<?php
require_once("../bootstrap.php");
require_once("../config.php");

if (! isset($config['mod_documentos']) || $config['mod_documentos'] != 1) {
	include("../error404.php");
}

if ( !defined('IN_PHPATM') )
{
	die("Hacking attempt");
}

//
//
$phpExt = 'php';

//
include('include/constants.'.$phpExt);

//
$homeurl = WEBCENTROS_DOMINIO."documentos/index.php";

$uploads_folder_name = $config['mod_documentos_dir'];
$languages_folder_name = 'languages';

//
$cookiesecure = false;
$cookievalidity = 8760; //hours

//  STATUS    => array(view,    modown,  delown,  download, mail,    upload,  mkdir,   modall,  delall,  mailall,  webcopy)
//                       V        V        V        V         V        V        V        V        V        V         V
$grants = array(
	ANONYMOUS => array(FALSE,    FALSE,    FALSE,    FALSE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE ),
	www       => array(FALSE,    FALSE,    FALSE,    FALSE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE ),
	UPLOADER  => array(FALSE,    FALSE,    FALSE,    FALSE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE ),
	VIEWER    => array(FALSE,    FALSE,    FALSE,    FALSE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE ),
	NORMAL    => array(FALSE,    FALSE,    FALSE,    FALSE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE ),
	POWER     => array(TRUE,    FALSE,    FALSE,    TRUE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE ),
	ADMIN     => array(FALSE,    FALSE,    FALSE,    FALSE,     FALSE,    FALSE,    FALSE,    FALSE,    FALSE ,   FALSE,     FALSE )
);

//
$default_user_status = ANONYMOUS;

//
$page_title = 'Archivos del '.$config['centro_denominacion'];

//
$GMToffset = date('Z')/3600;

$maintenance_time = 2;

//

$mail_functions_enabled = false;

//
$max_filesize_to_mail = 10000;

$require_email_confirmation = false;

//
$max_last_files = 12;

//
$max_topdownloaded_files = 10;

//
$dft_language = 'es';


//
$max_allowed_filesize = 50000;

//
$datetimeformat = 'd.m.Y H:i';

//
$file_name_max_caracters = 150;

//
$file_out_max_caracters = 40;

//
//
$comment_max_caracters = 300;

//

$rejectedfiles = "^index\.|\.desc$|\.dlcnt$|\.php$|\.php3$|\.cgi$|\.pl$";

//
$showhidden = false;

//
//
$hidden_dirs = "^_vti_";

