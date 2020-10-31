<?php 
header( 'Content-type: text/html; charset=utf-8' );
//
// This utility reads a mysql export & preps it for pg load.
// It does two things:
//  - Maps single & double-quotes from mysql format to pg accepted format
//  - Maps varbinary16 values, used in SMF for IP addresses, to pg inet format
//
// Prepwork: 
//  - Install a vanilla version of PG & get it fully working.  Truncate all tables.
//  - Your source mysql SMF DB must be UTF8.
//  - Your source mysql SMF DB must include ONLY vanilla tables & columns. Source & target tables & columns must match perfectly.
//  - If needed, create a copy & delete all extraneous rows & columns and do the mysqldump from there.
//
// Overall Process - for use on Windows:
// (1) Use the following command to do the export:
//    mysqldump -u{user} -p{pass} --no-create-db --no-create-info --hex-blob --skip-add-locks --skip-comments --skip-set-charset --compact --skip-quote-names --complete-insert {dbname} > {myfile.sql}
// (2) Modify the $infile, $outfile & $path in the config section below
// (3) Run this utility, reading the mysqldump just created & creating a new .sql file
// (4) Open a command window
// (5) Issue the following in the Windows command window (otherwise it assumes import is in Windows 1252, not utf8...):
//    SET PGCLIENTENCODING=utf-8
// (6) Log on to psql, connect to your new empty vanilla pg DB
// (7) Load file with: \i mynewfile.sql
// (8) After load, you must fix all the SEQUENCE #s...
// (9) Run repair_settings.php to correct paths
// (10) Copy over your attachments, avatars, custom avatars & smileys
// (11) Clear your cache
//
//     by Shawn Bulen
//

// Config section - input & output files, & the path where they are found
$infile = 'vgfdump.sql';
$outfile = 'vgfdump_pg.sql';
$path = 'D:\EasyPHP\pgvgf21\\';
// End config section

echo("<br>*******************<br>");
echo("*** PG Converter ***<br>");
echo("********************<br><br>");

echo(" Input file: " . $infile . "<br>");
echo(" Output file: " . $outfile . "<br>");
echo(" Path: " . $path . "<br><br>");
@ob_flush();
@flush();

$lines = 0;
$bytes = 0;

//open files 
$file_in_handle = fopen($path . $infile, 'r'); 
	if (!$file_in_handle) {
		echo("<br><br>*** FATAL ERROR on opening input file***<br><br>");
		return;
	};
$file_out_handle = fopen($path . $outfile, 'w'); 
	if (!$file_out_handle) {
		echo("<br><br>*** FATAL ERROR on opening output file***<br><br>");
		return;
	};
echo("Files opened.<br>Processing...");

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
$bin_regex = '~(?<=\,)0x([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})(?=\,|\))~';
$matches = array();

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

// end of program
return;

?> 