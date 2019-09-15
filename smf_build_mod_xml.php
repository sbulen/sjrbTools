<?php 
// 
// An utility to scan a local git repo & build xml package files.
//
// ***** Windows assumed *****
//
// Usage guidelines:
// (1) Your git/bin must be in your environment PATH
// (2) Set the user config variables below.  All 4 variables must be provided. 
// (3) Execute this file from your browser.
// (4) Some info will be displayed in your browser, which files were updated, etc.
// (5) Xml files will be in the directory where this was launched.  
//       *** They will be overwritten with each execution!!! ***
//     by sbulen
// 

//*** Start user config
$repo_path = 'D:/EasyPHP/Git/SMF2.0';
$repo_master_branch = 'master';
$repo_prior_release_commit = 'v2.0.15';
$new_version = '2.0.16';
//*** End user config

//*** Main program
doStartup();
navFileSystem($repo_path);
doWrapUp();
return;

//*** Startup 
function doStartup() {

	global $repo_path, $repo_master_branch, $new_version, $rundir;

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
	$file = $rundir . '/smf_' . $new_version . '_patch.xml';
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

	global $repo_path, $repo_prior_release_commit;

	// Strip repo root path...
	$file = substr($file, strlen($repo_path) + 1);
	
	echo 'Checking ' . $file . '... ';

	// Can limit context here with -Ux; don't want color affecting text anyhow (haven't seen it, but still concerns me...)
	// -U0 seems like a good idea, but it's not; relocations of whole lines with no context cause issues (is the pkg mgr finding the old one or the new one?).
	// -U1/U2 also have issues; changes too close to each other can impact each other at search/replace time; best to treat as a whole.
	$cmd = "git diff -U3 --no-color {$repo_prior_release_commit} HEAD {$file}";
	$result = `{$cmd}`;
	if (!empty($result))
	{
		buildXML($file, $result);
		echo '<strong><em>DONE!!!</em></strong><br>';
	}
	else
		echo 'no change.<br>';

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	
	return;
}

