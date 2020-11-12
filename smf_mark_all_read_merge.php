<?php 
//
// Mark all NEW boards (from secondary) read for OLD users...
// So their "unread posts" aren't flooded with old stuff...
//
// *** Only needed when the SECONDARY forum has old posts you don't want to look new... ***
// *** Only needed when the SECONDARY forum has old posts you don't want to look new... ***
// *** Only needed when the SECONDARY forum has old posts you don't want to look new... ***
//
// Run against primary after merge...
//
// **** These figures MUST BE UPDATED BASED ON PRE-MERGE PRIMARY... ****
// **** These figures MUST BE UPDATED BASED ON PRE-MERGE PRIMARY... ****
// **** These figures MUST BE UPDATED BASED ON PRE-MERGE PRIMARY... ****
//
// Max id_board from old primary - so we know what was newly added
$old_board_max = 346;
// Max id_member from old primary - will have newly-added secondary boards marked as read
$old_user_max = 34444;

//*** Main program
doStartup();
loadSettings();
doIt();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	global $rundir, $fp, $url, $board;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>*******************************<br>");
	echo("**** Mark Everything Read.... ****<br>");
	echo("*******************************<br>");

	define('SMF', 1);

	@ini_set('memory_limit', '512M');

	@flush();

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	return;
}

//*** Settings File 
function loadSettings() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $boardurl, $sourcedir, $cachedir, $modSettings;
	global $cache_accelerator, $cache_enable, $cacheAPI;

	$smcFunc = array();

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);
	if (empty($db_connection))
		echo 'Failed to connect ERROR ' . mysqli_errno($db_connection) . ': ' . mysqli_error($db_connection) . '<br>';

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

//*** Do it...
function doIt() {

	global $db_connection, $db_prefix;
	global $old_user_max, $old_board_max;

	// Narrow this to recently active users.
	// This requires a cross product of users & boards - which can easily turn into 100s of Ks - if not millions - of recs.
	// So narrow it down to active folks...
	$six_months_ago = time() - 6*31*24*60*60;
	echo 'Six months ago: ' . $six_months_ago . '<br>';

	// Get all old user ids...
	$users = array();
	$sql = "SELECT id_member FROM {$db_prefix}members WHERE id_member <= {$old_user_max} 
		AND is_activated = '1' AND last_login > {$six_months_ago}";
	$query = mysqli_query($db_connection, $sql);
	if ($query === false)
		echo 'Failed getting old users ERROR ' . mysqli_errno($db_connection) . ': ' . mysqli_error($db_connection) . '<br>';
	while($row = mysqli_fetch_assoc($query))
		$users[] = $row['id_member'];
	mysqli_free_result($query);
	echo 'Primary system users active within the last 6 months: ' . count($users) . '<br>';

	// Get all new boards...
	$boards = array();
	$sql = "SELECT id_board FROM {$db_prefix}boards where id_board > {$old_board_max}";
	$query = mysqli_query($db_connection, $sql);
	if ($query === false)
		echo 'Failed getting new boards ERROR ' . mysqli_errno($db_connection) . ': ' . mysqli_error($db_connection) . '<br>';
	while($row = mysqli_fetch_assoc($query))
		$boards[] = $row['id_board'];
	mysqli_free_result($query);
	echo 'Boards migrated from secondary: ' . count($boards) . '<br>';

	// Get max msg #...
	$sql = "SELECT MAX(id_msg) FROM {$db_prefix}messages";
	$query = mysqli_query($db_connection, $sql);
	if ($query === false)
		echo 'Failed getting new max msg id ERROR ' . mysqli_errno($db_connection) . ': ' . mysqli_error($db_connection) . '<br>';
	$maxmsg = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);
	echo 'Max msg id: ' . $maxmsg . '<br>';

	// Build table of inserts...
	$inserts = array();
	foreach($boards AS $board)
		foreach($users AS $user)
			$inserts[] = "({$user}, {$board}, {$maxmsg})";
	echo 'Rows to insert: ' . count($inserts) . '<br>';

	// Insert 'em...
	$sql = "INSERT INTO {$db_prefix}log_mark_read (id_member, id_board, id_msg) VALUES " . implode(', ', $inserts);
	$query = mysqli_query($db_connection, $sql);
	if ($query === false)
		echo 'Failed inserting log_mark_read ERROR ' . mysqli_errno($db_connection) . ': ' . mysqli_error($db_connection) . '<br>';
	echo 'Rows inserted: ' . $db_connection->affected_rows . '<br>';

	return;
}

//*** Wrap Up 
function doWrapUp() {

	echo "<br>Completed!<br><br>";
	echo '</pre>';

	@flush();
	return;
}

?>