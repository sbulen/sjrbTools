<?php 
// 
// An SMF utility to dump theme information to help diagnose issues.
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
doSettingsTable();
dumpThemes();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>***********************************<br>");
	echo("******* SMF Theme diagnostic ********<br>");
	echo("***********************************<br>");

	define('SMF', 1);
	
	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Settings File 
function doSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc;
	$smcFunc = array();

	$dumpvars = array('mbname', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type', 'db_character_set', 'boardurl', 'boarddir', 'sourcedir');

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

//*** Settings Table 
function doSettingsTable() {

	global $smcFunc, $db_type, $db_connection, $db_prefix;

	$settings = array();
	$settings[0] = array('Settings Table Var','Value');

	$dumpvars = array('smfVersion', 'knownThemes', 'theme_allow', 'theme_default', 'theme_guests', 'dont_repeat_theme_core');

	foreach ($dumpvars as $setting) {
		$result = $smcFunc['db_query']('', '
			SELECT value FROM {db_prefix}settings
			 WHERE variable = {string:setting_var};',
			array(
				'setting_var' => $setting,
			)
		);
		$row = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
		$settings[] = array($setting, (!is_null($row[0]) ? $row[0] : '<strong>NOT SET</strong>'));
	}

	dumpTable($settings);

	return;
}

//*** Check Themes Table
function dumpThemes() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	// Figure out which themes have entries...
	$request = $smcFunc['db_query']('', '
		SELECT DISTINCT id_theme
		  FROM {db_prefix}themes;'
	 	);

	// Do each theme
	 while ($row = $smcFunc['db_fetch_assoc']($request))
	 		dumpOneTheme($row['id_theme']);

	$smcFunc['db_free_result']($request);

	return;
}

// For each id_theme found, dump key vars & a count of all other entries
function dumpOneTheme($theme) {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$dumpvars = array('name', 'theme_url', 'images_url', 'theme_dir', 'header_logo_url');

	$settings = array();
	$settings[0] = array('Theme ID', 'Variable', 'Value');

	// First dump each of the requested vars
	foreach ($dumpvars as $setting) {
		$result = $smcFunc['db_query']('', '
			SELECT value FROM {db_prefix}themes
			 WHERE variable = {string:setting_var}
			   and id_theme = {string:setting_theme};',
			array(
				'setting_var' => $setting,
				'setting_theme' => $theme,
			)
		);
		$row = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
		$settings[] = array($theme, $setting, (!is_null($row[0]) ? $row[0] : '<strong>NOT SET</strong>'));
	}

	// At least provide a count all the other entries
	$result = $smcFunc['db_query']('', '
		SELECT count(*) FROM {db_prefix}themes
		 WHERE variable NOT IN ({array_string:dump_vars})
		   and id_theme = {string:setting_theme};',
		array(
			'dump_vars' => $dumpvars,
			'setting_theme' => $theme,
		)
	);
	$row = $smcFunc['db_fetch_row']($result);
	$smcFunc['db_free_result']($result);
	$settings[] = array($theme, 'Count of other variables: ', $row[0]);

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