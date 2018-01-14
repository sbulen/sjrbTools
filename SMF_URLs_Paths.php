<?php 
//
// A utility to change all URL and directory settings in settings & themes tables.
// Does message bodies, personal messages, and member signatures as well.  
// 
// I use this utility to rapidly setup test environments, but with care, it can help with prod issues.
// It may even help with https: conversions.  
// 
// This utility does not update the Settings.php file, in fact it uses its contents to 
// connect to the DB.  I.e., run this *after* repair_settings.php to update all the other items
// (mod settings, links in posts) that repair_settings.php does not update.  
// 
// To be used *** with extreme caution *** post migration to rapidly get up & running. 
// 
// Flag "Doit" set to 'Yes' will do updates, otherwise it will only display what it would change.
// 
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL & Postgresql *****
// 
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Edit the Config section as appropriate.
// (5) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (6) Run in test mode - with $doit = 'no'.
// (7) Execute it from your browser.
// (8) When things look good, Execute it for real by changing $doit to 'Yes'.
// (9) Delete it when you're done.
//     by sbulen
// 
// Config section...
// Do not include a slash at end of Dirs or URLs
// No need to escape (add slashes) - this utility will do that later.
// 
$oldURL = 'http://your/old/url';
$newURL = 'http://your/new/url';
$oldDir = '/your/old/dir';
$newDir = 'C:\Program Files (x86)\your\new\dir';
$doit = 'No';	
// End config section

//*** Main program
doStartup();
loadSettingsFile();
doSettings();
doThemes();
doMessages();
doPMs();
doSignatures();
doWrapUp();
return;


//*** do Startup
function doStartup() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $oldURL, $newURL, $oldDir, $newDir, $doit;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>************************<br>");
	echo("*** Path & URL Updater ***<br>");
	echo("************************<br>");

	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	define('SMF', 1);
	
	return;
}

//*** Settings File 
function loadSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $oldURL, $newURL, $oldDir, $newDir, $doit;
	$smcFunc = array();

	$dumpvars = array('mbname', 'boardurl', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type');

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	$settings[] = array();
	$settings[0] = array('Settings.php Var','Value');
	foreach($dumpvars as $setting)
		$settings[] = array('$' . $setting, (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>'));
	
	dumpTable($settings);

	$settings = array();
	$settings[] = array('Old URL:', $oldURL);
	$settings[] = array('New URL:', $newURL);
	$settings[] = array('Old Dir:', $oldDir);
	$settings[] = array('New Dir:', $newDir);
	$settings[] = array('Do it:', $doit);

	dumpTable($settings);

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	return;
}

//*** Do settings
function doSettings() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $oldURL, $newURL, $oldDir, $newDir, $doit;

	$sql = "SELECT variable, value FROM " . $db_prefix . "settings;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result)) {
		if (stristr($row['value'], $oldURL)){
			$settings = array();
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $oldURL));
			$newval = str_ireplace($oldURL, $newURL, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $newURL));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newval = addslashes($newval);
				$sql = "UPDATE " . $db_prefix . "settings SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
		if (stristr($row['value'], $oldDir)){
			$settings = array();
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $oldDir));
			$newval = str_ireplace($oldDir, $newDir, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $newDir));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newval = addslashes($newval);
				$sql = "UPDATE " . $db_prefix . "settings SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}	
	return;
}

//*** Do themes
function doThemes() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $oldURL, $newURL, $oldDir, $newDir, $doit;

	$sql = "SELECT id_member, id_theme, variable, value FROM " . $db_prefix . "themes;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result)) {
		if (stristr($row['value'], $oldURL)){
			$settings = array();
			$settings[] = array('Member: ', $row['id_member']);
			$settings[] = array('Theme: ', $row['id_theme']);
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $oldURL));
			$newval = str_ireplace($oldURL, $newURL, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $newURL));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newval = addslashes($newval);
				$sql = "UPDATE " . $db_prefix . "themes SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable']
					. "' AND id_member = '" . $row['id_member']
					. "' AND id_theme = '" . $row['id_theme'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
		if (stristr($row['value'], $oldDir)){
			$settings = array();
			$settings[] = array('Member: ', $row['id_member']);
			$settings[] = array('Theme: ', $row['id_theme']);
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $oldDir));
			$newval = str_ireplace($oldDir, $newDir, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $newDir));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newval = addslashes($newval);
				$sql = "UPDATE " . $db_prefix . "themes SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable']
					. "' AND id_member = '" . $row['id_member']
					. "' AND id_theme = '" . $row['id_theme'] . "';";
				$smcFunc['db_query']('', $sql);
			}			
		}
	}
	return;
}

