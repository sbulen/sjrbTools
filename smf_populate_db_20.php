<?php 
// 
// An SMF utility to populate an SMF 2.0 MySQL latin1 database - specifically with heaps of the latin1 charset.
//
// You need to start with an SMF MySQL installation with latin1_swedish_ci.  Preferably a fresh install, nearly empty.
// To use, copy to the forum root, where Settings.php is, set the settings below in the User config section, & execute.
// SMF prefix must be "smf_".  Just because.
//
// Should run find & fix errors after completion - it'll plug holes in the subject cache.
// Should recount stats after completion.
// Should add a search index after completion - fulltext or custom.
//
// ***** SMF 2.0 *****
// ***** latin1 *****
// ***** MySQL *****
// ***** smf_ *****
//

// User config section...
$write_max = 10000;
$tables = array(
	'smf_categories' => array('add' => 1, 'key' => 'id_cat'),
	'smf_boards' => array('add' => 216, 'key' => 'id_board'),
	'smf_members' => array('add' => 10000, 'key' => 'id_member'),
	'smf_log_actions' => array('add' => 40000, 'key' => 'id_action'),
	'smf_log_comments' => array('add' => 50, 'key' => 'id_comment'),
	'smf_messages' => array('add' => 3500000, 'key' => 'id_msg'),
	'smf_personal_messages' => array('add' => 160000, 'key' => 'id_pm'),
	'smf_pm_recipients' => array('add' => 200000, 'key' => ''),
	'smf_topics' => array('add' => 35000, 'key' => 'id_topic'),
);
// End user config section

//*** Main program
do_startup();
load_settings();
load_table_min_max();
foreach ($tables AS $table => $details)
	do_table($table, $details);
do_wrap_up();
return;

//*** Startup 
function do_startup() {

	global $rundir, $fp, $url, $board, $allTimer;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=iso-8859-1' );
	echo("<br>********************************<br>");
	echo("****** SMF Populate DB - 2.0 ******<br>");
	echo("********************************<br>");

	define('SMF', 1);
	define('SMF_VERSION', '2.1 RC2');
	define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
	define('MYSQL_TITLE', 'MySQL');

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	mb_internal_encoding('ISO-8859-1');

	@flush();

	return;
}

//*** Settings File 
function load_settings() {

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

	// SET NAMES
	$smcFunc['db_query']('', '
		SET NAMES \'latin1\'',
		array(
		)
	);

	// Turn off binary log...
	$smcFunc['db_query']('', '
		SET sql_log_bin = 0;',
		array(
		)
	);

	// Load modSettings
	require_once($sourcedir . '/Subs.php');
	require_once($sourcedir . '/Load.php');
	reloadSettings();

	$curr_time = new DateTimeImmutable();
	echo '<br>Start time: ' . $curr_time->format(DateTimeInterface::RFC7231) . '<br><br>';

	return;
}

//*** do an individual table
function load_table_min_max()
{
	global $smcFunc, $tables;

	foreach($tables AS $table => $tabledata)
	{
		if (!empty($tabledata['key']))
		{
			$request = $smcFunc['db_query']('', 'SELECT MIN({raw:key}), MAX({raw:key}) FROM {raw:table}',
				array(
					'table' => $table,
					'key' => $tabledata['key'],
				),
			);
			list ($min, $max) = $smcFunc['db_fetch_row']($request);
			$tables[$table]['min'] = $min ?? 0;
			$tables[$table]['max'] = $max ?? 0;
		}
		else
		{
			$tables[$table]['min'] = 0;
			$tables[$table]['max'] = 0;
		}
	}

	// Keep this around for debugging...
	echo '<br><pre>' . print_r($tables, true) . '</pre><br>';

}

//*** do an individual table
function do_table($table, $details)
{
	global $smcFunc, $indexes;

	// These can be long running tasks, attempt to disable time check...
	@set_time_limit(0);

	// Let's do these in transactions...
	$smcFunc['db_transaction']('begin');

	echo 'Table: ' . $table . '<br>';
	$indexes = array();
	$count = $details['add'];

	$start = time();
	drop_indexes($table);
	echo 'Indexes dropped, time elapsed: ' . date('H:i:s', time() - $start) . '<br>';
	@ob_flush();
	@flush();

	$start = time();
	$table_func = 'add_' . $table;
	$table_func($count);
	echo $count . ' rows added, time elapsed: ' . date('H:i:s', time() - $start) . '<br>';
	@ob_flush();
	@flush();

	$start = time();
	re_add_indexes($table);
	echo 'Indexes re-added, time elapsed: ' . date('H:i:s', time() - $start) . '<br><br>';
	@ob_flush();
	@flush();

	// Let's commit that...
	$smcFunc['db_transaction']('commit');
}

