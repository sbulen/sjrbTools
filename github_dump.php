<?php
/**
 *
 * A utility to dump github open issue & pr information.
 *
 * Usage guidelines:
 * (1) Run this file from your browser.
 * (2) Change owner & repo when prompted.
 * (3) github_dump.csv will be in the directory where it was launched.
 * (4) Delete this file when you're done.
 *     by sbulen
 *
 */

$site_title = 'GitHub Export Utility';
$db_needed = false;
$max_width = 1100;
$ui = new SimpleSmfUI($site_title, $db_needed, $max_width);

$ui->addChunk('Repo', function() use ($ui)
{
	$owner = 'SimpleMachines';
	$repo = 'SMF2.1';

	if (isset($_POST['owner']) && is_string($_POST['owner']))
		$owner = $ui->cleanseText($_POST['owner']);
	if (isset($_POST['repo']) && is_string($_POST['repo']))
		$repo = $ui->cleanseText($_POST['repo']);

	echo '<form>';
	echo 'Specify owner/repo:<br>';
	echo '<label for="owner">Owner: </label><input type="text" name="owner" value="' . $owner . '"><br>
	<label for="repo">Repo: </label><input type="text" name="repo" value="' . $repo . '"><br>';

	echo '<input type="submit" class="button" class="button" formmethod="post" value="Ok">';
	echo '</form>';

	$ui->githubAll = array();

	// startup curl
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_VERBOSE => true,
		CURLOPT_USERAGENT => 'xxx',	// Oddly, these are required and cannot be blank...
		CURLOPT_USERPWD => 'xxx',	// Oddly, these are required and cannot be blank...
		CURLOPT_HEADERFUNCTION =>
			function($curl, $header) use (&$gha_header)
				{
					$len = strlen($header);
					// Split header into field & val
					$pos = strpos($header, ':');
					if ($pos === false) {
						$field = trim($header);
						$val =  '';
					}
					else {
						$field = trim(substr($header, 0, $pos));
						$val =  trim(substr($header, $pos + 1));
					}
					// Discard that empty row...
					if (empty($field))
						return $len;
					// Make this one readable, translate from unix timestamp...
					if ($field == 'X-RateLimit-Reset')
						$val = gmdate('M d Y H:i:s', $val) . ' GMT';
					// Populate gha_header.  Allow for multiples, e.g., happens with Vary
					if (!array_key_exists($field, $gha_header))
						$gha_header[$field] = $val;
					else
						$gha_header[$field] .= ', ' . $val;
					return $len;
				},
	));

	// Loop thru all the pages - 100 rows at a time
	$ui->githubAll = array();
	$more = true;
	$page = 0;
	while ($more) {
		$more = false;
		$page++;

		// Init github API Header prior to each call
		$gha_header = array();
		curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/' . $owner . '/' . $repo . '/issues?per_page=100&page=' . $page);
		$githubAll_json = curl_exec($ch);
		curlErr($ch, $ui);

		// Save rate limit info
		if (isset($gha_header['X-RateLimit-Remaining']))
			$gh_calls_remaining = $gha_header['X-RateLimit-Remaining'];
		if (isset($gha_header['X-RateLimit-Reset']))
			$gh_calls_reset = $gha_header['X-RateLimit-Reset'];

		// Check status accessing repos
		if ((isset($gha_header['status']) && ($gha_header['status'] != '200 OK')) || (!isset($gha_header['status']) && !isset($gha_header['HTTP/2 200']) && !isset($gha_header['HTTP/1.1 200 OK']))) {
			if (isset($gh_calls_remaining))
				echo '<br>X-RateLimit-Remaining: ' . $gh_calls_remaining . '<br>';
			if (isset($gh_calls_reset))
				echo 'X-RateLimit-Reset: ' . $gh_calls_reset . '<br>';
			//Got some info on the failure???
			if (!empty($gha_header['Status']))
				$gh_error = $gha_header['Status'];
			elseif ($githubAll_json !== false)
			{
				// Sometimes helpful info in there...
				$gh_feedback = json_decode($githubAll_json, true);
				if (!empty($gh_feedback['message']))
					$gh_error = $gh_feedback['message'];
				else
					$gh_error = 'Unknown...';
			}
			else
				$gh_error = 'Unknown...';
			$ui->addError('<br>Error accessing Github repository: ' . $gh_error . '<br>');
			return;
		}

		// if next page link exists, there is more data to get & you have calls available to do so...
		if (!empty($gha_header['Link']) && strpos($gha_header['Link'], 'rel="next"') && !empty($gh_calls_reset))
			$more = true;

		// If successful response, dump it into an array
		if ($githubAll_json !== false)
			$ui->githubAll = array_merge($ui->githubAll, json_decode($githubAll_json, true));
	}
	curl_close($ch);

	// Put the header row in there...
	$githubTemp[0] = array(
				'type', 
				'number',
				'title',
				'login',
				'labels',
				'assignees',
				'milestone',
				'comments',
				'fixes issues',
				'issue milestones',
				'body',
				'created_at',
	);

	foreach($ui->githubAll as $row) {
		$githubTemp[$row['number']] = array(
			empty($row['pull_request']) ? 'Issue' : 'PR',
			$row['number'],
			$row['title'],
			$row['user']['login'],
			col2csv($row['labels'], 'name'),
			col2csv($row['assignees'], 'login'),
			isset($row['milestone']['title']) ? $row['milestone']['title'] : '',
			$row['comments'],
			'',		// populated later
			'',		// populated later
			$row['body'],
			substr($row['created_at'],0,10),
		);
	}
	$ui->githubAll = $githubTemp;

	//*** Find issues and issue milestones associated with PRs
	$pattern = '/(\/|#)(\d{1,8})/';

	// check whole table
	foreach($ui->githubAll as $ix => $row) {	
		//Look at each PR...
		if ($row[0] == 'PR') {
			// allow for multiple matches of #9999 or /9999 (when folks use links) in body of issue (10th field)
			preg_match_all($pattern, $row[10], $matches);
			foreach ($matches[2] AS $match) {
				// finally look for active issue entries
				if (array_key_exists($match, $ui->githubAll) && $ui->githubAll[$match][0] == 'Issue') {
					// add issue number
					if (empty($ui->githubAll[$ix][8]))
						$ui->githubAll[$ix][8] = $ui->githubAll[$match][1];
					else
						$ui->githubAll[$ix][8] .= ', ' . $ui->githubAll[$match][1];
					// add milestone info
					if (!empty($ui->githubAll[$match][6])) {
						if (empty($ui->githubAll[$ix][9]))
							$ui->githubAll[$ix][9] = $ui->githubAll[$match][6];
						else
							$ui->githubAll[$ix][9] .= ', ' . $ui->githubAll[$match][6];
					}
				}
			}
		}
	}

	// Done with the message body - delete it
	foreach($ui->githubAll AS $ix => $row)
		unset($ui->githubAll[$ix][10]);

	// Write output to .csv file
	$fp = @fopen('github_dump.csv', 'w');
	if ($fp === false)
		$ui->addError('Cannot open github_dump.csv');
	else
	{
		foreach($ui->githubAll AS $row)
			fputcsv($fp, $row);
		fclose($fp);
	}

});

