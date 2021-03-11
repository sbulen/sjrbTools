<?php 
// 
// An SMF utility to dump web file retrieval info to help diagnose image proxy issues.
//
// ***** SMF 2.0 $ 2.1 *****
//
// Usage guidelines:
// (1) If you want to look at a different image, update the value in the config section below.
// (2) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (3) Execute it from your browser.
// (4) Delete it when you're done.
//     by sbulen
// 

// Config section...
// Put a link to an http image here to test... 
	$image = 'http://www.ovationgallery.com/Gallery%20Storm/OG-storm-to-nutv-01.jpg';
// End config section

//*** Main program
doStartup();
doSettingsFile();
doEnvChecks();
doHost();

doCurl();
doSockets();

doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>*********************************<br>");
	echo("**** SMF Image Proxy diagnostic ****<br>");
	echo("*********************************<br>");

	define('SMF', 1);
	define('SMF_VERSION', '2.1 RC3');
	define('SMF_USER_AGENT', 'Mozilla/5.0 (' . php_uname('s') . ' ' . php_uname('m') . ') AppleWebKit/605.1.15 (KHTML, like Gecko)  SMF/' . strtr(SMF_VERSION, ' ', '.'));

	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Settings File 
function doSettingsFile() {

	global $boardurl, $sourcedir, $cachedir;

	$sourcedir = $boardurl . '/Source';

	$dumpvars = array('mbname', 'db_server', 'db_name', 'boardurl', 'image_proxy_enabled', 'image_proxy_secret', 'image_proxy_maxsize', 'cachedir', 'sourcedir');

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	$settings = array();
	$settings[0] = array('Settings.php Var','Value');
	foreach($dumpvars as $setting)
		$settings[] = array('$' . $setting, (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>'));
	
	dumpTable($settings);

	return;
}

//*** Some environment checks
function doEnvChecks() {

	global $cachedir, $imagedir;
	
	$imagedir = $cachedir . '/images'; 

	$settings = array();
	$settings[0] = array('Directory checks...');
	
	// Check image proxy cache folder...

	$exists = is_dir($imagedir);
	
	$settings[] = array("Image Directory:", $imagedir);
	$settings[] = array("Image Directory Exists:", $exists ? 'true' : 'false');
	$settings[] = array("Image Directory Writable?", is_writable($imagedir) ? 'true' : 'false');

	if ($exists) {
		$settings[] = array("Image Directory Permissions:", substr(decoct(fileperms($imagedir)), -3));
		$settings[] = array("Image Directory Permissions full:", decoct(fileperms($imagedir)));
	}

	dumpTable($settings);

	return;
}

//*** Does host exist 
function doHost() {

	global $image;

	$parsed = parse_url($image);
	$settings = array();
	$settings[] = array('get_headers...');
	$settings[] = array('Host: ', $parsed['host']);

	$hostheaders = @get_headers($parsed['scheme'] . '://' . $parsed['host']);
	$settings[] = array('Host headers returned: ', $hostheaders === false ? 'false' : 'true');

	if ($hostheaders !== false)
		$settings[] = array('Host headers: ', implode("<br>", $hostheaders));

	$imgheaders = @get_headers($image);
	if ($imgheaders !== false)
		$settings[] = array('Image Headers: ', implode("<br>", $imgheaders));

	dumpTable($settings);

	return;
}

//*** Use Curl to see if it works & dump any helpful info found...
function doCurl() {

	global $sourcedir, $image;

	require_once($sourcedir . '/Class-CurlFetchWeb.php');

	$installed = function_exists('curl_version');
	
	$settings = array();
	$settings[0] = array('Curl attempt...');
	$settings[] = array('Curl Installed:', $installed ? 'true' : 'false');

	if ($installed) {
		$curl = new curl_fetch_web_data(array(CURLINFO_HEADER_OUT => 1, CURLOPT_VERBOSE => 1));
		$request = $curl->get_url_data($image);
		$response = $request->result();
		$settings[] = array('Response url:', $response['url']);
		$settings[] = array('Return code:', $response['code']);
		$settings[] = array('Error:', $response['error']);
		$settings[] = array('Response size:', $response['size']);

   		$respstr = '';
        if (!empty($response['headers'])) {
    		foreach ($response['headers'] AS $ix=>$header)
    			$respstr .= $ix . ': ' . $header . '<br>';
        }

		$settings[] = array('Headers:', $respstr);
	}

	dumpTable($settings);

	return;
}

//*** See if sockets works...
function doSockets() {

	global $image;

	$parsed = parse_url($image);

	$settings = array();
	$settings[0] = array('Sockets attempt...');

	$fp = @fsockopen($parsed['host'], 80, $errno, $errstr, 15);
	$settings[] = array('Host:', $parsed['host']);
	$settings[] = array('Connect Result:', (string) $fp);
	$settings[] = array('Connect Error:', $errno);
	$settings[] = array('Connect Error String:', $errstr);	

    if ($fp === false) {
    	dumpTable($settings);
        return;
    }

	fwrite($fp, 'GET ' . $parsed['path'] . ' HTTP/1.0' . "\r\n");
	fwrite($fp, 'Host: ' . $parsed['host'] . "\r\n");
	fwrite($fp, 'User-Agent: PHP/SMF' . "\r\n");
	fwrite($fp, 'Connection: close' . "\r\n\r\n");	
	
	// get the headers
	$headers = '';
	while (!feof($fp) && trim($header = fgets($fp, 4096)) != '')
		$headers .= $header;
	$settings[] = array('Headers:', nl2br($headers));
	
	// get the content
	$pic = '';
	while (!feof($fp))
		$pic .= fread($fp, 4096);
	fclose($fp);

	$resource = finfo_open(FILEINFO_MIME_TYPE);
	$type = finfo_buffer($resource, $pic);
	$settings[] = array('content-type (from finfo):', $type);
	$settings[] = array('Size (string length):', strlen($pic));

	dumpTable($settings);
	
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

//*** Strip quotes
function stripQuotes($string) {

	if (strlen($string) > 1 
	&& substr($string, 0, 1) == substr($string, strlen($string) - 1, 1) 
	&& in_array(substr($string, 0, 1), array('"', "'"))) {
		$string = substr($string, 1, strlen($string) - 2);
	}
	return $string;
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