<?php 
// 
// An SMF utility to dump SSL information to help diagnose issues.
//
// ***** SMF 2.0 & 2.1 *****
// ***** MySQL & Postgresql *****
//
// Usage guidelines:
// (1) Copy this file to your base SMF directory - (the one with Settings.php in it).
// (2) Execute it from your browser.
// (3) Delete it when you're done.
//     by sbulen
// 

//*** Main program
doStartup();
doSettingsFile();
doEnvChecks();
doSettingsTable();
dumpThemes();
doWrapUp();
return;

//*** Startup 
function doStartup() {

	// Without this header, flushes don't work...
	header( 'Content-type: text/html; charset=utf-8' );
	echo("<br>*********************************<br>");
	echo("******* SMF SSL diagnostic ********<br>");
	echo("*********************************<br>");

	define('SMF', 1);
	
	// Yes, both flushes necessary
	@ob_flush();
	@flush();
	
	return;
}

//*** Settings File 
function doSettingsFile() {

	global $db_type, $db_connection, $db_prefix, $db_name, $smcFunc, $boardurl;
	$smcFunc = array();

	$dumpvars = array('mbname', 'db_server', 'db_name', 'boardurl', 'image_proxy_enabled', 'image_proxy_secret', 'image_proxy_maxsize');

	// Load the settings...
	require_once(dirname(__FILE__) . '/Settings.php');

	$settings = array();
	$settings[0] = array('Settings.php Var','Value');
	foreach($dumpvars as $setting)
		$settings[] = array('$' . $setting, (isset(${$setting}) ? ${$setting} : '<strong>NOT SET</strong>'));
	
	dumpTable($settings);

	// Get the database going!
	if (empty($db_type) || $db_type == 'mysqli')
		$db_type = 'mysql';

	// Make the connection...
	require_once($sourcedir . '/Subs-Db-' . $db_type . '.php');
	$db_connection = smf_db_initiate($db_server, $db_name, $db_user, $db_passwd, $db_prefix);

	return;
}

//*** Some environment checks
function doEnvChecks() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$settings = array();
	$settings[0] = array('Environment Check','Result');

	$settings[] = array('$_SERVER["HTTPS"]', isset($_SERVER["HTTPS"]) ? $_SERVER["HTTPS"] : '<strong>NOT SET</strong>');
	
	// Is cert installed?
	$settings[] = array('Certificate detected? ', ssl_cert_found() ? 'Yes' : '<strong>No</strong>');

	// Is redirect active?
	$settings[] = array('Redirect detected? ', https_redirect_active() ? 'Yes' : '<strong>No</strong>');

	// Use file_get_contents to test reading the site via http & https.  This can be very slow...

	// Do it this way in case there's a subfolder...
	$uri =  $_SERVER["REQUEST_URI"];
	$uri = str_replace('SMF_SSL_Diag.php', 'index.php', $uri);
	
	//Check to see if we can read this file via http
	$file = 'http://' . $_SERVER["SERVER_NAME"] . $uri;
	$result = @file_get_contents($file, false);
	$settings[] = array('Test read of: ' . $file, $result !== false ? 'Successful' : '<strong>Not successful</strong>');

	//Check to see if we can read this file via https
	$file = 'https://' . $_SERVER["SERVER_NAME"] . $uri;
	$result = @file_get_contents($file, false);
	$settings[] = array('Test read of: ' . $file, $result !== false ? 'Successful' : '<strong>Not successful</strong>');
	
	dumpTable($settings);

	return;
}

//*** Settings Table 
function doSettingsTable() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$settings = array();
	$settings[0] = array('Settings Table Var','Value');

	$dumpvars = array('smfVersion', 'force_ssl', 'avatar_url', 'custom_avatar_url', 'smileys_url');

	foreach ($dumpvars as $setting) {
		$result = $smcFunc['db_query']('', '
			SELECT value FROM {db_prefix}settings
			 WHERE variable = {string:setting_var};',
			array(
				'setting_var' => $setting,
			)
		);
		$row = $smcFunc['db_fetch_row']($result);
		$smcFunc['db_free_result']($result);
		$settings[] = array($setting, (!is_null($row[0]) ? $row[0] : '<strong>NOT SET</strong>'));
	}

	dumpTable($settings);

	return;
}

//*** Check Themes Table
function dumpThemes() {

	global $smcFunc, $db_type, $db_connection, $db_prefix, $db_name;

	$settings = array();
	$settings[0] = array('Theme ID', 'Variable', 'Value');

	// Look for Theme URLs
	$result = $smcFunc['db_query']('', '
		SELECT id_theme, variable, value FROM {db_prefix}themes
		 WHERE variable IN ({array_string:theme_vars});',
		array(
			'theme_vars' => array('theme_url', 'images_url'),
		)
	);
	// Do each theme
	 while ($row = $smcFunc['db_fetch_assoc']($result))
		$settings[] = array($row['id_theme'], $row['variable'], $row['value']);

	$smcFunc['db_free_result']($result);

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

//*** Check if current domain has a cert
// Adapted from: https://stackoverflow.com/questions/27689147/how-to-check-if-domain-has-ssl-certificate-or-not
// 
function ssl_cert_found() {

	$url = 'https://' . $_SERVER["SERVER_NAME"];

	$result = false;
	$stream = stream_context_create (array("ssl" => array("capture_peer_cert" => true)));
	$read = @fopen($url, "rb", false, $stream);
	if ($read !== false) {
		$cont = stream_context_get_params($read);
		$result = isset($cont["options"]["ssl"]["peer_certificate"]) ? true : false;
	}
    return $result;
}

//*** Check if $boardurl has a redirect to https:// by querying headers
// 
function https_redirect_active() {

	global $boardurl;

	// Ask for the headers for the current $boardurl, but via http...
	// Need to add the trailing slash, or it puts it there & thinks there's a redirect when there isn't...
	$url = str_ireplace('https://', 'http://', $boardurl) . '/';
	$headers = @get_headers($url);
	if ($headers === false)
		return false;

	// Dump the headers
	$settings = array();
	$settings[0] = array('Response Header for: ' . $url);
	$settings[] = array(implode('<br>', $headers));
	dumpTable($settings);
	
	// Now to see if it came back https...   
	// First check for a redirect status code in first row (301, 302, 307)
	if (strstr($headers[0], '301') === false && strstr($headers[0], '302') === false && strstr($headers[0], '307') === false)
		return false;
	
	// Search for the location entry to confirm https
	$result = false;
	foreach ($headers as $header) {
		if (stristr($header, 'Location: https://') !== false) {
			$result = true;
			break;
		}
	}
	return $result;		
}

//*** Check if current domain has a redirect to https:// using cURL
// Adapted from: https://stackoverflow.com/questions/2964834/php-check-if-url-redirects
// 
function https_redirect_active_curl() {

	$url = 'http://' . $_SERVER["SERVER_NAME"];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, '60'); // in seconds
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($ch);

	if(substr(curl_getinfo($ch)['url'], 0, 8) === 'https://')
		return true;
	else
		return false;
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