$ui->addChunk('Issues & PRs (.csv export also provided)', function() use ($ui)
{
	if (count($ui->githubAll) == 1)
		echo 'No issues or PRs!<br>';
	else
		$ui->dumpTable($ui->githubAll);

});

$ui->go();

//*** Check for curl error
function curlErr($ch, $ui) {

	// Check for errors and display the error message
	if($errno = curl_errno($ch)) {
		$error_message = curl_strerror($errno);
		$ui->addError("cURL error ({$errno}):\n {$error_message}");
	}
	return;
}

//*** Pluck a column out of array into a comma delimited string
function col2csv($labels, $col) {

	$values = array_column($labels, $col);
	$lstring = implode(', ', $values);
	return $lstring;
}

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

		// DB...
		define('SMF', 1);
		define('SMF_VERSION', '2.x');
		define('SMF_FULL_VERSION', 'SMF ' . SMF_VERSION);
		define('SMF_SOFTWARE_YEAR', '2021');

		define('POSTGRE_TITLE', 'PostgreSQL');
		define('MYSQL_TITLE', 'MySQL');
		define('SMF_USER_AGENT', 'Mozilla/5.0 (' . php_uname('s') . ' ' . php_uname('m') . ') AppleWebKit/605.1.15 (KHTML, like Gecko)  SMF/' . strtr(SMF_VERSION, ' ', '.'));

		// These must remain globals when calling SMF funcs...
		global $smcFunc, $db_connection, $db_prefix, $db_name, $db_type, $sourcedir, $cachedir;
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
				min-width: 70px;
				max-width: 750px;
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
	 * @return string cleansed
	 */
	public function cleanseText($input)
	{
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
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
	}
}
