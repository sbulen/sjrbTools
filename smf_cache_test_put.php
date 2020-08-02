<?php 
//
// An SMF utility to PUT a file to cache, repeatedly, rapidly.
// Intended to help test race conditions, etc., behavior when making changes to smf caching.
// The goal should be for this to complete all requested executions without error.
//
// To use, copy both utilities to the forum root, where Settings.php is, & execute them simultaneously.
// Things are most interesting when you run at least two PUT scripts while running a GET script...
// Two PUTs at the same time trigger the race conditions that cause issues.
//
// ***** SMF 2.0 $ 2.1 *****
//

// Config section...
$file = 'nonimportantsettings';
$fields = 100;		// how many fields in your json
$size = 100;		// how big is each field
$sleeptime = 100;	// in milliseconds
$writes = 1000; 	// don't go on forever...
// End config section

//*** Main program
doStartup();
loadSettings();
for ($i =1; $i <= $writes; $i++)
	dumpFile($i);
doWrapUp();
return;

//*** Startup 
function doStartup() {

	global $rundir, $fp, $url, $board;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>*****************************<br>");
	echo("**** SMF rapid PUT to cache ****<br>");
	echo("*****************************<br>");

	define('SMF', 1);
	define('SMF_VERSION', '2.1 RC2');
	define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
	define('MYSQL_TITLE', 'MySQL');

	@flush();

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	return;
}

//*** Settings File 
function loadSettings() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $boardurl, $sourcedir, $cachedir, $modSettings;
	global $cache_accelerator, $cache_enable, $cacheAPI;

	$smcFunc = array();

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	// Load modSettings
	require_once($sourcedir . '/Subs.php');
	require_once($sourcedir . '/Load.php');
	reloadSettings();

	return;
}

//*** Create a file & dump to cache
function dumpFile($fileno) {

	global $file, $fields, $size, $sleeptime, $sourcedir, $modSettings, $cacheAPI;

	// Build an array
	$randomstuff = array();
	for ($i = 1; $i <= $fields; $i++)
	{
		$randomstuff['field' . $i] = randString($size);
	}

	// Write to cache
	require_once($sourcedir . '/Subs.php');
	require_once($sourcedir . '/Load.php');
	cache_put_data($file, $randomstuff);

	echo 'Dumping file ' . $fileno . '...<br>';
//	echo $file . '<br>';
//	echo print_r($randomstuff, TRUE) . '<br>';
	@ob_flush();

	@flush();
	
	// Pause briefly
	usleep($sleeptime * 1000);

	return;
}

//*** Create a random string of specified length
function randString($size) {

	// Build an array
	static $chars = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$^%$&*(_)+-@~\"\' ';
	$output = '';
	for ($i = 1; $i <= $size; $i++)
		$output .= substr($chars, rand(0, strlen($chars) - 1), 1);

	return $output;
}

//*** Wrap Up 
function doWrapUp() {

	echo "<br>Completed!<br><br>";
	echo '</pre>';

	@flush();	
	return;
}

?>