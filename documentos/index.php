<?php
require_once("../bootstrap.php");
require_once("../config.php");

/**
 * @file
 * File Thingie - Andreas Haugstrup Pedersen <andreas@solitude.dk>
 * The newest version of File Thingie can be found at <http://www.solitude.dk/filethingie/>
*
* Copyright (c) 2003-2012 Andreas Haugstrup Pedersen
*
* Permission is hereby granted, free of charge, to any person obtaining
* a copy of this software and associated documentation files (the
* "Software"), to deal in the Software without restriction, including
* without limitation the rights to use, copy, modify, merge, publish,
* distribute, sublicense, and/or sell copies of the Software, and to
* permit persons to whom the Software is furnished to do so, subject to
* the following conditions:
*
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
* MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
* LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
* WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

define("MUTEX", $_SERVER['PHP_SELF']);

$ft = array();
$ft['settings'] = array();
$ft['groups'] = array();
$ft['users'] = array();
$ft['plugins'] = array();

/**
 * Check if directory is on the blacklist.
 *
 * @param $dir
 *   Directory path.
 * @return TRUE if directory is not blacklisted.
 */
function ft_check_dir($dir) {
	// Check against folder blacklist.
	if (FOLDERBLACKLIST != "") {
		$blacklist = explode(" ", FOLDERBLACKLIST);
		foreach ($blacklist as $c) {
      if (substr($dir, 0, strlen(ft_get_root().'/'.$c)) == ft_get_root().'/'.$c) {
        return FALSE;
      }
		}
		return TRUE;
	} else {
		return TRUE;
	}
}

/**
 * Check if file actions are allowed in the current directory.
 *
 * @return TRUE is file actions are allowed.
 */
function ft_check_fileactions() {
  if (FILEACTIONS === TRUE) {
    // Uploads are universally turned on.
    return TRUE;
  } else if (FILEACTIONS == TRUE && FILEACTIONS == substr(ft_get_dir(), 0, strlen(FILEACTIONS))) {
    // Uploads are allowed in the current directory and subdirectories only.
    return TRUE;
  }
  return FALSE;
}

/**
 * Check if the filename provided is valid.
 * Filename should not include any unwanted characters, leading or trailing periods.
 * @param $file File name.
 * @return bool True if the filename is valid.
 */
function ft_validate_filename($file)
{
	// Make sure the file doesn't start with a period, contain unwanted characters, or end in a period.
	$pattern = '/^[^\.:?"\\/<>|]((\.)?(([\w~\s-áéíóúàèìòùñäëïöüâêîôûÁÉÍÓÚÀÈÌÒÙÑÄÂÊÎÔÛËÏÖÜ]){1,}))+$/';
	$result = preg_match($pattern, $file);
	return $result;
}

/**
 * Check if file is on the blacklist.
 *
 * @param $file
 *   File name.
 * @return TRUE if file is not blacklisted.
 */
function ft_check_file($file) {
	// Check against file blacklist.
	if (FILEBLACKLIST != "") {
		$blacklist = explode(" ", strtolower(FILEBLACKLIST));
		if (in_array(strtolower($file), $blacklist)) {
			return FALSE;
		} else {
			return TRUE;
		}
	} else {
		return TRUE;
	}
}

/**
 * Check if file type is on the blacklist.
 *
 * @param $file
 *   File name.
 * @return TRUE if file is not blacklisted.
 */
