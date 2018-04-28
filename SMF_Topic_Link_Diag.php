<?php 
// 
// An SMF utility to identify quote links that may be damaged.
// This might happen in older versions of SMF after topics have been split or merged after messages were quoted.
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
checkMessages();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>********************************************<br>");
	echo("******* SMF Quote Topic Link diagnostic ********<br>");
	echo("********************************************<br>");

	define('SMF', 1);
	
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

	return;
}

//*** check ALL messages
function checkMessages() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$result = $smcFunc['db_query']('', '
		SELECT id_msg, body FROM {db_prefix}messages;',
		array(
		)
	);

	// Setup table for display
	global $updates;
	$updates = array();
	$updates[0] = array('Message ID', 'Broken Link', 'Note');

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

	// Format of the old link type
	// Matches [0] = whole match; [1] = author; [2] = topic; [3] = message [4] = date
	$pattern = '/\[quote\sauthor=([^\s]*?)\slink=topic=(\d{1,10})\.msg\d{1,10}#msg(\d{1,10})\sdate=(\d{1,15})\]/i';
	
	// Allow for multiple quotes in the same message
	preg_match_all($pattern, $message['body'], $matches);
	
	if (empty($matches[0]))
		return;
	
	foreach($matches[3] as $ix=>$msg) {
		// Pluck the message ID for the link from the match string
		$testmsgid = (int) $msg;
	
		// Get the message referenced in the link
		$result = $smcFunc['db_query']('', '
			SELECT id_topic FROM {db_prefix}messages
			 WHERE id_msg = {int:msgid};',
			array(
				'msgid' => $testmsgid,
			)
		);
		$referenced = $smcFunc['db_fetch_assoc']($result);

		// If you found the message...
		if 	(!empty($referenced)) {
			// And the topics don't match...
			if ($matches[2][$ix] != $referenced['id_topic']) {
				$updates[] = array($message['id_msg'], $matches[0][$ix], 'New topic: ' . $referenced['id_topic']);
			}
		}
		else {
			// Or maybe you didn't find the message...
			$updates[] = array($message['id_msg'], $matches[0][$ix], 'Message deleted');
		}

		$smcFunc['db_free_result']($result);
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