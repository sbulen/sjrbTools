<?php
/*
v2.0.17

Original version for SMF 1.0.x by Oldiesmann at SimpleMachines dot org
Many thanks for throwing it together and giving us something to work with.
Modified version for SMF 1.1RC3 by Resourcez at resourcez dot biz (way back in 2006)
Modified version for SMF 2.0.6 by bfeist (fall, 2013). Let's call this new version 2.0.
Modified version for SMF 2.0.17 to add several new record types, use mysqli, enhance error reporting, address column conflicts.  shawnb61, Sept, 2020

Description:
This script will merge two SMF forums. It will takes the boards, topics, members, messages, etc from a SECONDARY forum and merge them into a PRIMARY forum.
You need to be comfortable with PHP, and wrapping your head around databases etc to use this script. It works, but it will take some trial and error to get everything right.

Instructions:
1. Restore your two forums and get them working side-by-side on your site, both installations within the same database (just use a different database prefix like smf2_ for the SECONDARY one prior to the DB restore).
2. Edit this file in a text editor and change the prefix to match the database prefix of the PRIMARY smf board (define('PRIMARY_DB_PREFIX', 'smf_') - change smf_ to whatever you used...).
3. Also set $secondary_suffix to be the value appended to the end of member names & group names & other records in order to make them unique, in case of conflicts with the primary forum.
4. Save this modified file, put it in the directory for the SECONDARY smf installation and run it (just like you would run install.php or the converter).
5. Follow the instructions, clicking the "Continue" link as needed.
6. Pay careful attention to any errors reported.
7. When completed, copy all files in your SECONDARY attachments/to_move_to_primary directory to the primary attachments directory.
8. Copy all files in your SECONDARY custom_avatar/to_move_to_primary directory to the primary custom_avatar directory.  Be careful to confirm the name of the directory, it is different for different forums.
9. Copy all files in your SECONDARY avatars directory to the primary avatars directory.
10. Once you're done, if everything worked, login to your PRIMARY SMF board, go to Admin -> Forum Maintenance and click on "Recount all totals and statistics" - this will update everything for you.
11. Check for any members in the new (merged) PRIMARY SMF installation that end with your $secondary_suffix. If desired, these members can be merged with the members of the same name using a tool like SMF Admin Toolbox (http://www.simplemachines.org/community/index.php?topic=470463.0)
12. Carefully audit all board permissions, membergroups, and subscriptions.
*/

// *** User configs - important! ***
define('PRIMARY_DB_PREFIX', 'smf_');
$secondary_suffix = '-fgn';
// *** End of user configs ***

include_once('Settings.php');
$db_connection = @mysqli_connect($db_server, $db_user, $db_passwd, $db_name);
@mysqli_select_db($db_name, $db_connection);
if (!empty($db_character_set))
	mysqli_query($db_connection, "SET NAMES {$db_character_set}");

// Might as well try...
@set_time_limit(6000);

