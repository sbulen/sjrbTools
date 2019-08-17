<?php 
// A utility to identify and correct double-encoding errors in message bodies & subjects in the SMF messages table.
//
// This utility issues a SQL command that will fix most, if not all, of the issues.
// It is intended to be used when you believe many or all of your message bodies are suspect.
//
// If you still have problem data after running this utility, there is probably an issue with the data,
// for example, fixing the double-encoding may result in 4-byte sequences not supported by UTF8 MySQL,
// which only supports 3-byte UTF8 sequences.  ***Use smf_fix_dbl_enc_deep to attempt to address those.**
//
// This will help fix issues POST-UTF8 Conversion!  It is *not* to be used prior to UTF8 conversion.
// Also, make sure your $db_character_set in Settings.php is set to 'utf8', and your $db_type is 'mysql'.
//
// This is based upon the excellent input found here:
//      https://stackoverflow.com/questions/11436594/how-to-fix-double-encoded-utf8-characters-in-an-utf-8-table
//
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL ONLY *****
// ***** UTF8 ONLY *****
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

// Config section...
// *** None... ***
// End config section


//*** Main program
doStartup();
loadSettingsFile();
if (confirmReady())
	findFixUTF8Issues();
doWrapUp();
return;

//*** do Startup
function doStartup() {

	global $allTimer, $doit;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo('<br>**********************************************<br>');
	echo('*** Find & Fix UTF8 double-encoding issues - ALL ***<br>');
	echo('**********************************************<br><br>');

	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	define('SMF', 1);

	// Prime the pump...
	$allTimer = microtime(true);

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

//*** Fix 'em...
function findFixUTF8Issues() {

	global $smcFunc;

	// With STRICT mode on we get - no data truncation...
	// Note that if the conversion fails, it just puts the body/subject back as it was - no change.
	// The convoluted LENGTH logic below ensures the # of '?'s is unchanged by the update.
	$sql = 'UPDATE {db_prefix}messages
		SET body =
			CASE
				WHEN CONVERT(CAST(CONVERT(body USING latin1) AS BINARY) USING utf8) IS NULL THEN body
				WHEN (LENGTH(body) - LENGTH(REPLACE(body, \'?\', \'\'))) != (LENGTH(CONVERT(CAST(CONVERT(body USING latin1) AS BINARY) USING utf8)) - LENGTH(REPLACE(CONVERT(CAST(CONVERT(body USING latin1) AS BINARY) USING utf8), \'?\', \'\'))) THEN body
				ELSE CONVERT(CAST(CONVERT(body USING latin1) AS BINARY) USING utf8)
			END,
		subject =
			CASE
				WHEN CONVERT(CAST(CONVERT(subject USING latin1) AS BINARY) USING utf8) IS NULL THEN subject
				WHEN (LENGTH(subject) - LENGTH(REPLACE(subject, \'?\', \'\'))) != (LENGTH(CONVERT(CAST(CONVERT(subject USING latin1) AS BINARY) USING utf8)) - LENGTH(REPLACE(CONVERT(CAST(CONVERT(subject USING latin1) AS BINARY) USING utf8), \'?\', \'\'))) THEN subject
				ELSE CONVERT(CAST(CONVERT(subject USING latin1) AS BINARY) USING utf8)
			END';
	$result = $smcFunc['db_query']('', $sql,
		array(
		)
	);

	return;
}

//*** Wrap Up
function doWrapUp() {

	global $allTimer;

	echo '<br><br>Fixing double UTF8 encoding completed!<br>';

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