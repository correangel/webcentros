<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed');

function ft_settings_external_load() {
  global $config, $db_con;
  $ft = array();
  $ft['settings'] = array();
  $ft['groups'] = array();
  $ft['users'] = array();
  $ft['plugins'] = array();
  $ft["settings"]["DIR"] = rtrim($config['mod_documentos_dir'], '/'); // Your default directory. Do NOT include a trailing slash!
  $ft["settings"]["LANG"]              = "es"; // Language. Do not change unless you have downloaded language file.
  $ft["settings"]["MAXSIZE"]           = 12582912; // Maximum file upload size - in bytes.
  $ft["settings"]["PERMISSION"]        = 0644; // Permission for uploaded files.
  $ft["settings"]["DIRPERMISSION"]     = 0777; // Permission for newly created folders.
  $ft["settings"]["HIDEFILEPATHS"]     = TRUE; // Set to TRUE to pass downloads through File Thingie.
  $ft["settings"]["SHOWDATES"]         = 'd/m/Y \a \l\a\s h:i'; // Set to a date format to display last modified date (e.g. 'Y-m-d'). See http://dk2.php.net/manual/en/function.date.php
  $ft["settings"]["FILEBLACKLIST"]     = ".DS_Store ._.DS_Store"; // Specific files that will not be shown.
  $ft["settings"]["FOLDERBLACKLIST"]   = ""; // Specifies folders that will not be shown. No starting or trailing slashes!
  $ft["settings"]["FILETYPEBLACKLIST"] = "php php5 php6 php7 phtml htm html js css bin run sh rb exe deb rpm"; // File types that are not allowed for upload.
  $ft["settings"]["FILETYPEWHITELIST"] = ""; // Add file types here to *only* allow those types to be uploaded.
  $ft["settings"]["LIMIT"]             = 0; // Restrict total dir file usage to this amount of bytes. Set to "0" for no limit.
  $ft["settings"]["REQUEST_URI"]       = FALSE; // Installation path. You only need to set this if $_SERVER['REQUEST_URI'] is not being set by your server.
  $ft["settings"]["HTTPS"]             = TRUE; // Change to TRUE to enable HTTPS support.
  $ft["settings"]["UPLOAD"]            = FALSE; // Set to FALSE if you want to disable file uploads.
  $ft["settings"]["CREATE"]            = FALSE; // Set to FALSE if you want to disable file/folder/url creation.
  $ft["settings"]["FILEACTIONS"]       = FALSE; // Set to FALSE if you want to disable file actions (rename, move, delete, edit, duplicate).
  $ft["settings"]["DELETEFOLDERS"]     = FALSE; // Set to TRUE to allow deletion of non-empty folders.
  $ft["settings"]["ADVANCEDACTIONS"]   = FALSE; // Set to TRUE to enable advanced actions like chmod and symlinks.

  return $ft;
}