function head()
{
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>SMF Board Merger</title>
<style type="text/css">
	body {font-family: Verdana, sans-serif;	background-color: #D4D4D4; margin: 0; }
	div#header {background-color: white; padding: 12px 4% 12px 4%; font-family: Georgia, serif; font-size: xx-large; border-bottom: 1px solid black; height: 60px; text-align:center; }
	div#content {margin: 20px 30px;	}
</style>
<body>
<div id="header" title="Resourcez">
	<div>SMF Board Merger</div>
	<div style="font-size:14px;font-weight:bold;">(You should be running this script on your SECONDARY site - the one you wish to copy content from)</div>
</div>
<div id="content">';
}

function foot()
{
echo '</div></body></html>';
}

/*****************************************************************
 *
 * This table drives all the action...
 *
 * <Tables> acted upon, the "driver" tables
 *    incby = rec key value which all related tables/fields must be incremented by (from primary)
 *    rels = list of related records to update
 *       <tables> => array of fields to be updated by the value of incby
 *    nzrels = list of related records to update - ***but only if the field is non-zero***
 *       <tables> => array of fields to be updated by the value of incby
 *    userfunc = user-defined callback for any special logic
 *
 *****************************************************************/

$tables = array(
	'boards' => array (
		'incby' => 'id_board',
		'rels' => array(
			'boards' => array('id_board', 'board_order'),
			'messages' => array('id_board'),
			'moderators' => array('id_board'),
			'topics' => array('id_board'),
			'log_reported' => array('id_board'),
		),
		'nzrels' => array(
			'boards' => array('id_parent'),
			'log_actions' => array('id_board'),
			'log_notify' => array('id_board'),
		),
	),
	'categories' => array (
		'incby' => 'id_cat',
		'rels' => array(
			'categories' => array('id_cat', 'cat_order'),
			'boards' => array('id_cat'),
		),
	),
	'messages' => array (
		'incby' => 'id_msg',
		'rels' => array(
			'messages' => array('id_msg'),
			'topics' => array('id_first_msg', 'id_last_msg'),
			'log_reported' => array('id_msg'),
		),
		'nzrels' => array(
			'boards' => array('id_last_msg'),
			'log_actions' => array('id_msg'),
			'attachments' => array('id_msg'),
		),
	),
	'attachments' => array (
		'incby' => 'id_attach',
		'rels' => array(
			'attachments' => array('id_attach'),
		),
		'nzrels' => array(
			'attachments' => array('id_thumb'),
		),
		'userfunc' => 'renameattachments',
	),
	'members' => array (
		'incby' => 'id_member',
		'rels' => array(
			'members' => array('id_member'),
			'pm_recipients' => array('id_member'),
			'log_notify' => array('id_member'),
			'messages' => array('id_member'),
			'polls' => array('id_member'),
			'group_moderators' => array('id_member'),
			'moderators' => array('id_member'),
			'log_subscribed' => array('id_member'),
			'log_reported' => array('id_member'),
			'log_reported_comments' => array('id_member'),
		),
		'nzrels' => array(
			'personal_messages' => array('id_member_from'),
			'log_actions' => array('id_member'),
			'log_polls' => array('id_member'),
			'topics' => array('id_member_started', 'id_member_updated'),
			'attachments' => array('id_member'),
			'ban_items' => array('id_member'),
		),
		'userfunc' => 'renamemembers',
	),
	'personal_messages' => array (
		'incby' => 'id_pm',
		'rels' => array(
			'personal_messages' => array('id_pm', 'id_pm_head'),
			'pm_recipients' => array('id_pm'),
		),
	),
	'polls' => array (
		'incby' => 'id_poll',
		'rels' => array(
			'polls' => array('id_poll'),
			'log_polls' => array('id_poll'),
			'poll_choices' => array('id_poll'),
		),
		'nzrels' => array(
			'topics' => array('id_poll'),
		),
	),
	'poll_choices' => array (
		'incby' => 'id_choice',
		'rels' => array(
			'poll_choices' => array('id_choice'),
			'log_polls' => array('id_choice'),
		),
	),
	'topics' => array (
		'incby' => 'id_topic',
		'rels' => array(
			'topics' => array('id_topic'),
			'messages' => array('id_topic'),
			'log_reported' => array('id_topic'),
		),
		'nzrels' => array(
			'log_actions' => array('id_topic'),
			'log_notify' => array('id_topic'),
		),
	),
	'log_actions' => array (
		'incby' => 'id_action',
		'rels' => array(
			'log_actions' => array('id_action'),
		),
		'userfunc' => 'serial_strings',
	),
	'membergroups' => array (
		'incby' => 'id_group',
		'rels' => array(
			'membergroups' => array('id_group'),
		),
		'nzrels' => array(
			'members' => array('id_group'),
			'group_moderators' => array('id_group'),
			'board_permissions' => array('id_group'),
			'permissions' => array('id_group'),
			'membergroups' => array('id_parent'),
			'log_subscribed' => array('old_id_group'),
		),
		'userfunc' => 'cleanrenamegroups',
	),
	'permission_profiles' => array (
		'userfunc' => 'processprofiles',
	),
	'subscriptions' => array (
		'incby' => 'id_subscribe',
		'rels' => array(
			'subscriptions' => array('id_subscribe'),
			'log_subscribed' => array('id_subscribe'),
		),
	),
	'log_subscribed' => array (
		'incby' => 'id_sublog',
		'rels' => array(
			'log_subscribed' => array('id_sublog'),
		),
	),
	'log_reported' => array (
		'incby' => 'id_report',
		'rels' => array(
			'log_reported' => array('id_report'),
			'log_reported_comments' => array('id_report'),
		),
	),
	'log_reported_comments' => array (
		'incby' => 'id_comment',
		'rels' => array(
			'log_reported_comments' => array('id_comment'),
		),
	),
	'ban_groups' => array (
		'incby' => 'id_ban_group',
		'rels' => array(
			'ban_groups' => array('id_ban_group'),
			'ban_items' => array('id_ban_group'),
		),
	),
	'ban_items' => array (
		'incby' => 'id_ban',
		'rels' => array(
			'ban_items' => array('id_ban'),
		),
	),
	// These records don't drive updates to other related records.
	// They only get copied over once updated themselves.
	'board_permissions' => array(),
	'group_moderators' => array(),
	'moderators' => array(),
	'permissions' => array(),
	'log_notify' => array(),
	'log_polls' => array(),
	'pm_recipients' => array(),
);

/****************************
 * This is the main program
 ****************************/

if(!isset($_REQUEST['step']))
{
	// Check this Secondary Prefix is different...
	if ($db_prefix == PRIMARY_DB_PREFIX)
	{
		head();
		echo 'You are on the wrong installation,<br />Or the prefix you set in this file is wrong.<br /><br /><a href="'.$_SERVER['PHP_SELF'].'">Please remedy and start again.</a>';
		foot();
	}
	else
	{
		call_user_func('dostep0');
	}
}
else
{
	call_user_func('dostep' . $_REQUEST['step']);
}

function dostep0()
{
	head();

	echo 'You are on the right installation. Let\'s start.<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=1">Start</a></center>';
	foot();
}

// Update board and category IDs
function dostep1()
{
	head();

	echo 'Updating category IDs...<br>';
	dotable('categories');

	echo '<br>Updating board IDs...<br>';
	dotable('boards');

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=2">Continue Step 2</a></center>';
	foot();
}

// Update messages
function dostep2()
{
	head();

	echo 'Updating message IDs for boards, topics, attachments and messages...<br>';
	dotable('messages');

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=3">Continue Step 3</a></center>';
	foot();
}


// Update attachments filenames based on new attachment IDs
// Also, move all SECONDARY attachments (renamed using new attachment IDs) to a to_move_to_primary subfolder in the SECONDARY attachments directory
function dostep3()
{
	head();

	dotable('attachments');

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=4">Continue Step 4</a></center>';
	foot();
}

// Rename attachments
function renameattachments()
{
	global $db_prefix;

	echo 'Renaming & copying attachments and thumbs...<br>';

	// Get the attachments directory...
	echo 'Getting attachment upload dir';
	$sql = "SELECT value FROM {$db_prefix}settings WHERE variable = 'attachmentUploadDir' LIMIT 1";
	$result = call_mysqli_query($sql, false);
	list ($attachmentUploadDir) = mysqli_fetch_row($result);
	mysqli_free_result($result);
	echo '...done<br>';

	// Make temporary attachments directory...
	$attachmentTempDir = $attachmentUploadDir . '/to_move_to_primary/';
	echo 'Creating to_move_to_primary attachments directory ' . $attachmentTempDir;
	@mkdir($attachmentTempDir, 0755);
	echo '...done<br>';

	// Get the max attach ID
	echo 'Getting max attachment ID from primary';
	$sql = "SELECT MAX(ID_ATTACH) FROM " . PRIMARY_DB_PREFIX . "attachments";
	$query = call_mysqli_query($sql, false);
	$maxattach = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);
	echo '...done<br>';

	echo 'Copying attachments';
	$sql = "SELECT ID_ATTACH FROM {$db_prefix}attachments ORDER BY ID_ATTACH DESC";
	$query = call_mysqli_query($sql, false);

	while($attach = mysqli_fetch_row($query))
	{
		$prefix_old = '/^' . preg_quote($attachmentUploadDir .'/' . $attach[0] . '_', '/') . '/';
		$prefix_new = $attachmentTempDir . ($attach[0] + $maxattach) . '_';
		$filename = glob($attachmentUploadDir .'/'. $attach[0] . '_*', GLOB_NOESCAPE);
		if (!empty($filename[0]) && is_file($filename[0]))
		{
			$filenew = preg_replace($prefix_old, $prefix_new, $filename[0]);
			copy($filename[0], $filenew);
		}
	}
	mysqli_free_result($query);
	echo '...done<br><br>';

	return;
}

