<?php 
// 
// A utility to dump github open issue & pr information.
//
// Usage guidelines:
// (1) Update User Configuration section below with info on your repo & user credentials.
// (2) Run it.
// (3) github_dump.csv will be in the directory where it was launched.
//     by sbulen
// 

//*** User Configuration
$owner = 'SimpleMachines';
$repo = 'SMF2.1';
$user = 'xxx';
$pwd = 'xxx';
//*** End User Configuration

//*** Main program
doStartup();
getInfo();
cleanUnusedColumns();
mapIssues();
exportInfo();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	global $owner, $repo;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>***********************************<br>");
	echo("******** Github export utility **********<br>");
	echo("***********************************<br><br>");

	echo("Owner: " . $owner . "<br>");
	echo("Repository: " . $repo . "<br><br>");

	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Get the full set of info from Github 
function getInfo() {

	global $githubAll, $user, $pwd, $owner, $repo;

	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_VERBOSE => true,
		CURLOPT_USERAGENT => $user,
		CURLOPT_USERPWD => $pwd,
		CURLOPT_HEADERFUNCTION =>
			function($curl, $header) use (&$more)
				{
					$len = strlen($header);
					$pos = strpos($header, ':');
					if ($pos === false) {
						$field = $header;
						$val =  '';
					}
					else {
						$field = substr($header, 0, $pos);
						$val =  trim(substr($header, $pos + 1));
					}

					// if next page link exists, there is more data to get...
					if ($field == 'Link' && strpos($val, 'rel="next"'))
						$more = true;
					// Display rate limit info
					if ($field == 'X-RateLimit-Remaining')
						echo $header . '<br>';
					if ($field == 'X-RateLimit-Reset')
						echo $field . ': ' . gmdate('M d Y H:i:s', $val) . ' GMT<br>';
					// Check status accessing repos
					if ($field == 'Status' && $val != '200 OK')
						die('<br>Error accessing Github repository: ' . $header . '<br>');
					return $len;
				},
	));

	// Loop thru all the pages - 100 rows at a time
	$githubAll = array();
	$more = true;
	$page = 0;
	while ($more) {
		$more = false;
		$page++;
		curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/' . $owner . '/' . $repo . '/issues?per_page=100&page=' . $page);
		$githubAll_json = curl_exec($ch);
		curlErr($ch);
		// If successful response, dump it into an array
		if ($githubAll_json !== false)
			$githubAll = array_merge($githubAll, json_decode($githubAll_json, true));
	}
	curl_close($ch);
	return;
}

//*** Way too much stuff, strip most of it...
function cleanUnusedColumns() {

	global $githubAll;

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

	foreach($githubAll as $row) {
		$githubTemp[] = array(
			empty($row['pull_request']) ? 'Issue' : 'PR',
			$row['number'],
			$row['title'],
			$row['user']['login'],
			col2csv($row['labels'], 'name'),
			col2csv($row['assignees'], 'login'),
			$row['milestone']['title'],
			$row['comments'],
			'',		// populated later
			'',		// populated later
			$row['body'],
			substr($row['created_at'],0,10),
		);
	}
	$githubAll = $githubTemp;
	return;
}

//*** Pluck a column out of array into a comma delimited string
function col2csv($labels, $col) {

	$values = array_column($labels, $col);
	$lstring = implode(',', $values);
	return $lstring;
}

//*** Find issues and issue milestones associated with PRs
function mapIssues() {

	global $githubAll;
	$pattern = '/(\/|#)(\d{1,8})/';

	// check whole table
	foreach($githubAll as $ix => $row) {	
		//Look at each PR...
		if ($row[0] == 'PR') {
			// allow for multiple matches of #9999 or /9999 (when folks use links) in body of issue (10th field)
			preg_match_all($pattern, $row[10], $matches);
			foreach ($matches[2] AS $match) {
				// finally look for active issue entries
				foreach($githubAll as $rowtemp) {
					if ($match == $rowtemp[1] && $rowtemp[0] == 'Issue') {
						// add issue number
						if (empty($githubAll[$ix][8]))
							$githubAll[$ix][8] = $rowtemp[1];
						else
							$githubAll[$ix][8] .= ', ' . $rowtemp[1];
						// add milestone info
						if (empty($githubAll[$ix][9]))
							$githubAll[$ix][9] = $rowtemp[6];
						else
							$githubAll[$ix][9] .= ', ' . $rowtemp[6];
					}
				}
			}
		}
	}

	// Done with the message body - delete it
	foreach($githubAll AS $ix => $row)
		unset($githubAll[$ix][10]);

	return;
}

// Dump to screen and to .csv
function exportInfo() {

	global $githubAll;

	dumpTable($githubAll);

	$fp = fopen('github_dump.csv', 'w');
	foreach($githubAll AS $row)
		fputcsv($fp, $row);
	fclose($fp);
	
	return;
}

//*** Check for curl error
function curlErr($ch) {

	// Check for errors and display the error message
	if($errno = curl_errno($ch)) {
		$error_message = curl_strerror($errno);
		die("cURL error ({$errno}):\n {$error_message}");
	}
	return;
}

//*** Wrap Up 
function doWrapUp() {

	echo "<br>Completed!<br><br>";

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
}

//*** Dump Table
// Takes a simple 2 dimensional array & dumps it in table format
function dumpTable($passedArray) {
	echo '<br><table border="1" cellpadding="3" frame="border" rules="all">';
	foreach($passedArray as $row) {
		echo '<tr><td>';
		echo implode('</td><td>', $row);
		echo '</td></tr>';
	}
	echo '</table><br>';
	@ob_flush();
	@flush();	
	return;
}

