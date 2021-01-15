<?php 
//
// A utility to remove old BBC tags from message bodies.
// The tag must be specified in a regex provdied by the user.
// 
// Flag "doit" set to 'Yes' will do updates, otherwise it will only display what it would change.
// 
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL & Postgresql *****
// 
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Edit the Config section as appropriate.  Specify all 5 parameters.  
// (5) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (6) Run in test mode - with $doit = 'no'.
// (7) Execute it from your browser.
// (8) When things look good, Execute it for real by changing $doit to 'Yes'.
// (9) Delete it when you're done.
//     by sbulen
// 
// Config section...
// *** All of of these parameters must be specified! ***
// *** The FULL match will be replaced by the first captured group,
// *** i.e., $matches[0] will be replaced with $matches[1]...
$pattern = '~(?>\[member=\d{1,10}\]([^\[]*)\[/member\])~i';
$doit = 'No';
// End config section

//*** Main program
doStartup();
loadSettingsFile();
doMessages();
doWrapUp();
return;


//*** do Startup
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>*************************<br>");
	echo("*** SMF old bbc remover ***<br>");
	echo("*************************<br>");

	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	define('SMF', 1);
	define('POSTGRE_TITLE', 'PostgreSQL');
	define('MYSQL_TITLE', 'MySQL');

	@ini_set('memory_limit', '512M');

	return;
}

//*** Settings File 
function loadSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $pattern, $doit;
	$smcFunc = array();

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	// Most database systems have not set UTF-8 as their default input charset.
	if (!empty($db_character_set))
		$smcFunc['db_query']('', '
			SET NAMES {string:db_character_set}',
			array(
				'db_character_set' => $db_character_set,
			)
		);

	// Get global_character_set
	$result = $smcFunc['db_query']('', '
		SELECT value FROM {db_prefix}settings WHERE variable = {string:global_character_set};',
		array(
			'global_character_set' => 'global_character_set',
		)
	);
	list($global_character_set) = $smcFunc['db_fetch_row']($result);

	if (!empty($global_character_set_))
		mb_internal_encoding($global_character_set);
	else
		// Assume default of latin1, esp for 2.0
		mb_internal_encoding("ISO-8859-1");

	// Show all the settings
	$settings[] = array();
	$settings[0] = array('Settings.php Var','Value');
	$dumpvars = array('mbname', 'boardurl', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type', 'db_character_set', 'global_character_set');
	foreach($dumpvars as $setting)
		$settings[] = array('$' . $setting, (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>'));
	
	dumpTable($settings);

	$settings = array();
	$settings[] = array('Pattern:', $pattern);
	$settings[] = array('Do it:', $doit);

	dumpTable($settings);

	return;
}

//*** Do messages
function doMessages() {

	global $smcFunc, $db_prefix, $pattern, $doit;

	$sql = "SELECT id_msg, body FROM " . $db_prefix . "messages;";
	$result = $smcFunc['db_query']('', $sql);
	$matches = array();

	while($row = $smcFunc['db_fetch_assoc']($result)) {
		$hits = preg_match_all($pattern, $row['body'], $matches);
		if (!empty($hits)) {
			$settings = array();
			$settings[] = array('Message: ', $row['id_msg']);
			$newbody = $row['body'];
			foreach ($matches[0] AS $ix => $match) {
				$newbody = str_ireplace($matches[0][$ix], $matches[1][$ix], $newbody);
				$settings[] = array('Old text: ', $matches[0][$ix], 'New text: ', $matches[1][$ix]);

				if ($doit == 'Yes') {
					$newbody = addslashes($newbody);
					$sql = "UPDATE " . $db_prefix . "messages SET body = '" . $newbody
						. "' WHERE id_msg = '" . $row['id_msg'] . "';";
					$smcFunc['db_query']('', $sql);
				}
			}
			dumpTable($settings);
		}
	}
	$smcFunc['db_free_result']($result);
	return;
}

//*** Wrap Up
function doWrapUp() {

	echo "<br>Removing old bbcs completed!<br><br>";

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