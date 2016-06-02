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
	
	global $domain, $protocol, $business, $entity, $contact, $referee, $peerings, $source;
	$clienthost = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
	$ttl = mt_rand(24,99);
	$delay = mt_rand(1,13);
	$bytes = mt_rand(256,7096);
	$sets = mt_rand(2,5);
	$res = array();
	for($i=1;$i<=$sets;$i++)
		$res[$i] = mt_rand(1,13);
	$delayset = implode("-", $res);
	$delaysets = implode(", ", $res);
	$res = array();
	for($i=1;$i<=$sets;$i++)
		$res[$i] = mt_rand(256,7096);
	$bytesset = implode("-", $res);
	$bytessets = implode(", ", $res);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<?php 	
		$servicename = "Pinging API Services"; 
		$servicecode = "PAS"; 
	?>
	<meta property="og:url" content="<?php echo (isset($_SERVER["HTTPS"])?"https://":"http://").$_SERVER["HTTP_HOST"]; ?>" />
	<meta property="og:site_name" content="<?php echo $servicename; ?> Open Services API's (With Source-code) from <?php echo API_BUSINESS; ?>"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="rating" content="general" />
	<meta http-equiv="author" content="wishcraft@users.sourceforge.net" />
	<meta http-equiv="copyright" content="<?php echo API_BUSINESS; ?> &copy; <?php echo date("Y")-1; ?>-<?php echo date("Y")+1; ?>" />
	<meta http-equiv="generator" content="wishcraft@users.sourceforge.net" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="//labs.partnerconsole.net/execute2/external/reseller-logo">
	<link rel="icon" href="//labs.partnerconsole.net/execute2/external/reseller-logo">
	<link rel="apple-touch-icon" href="//labs.partnerconsole.net/execute2/external/reseller-logo">
	<meta property="og:image" content="//labs.partnerconsole.net/execute2/external/reseller-logo"/>
	<link rel="stylesheet" href="/style.css" type="text/css" />
	<link rel="stylesheet" href="https://css.ringwould.com.au/3/gradientee/stylesheet.css" type="text/css" />
	<link rel="stylesheet" href="https://css.ringwould.com.au/3/shadowing/styleheet.css" type="text/css" />
	<title><?php echo $servicename; ?> (<?php echo $servicecode; ?>) Open API || <?php echo API_BUSINESS; ?></title>
	<meta property="og:title" content="<?php echo $servicename; ?> Open Services API's (With Source-code) from <?php echo API_BUSINESS; ?>"/>
	<meta property="og:type" content="<?php echo strtolower($servicecode); ?>-api"/>
	<!-- AddThis Smart Layers BEGIN -->
	<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50f9a1c208996c1d"></script>
	<script type="text/javascript">
	  addthis.layers({
		'theme' : 'transparent',
		'share' : {
		  'position' : 'right',
		  'numPreferredServices' : 6
		}, 
		'follow' : {
		  'services' : [
			{'service': 'twitter', 'id': 'ChronolabsCoop'},
			{'service': 'twitter', 'id': 'Cipherhouse'},
			{'service': 'twitter', 'id': 'OpenRend'},
			{'service': 'facebook', 'id': 'Chronolabs'},
			{'service': 'twitter', 'id': 'OfficalNorez'},
			{'service': 'google_follow', 'id': '105256588269767640343'},
			{'service': 'google_follow', 'id': '116789643858806436996'}
		  ]
		},  
		'whatsnext' : {},  
		'recommended' : {
		  'title': 'Recommended for you:'
		} 
	  });
	</script>
	<!-- AddThis Smart Layers END -->