// Custom Avatars...
function dostep4()
{
	head();

	// Now do the same with custom avatars...
	custom_avs();

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=5">Continue Step 5</a></center>';

	foot();
}

// Custom Avatars...
function custom_avs()
{
	global $db_prefix;

	// Get the custom_avatars directory...
	$sql = "SELECT value FROM {$db_prefix}settings WHERE variable = 'custom_avatar_dir' LIMIT 1";
	$result = call_mysqli_query($sql, false);

	// If it wasn't setup, no need to go any further.
	if (mysqli_num_rows($result) == 0)
	{
		echo 'No custom avatars.<br>';
		return;
	}

	echo 'Getting custom avatar dir';
	list ($customAvatarDir) = mysqli_fetch_row($result);
	mysqli_free_result($result);
	echo '...done<br>';

	// Make sure it's a real directory...
	if (empty($customAvatarDir) || !is_dir($customAvatarDir))
	{
		echo '<br>No custom avatars.<br>';
		return;
	}

	// Make temporary directory...
	$customAvTempDir = $customAvatarDir . '/to_move_to_primary/';
	echo 'Creating to_move_to_primary custom avatar directory' . $customAvTempDir;
	@mkdir($customAvTempDir, 0755);
	echo '...done<br>';

	// Get the max member ID
	echo 'Getting max member ID from primary';
	$sql = "SELECT MAX(id_member) FROM " . PRIMARY_DB_PREFIX . "members";
	$query = call_mysqli_query($sql, false);
	$maxmember = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);
	echo '...done<br>';

	// Simplest here to just rename & move 'em over based on the directory contents.
	echo 'Copying custom avatars';
	$files = glob($customAvatarDir . '/avatar_*', GLOB_NOESCAPE);
	$pattern = '/^' . preg_quote($customAvatarDir . '/', '/') . 'avatar_(\d+)_(.*)$/';
	$matches = array();
	foreach($files AS $filename)
	{
		if ((preg_match($pattern, $filename, $matches) == 1) && is_file($filename))
		{
			$filenew = $customAvTempDir . 'avatar_' . ($matches[1] + $maxmember) . '_' . $matches[2];
			copy($filename, $filenew);
		}
	}
	echo '...done<br><br>';

	// Finally, update the filename in the attachments table for the custom avatars...
	echo 'Renaming avatar filenames in members table';
	$sql = "SELECT id_attach, filename FROM {$db_prefix}attachments WHERE attachment_type = 1 and id_member > 0 ORDER BY id_member DESC";
	$query = call_mysqli_query($sql, false);

	// Increase 'em all...
	$pattern = '/^avatar_(\d+)_(.*)$/';
	$matches = array();
	while($avinfo = mysqli_fetch_assoc($query))
	{
		if (preg_match($pattern, $avinfo['filename'], $matches) == 1)
		{
			$filenew = 'avatar_' . ($matches[1] + $maxmember) . '_' . $matches[2];
			$sql = "UPDATE {$db_prefix}attachments SET filename = '{$filenew}' WHERE id_attach = {$avinfo['id_attach']}";
			$query0 = call_mysqli_query($sql, false);
		}
	}
	mysqli_free_result($query);
	echo '...done';

}

// Log actions...
function dostep5()
{
	head();

	dotable('log_actions');

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=6">Continue Step 6</a></center>';

	foot();
}

