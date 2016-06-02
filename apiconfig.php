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
 * @package         salty
 * @since           2.0.1
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @version         $Id: apiconfig.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		api
 * @description		Pinging API
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

/**
 * Opens Access Origin Via networking Route NPN
 */
header('Access-Control-Allow-Origin: *');
header('Origin: *');

/**
 * Turns of GZ Lib Compression for Document Incompatibility
 */
ini_set("zlib.output_compression", 'Off');
ini_set("zlib.output_compression_level", -1);

/**
 * 
 * @var constants
 */
define('API_URL', (!isset($_SERVER["HTTP_HOST"])?"http://ping.labs.coop":(isset($_SERVER["HTTPS"])?"https://":"http://").$_SERVER["HTTP_HOST"]));
define("API_CRON_SECS_TIMEOUT", 987);
define("API_CURL_RESULTTIMEOUT", 75);
define("API_CURL_CONNECTIONTIMEOUT", 35);
define("API_DEFAULT_BYTES", 396);
define("API_DEFAULT_TTL", 42);
define("API_DEFAULT_DELAY", 1);
define("API_UNITS_MIN", 7);
define("API_UNITS_MAX", 14);
define("API_PING_EXEC", "ping -c %units -i %delay -s %bytes %target");
define("API_FILE_IO_FOOTER", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'api-pings.labs.coop.html');
define("API_HISTORY", __DIR__ . DIRECTORY_SEPARATOR . 'history');
define("API_DATA_CALLBACKS", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'callbacks');
define("API_DATA_PEERS", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'peers');
define("API_DATA_TASKINGS", __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'tasks');
define("API_WHITELIST_DOMAIN", dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'whitelist-domains.txt');
define("API_WHITELIST_IP", dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'whitelist-ipaddy.txt');
define("API_BUSINESS", 'Chronolabs Cooperative (labs.coop)');
define("API_CALLBACK_TARGET", '/%version/%target/%peer/%state.api');
define("API_CALLBACK_TARGET_TTL", '/%version/%ttl/%target/%peer/%state.api');
define("API_CALLBACK_TARGET_TTL_DELAY", '/%version/%delay/%ttl/%target/%peer/%state.api');
define("API_CALLBACK_TARGET_TTL_DELAY_BYTES", '/%version/%bytes/%delay/%ttl/%target/%peer/%state.api');
define("API_PEER_QUERY_TARGET", '/%version/%target/%state.api?callback=%url');
define("API_PEER_QUERY_TARGET_TTL", '/%version/%ttl/%target/%state.api?callback=%url');
define("API_PEER_QUERY_TARGET_TTL_DELAY", '/%version/%delay/%ttl/%target/%state.api?callback=%url');
define("API_PEER_QUERY_TARGET_TTL_DELAY_BYTES", '/%version/%bytes/%delay/%ttl/%target/%state.api?callback=%url');

// Required for Accurate Trignometry of Ping GPS location
define("API_SERVER_LONGITUDE", '0.00000000001');
define("API_SERVER_LATITUDE", '0.00000000001');

error_reporting(E_ERROR);
ini_set('display_errors', false);
ini_set('log_errors', false);



?>