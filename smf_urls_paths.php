<?php
/**
 * A utility to change all URL and directory settings in settings & themes tables.
 * Does message bodies, personal messages, and member signatures as well.  
 * 
 * I use this utility to rapidly setup test environments, but with care, it can help with prod issues.
 * It may even help with https: conversions.  
 * 
 * This utility does not update the Settings.php file, in fact it uses its contents to 
 * connect to the DB.  I.e., run this *after* repair_settings.php to update all the other items
 * (mod settings, links in posts) that repair_settings.php does not update.  
 * 
 * To be used *** with extreme caution *** post migration to rapidly get up & running. 
 * 
 * ***** SMF 2.0 & 2.1 *****
 * ***** MySQL & Postgresql *****
 * 
 * Usage guidelines:
 * (1) Use at your own risk.
 * (2) ALWAYS run in your test environment first.
 * (3) ALWAYS backup your system first - expect the unexpected.
 * (4) Copy this file to your base SMF directory - (the one with Settings.php in it).
 * (5) Execute it from your browser.
 * (6) Change query prompts as needed.
 * (7) Run in Preview mode first.
 * (8) If things look good, click the Proceed button.
 * (9) Delete it when you're done.
 *     by sbulen
 */

$site_title = 'SMF URLs and Paths';
$db_needed = true;
$ui = new SimpleSmfUI($site_title, $db_needed);

