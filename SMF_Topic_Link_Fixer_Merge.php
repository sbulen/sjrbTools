<?php 
// 
// An SMF utility to identify and FIX quote links that may be damaged.
// This might happen in older versions of SMF after topics have been split or merged after messages were quoted.
// *** SPECIAL VERSION FOR RECENTLY MERGED FORUMS ***
//
// ***** SMF 2.0 *****
// ***** MySQL & Postgresql *****
//
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (5) UPDATE the 3 values in the user config section below
// (6) Execute it from your browser.
// (7) Delete it when you're done.
//     by sbulen
// 
// ***** VERY IMPORTANT TO UPDATE THESE THREE VALUES!!! *****
// ***** VERY IMPORTANT TO UPDATE THESE THREE VALUES!!! *****
// ***** VERY IMPORTANT TO UPDATE THESE THREE VALUES!!! *****
//
// Min & max #s of the recently added messages from the old secondary forum - messages to be checked
$msg_min = 212950;
$msg_max = 230217;
// The amount the secondary forum's messages were incremented (max id_msg from old primary)
$msg_inc = 212948;

//*** Main program
doStartup();
doSettingsFile();
checkMessages();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>*****************************************************<br>");
	echo("******* SMF Quote Topic Link Fixer MERGE VERSION *******<br>");
	echo("*****************************************************<br>");

	define('SMF', 1);
	define('POSTGRE_TITLE', 'PostgreSQL');
	define('MYSQL_TITLE', 'MySQL');

	@ini_set('memory_limit', '512M');

	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Settings File 
function doSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $boardurl;
	$smcFunc = array();

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	// Set the charset
	if ($db_type == 'mysql' && !empty($db_character_set))
		mysqli_set_charset($db_connection, $db_character_set);

	// Most database systems have not set UTF-8 as their default input charset.
	if (!empty($db_character_set))
		$smcFunc['db_query']('', '
			SET NAMES {string:db_character_set}',
			array(
				'db_character_set' => $db_character_set,
			)
		);

	return;
}

//*** check ALL messages
function checkMessages() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;
	global $msg_min, $msg_max;

	$result = $smcFunc['db_query']('', '
		SELECT id_msg, body FROM {db_prefix}messages
		WHERE id_msg >= ' . $msg_min . ' AND id_msg <= ' . $msg_max . ';',
		array(
		)
	);

	// Setup table for display
	global $updates;
	$updates = array();
	$updates[0] = array('Message ID', 'Broken Link', 'Note', 'New Link');

	// Check each...
	while ($message = $smcFunc['db_fetch_assoc']($result))
		checkMessage($message);
	
	$smcFunc['db_free_result']($result);

	dumpTable($updates);
	
	return;
}

//*** check ONE message
function checkMessage($message) {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $updates;
	global $msg_inc;

	// Format of the old link type
	// Matches [0] = whole match; [1] = author; [2] = topic; [3] = message [4] = date
	$pattern = '/\[quote\sauthor=([^\s]*?)\slink=topic=(\d{1,10})\.msg\d{1,10}#msg(\d{1,10})\sdate=(\d{1,15})\]/i';
	
	// Allow for multiple quotes in the same message
	preg_match_all($pattern, $message['body'], $matches);
	
	if (empty($matches[0]))
		return;
	
	$updateneeded = false;
	
	foreach($matches[3] as $ix => $msg) {
		// Pluck the message ID for the link from the match string
		$testmsgid = (int) $msg + $msg_inc;
	
		// Get the message referenced in the link
		$result = $smcFunc['db_query']('', '
			SELECT id_topic FROM {db_prefix}messages
			 WHERE id_msg = {int:msgid};',
			array(
				'msgid' => $testmsgid,
			)
		);
		$referenced = $smcFunc['db_fetch_assoc']($result);
		$smcFunc['db_free_result']($result);

		// If you found the message...
		$newlink = '';
		if 	(!empty($referenced)) {
			// And the topics don't match...
			if ($matches[2][$ix] != $referenced['id_topic']) {
				$newlink = '[quote author= ' . $matches[1][$ix] . ' link=topic=' . $referenced['id_topic'] . '.msg' . $testmsgid . '#msg' . $testmsgid . ' date=' . $matches[4][$ix] . ']';
				$updates[] = array($message['id_msg'], $matches[0][$ix], 'New topic: ' . $referenced['id_topic'], $newlink);
			}
		}
		else {
			// Or maybe you didn't find the message...
			$newlink = '[quote author= ' . $matches[1][$ix] . ']';
			$updates[] = array($message['id_msg'], $matches[0][$ix], 'Message deleted', $newlink);
		}

		// Update the message body...
		if (!empty($newlink)) {
			$message['body'] = str_replace($matches[0][$ix], $newlink, $message['body']);
			$updateneeded = true;
		}
	}

	// Update DB with new message body
	if ($updateneeded) {
		$result = $smcFunc['db_query']('', '
			UPDATE {db_prefix}messages
			   SET body = {string:newbody}
			 WHERE id_msg = {int:msgid};',
			array(
				'newbody' => $message['body'],
				'msgid' => $message['id_msg'],
			)
		);
	}
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