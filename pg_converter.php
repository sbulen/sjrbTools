<?php
/**
 *
 * This utility reads a mysql export & preps it for pg load.
 * It does three things:
 *  - Maps single & double-quotes from mysql format to pg accepted format
 *  - Maps varbinary16 values, used in SMF for IP addresses, to pg inet format
 *  - Maps newlines back to newlines... mysqldump exports all newlines as the two characters: \n
 *
 * Prepwork: 
 *  - Install a vanilla version of SMF, same version as your source & get it fully working.  Truncate all tables.
 *  - Your source mysql SMF DB must be UTF8.
 *  - Your source mysql and target SMF DBs must have the exact same tables & columns.
 *  - If needed, create a copy of your source forum & delete all extraneous rows & columns and do the mysqldump from there.
 *
 * Overall Process - for use on Windows:
 * (1) Use the following command to do the export:
 *    mysqldump -u{user} -p{pass} --no-create-db --no-create-info --hex-blob --skip-add-locks --skip-comments --skip-set-charset --compact --skip-quote-names --complete-insert {dbname} > {myfile.sql}
 * (2) Run this utility, reading the mysqldump just created & creating a new .sql file
 * (3) Specify the $infile, $outfile & $path when prompted
 * (4) Open a command window
 * (5) Issue the following in the Windows command window (otherwise it assumes import is in Windows 1252, not utf8...):
 *    SET PGCLIENTENCODING=utf-8
 * (6) Log on to psql, connect to your new empty vanilla pg DB
 * (7) Load file with: \i mynewfile.sql
 * (8) After load, you must fix all the SEQUENCE #s...
 * (9) Run repair_settings.php to correct paths
 * (10) Copy over your attachments, avatars, custom avatars & smileys
 * (11) Clear your cache
 *
 * ***** SMF 2.1 ONLY *****
 * ***** Postgresql ONLY *****
 * 
 * Usage guidelines:
 * (1) Copy this file to your base SMF directory - (the one with Settings.php in it).
 * (2) Run this file from your browser.
 * (3) Change query prompts as needed.
 * (4) Delete this file when you're done.
 *     by sbulen
 *
 */

$site_title = 'SMF Pg Converter';
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

$ui->addChunk('Input and Output Files', function() use ($ui)
{
	global $db_type;

	// Ensure we are running pg...
	if (empty($db_type) || $db_type != 'postgresql')
	{
		$ui->addError('Database is not postgresql!');
		return;
	}

	$ui->infile = 'mysqldump.sql';
	$ui->outfile = 'pgdump.sql';
	$ui->path = __DIR__;

	if (isset($_SESSION['infile']) && is_string($_SESSION['infile']))
		$ui->infile = $ui->cleanseText($_SESSION['infile']);
	if (isset($_SESSION['outfile']) && is_string($_SESSION['outfile']))
		$ui->outfile = $ui->cleanseText($_SESSION['outfile']);
	if (isset($_SESSION['path']) && is_string($_SESSION['path']))
		$ui->path = $ui->cleanseText($_SESSION['path'], true);

	echo '<form>';
	echo '<label for="infile">Input file name: </label>';
	echo '<input type="text" name="infile" value="' . $ui->infile . '"><br>';
	echo '<label for="outfile">Output File name: </label>';
	echo '<input type="text" name="outfile" value="' . $ui->outfile . '"><br>';
	echo '<label for="path">Path: </label>';
	echo '<input type="text" name="path" value="' . $ui->path . '"><br>';
	echo '<input type="submit" class="button" class="button" formmethod="post" name="proceed" value="Ok">';
	echo '</form>';

});

