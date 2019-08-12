<?php 
// A utility to identify and correct double-encoding errors in message bodies & subjects in the SMF messages table.
// It is intended to be used when you may have a mix of good utf8 data and double-encoded utf8 data.
//
// This actually attempts a conversion, & will apply the updates only if it looks safe (no ????s).
// This utility also checks for 4-byte characters that have been double-encoded.  If found, they will 
// be converted to htmlentities.  This is necessary because MySQL's UTF8 charset doesn't support them.
//
// This will help fix issues POST-UTF8 Conversion!  It is *not* to be used prior to UTF8 conversion.  
// Also, make sure your $db_character_set in Settings.php is set to 'utf8', and your $db_type is 'mysql'.  
//
// This is based upon the excellent input found here:
//      https://stackoverflow.com/questions/11436594/how-to-fix-double-encoded-utf8-characters-in-an-utf-8-table
//
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL ONLY *****
// 
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (5) Execute it from your browser with $doit set to 'No'.
// (6) When happy with the preview, change the $doit parameter to 'Yes' & re-execute.
// (7) Delete it when you're done.
//     by sbulen
// 

// Config section...
// *** All parameters must be specified! ***
// Whether to make updates; 'Yes' makes updates, anything else doesn't.
$doit = 'No';
// For large tables, only process this many rows at a time.
// Program will loop & do the whole table, but only in chunks this size.
$atatime = 20000;
// End config section


//*** Main program
doStartup();
loadSettingsFile();
if (confirmReady())
	checkRecords();
doWrapUp();
return;

//*** do Startup
function doStartup() {

	global $allTimer, $doit;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo('<br>***********************************************<br>');
	echo('*** Find & Fix UTF8 double-encoding issues - DEEP ***<br>');
	echo('***********************************************<br><br>');

	define('SMF', 1);

	// Prime the pump...
	$allTimer = microtime(true);

	// Display parameter
	echo 'Execute updates? ' . $doit . '<br><br>';;
	
	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	return;
}

//*** Settings File 
function loadSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $db_character_set, $smcFunc;
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

	// Set STRICT mode - offers more protections against corrupting data; without STRICT mode, 
	// it may insert 'adjusted values', i.e., truncated data...  No bueno.  
	$mode = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
	mysqli_query($db_connection, 'SET SESSION sql_mode = \'' . $mode . '\'');

	return;
}

//*** Make sure they're ready...
function confirmReady() {

	global $db_character_set, $db_type, $smcFunc;

	// Check charset of body
	$result = $smcFunc['db_query']('', '
			SHOW FULL COLUMNS FROM {db_prefix}messages LIKE \'body\'',
			array(
			)
		);
	$attrs = $smcFunc['db_fetch_assoc']($result);
	$smcFunc['db_free_result']($result);

	$body_collation = $attrs['Collation'];
	list($body_charset) = explode('_', $body_collation);

	// Check charset of subject
	$result = $smcFunc['db_query']('', '
			SHOW FULL COLUMNS FROM {db_prefix}messages LIKE \'subject\'',
			array(
			)
		);
	$attrs = $smcFunc['db_fetch_assoc']($result);
	$smcFunc['db_free_result']($result);

	$subject_collation = $attrs['Collation'];
	list($subject_charset) = explode('_', $subject_collation);

	echo '$db_character_set: ' . $db_character_set . '<br>';
	echo '$db_type: ' . $db_type . '<br>';
	echo 'Collation for body: ' . $body_collation . '<br>';
	echo 'Charset for body: ' . $body_charset . '<br>';
	echo 'Collation for subject: ' . $subject_collation . '<br>';
	echo 'Charset for subject: ' . $subject_charset . '<br>';

	$goAhead = 'true';
	if ($db_character_set != 'utf8')
	{
		echo '*** Error!!!  $db_character_set not set properly!<br>';
		$goAhead = false;
	}
	if ($db_type != 'mysql')
	{
		echo '*** Error!!!  $db_type not mysql!<br>';
		$goAhead = false;
	}
	if (($body_charset != 'utf8') || ($subject_charset != 'utf8'))
	{
		echo '*** Error!!!  Charset not utf8!<br>';
		$goAhead = false;
	}

	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	return $goAhead;
}

