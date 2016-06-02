<?php
/**
 * Chronolabs REST API File
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
 * @since           1.1.2
 * @author          Simon Roberts <simon@staff.labs.coop>
 * @version         $Id: help.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		api
 * @description		Pinging API Service REST
 */

	$parts = explode(".", microtime(true));
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	$salter = ((float)(mt_rand(0,1)==1?'':'-').$parts[1].'.'.$parts[0]) / sqrt((float)$parts[1].'.'.intval(cosh($parts[0])))*tanh($parts[1]) * mt_rand(1, intval($parts[0] / $parts[1]));
	header('Blowfish-salt: '. $salter);
	
	require_once __DIR__ . DIRECTORY_SEPARATOR . 'apiconfig.php';
	
	global $source;
	$source = API_URL;

	include dirname(__FILE__).'/functions.php';
	
	$help=false;
	if (!isset($_GET['ping']) || empty($_GET['ping'])) {
		$help=true;
	} elseif (isset($_GET['output']) || !empty($_GET['ping'])) {
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
		if (!in_array($output, array('json', 'serial', 'xml', 'peers', 'local')))
			$help=true;
	} else {
		$help=true;
	}
	
	/**
	 * Buffers Help
	 */
	if ($help==true) {
		if (function_exists("http_response_code"))
			http_response_code(400);
		include dirname(__FILE__).'/help.php';
		exit;
	}
	
	/**
	 * Calculates Whitelist
	 */
	if (function_exists('whitelistGetIP') && function_exists('whitelistGetIPAddy') && defined('MAXIMUM_QUERIES'))
	{
		session_start();
		if (!in_array(whitelistGetIP(true), whitelistGetIPAddy())) {
			if (isset($_SESSION['reset']) && $_SESSION['reset']<microtime(true))
				$_SESSION['hits'] = 0;
			if ($_SESSION['hits']<=MAXIMUM_QUERIES) {
				if (!isset($_SESSION['hits']) || $_SESSION['hits'] = 0)
					$_SESSION['reset'] = microtime(true) + 3600;
				$_SESSION['hits']++;
			} else {
				header("HTTP/1.0 404 Not Found");
				if (function_exists("http_response_code"))
					http_response_code(404);
				exit;
			}
		}
	}
	
	switch ($output) {
		case 'json':
		case 'xml':
		case 'serial':
			if (function_exists("http_response_code"))
				http_response_code(200);
					
			$data = getLocalPing($output, $ping, $type, $ttl, $delay, $bytes, $version);
			break;
		
		case 'local':
			if (function_exists("http_response_code"))
				http_response_code(201);
		
			$data = getCallbackLocalPing($output, $ping, $type, $ttl, $delay, $bytes, $callback, $peer, $version);
			$output = 'json';
			break;
		
		case 'peer':
			if (function_exists("http_response_code"))
				http_response_code(201);
		
			$data = getCallbackPeersPing($output, $ping, $type, $ttl, $delay, $bytes, $callback, $peer, $version);
			$output = 'json';
			break;
	}
	
	switch ($output) {
		case 'json':
			header('Content-type: application/json');
			echo json_encode($data);
			break;
		case 'serial':
			header('Content-type: text/html');
			echo serialise($data);
			break;
		case 'xml':
			header('Content-type: application/xml');
			$dom = new XmlDomConstruct('1.0', 'utf-8');
			$dom->fromMixed(array('root'=>$data));
 			echo $dom->saveXML();
			break;
	}
	exit(0);
?>