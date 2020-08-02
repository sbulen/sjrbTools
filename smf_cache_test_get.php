<?php 
// 
// An SMF utility to GET a file from cache, repeatedly, rapidly.
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
$sleeptime = 10;	// in milliseconds, between GETs
$reads = 1000; 		// don't go on forever...
// End config section

//*** Main program
doStartup();
loadSettings();
for ($i =1; $i <= $reads; $i++)
	getfile($i);
doWrapUp();
return;

//*** Startup 
function doStartup() {

	global $rundir, $fp, $url, $board, $allTimer;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>********************************<br>");
	echo("**** SMF rapid GET from cache ****<br>");
	echo("********************************<br>");

	define('SMF', 1);
	define('SMF_VERSION', '2.1 RC2');
	define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
	define('MYSQL_TITLE', 'MySQL');

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	@flush();

	// Prime the pump...
	$allTimer = microtime(true);

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

//*** Read cache
function getFile($fileno) {

	global $file, $fields, $size, $sleeptime, $sourcedir, $cacheAPI;

	// Read from cache
	require_once($sourcedir . '/Subs.php');
	require_once($sourcedir . '/Load.php');

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	$joe = cache_get_data($file);

//	echo 'file: ' . $file . '<br>';
//	echo 'data: ' . print_r($joe, TRUE) . '<br>';

	if (is_null($joe))
	{
		echo 'NOT Successfully read file ' . $fileno . ' IS NULL...<br>';
	}
	elseif (count($joe) != $fields)
	{
		echo 'NOT Successfully read file ' . $fileno . ' incomplete: only ' . count($joe) . ' rows...<br>';
		echo ' error: ' . print_r(error_get_last(), TRUE) . '<br>';
		echo '   joe: ' . print_r($joe, TRUE) . '<br>';
	}
	else
		echo 'Successfully read file ' . $fileno . '...<br>';

	@flush();
	
	// Pause briefly
	usleep($sleeptime * 1000);

	return;
}

//*** Wrap Up 
function doWrapUp() {

	global $allTimer;

	echo "<br>Completed!<br><br>";

	echo "<br>Elapsed time: " . timer($allTimer) . "<br><br>";

	// Yes, both flushes necessary
	@flush();
	return;
}

//*** Timer - returns time from prior call as h:m:s:msec string
function timer(&$timer) {

	$diff = abs(microtime(TRUE) - $timer);
	
	$temp = (int) $diff;  // get seconds (fraction is msec)
	$msec = (int) (($diff - $temp) * 1000000);

	$H = intdiv_alt($temp, 3600);
	$temp = $temp % 3600;
	$M = intdiv_alt($temp, 60);
	$S = $temp % 60;

	// Reset timer for next call...
	$timer = microtime(TRUE);

	return ($H . ":" . $M . ":" . $S . ":" . $msec);
}

// Crap, intdiv is only php 7+
function intdiv_alt($a, $b){
    return ($a - $a % $b) / $b;
}

?>