function ft_check_filetype($file) {
	$type = strtolower(ft_get_ext($file));
	// Check if we are using a whitelist.
	if (FILETYPEWHITELIST != "") {
		// User wants a whitelist
		$whitelist = explode(" ", FILETYPEWHITELIST);
		if (in_array($type, $whitelist)) {
			return TRUE;
		} else {
			return FALSE;
		}
	} else {
		// Check against file blacklist.
		if (FILETYPEBLACKLIST != "") {
			$blacklist = explode(" ", FILETYPEBLACKLIST);
			if (in_array($type, $blacklist)) {
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
		}
	}
}

/**
 * Check if a move action is inside the file actions area if FILEACTIONS is set to a specific director.
 *
 * @param $dest
 *   The directory to move to.
 * @return TRUE if move action is allowed.
 */
function ft_check_move($dest) {
  if (FILEACTIONS === TRUE) {
    return TRUE;
  }
  // Check if destination is within the fileactions area.
  $dest = substr($dest, 0, strlen($dest));
  $levels = substr_count(substr(ft_get_dir(), strlen(FILEACTIONS)), '/');
  if ($levels <= substr_count($dest, '../')) {
    return TRUE;
  } else {
    return FALSE;
  }
}

/**
 * Check if uploads are allowed in the current directory.
 *
 * @return TRUE if uploads are allowed.
 */
function ft_check_upload() {
  if (UPLOAD === TRUE) {
    // Uploads are universally turned on.
    return TRUE;
  } else if (UPLOAD == TRUE && UPLOAD == substr(ft_get_dir(), 0, strlen(UPLOAD))) {
    // Uploads are allowed in the current directory and subdirectories only.
    return TRUE;
  }
  return FALSE;
}

/**
 * Remove unwanted characters from the settings array.
 */
function ft_clean_settings($settings) {
  // TODO: Clean DIR, UPLOAD and FILEACTIONS so they can't start with ../
  return $settings;
}

/**
 * Run all system actions based on the value of $_REQUEST['act'].
 */
function ft_do_action() {
	if (!empty($_REQUEST['act'])) {

    // Only one callback action is allowed. So only the first hook that acts on an action is run.
    ft_invoke_hook('action', $_REQUEST['act']);

		# mkdir
		if ($_REQUEST['act'] == "createdir" && CREATE === TRUE) {
		  $_POST['newdir'] = trim($_POST['newdir']);
			// Create directory.
			// Check input.
      // if (strstr($_POST['newdir'], ".")) {
				// Throw error (redirect).
        // ft_redirect("status=createddirfail&dir=".$_REQUEST['dir']);
      // } else {
				$_POST['newdir'] = ft_stripslashes($_POST['newdir']);
				$newdir = ft_get_dir()."/{$_POST['newdir']}";
				$oldumask = umask(0);
				if (strlen($_POST['newdir']) > 0 && @mkdir($newdir, DIRPERMISSION)) {
					ft_redirect("dir=".$_REQUEST['dir']);
				} else {
					// Redirect
					ft_set_message(t("Directory could not be created."), 'error');
					ft_redirect("dir=".$_REQUEST['dir']);
				}
				umask($oldumask);
      // }
		# Move
		} elseif ($_REQUEST['act'] == "move" && ft_check_fileactions() === TRUE) {
			// Check that both file and newvalue are set.
			$file = trim(ft_stripslashes($_REQUEST['file']));
			$dir = trim(ft_stripslashes($_REQUEST['newvalue']));
			if (substr($dir, -1, 1) != "/") {
				$dir .= "/";
			}
			// Check for level.
			if (substr_count($dir, "../") <= substr_count(ft_get_dir(), "/") && ft_check_move($dir) === TRUE) {
				$dir  = ft_get_dir()."/".$dir;
				if (!empty($file) && file_exists(ft_get_dir()."/".$file)) {
					// Check that destination exists and is a directory.
					if (is_dir($dir)) {
						// Move file.
						if (@rename(ft_get_dir()."/".$file, $dir."/".$file)) {
							// Success.
							ft_redirect("dir={$_REQUEST['dir']}");
						} else {
							// Error rename failed.
							ft_set_message(t("!old could not be moved.", array('!old' => $file)), 'error');
							ft_redirect("dir={$_REQUEST['dir']}");
						}
					} else {
						// Error dest. isn't a dir or doesn't exist.
						ft_set_message(t("Could not move file. !old does not exist or is not a directory.", array('!old' => $dir)), 'error');
						ft_redirect("dir={$_REQUEST['dir']}");
					}
				} else {
					// Error source file doesn't exist.
					ft_set_message(t("!old could not be moved. It doesn't exist.", array('!old' => $file)), 'error');
					ft_redirect("dir={$_REQUEST['dir']}");
				}
			} else {
				// Error level
				ft_set_message(t("!old could not be moved outside the base directory.", array('!old' => $file)), 'error');
				ft_redirect("dir={$_REQUEST['dir']}");
			}
		# Delete
		} elseif ($_REQUEST['act'] == "delete" && ft_check_fileactions() === TRUE) {
			// Check that file is set.
			$file = ft_stripslashes($_REQUEST['file']);
			if (!empty($file) && ft_check_file($file)) {
				if (is_dir(ft_get_dir()."/".$file)) {
          if (DELETEFOLDERS == TRUE) {
            ft_rmdir_recurse(ft_get_dir()."/".$file);
          }
					if (!@rmdir(ft_get_dir()."/".$file)) {
					  ft_set_message(t("!old could not be deleted.", array('!old' => $file)), 'error');
						ft_redirect("dir={$_REQUEST['dir']}");
					} else {
						ft_redirect("dir={$_REQUEST['dir']}");
					}
				} else {
					if (!@unlink(ft_get_dir()."/".$file)) {
					  ft_set_message(t("!old could not be deleted.", array('!old' => $file)), 'error');
						ft_redirect("dir={$_REQUEST['dir']}");
					} else {
						ft_redirect("dir={$_REQUEST['dir']}");
					}
				}
			} else {
			  ft_set_message(t("!old could not be deleted.", array('!old' => $file)), 'error');
				ft_redirect("dir={$_REQUEST['dir']}");
			}
		# Rename && Duplicate && Symlink
		} elseif ($_REQUEST['act'] == "rename" || $_REQUEST['act'] == "duplicate" && ft_check_fileactions() === TRUE) {
			// Check that both file and newvalue are set.
			$old = trim(ft_stripslashes($_REQUEST['file']));
			$new = trim(ft_stripslashes($_REQUEST['newvalue']));
			if ($_REQUEST['act'] == 'rename') {
			  $m['typefail'] = t("!old was not renamed to !new (type not allowed).", array('!old' => $old, '!new' => $new));
			  $m['writefail'] = t("!old could not be renamed (write failed).", array('!old' => $old));
			  $m['destfail'] = t("File could not be renamed to !new since it already exists.", array('!new' => $new));
			  $m['emptyfail'] = t("File could not be renamed since you didn't specify a new name.");
			} elseif ($_REQUEST['act'] == 'duplicate') {
			  $m['typefail'] = t("!old was not duplicated to !new (type not allowed).", array('!old' => $old, '!new' => $new));
			  $m['writefail'] = t("!old could not be duplicated (write failed).", array('!old' => $old));
			  $m['destfail'] = t("File could not be duplicated to !new since it already exists.", array('!new' => $new));
			  $m['emptyfail'] = t("File could not be duplicated since you didn't specify a new name.");
			}
			if (!empty($old) && !empty($new)) {
				if (ft_check_filetype($new) && ft_check_file($new)) {
					// Make sure destination file doesn't exist.
					if (!file_exists(ft_get_dir()."/".$new)) {
						// Check that file exists.
						if (is_writeable(ft_get_dir()."/".$old)) {
							if ($_REQUEST['act'] == "rename") {
								if (@rename(ft_get_dir()."/".$old, ft_get_dir()."/".$new)) {
									// Success.
									ft_redirect("dir={$_REQUEST['dir']}");
								} else {
									// Error rename failed.
									ft_set_message(t("!old could not be renamed.", array('!old' => $old)), 'error');
									ft_redirect("dir={$_REQUEST['dir']}");
								}
							} else {
								if (@copy(ft_get_dir()."/".$old, ft_get_dir()."/".$new)) {
									// Success.
									ft_redirect("dir={$_REQUEST['dir']}");
								} else {
									// Error rename failed.
									ft_set_message(t("!old could not be duplicated.", array('!old' => $old)), 'error');
									ft_redirect("dir={$_REQUEST['dir']}");
								}
							}
						} else {
							// Error old file isn't writeable.
							ft_set_message($m['writefail'], 'error');
							ft_redirect("dir={$_REQUEST['dir']}");
						}
					} else {
						// Error destination exists.
						ft_set_message($m['destfail'], 'error');
						ft_redirect("dir={$_REQUEST['dir']}");
					}
				} else {
					// Error file type not allowed.
					ft_set_message($m['typefail'], 'error');
					ft_redirect("dir={$_REQUEST['dir']}");
				}
			} else {
				// Error. File name not set.
				ft_set_message($m['emptyfail'], 'error');
				ft_redirect("dir={$_REQUEST['dir']}");
			}
		# upload
		} elseif ($_REQUEST['act'] == "upload" && ft_check_upload() === TRUE && (LIMIT <= 0 || LIMIT > ROOTDIRSIZE)) {
			// If we are to upload a file we will do so.
			$msglist = 0;
			foreach ($_FILES as $k => $c) {
				if (!empty($c['name'])) {
					$c['name'] = ft_stripslashes($c['name']);
					if ($c['error'] == 0) {
						// Upload was successfull
						if (ft_validate_filename($c['name']) && ft_check_filetype($c['name']) && ft_check_file($c['name'])) {
							if (file_exists(ft_get_dir()."/{$c['name']}")) {
							  $msglist++;
							  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("File already exists"), 'error');
							} else {
								if (@move_uploaded_file($c['tmp_name'], ft_get_dir()."/{$c['name']}")) {
									@chmod(ft_get_dir()."/{$c['name']}", PERMISSION);
									// Success!
									$msglist++;
                  ft_invoke_hook('upload', ft_get_dir(), $c['name']);
								} else {
									// File couldn't be moved. Throw error.
  							  $msglist++;
                  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("File couldn't be moved"), 'error');
								}
							}
						} else {
							// File type is not allowed. Throw error.
						  $msglist++;
              ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("File type not allowed"), 'error');
						}
					} else {
						// An error occurred.
						switch($_FILES["localfile"]["error"]) {
							case 1:
						    $msglist++;
							  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("The file was too large"), 'error');
								break;
							case 2:
						    $msglist++;
							  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("The file was larger than MAXSIZE setting."), 'error');
								break;
							case 3:
						    $msglist++;
							  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("Partial upload. Try again"), 'error');
								break;
							case 4:
						    $msglist++;
							  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("No file was uploaded. Please try again"), 'error');
								break;
							default:
						    $msglist++;
							  ft_set_message(t('!file was not uploaded.', array('!file' => ft_get_nice_filename($c['name'], 20))) . ' ' . t("Unknown error"), 'error');
								break;
						}
					}
				}
			}
			if ($msglist > 0) {
				ft_redirect("dir=".$_REQUEST['dir']);
			} else {
			  ft_set_message(t("Upload failed."), 'error');
				ft_redirect("dir=".$_REQUEST['dir']);
			}
		}
	}
}

