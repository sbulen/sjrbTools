<?php 
// 
// An SMF utility to dump collation and charset information, to help diagnose issues with 
// UTF8 conversions.
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
if ($db_type == 'mysql')
	checkDB();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>***********************************<br>");
	echo("******** SMF UTF8 diagnostic ********<br>");
	echo("***********************************<br>");

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

	$dumpvars = array('mbname', 'boardurl', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type', 'db_character_set');

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

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

	$settings[0] = array('Settings Table Var','Value');

	$dumpvars = array('smfVersion', 'global_character_set', 'langList');

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

//*** Check DB 
function checkDB() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	// mysql or postgresql
	if ($db_type == 'mysql') {
		$schema_columns = 'SCHEMA_NAME, DEFAULT_CHARACTER_SET_NAME, DEFAULT_COLLATION_NAME';
		$schema_header = array('SCHEMA_NAME', 'DEFAULT_CHARACTER_SET_NAME', 'DEFAULT_COLLATION_NAME');
		$tbl_columns = 'TABLE_SCHEMA, TABLE_NAME, ENGINE, TABLE_COLLATION';
		$tbl_header = array('TABLE_SCHEMA', 'TABLE_NAME', 'ENGINE', 'TABLE_COLLATION');
		$col_columns = 'TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, CHARACTER_OCTET_LENGTH, CHARACTER_SET_NAME, COLLATION_NAME';
		$col_header = array('TABLE_SCHEMA', 'TABLE_NAME', 'COLUMN_NAME', 'DATA_TYPE', 'CHARACTER_MAXIMUM_LENGTH', 'CHARACTER_OCTET_LENGTH', 'CHARACTER_SET_NAME', 'COLLATION_NAME');
	} 
	else {
		$schema_columns = 'schema_name, default_character_set_name';
		$schema_header = array('schema_name', 'default_character_set_name');
		$tbl_columns = 'table_schema, table_name';
		$tbl_header = array('table_schema', 'table_name');
		$col_columns = 'table_schema, table_name, column_name, data_type, character_maximum_length, character_octet_length, character_set_name, collation_name';
		$col_header = array('table_schema', 'table_name', 'column_name', 'data_type', 'character_maximum_length', 'character_octet_length', 'character_set_name', 'collation_name');
	}
	
	// Dump schema-level info...
	$settings = array();
	$settings[0] = $schema_header;

	$result = $smcFunc['db_query']('', '
		SELECT ' . $schema_columns . '
		  FROM INFORMATION_SCHEMA.SCHEMATA
		 WHERE SCHEMA_NAME = "' . $db_name . '";'
	);
	while ($row = $smcFunc['db_fetch_assoc']($result))
		$settings[] = $row;
	$smcFunc['db_free_result']($result);

	dumpTable($settings);

	// Dump table info...
	$settings = array();
	$settings[0] = $tbl_header;

	$result = $smcFunc['db_query']('', '
		SELECT ' . $tbl_columns . '
		  FROM INFORMATION_SCHEMA.TABLES
		 WHERE TABLE_SCHEMA = "' . $db_name . '";'
	);
	while ($row = $smcFunc['db_fetch_assoc']($result))
		$settings[] = $row;
	$smcFunc['db_free_result']($result);

	dumpTable($settings);

	// Dump column info...
	$settings = array();
	$settings[0] = $col_header;
	
	$result = $smcFunc['db_query']('', '
		SELECT ' . $col_columns . '
		  FROM INFORMATION_SCHEMA.COLUMNS
		 WHERE TABLE_SCHEMA = "' . $db_name . '";'
	);
	while ($row = $smcFunc['db_fetch_assoc']($result))
		if (strpos($row['DATA_TYPE'], 'text') !== false || strpos($row['DATA_TYPE'], 'char') !== false)
			$settings[] = $row;
	$smcFunc['db_free_result']($result);

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