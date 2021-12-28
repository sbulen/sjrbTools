<?php
/**
 * A utility to identify and correct double-encoding errors in message bodies & subjects in the SMF messages table.
 * It is intended to be used when you may have a mix of good utf8 data and double-encoded utf8 data.
 *
 * This actually attempts a conversion, & will apply the updates only if it looks safe (no ????s).
 * This utility also checks for 4-byte characters that have been double-encoded.  If found, they will 
 * be converted to htmlentities.  This is necessary because MySQL's UTF8 charset doesn't support them.
 *
 * This will help fix issues POST-UTF8 Conversion!  It is *not* to be used prior to UTF8 conversion.  
 * Also, make sure your $db_character_set in Settings.php is set to 'utf8', and your $db_type is 'mysql'.  
 *
 * This is based upon the excellent input found here:
 *      https://stackoverflow.com/questions/11436594/how-to-fix-double-encoded-utf8-characters-in-an-utf-8-table
 *
 * ***** SMF 2.0 & 2.1 *****
 * ***** MySQL ONLY *****
 * 
 * Usage guidelines:
 * (1) Use at your own risk.
 * (2) ALWAYS run in your test environment first.
 * (3) ALWAYS backup your system first - expect the unexpected.
 * (4) Copy this file to your base SMF directory - (the one with Settings.php in it).
 * (5) Execute it from your browser.
 * (6) Run in preview mode first.
 * (7) If things look good, click the Proceed button.
 * (8) Delete it when you're done.
 *     by sbulen
 */

$site_title = 'SMF Fix UTF8 Double Encoding';
$db_needed = true;
$ui = new SimpleSmfUI($site_title, $db_needed);

$ui->addChunk('Settings', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_type, $sourcedir, $db_character_set;

	// First some settings file stuff...
	$dumpvars = array('mbname', 'boardurl', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type', 'db_character_set', 'db_mb4');

	$settings = array();
	$settings[0] = array('Variable','Value');
	foreach($dumpvars AS $var)
	{

		if (!isset($ui->getSettingsFile()[$var]))
			$value = '<strong>NOT SET</strong>';
		elseif (is_null($ui->getSettingsFile()[$var]))
			$value = '<em>null</em>';
		elseif ($ui->getSettingsFile()[$var] === false)
			$value = '<em>false</em>';
		elseif ($ui->getSettingsFile()[$var] === true)
			$value = '<em>true</em>';
		else
			$value = $ui->getSettingsFile()[$var];

		$settings[] = array($var, $value);
	}
	$ui->dumpTable($settings);
});

$ui->addChunk('Preview or Proceed?', function() use ($ui)
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name, $db_character_set;

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

	$go_ahead = true;
	if ($db_character_set != 'utf8')
	{
		$ui->addError('$db_character_set not set properly!');
		$go_ahead = false;
	}
	if ($db_type != 'mysql')
	{
		$ui->addError('$db_type not mysql!');
		$go_ahead = false;
	}
	if (($body_charset != 'utf8') || ($subject_charset != 'utf8'))
	{
		$ui->addError('Charset not utf8!');
		$go_ahead = false;
	}
	if ($db_type != 'mysql')
	{
		$ui->addError('This utility is only needed for MySQL databases.');
		$go_ahead = false;
	}

	if ($go_ahead)
	{
		echo '<form>';
		echo '<br><input type="submit" class="button" formmethod="post" name="preview" value="Preview?"><br>';
		echo '<br><input type="submit" class="button" formmethod="post" name="proceed" value="Proceed?"><br>';
		echo '</form>';
	}
});