/**
 * Convert PHP ini shorthand notation for file size to byte size.
 *
 * @return Size in bytes.
 */
function ft_get_bytes($val) {
	$val = trim($val);
	$last = strtolower($val{strlen($val)-1});
	switch($last) {
		// The 'G' modifier is available since PHP 5.1.0
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return $val;
}

/**
 * Get the total disk space consumed by files available to the current user.
 * Files and directories on blacklists are not counted.
 *
 * @param $dirname
 *   Name of the directory to scan.
 * @return Space consumed by this directory in bytes (not counting files and directories on blacklists).
 */
function ft_get_dirsize($dirname) {
  if (!is_dir($dirname) || !is_readable($dirname)) {
    return false;
  }
  $dirname_stack[] = $dirname;
  $size = 0;
  do {
    $dirname = array_shift($dirname_stack);
    $handle = opendir($dirname);
    while (false !== ($file = readdir($handle))) {
      if ($file != '.' && $file != '..' && is_readable($dirname . '/' . $file)) {
        if (is_dir($dirname . '/' . $file)) {
          if (ft_check_dir($dirname . '/' . $file)) {
            $dirname_stack[] = $dirname . '/' . $file;
          }
        } else {
          if (ft_check_file($file) && ft_check_filetype($file)) {
            $size += filesize($dirname . '/' . $file);
          }
        }
      }
    }
    closedir($handle);
  } while (count($dirname_stack) > 0);
  return $size;
}

/**
 * Get the current directory.
 *
 * @return The current directory.
 */
function ft_get_dir() {
	if (empty($_REQUEST['dir'])) {
		return ft_get_root();
	} else {
		return ft_get_root().$_REQUEST['dir'];
	}
}
/**
 * Get file extension from a file name.
 *
 * @param $name
 *   File name.
 * @return The file extension without the '.'
 */
function ft_get_ext($name) {
	if (strstr($name, ".")) {
		$ext = str_replace(".", "", strrchr($name, "."));
	} else {
		$ext = "";
	}
	return $ext;
}

/**
 * Get a list of files in a directory with metadata.
 *
 * @param $dir
 *   The directory to scan.
 * @param $sort
 *   Sorting parameter. Possible values: name, type, size, date. Defaults to 'name'.
 * @return An array of files. Each item is an array:
 *   array(
 *     'name' => '', // File name.
 *     'shortname' => '', // File name.
 *     'type' => '', // 'file' or 'dir'.
 *     'ext' => '', // File extension.
 *     'writeable' => '', // TRUE if writeable.
 *     'perms' => '', // Permissions.
 *     'modified' => '', // Last modified. Unix timestamp.
 *     'size' => '', // File size in bytes.
 *     'extras' => '' // Array of extra classes for this file.
 *   )
 */
function ft_get_filelist($dir, $sort = 'name') {
	$filelist = array();
	$subdirs = array();
	if (ft_check_dir($dir) && $dirlink = @opendir($dir)) {
		// Creates an array with all file names in current directory.
		while (($file = readdir($dirlink)) !== false) {
			if ($file != "." && $file != ".." && ((!is_dir("{$dir}/{$file}") && ft_check_file($file) && ft_check_filetype($file)) || is_dir("{$dir}/{$file}") && ft_check_dir("{$dir}/{$file}"))) { // Hide these two special cases and files and filetypes in blacklists.
				$c = array();
				$c['name'] = $file;
        // $c['shortname'] = ft_get_nice_filename($file, 20);
        $c['shortname'] = $file;
				$c['type'] = "file";
				$c['ext'] = ft_get_ext($file);
        $c['mimetype'] = mime_content_type("{$dir}/{$file}");
				$c['writeable'] = is_writeable("{$dir}/{$file}");

        // Grab extra options from plugins.
				$c['extras'] = array();
				$c['extras'] = ft_invoke_hook('fileextras', $file, $dir);

				// File permissions.
				if ($c['perms'] = @fileperms("{$dir}/{$file}")) {
  				if (is_dir("{$dir}/{$file}")) {
            $c['perms'] = substr(base_convert($c['perms'], 10, 8), 2);
          } else {
            $c['perms'] = substr(base_convert($c['perms'], 10, 8), 3);
          }
				}
        $c['modified'] = @filemtime("{$dir}/{$file}");
				$c['size'] = @filesize("{$dir}/{$file}");
				if (ft_check_dir("{$dir}/{$file}") && is_dir("{$dir}/{$file}")) {
					$c['size'] = 0;
					$c['type'] = "dir";
					if ($sublink = @opendir("{$dir}/{$file}")) {
						while (($current = readdir($sublink)) !== false) {
							if ($current != "." && $current != ".." && ft_check_file($current)) {
								$c['size']++;
							}
						}
						closedir($sublink);
					}
					$subdirs[] = $c;
				} else {
					$filelist[] = $c;
				}
			}
		}
		closedir($dirlink);
    // sort($filelist);

		// Obtain a list of columns
		$ext = array();
		$name = array();
		$date = array();
		$size = array();
    foreach ($filelist as $key => $row) {
      $ext[$key]  = strtolower($row['ext']);
      $name[$key] = strtolower($row['name']);
      $date[$key] = $row['modified'];
      $size[$key] = $row['size'];
    }

    if ($sort == 'type') {
      // Sort by file type and then name.
      array_multisort($ext, SORT_ASC, $name, SORT_ASC, $filelist);
    } elseif ($sort == 'size') {
      // Sort by filesize date and then name.
      array_multisort($size, SORT_ASC, $name, SORT_ASC, $filelist);
    } elseif ($sort == 'date') {
      // Sort by last modified date and then name.
      array_multisort($date, SORT_DESC, $name, SORT_ASC, $filelist);
    } else {
      // Sort by file name.
      array_multisort($name, SORT_ASC, $filelist);
    }
		// Always sort dirs by name.
		sort($subdirs);
		return array_merge($subdirs, $filelist);
	} else {
		return "dirfail";
	}
}

/**
 * Determine the max. size for uploaded files.
 *
 * @return Human-readable string of upload limit.
 */
function ft_get_max_upload() {
  $post_max = ft_get_bytes(ini_get('post_max_size'));
  $upload = ft_get_bytes(ini_get('upload_max_filesize'));
  // Compare ini settings.
  $max = (($post_max > $upload) ? $upload : $post_max);
  // Compare with MAXSIZE.
  if ($max > MAXSIZE) {
    $max = MAXSIZE;
  }
  return ft_get_nice_filesize($max);
}

/**
 * Shorten a file name to a given length maintaining the file extension.
 *
 * @param $name
 *   File name.
 * @param $limit
 *   The maximum length of the file name.
 * @return The shortened file name.
 */
function ft_get_nice_filename($name, $limit = -1) {
  if ($limit > 0) {
    $noext = $name;
    if (strstr($name, '.')) {
      $noext = substr($name, 0, strrpos($name, '.'));
    }
    $ext = ft_get_ext($name);
    if (strlen($noext)-3 > $limit) {
      $name = substr($noext, 0, $limit).'...';
      if ($ext != '') {
        $name = $name. '.' .$ext;
      }
    }
  }
  return $name;
}

/**
 * Convert a number of bytes to a human-readable format.
 *
 * @param $size
 *   Integer. File size in bytes.
 * @return String. Human-readable file size.
 */
function ft_get_nice_filesize($size) {
  if (empty($size)) {
    return "&mdash;";
	} elseif (strlen($size) > 6) { // Convert to megabyte
		return round($size/(1024*1024), 2)."&nbsp;MB";
	} elseif (strlen($size) > 4 || $size > 1024) { // Convert to kilobyte
		return round($size/1024, 0)."&nbsp;Kb";
	} else {
		return $size."&nbsp;b";
	}
}

/**
 * Get the root directory.
 *
 * @return The root directory.
 */
function ft_get_root() {
	return DIR;
}

/**
 * Get the name of the File Thingie file. Used in <form> actions.
 *
 * @return File name.
 */
function ft_get_self() {
	return basename($_SERVER['PHP_SELF']);
}

/**
 * Retrieve the contents of a URL.
 *
 * @return The contents of the URL as a string.
 */
function ft_get_url($url) {
	$url_parsed = parse_url($url);
	$host = $url_parsed["host"];
	$port = 0;
	$in = '';
	if (!empty($url_parsed["port"])) {
  	$port = $url_parsed["port"];
	}
	if ($port==0) {
		$port = 80;
	}
	$path = $url_parsed["path"];
	if ($url_parsed["query"] != "") {
		$path .= "?".$url_parsed["query"];
	}
	$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";
	$fp = fsockopen($host, $port, $errno, $errstr, 30);
	fwrite($fp, $out);
	$body = false;
	while ($fp && !feof($fp)) {
		$s = fgets($fp, 1024);
		if ( $body ) {
			$in .= $s;
		}
		if ( $s == "\r\n" ) {
			$body = true;
		}
	}
	fclose($fp);
	return $in;
}

/**
 * Invoke a hook in all loaded plugins.
 *
 * @param $hook
 *   Name of the hook to invoke.
 * @param ...
 *   Arguments to pass to the hook.
 * @return Array of results from all hooks run.
 */
function ft_invoke_hook() {
  global $ft;
  $args = func_get_args();
  $hook = $args[0];
  unset($args[0]);
  // Loop through loaded plugins.
  $return = array();
  if (isset($ft['loaded_plugins']) && is_array($ft['loaded_plugins'])) {
    foreach ($ft['loaded_plugins'] as $name) {
      if (function_exists('ft_'.$name.'_'.$hook)) {
        $result = call_user_func_array('ft_'.$name.'_'.$hook, $args);
        if (isset($result) && is_array($result)) {
          $return = array_merge_recursive($return, $result);
        }
        else if (isset($result)) {
          $return[] = $result;
        }
      }
    }
  }
  return $return;
}

/**
 * Create HTML for the page body. Defaults to a file list.
 */
function ft_make_body() {
	$str = "";

  // Make system messages.
	$status = '';
	if (ft_check_upload() === TRUE && is_writeable(ft_get_dir()) && (LIMIT > 0 && LIMIT < ROOTDIRSIZE)) {
	  $status = '
		<div class="col-sm-12">
			<div id="status" class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				'. t('Upload disabled. Total disk space use of !size exceeds the limit of !limit.', array('!limit' => ft_get_nice_filesize(LIMIT), '!size' => ft_get_nice_filesize(ROOTDIRSIZE))) . '
			</div>
		</div>';
	}
	$status .= ft_make_messages();
	if (empty($status)) {
    $str .= "<div class=\"col-sm-12 hidden\"></div>";
	} else {
		$str .= "<div class=\"col-sm-12\">{$status}</div>";
	}

	// Invoke page hook if an action has been set.
	if (!empty($_REQUEST['act'])) {
    return $str . '<div id="main">'.implode("\r\n", ft_invoke_hook('page', $_REQUEST['act'])).'</div>';
	}

	// If no action has been set, show a list of files.

	if (empty($_REQUEST['act']) && (empty($_REQUEST['status']) || $_REQUEST['status'] != "dirfail")) { // No action set - we show a list of files if directory has been proven openable.
    $totalsize = 0;
    // Set sorting type. Default to 'name'.
    $sort = 'name';
    $cookie_mutex = str_replace('.', '_', MUTEX);
    // If there's a GET value, use that.
    if (!empty($_GET['sort'])) {
      // Set the cookie.
      setcookie('ft_sort_'.MUTEX, $_GET['sort'], time()+60*60*24*365);
      $sort = $_GET['sort'];
    } elseif (!empty($_COOKIE['ft_sort_'.$cookie_mutex])) {
      // There's a cookie, we'll use that.
      $sort = $_COOKIE['ft_sort_'.$cookie_mutex];
    }
		$files = ft_get_filelist(ft_get_dir(), $sort);
		if (!is_array($files)) {
			// List couldn't be fetched. Throw error.
      // ft_set_message(t("Could not open directory."), 'error');
      // ft_redirect();
      $str .= '<div class="col-sm-12"><p class="lead text-muted text-center" style="margin: 40px 0;">'.t("Could not open directory.").'</p></div>';
		} else {
			// Show list of files in a table.
			$colspan = 3;
			if (SHOWDATES) {
			  $colspan = 4;
			}
      $str .= "<div class=\"col-sm-12\">";
      $str .= '<div style="margin-bottom: 20px;">';
      if (ft_check_upload() === TRUE && is_writeable(ft_get_dir())) {

    	  if (LIMIT <= 0 || LIMIT > ROOTDIRSIZE) {
          $str .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">'.t('Upload files').'</button> ';
        }
        if (CREATE) {
          $str .= '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#new">'.t('Create folder').'</button>';
        }
      }

			$str .= "<table class=\"table table-hover\" id='filelist'>";
			$str .= "<tbody>";
			$countfiles = 0;
			$countfolders = 0;
			if (count($files) <= 0) {
				$str .= "<tr><td colspan=\"{$colspan}\" class=\"lead text-muted text-center\" style=\"padding: 40px 0;\">".t('Directory is empty.')."</td></tr>";
			} else {
				$i = 0;
				$previous = $files[0]['type'];
				foreach ($files as $c) {
					$odd = "";
					$class = '';
					if ($c['writeable']) {
						$class = "show writeable ";
					}
					if ($c['type'] == 'dir' && $c['size'] == 0) {
					  $class .= " empty";
					}
          // Loop through extras and set classes.
					foreach ($c['extras'] as $extra) {
					  $class .= " {$extra}";
					}

					if (isset($c['perms'])) {
						$class .= " perm-{$c['perms']} ";
					}
					if (!empty($_GET['highlight']) && $c['name'] == $_GET['highlight']) {
						$class .= " highlight ";
						$odd = "highlight ";
					}
					if ($i%2 != 0) {
						$odd .= "odd";
					}
					if ($previous != $c['type']) {
						// Insert seperator.
						$odd .= " seperator ";
					}
					$previous = $c['type'];
					$str .= "<tr class='{$c['type']} $odd'>";

				  $plugin_data = implode('', ft_invoke_hook('filename', $c['name']));
					if ($c['type'] == "file"){
            $mimetypes = array(
              'text/plain' => 'fas fa-file-alt text-danger',
              'application/pdf' => 'fas fa-file-pdf text-danger',
              'application/msword' => 'fas fa-file-word text-info',
              'application/vnd.oasis.opendocument.text' => 'fas fa-file-word text-info',
              'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fas fa-file-word text-info',
              'application/msexcel' => 'fas fa-file-excel text-success',
              'application/vnd.ms-office' => 'fas fa-file-excel text-success',
              'application/vnd.oasis.opendocument.spreadsheet' => 'fas fa-file-excel text-success',
              'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fas fa-file-excel text-success',
              'application/vnd.ms-powerpoint' => 'fas fa-file-powerpoint text-danger',
              'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fas fa-file-powerpoint text-danger',
              'application/zip' => 'fas fa-file-archive text-warning',
              'application/x-compressed' => 'fas fa-file-archive text-warning',
              'application/x-rar-compressed' => 'fas fa-file-archive text-warning',
              'application/x-tar' => 'fas fa-file-archive text-warning',
              'image/gif' => 'fas fa-file-image text-primary',
              'image/jpeg' => 'fas fa-file-image text-primary',
              'image/bmp' => 'fas fa-file-image text-primary',
              'image/png' => 'fas fa-file-image text-primary',
              'image/tiff' => 'fas fa-file-image text-primary',
							'image/svg+xml' => 'fas fa-file-image text-primary',
							'image/vnd.adobe.photoshop' => 'fas fa-file-image text-primary',
              'audio/mid' => 'fas fa-file-audio text-primary',
              'audio/x-wav' => 'fas fa-file-audio text-primary',
              'audio/msvideo' => 'fas fa-file-audio text-primary',
              'video/x-mpeg' => 'fas fa-file-video text-primary',
              'video/quicktime' => 'fas fa-file-video text-primary',
            );

					  $link = "<a href=\"".ft_get_dir()."/".rawurlencode($c['name'])."\" title=\"" .t('Show !file', array('!file' => $c['name'])). "\"><i class=\"{$mimetypes[$c['mimetype']]} fa-lg fa-fw\"></i> {$c['shortname']}</a>";
					  if (HIDEFILEPATHS == TRUE) {
					    $link = ft_make_link('<i class="'.$mimetypes[$c['mimetype']].' fa-lg fa-fw"></i> '.$c['shortname'], 'method=getfile&amp;dir='.rawurlencode($_REQUEST['dir']).'&amp;file='.$c['name'], t('Show !file', array('!file' => $c['name'])));
					  }
						$str .= "<td class=\"name\">{$link}{$plugin_data}</td>";
						$countfiles++;
					} else {
            $str .= "<td class='name'>".ft_make_link('<i class="fas fa-folder text-info fa-lg fa-fw"></i> '.$c['shortname'], "dir=".rawurlencode($_REQUEST['dir'])."/".rawurlencode($c['name']), t("Show files in !folder", array('!folder' => $c['name'])))."{$plugin_data}</td>";
						$countfolders++;
					}

					if ($c['type'] == "file"){
            $str .= "<td class=\"d-none d-sm-block\"><span class=\"float-right\">".ft_get_nice_filesize($c['size'])."</span></td>";
          }
          else {
            $str .= "<td class=\"d-none d-sm-block\"><span class=\"float-right\">{$c['size']} ".(($c['size'] > 1) ? t('files') : 'archivo')."</span></td>";
          }
					/*
          if (SHOWDATES) {
            if ($c['type'] == "file" && isset($c['modified']) && $c['modified'] > 0) {
              $str .= "<td class='date text-center hidden-xs' nowrap>".date(SHOWDATES, $c['modified'])."</td>";
            } else {
              $str .= "<td class='date text-center hidden-xs' nowrap>&mdash;</td>";
            }
          }

          if ($c['writeable'] && ft_check_fileactions() === TRUE) {
						$str .= '
						<td class="details text-center">
							<span class="'.$class.'">
							  <button type="button" class="btn btn-default btn-xs">
							    <i class="fas fa-ellipsis-h fa-fw"></i>
							  </button>
							</span>
							<span class="hide" style="display: none;"></span>
						</td>';
					} else {
						$str .= "<td class='details text-center'>&mdash;</td>";
					}
					*/

					// Add filesize to total.
					if ($c['type'] == 'file') {
					  $totalsize = $totalsize+$c['size'];
					}

          $str .= "</tr>";

					$i++;
				}
			}
			if ($totalsize == 0) {
			  $totalsize = '';
			} else {
			  $totalsize = " (".ft_get_nice_filesize($totalsize).")";
			}
			$str .= "</tbody><tfoot><tr><td colspan=\"{$colspan}\">".$countfolders." ".t('folders')." - ".$countfiles." ".t('files')."{$totalsize}</td></tr></tfoot>";
			$str .= "</table>";
      $str .= "</div>";
		}
	}
	return $str;
}

/**
 * Create HTML for top header that shows breadcumb navigation.
 */
function ft_make_header() {
  global $ft;
	$str = '<div class="col-sm-12">';
	$str .= '<nav aria-label="breadcrumb">';
  $str .= '<ol class="breadcrumb">';
  $str .= '<li class="breadcrumb-item">'.ft_make_link(t("Home"), '', t("Go to home folder")).'</li>';
	if (! empty($_REQUEST['dir'])) {
		// Get breadcrumbs.
		if (!empty($_REQUEST['dir'])) {
			$crumbs = explode("/", $_REQUEST['dir']);
			// Remove first empty element.
			unset($crumbs[0]);
			// Output breadcrumbs.
			$path = "";
			foreach ($crumbs as $c) {
				$path .= "/{$c}";
				$str .= '<li class="breadcrumb-item">'.ft_make_link($c, "dir=".rawurlencode($path), t("Go to folder")).'</li>';
			}
		}
	}
  $str .= "</ol>";
	$str .= "</nav>";
  $str .= "</div>";
	return $str;
}

/**
 * Create HTML for error message in case output was sent to the browser.
 */
function ft_make_headers_failed() {
	return "Header failed";
}

/**
 * Create an internal HTML link.
 *
 * @param $text
 *   Link text.
 * @param $query
 *   The query string for the link. Optional.
 * @param $title
 *   String for the HTML title attribute. Optional.
 * @return String containing the HTML link.
 */
function ft_make_link($text, $query = "", $title = "") {

  $str = "<a href=\"".ft_get_self();

	if (isset($_GET['index'])) {
		$pre_query = "?index=".$_GET['index'];
	}

  if (isset($pre_query) && ! empty($query)) {
    $str .= $pre_query."&{$query}";
	}
	elseif (isset($pre_query) && empty($query)) {
    $str .= $pre_query;
	}
	else {
		$str .= "?{$query}";
	}

	$str .= "\"";
	if (!empty($title)) {
		$str .= "title=\"{$title}\"";
	}
	$str .= ">{$text}</a>";
	return $str;
}

/**
 * Create HTML for current status messages and reset status messages.
 */
function ft_make_messages() {
  $str = '';
  $msgs = array();
  if (isset($_SESSION['ft_status']) && is_array($_SESSION['ft_status'])) {
    foreach ($_SESSION['ft_status'] as $type => $messages) {
      if (is_array($messages)) {
        foreach ($messages as $m) {
          $alert_type = '';
          switch($type) {
            case 'error': $alert_type = 'danger'; break;
            case 'alert': $alert_type = 'warning'; break;
            case 'ok': $alert_type = 'success'; break;
          }
          $msgs[] = "
					<div class=\"alert alert-{$alert_type}\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Cerrar\"><span aria-hidden=\"true\">&times;</span></button>
						{$m}
					</div>";
        }
      }
    }
    // Reset messages.
    unset($_SESSION['ft_status']);
  }
  if (count($msgs) == 1) {
    return $msgs[0];
  } elseif (count($msgs) > 1) {
    $str .= "<ul>";
    foreach ($msgs as $c) {
      $str .= "<li>{$c}</li>";
    }
    $str .= "</ul>";
  }
  return $str;
}

/**
 * Create and output <script> tags for the page.
 */
function ft_make_scripts() {
  global $ft;
  $scripts = array();
  $scripts[] = 'filethingie.js';
  $result = ft_invoke_hook('add_js_file');
  $scripts = array_merge($scripts, $result);
  foreach ($scripts as $c) {
    echo "<script type='text/javascript' charset='utf-8' src='js/{$c}'></script>\r\n";
  }
}

/**
 * Create inline javascript for the HTML footer.
 *
 * @return String containing inline javascript.
 */
function ft_make_scripts_footer() {
  $result = ft_invoke_hook('add_js_call_footer');
  $str = "\r\n";
  if (count($result) > 0) {
    $str .= '<script type="text/javascript" charset="utf-8">';
    $str .= implode('', $result);
    $str .= '</script>';
  }
  return $str;
}

/**
 * Create HTML for sidebar.
 */
function ft_make_sidebar() {
  // $status = '';
  // if (ft_check_upload() === TRUE && is_writeable(ft_get_dir()) && (LIMIT > 0 && LIMIT < ROOTDIRSIZE)) {
  //   $status = '<p class="alarm">' . t('Upload disabled. Total disk space use of !size exceeds the limit of !limit.', array('!limit' => ft_get_nice_filesize(LIMIT), '!size' => ft_get_nice_filesize(ROOTDIRSIZE))) . '</p>';
  // }
  // $status .= ft_make_messages();
  // if (empty($status)) {
  //     $str .= "<div id='status' class='hidden'></div>";
  // } else {
  //  $str .= "<div id='status' class='section'><h2>".t('Results')."</h2>{$status}</div>";
  // }
	if (ft_check_upload() === TRUE && is_writeable(ft_get_dir())) {
	  if (LIMIT <= 0 || LIMIT > ROOTDIRSIZE) {
    	$str .= '
      <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabelCreate">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabelCreate">'.t('Upload').'</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Seleccione uno o varios archivos a subir</label>
                  <div id="uploadsection" style="margin-bottom: 20px;">
                    <input type="file" class="upload" name="localfile" id="localfile-0" size="12" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="'.MAXSIZE.'" />
                    <input type="hidden" name="act" value="upload" />
                    <input type="hidden" name="dir" value="'.$_REQUEST['dir'].'" />
                  </div>
                </div>
                <p><small>' . t('Max:') . ' <strong>' . ft_get_max_upload() . ' / ' . ft_get_nice_filesize((ft_get_bytes(ini_get('upload_max_filesize')) < ft_get_bytes(ini_get('post_max_size')) ? ft_get_bytes(ini_get('upload_max_filesize')) : ft_get_bytes(ini_get('post_max_size')))) . '</strong></small></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="uploadbutton" name="submit">'.t('Upload').'</button>
              </div>
            </form>
          </div>
        </div>
      </div>';
	  }
	}
	if (CREATE) {
		$str .= '
    <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNew">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabelNew">'.t('Create folder').'</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="newdir">Nombre de la carpeta</label>
                <input type="text" class="form-control" name="newdir" id="newdir" size="16" />
              </div>

              <input type="hidden" name="act" value="createdir" />
              <input type="hidden" name="dir" value="'.$_REQUEST['dir'].'" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" name="submit">'.t('Create folder').'</button>
            </div>
          </form>
        </div>
      </div>
    </div>';
	}

	return (isset($str) ? $str : false);
}

/**
 * Recursively remove a directory.
 */
function ft_rmdir_recurse($path) {
  $path= rtrim($path, '/').'/';
  $handle = opendir($path);
  for (;false !== ($file = readdir($handle));) {
    if($file != "." and $file != ".." ) {
      $fullpath = $path.$file;
      if(is_dir($fullpath)) {
        ft_rmdir_recurse($fullpath);
        if (!@rmdir($fullpath)) {
          return FALSE;
        }
      }
      else {
        if(!@unlink($fullpath)) {
          return FALSE;
        }
      }
    }
  }
  closedir($handle);
}

/**
 * Redirect to a File Thingie page.
 *
 * @param $query
 *   Query string to append to redirect.
 */
function ft_redirect($query = '') {
  if (REQUEST_URI) {
    $_SERVER['REQUEST_URI'] = REQUEST_URI;
  }
  $protocol = 'http://';
  if (HTTPS) {
    $protocol = 'https://';
  }
  if (isset($_SERVER['REQUEST_URI'])) {
  	if (stristr($_SERVER["REQUEST_URI"], "?")) {
  		$requesturi = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], "?"));
  		$location = "Location: {$protocol}{$_SERVER["HTTP_HOST"]}{$requesturi}";
  	} else {
  		$requesturi = $_SERVER["REQUEST_URI"];
  		$location = "Location: {$protocol}{$_SERVER["HTTP_HOST"]}{$requesturi}";
  	}
  } else {
		$location = "Location: {$protocol}{$_SERVER["HTTP_HOST"]}{$_SERVER['PHP_SELF']}";
  }
	if (!empty($query)) {
		if (isset($_GET['index'])) {
				$location .= "?index=".$_GET['index']."&{$query}";
		}
		else {
				$location .= "?{$query}";
		}
	}
	else {
		if (isset($_GET['index'])) {
			$location .= "?index=".$_GET['index'];
		}
	}
	header($location);
	exit;
}

