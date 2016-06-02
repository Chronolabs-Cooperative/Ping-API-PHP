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



/**
 * 
 */
 class pinging
 {
 	/**
 	 * Pings a Target
 	 * 
 	 * @param unknown $target
 	 * @param unknown $output
 	 */
 	public static function ping($target = 'example.com', $ttl = 41, $delay = 2, $bytes = 1024, $type = 'domain')
 	{
 		$start = microtime(true);
 		exec(str_replace("%units", (string)($units = mt_rand(API_UNITS_MIN, API_UNITS_MAX)), str_replace('%ttl', $ttl, str_replace('%delay', $delay, str_replace('%target', $target, API_PING_EXEC)))), $output, $reolve);
 		if (!count($output) || empty($output))
 			return false;
 		$times = array();
 		foreach($output as $line => $value)
 		{
 			if (strpos($value, "time=")>0)
 			{
 				$parts = explode("time=", $value);
 				$times[] = $parts[1];
 			}
 		}
 		$resolved = trim(str_replace(" ping statistics ", "", str_replace("---", "", $output[count($output)-3])));
 		$broadcast = explode(', ', $output[count($output)-2]);
 		$bit = explode(' = ', $output[count($output)-1]);
 		$parts = explode(' ', $bit[1]);
 		$timers = explode('/', $parts[0]);
 		$statistics = array('minimum' => $timers[0] . ' ' . $parts[1], 'average' => $timers[1] . ' ' . $parts[1], 'maximum' => $timers[2] . ' ' . $parts[1], 'deviation' => $timers[3] . ' ' . $parts[1], 'target' => $target, 'ttl' => $ttl, 'delay' => $delay, 'bytes' => $bytes, 'units' => $units);
 		$history = array();
 		if (!is_dir(API_HISTORY . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $target))
 			mkdir(API_HISTORY . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $target, 0777, true);
 		if (file_exist($file = API_HISTORY . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $target . DIRECTORY_SEPARATOR . 'statistical-history.json'))
 			$history = json_decode(file_get_contents($file), true); 		
 		$data = array('timings' => $times, 'resolved' => $resolved, 'broadcasting' => $broadcast, 'statistics' => $statistics, 'start' => $start, 'finish' => microtime(true), 'location' => getAPILocation(), 'hostname' => $_SERVER["HOST_NAME"], 'history' => isset($history[$resolved])?$history[$resolved]:array());
 		if (!is_dir($path = API_HISTORY . DIRECTORY_SEPARATOR . 'local' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $target . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR . date('h')))
 			mkdir($path, 0777, true);
		writeRawFile($path . DIRECTORY_SEPARATOR . $resolved.'--'.$data['finish'] . '.json', json_encode($data));
		$history[$resolved][$data['finish']] = $statistics;
		writeRawFile($file, json_encode($history));
		return $data;
 	}
 }