$ui->addChunk('Settings', function() use ($ui)
{
	global $smcFunc, $db_connection, $db_type, $sourcedir;   // Must remain globals

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

$ui->addChunk('Specify URLs and Paths', function() use ($ui)
{
	// Starting values...
	$ui->oldURL = 'http://your/old/url';
	$ui->newURL = $ui->getSettingsFile()['boardurl'];

	$ui->oldDir = '/your/old/dir';
	$ui->newDir = $ui->getSettingsFile()['boarddir'];

	// If in session, use those......
	if (isset($_SESSION['oldurl']) && is_string($_SESSION['oldurl']))
		$ui->oldURL = $ui->cleanseText($_SESSION['oldurl']);
	if (isset($_SESSION['newurl']) && is_string($_SESSION['newurl']))
		$ui->newURL = $ui->cleanseText($_SESSION['newurl']);
	if (isset($_SESSION['olddir']) && is_string($_SESSION['olddir']))
		$ui->oldDir = $ui->cleanseText($_SESSION['olddir']);
	if (isset($_SESSION['newdir']) && is_string($_SESSION['newdir']))
		$ui->newDir = $ui->cleanseText($_SESSION['newdir']);

	echo '<form>';
	echo '<label for="oldurl">Old URL: </label>';
	echo '<input type="text" name="oldurl" value="' . $ui->oldURL . '"><br>';
	echo '<label for="newurl">New URL: </label>';
	echo '<input type="text" name="newurl" value="' . $ui->newURL . '"><br>';

	echo '<label for="olddir">Old dir: </label>';
	echo '<input type="text" name="olddir" value="' . $ui->oldDir . '"><br>';
	echo '<label for="newdir">New dir: </label>';
	echo '<input type="text" name="newdir" value="' . $ui->newDir . '"><br>';

	echo '<br><input type="submit" class="button" formmethod="post" name="preview" value="Preview?"><br>';
	echo '<br><input type="submit" class="button" formmethod="post" name="proceed" value="Proceed?"><br>';
	echo '</form>';

	// Some edits...
	if (empty($ui->oldURL))
	{
		unset($_SESSION['preview']);
		unset($_SESSION['proceed']);
		$ui->addError('Old URL is required.');
	}

	// Make sure empty means empty strings...
	if (empty($ui->newURL))
		$ui->newURL = '';
	if (empty($ui->oldDir))
		$ui->oldDir = '';
	if (empty($ui->newDir))
		$ui->newDir = '';

	// Dirs must be both empty or both provided...
	if ((empty($ui->newDir) && !empty($ui->oldDir)) || (!empty($ui->newDir) && empty($ui->oldDir)))
	{
		unset($_SESSION['preview']);
		unset($_SESSION['proceed']);
		$ui->addError('Dirs must be both empty or both provided.');
	}
});

$ui->addChunk('Results', function() use ($ui)
{
	if (empty($_SESSION['preview']) && empty($_SESSION['proceed']))
		return;

	if (!empty($_SESSION['proceed']))
		echo '<br><strong>Executing:</strong><br>';
	else
		echo '<br><strong>Preview:</strong><br>';

	doSettings($ui);
	doThemes($ui);
	doMessages($ui);
	doPMs($ui);
	doSignatures($ui);

	echo "<br>Path & URL updates completed!<br><br>";
});


//*** Do settings
function doSettings($ui)
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$sql = "SELECT variable, value FROM " . $db_prefix . "settings;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result))
	{
		$stringPos = mb_stripos($row['value'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $stringPos));
			$newval = str_ireplace($ui->oldURL, $ui->newURL, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newval = $smcFunc['db_escape_string']($newval);
				$sql = "UPDATE " . $db_prefix . "settings SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}

		if (empty($ui->oldDir))
			continue;
		$stringPos = mb_stripos($row['value'], $ui->oldDir);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $stringPos));
			$newval = str_ireplace($ui->oldDir, $ui->newDir, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newval = $smcFunc['db_escape_string']($newval);
				$sql = "UPDATE " . $db_prefix . "settings SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	$smcFunc['db_free_result']($result);
	return;
}

//*** Do themes
function doThemes($ui)
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$sql = "SELECT id_member, id_theme, variable, value FROM " . $db_prefix . "themes;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result))
	{
		$stringPos = mb_stripos($row['value'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Member: ', $row['id_member']);
			$settings[] = array('Theme: ', $row['id_theme']);
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $stringPos));
			$newval = str_ireplace($ui->oldURL, $ui->newURL, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newval = $smcFunc['db_escape_string']($newval);
				$sql = "UPDATE " . $db_prefix . "themes SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable']
					. "' AND id_member = '" . $row['id_member']
					. "' AND id_theme = '" . $row['id_theme'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}

		if (empty($ui->oldDir))
			continue;
		$stringPos = mb_stripos($row['value'], $ui->oldDir);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Member: ', $row['id_member']);
			$settings[] = array('Theme: ', $row['id_theme']);
			$settings[] = array('Variable: ', $row['variable']);
			$settings[] = array('Old Value: ', shortString($row['value'], $stringPos));
			$newval = str_ireplace($ui->oldDir, $ui->newDir, $row['value']);
			$settings[] = array('New Value: ', shortString($newval, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newval = $smcFunc['db_escape_string']($newval);
				$sql = "UPDATE " . $db_prefix . "themes SET value = '" . $newval
					. "' WHERE variable = '" . $row['variable']
					. "' AND id_member = '" . $row['id_member']
					. "' AND id_theme = '" . $row['id_theme'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	$smcFunc['db_free_result']($result);
	return;
}

//*** Do messages
function doMessages($ui)
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$sql = "SELECT id_msg, subject, body FROM " . $db_prefix . "messages;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result))
	{
		$stringPos = mb_stripos($row['body'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Message: ', $row['id_msg']);

			$settings[] = array('Old body: ', shortString($row['body'], $stringPos));
			$newbody = str_ireplace($ui->oldURL, $ui->newURL, $row['body']);
			$settings[] = array('New body: ', shortString($newbody, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newbody = $smcFunc['db_escape_string']($newbody);
				$sql = "UPDATE " . $db_prefix . "messages SET body = '" . $newbody
					. "' WHERE id_msg = '" . $row['id_msg'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
		$stringPos = mb_stripos($row['subject'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Message: ', $row['id_msg']);

			$settings[] = array('Old subject: ', shortString($row['subject'], $stringPos));
			$newsubject = str_ireplace($ui->oldURL, $ui->newURL, $row['subject']);
			$settings[] = array('New subject: ', shortString($newsubject, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newsubject = $smcFunc['db_escape_string']($newsubject);
				$sql = "UPDATE " . $db_prefix . "messages SET subject = '" . $newsubject
					. "' WHERE id_msg = '" . $row['id_msg'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	$smcFunc['db_free_result']($result);
	return;
}

//*** Do personal messages
function doPMs($ui)
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$sql = "SELECT id_pm, subject, body FROM " . $db_prefix . "personal_messages;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result))
	{
		$stringPos = mb_stripos($row['body'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('PM: ', $row['id_pm']);

			$settings[] = array('Old body: ', shortString($row['body'], $stringPos));
			$newbody = str_ireplace($ui->oldURL, $ui->newURL, $row['body']);
			$settings[] = array('New body: ', shortString($newbody, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newbody = $smcFunc['db_escape_string']($newbody);
				$sql = "UPDATE " . $db_prefix . "personal_messages SET body = '" . $newbody
					. "' WHERE id_pm = '" . $row['id_pm'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
		$stringPos = mb_stripos($row['subject'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('PM: ', $row['id_pm']);

			$settings[] = array('Old subject: ', shortString($row['subject'], $stringPos));
			$newsubject = str_ireplace($ui->oldURL, $ui->newURL, $row['subject']);
			$settings[] = array('New subject: ', shortString($newsubject, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newsubject = $smcFunc['db_escape_string']($newsubject);
				$sql = "UPDATE " . $db_prefix . "personal_messages SET subject = '" . $newsubject
					. "' WHERE id_pm = '" . $row['id_pm'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	$smcFunc['db_free_result']($result);
	return;
}

//*** Do signatures
function doSignatures($ui)
{
	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$sql = "SELECT id_member, member_name, signature FROM " . $db_prefix . "members;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result))
	{
		$stringPos = mb_stripos($row['signature'], $ui->oldURL);
		if ($stringPos !== false)
		{
			$settings = array();
			$settings[] = array('Member: ', $row['id_member']);
			$settings[] = array('Name: ', $row['member_name']);
			$settings[] = array('Old Signature: ', shortString($row['signature'], $stringPos));
			$newval = str_ireplace($ui->oldURL, $ui->newURL, $row['signature']);
			$settings[] = array('New Signature: ', shortString($newval, $stringPos));
			$ui->dumpTable($settings);

			if (!empty($_SESSION['proceed']))
			{
				$newval = $smcFunc['db_escape_string']($newval);
				$sql = "UPDATE " . $db_prefix . "members SET signature = '" . $newval
					. "' WHERE id_member = '" . $row['id_member'] . "';";
				$smcFunc['db_query']('', $sql);
			}
		}
	}
	$smcFunc['db_free_result']($result);
	return;
}

//*** For display purposes, return only relevant portion of a string (first chars near 1st instance of search string)
function shortString($targetStr, $stringPos)
{
	static $maxlen = 100;
	static $buffer = 10;
	$length = mb_strlen($targetStr);
	if ($length > $maxlen)
	{
		if ($stringPos > $buffer)
		{
			$stringPos = $stringPos - $buffer;
			$beforetext = '... ';
		}
		else
		{
			$stringPos = 0;
			$beforetext = '';
		}

		if ($length - $stringPos > $maxlen)
			$aftertext = ' ...';
		else
			$aftertext = '';

		$targetStr = $beforetext . mb_substr($targetStr, $stringPos, $maxlen) . $aftertext;
	}
	return $targetStr;
}

$ui->go();

/**
 * SimpleSmfUI
 *
 * A simple basic abstracted UI for utilities.
 *
 * Copyright 2021-2022 Shawn Bulen
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
