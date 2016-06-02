<?php
/**
 * Chronolabs REST Pinging API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Pinging
 * @since           2.0.1
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @version         $Id: pinging.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		api
 * @description		Pinging API Action Class
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

 // 	suggested script example for '$ crontab -e'
 //
 // 	*/1 * * * * /var/www/ping.labs.coop/crons/tasks.php
 //



require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'apiconfig.php';

foreach(getDirListAsArray(API_DATA_TASKINGS) as $typefldr)
{
	foreach(getDirListAsArray(API_DATA_TASKINGS . DIRECTORY_SEPARATOR . $typefldr) as $peerfldr)
	{
		foreach(getJsonListAsArray($folder = API_DATA_TASKINGS . DIRECTORY_SEPARATOR . $typefldr . DIRECTORY_SEPARATOR . $peerfldr) as $jsonfile)
		{
			$data = json_decode(file_get_contents($folder . DIRECTORY_SEPARATOR . $jsonfile), true);
			if ($data['timeout'] >= microtime(true))
			{
				$local = getLocalPing($data['output'], $data['target'], $data['type'], $data['ttl'], $data['delay'], $data['bytes'], $data['version']);
				switch ($data['output'])
				{
					case 'local':
						$call = array();
						$call['callback'] = $data['callback'];
						$call['values'] = $local;
						$call['values']['identity'] = md5(json_encode($data));
						$call['values']['pings'][parse_url(API_URL, PHP_URL_HOST)] = $local;
						$call['values']['mode'] = 'ping';
						$call['values']['set'] = microtime(true);
						$call['timeout'] = microtime(true)+API_CRON_SECS_TIMEOUT;
						if (!is_dir($path = API_DATA_CALLBACKS . DIRECTORY_SEPARATOR . $data['type'] . DIRECTORY_SEPARATOR . parse_url(API_URL, PHP_URL_HOST)))
							mkdir($path, 0777, true);
						writeRawFile($path . DIRECTORY_SEPARATOR . md5(json_encode($call)) . '.json', json_encode($call));
						if (!is_dir($path = API_HISTORY . DIRECTORY_SEPARATOR . 'tasks' . DIRECTORY_SEPARATOR . $data['type'] . DIRECTORY_SEPARATOR . $data['target'] . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR . date('h')))
							mkdir($path, 0777, true);
						writeRawFile($path . DIRECTORY_SEPARATOR . microtime(true) . '.json', json_encode($data));
						unlink($folder . DIRECTORY_SEPARATOR . $jsonfile);
						break;
					case 'peers':
						$callfiles = array();
						foreach($data['peers'] as $peers)
						{
							if (!is_dir($path = API_DATA_CALLBACKS . DIRECTORY_SEPARATOR . $data['type'] . DIRECTORY_SEPARATOR . parse_url($peers, PHP_URL_HOST)))
								mkdir($path, 0777, true);
							if (!file_exist($callfiles[] = $path . DIRECTORY_SEPARATOR . md5($peers.json_encode($data)) . '.json'))
							{
								$call = array();
								$call['callback'] = $peers."/".str_replace("%version", $data['version'], str_replace('%delay', implode("-",$data['delay']), str_replace('%bytes', implode('-', $data['bytes']), str_replace('%ttl', $data['ttl'], str_replace('%target', $data['target'], str_replace('%peer', parse_url(API_URL, PHP_URL_HOST), str_replace('%state', 'local', str_replace('%url', API_URL . "/".str_replace("%version", $data['version'], str_replace('%delay', implode("-",$data['delay']), str_replace('%bytes', implode('-', $data['bytes']), str_replace('%ttl', $data['ttl'], str_replace('%target', md5(json_encode($data)), str_replace('%peer', parse_url(API_URL, PHP_URL_HOST),  str_replace('%state', 'return', API_CALLBACK_TARGET_TTL_DELAY_BYTES))))))), API_PEER_QUERY_TARGET_TTL_DELAY_BYTES))))))));
								$call['values'] = $data;
								$call['values']['peer'] = parse_url($peers, PHP_URL_HOST);
								$call['values']['identity'] = md5(json_encode($data));
								$call['values']['mode'] = 'remote';
								$call['values']['set'] = microtime(true);
								$call['timeout'] = microtime(true)+API_CRON_SECS_TIMEOUT;
								writeRawFile($path . DIRECTORY_SEPARATOR . md5($peers.json_encode($data)) . '.json', json_encode($call));
							}
						}
						$ended = 0;
						foreach($callfiles as $filez)
						{
							$datb = json_decode(file_get_contents($filez), true);
							if ($datb['timeout'] < microtime(true))
								$ended++;
						}
						if ($ended==count($callfiles))
						{
							foreach($callfiles as $filez)
							{
								$datb = json_decode(file_get_contents($filez), true);
								if (!is_dir($path = API_HISTORY . DIRECTORY_SEPARATOR . 'callbacks' . DIRECTORY_SEPARATOR . $data['type'] . DIRECTORY_SEPARATOR . $datb['peer'] . DIRECTORY_SEPARATOR . $data['target'] . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR . date('h')))
									mkdir($path, 0777, true);
								writeRawFile($path . DIRECTORY_SEPARATOR . microtime(true) . '.json', json_encode($datb));
								unlink($filez);
							}
							if (!is_dir($path = API_HISTORY . DIRECTORY_SEPARATOR . 'tasks' . DIRECTORY_SEPARATOR . $data['type'] . DIRECTORY_SEPARATOR . $data['target'] . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR . date('h')))
								mkdir($path, 0777, true);
							writeRawFile($path . DIRECTORY_SEPARATOR . microtime(true) . '.json', json_encode($data));
							unlink($folder . DIRECTORY_SEPARATOR . $jsonfile);
						}
						break;
				}
			}
		}
	}
}