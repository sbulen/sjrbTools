<?php 
// 
// An SMF utility to dump settings file & table information to help diagnose issues.
//
// Sometimes you just want to see it all...
//
// *** NOTE that some mods place password info in the Settings table - do not publicly share the output of this utility *****
//
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL & Postgresql *****
//
// Usage guidelines:
// (1) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (2) Execute it from your browser.
// (3) Delete it when you're done.
//     by sbulen
// 

//*** Main program
doStartup();
doSettingsFile();
doSmcFuncs();
doSettingsTable();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>********************************<br>");
	echo("******* SMF Settings dump ********<br>");
	echo("********************************<br>");

	define('SMF', 1);
	
	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Settings File 
function doSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $sourcedir;
	$smcFunc = array();

	$dumpvars = array('mbname', 'db_server', 'db_name', 'db_prefix', 'db_type', 'db_character_set', 'language', 
		'boardurl', 'boarddir', 'sourcedir', 'packagesdir', 'tasksdir', 'cachedir', 
		'maintenance', 'mtitle', 'mmessage',
		'cookiename', 'db_persist', 'db_error_send',
		'cache_accelerator', 'cache_enable', 'cache_memcached',
		'image_proxy_enabled', 'image_proxy_secret', 'image_proxy_maxsize');

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	$settings = array();
	$settings[0] = array('Settings.php Var','Value');
	foreach($dumpvars as $setting)
		$settings[] = array('$' . $setting, (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>'));

	dumpTable($settings);

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	return;
}

//*** get smcFunc db info
function doSmcFuncs() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $sourcedir;

	// Where the params at...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	require_once($sourcedir . '/DbExtra-' . $db_type . '.php');
	db_extra_init();

	$settings = array();
	$settings[0] = array('smcFunc','Value');

	$settings[] = array('db_title', $smcFunc['db_title']);
	$settings[] = array('db_get_version', isset($smcFunc['db_get_version']) ? $smcFunc['db_get_version']() : '<strong>Not defined</strong>');
	$settings[] = array('db_get_engine', isset($smcFunc['db_get_engine']) ? $smcFunc['db_get_engine']() : '<strong>Not defined</strong>');
	
	dumpTable($settings);

	return;
}

//*** Settings Table 
function doSettingsTable() {

	global $smcFunc, $db_type, $db_connection, $db_prefix;

	$settings = array();
	$settings[0] = array('Settings Table Var','Value');

	$dumpvars = array('knownThemes', 'theme_allow', 'theme_default', 'theme_guests', 'dont_repeat_theme_core');

	// get the whole table, why not...
	$result = $smcFunc['db_query']('', '
		SELECT variable, value FROM {db_prefix}settings;',
		array(
		)
	);

	// fetch_all would be nice, but...
	$allSettings = array();
	while ($row = $smcFunc['db_fetch_assoc']($result))
		$allSettings[] = $row;

	$smcFunc['db_free_result']($result);

	// case insensitive multi-dim sort
	usort($allSettings, 
		function ($a, $b) {
			return strcasecmp($a['variable'], $b['variable']);
		}
	);

	$settings += $allSettings;

	dumpTable($settings);

	return;
}

//*** Wrap Up 
function doWrapUp() {

	echo "<br>Completed!<br><br>";

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
}

//*** Strip quotes
function stripQuotes($string) {

	if (strlen($string) > 1 
	&& substr($string, 0, 1) == substr($string, strlen($string) - 1, 1) 
	&& in_array(substr($string, 0, 1), array('"', "'"))) {
		$string = substr($string, 1, strlen($string) - 2);
	}
	return $string;
}

//*** Dump Table
// Takes a simple 2 dimensional array & dumps it in table format
function dumpTable($passedArray) {
	echo '<br><table border="1" cellpadding="3" frame="border" rules="all">';
	foreach($passedArray as $row) {
		echo '<tr><td>';
		echo implode('</td><td>', $row);
		echo '</td></tr>';
	}
	echo '</table><br>';
	@ob_flush();
	@flush();	
	return;
}