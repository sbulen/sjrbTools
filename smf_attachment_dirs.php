<?php
/**
 *
 * A utility to dump all attachment directory configuration information for an SMF forum, to help diagnose folder issues.
 *
 * **** SMF 2.1 & 3.0 ***
 *
 * Usage guidelines:
 * (1) Copy this file to your base SMF directory - (the one with Settings.php in it).
 * (2) Execute it from your browser.
 * (3) Delete this file when you're done.
 *     by sbulen
 *
 */

$site_title = 'SMF Attachment Directories';
$db_needed = true;
$max_width = 1300;
$ui = new SimpleSmfUI($site_title, $db_needed, $max_width);

$ui->addChunk('Settings', function() use ($ui)
{
	// First some settings...
	$dumpvars = array('mbname', 'boardurl', 'boarddir', 'db_server', 'db_name', 'db_prefix');

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

	// Finally some settings table stuff...
	$settings = array();
	$settings_lookup = array();
	$settings[0] = array('Variable','Value');
	$result = $ui->db->query('
		SELECT variable, value FROM ' . $ui->db->db_prefix . 'settings
		WHERE variable IN (\'smfVersion\', \'attachmentCheckExtensions\', \'attachmentDirSizeLimit\', \'attachmentEnable\', \'attachmentExtensions\', \'attachmentNumPerPostLimit\', \'attachmentPostLimit\', \'attachmentShowImages\', \'automanage_attachments\', \'attachmentSizeLimit\', \'basedirectory_for_attachments\', \'attachment_basedirectories\', \'attachmentUploadDir\')'
	);

	while ($row = $ui->db->fetch_assoc($result))
	{
		if (is_null($row['value']))
			$row['value'] = '<em>null</em>';
		elseif ($row['value'] === false)
			$row['value'] = '<em>false</em>';
		elseif ($row['value'] === true)
			$row['value'] = '<em>true</em>';

		$settings[] = $row;
		$settings_lookup[$row['variable']] = $row['value'];
	}

	// Ensure they were all set, by checking first column of $settings...
	foreach (array('smfVersion', 'attachmentCheckExtensions', 'attachmentDirSizeLimit', 'attachmentEnable', 'attachmentExtensions', 'attachmentNumPerPostLimit', 'attachmentPostLimit', 'attachmentShowImages', 'automanage_attachments', 'attachmentSizeLimit', 'basedirectory_for_attachments', 'attachment_basedirectories', 'attachmentUploadDir') AS $var)
	{
		if (!array_key_exists($var, $settings_lookup))
			$settings[] = array($var, '<strong>NOT SET</strong>');
	}

	// Save this off...
	if (isset($settings_lookup['smfVersion']))
		$ui->smfVersion = substr($settings_lookup['smfVersion'], 0, 3);

	$ui->dumpTable($settings);

});

$ui->addChunk('Attachment Directories - attachmentUploadDir Decoded', function() use ($ui)
{
	// Only for 2.1 & 3.0
	if (!isset($ui->smfVersion) || !in_array($ui->smfVersion, array('2.1', '3.0')))
	{
		$ui->addError('This utility only works for SMF 2.1 & 3.0.');
		return;
	}

	$result = $ui->db->query('
		SELECT value FROM ' . $ui->db->db_prefix . 'settings
		 WHERE variable = \'attachmentUploadDir\''
	);
	$att_dir_json = '';
	while ($row = $ui->db->fetch_assoc($result))
		$att_dir_json = $row['value'];

	$ui->db->free($result);

	// Decode as array
	$att_dirs = json_decode($att_dir_json, true);
	if (empty($att_dirs))
		$att_dirs = array();

	$folders = array();
	$folders[-1] = array('Folder ID', 'Folder', 'Valid Folder?');
	foreach ($att_dirs as $num => $dir)
	{
		$valid = file_exists($dir) && is_dir($dir);
		$folders[] = array($num, $dir, $valid ? 'True' : 'False');
	}

	$ui->dumpTable($folders);

	// Lop off the header & Save this off for lookups later...
	unset($folders[-1]);
	$ui->att_dirs = array();
	foreach ($folders as $folder)
		$ui->att_dirs[$folder[0]] = strtr($folder[1], '\\', '/');

	// Show count of attachments by folder
	$counts = array();
	$counts[] = array('Folder ID', 'Attachment Count in DB');
	$result = $ui->db->query('
		SELECT id_folder, count(*) as att_count FROM ' . $ui->db->db_prefix . 'attachments
		WHERE attachment_type != 1
		GROUP BY id_folder
		ORDER BY id_folder'
	);
	while ($row = $ui->db->fetch_assoc($result))
	{
		$row['att_count'] = number_format($row['att_count']);
		$counts[] = $row;
	}
	$ui->db->free($result);

	$ui->dumpTable($counts);
	echo 'Avatars excluded.<br>';

});

$ui->addChunk('Attachment Directories - File System', function() use ($ui)
{
	// Only for 2.1 & 3.0
	if (!isset($ui->smfVersion) || !in_array($ui->smfVersion, array('2.1', '3.0')))
		return;

	// Recursively return all directories under boarddir that have 'att' somewhere in dir name...
	function inspect_dir($dir, &$result)
	{
		$files = 0;
		$bytes = 0;
		foreach (glob($dir . '/*') as $entry)
		{
			if (is_dir($entry))
			{
				$result[] = inspect_dir($entry, $result);
			}
			else
			{
				$filename = basename($entry);
				if ($filename == 'index.php')
					continue;
				if (substr($filename, 0, 1) == '.')
					continue;
				$files++;
				$bytes += filesize($entry);
			}
		}
		$files = number_format($files);
		$bytes = number_format($bytes);
		return array($dir, $files, $bytes);
	}

	$folders = array();
	$folders[0] = array('Folders Found', 'Files', 'Size');
	foreach (glob($ui->getSettingsFile()['boarddir'] . '/att*', GLOB_ONLYDIR) as $dir)
		$folders[] = inspect_dir($dir, $folders);

	$ui->dumpTable($folders);
	echo 'index.php & files starting with a \'.\' are excluded.<br>';

});

$ui->addChunk('Comparing DB to File System', function() use ($ui)
{
	// Only for 2.1 & 3.0
	if (!isset($ui->smfVersion) || !in_array($ui->smfVersion, array('2.1', '3.0')))
		return;

	// Step 1: Get att info from db...  Exclude avatars...
	$result = $ui->db->query('
		SELECT id_attach, id_msg, filename, file_hash, size, id_folder, \'\' AS lookup FROM ' . $ui->db->db_prefix . 'attachments
		WHERE attachment_type != 1'
	);
	$db_atts = array();
	while ($row = $ui->db->fetch_assoc($result))
	{
		$row['size'] = number_format($row['size']);
		$db_atts[$row['id_attach']] = $row;
	}

	$ui->db->free($result);

	// Step 2: Get att info from file system...
	// Recursively return all files under all directories under boarddir that have 'att' somewhere in dir name...
	function inspect_files($dir, &$fs_atts)
	{
		foreach (glob($dir . '/*') as $entry)
		{
			if (is_dir($entry))
				inspect_files($entry, $fs_atts);
			else
			{
				$filename = basename($entry);
				if ($filename == 'index.php')
					continue;
				if (substr($filename, 0, 1) == '.')
					continue;
				if ($pos = strpos($filename, '_'))
					$id = (int) substr($filename, 0, $pos);
				else
					// Use whole fs entry, including dir, to ensure unique, even across folders, when attach id not found
					$id = $entry;
				// The key must include the entry to handle dupes w/same attach id; the index is the fs data
				$fs_atts[$id][$entry] = '';
			}
		}
	}

	$fs_atts = array();
	foreach (glob($ui->getSettingsFile()['boarddir'] . '/att*', GLOB_ONLYDIR) as $dir)
		inspect_files($dir, $fs_atts);

	// Step 3: Merge these two arrays
	$all_keys = array_merge(array_keys($db_atts), array_keys($fs_atts));
	$all_keys = array_unique($all_keys, SORT_NATURAL);
	asort($all_keys, SORT_NATURAL);
	$all_atts = array();
	$all_atts[0] = array('id_attach', 'id_msg', 'filename', 'file_hash', 'size (db)', 'id_folder', 'folder lookup', 'fs_folder', 'fs_filename', 'Error');

	// Step thru keys now, might be fs &/or db
	foreach ($all_keys as $id_attach)
	{
		if (key_exists($id_attach, $fs_atts))
		{
			// Possibly multiple files per attach, gotta loop
			foreach ($fs_atts[$id_attach] as $file => $dummy)
			{
				$fs_folder = strtr(dirname($file), '\\', '/');
				$fs_file = basename($file);
				$right = array($fs_folder, $fs_file);

				if (!key_exists($id_attach, $db_atts))
				{
					// No attach, orphan file (we know it's only one because use used full fs entry, including dir, as key)
					$left = array_fill(0, 7, ' - ');
					$err = 'No attachment record';
					$all_atts[] = array_merge($left, $right, array($err));
					// Bail, because the remaining edits compare to DB vals...
					continue;
				}

				// Ensure folder ID'd by id_folder matches what we see in the file system...
				$err = '';
				$left = $db_atts[$id_attach];
				$left['lookup'] = isset($ui->att_dirs[$left['id_folder']]) ? $ui->att_dirs[$left['id_folder']] : 'Invalid folder reference';
				if ($fs_folder != $left['lookup'])
					$err .= 'Incorrect folder';

				// Filename check...
				if ($fs_file != $id_attach . '_' . $db_atts[$id_attach]['file_hash'] . '.dat')
					$err .= (empty($err) ? '' : '; ') . 'Invalid filename';

				// Allow for adding 'dispall' to the URL to display all, including OK entries
				if (!empty($err) || isset($_REQUEST['dispall']))
					$all_atts[] = array_merge($left, $right, array($err));
			}
		}
		else
		{
			// DB key only - missing file (we know it's only one because attach ids are unique)
			$left = $db_atts[$id_attach];
			$left['lookup'] = isset($ui->att_dirs[$left['id_folder']]) ? $ui->att_dirs[$left['id_folder']] : 'Invalid folder reference';
			$right = array_fill(0, 2, ' - ');
			$err = 'Missing file';
			$all_atts[] = array_merge($left, $right, array($err));
		}

	}

	// Step 4: Display results...  Or dump to .csv...
	if ((count($all_atts) == 1) && !isset($_REQUEST['dispall']))
		echo '<br>No errors found!<br>';
	else
	{
		if (isset($_REQUEST['csv']))
		{
			// Give it a unique timestamp...
			$ts = date('YmdHis');
			$csv_file = $ui->getSettingsFile()['boarddir'] . '/smf_attdir_' . $ts. '.csv';
			$csv_url = $ui->getSettingsFile()['boardurl'] . '/smf_attdir_' . $ts. '.csv';

			$fp = fopen($csv_file, 'w');
			foreach ($all_atts as $row)
				fputcsv($fp, $row, ",", '"', '');
			fclose($fp);

			echo '<br>CSV file created for download: <a href="' . $csv_url . '">' . $csv_url . '</a><br>';
		}
		else
			$ui->dumpTable($all_atts);
	}
});

$ui->go();
/**
 * SimpleSmfUI
 *
 * A simple basic abstracted UI for utilities.
 *
 * Copyright 2021-2025 Shawn Bulen
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

// Create a minimal db layer...
class Ssui_Db
{
	/*
	 * Properties
	 */
	public $db_obj = null;
	// Helps handle pg_connect errors...
	public $pg_connect_error = '';
	public $db_type = '';
	public $db_prefix = '';
	public $db_name = '';

	/**
	 * Constructor
	 *
	 * Builds a SimpleSmfUI object
	 *
	 * @param string title
	 * @param bool db_needed
	 * @return void
	 */
	function __construct($db_type, $db_prefix, $db_character_set, $db_server, $db_user, $db_passwd, $db_name, $db_port)
	{
		// Some quick db parameter validations...
		$this->db_type = $db_type == 'postgresql' ? 'postgresql' : 'mysql';
		$this->db_prefix = empty($db_prefix) ? 'smf_' : $db_prefix;
		$this->db_name = empty($db_name) ? '' : $db_name;

		// pg...
		if ($this->db_type == 'postgresql')
		{
			// Since pg_connect doesn't feed error info to pg_last_error, we have to catch issues with a try/catch.
			set_error_handler(
				function($errno, $errstr)
				{
					throw new ErrorException($errstr, $errno);
				}
			);
			try
			{
				$this->db_obj = @pg_connect((empty($db_server) ? '' : 'host=' . $db_server . ' ') . 'dbname=' . $db_name . ' user=\'' . $db_user . '\' password=\'' . $db_passwd . '\'' . (empty($db_port) ? '' : ' port=\'' . $db_port . '\''));
			}
			catch (Exception $e)
			{
				// Make error info available to calling processes
				$this->pg_connect_error = $e->getMessage();
				$this->db_obj = null;
			}
			restore_error_handler();
		}
		// mysql...
		else
		{
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$this->db_obj = new mysqli($db_server, $db_user, $db_passwd, $db_name, $db_port);

			if (!$this->db_obj->connect_errno)
			{
				// Set names...
				if (!empty($db_character_set))
					$this->db_obj->set_charset($db_character_set);

				$this->db_obj->query('SET SESSION sql_mode = \'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION,PIPES_AS_CONCAT\'');
			}
		}
	}

	/**
	 * query
	 *
	 * @param string query
	 * @return pgsql\result | mysqli_result
	 */
	public function query($query_string)
	{
		// pg...
		if ($this->db_type == 'postgresql')
		{
			return pg_query($this->db_obj, $query_string);
		}
		// mysql...
		else
		{
			return $this->db_obj->query($query_string);
		}
	}

	/**
	 * fetch_assoc
	 *
	 * @param pgsql\result | mysqli_result
	 * @return array
	 */
	public function fetch_assoc($db_result)
	{
		// pg...
		if ($this->db_type == 'postgresql')
		{
			return pg_fetch_assoc($db_result);
		}
		// mysql...
		else
		{
			return $db_result->fetch_assoc();
		}
	}

	/**
	 * free
	 *
	 * @param pgsql\result | mysqli_result
	 * @return void
	 */
	public function free($db_result)
	{
		// pg...
		if ($this->db_type == 'postgresql')
		{
			pg_free_result($db_result);
		}
		// mysql...
		else
		{
			$db_result->free();
		}
	}

	/**
	 * escape_string
	 *
	 * @param string string
	 * @return string
	 */
	public function escape_string($string)
	{
		// pg...
		if ($this->db_type == 'postgresql')
		{
			return pg_escape_string($this->db_obj, $string);
		}
		// mysql...
		else
		{
			return $this->db_obj->real_escape_string($string);
		}
	}

	/**
	 * connect_error
	 *
	 * @return string
	 */
	public function connect_error()
	{
		// pg...
		if ($this->db_type == 'postgresql')
		{
			return $this->pg_connect_error;
		}
		// mysql...
		else
		{
			return $this->db_obj->connect_error;
		}
	}

	/**
	 * error
	 *
	 * @return string
	 */
	public function error()
	{
		// pg...
		if ($this->db_type == 'postgresql')
		{
			return pg_last_error($this->db_obj);
		}
		// mysql...
		else
		{
			return $this->db_obj->error;
		}
	}
}

// This oughtta hold us off until php 9.0...
#[\AllowDynamicProperties]
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

	public $db = null;

	/*
	 * SMF Properties
	 */
	public $settings_file;

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

				// Make the connection...
				$db_type = empty($db_type) ? 'mysql' : $db_type;
				$db_port = empty($db_port) ? null : $db_port;
				$db_character_set = empty($db_character_set) ? '' : $db_character_set;
				$this->db = new Ssui_Db($db_type, $db_prefix, $db_character_set, $db_server, $db_user, $db_passwd, $db_name, $db_port);

				if ($this->db->connect_error())
				{
					$this->addError('err_no_db', ' ' . $this->db->connect_error());
					// So subsequent steps know the DB isn't there...
					$this->db = null;
				}
			}
			else
				$this->addError('err_no_settings');
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
		if (!$this->db_needed || ($this->db_needed && !empty($this->db)))
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