/**
 * Clean user input in $_REQUEST.
 */
function ft_sanitize_request() {
  // Kill null bytes
  foreach ($_REQUEST as $k => $v) {
    $_REQUEST[$k] = str_replace("\0", 'NULL', $_REQUEST[$k]);
    $_REQUEST[$k] = str_replace(chr(0), 'NULL', $_REQUEST[$k]);
  }
  if ($_FILES && is_array($_FILES)) {
    foreach ($_FILES as $k => $v) {
      $_FILES[$k]['name'] = str_replace("\0", 'NULL', $_FILES[$k]['name']);
      $_FILES[$k]['name'] = str_replace(chr(0), 'NULL', $_FILES[$k]['name']);
      $_FILES[$k]['name'] = urldecode($_FILES[$k]['name']);
      $_FILES[$k]['name'] = str_replace("&#00", 'NULL', $_FILES[$k]['name']);
    }
  }

	// Make sure 'dir' cannot be changed to open directories outside the stated FT directory.
	if (!empty($_REQUEST['dir']) && strstr($_REQUEST['dir'], "..") || !empty($_REQUEST['dir']) && strstr($_REQUEST['dir'], "./") || empty($_REQUEST['dir'])) {
		unset($_REQUEST['dir']);
	}
	// Set 'dir' to empty if it isn't set.
	if (!isset($_REQUEST['dir']) || empty($_REQUEST['dir'])) {
		$_REQUEST['dir'] = "";
	}
	// If 'dir' is set to just / it is a security risk.
	if (trim($_REQUEST['dir']) == '/') {
	  unset($_REQUEST['dir']);
  }
	// Nuke slashes from 'file' and 'newvalue'
	if (!empty($_REQUEST['file'])) {
		$_REQUEST['file'] = trim(str_replace("/", "", $_REQUEST['file']));
	}
	if (!empty($_REQUEST['act']) && $_REQUEST['act'] != "move") {
		if (!empty($_REQUEST['newvalue'])) {
			$_REQUEST['newvalue'] = str_replace("/", "", $_REQUEST['newvalue']);
			// Nuke ../ for 'newvalue' when not moving files.
			if (stristr($_REQUEST['newvalue'], "..") || empty($_REQUEST['newvalue'])) {
				unset($_REQUEST['newvalue']);
			}
		}
	}
	// Nuke ../ for 'file' and newdir
	if (!empty($_REQUEST['file']) && stristr($_REQUEST['file'], "..") || empty($_REQUEST['file'])) {
		unset($_REQUEST['file']);
	}
	if (!empty($_POST['newdir']) && stristr($_POST['newdir'], "..") || empty($_POST['newdir'])) {
		unset($_POST['newdir']);
	}
	// Set 'q' (search queries) to empty if it isn't set.
	if (empty($_REQUEST['q'])) {
		$_REQUEST['q'] = "";
	}
}