// Update serialized strings' member and applicator values
function serial_strings()
{
	global $db_prefix, $db_connection;

	echo 'Updating log_actions - fixing serialized strings...<br>';

	// Get the max member ID
	$sql = 'SELECT MAX(id_member) FROM ' . PRIMARY_DB_PREFIX . 'members';
	$query = call_mysqli_query($sql, false);
	$maxmember = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);

	// Collect all the extras that need updating...
	echo 'Getting member-related extras to update';
	$sql = "SELECT id_action, extra FROM `{$db_prefix}log_actions` WHERE extra like '%member%' OR extra like '%applicator%'";
	$query = call_mysqli_query($sql, false);
	echo '...done<br>';

	// Increase 'em all...
	echo 'Updating member-related extras';
	while($action = mysqli_fetch_assoc($query))
	{
		$checkvals = @unserialize($action['extra']);
		if ($checkvals === false)
			echo_error_text('Cannot unserialize action: ' . $action['id_action'] . ' extra: ' . $action['extra']);
		else
		{
			if (array_key_exists('member', $checkvals))
				$checkvals['member'] = (string) ($checkvals['member'] + $maxmember);
			elseif (array_key_exists('applicator', $checkvals))
				$checkvals['applicator'] = (string) ($checkvals['applicator'] + $maxmember);
			else
				// Just in case the value just happened to be in a string...
				continue;

			$newstring = mysqli_real_escape_string($db_connection, serialize($checkvals));
			$sql = "UPDATE {$db_prefix}log_actions SET extra = '{$newstring}' WHERE id_action = {$action['id_action']}";
			$query0 = call_mysqli_query($sql, false);
		}
	}
	mysqli_free_result($query);
	echo '...done<br>';

	// Board #s need to be fixed on moves...
	// Get the max board ID
	$sql = 'SELECT MAX(id_board) FROM ' . PRIMARY_DB_PREFIX . 'boards';
	$query = call_mysqli_query($sql, false);
	$maxboard = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);

	// Collect all the extras that need updating...
	echo 'Getting board-related extras to update';
	$sql = "SELECT id_action, extra FROM `{$db_prefix}log_actions` WHERE action = 'move'";
	$query = call_mysqli_query($sql, false);
	echo '...done<br>';

	// Increase 'em all...
	echo 'Updating board-related extras';
	while($action = mysqli_fetch_assoc($query))
	{
		$checkvals = @unserialize($action['extra']);
		if ($checkvals === false)
			echo_error_text('Cannot unserialize action: ' . $action['id_action'] . ' extra: ' . $action['extra']);
		else
		{
			if (array_key_exists('board_from', $checkvals))
				$checkvals['board_from'] = (string) ($checkvals['board_from'] + $maxboard);
			else
				// Just in case the value just happened to be in a string...
				continue;

			$newstring = mysqli_real_escape_string($db_connection, serialize($checkvals));
			$sql = "UPDATE {$db_prefix}log_actions SET extra = '{$newstring}' WHERE id_action = {$action['id_action']}";
			$query0 = call_mysqli_query($sql, false);
		}
	}
	mysqli_free_result($query);
	echo '...done<br>';

}

// Update Members
function dostep6()
{
	head();

	echo 'Updating member IDs...<br>';
	dotable('members');

	echo '<br /><br /><center><a href="' . $_SERVER['PHP_SELF'] . '?step=7">Continue Step 7</a></center>';
	foot();
}

