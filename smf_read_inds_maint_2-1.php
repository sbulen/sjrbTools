<?php 
//
// A utility to mark boards read in order to prune/maintain the log_topics table.
// This will also purge old entries in these tables, freeing space.  
//      log_boards
//      log_topics
//      log_mark_read
//
// This is done in two layers:
//    - a $MarkReadCutoff timeframe; in days; users who haven't logged on in a while just get all boards marked as read
//    - a $cleanupBeyond timeframe; in days; users who haven't logged on in a very long time get all read indicators deleted; 
//      as if they have never logged on
//
// This two-tier approach avoids storing lots of data for folks who haven't been around.  
// The next time they do logon everything will look unread, which is basically what it should look like...
//
// ***** SMF 2.1 *****
// ***** MySQL & Postgresql *****
// 
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Edit the Config section as appropriate.  Specify all parameters.  
// (5) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (6) Execute it from your browser.  Multiple executions will be necessary.
// (7) Delete it when you're done.
//     by sbulen
// 
// Config section...
// *** All of of these parameters must be specified! ***
// *** Note that $markReadCutoff must be <= $cleanupBeyond ***
$markReadCutoff = 90;
$cleanupBeyond = 365;
$maxMembers = 500;
// End config section


//*** Main program
doStartup();
loadSettingsFile();
pruneTables();
doWrapUp();
return;


//*** do Startup
function doStartup() {

	global $maxMembers, $markReadCutoff, $cleanupBeyond, $allTimer;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>***************************<br>");
	echo("*** Cleanup Read Indicators ***<br>");
	echo("***************************<br><br>");

	// Some sanity checks...
	if ($markReadCutoff > 18000)
		$markReadCutoff = 18000;
	if ($cleanupBeyond > 18000)
		$cleanupBeyond = 18000;

	echo("Mark Read cutoff: " . $markReadCutoff . "<br>");
	echo("Purge records cutoff: " . $cleanupBeyond . "<br>");
	echo("Max members: " . $maxMembers . "<br><br>");
	
	// Convert to timestamps for comparison
	$markReadCutoff = time() - $markReadCutoff * 86400;
	$cleanupBeyond = time() - $cleanupBeyond * 86400;

	// You're basically saying to just purge, so just purge
	if ($markReadCutoff < $cleanupBeyond)
		$markReadCutoff = $cleanupBeyond;

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

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc;
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

//*** Find the oldest members by last_login across all 3 tables...
function pruneTables() {

	global $smcFunc, $maxMembers, $markReadCutoff, $cleanupBeyond, $members;

	$members = array();

	// Find the oldest $maxMembers in log_boards, log_topics & log_mark_read
	$sql = 'SELECT lb.id_member, m.last_login
			FROM {db_prefix}members m
			INNER JOIN
			(
				SELECT DISTINCT id_member
				FROM {db_prefix}log_boards
			) lb ON lb.id_member = m.id_member
			WHERE m.last_login <= {int:dcutoff}
		UNION
		SELECT lmr.id_member, m.last_login
			FROM {db_prefix}members m
			INNER JOIN
			(
				SELECT DISTINCT id_member
				FROM {db_prefix}log_mark_read
			) lmr ON lmr.id_member = m.id_member
			WHERE m.last_login <= {int:dcutoff}
		UNION
		SELECT lt.id_member, m.last_login
			FROM {db_prefix}members m
			INNER JOIN
			(
				SELECT DISTINCT id_member
				FROM {db_prefix}log_topics
				WHERE unwatched = {int:unwatched}
			) lt ON lt.id_member = m.id_member
			WHERE m.last_login <= {int:mrcutoff}
		ORDER BY last_login
		LIMIT {int:limit}';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'limit' => $maxMembers,
			'dcutoff' => $cleanupBeyond,
			'mrcutoff' => $markReadCutoff,
			'unwatched' => 0,
		)
	);

	// Move to array...
	$members = $smcFunc['db_fetch_all']($result);
	$smcFunc['db_free_result']($result);

	// Nothing to do?
	if (empty($members))
		return;

	// Determine action based on last_login...
	$purgeMembers = array();
	$markReadMembers = array();
	
	foreach($members as $member)
	{
		if ($member['last_login'] <= $cleanupBeyond)
		{
			echo "Cleaning logs for: " . $member['id_member'] . " last login: " . date('Y-m-d H:i:s', $member['last_login']) . "<br>";
			$purgeMembers[] = $member['id_member'];
		}
		elseif ($member['last_login'] <= $markReadCutoff)
		{
			echo "Marking boards read for: " . $member['id_member'] . " last login: " . date('Y-m-d H:i:s', $member['last_login']) . "<br>";
			$markReadMembers[] = $member['id_member'];
		}
	}

	if (!empty($purgeMembers))
	{
		// Delete rows from log_boards
		$sql = 'DELETE FROM {db_prefix}log_boards
			WHERE id_member IN ({array_int:members})';
		$smcFunc['db_query']('', $sql,
			array(
				'members' => $purgeMembers,
			)
		);
		// Delete rows from log_mark_read
		$sql = 'DELETE FROM {db_prefix}log_mark_read
			WHERE id_member IN ({array_int:members})';
		$smcFunc['db_query']('', $sql,
			array(
				'members' => $purgeMembers,
			)
		);
		// Delete rows from log_topics
		$sql = 'DELETE FROM {db_prefix}log_topics
			WHERE id_member IN ({array_int:members})
				AND unwatched = {int:unwatched}';
		$smcFunc['db_query']('', $sql,
			array(
				'members' => $purgeMembers,
				'unwatched' => 0,
			)
		);
	}

	// Nothing left to do?
	if (empty($markReadMembers))
		return;

	// Find board inserts to perform...
	// Get board info for each member from log_topics.
	// Note this user may have read many topics on that board, 
	// but we just want one row each, & the ID of the last message read in each board.
	$boards = array();
	$sql = 'SELECT lt.id_member, t.id_board, MAX(lt.id_msg) AS id_last_message
		FROM {db_prefix}topics t
		INNER JOIN
		(
			SELECT id_member, id_topic, id_msg
			FROM {db_prefix}log_topics
			WHERE id_member IN ({array_int:members})
		) lt ON lt.id_topic = t.id_topic
		GROUP BY lt.id_member, t.id_board';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'members' => $markReadMembers,
		)
	);
	$boards = $smcFunc['db_fetch_all']($result);
	$smcFunc['db_free_result']($result);

	// Create one SQL statement for this set of inserts
	if (!empty($boards))
	{
		$smcFunc['db_insert']('replace',
			'{db_prefix}log_mark_read',
			array('id_member' => 'int', 'id_board' => 'int', 'id_msg' => 'int'),
			$boards,
			array('id_member', 'id_board')
		);
	}

	// Finally, delete this set's rows from log_topics
	$sql = 'DELETE FROM {db_prefix}log_topics
		WHERE id_member IN ({array_int:members})
			AND unwatched = {int:unwatched}';
	$smcFunc['db_query']('', $sql,
		array(
			'members' => $markReadMembers,
			'unwatched' => 0,
		)
	);

	return;
}

//*** Wrap Up
function doWrapUp() {

	global $allTimer;

	echo "Pruning of read indicators completed!<br>";

	echo "<br>Elapsed time: " . timer($allTimer) . "<br><br>";

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

	return ($H . ":" . $M . ":" . $S . ":" . $msec);
}

// Crap, intdiv is only php 7+
function intdiv_alt($a, $b){
    return ($a - $a % $b) / $b;
}