//*** Process messages table in chunks...
function checkRecords() {

	global $smcFunc, $atatime, $doit, $db_prefix, $db_connection;

	// First things first, add the column body_1206.
	// Note this is even needed for the analysis.  
	$sql = 'ALTER TABLE {db_prefix}messages
		ADD COLUMN body_1206 MEDIUMBLOB NOT NULL,
		ADD COLUMN subject_1206 BLOB NOT NULL;';
	$result = $smcFunc['db_query']('', $sql,
		array(
		)
	);

	// How many are there...
	$sql = 'SELECT COUNT(*)
			FROM {db_prefix}messages';
	$result = $smcFunc['db_query']('', $sql,
		array(
		)
	);
	$count = $smcFunc['db_fetch_assoc']($result);
	$count = reset($count);

	$iterations = intval($count/$atatime);
	$i = 0;
	while ($i <= $iterations)
	{
	    echo '<br>About to do set ' . ($i + 1) . ' of ' . ($iterations + 1) . '...<br>';
		@ob_flush();
		@flush();	
		findFixUTF8Issues($i);
		$i++;
		if ($doit == 'Yes' && $i <= $iterations)
		{
			echo 'Pausing 5 sec to manage server load...';
			@ob_flush();
			@flush();
			sleep(5);
			echo 'done.<br>';
		}
	}

	// Delete the column...
	$sql = 'ALTER TABLE {db_prefix}messages
		DROP body_1206, 
		DROP subject_1206;';
	$result = $smcFunc['db_query']('', $sql,
		array(
		)
	);

	return;
}