//*** Do messages
function doMessages() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $oldURL, $newURL, $oldDir, $newDir, $doit;

	$sql = "SELECT id_msg, subject, body FROM " . $db_prefix . "messages;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result)) {
		if (stristr($row['body'], $oldURL) || stristr($row['subject'], $oldURL)){
			$settings = array();
			$settings[] = array('Message: ', $row['id_msg']);

			$settings[] = array('Old subject: ', shortString($row['subject'], $oldURL));
			$newsubject = str_ireplace($oldURL, $newURL, $row['subject']);
			$settings[] = array('New subject: ', shortString($newsubject, $newURL));

			$settings[] = array('Old body: ', shortString($row['body'], $oldURL));
			$newbody = str_ireplace($oldURL, $newURL, $row['body']);
			$settings[] = array('New body: ', shortString($newbody, $newURL));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newsubject = addslashes($newsubject);
				$newbody = addslashes($newbody);
				$sql = "UPDATE " . $db_prefix . "messages SET subject = '" . $newsubject
				    . ", body = '" . $newbody
					. "' WHERE id_msg = '" . $row['id_msg'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	return;
}

//*** Do personal messages
function doPMs() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $oldURL, $newURL, $oldDir, $newDir, $doit;

	$sql = "SELECT id_pm, subject, body FROM " . $db_prefix . "personal_messages;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result)) {
		if (stristr($row['body'], $oldURL) || stristr($row['subject'], $oldURL)){
			$settings = array();
			$settings[] = array('PM: ', $row['id_pm']);

			$settings[] = array('Old subject: ', shortString($row['subject'], $oldURL));
			$newsubject = str_ireplace($oldURL, $newURL, $row['subject']);
			$settings[] = array('New subject: ', shortString($newsubject, $newURL));

			$settings[] = array('Old body: ', shortString($row['body'], $oldURL));
			$newbody = str_ireplace($oldURL, $newURL, $row['body']);
			$settings[] = array('New body: ', shortString($newbody, $newURL));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newsubject = addslashes($newsubject);
				$newbody = addslashes($newbody);
				$sql = "UPDATE " . $db_prefix . "personal_messages SET subject = '" . $newsubject
				    . "', body = '" . $newbody
					. "' WHERE id_pm = '" . $row['id_pm'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	return;
}

//*** Do signatures
function doSignatures() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $oldURL, $newURL, $oldDir, $newDir, $doit;

	$sql = "SELECT id_member, member_name, signature FROM " . $db_prefix . "members;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result)) {
		if (stristr($row['signature'], $oldURL)){
			$settings = array();
			$settings[] = array('Member: ', $row['id_member']);
			$settings[] = array('Name: ', $row['member_name']);
			$settings[] = array('Old Signature: ', shortString($row['signature'], $oldURL));
			$newval = str_ireplace($oldURL, $newURL, $row['signature']);
			$settings[] = array('New Signature: ', shortString($newval, $newURL));
			dumpTable($settings);

			if ($doit == 'Yes') {			
				$newval = addslashes($newval);
				$sql = "UPDATE " . $db_prefix . "members SET signature = '" . $newval
					. "' WHERE id_member = '" . $row['id_member'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}	
	return;
}

//*** Wrap Up
function doWrapUp() {

	echo "<br>Path & URL updates completed!<br><br>";

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	

	return;
}

//*** For display purposes, return only relevant portion of a string (first chars near 1st instance of search string)
function shortString($targetStr, $searchStr) {
	$maxlen = 160;
	$buffer = 20;
	if (strlen($targetStr) > $maxlen) {
		$strstart = stripos($targetStr, $searchStr);
		if ($strstart !== false && $strstart > $buffer) {
			$strstart = $strstart - $buffer;
		}
		else {
			$strstart = 0;
		}
		$targetStr = '... ' . substr($targetStr, $strstart, $maxlen - 8) . ' ...';
	}
	return $targetStr;
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