//*** drop indexes...
//*** leaving PKs in place for now...  If that's a problem, will have to deal with auto inc later...
function drop_indexes($table)
{
	global $smcFunc, $indexes;

	$sql = 'SHOW CREATE TABLE ' . $table;
	$request = $smcFunc['db_query']('', $sql,
		array(),
	);
	list(,$ct) = $smcFunc['db_fetch_row']($request);

	$matches = array();
	preg_match_all('~^\s+(UNIQUE KEY|PRIMARY KEY|FULLTEXT KEY|SPATIAL KEY|INDEX|KEY)\s+([^()]+)?(\(.+\)),?$~m', $ct, $matches);

	foreach ($matches[0] AS $ix => $match)
	{
		$indexes[] = array(
			'string' => trim(rtrim($match, ',')),
			'type' => trim($matches[1][$ix]),
			'name' => trim($matches[2][$ix]),
			'cols' => rtrim($matches[3][$ix], ','),
		);
	}

	// Keep this around for debugging...
	//echo '<br><pre>' . print_r($indexes, true) . '</pre><br>';

	$command = 'ALTER TABLE ' . $table . "\n";
	foreach ($indexes AS $index)
	{
		if ($index['type'] == 'PRIMARY KEY')
			//$command .= 'DROP PRIMARY KEY,' . "\n";
			continue;
		ELSE
			$command .= 'DROP INDEX ' . $index['name'] . ',' . "\n";
	}

	$command = rtrim(trim($command), ',') . ';';
	echo '<br><pre>' . $command . '</pre><br>';

	$request = $smcFunc['db_query']('', $command,
		array(),
	);
}

//*** re-add indexes...
//*** leaving PKs in place for now...  If that's a problem, will have to deal with auto inc later...
function re_add_indexes($table)
{
	global $smcFunc, $indexes;

	$command = 'ALTER TABLE ' . $table . "\n";

	foreach ($indexes AS $index)
	{
		if ($index['type'] == 'PRIMARY KEY')
			//$command .= 'ADD PRIMARY KEY ' . $index['cols'] . ',' . "\n";
			continue;
		ELSEIF ($index['type'] == 'UNIQUE KEY')
			$command .= 'ADD UNIQUE INDEX ' . $index['name'] . ' ' . $index['cols'] . ',' . "\n";
		ELSEIF ($index['type'] == 'FULLTEXT KEY')
			$command .= 'ADD FULLTEXT INDEX ' . $index['name'] . ' ' . $index['cols'] . ',' . "\n";
		ELSEIF ($index['type'] == 'SPATIAL KEY')
			$command .= 'ADD SPATIAL INDEX ' . $index['name'] . ' ' . $index['cols'] . ',' . "\n";
		ELSE
			$command .= 'ADD INDEX ' . $index['name'] . ' ' . $index['cols'] . ',' . "\n";
	}

	$command = rtrim(trim($command), ',') . ';';
	echo '<br><pre>' . $command . '</pre><br>';

	$request = $smcFunc['db_query']('', $command,
		array(),
	);
}

//*** wrap it up...
function do_wrap_up()
{
	$curr_time = new DateTimeImmutable();
	echo '<br>End time: ' . $curr_time->format(DateTimeInterface::RFC7231) . '<br><br>';
}

/*****
 *
 * Text builds & other helper funcs
 *
 */

//*** One title...
function make_title()
{
	$length = rand(1, 6);
	$title = '';
	for ($i = 0; $i < $length; $i++)
	{
		$title .= make_word(true) . ' ';
	}
	return trim($title);
}

//*** Several sentences, a pseudo-post...
function make_para()
{
	$sentences = rand(1, 16);
	$para = '';
	for ($i = 0; $i < $sentences; $i++)
	{
		$para .= make_sentence();
	}
	return trim($para);
}

//*** One sentence...
function make_sentence()
{
	$length = rand(4, 8);
	$sentence = '';
	for ($i = 0; $i < $length; $i++)
	{
		$caps = $i == 0 ? true : false;
		$sentence .= make_word($caps) . ' ';
	}
	$sentence = trim($sentence) . '. ';
	return $sentence;
}