//
$mimetypes = array (
'.txt'  => array('img' => 'far fa-lg fa-edit',    'mime' => 'text/plain'),
'.html' => array('img' => 'far fa-lg fa-globe',   'mime' => 'text/html'),
'.htm'  => array('img' => 'far fa-lg fa-globe',   'mime' => 'text/html'),
'.mdb'  => array('img' => 'far fa-lg fa-database',    'mime' => 'application/vnd.ms-access'),
'.doc'  => array('img' => 'far fa-lg fa-file-word',    'mime' => 'application/msword'),
'.docx' => array('img' => 'far fa-lg fa-file-word',    'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
'.dotx' => array('img' => 'far fa-lg fa-file-word',    'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template'),
'.docm' => array('img' => 'far fa-lg fa-file-word',    'mime' => ' application/vnd.ms-word.document.macroEnabled.12'),
'.dotm' => array('img' => 'far fa-lg fa-file-word',    'mime' => ' application/vnd.ms-word.template.macroEnabled.12'),
'.odf'  => array('img' => 'far fa-lg fa-file-word',    'mime' => 'application/msword'),
'.odt'  => array('img' => 'far fa-lg fa-file-word',    'mime' => 'application/msword'),
'.ppt'  => array('img' => 'far fa-lg fa-file-powerpoint',    'mime' => 'application/msword'),
'.pptx' => array('img' => 'far fa-lg fa-file-powerpoint',    'mime' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation'),
'.ppsx' => array('img' => 'far fa-lg fa-file-powerpoint',    'mime' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow'),
'.pptm' => array('img' => 'far fa-lg fa-file-powerpoint',    'mime' => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12'),
'.pdf'  => array('img' => 'far fa-lg fa-file-pdf',    'mime' => 'application/pdf'),
'.xls'  => array('img' => 'far fa-lg fa-file-excel',    'mime' => 'application/msexcel'),
'.xlsx'  => array('img' => 'far fa-lg fa-file-excel',    'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
'.xltx'  => array('img' => 'far fa-lg fa-file-excel',    'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template'),
'.xlsm'  => array('img' => 'far fa-lg fa-file-excel',    'mime' => 'application/vnd.ms-excel.sheet.macroEnabled.12'),
'.xltm'  => array('img' => 'far fa-lg fa-file-excel',    'mime' => 'application/vnd.ms-excel.template.macroEnabled.12'),
'.gif'  => array('img' => 'far fa-lg fa-file-image',    'mime' => 'image/gif'),
'.jpg'  => array('img' => 'far fa-lg fa-file-image',    'mime' => 'image/jpeg'),
'.jpeg' => array('img' => 'far fa-lg fa-file-image',    'mime' => 'image/jpeg'),
'.bmp'  => array('img' => 'far fa-lg fa-file-image',    'mime' => 'image/bmp'),
'.png'  => array('img' => 'far fa-lg fa-file-image',    'mime' => 'image/png'),
'.zip'  => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/zip'),
'.rar'  => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/x-rar-compressed'),
'.gz'   => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/x-compressed'),
'.tgz'  => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/x-compressed'),
'.z'    => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/x-compress'),
'.exe'  => array('img' => 'far fa-lg fa-gear',			'mime' => 'application/x-msdownload'),
'.mid'  => array('img' => 'far fa-lg fa-file-sound',    'mime' => 'audio/mid'),
'.midi' => array('img' => 'far fa-lg fa-file-sound',    'mime' => 'audio/mid'),
'.wav'  => array('img' => 'far fa-lg fa-file-sound',    'mime' => 'audio/x-wav'),
'.mp3'  => array('img' => 'far fa-lg fa-file-sound',    'mime' => 'audio/x-mpeg'),
'.avi'  => array('img' => 'far fa-lg fa-file-movie',    'mime' => 'video/x-msvideo'),
'.mpg'  => array('img' => 'far fa-lg fa-file-movie',    'mime' => 'video/mpeg'),
'.mpeg' => array('img' => 'far fa-lg fa-file-movie',    'mime' => 'video/mpeg'),
'.mov'  => array('img' => 'far fa-lg fa-file-movie',    'mime' => 'video/quicktime'),
'.swf'  => array('img' => 'far fa-lg fa-file-flash',  'mime' => 'application/x-shockwave-flash'),
'.gtar' => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/x-gtar'),
'.tar'  => array('img' => 'far fa-lg fa-file-zip',    'mime' => 'application/x-tar'),
'.tiff' => array('img' => 'far fa-lg fa-file-image', 'mime' => 'image/tiff'),
'.tif'  => array('img' => 'far fa-lg fa-file-image', 'mime' => 'image/tiff'),
'.rtf'  => array('img' => 'far fa-lg fa-edit',    'mime' => 'application/rtf'),
'.ps'   => array('img' => 'far fa-lg fa-file-pdf', 'mime' => 'application/postscript'),
'.qt'   => array('img' => 'far fa-lg fa-file-movie'  ,  'mime' => 'video/quicktime'),
'directory' => array('img' => 'far fa-lg fa-folder-open', 'mime' => ''),
'default' =>   array('img' => 'far fa-lg fa-file',  'mime' => 'application/octet-stream')
);

//
$invalidchars = array (
"'",
"\"",
"\"",
'&',
',',
';',
'/',
"\\",
'`',
'<',
'>',
':',
'*',
'|',
'?',
'�',
'+',
'^',
'(',
')',
'=',
'$',
'%'
);

//
//$ip_black_list = array (
//'127.0.0.2',
//'127.0.0.3',
//);

?>
