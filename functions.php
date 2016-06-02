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
 * @since           1.0.2
 * @author          Simon Roberts <simon@staff.labs.coop>
 * @version         $Id: functions.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		api
 * @description		Pinging API Service REST
 */


include dirname(__FILE__).'/class/pinging.php';


if (!function_exists("getDirListAsArray")) {
	function getDirListAsArray($dirname)
	{
		$ignored = array(
				'cvs' ,
				'_darcs');
		$list = array();
		if (substr($dirname, - 1) != '/') {
			$dirname .= '/';
		}
		if ($handle = opendir($dirname)) {
			while ($file = readdir($handle)) {
				if (substr($file, 0, 1) == '.' || in_array(strtolower($file), $ignored))
					continue;
					if (is_dir($dirname . $file)) {
						$list[$file] = $file;
					}
			}
			closedir($handle);
			asort($list);
			reset($list);
		}

		return $list;
	}
}

if (!function_exists("getFileListAsArray")) {
	function getFileListAsArray($dirname, $prefix = '')
	{
		$filelist = array();
		if (substr($dirname, - 1) == '/') {
			$dirname = substr($dirname, 0, - 1);
		}
		if (is_dir($dirname) && $handle = opendir($dirname)) {
			while (false !== ($file = readdir($handle))) {
				if (! preg_match('/^[\.]{1,2}$/', $file) && is_file($dirname . '/' . $file)) {
					$file = $prefix . $file;
					$filelist[$file] = $file;
				}
			}
			closedir($handle);
			asort($filelist);
			reset($filelist);
		}

		return $filelist;
	}
}

if (!function_exists("getJsonListAsArray")) {
	function getJsonListAsArray($dirname, $prefix = '')
	{
		$filelist = array();
		if ($handle = opendir($dirname)) {
			while (false !== ($file = readdir($handle))) {
				if (preg_match('/(\.json)$/i', $file)) {
					$file = $prefix . $file;
					$filelist[$file] = $file;
				}
			}
			closedir($handle);
			asort($filelist);
			reset($filelist);
		}

		return $filelist;
	}
}


if (!function_exists("getLocalPing")) {
	/**
	 * Does a local only ping of a target
	 *
	 * @param string $output
	 * @param string $target
	 * @param string $type
	 * @param integer $ttl
	 * @param array $delay
	 * @param array $bytes
	 *
	 * @return array
	 */
	function getLocalPing($output, $target, $type, $ttl, $delay, $bytes, $version = 'v2')
	{
		$result = array();
		foreach($delay as $dly)
			foreach($bytes as $len)
			{
				$result[$type][$ttl][$dly][$len] = pinging::ping($target, $ttl, $dly, $len, $type);
			}
		return $result;
	}
}


if (!function_exists("getCallbackLocalPing")) {
	/**
	 * Does a local only ping of a target and return session key identifier as data to immediately
	 * output in calling this routine.
	 *
	 * @param string $output
	 * @param string $target
	 * @param string $type
	 * @param integer $ttl
	 * @param array $delay
	 * @param array $bytes
	 * @param string $callback
	 * @param string $peer
	 * 
	 * @return array
	 */
	function getCallbackLocalPing($output, $ping, $type, $ttl, $delay, $bytes, $callback, $peer, $version = 'v2')
	{
		$task = array();
		$task['output'] = $output;
		$task['target'] = $ping;
		$task['type'] = $type;
		$task['ttl'] = $ttl;
		$task['delay'] = $delay;
		$task['bytes'] = $bytes;
		$task['callback'] = $callback;
		$task['version'] = $version;
		$task['peers'] = array();
		$task['peer'] = $peer;
		$task['set'] = microtime(true);
		$task['timeout'] = microtime(true)+API_CRON_SECS_TIMEOUT;
		if (!is_dir($path = API_DATA_TASKINGS . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $peer))
			mkdir($path, 0777, true);
		writeRawFile($path . DIRECTORY_SEPARATOR . md5(json_encode($task)) . '.json', json_encode($task));
		return array('identity'=>md5(json_encode($task)));
	}
}

if (!function_exists("getCallbackPeersPing")) {
	/**
	 * Does a local only ping of a target and return session key identifier as data to immediately
	 * output in calling this routine.
	 *
	 * @param string $output
	 * @param string $target
	 * @param string $type
	 * @param integer $ttl
	 * @param array $delay
	 * @param array $bytes
	 * @param string $callback
	 * @param string $peer
	 *
	 * @return array
	 */
	function getCallbackPeersPing($output, $ping, $type, $ttl, $delay, $bytes, $callback, $peer, $version = 'v2')
	{
		$task = array();
		$task['output'] = $output;
		$task['target'] = $ping;
		$task['type'] = $type;
		$task['ttl'] = $ttl;
		$task['delay'] = $delay;
		$task['bytes'] = $bytes;
		$task['callback'] = $callback;
		$task['version'] = $version;
		$task['peers'] = getAPIPeeredServices();
		$task['peer'] = $peer;
		$task['set'] = microtime(true);
		$task['timeout'] = microtime(true)+API_CRON_SECS_TIMEOUT;
		if (!is_dir($path = API_DATA_TASKINGS . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $peer))
			mkdir($path, 0777, true);
		writeRawFile($path . DIRECTORY_SEPARATOR . md5(json_encode($task)) . '.json', json_encode($task));
		return array('identity'=>md5(json_encode($task)));
	}
}


