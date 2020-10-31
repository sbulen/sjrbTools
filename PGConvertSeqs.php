<?php 
//
// A utility to fix all sequences after a mysql => postgresql conversion.
//
// ***** Postgresql ONLY *****
// 
//     by sbulen
// 

//*** Main program
doStartup();
loadSettingsFile();
fixSequences();
doWrapUp();
return;

//*** do Startup
function doStartup() {

	header( 'Content-type: text/html; charset=utf-8' );
	echo('<br>************************************<br>');
	echo('*** Find & Fix all Postgresql sequences ***<br>');
	echo('************************************<br><br>');

	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	define('SMF', 1);
	define('POSTGRE_TITLE', 'PostgreSQL');

	return;
}

//*** Settings File 
function loadSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $db_character_set, $smcFunc;
	$smcFunc = array();

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	// Get the database going!
	if (empty($db_type) || $db_type != 'postgresql')
		die('***** Database is not postgresql! *****');

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	return;
}

//*** Find 'em and fix 'em...
function fixSequences() {

	global $db_type, $db_connection, $db_prefix, $db_name, $db_character_set, $smcFunc;

	// Find all the sequences...
	$sql = "select t.relname as table, c.attname as column, d.adsrc as default
		from pg_class t, pg_attribute c, pg_attrdef d
		WHERE d.adsrc like 'nextval(''{$db_prefix}%'
		AND d.adrelid = c.attrelid AND d.adnum = c.attnum
		AND d.adrelid = t.oid;";
	$result = $smcFunc['db_query']('', $sql, array());

	// Move to array...
	$sequences = array();
	while($row = $smcFunc['db_fetch_assoc']($result))
		$sequences[] = $row;
	$smcFunc['db_free_result']($result);

	$getseq_regex = '/^nextval\(\'(.*)\'::regclass\)$/';
	$matches = array();

	foreach($sequences AS $sequence)
	{
		// Pluck the sequence name from the default & display what you found...
		preg_match($getseq_regex, $sequence['default'], $matches);
		$seqname = $matches[1];
		echo "Table: {$sequence['table']}, Column: {$sequence['column']}, Sequence: {$seqname}<br>";

		// Show the before value...
		$sql = "SELECT last_value FROM {$seqname};";
		$result = $smcFunc['db_query']('', $sql, array());
		list ($lastval) = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
		echo "Last value before operation: {$lastval}<br>";

		// If empty, bypass...
		$sql = "SELECT count(*) FROM {$sequence['table']}";
		$result = $smcFunc['db_query']('', $sql, array());
		list ($count) = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
		if (empty($count))
		{
			echo "Table empty, bypassing...<br><br>";
			continue;
		}

		// Now set the proper sequence value, choose greater of existing nextval or max of column ID...
		$sql = "SELECT setval('{$seqname}', (SELECT GREATEST(MAX({$sequence['column']}) + 1, nextval('{$seqname}')) - 1 FROM {$sequence['table']}))";
		$result = $smcFunc['db_query']('', $sql, array());
		list ($lastval) = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
		echo "Last value after operation: {$lastval}<br><br>";
		@ob_flush();
		@flush();
	}

	return;
}

//*** Wrap Up
function doWrapUp() {

	echo '<br>Fixing postgresql sequences completed!<br>';

	@ob_flush();
	@flush();	

	return;
}