// Update several items related to members:
//  - Rename if needed to make names unique
//  - Update buddy/ignore lists
//  - Theme & smiley defaults
//
function renamemembers()
{
	global $db_prefix, $secondary_suffix;

	echo 'Getting member names';
	$sql = "SELECT ID_MEMBER, member_name, real_name, email_address FROM {$db_prefix}members ORDER BY ID_MEMBER DESC";
	$query = call_mysqli_query($sql, false);
	echo '...done<br>';

	while($mem = mysqli_fetch_row($query))
	{
		// Make sure member_name is unique...
		$sql = "SELECT ID_MEMBER FROM " . PRIMARY_DB_PREFIX . "members where member_name = '$mem[1]'";
		$queryPrimaryMemberID = call_mysqli_query($sql, false);
		$member_name_hits = mysqli_num_rows($queryPrimaryMemberID);

		// Also check real_name...
		$sql = "SELECT ID_MEMBER FROM " . PRIMARY_DB_PREFIX . "members where real_name = '$mem[2]'";
		$queryPrimaryMemberID = call_mysqli_query($sql, false);
		$real_name_hits = mysqli_num_rows($queryPrimaryMemberID);

		// Also check email...
		$sql = "SELECT ID_MEMBER FROM " . PRIMARY_DB_PREFIX . "members where email_address = '$mem[3]'";
		$queryPrimaryMemberID = call_mysqli_query($sql, false);
		$email_hits = mysqli_num_rows($queryPrimaryMemberID);

		//IF MEMBERNAME EXISTS IN PRIMARY DATABASE, rename the member to {membername]-suffix. 
		//You can use a tool like SMF Admin Toolbox to merge these members with the primary members of the same name after finished with this script.
		if(($member_name_hits > 0) || ($real_name_hits > 0) || ($email_hits > 0))
		{
			echo "Member $mem[1] exists in primary. Renaming...<BR>";
			$sql = "UPDATE {$db_prefix}members SET member_name = CONCAT(member_name, '{$secondary_suffix}'), real_name = CONCAT(real_name, '{$secondary_suffix}'), email_address = CONCAT(email_address, '{$secondary_suffix}') WHERE ID_MEMBER = '$mem[0]'";
			$query0 = call_mysqli_query($sql, false);
		} 
		else 
		{
			echo "Member $mem[1] does not exist in primary.<BR>";
		}
		mysqli_free_result($queryPrimaryMemberID);
	}
	mysqli_free_result($query);


	// Get the max id_member
	echo 'Getting max member ID in primary';
	$sql = "SELECT MAX(id_member) FROM " . PRIMARY_DB_PREFIX . "members";
	$query = call_mysqli_query($sql, false);
	$maxmember = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);
	echo '...done<br>';

	// Look at buddy list on members...
	echo '<br>Updating buddy lists on members...';
	$sql = "SELECT id_member, buddy_list FROM {$db_prefix}members WHERE buddy_list <> ''";
	$query = call_mysqli_query($sql, false);

	while($mem = mysqli_fetch_assoc($query))
	{
		$members = explode(',', $mem['buddy_list']);
		foreach ($members AS $ix => $member)
		{
			if ($member > 0)
				$members[$ix] = $members[$ix] + $maxmember;
		}
		$members_new = implode(',', $members);
		$sql = "UPDATE {$db_prefix}members SET buddy_list = '{$members_new}' WHERE id_member = {$mem['id_member']}";
		$query0 = call_mysqli_query($sql, false);
	}
	mysqli_free_result($query);
	echo '...done<br>';

	// Look at ignore list on members...
	echo 'Updating ignore lists on members';
	$sql = "SELECT id_member, pm_ignore_list FROM {$db_prefix}members WHERE pm_ignore_list <> ''";
	$query = call_mysqli_query($sql, false);

	while($mem = mysqli_fetch_assoc($query))
	{
		$members = explode(',', $mem['pm_ignore_list']);
		foreach ($members AS $ix => $member)
		{
			if ($member > 0)
				$members[$ix] = $members[$ix] + $maxmember;
		}
		$members_new = implode(',', $members);
		$sql = "UPDATE {$db_prefix}members SET pm_ignore_list = '{$members_new}' WHERE id_member = {$mem['id_member']}";
		$query0 = call_mysqli_query($sql, false);
	}
	mysqli_free_result($query);
	echo '...done.<br><br>';


	//Themes & smiley sets may not line up, so set users who are about to move over to defaults
	echo "Setting themes, smilies to defaults";
	$sql = "UPDATE {$db_prefix}members SET id_theme = 0, smiley_set = ''";
	$query9a = call_mysqli_query($sql, false);
	echo "...done.<br>";

	//SMF doesn't like Member profile IPs of 000.000.000.000 (I had some of these from very old members, probably from my original migration from Snitz).
	echo "Fixing old broken IPs";
	$sql = "UPDATE {$db_prefix}members SET member_ip = '1.1.1.1', member_ip2 = '1.1.1.1' WHERE member_ip = '000.000.000.000'";
	$query9b = call_mysqli_query($sql, false);
	echo "...done.<br><br>";

	return;
}

// Update PM IDs...
function dostep7()
{
	head();

	echo 'Updating PM IDs...<br>';
	dotable('personal_messages');

	echo '<br /><br /><center><a href="' . $_SERVER['PHP_SELF'] . '?step=8">Continue Step 8</a></center>';
	foot();
}

// Update polls...
function dostep8()
{
	head();

	echo 'Updating poll IDs in polls, poll choices, polls log and topics...<br>';
	dotable('polls');

	echo '<br>Updating choice IDs in polls log and poll choices...<br>';
	dotable('poll_choices');

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=9">Continue Step 9</a></center>';
	foot();
}

// Update topic IDs...
function dostep9()
{
	head();

	echo 'Updating topic IDs in notify log, messages and topics...<br>';
	dotable('topics');

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=10">Continue Step 10</a></center>';
	foot();
}

