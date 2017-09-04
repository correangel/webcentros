<?php

if ( !defined('IN_PHPATM') )
{
	die("Hacking attempt");
}

include('include/functions.'.$phpExt);

$header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')) ) ? 'Refresh: 0; URL=' : 'Location: ';

if (is_ip_blocked(getenv('REMOTE_ADDR')))
{
	header($header_location.'ipblocked.'.$phpExt);
	exit;
}

session_start();

$version = phpversion();
$major = substr($version, 0, 1);
$release = substr($version, 2, 1);

if ($major < 4)
{
	die("Wrong PHP Version: minimum required 4.0.0 - currently installed ".phpversion()."<BR>Please upgrade");
}
elseif ($major > 4 || $release > 0)
{
	$sysarr = array($_GET, $_SESSION, $_COOKIE, $_POST, $_FILES);
}
else
{
	$sysarr = array($HTTP_GET_VARS, $HTTP_SESSION_VARS, $HTTP_COOKIE_VARS, $HTTP_POST_VARS, $HTTP_POST_FILES);
}

while (list(, $arr) = each($sysarr))
{
	if (is_array($arr))
	{
		while (list($key, $value) = each($arr))
		{
			$GLOBALS[$key] = $value;
		}
	}
}

header("Expires: Mon, 03 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

if (!isset($action))
	$action = '';

if (!isset($logged_user_name))
	$logged_user_name = '';

if (!isset($language))
	$language = $dft_language;

$activationcode = USER_DISABLED;
$user_status = ANONYMOUS;

if ($logged_user_name != '' && !check_is_user_session_active($logged_user_name))
{
	$user_status = ADMIN;
	$logged_user_name = 'Admin';
}

if ($user_status == ANONYMOUS)
  $logged_user_name = '';

if ($activationcode != USER_ACTIVE)
{
  $user_status = ANONYMOUS;
  $logged_user_name = '';
}

if (!isset($languages) || !is_array($languages))
{
	$languages = available_languages($languages_folder_name);
	if ($major > 4 || $release > 0)
	{
		$_SESSION['languages'] = $languages;
	}
	else
	{
		$HTTP_SESSION_VARS['languages'] = $languages;
	}
}
$timeoffset = -$GMToffset + $languages[$language]['TimeZone'];
require("${languages_folder_name}/${language}.${phpExt}");

?>