$ui->addChunk('Results', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_prefix;

	// Gotta hit a button...
	if (empty($_SESSION['preview']) && empty($_SESSION['proceed']))
		return;

	if (!empty($_SESSION['proceed']))
		echo '<br><strong>Executing:</strong><br>';
	else
		echo '<br><strong>Preview:</strong><br>';

	// Set STRICT mode - offers more protections against corrupting data; without STRICT mode, 
	// it may insert 'adjusted values', i.e., truncated data...  No bueno.  
	$mode = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
	mysqli_query($db_connection, 'SET SESSION sql_mode = \'' . $mode . '\'');

	// Prime the timer...
	$allTimer = microtime(true);

	// OK...  Do it...
	checkRecords();

	if (!empty($_SESSION['proceed']))
		echo '<br>Fixing UTF8 double encoding completed!<br>';
	else
		echo '<br>Checking for UTF8 double encoding completed!<br>';

	echo '<br>Elapsed time: ' . timer($allTimer) . '<br><br>';
});

//*** Main logic, time to go ahead & do it...
function checkRecords()
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$atatime = 20000;

	// First things first, add the column body_1206.
	// Note this is even needed for the analysis.
	// Skip errors in case this utility somehow failed earlier...
	$sql = 'ALTER TABLE {db_prefix}messages
		ADD COLUMN body_1206 MEDIUMBLOB NOT NULL';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'db_error_skip' => true,
		)
	);
	$sql = 'ALTER TABLE {db_prefix}messages
		ADD COLUMN subject_1206 BLOB NOT NULL';
	$result = $smcFunc['db_query']('', $sql,
		array(
			'db_error_skip' => true,
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
		findFixUTF8Issues($i, $atatime);
		$i++;
		if (!empty($_SESSION['proceed']) && $i <= $iterations)
		{
			echo 'Pausing to manage server load...';
			@ob_flush();
			@flush();
			sleep(3);
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
}

//*** Find 'em and fix 'em...
function findFixUTF8Issues($call, $atatime) {

	global $smcFunc;

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
	if (!empty($fixthese) && !empty($_SESSION['proceed']))
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

$ui->go();

/**
 * SimpleSmfUI
 *
 * A simple basic abstracted UI for utilities.
 *
 * Copyright 2021 Shawn Bulen
 *
 * This file is part of the sjrbTools library.
 *
 * SimpleSmfUI is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SimpleSmfUI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SimpleSmfUI.  If not, see <https://www.gnu.org/licenses/>.
 *
 */

class SimpleSmfUI
{
	/*
	 * Properties
	 */
	protected $site_title = 'Simple UI';
	protected $max_width = 1200;
	protected $db_needed;
	protected $txt = array(
		'err_no_title' => 'Site title is required and must be a string!',
		'err_width' => 'Funky width specified!',
		'err_no_settings' => 'Could not find Settings.php!  Place this file in the same folder as Settings.php.',
		'err_no_db' => 'Could not establish connection with the database!',
		'err_no_chunk_title' => 'Invalid chunk title!',
		'err_no_chunk_func' => 'Invalid chunk function!',
		'errors' => 'Errors',
	);
	protected $chunks = array();
	protected $errors = array();

	/*
	 * SMF Properties
	 */
	protected $settings_file;

	/**
	 * Constructor
	 *
	 * Builds a SimpleSmfUI object
	 *
	 * @param string title
	 * @param bool db_needed
	 * @return void
	 */
	function __construct($title, $db_needed = null, $max_width = 800)
	{
		// Might as well try...
		@set_time_limit(6000);
		@ini_set('memory_limit', '512M');

		// Title...
		if (is_string($title))
			$this->site_title = $title;
		else
			$this->addError('err_no_title');

		// db_needed...
		if (empty($db_needed))
			$this->db_needed = false;
		else
			$this->db_needed = true;

		// Width...
		if (is_numeric($max_width))
			$this->max_width = $max_width;
		else
			$this->addError('err_width');

		// Error handler
		// Note that php error suppression - @ - still calls the error handler.  It will return 0 as it does so (pre php8).
		// Note error handling in php8+ no longer fails silently on many errors, but error_reporting()
		// will return 4437 (E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR | E_PARSE)
		// as it does so.
		set_error_handler(
			function($errno, $errstr, $errfile, $errline)
			{
				if ((error_reporting() != 0) && (error_reporting() != (E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR | E_PARSE)))
					$this->addError($errstr . ' (' . $errno . ')');
				// Always try & report errors gracefully...
				return true;
			}
		);

		// DB...
		define('SMF', 1);
		define('SMF_VERSION', '2.x');
		define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
		define('SMF_SOFTWARE_YEAR', '2021');

		define('POSTGRE_TITLE', 'PostgreSQL');
		define('MYSQL_TITLE', 'MySQL');
		define('SMF_USER_AGENT', 'Mozilla/5.0 (' . php_uname('s') . ' ' . php_uname('m') . ') AppleWebKit/605.1.15 (KHTML, like Gecko)  SMF/' . strtr(SMF_VERSION, ' ', '.'));

		// These must remain globals when calling SMF funcs...
		global $smcFunc, $db_connection, $db_prefix, $db_name, $db_type, $sourcedir, $cachedir, $db_character_set;
		$smcFunc = array();
		$this->settings_file = array();

		if ($this->db_needed)
		{
			// Load & save off settings file contents
			if (file_exists('Settings.php'))
			{
				include_once('Settings.php');
				$dumpvars = array('mbname', 'db_server', 'db_name', 'db_prefix', 'db_type', 'db_character_set', 'db_mb4', 'language',
					'boardurl', 'boarddir', 'sourcedir', 'packagesdir', 'tasksdir', 'cachedir',
					'maintenance', 'mtitle', 'mmessage',
					'cookiename', 'db_persist', 'db_error_send',
					'cache_accelerator', 'cache_enable', 'cache_memcached',
					'image_proxy_enabled', 'image_proxy_secret', 'image_proxy_maxsize');

				foreach($dumpvars as $setting)
					$this->settings_file[$setting] = (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>');
			}
			else
				$this->addError('err_no_settings');

			if (!empty($sourcedir))
			{
				// Get the database going!
				if (empty($db_type) || $db_type == 'mysqli')
					$db_type = 'mysql';

				// Make the connection...
				require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
				$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

				if (empty($db_connection))
					$this->addError('err_no_db');

				// Set names...
				if (!empty($db_character_set))
					$smcFunc['db_query']('', '
						SET NAMES {string:db_character_set}',
						array(
							'db_character_set' => $db_character_set,
						)
					);
			}
		}
	}

	/**
	 * Render chunk
	 *
	 * Display one portion of the form
	 *
	 * @return void
	 */
	protected function doChunk($ix, $chunk)
	{
		echo '<section>';	// sections needed to narrow scope of expand/collapse action
		echo '<input type="checkbox" name="collapse" checked id="chunk' . $ix . '">
			<div class="chunkhdr">
				<label for="chunk' . $ix . '">' . $chunk['title'] . '</label>
			</div>
			<div class="content_nopad">
			<div class="content">';

		$chunk['function']();

		echo '</div></div>';
		echo '</section>';
	}

	/**
	 * Display errors
	 *
	 * Display errors in current display area
	 *
	 * @return void
	 */
	protected function renderErrors()
	{
		echo '<div id="errhdr">' . $this->txt['errors'] . '</div>
			<div class="content_nopad">
			<div class="content">';

		foreach ($this->errors AS $error)
			echo $error . '<br>';

		echo '</div></div>';
	}

	/**
	 * Render header
	 *
	 * Spits out the head, title, style & starts the body
	 *
	 * @return void
	 */
	protected function renderHeader()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<meta charset="utf-8">
		<title>' . $this->site_title . '</title>
		<style type="text/css">
			body
			{
				padding: 12px 0px 0px 0px;
				font-family: "Roboto", sans-serif;
				background-color: rgb(242,242,242);
				max-width: ' . $this->max_width . 'px;
				margin: 0 auto;
				box-shadow: 2px 2px 2px 2px rgb(220,220,220);
				border-bottom: 1px solid rgb(170,170,170);
			}

			#header
			{
				padding: 4px 4% 4px 4%;
				background-color: rgb(54,126,189);
				font-family: "Roboto", sans-serif;
				font-size: x-large;
				height: 30px;
				vertical-align: middle;
				text-align:center;
				border-bottom: 1px solid rgb(58,123,155);
			}

			.content_nopad
			{
				background: linear-gradient(180deg, rgb(190,190,190) 0%, rgb(252,252,252) 5px);
			}

			.content
			{
				padding: 10px 10px 10px 10px;
				font-size: small;
			}

			#nametag
			{
				font-family: "Roboto", sans-serif;
				font-size: smaller;
				color: rgb(122,132,134);
				background-color: rgb(252,252,252);
				text-align: right;
				display: inline-block;
				width: 50%;
			}

			#warningtag
			{
				font-family: "Roboto", sans-serif;
				font-size: smaller;
				color: rgb(122,132,134);
				background-color: rgb(252,252,252);
				text-align: left;
				display: inline-block;
				width: 50%;
			}

			.chunkhdr
			{
				padding: 4px 4% 4px 4%;
				background-color: rgb(0,153,204);
				font-family: "Roboto", sans-serif;
				font-size: large;
				height: 25px;
				vertical-align: middle;
				text-align:center;
				border-bottom: 1px solid rgb(89,154,187);
			}

			.chunkhdr label
			{
				display: inline-block;
				width: 100%;
			}

			.chunkhdr:hover,
			.chunkhdr:focus
			{
				background: rgb(76,175,208);
			}

			input[name="collapse"]:not(:checked) ~ .content_nopad
			{
				display: none;
			}

			input[name="collapse"]
			{
				display: none;
			}

			.chunkhdr label:before {
				content: "▲";
				display: inline-block;
				float: left;
				vertical-align: middle;
				color: rgb(54,126,189);
			}

			input[name="collapse"]:not(:checked) ~ .chunkhdr label:before
			{
				transform: rotate(180deg);
				transform-origin: center;
			}

			#errhdr
			{
				padding: 4px 4% 4px 4%;
				background-color: rgb(230,130,130);
				font-family: "Roboto", sans-serif;
				font-size: large;
				height: 25px;
				vertical-align: middle;
				text-align:center;
			}

			input[type=text], select
			{
				width: 85%;
				height: 25px;
				margin: 4px 0px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			.button
			{
				padding: 1px 1px;
				text-align: center;
				width: 100px;
				box-shadow: 1px 1px 1px 1px rgb(210,210,210);
			}

			.sui_table
			{
				display: table;
				table-layout:fixed;
				border-collapse: collapse;
				border-spacing: 0;
				padding: 0px;
				border: 1px solid #ccc;
				text-align: left;
				vertical-align: top;
				white-space: normal;
				word-break: break-word;
				font-weight: normal;
				font-variant: normal;
				color: inherit;
			}

			.sui_row
			{
				display: table-row;
			}

			.sui_row_red
			{
				display: table-row;
				background-color: rgb(230,130,130);
			}

			.sui_row_green
			{
				display: table-row;
				background-color: #42ddcf;
			}

			.sui_row_header
			{
				display: table-header-group;
				font-weight: bold;
				color: rgb(46,96,140);
			}

			.sui_cell
			{
				border: 1px solid #ccc;
				display: table-cell;
				padding: 2px;
				min-width: 80px;
				max-width: 750px;
			}

			.sui_cell_yellow
			{
				border: 1px solid #ccc;
				display: table-cell;
				padding: 2px;
				min-width: 80px;
				max-width: 750px;
				background-color: #f7f793;
			}
		</style>
		</head>
		<body>
		<div id="header">' . $this->site_title . '
		</div>';
	}

	/**
	 * Render header
	 *
	 * Closes out the body & html tags
	 *
	 * @return void
	 */
	protected function renderFooter()
	{
		// Close out body & html tags
		echo '<div id="warningtag">Remove when not in use</div>';
		echo '<div id="nametag">sbulen/sjrbTools</div>';
		echo '</body>
		</html>';
	}

	/**
	 * Cleanse text
	 *
	 * Some basic hygiene for user-entered input
	 *
	 * @param string input
	 * @param bool gtlt - whether to leave > and < alone (e.g., for queries)
	 * @return string cleansed
	 */
	public function cleanseText($input, $gtlt = false)
	{
		$input = trim($input);
		$input = htmlspecialchars($input);
		if ($gtlt)
		{
			$input = str_replace('&gt;', '>', $input);
			$input = str_replace('&amp;gt;', '>', $input);
			$input = str_replace('&lt;', '<', $input);
			$input = str_replace('&amp;lt;', '<', $input);
		}
		return $input;
	}

	/**
	 * Dump table
	 *
	 * Render a simple 2-d array in table form
	 *
	 * @param array passed_array
	 * @return void
	 */
	public function dumpTable($passed_array)
	{
		static $special_cells = array('<strong>NOT SET</strong>', '<em>null</em>', '<em>true</em>', '<em>false</em>');

		$header = true;
		echo '<br><div class="sui_table">';
		foreach($passed_array as $row)
		{
			// Some cleansing...
			foreach ($row AS $ix => $cell)
			{
				// Treat NOT SET, null, true, & false special...
				if (in_array($cell, $special_cells))
					$row[$ix] = $cell;
				else
				{
					$row[$ix] = htmlspecialchars($cell);
					// Undo any line breaks you just broke...
					$row[$ix] = str_replace('&lt;br&gt;', '<br>', $row[$ix]); 
					$row[$ix] = str_replace('&lt;br /&gt;', '<br>', $row[$ix]); 
				}
			}
			if ($header)
				echo '<div class="sui_row_header">';
			else
				echo '<div class="sui_row">';
			echo '<div class="sui_cell">';
			echo implode('</div><div class="sui_cell">', $row);
			echo '</div></div>';
			$header = false;
		}
		echo '</div><br>';
	}

	/**
	 * Add Chunk
	 *
	 * Adds an entry to the internal chunk array.
	 * Each chunk will display a header, do some logic, & display some content.
	 * If errors are encountered, ideally they should be added to the errors display and displayed at the end.
	 *
	 * @param string title - title to display above this chunk
	 * @param function logic - what to execute, passed as an anonymous function
	 * @return void
	 */
	public function addChunk($title, $func)
	{
		if (!is_string($title))
		{
			$title = '';
			$this->addError('err_no_chunk_title');
		}

		if (!is_callable($func))
		{
			$func = function() {};
			$this->addError('err_no_chunk_func');
		}

		$this->chunks[] = array('title' => $title, 'function' => $func);
	}

	/**
	 * Get Settings File contents
	 *
	 * @return array
	 */
	public function getSettingsFile()
	{
		return $this->settings_file;
	}

	/**
	 * Add Error
	 *
	 * Add error to internal log
	 *
	 * @param string key - is key to $txt array
	 * @param string more - is additional info to be added to output string if needed
	 * @return void
	 */
	public function addError($key, $more = '')
	{
		if (!is_string($key))
			$key = '';

		if (!is_string($more))
			$more = '';

		if (!empty($this->txt[$key]))
			$key = $this->txt[$key];

		$this->errors[] = $key . ' ' . $more;
	}

	/**
	 * Go
	 *
	 * Got everything, now do it...
	 *
	 * @return void
	 */
	public function go()
	{
		global $db_connection;

		// Responding to a POST? Cleanse info, put in session and redirect
		session_start();
		if ($_POST)
		{
			$_SESSION = array();
			foreach($_POST as $var => $val)
				$_SESSION[$this->cleanseText($var)] = $this->cleanseText($val);
			
			// Redirect to this page
			header("Location: {$_SERVER['REQUEST_URI']}", true, 302);
			exit();
		}

		// OK, display stuff...
		$this->renderHeader();

		// Execute the chunks...
		// Note if db_needed & no connection, do not process chunks, just display the errors
		if (!$this->db_needed || ($this->db_needed && !empty($db_connection)))
		{
			foreach($this->chunks AS $ix => $chunk)
				$this->doChunk($ix, $chunk);
		}

		// Display any errors...
		if (!empty($this->errors))
			$this->renderErrors();

		$this->renderFooter();

		// Ensure refreshes actually refresh!
		$_SESSION = array();
	}
}