// Combine the daily statistics...
function dostep10()
{
	head();
	global $db_prefix;

	echo 'Merging daily statistics...<br>';

	// Get stats from primary
	echo 'Getting stats from primary';
	$primary_activity = array();
	$sql = 'SELECT date, hits, topics, posts, registers, most_on FROM ' . PRIMARY_DB_PREFIX . 'log_activity';
	$query = call_mysqli_query($sql, false);
	while($row = mysqli_fetch_assoc($query))
		$primary_activity[$row['date']] = array('hits' => $row['hits'], 'topics' => $row['topics'], 'posts' => $row['posts'], 'registers' => $row['registers'], 'most_on' => $row['most_on']);
	mysqli_free_result($query);
	echo "...done.<br>";

	// Get stats from secondary
	echo 'Getting stats from secondary';
	$secondary_activity = array();
	$sql = 'SELECT date, hits, topics, posts, registers, most_on FROM ' . $db_prefix . 'log_activity';
	$query = call_mysqli_query($sql, false);
	while($row = mysqli_fetch_assoc($query))
		$secondary_activity[$row['date']] = array('hits' => $row['hits'], 'topics' => $row['topics'], 'posts' => $row['posts'], 'registers' => $row['registers'], 'most_on' => $row['most_on']);
	mysqli_free_result($query);
	echo "...done.<br>";

	// Add secondary stats into primary
	echo 'Adding them together';
	foreach($secondary_activity AS $secdate => $stats)
	{
		if (array_key_exists($secdate, $primary_activity))
		{
			$primary_activity[$secdate]['hits'] = $primary_activity[$secdate]['hits'] + $secondary_activity[$secdate]['hits'];
			$primary_activity[$secdate]['topics'] = $primary_activity[$secdate]['topics'] + $secondary_activity[$secdate]['topics'];
			$primary_activity[$secdate]['posts'] = $primary_activity[$secdate]['posts'] + $secondary_activity[$secdate]['posts'];
			$primary_activity[$secdate]['registers'] = $primary_activity[$secdate]['registers'] + $secondary_activity[$secdate]['registers'];
			$primary_activity[$secdate]['most_on'] = $primary_activity[$secdate]['most_on'] + $secondary_activity[$secdate]['most_on'];
		}
		else
			$primary_activity[$secdate] = $stats;
	}

	// Convert to text for easy inserts
	$inserts = array();
	foreach($primary_activity AS $primdate => $stats)
		$inserts[] = '(\'' . $primdate . '\',' . implode(',', $stats) . ')';
	echo "...done.<br>";

	// Wipe out target stats & replace
	echo 'Updating stats on primary';
	$sql = 'TRUNCATE ' . PRIMARY_DB_PREFIX . 'log_activity';
	$query = call_mysqli_query($sql, false);

	$sql = 'INSERT INTO ' . PRIMARY_DB_PREFIX . 'log_activity (date, hits, topics, posts, registers, most_on) VALUES ' . implode(', ', $inserts);
	$query = call_mysqli_query($sql, false);
	echo "...done.<br>";

	echo '<br /><br /><center><a href="'.$_SERVER['PHP_SELF'].'?step=11">Continue Step 11</a></center>';

	foot();
}

// Update Membergroups...
function dostep11()
{
	head();

	echo 'Updating membergroups...<br>';
	dotable('membergroups');

	echo '<br /><br /><center><a href="' . $_SERVER['PHP_SELF'] . '?step=12">Continue Step 12</a></center>';
	foot();
}

// Update Membergroups...
// Remember at the end, all records in the tables get copied over...
// So you gotta get rid of anything that will collide with settings/records already in primary.
// Everything to do with -1 (guests) and 0 (default) must be left alone and not migrated over.
// Also, post-count based groups will not be brought over - rules from the primary should be used.
//
function cleanrenamegroups()
{
	global $db_prefix, $secondary_suffix;

	// Get the max id_group
	$sql = "SELECT MAX(id_group) FROM " . PRIMARY_DB_PREFIX . "membergroups";
	$query = call_mysqli_query($sql, false);
	$maxgroup = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);

	// membergroups - remove recs we won't be moving over; use primary board's post-count based groups instead.
	echo '<br>Updating membergroups - do not migrate post-count based groups...';
	$sql = "DELETE FROM {$db_prefix}membergroups WHERE min_posts > -1";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// permissions - remove -1 & 0; guest & default behavior defined by primary
	echo 'Updating permissions - default values should be coming from primary...';
	$sql = "DELETE FROM {$db_prefix}permissions WHERE id_group < 1";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// board_permissions - remove groups -1 and profiles < 5
	echo 'Updating board_permissions - default values should be coming from primary...';
	$sql = "DELETE FROM {$db_prefix}board_permissions WHERE id_group < 0 AND id_profile < 5";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// This is a weird one... Admins (id_group = 1) don't have entries in board_permissions...
	// Thus, they lose EVERYTHING post migration.  Worse than guests!!!  They should at least get what
	// regular members get in primary.  So... Change the regular member entries to admin entries...
	// This effectively (1) gives admins access AND (2) gets rid of the last of the 'default' values
	// to avoid conflicts with primary...
	echo 'Updating board_permissions - old admins need perms...';
	$sql = "UPDATE {$db_prefix}board_permissions SET id_group = 1 WHERE id_group = 0";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// Identify set of remaining groups - needed for cleaning group lists...
	echo 'Identifying remaining groups...';
	$grouplist = array();
	$sql = "SELECT id_group FROM {$db_prefix}membergroups";
	$query = call_mysqli_query($sql, false);
	while($grp = mysqli_fetch_assoc($query))
		$grouplist[] = $grp['id_group'];
	mysqli_free_result($query);
	echo 'done.<br>';

	// Look at member_groups on boards...
	echo 'Updating member_groups on boards...';
	$sql = "SELECT id_board, member_groups FROM {$db_prefix}boards WHERE member_groups <> ''";
	$query = call_mysqli_query($sql, false);

	while($mem = mysqli_fetch_assoc($query))
	{
		$groups = explode(',', $mem['member_groups']);
		$groups_new = array();
		foreach ($groups AS $group)
		{
			if ($group > 0)
			{
				// This removes count-based from the group lists...
				if (in_array($group, $grouplist))
					$groups_new[] = $group + $maxgroup;
			}
			else
				$groups_new[] = $group;
		}
		$groups_new = implode(',', $groups_new);
		$sql = "UPDATE {$db_prefix}boards SET member_groups = '{$groups_new}' WHERE id_board = {$mem['id_board']}";
		$query0 = call_mysqli_query($sql, false);
	}
	mysqli_free_result($query);
	echo 'done.<br>';

	// Look at additional_groups on members...
	echo 'Updating additional_groups on members...';
	$sql = "SELECT id_member, additional_groups FROM {$db_prefix}members WHERE additional_groups <> ''";
	$query = call_mysqli_query($sql, false);

	while($mem = mysqli_fetch_assoc($query))
	{
		$groups = explode(',', $mem['additional_groups']);
		$groups_new = array();
		foreach ($groups AS $group)
		{
			if ($group > 0)
			{
				// This removes count-based from the group lists...
				if (in_array($group, $grouplist))
					$groups_new[] = $group + $maxgroup;
			}
			else
				$groups_new[] = $group;
		}
		$groups_new = implode(',', $groups_new);
		$sql = "UPDATE {$db_prefix}members SET additional_groups = '{$groups_new}' WHERE id_member = {$mem['id_member']}";
		$query0 = call_mysqli_query($sql, false);
	}
	mysqli_free_result($query);
	echo 'done.<br>';

	// Look at add_groups on subscriptions...
	echo 'Updating add_groups on subscriptions...';
	$sql = "SELECT id_subscribe, add_groups FROM {$db_prefix}subscriptions WHERE add_groups <> ''";
	$query = call_mysqli_query($sql, false);

	while($mem = mysqli_fetch_assoc($query))
	{
		$groups = explode(',', $mem['add_groups']);
		$groups_new = array();
		foreach ($groups AS $group)
		{
			if (group > 0)
			{
				// This removes count-based from the group lists...
				if (in_array($group, $grouplist))
					$groups_new[] = $group + $maxgroup;
			}
			else
				$groups_new[] = $group;
		}
		$groups_new = implode(',', $groups_new);
		$sql = "UPDATE {$db_prefix}subscriptions SET add_groups = '{$groups_new}' WHERE id_subscribe = {$mem['id_subscribe']}";
		$query0 = call_mysqli_query($sql, false);
	}
	mysqli_free_result($query);
	echo 'done.<br>';

	// Rename membergroups
	echo 'Renaming membergroups so they are guaranteed to be unique...';
	$sql = "UPDATE {$db_prefix}membergroups SET group_name = CONCAT(group_name, '{$secondary_suffix}')";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br><br>';

}

