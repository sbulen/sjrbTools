<?php 
// 
// An utility to scan a local git repo & build xml package files.
//
// ***** Windows assumed *****
//
// Usage guidelines:
// (1) Your git/bin must be in your environment PATH
// (2) Set the user config variables below.
// (3) Execute this file from your browser.
// (4) Some info will be displayed in your browser, which files were updated, etc.
// (5) Xml files will be in the directory where this was launched.  
//       *** They will be overwritten with each execution!!! ***
//     by sbulen
// 
// This version always attempts 0 lines of context & builds searches up from there.
// This was based on comparison to successful patches, that were very granular in their searches/replaces
// and had far fewer conflicts with mods.
//

//*** Start user config - these parameters are all required
$repo_path = 'D:/EasyPHP/Git/SMF2.0';
$repo_master_branch = 'master';
$repo_prior_release_commit = 'v2.0.15';
$repo_this_release_commit = 'HEAD';
$new_version_txt = '2.0.16';
// Only display changes; if false will also list all files looked at
$only_display_changes = true;
// Audit will display info on each variant of lines of context & direction (up/down) tested
$audit = true;
// $override is an optional parameter...
// Override is intended to be used ONLY if you find there are conflicts
// It is an array which associates files with a set of snippet/direction pairs
// For direction, up is TRUE and down is FALSE
// For example, to ONLY look UP for index.php, snippet 4:
//     $override = array('index.php' => array(4 => TRUE));
$override = array('index.php' => array(4 => TRUE));
//*** End user config

//*** Main program
doStartup();
navFileSystem($repo_path);
doWrapUp();
return;

