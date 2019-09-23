<?php 
// 
// An utility to scan a local git repo & build xml package files.
//
// ***** Windows assumed *****
//
// Usage guidelines:
// (1) Your git/bin must be in your environment PATH
// (2) Set the user config variables below.  All 6 variables must be provided. 
// (3) Execute this file from your browser.
// (4) Some info will be displayed in your browser, which files were updated, etc.
// (5) Xml files will be in the directory where this was launched.  
//       *** They will be overwritten with each execution!!! ***
//     by sbulen
// 
// Notes on $lines_of_context:
// A lower # means a higher # of tiny changes, is harder to read, and is more likely to run into
// ambiguous search/replace functions.  BUT... is more mod-friendly, as the odds of code collisions are lower.
// A higher # means you have a lower # of changes (they blend together...), captures more comments & is more readable, 
// but is less mod-friendly.
// As of now:
//    $lines_of_context = 3 produces a fully working diff that installs & uninstalls cleanly.
//    $lines_of_context = 2 has a couple ambiguous searches, but seems to work anyway...
//    $lines_of_context = 1 has a few ambiguous searches that must be resolved by hand.
//    $lines_of_context = 0 has even more ambiguous searches.
//

//*** Start user config
$repo_path = 'D:/EasyPHP/Git/SMF2.0';
$repo_master_branch = 'master';
$repo_prior_release_commit = '0d792ea2436ece61dbfb51c9d73fe4d42eb20ebe';
$repo_this_release_commit = 'HEAD';
$new_version_txt = '2.0.16';
$lines_of_context = '3';
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

	global $repo_path, $repo_prior_release_commit, $repo_this_release_commit, $lines_of_context;

	// Strip repo root path...
	$file = substr($file, strlen($repo_path) + 1);

	echo 'Checking ' . $file . '... ';

	// -U# tells git how much context to provide.
	// Don't want color affecting text anyhow (haven't seen it, but still concerns me...)
	$cmd = "git diff -U{$lines_of_context} --no-color {$repo_prior_release_commit} {$repo_this_release_commit} {$file}";
	$result = `{$cmd}`;
	if (!empty($result))
	{
		processDiff($file, $result);
		echo '<strong><em>DONE!!!</em></strong><br>';
	}
	else
		echo 'no change.<br>';

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
}

//*** Figure out what to do with each diff
function processDiff($file, $diff) {

	global $repo_prior_release_commit, $repo_this_release_commit, $lines_of_context;

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
	$snippets = parseDiff($diff);

	// If we've asked for context, strip it...
	if (!empty($lines_of_context))
		$snippets = trimOuterContext($snippets, $oldfilearr);

	// Determine appropriate action for each snippet
	$snippets = determineAction($snippets, $oldfilearr);

	// Make sure searches work & are unique
	$snippets = unambiguate($snippets, $oldfilestr, $oldfilearr, $newfilestr);

	// New files have one row with an action of 'new file'
	if (count($snippets) == 1 && $snippets[0]['action'] == 'new file')
		addFile($dir, $file);
	else
		buildFileOps($dir, $file, $gitfile, $snippets);

	return;
}