// Update Profiles...
function dostep12()
{
	head();

	echo 'Updating permission profiles...<br>';
	dotable('permission_profiles');

	echo '<br /><br /><center><a href="' . $_SERVER['PHP_SELF'] . '?step=13">Continue Step 13</a></center>';
	foot();
}

// Update Profiles...
// Remember at the end, all records in the tables get copied over...
// So you gotta get rid of anything that will collide with settings/records already in primary.
// Given we need to bypass a specific set of profiles (1-4), all logic is custom here.
// Profile 1 is for the default forum behavior.  That should be driven by the primary forum.
// Profiles 2-4 are not-user-editable, and are common across all SMF, so leave those alone also.
// Thus...  Only bring over profiles 5+.  Boards that use profiles 1-4 will continue to do so
// once migrated - but they will be pointing to the perms as defined on the primary forum.
function processprofiles()
{
	global $db_prefix, $secondary_suffix;

	// Get the max id_profile
	$sql = "SELECT MAX(id_profile) FROM " . PRIMARY_DB_PREFIX . "permission_profiles";
	$query = call_mysqli_query($sql, false);
	$maxprofile = mysqli_fetch_row($query)[0];
	mysqli_free_result($query);

	// How much to add to secondary profiles?  max - 4...
	// (Which would be 0 if there were no custom profiles in the primary.)
	$incby = $maxprofile - 4;
	// Just being paranoid here...
	if ($incby < 0)
		$incby = 0;

	// Profiles - remove recs we won't be moving over
	echo 'Removing duplicate permission_profiles - should be as defined on primary...';
	$sql = "DELETE FROM {$db_prefix}permission_profiles WHERE id_profile < 5";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// Profiles - update profile_id 
	echo 'Updating id_profile on permission_profiles...';
	$sql = "UPDATE {$db_prefix}permission_profiles SET id_profile = id_profile + {$incby} ORDER BY id_profile DESC";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// Board permissions - update profile_id 
	echo 'Updating id_profile on board_permissions...';
	$sql = "UPDATE {$db_prefix}board_permissions SET id_profile = id_profile + {$incby} WHERE id_profile > 4 ORDER BY id_profile DESC";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// Boards - update profile_id 
	echo 'Updating id_profile on boards...';
	$sql = "UPDATE {$db_prefix}boards SET id_profile = id_profile + {$incby} WHERE id_profile > 4 ORDER BY id_profile DESC";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

	// Rename profiles
	echo 'Renaming permission_profiles so they are guaranteed to be unique...';
	$sql = "UPDATE {$db_prefix}permission_profiles SET profile_name = CONCAT(profile_name, '{$secondary_suffix}')";
	$query = call_mysqli_query($sql, false);
	echo 'done.<br>';

}

// Update Subscriptions...
function dostep13()
{
	head();

	echo 'Updating subscriptions...<br>';
	dotable('subscriptions');

	echo '<br>Updating subscription log...<br>';
	dotable('log_subscribed');

	echo '<br /><br /><center><a href="' . $_SERVER['PHP_SELF'] . '?step=14">Continue Step 14</a></center>';
	foot();
}