/**
 * Set status message for display.
 *
 * @param $message
 *   Message string to display.
 * @param $type
 *   Message type. Possible values: ok, error. Default is 'ok'.
 */
function ft_set_message($message = NULL, $type = 'ok') {
  if ($message) {
    if (!isset($_SESSION['ft_status'])) {
      $_SESSION['ft_status'] = array();
    }
    if (!isset($_SESSION['ft_status'][$type])) {
      $_SESSION['ft_status'][$type] = array();
    }
    $_SESSION['ft_status'][$type][] = $message;
  }
}

/**
 * Load external configuration file.
 *
 * @param $file
 *   Path to external file to load.
 * @return Array of settings, users, groups and plugins.
 */
function ft_settings_external($file) {
  if (file_exists($file)) {
    @include_once($file);
    $json = ft_settings_external_load();
    if (!$json) {
      // Not translateable. Language info is not available yet.
      ft_set_message('Could not load external configuration.', 'error');
      return FALSE;
    }
    return $json;
  }
  return FALSE;
}

/**
 * Prepare settings. Loads configuration file is any and
 * sets the needed setting constants according to user group.
 */
function ft_settings_load() {
  global $ft;
  $settings = array();

  // Load external configuration if any.
  $json = ft_settings_external('config.php');
  if ($json) {
    // Merge settings.
    if (is_array($json['settings'])) {
      foreach ($json['settings'] as $k => $v) {
        $ft['settings'][$k] = $v;
      }
    }
    // Merge users.
    if (is_array($json['users'])) {
      foreach ($json['users'] as $k => $v) {
        $ft['users'][$k] = $v;
      }
    }
    // Merge groups.
    if (is_array($json['groups'])) {
      foreach ($json['groups'] as $k => $v) {
        $ft['groups'][$k] = $v;
      }
    }
    // Overwrite plugins
    if (is_array($json['plugins'])) {
      $ft['plugins'] = $json['plugins'];
      // foreach ($json['plugins'] as $k => $v) {
      //   $ft['plugins'][$k] = $v;
      // }
    }
  }
  else {
    die('Could not open config file. Please create config.php');
  }

  // Save default settings before groups overwrite them.
  $ft['default_settings'] = $ft['settings'];

  // Check if current user is a member of a group.
  $current_group = FALSE;
  $current_group_name = FALSE;
  if (
    !empty($_SESSION['ft_user_'.MUTEX]) &&
    is_array($ft['groups']) &&
    is_array($ft['users']) &&
    array_key_exists($_SESSION['ft_user_'.MUTEX], $ft['users']) &&
    isset($ft['groups'][$ft['users'][$_SESSION['ft_user_'.MUTEX]]['group']]) &&
    is_array($ft['groups'][$ft['users'][$_SESSION['ft_user_'.MUTEX]]['group']])) {
      $current_group = $ft['groups'][$ft['users'][$_SESSION['ft_user_'.MUTEX]]['group']];
      // $current_group_name = $ft['users'][$_SESSION['ft_user_'.MUTEX]]['group'];
  }

  // Break out plugins in the group settings.
  if (is_array($current_group) && array_key_exists('plugins', $current_group)) {
    $ft['plugins'] = $current_group['plugins'];
    unset($current_group['plugins']);
  }

  // Loop through settings. Use group values if set.
  // foreach ($constants as $k => $v) {
  foreach ($ft['settings'] as $k => $v) {
    // $new_k = substr($k, 1);
    $new_k = $k;
    if (is_array($current_group) && array_key_exists($k, $current_group)) {
      // define($new_k, $current_group[$k]);
      $settings[$new_k] = $current_group[$k];
    } else {
      // Use original value.
      // define($new_k, $v);
      $settings[$new_k] = $v;
    }
  }
  // Define constants.
  $settings = ft_clean_settings($settings);
  foreach ($settings as $k => $v) {
    define($k, $v);
  }
  // Clean up $ft.
  unset($ft['settings']);
}