//*** One word...
function make_word($caps = false)
{
	// latin1 chars, with lotsa accents...
	static $latin1_chars = "abcdefghijklmnopqrstuvwxyz\xdf\xe0\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8\xe9\xea\xeb\xec\xed\xee\xef\xf0\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xfe\xff";

	$len = rand(1, 8);
	$str = '';
	for ($i = 0; $i < $len; $i++)
	{
		$pos = rand(0, strlen($latin1_chars) - 1);
		$str .= substr($latin1_chars, $pos, 1);
	}

	if ($caps)
		mb_convert_case($str, MB_CASE_TITLE);

	return $str;
}

//*** One name...  Just a little longer than a word...
function make_name($caps = true)
{
	// latin1 chars, with lotsa accents...
	static $latin1_chars = "abcdefghijklmnopqrstuvwxyz\xdf\xe0\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8\xe9\xea\xeb\xec\xed\xee\xef\xf0\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xfe\xff";

	$len = rand(3, 12);
	$str = '';
	for ($i = 0; $i < $len; $i++)
	{
		$pos = rand(0, strlen($latin1_chars) - 1);
		$str .= substr($latin1_chars, $pos, 1);
	}

	if ($caps)
		mb_convert_case($str, MB_CASE_TITLE);

	return $str;
}

//*** Apparently SMF 2.0 emails don't like these...  Need a function to remove 'em...
function remove_accents($string_w_accents)
{
	// latin1 chars, map to remove accents...
	static $make_dull_chars = array(
		"\xdf" => 'ss', "\xe0" => 'a', "\xe1" => 'a', "\xe2" => 'a', "\xe3" => 'a', "\xe4" => 'a',
		"\xe5" => 'a', "\xe6" => 'ae', "\xe7" => 'c', "\xe8" => 'e', "\xe9" => 'e', "\xea" => 'e',
		"\xeb" => 'e', "\xec" => 'i', "\xed" => 'i', "\xee" => 'i', "\xef" => 'i', "\xf0" => 'o',
		"\xf1" => 'n', "\xf2" => 'o', "\xf3" => 'o', "\xf4" => 'o', "\xf5" => 'o', "\xf6" => 'o',
		"\xf8" => 'o', "\xf9" => 'u', "\xfa" => 'u', "\xfb" => 'u', "\xfc" => 'u', "\xfd" => 'y',
		"\xfe" => 'b', "\xff" => 'y',
	);

	$str = strtr($string_w_accents, $make_dull_chars);

	return $str;
}

//*** Dummy up a dummy IP dummy...
function make_ip()
{
	return rand(4, 220) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255);
}

/*****
 *
 * Table populations
 *
 */

