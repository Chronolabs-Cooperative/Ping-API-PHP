<?php
/**
 * Chronolabs Entitiesing Repository Services REST API API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @package         entities
 * @since           2.1.9
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @subpackage		api
 * @description		Entitiesing Repository Services REST API
 * @link			http://sourceforge.net/projects/chronolabsapis
 * @link			http://cipher.labs.coop
 */



	$parts = explode(".", microtime(true));
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	$salter = ((float)(mt_rand(0,1)==1?'':'-').$parts[1].'.'.$parts[0]) / sqrt((float)$parts[1].'.'.intval(cosh($parts[0])))*tanh($parts[1]) * mt_rand(1, intval($parts[0] / $parts[1]));
	header('Blowfish-salt: '. $salter);
	
	global $source;
	require_once __DIR__ . DIRECTORY_SEPARATOR . 'apiconfig.php';
	
	include dirname(__FILE__).'/functions.php';
	
	$help=false;
	if (!isset($_GET['ping']) || empty($_GET['ping']) || empty($_GET['peer'])) {
		$help=true;
	} elseif (isset($_GET['output']) || !empty($_GET['ping']) && isset($_POST['identity'])) {
		$version = isset($_GET['version'])?trim($_GET['version']):'v2';
		$ping = trim($_GET['ping']);
		$output = trim($_GET['output']);
		$callback = isset($_GET['callback'])?trim($_GET['callback']):'';
		$peer = isset($_GET['peer'])?trim($_GET['peer']):$_SERVER['HOST_NAME'];
		$ttl = isset($_GET['ttl'])?trim($_GET['ttl']):API_DEFAULT_TTL;
		$bytes = isset($_GET['bytes'])?explode('-',trim($_GET['bytes'])):array(API_DEFAULT_BYTES);
		$delay = isset($_GET['delay'])?explode('-',trim($_GET['delay'])):array(API_DEFAULT_DELAY);
		if (validateIPv4($ping))
		{
			$type = 'ipv4';
		} elseif(validateIPv6($ping)) {
			$type = 'ipv6';
		} elseif(validateDomain($ping)) {
			$type = 'domain';
		} else 
			$help=true;
		if (!in_array($output, array('callback', 'return')))
			$help=true;
	} else {
		$help=true;
	}
	
	/**
	 * Checks with peer listing that source of call is supported
	 */
	$found = false;
	foreach(getAPIPeeredServices() as $peers)
		if (strpos($peers, $peer))
			$found = true;
	if ($found==false)
		$help = true;
	
	/**
	 * Buffers Help
	 */
	if ($help==true) {
		if (function_exists("http_response_code"))
			http_response_code(301);
		header("Location: " . API_URL);
		exit;
	}
	

	if (function_exists("http_response_code"))
		http_response_code(201);
	
	switch ($output)
	{
		case 'callback':
			$data = getCallbackLocalPing($output, $ping, $type, $ttl, $delay, $bytes, 'http://'.$peer."/".str_replace("%version", $version, str_replace('%delay', implode("-",$delay), str_replace('%bytes', implode('-', $bytes), str_replace('%ttl', $ttl, str_replace('%target', $ping, str_replace('%peer', parse_url(API_URL, PHP_URL_HOST), API_CALLBACK_TARGET_TTL_DELAY_BYTES)))))), $peer);
			$output = 'json';
			break;
		case 'return':
		
			
			
			break;
	}
	
	switch ($output) {
		case 'json':
			header('Content-type: application/json');
			echo json_encode($data);
			break;
	}
	exit(0);