/**
 * Strips slashes from string if magic quotes are on.
 *
 * @param $string
 *   String to filter.
 * @return The filtered string.
 */
function ft_stripslashes($string) {
  if (get_magic_quotes_gpc()) {
    return stripslashes($string);
  } else {
    return $string;
  }
}

/**
 * Translate a string to the current locale.
 *
 * @param $msg
 *   A string to be translated.
 * @param $vars
 *   An associative array of replacements for placeholders.
 *   Array keys in $msg will be replaced with array values.
 * @param $js
 *   Boolean indicating if return values should be escaped for JavaScript.
 *   Defaults to FALSE.
 * @return The translated string.
 */
function t($msg, $vars = array(), $js = FALSE) {
  global $ft_messages;
  if(isset($ft_messages[LANG]) && isset($ft_messages[LANG][$msg])) {
   $msg = $ft_messages[LANG][$msg];
  } else {
   $msg = $msg;
  }
  // Replace vars
  if (count($vars) > 0) {
    foreach ($vars as $k => $v) {
      $msg = str_replace($k, $v, $msg);
    }
  }
  if ($js) {
    return str_replace("'", "\'", $msg);
  }
  return $msg;
}

# Plugins #

# Set timezone if PHP version is larger than 5.10. #
if (function_exists('date_default_timezone_set')) {
  date_default_timezone_set(date_default_timezone_get());
}

