<?php

/*
$cachefile ='cache/'.basename($_SERVER['SCRIPT_URI']);
$cachetime = 10 * 60; // 10 min
if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
include($cachefile);
echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
exit;
}
ob_start();
*/

header('Content-Type: text/html; charset=utf-8');


const DEBUG = true;
const WS_URL = 'http://www.giantbomb.com/api/search/?api_key=4cd2262e2399bb08f1507d97726ad8b5d34cebbc&format=json&query=%22elder%20scrolls%20online%22&resources=game&field_list=name,description';

if (DEBUG)
{
	ini_set('display_errors', 1);
	error_reporting(~0);
}

// Our dependencies
$logger = require('log.php');
require('cache.php');
require('restclient.class.php');

$cache = new Cache();

// Track how long we're doing all of this
$logger->Log("Starting");

$rest = new RestClient($cache, $logger);

try
{
	$data = $rest->Request(WS_URL, 'GET', true);
}
catch (Exception $e)
{
	// make sure the view can handle a false $data
	$data = false;
}

include('views/page.php');

// How long have been?
$logger->Log("Finished!");

if (DEBUG)
{
	include('views/debug.php');
}

/*
$fp = fopen($cachefile, 'w'); 
fwrite($fp, ob_get_contents()); 
fclose($fp); 
ob_end_flush();
*/