//*** add rows...
//*** Only the first new category is used...
function add_smf_categories($count)
{
	global $smcFunc, $write_max, $tables;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			$inserts_tot + $tables['smf_categories']['max'],
			make_title(),
			1,
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'{db_prefix}categories',
				array('cat_order' => 'int', 'name' => 'string-255', 'can_collapse' => 'int'),
				$inserts,
				array('id_cat'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** 
//*** add board rows...
//*** Build a 3-tier hierarchy to support all the requested boards...
//*** Use the first new category for all of 'em...
//*** 
function add_smf_boards($count)
{
	global $smcFunc, $write_max, $tables, $cube_root;

	// To handle large #s of boards, build a hierarchy with roughly the same # of child boards at leach branch of the hierarchy.
	// Tier 1 will have the cube_root # of the requested # of boards 
	// Tier 2 will have the cube_root # squared of the requested # of boards 
	// Tier 3 will have the cube_root # cubed, i.e., the requested # of boards 
	$cube_root = ceil($count ** (1/3));

	// board level 0...  One per cube_root...  All board-level-1 boards will be linked to one of these...
	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $cube_root)
	{
		$inserts[] = array(
			$tables['smf_categories']['max'] + 1,
			0,
			0,
			$tables['smf_boards']['max'] + 1 + $inserts_tot,
			0,
			0,
			'-1,0,2',
			1,
			make_title(),
			make_sentence(),
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			'',
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $cube_root))
		{
			$smcFunc['db_insert']('ignore',
				'{db_prefix}boards',
				array('id_cat' => 'int', 'child_level' => 'int', 'id_parent' => 'int', 'board_order' => 'int', 'id_last_msg' => 'int', 'id_msg_updated' => 'int', 'member_groups' => 'string-255', 'id_profile' => 'int', 'name' => 'string-255', 'Description' => 'string-255', 'num_topics' => 'int', 'num_posts' => 'int', 'count_posts' => 'int', 'id_theme' => 'int', 'override_theme' => 'int', 'unapproved_posts' => 'int', 'unapproved_topics' => 'int', 'redirect' => 'string-255'),
				$inserts,
				array('id_board'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}


	// board level 1...  One per cube_root * cube_root...  All board-level-2 boards will be linked to one of these...
	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $cube_root**2)
	{
		$inserts[] = array(
			$tables['smf_categories']['max'] + 1,
			1,
			$tables['smf_boards']['max'] + 1 + floor($inserts_tot/$cube_root),
			$tables['smf_boards']['max'] + 1 + $cube_root + $inserts_tot,
			0,
			0,
			'-1,0,2',
			1,
			make_title(),
			make_sentence(),
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			'',
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $cube_root**2))
		{
			$smcFunc['db_insert']('ignore',
				'{db_prefix}boards',
				array('id_cat' => 'int', 'child_level' => 'int', 'id_parent' => 'int', 'board_order' => 'int', 'id_last_msg' => 'int', 'id_msg_updated' => 'int', 'member_groups' => 'string-255', 'id_profile' => 'int', 'name' => 'string-255', 'Description' => 'string-255', 'num_topics' => 'int', 'num_posts' => 'int', 'count_posts' => 'int', 'id_theme' => 'int', 'override_theme' => 'int', 'unapproved_posts' => 'int', 'unapproved_topics' => 'int', 'redirect' => 'string-255'),
				$inserts,
				array('id_board'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}

	// board level 2...  One per requested board...  All topics will be linked to these...
	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			$tables['smf_categories']['max'] + 1,
			2,
			$tables['smf_boards']['max'] + 1 + $cube_root + floor($inserts_tot/$cube_root),
			$tables['smf_boards']['max'] + 1 + $cube_root + $cube_root**2 + $inserts_tot,
			0,
			0,
			'-1,0,2',
			1,
			make_title(),
			make_sentence(),
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			'',
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'{db_prefix}boards',
				array('id_cat' => 'int', 'child_level' => 'int', 'id_parent' => 'int', 'board_order' => 'int', 'id_last_msg' => 'int', 'id_msg_updated' => 'int', 'member_groups' => 'string-255', 'id_profile' => 'int', 'name' => 'string-255', 'Description' => 'string-255', 'num_topics' => 'int', 'num_posts' => 'int', 'count_posts' => 'int', 'id_theme' => 'int', 'override_theme' => 'int', 'unapproved_posts' => 'int', 'unapproved_topics' => 'int', 'redirect' => 'string-255'),
				$inserts,
				array('id_board'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
//*** Do a bunch of random real_name, personal_text & location changes...
function add_smf_log_actions($count)
{
	global $smcFunc, $write_max, $tables;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			time(),
			$member = rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			make_ip(),
			'real_name',
			serialize(array('previous' => make_name(true), 'new' => make_name(true), 'applicator' => $member)),
			0,
			0,
			0,
			2,
		);
		$inserts_tot++;
		$inserts_curr++;

		$inserts[] = array(
			time(),
			$member = rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			make_ip(),
			'location',
			serialize(array('previous' => '', 'new' => make_word(true), 'applicator' => $member)),
			0,
			0,
			0,
			2,
		);
		$inserts_tot++;
		$inserts_curr++;

		$inserts[] = array(
			time(),
			$member = rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			make_ip(),
			'personal_text',
			serialize(array('previous' => make_sentence(), 'new' => make_sentence(), 'applicator' => $member)),
			0,
			0,
			0,
			2,
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_log_actions',
				array('log_time' => 'int', 'id_member' => 'int', 'ip' => 'string-16', 'action' => 'string-30', 'extra' => 'string-4096', 'id_board' => 'int', 'id_topic' => 'int', 'id_msg' => 'int', 'id_log' => 'int'),
				$inserts,
				array('id_action'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
function add_smf_log_comments($count)
{
	global $smcFunc, $write_max, $tables;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			0,
			'',
			'ver_test',
			0,
			make_name(false),
			0,
			0,
			0,
			make_sentence(),
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_log_comments',
				array('id_member' => 'int', 'member_name' => 'string-80', 'comment_type' => 'string-8', 'id_recipient' => 'int', 'recipient_name' => 'string-255', 'log_time' => 'int', 'id_notice' => 'int', 'counter' => 'int', 'body' => 'string-4096'),
				$inserts,
				array('id_comment'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
function add_smf_members($count)
{
	global $smcFunc, $write_max, $tables;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			$tmp_name = make_name(true),
			time(),
			rand(0, 4000),
			0,
			'',
			time(),
			$tmp_name,
			0,
			0,
			'',
			hash('sha256', $tmp_name),
			remove_accents($tmp_name . '@' . make_name() . '.com'),
			make_sentence(),
			0,
			'0001-01-01',
			'',
			'',
			'',
			'', '', '', '',
			1,
			1,
			'',
			make_sentence(),
			0,
			'',
			1,
			0,
			0,
			'',
			1,
			1,
			make_ip(),
			make_sentence(),
			make_word(false),
			1,
			1,
			'',
			0,
			'',
			'',
			4,
			rand(0, 9999999),
			'',
			'',
			'',
			0,
			2,
			make_ip(),
			'',
			0,
			'',
			'',
			0,
			0,
			'',
			1,
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_members',
				array('member_name' => 'string-80', 'date_registered' => 'int', 'posts' => 'int', 'id_group' => 'int', 'lngfile' => 'string-255', 'last_login' => 'int', 'real_name' => 'string-255', 'instant_messages' => 'int', 'unread_messages' => 'int', 'pm_ignore_list' => 'string-4096', 'passwd' => 'string-64', 'email_address' => 'string-255', 'personal_text' => 'string-255', 'gender' => 'int', 'birthdate' => 'date', 'website_title' => 'string-255', 'website_url' => 'string-255', 'location' => 'string-255', 'icq' => 'string-255', 'aim' => 'string-255', 'yim' => 'string-255', 'msn' => 'string-255', 'hide_email' => 'int', 'show_online' => 'int', 'time_format' => 'string-80', 'signature' => 'string-4096', 'time_offset' => 'float', 'avatar' => 'string-255', 'pm_email_notify' => 'int', 'karma_bad' => 'int', 'karma_good' => 'int', 'usertitle' => 'string-255', 'notify_announcements' => 'int', 'notify_regularity' => 'int', 'member_ip' => 'string-255', 'secret_question' => 'string-255', 'secret_answer' => 'string-64', 'id_theme' => 'int', 'is_activated' => 'int', 'validation_code' => 'string-10', 'id_msg_last_visit' => 'int', 'additional_groups' => 'string-255', 'smiley_set' => 'string-48', 'id_post_group' => 'int', 'total_time_logged_in' => 'int', 'password_salt' => 'string-255', 'message_labels' => 'string-4096', 'buddy_list' => 'string-4096', 'notify_send_body' => 'int', 'notify_types' => 'int', 'member_ip2' => 'string-255', 'mod_prefs' => 'string-20', 'warning' => 'int', 'ignore_boards' => 'string-4096', 'passwd_flood' => 'string-12', 'new_pm' => 'int', 'pm_prefs' => 'int', 'openid_uri' => 'string-4096', 'pm_receive_from' => 'int'),
				$inserts,
				array('id_member'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
function add_smf_messages($count)
{
	global $smcFunc, $write_max, $tables, $cube_root;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			rand($tables['smf_topics']['max'] + 1, $tables['smf_topics']['max'] + $tables['smf_topics']['add']),
			rand($tables['smf_boards']['max'] + 1 + $cube_root + $cube_root**2, $tables['smf_boards']['max'] + $cube_root + $cube_root**2 + $tables['smf_boards']['add']),
			time(),
			rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			0,
			make_title(),
			make_name(true),
			remove_accents(make_name(true) . '@' . make_word(true) . '.com'),
			make_ip(),
			1,
			0,
			'',
			make_para(),
			'thumbup',
			1,
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_messages',
				array('id_topic' => 'int', 'id_board' => 'int', 'poster_time' => 'int', 'id_member' => 'int', 'id_msg_modified' => 'int', 'subject' => 'string-255', 'poster_name' => 'string-255', 'poster_email' => 'string-255', 'poster_ip' => 'string-255', 'smileys_enabled' => 'int', 'modified_time' => 'int', 'modified_name' => 'string-255', 'body' => 'string-4096', 'icon' => 'string-16', 'approved' => 'int'),
				$inserts,
				array('id_msg'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
function add_smf_personal_messages($count)
{
	global $smcFunc, $write_max, $tables;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			$tables['smf_personal_messages']['max'] + 1 + $inserts_tot,
			rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			0,
			make_name(true),
			time(),
			make_title(),
			make_para(),
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_personal_messages',
				array('id_pm_head' => 'int', 'id_member_from' => 'int', 'deleted_by_sender' => 'int', 'from_name' => 'string-255', 'msgtime' => 'int', 'subject' => 'string-255', 'body' => 'string-4096'),
				$inserts,
				array('id_pm'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
function add_smf_pm_recipients($count)
{
	global $smcFunc, $write_max, $tables;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			rand($tables['smf_personal_messages']['max'] + 1, $tables['smf_personal_messages']['max'] + $tables['smf_personal_messages']['add']),
			rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			'-1',
			0,
			1,
			0,
			rand(0, 1),
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_pm_recipients',
				array('id_pm' => 'int', 'id_member' => 'int', 'labels' => 'string-60', 'bcc' => 'int', 'is_read' => 'int', 'is_new' => 'int', 'deleted' => 'int'),
				$inserts,
				array('id_pm', 'id_member'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}
}

//*** add rows...
function add_smf_topics($count)
{
	global $smcFunc, $write_max, $tables, $cube_root;

	$inserts_tot = 0;
	$inserts_curr = 0;
	$inserts = array();
	while ($inserts_tot < $count)
	{
		$inserts[] = array(
			rand(0, 999) < 1 ? 1 : 0,
			rand($tables['smf_boards']['max'] + 1 + $cube_root + $cube_root**2, $tables['smf_boards']['max'] + $cube_root + $cube_root**2 + $tables['smf_boards']['add']),
			0,
			0,
			rand($tables['smf_members']['max'] + 1, $tables['smf_members']['max'] + $tables['smf_members']['add']),
			0,
			0,
			0,
			0,
			0,
			rand(35, 99999),
			0,
			0,
			1,
		);
		$inserts_tot++;
		$inserts_curr++;

		if (($inserts_curr >= $write_max) || ($inserts_tot >= $count))
		{
			$smcFunc['db_insert']('ignore',
				'smf_topics',
				array('is_sticky' => 'int', 'id_board' => 'int', 'id_first_msg' => 'int', 'id_last_msg' => 'int', 'id_member_started' => 'int', 'id_member_updated' => 'int', 'id_poll' => 'int', 'id_previous_board' => 'int', 'id_previous_topic' => 'int', 'num_replies' => 'int', 'num_views' => 'int', 'locked' => 'int', 'unapproved_posts' => 'int', 'approved' => 'int'),
				$inserts,
				array('id_topic'),
			);
			$inserts = array();
			$inserts_curr = 0;
		}
	}

	// OK, before we add those indexes back...  We gotta do some cleanup...
	// Fortunately, boards & messages already have their indexes back...
	$smcFunc['db_query']('',
		'UPDATE smf_boards b SET id_last_msg =
			(SELECT MAX(id_msg) FROM smf_messages m WHERE m.id_board = b.id_board)
		WHERE id_last_msg = 0;',
		array()
	);
	$smcFunc['db_query']('',
		'UPDATE smf_topics t SET id_last_msg =
			(SELECT MAX(id_msg) FROM smf_messages m WHERE m.id_topic = t.id_topic)
		WHERE id_last_msg = 0;',
		array()
	);
	$smcFunc['db_query']('',
		'UPDATE smf_topics t SET id_first_msg =
			(SELECT MIN(id_msg) FROM smf_messages m WHERE m.id_topic = t.id_topic)
		WHERE id_first_msg = 0;',
		array()
	);
	$smcFunc['db_query']('',
		'UPDATE smf_topics t SET num_replies =
			(SELECT COUNT(*) - 1 FROM smf_messages m WHERE m.id_topic = t.id_topic)
		WHERE num_replies = 0;',
		array()
	);
	$smcFunc['db_query']('',
		'UPDATE smf_messages m SET id_board =
			(SELECT id_board FROM smf_topics t WHERE t.id_topic = m.id_topic);',
		array()
	);
}
?>