# Start running File Thingie #
// Check if headers has already been sent.
if (headers_sent()) {
  $str = ft_make_headers_failed();
} else {
  // Prep settings
  ft_settings_load();
  // Load plugins
  ft_invoke_hook('init');
  // Prep language.
  if (file_exists("locales/".LANG.".php")) {
    @include_once("locales/".LANG.".php");
  }
  // Only calculate total dir size if limit has been set.
  if (LIMIT > 0) {
  	define('ROOTDIRSIZE', ft_get_dirsize(ft_get_root()));
  }

  $str = "";
  // Request is a file download.
  if (!empty($_GET['method']) && $_GET['method'] == 'getfile' && !empty($_GET['file'])) {

    ft_sanitize_request();
    // Make sure we don't run out of time to send the file.
    @ignore_user_abort();
    @set_time_limit(0);
    @ini_set("zlib.output_compression", "Off");
    @session_write_close();
    // Open file for reading
    if(!$fdl=@fopen(ft_get_dir().'/'.$_GET['file'],'rb')){
        die("Cannot Open File!");
    } else {
      ft_invoke_hook('download', ft_get_dir(), $_GET['file']);
      header("Cache-Control: ");// leave blank to avoid IE errors
      header("Pragma: ");// leave blank to avoid IE errors
      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"".htmlentities($_GET['file'])."\"");
      header("Content-length:".(string)(filesize(ft_get_dir().'/'.$_GET['file'])));
      header ("Connection: close");
      sleep(1);
      fpassthru($fdl);
    }
    exit;
  } elseif (!empty($_POST['method']) && $_POST['method'] == "ajax") {
		ft_sanitize_request();
		// Run the ajax hook for modules implementing ajax.
		echo implode('', ft_invoke_hook('ajax', $_POST['act']));
  	exit;
  }

	// Run initializing functions.
	ft_sanitize_request();
	ft_do_action();
	$str = ft_make_header();
	$str .= ft_make_sidebar();
	$str .= ft_make_body();
}
?>

