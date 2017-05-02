<?php 
// 
// A utility to convert all tables that match your smf db prefix to InnoDB
//   *** SMF 2.0 & 2.1 ***
//   *** MySQL v5.5+ only ***
//
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (5) Execute it from your browser.
// (6) Delete it when you're done.
//     by sbulen
// 

//*** Main program
doStartup();
doSettingsFile();
doInnoDB();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>**********************<br>");
	echo("*** InnoDB Converter ***<br>");
	echo("**********************<br><br>");

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
	$db_connection = mysqli_connect($db_server, $db_user, $db_passwd, $db_name);

	return;
}

//*** do the conversion
function doInnoDB() {

	global $db_connection, $db_prefix;

	// Do them tables
	$sql = "SHOW TABLES LIKE '" . $db_prefix . "%'";
	$result = mysqli_query($db_connection, $sql);
	while($table = mysqli_fetch_assoc($result)) {
		foreach ($table as $value) {
			$result2 = mysqli_query($db_connection, "SHOW CREATE TABLE " . $value);
			$createstuff = mysqli_fetch_row($result2); 
			if (!strpos($createstuff[1], 'ENGINE=InnoDB')) {
				echo(" Working on table: " . $value . "...   ");
				@ob_flush();
				@flush();
				mysqli_query($db_connection, "ALTER TABLE $value ENGINE=InnoDB;");
				echo("Result: " . mysqli_errno($db_connection) . " " . mysqli_error($db_connection) . "<br>");
				@ob_flush();
				@flush();
			}
			else { 
				echo(" Bypassing table - Already InnoDB: " . $value . "<br>");
				@ob_flush();
				@flush();
			}
		}		
	}
}

//*** Wrap Up 
function doWrapUp() {

	echo "<br>Your tables have been converted to InnoDB!<br><br>";

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
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