//*** Figure out if we're going to do a position=replace, end, before, etc...
function determineAction($snippets, $oldfilearr) {

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
		// Adding lines - if at the bottom, do an 'end', otherwise, do a 'before'
		// position="end" is very picky - old last 2 lines must match exactly LF & \?\> and must be the 2 lines being replaced with the new lines...
		elseif (!empty($snippet['addlines']))
		{
			if ((count($oldfilearr) == $snippet['linestart'] + 1) && (isset($oldfilearr[$snippet['linestart'] - 1]) && empty(trim($oldfilearr[$snippet['linestart'] - 1]))) && (isset($oldfilearr[$snippet['linestart']]) && trim($oldfilearr[$snippet['linestart']]) == '?>'))
				$snippets[$ix]['action'] = 'end';
			else
				$snippets[$ix]['action'] = 'before';
		}
		else
		{
			echo '******************************* I\'m confused ****************************';
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
			echo '***** CDATA NOT USED ***** ';
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
function parseDiff($diff) {

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
			echo '************************* Unknown diff line type: ' . $line . ' ****************************';

		// Save off for when it tells you 'no line feed' after the fact...
		$prior = substr($line, 0, 1);
	}

	return $parsed;
}

//*** Make sure all searches are unambiguous (for replaces & befores, which will be empty upon entry here)
function unambiguate($snippets, &$oldfilestr, &$oldfilearr, &$newfilestr) {

	foreach ($snippets AS $ix => $snippet)
	{
		// No search string for these
		if (in_array($snippet['action'], array('end', 'new file')))
			continue;
		else
		{
			// Keep adding lines until the search is unambiguous
			// For 'replace', add to both remove & add; for before/after, etc., only to the search criterion
			// If empty, add a line to prime the pump...
			$line = $snippet['linestart'] - 2;
			if (empty($snippet['removelines']) || ($snippet['action'] == 'replace' && empty($snippet['addlines'])))
			{
				$snippet['removelines'] = $oldfilearr[$line] . "\n" . $snippet['removelines'];
				if ($snippet['action'] == 'replace')
					$snippet['addlines'] = $oldfilearr[$line] . "\n" . $snippet['addlines'];
				$line--;
				// Keep status current...
				$snippet['linestart']--;
				$snippet['removes']++;
			}
			$count = substr_count($oldfilestr, $snippet['removelines']);
			if ($snippet['action'] == 'replace')
				$repcount = substr_count($newfilestr, $snippet['addlines']);

			// Cannot intrude upon updates from prior snippet...
			$compareline = (isset($snippets[$ix - 1]['linestart']) ? $snippets[$ix - 1]['linestart'] : 0) + (isset($snippets[$ix - 1]['removes']) ? $snippets[$ix - 1]['removes'] : 0) - 2;
			while (($count > 1 || ($snippet['action'] == 'replace' && $repcount > 1)) && $line > 0)
			{
				if ($line > $compareline)
				{
					$snippet['removelines'] = $oldfilearr[$line] . "\n" . $snippet['removelines'];
					if ($snippet['action'] == 'replace')
						$snippet['addlines'] = $oldfilearr[$line] . "\n" . $snippet['addlines'];
					$line--;
					// Keep status current...
					$snippet['linestart']--;
					$snippet['removes']++;

					$count = substr_count($oldfilestr, $snippet['removelines']);
					if ($snippet['action'] == 'replace')
						$repcount = substr_count($newfilestr, $snippet['addlines']);
				}
				else
				{
					// These must be resolved by hand at this point...
					echo '************************* Cannot unambiguate snippet ' . ($ix + 1) . '! ****************************';
					break;
				}

			}
			$snippets[$ix] = $snippet;
		}
	}

	return $snippets;
}

//*** If context was requested, trim it from start & end of snippets
function trimOuterContext($snippets) {

	global $lines_of_context;

	$lines_of_context = (int) $lines_of_context;

	foreach ($snippets AS $ix => $snippet)
	{
		// Leave it alone if action is pre-ordained (new files)
		if (empty($snippet['action']))
		{
			for ($i = 1; $i <= $lines_of_context; $i++)
			{
				$snippet = removeBottomLine($snippet);
				$snippet = removeTopLine($snippet);
			}
			$snippets[$ix] = $snippet;
		}
	}

	return $snippets;
}

//*** Remove Top Line - & make sure it's common
function removeTopLine($snippet) {

	// Get top lines from both...
	$eolSearch = strpos($snippet['removelines'], "\n");
	$eolReplace = strpos($snippet['addlines'], "\n");
	if ($eolSearch !== false && $eolReplace !== false)
	{
		$topSearch = substr($snippet['removelines'], 0, $eolSearch + 1);
		$topReplace = substr($snippet['addlines'], 0, $eolReplace + 1);
		if ($topSearch === $topReplace)
		{
			$snippet['removelines'] = substr($snippet['removelines'], $eolSearch + 1);
			$snippet['addlines'] = substr($snippet['addlines'], $eolReplace + 1);

			// Keep status current...
			$snippet['linestart']++;
			$snippet['removes']--;
		}
	}

	return $snippet;
}

//*** Remove Bottom Line - & make sure it's common
function removeBottomLine($snippet) {

	static $codeLine = '/(?<=\n|^)(.*\n?)$/D';

	$sLine = preg_match($codeLine, $snippet['removelines'], $sMatch);
	$rLine = preg_match($codeLine, $snippet['addlines'], $rMatch);
	if ($sLine && $rLine && $sMatch[1] === $rMatch[1])
	{
		$snippet['removelines'] = substr($snippet['removelines'], 0, strlen($snippet['removelines']) - strlen($sMatch[1]));
		$snippet['addlines'] = substr($snippet['addlines'], 0, strlen($snippet['addlines']) - strlen($rMatch[1]));

		// Keep status current...
		$snippet['removes']--;
	}

	return $snippet;
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