if (!function_exists("validateDomain")) {
	/**
	 * validateDomain()
	 * Validates a Domain Name
	 *
	 * @param string $domain
	 * @return boolean
	 */
	function validateDomain($domain) {
		if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
			return false;
		}
		return $domain;
	}
}

if (!function_exists("validateIPv4")) {
	/**
	 * validateIPv4()
	 * Validates and IPv6 Address
	 *
	 * @param string $ip
	 * @return boolean
	 */
	function validateIPv4($ip) {
		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) === FALSE) // returns IP is valid
		{
			return false;
		} else {
			return true;
		}
	}
}

if (!function_exists("validateIPv6")) {
	/**
	 * validateIPv6()
	 * Validates and IPv6 Address
	 *
	 * @param string $ip
	 * @return boolean
	 */
	function validateIPv6($ip) {
		if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === FALSE) // returns IP is valid
		{
			return false;
		} else {
			return true;
		}
	}
}

if (!function_exists("cleanWhitespaces")) {
	/**
	 *
	 * @param array $array
	 */
	function cleanWhitespaces($array = array())
	{
		foreach($array as $key => $value)
		{
			if (is_array($value))
				$array[$key] = cleanWhitespaces($value);
				else {
					$array[$key] = trim(str_replace(array("\n", "\r", "\t"), "", $value));
				}
		}
		return $array;
	}
}

if (!function_exists("getAPIPeeredServices")) {

	/* function getAPIPeeredServices()
	 *
	 * 	Get a Listed Peered Services excluding current API URL for this Service
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 *
	 * @return 		array()
	 */
	function getAPIPeeredServices()
	{
		static $uris = array();
		if (empty($uris))
		{
			$uris = cleanWhitespaces(file($file = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "peered-services.diz"));
			shuffle($uris); shuffle($uris); shuffle($uris); shuffle($uris);
			foreach($uris as $lk => $uri)
			{
				if ($uri == API_URL)
					unset($uris[$lk]);
				if (substr($uri,0,1) == '#')
					unset($uris[$lk]);
			}
		}
		return $uris;
	}
}

if (!function_exists("getAPILocation")) {

	/* function getAPILocation()
	 *
	 * 	Get a locational and mapping positions for the server
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 *
	 * @return 		array()
	 */
	function getAPILocation()
	{
		if (!file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'lookup-' . $_SERVER["HTTP_HOST"] . '.json'))
		{
			$uris = cleanWhitespaces(file($file = __DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "lookups.diz"));
			shuffle($uris); shuffle($uris); shuffle($uris); shuffle($uris);
			$data = array();
			foreach($uris as $uri)
			{
				$data = json_decode(getURIData(sprintf($uri, 'myself', 'json'), API_CURL_RESULTTIMEOUT, API_CURL_CONNECTIONTIMEOUT), true);
				if (count($data['locality']) > 1 &&  $data['locality']['country']['iso'] != "-")
					continue;
			}
			if (API_SERVER_LONGITUDE != '0.00000000001' && API_SERVER_LATITUDE != '0.00000000001')
				$data['location']['coordinates'] = array('latitude' => API_SERVER_LATITUDE, 'longitude' => API_SERVER_LONGITUDE);
			writeRawFile($file, json_encode($data));
		} else 
			return json_decode(file_get_contents($file), true);
		return $data;
	}
}