//*** Make the XML for that file
function buildXML($file, $results) {

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

	// Split it up!
	$snippets = parseDiff($results);

	// Search is blank on a new file
	if (count($snippets) == 1 && empty($snippets[0]['search']))
		addFile($dir, $file);
	else
		searchReplace($dir, $file, $gitfile, $snippets);

	return;
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

//*** searchReplace
function searchReplace($dir, $file, $gitfile, $snippets) {

	global $rundir, $new_version;

	// First, clean the snippets - e.g., remove unnecessary trailing common characters (making the change more mod-friendly...)
	$snippets = cleanSnippets($snippets, $file, $gitfile);

	// Open append...
	$output = $rundir . '/smf_' . $new_version . '_patch.xml';
	$fp = fopen($output, "a");

	// File header info...
	fwrite($fp, "\t" . '<!-- ' . $new_version . ' updates for ' . $file . ' -->' . "\n");
	fwrite($fp, "\t" . '<file name="' . $dir . '/' . $file . '">' . "\n");

	foreach ($snippets AS $snippet)
	{
		// Alert to some oddities that don't seem to make sense with a clever message...
		// Note: They are EQUAL when the change only has to do with CR/LF normalization.
		if ($snippet['search'] == $snippet['replace'] || empty($snippet['search']))
			echo '************************************** WTF ************************************';

		// If it contains CDATA, you can't use CDATA...
		if (stripos($snippet['search'], '<![CDATA[') !== false || stripos($snippet['search'], ']]>') !== false || stripos($snippet['replace'], '<![CDATA[') !== false || stripos($snippet['replace'], ']]>') !== false)
		{
			$snippet['search'] = htmlspecialchars($snippet['search']);
			$snippet['replace'] = htmlspecialchars($snippet['replace']);
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
		fwrite($fp, "\t\t\t" . '<search position="replace">' . $before . $snippet['search'] . $after . '</search>' . "\n");
		fwrite($fp, "\t\t\t" . '<add>' . $before . $snippet['replace'] . $after . '</add>' . "\n");
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
		if (in_array(substr($line, 0, 3), array('---', '+++', 'dif')))
			continue;

		// If the file is new, don't need to look at the details
		if (substr($line, 0, 8) == 'new file')
		{
			$parsed[0]['search'] = '';
			$parsed[0]['replace'] = 'new file';
			break;
		}

		// If it's telling you that the prior text had no newline, strip it...
		if (substr($line, 0, 12) == '\ No newline')
		{
			if ($prior == ' ')
			{
				$parsed[$chunk]['search'] = substr($parsed[$chunk]['search'], 0, strlen($parsed[$chunk]['search']) - 1);
				$parsed[$chunk]['replace'] = substr($parsed[$chunk]['replace'], 0, strlen($parsed[$chunk]['replace']) - 1);
			}
			elseif ($prior == '-')
			{
				$parsed[$chunk]['search'] = substr($parsed[$chunk]['search'], 0, strlen($parsed[$chunk]['search']) - 1);
			}
			elseif ($prior == '+')
			{
				$parsed[$chunk]['replace'] = substr($parsed[$chunk]['replace'], 0, strlen($parsed[$chunk]['replace']) - 1);
			}
			continue;
		}

		// Process the actual diff
		if (substr($line, 0, 2) == '@@')
		{
			$chunk++;
			$parsed[$chunk]['search'] = '';
			$parsed[$chunk]['replace'] = '';
			$matches = array();
			preg_match('/@@ -(\d{1,10}),{0,1}\d{0,10} \+\d{1,10},{0,1}\d{0,10} @@/', $line, $matches);
			$parsed[$chunk]['linestart'] = $matches[1];
		}
		elseif (substr($line, 0, 1) == ' ')
		{
			$parsed[$chunk]['search'] .= substr($line, 1) . "\n";
			$parsed[$chunk]['replace'] .= substr($line, 1) . "\n";
		}
		elseif (substr($line, 0, 1) == '-')
		{
			$parsed[$chunk]['search'] .= substr($line, 1) . "\n";
		}
		elseif (substr($line, 0, 1) == '+')
		{
			$parsed[$chunk]['replace'] .= substr($line, 1) . "\n";
		}

		// Save off for when it tells you 'no line feed' after the fact...
		$prior = substr($line, 0, 1);
	}

	return $parsed;
}

//*** Clean Snippets - loop thru them all & try to fix
function cleanSnippets($snippets, $file, $gitfile) {

	global $repo_prior_release_commit;

	$cmd = "git show {$repo_prior_release_commit}:{$gitfile}";
	$filestr = `{$cmd}`;
	$filearr = explode("\n", $filestr);

	foreach ($snippets AS $ix => $snippet)
	{
		$snippets[$ix] = cleanSnippet($snippet, $filestr, $filearr);
	}

	return $snippets;
}

//*** Clean Snippet - remove trailing common characters & make sure it gets a unique hit
function cleanSnippet($snippet, &$filestr, &$filearr) {

	// PART I - remove trailing common text
	$searchLen = strlen($snippet['search']);
	$replaceLen = strlen($snippet['replace']);

	$common = 1;
	while (substr($snippet['search'], $searchLen - $common, 1) === substr($snippet['replace'], $replaceLen - $common, 1))
		$common++;
	$common--;

	$snippet['search'] = substr($snippet['search'], 0, $searchLen - $common);
	$snippet['replace'] = substr($snippet['replace'], 0, $replaceLen - $common);

	// PART II - deal with empty search strings.
	// *** Do NOT use -U0...  Line #s are wonky here if you do so...
	$line = $snippet['linestart'] - 2;
	if (empty($snippet['search']))
	{
		$snippet['search'] = $filearr[$line] . "\n" . $snippet['search'];
		$snippet['replace'] = $filearr[$line] . "\n" . $snippet['replace'];
		$line--;
	}

	// PART III - is the search string unique???  If not, narrow the search by adding lines at the top.
	$count = substr_count($filestr, $snippet['search']);
	if ($count != 1)
	{
		while ($count > 1 && $line > 0)
		{
			$snippet['search'] = $filearr[$line] . "\n" . $snippet['search'];
			$snippet['replace'] = $filearr[$line] . "\n" . $snippet['replace'];
			$line--;
			$count = substr_count($filestr, $snippet['search']);
		}
		}
	// PART IV - remove lines from the top, as long as it's still unique...
	// Folks like to keep comments around, so don't drop comment lines.
	else
	{
		// Save the current, working one off...
		$working = $snippet;
		while ($count == 1)
		{
			// Get top lines from both...
			$eolSearch = strpos($snippet['search'], "\n");
			$eolReplace = strpos($snippet['replace'], "\n");
			if ($eolSearch !== false && $eolReplace !== false)
			{
				$topSearch = substr($snippet['search'], 0, $eolSearch + 1);
				$topReplace = substr($snippet['replace'], 0, $eolReplace + 1);
				if ($topSearch === $topReplace && substr(ltrim($topSearch), 0, 2) != '//')
				{
					$snippet['search'] = substr($snippet['search'], $eolSearch + 1);
					$snippet['replace'] = substr($snippet['replace'], $eolReplace + 1);
					$count = substr_count($filestr, $snippet['search']);
					if ($count == 1)
						$working = $snippet;
				}
				else
					break;
			}
			else
				break;
		}
		// Use the last one that worked, not the last one putzed with...
		$snippet = $working;
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