//*** Startup 
function doStartup() {

	global $repo_path, $repo_master_branch, $new_version_txt, $rundir;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>**********************************<br>");
	echo("******* SMF gen package xml ********<br>");
	echo("**********************************<br>");

	define('SMF', 1);

	// Set path to your repo path & checkout your main branch
	chdir($repo_path);

	echo '<pre>';
	$cmd = "git checkout {$repo_master_branch}";
	echo $cmd . '<br>';
	echo `{$cmd} 2>&1` . '<br>';

	// Capture the run dir for output
	$rundir = (__DIR__);

	// Empty out prior files...
	$file = $rundir . '/smf_' . $new_version_txt . '_patch.xml';
	$fp = fopen($file, "w");
	fclose($fp);
	$file = $rundir . '/package-info.xml';
	$fp = fopen($file, "w");
	fclose($fp);
	
	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Navigate file system recursively looking for files to gen XML info for...
function navFileSystem($dir) {

	$files = scandir($dir);

	foreach($files as $key => $value){
		// Bypass all the "hidden" .git files, folders & also . & ..
		// Also bypass the /other folder & the changelog.txt file
		$path = $dir . DIRECTORY_SEPARATOR . $value;
		if($value[0] != "."  && $value != 'other' && $value != 'changelog.txt')
			if(!is_dir($path))
				checkFile($path);
			else
				navFileSystem($path);
	}

	return;
}

//*** Check individual file
function checkFile($file) {

	global $repo_path, $repo_prior_release_commit, $repo_this_release_commit, $only_display_changes, $audit;

	// Strip repo root path...
	$file = substr($file, strlen($repo_path) + 1);

	// -U# tells git how much context to provide.
	// Don't want color affecting text anyhow (haven't seen it, but still concerns me...)
	$cmd = "git diff -U0 --no-color {$repo_prior_release_commit} {$repo_this_release_commit} {$file}";
	$result = `{$cmd}`;
	if (!empty($result))
	{
		processDiff($file, $result);
		echo $file . ' <strong><em>DONE!!!</em></strong><br>';
	}
	else
		if (!$only_display_changes)
			echo $file . ' - no change.<br>';

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
}

//*** Figure out what to do with each diff
function processDiff($file, $diff) {

	global $repo_prior_release_commit, $repo_this_release_commit, $oldfilestr, $oldfilearr, $newfilestr;

	// Git wants unix style, not win style...
	$file = strtr($file, '\\', '/');

	// Save off file as git knows it...
	$gitfile = $file;

	// Prep file name
	if (!strncasecmp($file, 'Themes/default/images/', 22))
	{
		$dir = '$imagesdir';
		$file = substr($file, 22);
	}
	elseif (!strncasecmp($file, 'Themes/default/languages/', 25))
	{
		$dir = '$languagedir';
		$file = substr($file, 25);
	}
	elseif (!strncasecmp($file, 'Themes/default/', 15))
	{
		$dir = '$themedir';
		$file = substr($file, 15);
	}
	elseif (!strncasecmp($file, 'Themes/', 7))
	{
		$dir = '$themes_dir';
		$file = substr($file, 7);
	}
	elseif (!strncasecmp($file, 'Sources/', 8))
	{
		$dir = '$sourcedir';
		$file = substr($file, 8);
	}
	elseif (!strncasecmp($file, 'Avatars/', 8))
	{
		$dir = '$avatardir';
		$file = substr($file, 8);
	}
	elseif (!strncasecmp($file, 'Smileys/', 8))
	{
		$dir = '$smileysdir';
		$file = substr($file, 8);
	}
	else
	{
		$dir = '$boarddir';
	}

	// Load up old & new versions of the file...
	$cmd = "git show {$repo_prior_release_commit}:{$gitfile}";
	$oldfilestr = `{$cmd}`;
	$oldfilearr = explode("\n", $oldfilestr);
	$cmd = "git show {$repo_this_release_commit}:{$gitfile}";
	$newfilestr = `{$cmd}`;

	// Split it up!
	$snippets = parseDiff($diff, $file);

	// Determine appropriate action for each snippet
	$snippets = determineAction($snippets, $file);

	// Make sure searches work & are unique
	// position=before/after may be updated here
	$snippets = unambiguate($snippets, $file);

	// New files have one row with an action of 'new file'
	if ($snippets[0]['action'] == 'new file')
		addFile($dir, $file);
	else
		buildFileOps($dir, $file, $gitfile, $snippets);

	return;
}

//*** Figure out if we're going to do a position=replace, end, before, etc...
function determineAction($snippets, $file) {

	global $oldfilearr;

	foreach ($snippets AS $ix => $snippet)
	{
		// Leave any pre-ordained ones alone (new files...)
		if (!empty($snippet['action']))
			continue;
		// Both present - a clear replace
		elseif (!empty($snippet['removelines'] && !empty($snippet['addlines'])))
		{
			$snippets[$ix]['action'] = 'replace';
		}
		// Remove lines via replace
		elseif (!empty($snippet['removelines']))
		{
			$snippets[$ix]['action'] = 'replace';
		}
		// SMF package oddity - it doesn't like just inserting line feeds, whitespace, etc...
		// So force it to replace mode if only whitespace.
		elseif (empty(trim($snippet['addlines'])))
		{
			$snippets[$ix]['action'] = 'replace';
		}
		// Adding lines - if at the bottom, do an 'end', otherwise, default as a 'before' for now
		// Position="end" if change starts on the \?\>...
		elseif (!empty($snippet['addlines']))
		{
			if (isset($oldfilearr[$snippet['linestart']]) && trim($oldfilearr[$snippet['linestart']]) == '?>')
				$snippets[$ix]['action'] = 'end';
			else
				$snippets[$ix]['action'] = 'before';
		}
		else
		{
			echo $file . ': ******************************* I\'m confused ****************************<br>';
		}
	}

	return $snippets;
}

//*** addFile
function addFile($dir, $file) {

	global $rundir;

	// Open append...
	$output = $rundir . '/package-info.xml';
	$fp = fopen($output, "a");

	// New file to be copied...
	fwrite($fp, "\t\t" . '<require-file name="' . $file . '" destination="' . $dir . '">' . $file . '</require-file>' . "\n");

	fclose($fp);

	return;
}

//*** Build syntax for the xml file operations
function buildFileOps($dir, $file, $gitfile, $snippets) {

	global $rundir, $new_version_txt;

	// Open append...
	$output = $rundir . '/smf_' . $new_version_txt . '_patch.xml';
	$fp = fopen($output, "a");

	// File header info...
	fwrite($fp, "\t" . '<!-- ' . $new_version_txt . ' updates for ' . $file . ' -->' . "\n");
	fwrite($fp, "\t" . '<file name="' . $dir . '/' . $file . '">' . "\n");

	foreach ($snippets AS $snippet)
	{
		// If it contains CDATA, you can't use CDATA...
		if (stripos($snippet['removelines'], '<![CDATA[') !== false || stripos($snippet['removelines'], ']]>') !== false || stripos($snippet['addlines'], '<![CDATA[') !== false || stripos($snippet['addlines'], ']]>') !== false)
		{
			$snippet['removelines'] = htmlspecialchars($snippet['removelines']);
			$snippet['addlines'] = htmlspecialchars($snippet['addlines']);
			$before = '';
			$after = '';
			echo $file . ' ***** CDATA NOT USED *****<br>';
		}
		else
		{
			$before = '<![CDATA[';
			$after = ']]>';
		}

		// Spit it out
		fwrite($fp, "\t\t" . '<operation>' . "\n");
		if ($snippet['action'] == 'end')
			fwrite($fp, "\t\t\t" . '<search position="end"/>' . "\n");
		else
			fwrite($fp, "\t\t\t" . '<search position="' . $snippet['action'] . '">' . $before . $snippet['removelines'] . $after . '</search>' . "\n");
		fwrite($fp, "\t\t\t" . '<add>' . $before . $snippet['addlines'] . $after . '</add>' . "\n");
		fwrite($fp, "\t\t" . '</operation>' . "\n");
	}

	fwrite($fp, "\t" . '</file>' . "\n\n");
	fclose($fp);

	return;
}

//*** parseDiff
function parseDiff($diff, $file) {

	$diff = explode("\n", $diff);
	$chunk = -1;

	foreach ($diff AS $line)
	{
		// Don't need these
		if (in_array(substr($line, 0, 3), array('---', '+++', 'dif', 'ind')))
			continue;

		// If the file is new, don't need to look at the details
		if (substr($line, 0, 8) == 'new file')
		{
			$parsed[0]['removelines'] = '';
			$parsed[0]['addlines'] = '';
			$parsed[0]['action'] = 'new file';
			break;
		}

		// If it's telling you that the prior text had no newline, strip it...
		if (substr($line, 0, 12) == '\ No newline')
		{
			if ($prior == ' ')
			{
				$parsed[$chunk]['removelines'] = substr($parsed[$chunk]['removelines'], 0, strlen($parsed[$chunk]['removelines']) - 1);
				$parsed[$chunk]['addlines'] = substr($parsed[$chunk]['addlines'], 0, strlen($parsed[$chunk]['addlines']) - 1);
			}
			elseif ($prior == '-')
			{
				$parsed[$chunk]['removelines'] = substr($parsed[$chunk]['removelines'], 0, strlen($parsed[$chunk]['removelines']) - 1);
			}
			elseif ($prior == '+')
			{
				$parsed[$chunk]['addlines'] = substr($parsed[$chunk]['addlines'], 0, strlen($parsed[$chunk]['addlines']) - 1);
			}
			continue;
		}

		// Process the actual diff
		if (substr($line, 0, 2) == '@@')
		{
			$chunk++;
			$parsed[$chunk]['removelines'] = '';
			$parsed[$chunk]['addlines'] = '';
			$matches = array();
			preg_match('/@@ -(\d{1,10}),{0,1}(\d{0,10}) \+\d{1,10},{0,1}\d{0,10} @@/', $line, $matches);
			$parsed[$chunk]['linestart'] = $matches[1];
			$parsed[$chunk]['removes'] = $matches[2];
			// The x,0 means only adds, so the *change* would really start on the next line (weird git syntax...)
			if ($parsed[$chunk]['removes'] == '0')
				$parsed[$chunk]['linestart']++;
			// No value means 1 line removed (weird git syntax; 0=0, ''=1, 2=2...)
			elseif (empty($parsed[$chunk]['removes']))
				$parsed[$chunk]['removes'] = '1';
			// Factor in that we will be comparing to arrays, so zero offest (subtract 1).
			$parsed[$chunk]['linestart']--;
		}
		elseif (substr($line, 0, 1) == ' ')
		{
			$parsed[$chunk]['removelines'] .= substr($line, 1) . "\n";
			$parsed[$chunk]['addlines'] .= substr($line, 1) . "\n";
		}
		elseif (substr($line, 0, 1) == '-')
		{
			$parsed[$chunk]['removelines'] .= substr($line, 1) . "\n";
		}
		elseif (substr($line, 0, 1) == '+')
		{
			$parsed[$chunk]['addlines'] .= substr($line, 1) . "\n";
		}
		// Alert if there is a line type we haven't seen...  
		// Need to test for an empty line - don't know why there are sometimes empty lines in the output from git, but there are.
		elseif (!empty($line))
			echo $file . ' ************************* Unknown diff line type: ' . $line . ' ****************************<br>';

		// Save off for when it tells you 'no line feed' after the fact...
		$prior = substr($line, 0, 1);
	}

	return $parsed;
}

//*** Make sure all searches are unambiguous for replaces & befores
function unambiguate($snippets, $file) {

	global $audit, $oldfilestr, $oldfilearr, $newfilestr, $override;

	foreach ($snippets AS $ix => $snippet)
	{
		// No search string for new files
		if ($snippet['action'] == 'new file')
			continue;
		// Ends are weird...  SMF parser wants a "dummy" \n at the beggining and will add its own \n at the end...
		// Most of our code already has a \n at the end of each line...  So...  move it...
		elseif ($snippet['action'] == 'end')
		{
			$snippet['addlines'] = substr("\n" . $snippet['addlines'], 0, strlen($snippet['addlines']));
		}
		else
		{
			// Check 1 - Will it work as-is?
			$up = true;
			$context = 0;
			$count = 0;
			$repcount = 0;
			// Note counts are passed by reference & updated by testDir()
			$snippet = testDir($file, $up, $ix, $snippet, $context, 0, 0, $count, $repcount);

			// It's already unique, leave it alone!
			if ($count == 1 && $repcount == 1)
			{
				if ($audit == true)
					echo $file . ' Snippet: '. $ix . ' No need to add context!<br>';
				applySnippet($snippet);
				continue;
			}

			// Calculate widest range of valid context, against $oldfilearr (zero offsets for array nav)
			// Set minimum "safe" row to use.  Can not use rows involved in the prior snippet.
			if (isset($snippets[$ix - 1]['linestart']))
				$linemin = $snippets[$ix - 1]['linestart'] + $snippets[$ix - 1]['removes'];
			else
				$linemin = 0;
			
			// Set maximum "safe" row to use.  Line prior to the next snippet or EOF.
			if (isset($snippets[$ix + 1]['linestart']))
				$linemax = $snippets[$ix + 1]['linestart'] - 1;
			else
				$linemax = count($oldfilearr) - 1;

			// Keep increasing until you get unique hits, testing above &/or below...
			while ($count != 1 || $repcount != 1)
			{
				$context++;
				// If an override is in effect, only look in that direction...
				if (isset($override[$file][$ix]))
				{
					if ($audit == true)
						echo $file . ' Snippet: '. $ix . ' Override in effect: ' . ($override[$file][$ix] ? ' Up ' : ' Down ') . '!<br>';
					$test = testDir($file, $override[$file][$ix], $ix, $snippet, $context, $linemin, $linemax, $count, $repcount);
					if ($count == 1 && $repcount == 1)
					{
						$snippet = $test;
						break;
					}
				}
				// ...otherwise, choose a primary direction & check both if necessary
				else
				{
					$up = chooseDir($snippet, $linemin, $linemax, $context);
					// Note counts are passed by reference & updated by testDir()
					$test = testDir($file, $up, $ix, $snippet, $context, $linemin, $linemax, $count, $repcount);
					if ($count == 1 && $repcount == 1)
					{
						$snippet = $test;
						break;
					}
					else
					{
						$test = testDir($file, !$up, $ix, $snippet, $context, $linemin, $linemax, $count, $repcount);
						if ($count == 1 && $repcount == 1)
						{
							$snippet = $test;
							break;
						}
					}
				}
			}
		}
		// Apply the snippet to $oldfilestr, since it should affect future searches...
		applySnippet($snippet);
		$snippets[$ix] = $snippet;
	}

	return $snippets;
}

//*** Choose Direction - Up or Down (position = "before" or "after")
function chooseDir($snippet, $linemin, $linemax, $context) {

	global $oldfilearr;

	$before = '';
	$after = '';

	for ($i = 1; $i <= $context; $i++)
	{
		$before_line = $snippet['linestart'] - $context + $i - 1;
		if ($before_line >= $linemin)
			$before .= $oldfilearr[$before_line] . "\n";

		$after_line = $snippet['linestart'] + $snippet['removes'] + $i - 1;
		if ($after_line <= $linemax)
			$after .= $oldfilearr[$after_line]  . "\n";
	}

	// Comments get priority!  If no comments either way, use whatever context has more info...
	if (substr($before, 0, 2) == '//')
		$up = true;
	elseif (substr($after, 0, 2) == '//')
		$up = false;
	elseif (strlen($before) >= strlen($after))
		$up = true;
	else
		$up = false;

	return $up;
}

//*** Test one possible Direction/# lines for uniqueness
function testDir($file, $up, $ix, $snippet, $context, $linemin, $linemax, &$count, &$repcount) {

	global $audit, $oldfilestr, $oldfilearr, $newfilestr;

	// Force exit if we can't go any further...
	if ($context != 0 && ($snippet['linestart'] - $context < $linemin) && ($snippet['linestart'] + $snippet['removes'] + $context > $linemax))
	{
		echo $file . ' ************************************************************************* CANNOT UMAMBIGUATE snippet: ' . $ix . '<br>';
		$count = 1;
		$repcount = 1;
		return $snippet;
	}

	$before = '';
	$after = '';

	for ($i = 1; $i <= $context; $i++)
	{
		$before_line = $snippet['linestart'] - $context + $i - 1;
		if ($before_line >= $linemin)
			$before .= $oldfilearr[$before_line] . "\n";

		$after_line = $snippet['linestart'] + $snippet['removes'] + $i - 1;
		if ($after_line <= $linemax)
			$after .= $oldfilearr[$after_line] . ($after_line == count($oldfilearr) - 1 ? '' : "\n");
	}

	// Actually add the lines of context here
	if ($up)
	{
		if ($snippet['action'] == 'replace')
		{
			$snippet['removelines'] = $before . $snippet['removelines'];
			$snippet['addlines'] = $before . $snippet['addlines'];
		}
		else
		{
			$snippet['removelines'] = $before . $snippet['removelines'];
			$snippet['action'] = 'before';
		}
	}
	else
	{
		if ($snippet['action'] == 'replace')
		{
			$snippet['removelines'] = $snippet['removelines'] . $after;
			$snippet['addlines'] = $snippet['addlines'] . $after;
		}
		else
		{
			$snippet['removelines'] = $snippet['removelines'] . $after;
			$snippet['action'] = 'after';
		}
	}

	// How many occurances of the old text in the old file?
	if (empty($snippet['removelines']))
		$count = 99;
	else
		$count = substr_count($oldfilestr, $snippet['removelines']);

	// How many occurances of the new text in the new file?
	if (empty($snippet['addlines']))
		$repcount = 99;
	else
		if ($snippet['action'] == 'replace')
			$repcount = substr_count($newfilestr, $snippet['addlines']);
		else
			// If testing REMOVALS of before/after, the search should include the full substitution made
			if ($snippet['action'] == 'before')
				$repcount = substr_count($newfilestr, $snippet['removelines'] . $snippet['addlines']);
			else
				$repcount = substr_count($newfilestr, $snippet['addlines'] . $snippet['removelines']);

	if ($audit == true)
		echo $file . ' Snippet: '. $ix . ($up ? ' Up ' : ' Down ') . 'context: ' . $context . ' count: ' . $count . ' repcount: ' . $repcount . '<br>';

	return $snippet;
}

//*** Apply the snippet to $oldfilestr, since updates to the file will affect future searches...
function applySnippet($snippet) {

	global $oldfilestr;

	// Don't worry about end...  It's the last one anyway...
	if ($snippet['action'] == 'replace')
		$oldfilestr = str_replace($snippet['removelines'], $snippet['addlines'], $oldfilestr);
	elseif ($snippet['action'] == 'before')
		$oldfilestr = str_replace($snippet['removelines'], $snippet['removelines'] . $snippet['addlines'], $oldfilestr);
	elseif ($snippet['action'] == 'after')
		$oldfilestr = str_replace($snippet['removelines'], $snippet['addlines'] . $snippet['removelines'], $oldfilestr);

	return;
}

//*** Wrap Up 
function doWrapUp() {

	echo "<br>Completed!<br><br>";
	echo '</pre>';

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
}