if (!function_exists("getURIData")) {

	/* function getURIData()
	 *
	 * 	Get a supporting domain system for the API
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 *
	 * @return 		float()
	 */
	function getURIData($uri = '', $timeout = 25, $connectout = 25)
	{
		if (!function_exists("curl_init"))
		{
			return file_get_contents($uri);
		}
		if (!$btt = curl_init($uri)) {
			return false;
		}
		curl_setopt($btt, CURLOPT_HEADER, 0);
		curl_setopt($btt, CURLOPT_POST, 0);
		curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, $connectout);
		curl_setopt($btt, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($btt, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($btt, CURLOPT_VERBOSE, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($btt);
		curl_close($btt);
		return $data;
	}
}



if (!function_exists("writeRawFile")) {
	/**
	 *
	 * @param string $file
	 * @param string $data
	 */
	function writeRawFile($file = '', $data = '')
	{
		$lineBreak = "\n";
		if (substr(PHP_OS, 0, 3) == 'WIN') {
			$lineBreak = "\r\n";
		}
		if (!is_dir(dirname($file)))
			mkdir(dirname($file), 0777, true);
			if (is_file($file))
				unlink($file);
				$data = str_replace("\n", $lineBreak, $data);
				$ff = fopen($file, 'w');
				fwrite($ff, $data, strlen($data));
				fclose($ff);
	}
}


if (!function_exists("whitelistGetIP")) {

	/* function whitelistGetIPAddy()
	 * 
	 * 	provides an associative array of whitelisted IP Addresses
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 * 
	 * @return 		array
	 */
	function whitelistGetIPAddy() {
		return array_merge(whitelistGetNetBIOSIP(), file(API_WHITELIST_IP));
	}
}

if (!function_exists("whitelistGetNetBIOSIP")) {

	/* function whitelistGetNetBIOSIP()
	 *
	 * 	provides an associative array of whitelisted IP Addresses base on TLD and NetBIOS Addresses
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 *
	 * @return 		array
	 */
	function whitelistGetNetBIOSIP() {
		$ret = array();
		foreach(file(API_WHITELISTS_DOMAINS) as $domain) {
			$ip = gethostbyname($domain);
			$ret[$ip] = $ip;
		} 
		return $ret;
	}
}

if (!function_exists("whitelistGetIP")) {

	/* function whitelistGetIP()
	 *
	 * 	get the True IPv4/IPv6 address of the client using the API
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 * 
	 * @param		boolean		$asString	Whether to return an address or network long integer
	 * 
	 * @return 		mixed
	 */
	function whitelistGetIP($asString = true){
		// Gets the proxy ip sent by the user
		$proxy_ip = '';
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$proxy_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else
		if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
			$proxy_ip = $_SERVER['HTTP_X_FORWARDED'];
		} else
		if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
			$proxy_ip = $_SERVER['HTTP_FORWARDED_FOR'];
		} else
		if (!empty($_SERVER['HTTP_FORWARDED'])) {
			$proxy_ip = $_SERVER['HTTP_FORWARDED'];
		} else
		if (!empty($_SERVER['HTTP_VIA'])) {
			$proxy_ip = $_SERVER['HTTP_VIA'];
		} else
		if (!empty($_SERVER['HTTP_X_COMING_FROM'])) {
			$proxy_ip = $_SERVER['HTTP_X_COMING_FROM'];
		} else
		if (!empty($_SERVER['HTTP_COMING_FROM'])) {
			$proxy_ip = $_SERVER['HTTP_COMING_FROM'];
		}
		if (!empty($proxy_ip) && $is_ip = preg_match('/^([0-9]{1,3}.){3,3}[0-9]{1,3}/', $proxy_ip, $regs) && count($regs) > 0)  {
			$the_IP = $regs[0];
		} else {
			$the_IP = $_SERVER['REMOTE_ADDR'];
		}
			
		$the_IP = ($asString) ? $the_IP : ip2long($the_IP);
		return $the_IP;
	}
}

if (!class_exists("XmlDomConstruct")) {
	/**
	 * class XmlDomConstruct
	 * 
	 * 	Extends the DOMDocument to implement personal (utility) methods.
	 *
	 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
	 */
	class XmlDomConstruct extends DOMDocument {
	
		/**
		 * Constructs elements and texts from an array or string.
		 * The array can contain an element's name in the index part
		 * and an element's text in the value part.
		 *
		 * It can also creates an xml with the same element tagName on the same
		 * level.
		 *
		 * ex:
		 * <nodes>
		 *   <node>text</node>
		 *   <node>
		 *     <field>hello</field>
		 *     <field>world</field>
		 *   </node>
		 * </nodes>
		 *
		 * Array should then look like:
		 *
		 * Array (
		 *   "nodes" => Array (
		 *     "node" => Array (
		 *       0 => "text"
		 *       1 => Array (
		 *         "field" => Array (
		 *           0 => "hello"
		 *           1 => "world"
		 *         )
		 *       )
		 *     )
		 *   )
		 * )
		 *
		 * @param mixed $mixed An array or string.
		 *
		 * @param DOMElement[optional] $domElement Then element
		 * from where the array will be construct to.
		 * 
		 * @author 		Simon Roberts (Chronolabs) simon@staff.labs.coop
		 *
		 */
		public function fromMixed($mixed, DOMElement $domElement = null) {
	
			$domElement = is_null($domElement) ? $this : $domElement;
	
			if (is_array($mixed)) {
				foreach( $mixed as $index => $mixedElement ) {
	
					if ( is_int($index) ) {
						if ( $index == 0 ) {
							$node = $domElement;
						} else {
							$node = $this->createElement($domElement->tagName);
							$domElement->parentNode->appendChild($node);
						}
					}
					 
					else {
						$node = $this->createElement($index);
						$domElement->appendChild($node);
					}
					 
					$this->fromMixed($mixedElement, $node);
					 
				}
			} else {
				$domElement->appendChild($this->createTextNode($mixed));
			}
			 
		}
		 
	}
}

?>