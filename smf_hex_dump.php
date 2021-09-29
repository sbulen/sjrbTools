<?php 
//
// A utility to dump a specific field in hex for UTF8 data.
// UTF8 safe!  It won't chop multi-byte characters in half...
//  
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL & Postgresql *****
// 
//     by sbulen
// 
// Config section...
// *** All of of these parameters must be specified! ***
// *** Note that this will ONLY dump ONE column... ***
$record = 'messages';
$column = 'body';
$where_clause = 'WHERE id_msg IN (2, 3, 4, 5, 6, 7, 8)';
// End config section


//*** Main program
doStartup();
loadSettingsFile();
dump_it();
doWrapUp();
return;


//*** do Startup
function doStartup() {

	global $record, $column, $where_clause;

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo('<br>***************************<br>');
	echo('*** Stupid Hex Dump Utility ***<br>');
	echo('***************************<br><br>');

	echo('Record: ' . $record . '<br>');
	echo('Column: ' . $column . '<br>');
	echo('WHERE clause: ' . $where_clause . '<br><br>');
	
	// Yes, both flushes necessary
	@ob_flush();
	@flush();

	define('SMF', 1);
	define('POSTGRE_TITLE', 'PostgreSQL');
	define('MYSQL_TITLE', 'MySQL');

	// Prime the pump...
	$allTimer = microtime(true);
	
	return;
}

//*** Settings File 
function loadSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc;
	$smcFunc = array();

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

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

//*** Get it & dump it...
function dump_it() {

	global $smcFunc, $record, $column, $where_clause;

	$data = array();

	mb_regex_encoding('UTF-8');
	mb_internal_encoding('UTF-8');

	echo '<font size="3" face="Courier New">';

	// Get them datas...
	$sql = 'SELECT ' . $column . 
		' FROM {db_prefix}' . $record . ' ' . $where_clause;
	echo ' sql: ' . $sql . '<br><br>';
	$result = $smcFunc['db_query']('', $sql,
		array (
		)
	);

	// Move to array...
	$data = array();
	while($row = $smcFunc['db_fetch_assoc']($result))
		$data[] = $row;
	$smcFunc['db_free_result']($result);

	foreach($data as $row)
	{
		// Break into lines
		$offset = 0;
		$length = strlen($row[$column]);

		echo ' ----- -------- ---- 00-1-2-3-4-5-6-7-8--10-1-2-3-4-5-6-7-8--20-1-2-3-4-5-6-7-8--30-1-2-3-4-5-6-7-8--<br>';
		while ($offset < $length)
		{
			$line = mb_strcut($row[$column], $offset, 40);
			echo ' Byte: ' . sprintf('%08d', $offset + 1) . ' Hex: ' . str_pad(bin2hex($line), 80, '-') . ' Disp: ' . htmlentities($line) . '<br>';
			$offset += strlen($line);
		}
		echo '<br><br>';
		@ob_flush();
		@flush();	
	}

	echo '</font>';

	return;
}

//*** Wrap Up
function doWrapUp() {

	echo 'Done!';

	// Yes, both flushes necessary
	@ob_flush();
	@flush();	

	return;
}