// Bring over reported posts & bans....
function dostep14()
{
	head();

	echo 'Updating reported posts...<br>';
	dotable('log_reported');

	echo '<br>Updating report comments...<br>';
	dotable('log_reported_comments');

	echo '<br>Updating ban groups...<br>';
	dotable('ban_groups');

	echo '<br>Updating ban items...<br>';
	dotable('ban_items');

	echo '<br /><br /><center><a href="' . $_SERVER['PHP_SELF'] . '?step=15">Continue Step 15</a></center>';
	foot();
}

// Copy everything over to the other board...
function dostep15()
{
	head();
	global $db_prefix, $tables;
	echo 'Copying boards, categories, logs, messages, members, PMs, topics, polls and attachments to primary...<br><br>';

	foreach($tables AS $table => $info)
	{
		echo ucfirst($table) . ' merging...';
		$cols = commoncols($table);
		$sql = "INSERT INTO " . PRIMARY_DB_PREFIX . "{$table} ({$cols}) SELECT {$cols} FROM {$db_prefix}{$table}";
		$query = call_mysqli_query($sql, false);
		if ($query === false)
			echo ' FAILED...<br />';
		else
			echo 'done.<br />';
	}

	echo '<br>Yippee - mission accomplished!<br><br>Now login to the primary installation, then choose "Recount all totals and statistics" from the "Forum Maintenance" section of your admin center.<br /><br />Notes:<br />(a) Your renamed attachments are now in the "secondary_site/attachments/to_move_to_primary/" directory, so you need to copy them over to your "primary_site/attachments/" directory<br />(b) Your renamed custom avatars are now in the "secondary_site/custom_avatars/to_move_to_primary/" directory, so you need to copy them over to your primary site as well<br />(c) If you\'re done with all this, DELETE the mergeSMF.php file.<br /><br />Once again, we are indebted to Oldiesmann for originating this nifty script.';

	foot();
}

// For a specified table, return the columns that are common to both DBs as a string suitable for queries
function commoncols($table)
{
	global $db_prefix;

	$cols = array();
	$primarycols = getcols(PRIMARY_DB_PREFIX . $table);
	$secondarycols = getcols($db_prefix . $table);

	$cols = array_intersect($primarycols, $secondarycols);
	$cols = implode(', ', $cols);

	return $cols;
}

// For one specified table, return the columns as an array
function getcols($table)
{
	global $db_connection;

	$sql = "SHOW COLUMNS FROM {$table}";
	$colquery = call_mysqli_query($sql, false);
	if ($colquery === false)
		echo ' : Cannot retrieve columns for ' . $table . '<br>';

	$cols = array();
	while ($row = mysqli_fetch_assoc($colquery))
		$cols[] = $row['Field'];

	return $cols;
}

// For specified table, drive updates to all related tables
function dotable($table)
{
	global $db_prefix, $tables;

	// If userfunc defined, do it now, before values are changed!
	if (!empty($tables[$table]['userfunc']))
		call_user_func($tables[$table]['userfunc']);

	// Mass incrementation...
	if (!empty($tables[$table]['incby']))
	{
		// Get the max ID (e.g., "SELECT MAX(id_board) FROM smf_boards")
		$sql = "SELECT MAX({$tables[$table]['incby']}) FROM " . PRIMARY_DB_PREFIX . "{$table}";

		echo "Getting max from primary";
		$query = call_mysqli_query($sql);

		$maxvalue = mysqli_fetch_row($query)[0];
		if (empty($maxvalue))
			$maxvalue = 0;
		mysqli_free_result($query);
		echo "...done. ({$maxvalue})<br>";

		// Loop thru all related tables, enacting updates...
		foreach($tables[$table]['rels'] AS $target => $fields)
		{
			foreach($fields AS $field)
			{
				// Update statements (e.g., "UPDATE categories SET id_cat = id_cat + xxx ORDER BY id_cat DESC")
				$sql = "UPDATE {$db_prefix}{$target} SET {$field} = {$field} + {$maxvalue} ORDER BY {$field} DESC";

				echo "Updating {$db_prefix}{$target} {$field}";
				$query = call_mysqli_query($sql);
				echo '...done.<br>';
			}
		}

		// Loop thru all related tables, enacting updates.
		// This is specifically for updating non-zero values.  Often, 0 means "na"...
		if (!empty($tables[$table]['nzrels']))
		{
			foreach($tables[$table]['nzrels'] AS $target => $fields)
			{
				foreach($fields AS $field)
				{
					// Update statements (e.g., "UPDATE boards SET id_parent = id_parent + xxx WHERE id_parent > 0 ORDER BY id_parent DESC")
					$sql = "UPDATE {$db_prefix}{$target} SET {$field} = {$field} + {$maxvalue} WHERE {$field} > 0 ORDER BY {$field} DESC";

					echo "Updating {$db_prefix}{$target} {$field}";
					$query = call_mysqli_query($sql);
					echo '...done.<br>';
				}
			}
		}
	}

	return;
}

function call_mysqli_query($sql, $display_sql = true)
{
	global $db_connection;

	if ($display_sql)
		echo ' sql: ' . $sql;

	$result = mysqli_query($db_connection, $sql);
	if ($result === false)
		echo_error_text(mysqli_errno($db_connection) . ': ' . mysqli_error($db_connection));

	return $result;
	
}

function echo_error_text($text)
{
	echo '<span style = "color:red"><strong> *****ERROR ' . $text . '</strong></span>';
	
}