$ui->addChunk('Convert Quotes & IPs', function() use ($ui)
{
	global $db_type, $db_connection;

	// Ensure we are running pg...
	if (empty($db_type) || $db_type != 'postgresql')
		return;

	// Only proceed if user hit that button
	if (empty($_SESSION['proceed']))
		return;

	$lines = 0;
	$bytes = 0;

	//open files 
	$file_in_handle = @fopen($ui->path . '/' . $ui->infile, 'r'); 
		if (!$file_in_handle)
		{
			$ui->addError('FATAL ERROR on opening input file...');
			return;
		};
	$file_out_handle = @fopen($ui->path . '/' . $ui->outfile, 'w'); 
		if (!$file_out_handle)
		{
			$ui->addError('FATAL ERROR on opening output file...');
			return;
		};
	echo("Files opened.<br><br>");

	// This "escape single quote" regex looks for a \' that is NOT itself preceded by a \ so the \ itself isn't being escaped...  
	// Note in php, \\\\ is required to represent a single real \...
	// Lots of strings ending in smileys end in \ thus \\' is valid & should be left alone...
	$esc_sq_regex = '~(?<!' . '\\\\' . ')(?>' . '\\\\' . '\')~';
	// OTOH... Sometimes \\\' is used to escape a single quote...  We need to xlate 1 & 3, but not 2...
	$esc3_sq_regex = '~(?>' . '\\\\' . '\\\\' . '\\\\' . '\')~';
	// Same two, but for double-quotes
	$esc_dq_regex = '~(?<!' . '\\\\' . ')(?>' . '\\\\' . '")~';
	$esc3_dq_regex = '~(?>' . '\\\\' . '\\\\' . '\\\\' . '")~';
	// This regex looks for a varbinary hex value...  e.g., 0x8B74E210, as used for IPs in SMF
	$bin_regex = '~(?<=\,|\()0x([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})(?=\,|\))~';

	// crlf fixer...  Look for a \r\n...
	$esc_crlf_regex = '~(?>' . '\\\\' . 'r' . '\\\\' . 'n)~';
	// Newline fixer...  Look for a \n, but not a \\n...
	$esc_nl_regex = '~(?<!' . '\\\\' . ')(?>' . '\\\\' . 'n)~';
	// Newline fixer...  Look for a \r, but not a \\r...
	$esc_cr_regex = '~(?<!' . '\\\\' . ')(?>' . '\\\\' . 'r)~';
	// Fix broken slashes - mysqldump will escape them, pg doesn't do that...
	// Find pairs of slashes with no preceeding slash...
	$esc_slash_regex = '~(?<!' . '\\\\' . ')(?>' . '\\\\' . '\\\\' . ')~';

	$matches = array();

	$sql = 'SHOW standard_conforming_strings';
	$result = pg_query($db_connection, $sql);
	list ($quote_option) = pg_fetch_row($result);
	echo "Postgresql standard_conforming_string setting: {$quote_option}<br><br>";

	if ($quote_option != 'on')
		$ui->addError('standard_conforming_strings should be on.');

	echo("Processing...");

	$options = pg_options($db_connection);
	print_r($options);

	$buffer = fgets($file_in_handle);
	while (!feof($file_in_handle))
	{ 
		$bytes = $bytes + strlen($buffer);
		$lines++;

		// Fix single quotes - \\\' to ''
		$buffer = preg_replace_callback(
			$esc3_sq_regex,
			function($matches) {
				return "''";
			},
			$buffer
		);

		// Fix single quotes - \' to '', but only if no preceding \
		$buffer = preg_replace_callback(
			$esc_sq_regex,
			function($matches) {
				return "''";
			},
			$buffer
		);

		// Fix double quotes - \\\" to "
		$buffer = preg_replace_callback(
			$esc3_dq_regex,
			function($matches) {
				return '"';
			},
			$buffer
		);

		// Fix double quotes - \" to ", but only if no preceding \
		$buffer = preg_replace_callback(
			$esc_dq_regex,
			function($matches) {
				return '"';
			},
			$buffer
		);

		// Convert varbinary16 to pg inet...
		$buffer = preg_replace_callback(
			$bin_regex,
			function($matches) {
				return '\'' . hexdec($matches[1]) . '.' . hexdec($matches[2]) . '.' . hexdec($matches[3]) . '.' . hexdec($matches[4]) . '\'';
			},
			$buffer
		);

		// Restore CRLF broken by mysqldump- \r\n to "\r\n"
		$buffer = preg_replace_callback(
			$esc_crlf_regex,
			function($matches) {
				return "\r";
			},
			$buffer
		);

		// Restore newlines broken by mysqldump- \n to "\n", but only if no preceding \
		$buffer = preg_replace_callback(
			$esc_nl_regex,
			function($matches) {
				return "\n";
			},
			$buffer
		);

		// Restore CR broken by mysqldump- \r to "\r", but only if no preceding \
		$buffer = preg_replace_callback(
			$esc_cr_regex,
			function($matches) {
				return "\r";
			},
			$buffer
		);

		// Restore backslashes broken by mysqldump- \\ to \
		$buffer = preg_replace_callback(
			$esc_slash_regex,
			function($matches) {
				return '\\';
			},
			$buffer
		);

		fwrite($file_out_handle, $buffer);
		$buffer = fgets($file_in_handle);
	};

	//close things out...
	fclose($file_in_handle); 
	fclose($file_out_handle); 
	echo("done.<br><br>");
	echo(" Bytes Read: " . $bytes . "<br>");
	echo(" Lines Read: " . $lines . "<br><br>");
	echo(" Completed!<br><br>");

});

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
