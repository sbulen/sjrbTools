<?php 
//
// A utility to confirm the serialized strings in smf_log_actions table are proper.
// Certain activities, e.g., utf8 conversions, can change lengths of the strings, 
// and subsequent calls to unserialize will report them as broken.
//
// This utility specifically fixes string & array lengths wherever it can.
// 
// Flag "Doit" set to 'Yes' will do updates, otherwise it will only display what it would change.
// 
// ***** SMF 2.0 ONLY (2.1 doesn't use serialized strings...) *****
// ***** MySQL & Postgresql *****
// 
// Usage guidelines:
// (1) Use at your own risk.
// (2) ALWAYS run in your test environment first.
// (3) ALWAYS backup your system first - expect the unexpected.
// (4) Run in test mode - with $doit = 'No'.
// (5) Execute it from your browser.
// (6) When things look good, Execute it for real by changing $doit to 'Yes'.
// (7) Delete it when you're done.
//     by sbulen
// 
// Config section...
$doit = 'No';
// End config section

//*** Main program
doStartup();
loadSettingsFile();
fixStrings();
doWrapUp();
return;


//*** do Startup
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>************************<br>");
	echo("*** Check log_actions... ***<br>");
	echo("************************<br>");

	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	define('SMF', 1);
	
	return;
}

