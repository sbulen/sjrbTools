<?php 
// 
// An SMF utility to clean the image proxy cache folder.
//
// ***** SMF 2.0 & 2.1 *****
//
// Usage guidelines:
// (1) Copy this file to your crontab folder.  If you don't have one, create one.
// (2) Edit the configuration parameters below, indicating the directory 
//     of the smf forum (where settings.php is) & the # of total bytes of cached files to keep.
//     Forum path should have no trailing slash.
// (3) Execute it from your browser or run it as a cron job.
// (4) Output, all in the same directory:
//        - proxymaintstats.txt - dump of actions taken, easily readable & importable into Excel
//        - proxymainterrors.log - errors, if any
//     by sbulen
// 

// User configuration
$smf_root_dir = '/path/to/your/forum/here';
$bytes_to_keep = 500000000;
// End user configuration

//*** Main program

// Log errors to file
ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . '/proxymainterrors.log');

// Load the settings, to locate $cachedir...
require_once($smf_root_dir . '/Settings.php');
$imagedir = $cachedir . '/images';

// Files to match...
$match = '~^[0-9a-fA-F]{40}$~';

// Files to skip, just being safe...
$skip = array ('.', '..', 'index.php', '.htaccess');

// Loop through the dir, building array of file stats
$dirinfo = array();
$dirhnd = opendir($imagedir);
if (!$dirhnd) die("CANNOT READ IMAGE DIRECTORY: " . $imagedir);
while (false !== ($entry = readdir($dirhnd)))
{
	if (preg_match($match, $entry) && !in_array($entry, $skip))
	{
		$fileinfo = stat($imagedir . '/' . $entry);
		$dirinfo[] = array('file' => $entry, 'size' => $fileinfo[7], 'accessed' => $fileinfo[8], 'modified' => $fileinfo[9], 'changed' => $fileinfo[10]);
	}
}

// Sort the files by last accessed dates, most recent to oldest
usort($dirinfo, 
	function ($a, $b)
	{
		return $b['accessed'] - $a['accessed'];
	}
);

// Initialize the totals & counts...
$total = 0;
$count = 0;
$totalkept = 0;
$countkept = 0;
$totaldeleted = 0;
$countdeleted = 0;

// For stats...
$fp = fopen(__DIR__ . '/proxymaintstats.txt', 'w');

$output = "File\tSize\tAccessed\tModified\tiNodeChgd\tDisposition\n";
fwrite($fp, $output);

// Process the directory table, recording actions taken
foreach ($dirinfo AS $direntry)
{
	$total = $total + $direntry['size'];
	$count = $count + 1;
	if ($totalkept + $direntry['size'] > $bytes_to_keep)
	{
		unlink($imagedir . '/' . $direntry['file']);
		$totaldeleted = $totaldeleted + $direntry['size'];
		$countdeleted = $countdeleted + 1;
		$action = 'DELETED';
	}
	else
	{
		$totalkept = $totalkept + $direntry['size'];
		$countkept = $countkept + 1;
		$action = 'KEPT';		
	}
	$aDt = new DateTime();
	$aDt->setTimestamp($direntry['accessed']);
	$mDt = new DateTime();
	$mDt->setTimestamp($direntry['modified']);
	$cDt = new DateTime();
	$cDt->setTimestamp($direntry['changed']);
	$output = $direntry['file'] . "\t" . $direntry['size'] . "\t" . $aDt->format("Y-m-d H:i:s") . "\t" . $mDt->format("Y-m-d H:i:s") . "\t" . $cDt->format("Y-m-d H:i:s") . "\t" . $action . "\n";
	fwrite($fp, $output);
}

// Now do the stats
$output = "\nStats...\nTotal files:\t" . $count . "\tSize:\t" . $total . "\n";
fwrite($fp, $output);
$output = "Total kept:\t" . $countkept . "\tSize:\t" . $totalkept . "\n";
fwrite($fp, $output);
$output = "Total deleted:\t" . $countdeleted . "\tSize:\t" . $totaldeleted . "\n";
fwrite($fp, $output);

fclose($fp);

return;