//*** Find 'em and fix 'em...
function findFixUTF8Issues($call) {

	global $smcFunc, $doit, $atatime;

	// Find messages & IDs...
	$sql = 'SELECT id_msg, body, subject
			FROM {db_prefix}messages
			LIMIT {int:offset}, {int:limit}';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'offset' => $call * $atatime,
			'limit' => $atatime,
		)
	);

	// Move to array...
	$messages = array();
	while($row = $smcFunc['db_fetch_assoc']($result))
		$messages[$row['id_msg']] = array('body' => $row['body'], 'subject' => $row['subject']);
	$smcFunc['db_free_result']($result);

	$ids = array_keys($messages);

	// Use our technique to populate body_1206 & subject_1206
	$sql = 'UPDATE {db_prefix}messages
		SET body_1206 =
			CASE
				WHEN CONVERT(CAST(CONVERT(body USING latin1) AS BINARY) USING utf8mb4) IS NULL THEN body
				ELSE CONVERT(CAST(CONVERT(body USING latin1) AS BINARY) USING utf8mb4)
			END,
		subject_1206 =
			CASE
				WHEN CONVERT(CAST(CONVERT(subject USING latin1) AS BINARY) USING utf8mb4) IS NULL THEN subject
				ELSE CONVERT(CAST(CONVERT(subject USING latin1) AS BINARY) USING utf8mb4)
			END
		WHERE id_msg IN ({array_int:ids})';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'ids' => $ids,
		)
	);

	// Get info from newly created data...
	$sql = 'SELECT id_msg, body_1206, subject_1206
			FROM {db_prefix}messages
		WHERE id_msg IN ({array_int:ids})';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'ids' => $ids,
		)
	);

	// Move this one to an array...
	$messages2 = array();
	while($row = $smcFunc['db_fetch_assoc']($result))
		$messages2[$row['id_msg']] = array('body_1206' => $row['body_1206'], 'subject_1206' => $row['subject_1206']);
	$smcFunc['db_free_result']($result);

	// Look for 4-byte utf8 chars...
	static $badboys = '~[\x{010000}-\x{10FFFF}]~u';

	// Now let's inspect each...  
	$fixthese = array();
	foreach($messages AS $id => $message)
	{
		$fourbytes = false;

		// Check for 4-byte chars in body
		$matches = array();
		$pma = preg_match_all($badboys, $messages2[$id]['body_1206'], $matches);

		if ($pma > 0)
		{
			echo 'To fix body (Msg id - ' . $id . ') **4 bytes**: ' . bin2hex($matches[0][0]) . ', Number of others found: ' . count($matches[0]) . '<br>';

			// Html entity encoding for 4-byte; convert to codepoint
			$messages2[$id]['body_1206'] = preg_replace_callback($badboys, 
				function ($hex4) {
					$codepoint = ((ord($hex4[0][0]) & 0x07) << 18) | ((ord($hex4[0][1]) & 0x3F) << 12) | ((ord($hex4[0][2]) & 0x3F) << 6) | ((ord($hex4[0][3]) & 0x3F));
					return '&#' . $codepoint . ';';
				},
				$messages2[$id]['body_1206']
			);
			$fourbytes = true;
			@ob_flush();
			@flush();
		}

		// Check for 4-byte chars in subject
		$matches = array();
		$pma = preg_match_all($badboys, $messages2[$id]['subject_1206'], $matches);

		if ($pma > 0)
		{
			echo 'To fix subj (Msg id - ' . $id . ') **4 bytes**: ' . bin2hex($matches[0][0]) . ', Number of others found: ' . count($matches[0]) . '<br>';

			// Html entity encoding for 4-byte; convert to codepoint
			$messages2[$id]['subject_1206'] = preg_replace_callback($badboys, 
				function ($hex4) {
					$codepoint = ((ord($hex4[0][0]) & 0x07) << 18) | ((ord($hex4[0][1]) & 0x3F) << 12) | ((ord($hex4[0][2]) & 0x3F) << 6) | ((ord($hex4[0][3]) & 0x3F));
					return '&#' . $codepoint . ';';
				},
				$messages2[$id]['subject_1206']
			);
			$fourbytes = true;
			@ob_flush();
			@flush();
		}

		// Update temp columns if 4-byte chars found
		if ($fourbytes)
		{
			$sql = 'UPDATE {db_prefix}messages
				SET body_1206 = {string:newmsg},
					subject_1206 = {string:newsubj}
				WHERE id_msg = {int:id}';
			$result = $smcFunc['db_query']('', $sql,
				array(
					'id' => $id,
					'newmsg' => $messages2[$id]['body_1206'],
					'newsubj' => $messages2[$id]['subject_1206'],
				)
			);
		}

		// Look for '?'s...
		$oldbodyQs = substr_count($message['body'], '?');
		$newbodyQs = substr_count($messages2[$id]['body_1206'], '?');
		$oldsubjQs = substr_count($message['subject'], '?');
		$newsubjQs = substr_count($messages2[$id]['subject_1206'], '?');

		// Only use the output if the messages have changed, & we haven't substitued a bunch of ?s...
		if ((($message['body'] != $messages2[$id]['body_1206']) || ($message['subject'] != $messages2[$id]['subject_1206'])) && ($oldbodyQs == $newbodyQs) && ($oldsubjQs == $newsubjQs))
		{
			echo 'To fix mesg (Msg id - ' . $id . '): ' . htmlentities(substr($message['subject'], 0, 40)) . '<br>';
			$fixthese[] = $id;
			@ob_flush();
			@flush();
		}
	}

	// Do the updates...
	if (!empty($fixthese) && $doit == 'Yes')
	{
		$sql = 'UPDATE {db_prefix}messages
			SET body = body_1206,
				subject = subject_1206
			WHERE id_msg IN ({array_int:ids})';
		$result = $smcFunc['db_query']('', $sql,
			array(
				'ids' => $fixthese,
			)
		);
	}

	return;
}

//*** Wrap Up
function doWrapUp() {

	global $allTimer, $doit;

	if ($doit == 'Yes')
		echo '<br><br>Fixing UTF8 double encoding completed!<br>';
	else
		echo '<br><br>Checking for UTF8 double encoding completed!<br>';

	echo '<br>Elapsed time: ' . timer($allTimer) . '<br><br>';

	// Yes, both flushes necessary
	@ob_flush();
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

	return ($H . ':' . $M . ':' . $S . ':' . $msec);
}

// Crap, intdiv is only php 7+
function intdiv_alt($a, $b){
    return ($a - $a % $b) / $b;
}