//*** Settings File 
function loadSettingsFile() {

	global $db_connection, $doit, $smcFunc, $db_prefix;
	$smcFunc = array();

	$dumpvars = array('mbname', 'boardurl', 'db_server', 'db_name', 'db_prefix', 'language', 'db_type');

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	$settings[] = array();
	$settings[0] = array('Settings.php Var','Value');
	foreach($dumpvars as $setting)
		$settings[] = array('$' . $setting, (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>'));
	dumpTable($settings);

	$settings = array();
	$settings[] = array('Do it:', $doit);
	dumpTable($settings);

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	// Most database systems have not set UTF-8 as their default input charset.
	if (!empty($db_character_set))
		$smcFunc['db_query']('', '
			SET NAMES {string:db_character_set}',
			array(
				'db_character_set' => $db_character_set,
			)
		);

	return;
}

//*** Do settings
function fixStrings() {

	global $smcFunc, $db_connection, $db_prefix, $doit;

	// Init stats...
	$rows = 0;
	$good = 0;
	$bad = 0;
	$fixed = 0;
	$cantfix = 0;

	$settings = array();
	$settings[] = array('ID', 'Action', 'Corrected');

	$sql = "SELECT id_action, extra FROM " . $db_prefix . "log_actions;";
	$result = $smcFunc['db_query']('', $sql);

	while($row = $smcFunc['db_fetch_assoc']($result))
	{
		$rows++;
		if (@unserialize($row['extra']) !== false)
			$good++;
		else
		{
			$bad++;
			if ($new = cleanSerializedString($row['extra']))
			{
				if ($doit == 'Yes')
				{
					$fixed++;
					$newesc = mysqli_real_escape_string($db_connection, $new);
					$sql = "UPDATE {$db_prefix}log_actions SET extra = '{$newesc}' WHERE id_action = {$row['id_action']}";
					$smcFunc['db_query']('', $sql);
				}
				$settings[] = array($row['id_action'], $row['extra'], $new);
			}
			else
			{
				$cantfix++;
				$settings[] = array($row['id_action'], $row['extra'], '<strong>Cannot fix...</strong>');
			}
		}
	}
	if (count($settings) > 1)
		dumpTable($settings);

	// Display stats...
	$settings = array();
	$settings[] = array('Records read', $rows);
	$settings[] = array('OK', $good);
	$settings[] = array('Bad', $bad);
	$settings[] = array('Fixed', $fixed);
	$settings[] = array('Cannot fix', $cantfix);
	dumpTable($settings);

	return;
}


/**
 * This will attempt to clean serialized strings.
 * String lengths and array lengths will be corrected where possible.
 * 
 * It will return either:
 *  - the corrected string
 *  - false if the string is broken and cannot be corrected due to ambiguity
 * 
 * Limitation 1: Ambiguity can easily arise if syntax elements are within the values themselves, it
 * may be unclear whether the count or the content is wrong...  Curly braces in strings ({}) are tough
 * if within nested structures.
 * Limitation 2: It cannot test the contents of custom serialized formats, only lengths.
 */

function cleanSerializedString($string)
{
	static $preg_match_string = '~^s:\d+:"(.*)";$~si';
	static $preg_match_array = '~^a:\d+:{(.*)};?$~s';
	static $preg_match_object = '~^O:\d+:"(.*)":\d+:{(.*)};?$~s';
	static $preg_match_custom = '~^C:\d+:"(.*)":\d+:{(.*)};?$~s';
	static $preg_match_ref = '~^R:\d+;$~i';

	// At the bottom!  Go back!
	if (empty($string))
		return $string;

	// Don't fix what ain't broke...
	if (@unserialize($string) !== false)
		return $string;

	// Very special case...  Was I simply passed false?
	if ($string == 'b:0;')
		return $string;

	// OK, we got work to do...
	$new_string = '';
	$matches = array();

	// Check against each type...
	if (preg_match($preg_match_string, $string, $matches))
	{
		// Matches 0 = full, 1 = string
		$new_string = 's:' . strlen($matches[1]) . ':"' . $matches[1] . '";';
	}
	elseif (preg_match($preg_match_array, $string, $matches))
	{
		// Let's see what we can do...
		// Matches 0 = full, 1 = string
		$parsed = parseArrayString($matches[1]);
		if ($parsed === false)
			$new_string = false;
		else
			$new_string = 'a:' . count($parsed)/2 . ':{' . implode('', $parsed) . '}';
	}
	elseif (preg_match($preg_match_object, $string, $matches))
	{
		// Let's see what we can do...
		// Matches 0 = full, 1 = obj name, 2 = string
		$parsed = parseArrayString($matches[2]);
		if ($parsed === false)
			$new_string = false;
		else
			$new_string = 'O:' . strlen($matches[1]) . ':"' . $matches[1] . '":' . count($parsed)/2 . ':{' . implode('', $parsed) . '}';
	}
	elseif (preg_match($preg_match_custom, $string, $matches))
	{
		// Matches 0 = full, 1 = obj name, 2 = string
		$new_string = 'C:' . strlen($matches[1]) . ':"' . $matches[1] . '":' . strlen($matches[2]) . ':{' . $matches[2] . '}';
	}
	// Ref on its own fails unserialize...  We have to allow for it here, because we are checking individual components of arrays, objs...
	elseif (preg_match($preg_match_ref, $string, $matches))
	{
		$new_string = $string;
	}
	else
		$new_string = false;

	return $new_string;
}

/**
 * Attempts to turn the array string into an actual array...
 * Will make an attempt to clean each individual element.
 * Will return false if things go bad, e.g., the string is ambiguous.
 */
function parseArrayString($string)
{
	// What would make it ambiguous would be text strings that include
	// stuff that looks like syntax...  That would likely cause this to fail.
	// But let's try...
	//
	static $pattern_string = '~^(?>s:(\d+):".*";)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_array = '~^(?>a:\d+:({(?>[^{}]|(?1))*}))(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_obj = '~^(?>O:\d+:".*":\d+:({(?>[^{}]|(?1))*}))(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_custom = '~^(?>C:\d+:".*":\d+:({(?>[^{}]|(?1))*}))(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_int = '~^(?>i:\d+;)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_bool = '~^(?>b:(?:0|1);)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_null = '~^(?>N;)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_ref = '~^(?>(?:R|r):\d+;)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
	static $pattern_float = '~^(?>d:\d+\.\d+;)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';

	if (empty($string))
		return array();

	// Check each entry, left to right...
	$parsed = array();
	$matches = array();

	while (strlen($string) > 0)
	{
		if (preg_match($pattern_string, $string, $matches))
		{
			$element = $matches[0];
			// Before assuming it's wrong, let's test exactly what was given...
			// This reduces throwing out good strings because they contain syntax-like elements.
			$dynamic_pattern = '~^(?>s:' . $matches[1] . ':".{' . $matches[1] . '}";)(?=s:|a:|i:|b:|N;|(?:R|r):|d:|O:|C:|$)~sU';
			if (preg_match($dynamic_pattern, $string, $matches))
			{
				$element = $matches[0];
			}
		}
		elseif (preg_match($pattern_array, $string, $matches)
			|| preg_match($pattern_obj, $string, $matches)
			|| preg_match($pattern_custom, $string, $matches)
			|| preg_match($pattern_int, $string, $matches)
			|| preg_match($pattern_bool, $string, $matches)
			|| preg_match($pattern_null, $string, $matches)
			|| preg_match($pattern_ref, $string, $matches)
			|| preg_match($pattern_float, $string, $matches))
			$element = $matches[0];
		else
			return false;

		$clean_element = cleanSerializedString($element);
		if ($clean_element === false)
			return false;
		else
			$parsed[] = $clean_element;

		$string = substr($string, strlen($element));
	}

	// Must be pairs...  If not, it's broken...
	if (count($parsed) % 2 != 0)
		return false;

	return $parsed;
}

//*** Wrap Up
function doWrapUp() {

	echo "<br>Checking log_actions completed!<br><br>";

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