</head>
<body>
<div class="main">
    <h1>Pinging API Services -- <?php echo API_BUSINESS; ?></h1>
    <p>This is an API Service for conducting a Pinging on both IPv4, IPv6 and domain names. It provides a range of document standards for you to access the API inclusing JSON, XML, Serialisation, HTML and RAW outputs.</p>
    <p>You can access the API currently without a key or system it is an open api and was written in response to the many API Services that charge fees + charging amounts for querying such a simple base. The following instructions are how to access the api I hope you enjoy this api as I have writting it with the help of net registry.</p>
	<h2>Code API Documentation</h2>
    <p>You can find the phpDocumentor code API documentation at the following path :: <a href="<?php echo $source; ?>docs/" target="_blank"><?php echo $source; ?>docs/</a>. These should outline the source code core functions and classes for the API to function!</p>
    <h2>Peering Services Queried with Pushed Callback Result</h2>
    <p>This is done with the <em>peers.api</em> extension at the end of the url, this will crawl any internally listed pinging api services for the ping result and return the result in $_POST as a callback URL</p>
    <blockquote>
      
        <!-- Basic Ping with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        
        <!-- Time-to-live Ping with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        
        <!-- Time-to-live with delay between pinging with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

		<!-- Several pinging sets with different delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

		<!-- Single ping with packet size + delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
		
		<!-- Sets of ping's with packet size + several pinging sets with different delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

		<!-- Sets of ping's with different sets of packet size + repeating pinging sets with different delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/peers.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

    </blockquote>
    <h2>Local Only Pinging Service Callback Result</h2>
    <p>This is done with the <em>local.api</em> extension at the end of the url, this will only ping on the local service api for the ping result and return the result in $_POST as a callback URL</p>
    <blockquote>
      
        <!-- Basic Ping with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        
        <!-- Time-to-live Ping with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        
        <!-- Time-to-live with delay between pinging with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

		<!-- Several pinging sets with different delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

		<!-- Single ping with packet size + delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
		
		<!-- Sets of ping's with packet size + several pinging sets with different delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

		<!-- Sets of ping's with different sets of packet size + repeating pinging sets with different delay between ping + time-to-live in seconds with callback url called with pushed $_POST array -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/local.api?callback=http://example.com/callback/pings.php</a></strong></em><br /><br />

    </blockquote>
    <h2>Serialisation Document Output</h2>
    <p>This is done with the <em>serial.api</em> extension at the end of the url, this will only ping on the local service api for the ping result and return the result immediately in the PHP Serialisation format in array with history etc!</p>
    <blockquote>
      
        <!-- Basic Ping with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />
        
        <!-- Time-to-live Ping with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />
        
        <!-- Time-to-live with delay between pinging with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />

		<!-- Several pinging sets with different delay between ping + time-to-live in seconds with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />

		<!-- Single ping with packet size + delay between ping + time-to-live in seconds with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />
		
		<!-- Sets of ping's with packet size + several pinging sets with different delay between ping + time-to-live in seconds with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />

		<!-- Sets of ping's with different sets of packet size + repeating pinging sets with different delay between ping + time-to-live in seconds with serial output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/serial.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/serial.api</a></strong></em><br /><br />

    </blockquote>
    <h2>JSON Document Output</h2>
    <p>This is done with the <em>json.api</em> extension at the end of the url, this will only ping on the local service api for the ping result and return the result immediately in the JSON format in array with history etc!</p>
    <blockquote>
      
        <!-- Basic Ping with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />
        
        <!-- Time-to-live Ping with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />
        
        <!-- Time-to-live with delay between pinging with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />

		<!-- Several pinging sets with different delay between ping + time-to-live in seconds with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />

		<!-- Single ping with packet size + delay between ping + time-to-live in seconds with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />
		
		<!-- Sets of ping's with packet size + several pinging sets with different delay between ping + time-to-live in seconds with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />

		<!-- Sets of ping's with different sets of packet size + repeating pinging sets with different delay between ping + time-to-live in seconds with json output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/json.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/json.api</a></strong></em><br /><br />

    </blockquote>
    <h2>XML Document Output</h2>
    <p>This is done with the <em>xml.api</em> extension at the end of the url, this will only ping on the local service api for the ping result and return the result immediately in the XML format in array with history etc!</p>
    <blockquote>
      
        <!-- Basic Ping with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em></font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />
        
        <!-- Time-to-live Ping with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />
        
        <!-- Time-to-live with delay between pinging with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $delay; ?> seconds delay between pings</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />

		<!-- Several pinging sets with different delay between ping + time-to-live in seconds with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl) <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />

		<!-- Single ping with packet size + delay between ping + time-to-live in seconds with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $delay; ?> seconds delay</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delay; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />
		
		<!-- Sets of ping's with packet size + several pinging sets with different delay between ping + time-to-live in seconds with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes of <?php echo $bytes; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytes; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />

		<!-- Sets of ping's with different sets of packet size + repeating pinging sets with different delay between ping + time-to-live in seconds with xml output -->
        <font color="#009900">Ping's a domain of <em>'<?echo $clienthost; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl) and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?echo $clienthost; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv4 address  of <em>'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/<?php echo $_SERVER["REMOTE_ADDR"]; ?>/xml.api</a></strong></em><br /><br />
        <font color="#009900">Ping's a IPv6 address of <em>'2001:0:9d38:953c:1052:39d8:8355:2880'</em> with <?php echo $ttl; ?>ms time to live (ttl)  and packet sizes passes set's <?php echo $bytessets; ?> bytes with <?php echo $sets; ?> passes pinging with <?php echo $delaysets; ?> seconds delay in each set</font><br/>
        <em><strong><a href="<?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api" target="_blank"><?php echo $source; ?>v2/<?php echo $bytesset; ?>/<?php echo $delayset; ?>/<?php echo $ttl; ?>/2001:0:9d38:953c:1052:39d8:8355:2880/xml.api</a></strong></em><br /><br />

    </blockquote>
    <?php if (file_exists(API_FILE_IO_FOOTER)) {
    	readfile(API_FILE_IO_FOOTER);
    }?>	
    <?php if (!in_array(whitelistGetIP(true), whitelistGetIPAddy())) { ?>
    <h2>Limits</h2>
    <p>There is a limit of <?php echo MAXIMUM_QUERIES; ?> queries per hour. You can add yourself to the whitelist by using the following form API <a href="http://whitelist.<?php echo domain; ?>/">Whitelisting form (whitelist.<?php echo domain; ?>)</a>. This is only so this service isn't abused!!</p>
    <?php } ?>
    <h2>The Author</h2>
    <p>This was developed by Simon Roberts in 2013 and is part of the Chronolabs System and api's.<br/><br/>This is open source which you can download from <a href="https://sourceforge.net/projects/chronolabsapis/">https://sourceforge.net/projects/chronolabsapis/</a> contact the scribe  <a href="mailto:wishcraft@users.sourceforge.net">wishcraft@users.sourceforge.net</a></p></body>
</div>
</html>
<?php 