<?php
$pagina['titulo'] = 'Documentos';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Documentos públicos del ".$config['centro_denominacion'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../inc_menu.php");
?>

	<style type="text/css">
	  @import "css/ft.css";
    <?php echo implode("\r\n", ft_invoke_hook('add_css'));?>
	</style>
</head>
<body>

	<div class="section">

	  <div class="container">

	    <div class="row">
	      <?php echo $str;?>
	    </div>

	  </div>

	</div>

  <?php include("../inc_pie.php"); ?>

  <?php ft_make_scripts();?>

  <script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		// Set global object.
		var ft = {fileactions:{}};
		// Prep upload section.
		$('#uploadsection').parent().ft_upload({
		  header:"<?php echo t('Files for upload:');?>",
		  cancel: "<?php echo t('Cancel upload of this file');?>",
		  upload: "<?php echo t('Now uploading files. Please wait...');?>"
		});
		// Prep file actions.
		$('#filelist').ft_filelist({
		  fileactions: ft.fileactions,
		  rename_link: "<?php echo t('Rename');?>",
		  move_link: "<?php echo t('Move');?>",
		  del_link: "<?php echo t('Delete');?>",
		  duplicate_link: "<?php echo t('Duplicate');?>",
			share_link: "<?php echo t('Share');?>",
		  rename: "<?php echo t('Rename to:');?>",
      move: "<?php echo t('Move to folder:');?>",
      del: "<?php echo t('Do you really want to delete file?');?>",
      del_warning: "<?php echo t('You can only delete empty folders.');?>",
      del_button: "<?php echo t('Yes, delete it');?>",
      duplicate: "<?php echo t('Duplicate to file:');?>",
			share: "<?php echo t('Share to:');?>",
		  directory: "<?php if (!empty($_REQUEST['dir'])) {echo $_REQUEST['dir'];}?>",
		  ok: "<?php echo t('Ok');?>",
		  formpost: "<?php echo ft_get_self();?><?php echo (isset($_GET['index'])) ? '?index='.$_GET['index'] : ''; ?>",
		  advancedactions: "<?php if (ADVANCEDACTIONS === TRUE) {echo 'true';} else {echo 'false';}?>",
			user_idea: "<?php echo $idea; ?>"
		});

		// Sort select box.
		$('#sort').change(function(){
		  $('#sort_form').submit();
		});
		// Label highlight in 'create' box.
    $('#new input[type=radio]').change(function(){
      $('label').removeClass('label_highlight');
      $('label[@for='+$(this).attr('id')+']').addClass('label_highlight');
    });
		<?php echo implode("\r\n", ft_invoke_hook('add_js_call'));?>
	});
	</script>

  <?php echo ft_make_scripts_footer();?>
  <?php echo implode("\r\n", ft_invoke_hook('destroy'));?>
</body>
</html>
