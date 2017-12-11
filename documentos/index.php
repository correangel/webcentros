<?php
define('IN_PHPATM', true);
include('include/conf.php');
include('include/common.'.$phpExt);
//
function msdos_time_to_unix($DOSdate, $DOStime)
{
	$year = (($DOSdate & 65024) >> 9) + 1980;
	$month = ($DOSdate & 480) >> 5;
	$day = ($DOSdate & 31);
	$hours = ($DOStime & 63488) >> 11;
	$minutes = ($DOStime & 2016) >> 5;
	$seconds = ($DOStime & 31) * 2;
	return mktime($hours, $minutes, $seconds, $month, $day, $year);
}

//
//
function list_zip($filename)
{
	global $bordercolor, $headercolor, $tablecolor, $font, $headerfontcolor;
	global $normalfontcolor, $datetimeformat, $me;

	$fp = @fopen($filename,'rb');
	if (!$fp)
	{
		return;
	}
	fseek($fp, -22, SEEK_END);

	// Get central directory field values
	$headersignature = 0;
	do
	{
		// Search header
		$data = fread($fp, 22);
		list($headersignature,$numberentries, $centraldirsize, $centraldiroffset) =
			array_values(unpack('Vheadersignature/x6/vnumberentries/Vcentraldirsize/Vcentraldiroffset', $data));

		fseek($fp, -23, SEEK_CUR);
	} while (($headersignature != 0x06054b50) && (ftell($fp) > 0));

	if ($headersignature != 0x06054b50)
	{
		echo "<p><font face=\"$font\" size=\"3\" color=\"$normalfontcolor\">$mess[45]</p>";
		fclose($fp);
		return;
	}

	fseek($fp, $centraldiroffset, SEEK_SET);

	// Read central dir entries
	echo "<h3>$mess[46]</h3><br />";
	echo "<table class='table table-bordered' align='center'>";
	echo "<tr>
	<td>
		<b>$mess[15]</b>
	</td>
	<td>
		<b>$mess[17]</b>
	</td>
	<td>
		<b>$mess[47]</b>
	</td>
	</tr>";

	for ($i = 1; $i <= $numberentries; $i++)
	{
		// Read central dir entry
		$data = fread($fp, 46);
		list($arcfiletime,$arcfiledate,$arcfilesize,$arcfilenamelen,$arcfileattr) =
			array_values(unpack("x12/varcfiletime/varcfiledate/x8/Varcfilesize/Varcfilenamelen/x6/varcfileattr", $data));
		$filenamelen = fread($fp, $arcfilenamelen);

		$arcfiledatetime = msdos_time_to_unix($arcfiledate, $arcfiletime);

		echo "<tr>";

		// Print FileName
		echo '<td>';
		echo "";
		if ($arcfileattr == 16)
		{
			echo "<b>$filenamelen</b>";
		}
		else
		{
			echo $filenamelen;
		}

		echo '';
		echo '</td>';

		// Print FileSize column
		echo "<td>";

		if ($arcfileattr == 16)
			echo $mess[48];
		else
			echo $arcfilesize . ' bytes';

		echo '</td>';

		// Print FileDate column
		echo "<td>";
		echo date($datetimeformat, $arcfiledatetime);
		echo '</td>';
		echo '</tr>';
	}
	echo '</table></p>';
	fclose($fp);
	return;
}

//
//
function unix_time()
{
	global $timeoffset;
	$tmp = time() + 3600 * $timeoffset;
	return $tmp;
}

//
//
function file_time($filename)
{
	global $timeoffset;
	$tmp = filemtime($filename) + 3600 * $timeoffset;
	return $tmp;
}


function scan_dir_for_digest($current_dir, &$message)
{
	global $timeoffset, $comment_max_caracters, $datetimeformat, $uploads_folder_name;
	global $hidden_dirs, $showhidden;

	$currentdate = getdate();
	$time1 = mktime(0, 0, 0, $currentdate['mon'], $currentdate['mday']-1, $currentdate['year']);
	$time2 = $time1 + 86400;

	list($liste, $totalsize) = listing($current_dir);

	$filecount = 0;
	if (is_array($liste))
	{
		while (list($filename, $mime) = each($liste))
		{
			if(is_dir("$current_dir/$filename"))
			{
		      	if (preg_match('/'.$hidden_dirs.'/i', $filename) && !$showhidden)
		      	{
		      		continue;
		      	}

				$filecount += scan_dir_for_digest("$current_dir/$filename", $message);
				continue;
			}

			$file_modif_time = filemtime("$current_dir/$filename");
			if (($file_modif_time < $time1) || ($file_modif_time >= $time2))
				continue;

		    $filecount++;

			list($upl_user, $upl_ip, $contents) = get_file_description("$current_dir/$filename", $comment_max_caracters);

			$message.="
			    <tr valign=\"top\">
			        <td align=\"left\" width=\"45%\">
			          <font size=3>$filename<BR>
			          <font size=2>$contents
			        </td>
			        <td align=\"left\" width=\"30%\" valign=\"middle\">
			        	Documentos".ereg_replace($uploads_folder_name, '', $current_dir)."
			        </td>
			        <td align=\"right\"  nowrap valign=\"middle\">\n";
			$message.= get_filesize("$current_dir/$filename");
			$message.= "</td>
			 		<td align=\"left\"  nowrap valign=\"middle\">\n";
			$message.=date($datetimeformat, $file_modif_time - $timeoffset * 3600);
			$message.= "</td>
					<td align=\"left\"  valign=\"middle\">\n";

			if ($upl_user != "")
			$message.= "<b>$upl_user</b><br>";

			$message.= "
					</td>
				</tr>\n";
		}
	}

	return $filecount;
}

function init($directory)
{
	global $uploads_folder_name, $mess, $font, $normalfontcolor;

	$current_dir = $uploads_folder_name;
	if ($directory != '')
		$current_dir = "$current_dir/$directory";

	if (!is_dir($uploads_folder_name))
	{
		echo "$mess[196]<br><br>
			  <a href=\"index.$phpExt?".SID."\">$mess[29]</a>\n";
		exit;
	}

	if (!is_dir($current_dir))
	{
		echo "$mess[30]<br><br>
			  <a href=\"javascript:window.history.back()\">$mess[29]</a>\n";
		exit;
	}

	return $current_dir;
}

//
//
function assemble_tables($tab1, $tab2)
{

	$liste = '';

	if (is_array($tab1))
	{
		while (list($cle, $val) = each($tab1))
			$liste[$cle] = $val;
	}

	if (is_array($tab2))
	{
		while (list($cle, $val) = each($tab2))
			$liste[$cle] = $val;
	}

	return $liste;
}

//
//
function txt_vers_html($text)
{
	$text = str_replace('&', '&amp;', $text);
	$text = str_replace('<', '&lt;', $text);
	$text = str_replace('>', '&gt;', $text);
	$text = str_replace('\"', '&quot;', $text);
	return $text;
}

//
function listing($current_dir)
{

	$totalsize = 0;
	$handle = opendir($current_dir);
	$list_dir = '';
	$list_file = '';
	while (false !== ($filename = readdir($handle)))
    {
	    if ($filename != '.' && $filename != '..'
//	    	&& !eregi("\.desc$|\.dlcnt$|^index\.", $filename)
	    	&& show_hidden_files($filename))
		{
			$filesize=filesize("$current_dir/$filename");
			$totalsize += $filesize;
			if (is_dir("$current_dir/$filename"))
			{
				$list_dir[$filename] = $filename;
            }
            else
            {
            	$list_file[$filename] = get_mimetype_img("$current_dir/$filename");
			}
		}
	}
    closedir($handle);

	if(is_array($list_file))
	{
       	$direction == DIRECTION_DOWN ? ksort($list_file) : krsort($list_file);
	}

	if(is_array($list_dir))
	{
		$direction == DIRECTION_UP ? krsort($list_dir) : ksort($list_dir);
	}

	$liste = assemble_tables($list_dir, $list_file);

	if ($totalsize >= 1073741824)
		$totalsize = round($totalsize / 1073741824 * 100) / 100 . " Gb";
	elseif ($totalsize >= 1048576)
		$totalsize = round($totalsize / 1048576 * 100) / 100 . " Mb";
	elseif ($totalsize >= 1024)
		$totalsize = round($totalsize / 1024 * 100) / 100 . " Kb";
	else
		$totalsize = $totalsize . " b";

    return array($liste, $totalsize);
}

//

function contents_dir($current_dir, $directory)
{
  global $font,$totalsize,$mess,$tablecolor,$lightcolor;
  global $file_out_max_caracters,$normalfontcolor, $phpExt, $hidden_dirs, $showhidden;
  global $comment_max_caracters,$datetimeformat, $logged_user_name;
  global $user_status,$activationcode,$max_filesize_to_mail,$mail_functions_enabled, $timeoffset, $grants;

  // Read directory
  list($liste, $totalsize) = listing($current_dir);

  if(is_array($liste))
  {
    while (list($filename,$mime) = each($liste)) {

	
      if (is_dir("$current_dir/$filename")){

      	if (preg_match('/'.$hidden_dirs.'/i', $filename) && !$showhidden) {
      		continue;
      	}

        $filenameandpath = "index.$phpExt?".SID."&directory=";

        if ($directory != '') $filenameandpath .= "$directory/";

		$filenameandpath .= $filename;
		$icon_color = 'text-warning';
      }
      else
      {
        $filenameandpath = '';
        if ($directory != '')
        {
        	$filenameandpath .= "$directory/";
        }
		$filenameandpath .= $filename;
		$icon_color = 'text-info';
      }

	  echo "<tr>
		<td>
			<span class=\"$icon_color ".get_mimetype_img("$current_dir/$filename")." fa-2x\" style=\"margin: 0 8px 4px 0\"></span>";

			  
		if (is_dir("$current_dir/$filename"))
		{
		echo "<a href=\"$filenameandpath\">";
		}
		echo $filename;
		if(is_viewable($filename) || is_image($filename) || is_browsable($filename) || is_dir("$current_dir/$filename"))
		{echo "</a>\n";}

		echo "$contents";
		
		if (! is_dir("$current_dir/$filename")) {
			echo '<div class="text-muted pad10"><small>';
			echo 'Tamaño: '.get_filesize("$current_dir/$filename");
			echo ' - ';
			$file_modif_time = filemtime("$current_dir/$filename") - $timeoffset * 3600;
			echo 'Subido el: '.date($datetimeformat, $file_modif_time);
			echo '</small></div>';
		}
		echo "</td>
      <td nowrap>
        <div align=\"center\">";

//
//
if ($grants[$user_status][MODALL] || ($upl_user == $logged_user_name && $grants[$user_status][MODOWN]))
{
	if (!is_dir("$current_dir/$filename") || $grants[$user_status][MODALL])
	{
    }
}
else
{
	echo "&nbsp;";
}


//
//
//
if ($grants[$user_status][DOWNLOAD] && !is_dir("$current_dir/$filename"))
{
echo "<a href=\"index.${phpExt}?action=downloadfile&filename=$filename&directory=$directory\" class=\"btn btn-primary btn-sm\"><i class='fa fa-cloud-download fa-lg' title='Descargar' alt=\"$mess[23]\"></i> Descargar</a>";

}
else
	echo " ";

echo "    </div>
      </td>
	</tr>\n";
    }
  }
  else {
	echo "
	<tr>
		<td colspan=\"2\">
			<br><br>
			<div class=\"text-center\">
				<span class=\"fa fa-folder-o fa-4x\"></span>
				<p class=\"lead\">Directorio vacío</p>
			</div>
			<br><br>
		</td>
	</tr>
	";
  }
}

//
//
function list_dir($directory)
{
	global $mess,$uploads_folder_name;
	global $font,$totalsize,$tablecolor,$headercolor,$bordercolor;
	global $headerfontcolor, $normalfontcolor, $phpExt;
	$directory = clean_path($directory);
	$current_dir = init($directory);
	$filenameandpath = ($directory != '') ? "&directory=".$directory : '';


		echo "

	  <table class=\"table table-hover\">";
	    $direction = DIRECTION_DOWN;
        contents_dir($current_dir, $directory);
		echo "</table>";
}

//
function normalize_filename($name)
{
	global $file_name_max_caracters, $invalidchars;

	$name = stripslashes($name);

	reset($invalidchars);
	while (list($key, $value) = each($invalidchars))
	{
		$name = str_replace($value, '', $name);
	}

	$name = substr($name, 0, $file_name_max_caracters);
	return $name;
}

//
//
function show_contents()
{
	global $current_dir,$directory,$uploads_folder_name,$mess,$timeoffset;
	global $totalsize,$font,$tablecolor,$bordercolor,$headercolor;
	global $headerfontcolor,$normalfontcolor,$user_status, $grants, $phpExt;

	echo '<div class="section">';
	echo '<div class="container">';
	echo '<div class="row justify-content-md-center">';
	echo '<div class="col-md-10">';
	$directory = clean_path($directory);

	if (!file_exists("$uploads_folder_name/$directory")) {
		$directory = '';
	}

	if ($directory != '') {

		$name = dirname($directory);
		if ($directory == $name || $name == '.') $name = '';
		echo "<h5><a href=\"index.${phpExt}?&directory=$name\">";
		echo "<i class='fa fa-chevron-up'> &nbsp;&nbsp;</i> \n";
		echo "</a>\n";
		echo split_dir("$directory");
		echo "</h5><br />";	
	}


	if ($grants[$user_status][VIEW]){
		list_dir($directory);
	}

	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

//
function is_path_safe(&$path, &$filename)
{
	global $uploads_folder_name;

	$path = clean_path($path);
	$filename = clean_path($filename);

	if (!file_exists("$uploads_folder_name/$path")
//		|| eregi("\.desc$|\.dlcnt$|^index\.|\.$",  $filename)
		|| !show_hidden_files($filename)
	   )
	{
		return false;
	}

	return true;
}

//----------------------------------------------------------------------------
//      MAIN
//----------------------------------------------------------------------------
switch($action)
{

	case 'downloadfile';
		$current_dir = $uploads_folder_name;
		if ($directory != '')
			$current_dir.="/$directory";

		$filename = basename($filename);

		if (!$grants[$user_status][DOWNLOAD])
		{
			// place_header($mess[111]);
			
			$pagina['titulo'] = 'Documentos';

			// SEO
			//$pagina['meta']['robots'] = 0;
			//$pagina['meta']['canonical'] = 0;
			$pagina['meta']['meta_title'] = $pagina['titulo'];
			$pagina['meta']['meta_description'] = "Documentos públicos del ".$config['centro_denominacion'].". Programaciones didácticas de los departamentos, Plan de centro, Reglas de Organización y Funcionamiento y más documentos...";
			$pagina['meta']['meta_type'] = "website";
			$pagina['meta']['meta_locale'] = "es_ES";
			include("../inc_menu.php");
			show_contents();
			include("../inc_pie.php");
			break;
		}

		if (!file_exists("$current_dir/$filename"))
		{
			// // place_header($mess[125]);
			$pagina['titulo'] = 'Documentos';
			
			// SEO
			//$pagina['meta']['robots'] = 0;
			//$pagina['meta']['canonical'] = 0;
			$pagina['meta']['meta_title'] = $pagina['titulo'];
			$pagina['meta']['meta_description'] = "Documentos públicos del ".$config['centro_denominacion'].". Programaciones didácticas de los departamentos, Plan de centro, Reglas de Organización y Funcionamiento y más documentos...";
			$pagina['meta']['meta_type'] = "website";
			$pagina['meta']['meta_locale'] = "es_ES";
			include("../inc_menu.php");
			show_contents();
			include("../inc_pie.php");
			break;
		}

		if (!is_path_safe($directory, $filename))
		{
			// // place_header($mess[111]);
			$pagina['titulo'] = 'Documentos';
			
			// SEO
			//$pagina['meta']['robots'] = 0;
			//$pagina['meta']['canonical'] = 0;
			$pagina['meta']['meta_title'] = $pagina['titulo'];
			$pagina['meta']['meta_description'] = "Documentos públicos del ".$config['centro_denominacion'].". Programaciones didácticas de los departamentos, Plan de centro, Reglas de Organización y Funcionamiento y más documentos...";
			$pagina['meta']['meta_type'] = "website";
			$pagina['meta']['meta_locale'] = "es_ES";
			include("../inc_menu.php");
			show_contents();
			include("../inc_pie.php");
			break;
		}

		$size = filesize("$current_dir/$filename");
//		increasefiledownloadcount("$current_dir/$filename");

		if (($user_status != ANONYMOUS) && ($logged_user_name != ''))  // Update user statistics
		{
		  list($files_uploaded, $files_downloaded, $files_emailed) = load_userstat($logged_user_name);
		  $files_downloaded++;
		  save_userstat($logged_user_name, $files_uploaded, $files_downloaded, $files_emailed, time());
		}

		header("Content-Type: application/force-download; name=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: $size");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Expires: 0");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		readfile("$current_dir/$filename");
		exit;
		break;

	case 'view';
		$current_dir = $uploads_folder_name;
		if ($directory != '')
			$current_dir.="/$directory";

		$filename = basename($filename);

		if (!$grants[$user_status][VIEW])
		{
			header("Status: 404 Not Found");
			exit;
		}

		if (!file_exists("$current_dir/$filename") || !is_path_safe($directory, $filename))
		{
			header("Status: 404 Not Found");
			exit;
		}

		$filenametoview = basename($filename);
		page_header($mess[26].": ".$filenametoview);

		echo "<center><h4>$mess[26] : ";
		echo "<img src=\"images/".get_mimetype_img("$current_dir/$filename")."\" align=\"ABSMIDDLE\">\n";
		echo "".$filenametoview."<br><br><hr>\n";
		echo "<a href=\"javascript:window.print()\"><i class='fa fa-print' alt=\"$mess[27]\" border=\"0\"> &nbsp;&nbsp;</i></a>\n";
		echo "<div align=\"center\"><a href=\"index.${phpExt}?action=downloadfile&filename=".$filename."&directory=".$directory."h.php\"><i class='fa fa-cloud-download' alt=\"$mess[23]\"> &nbsp;&nbsp;</i></a>";
		echo "<a href=\"javascript:window.close()\"><i class='fa fa-chevron-left' alt=\"$mess[28]\" border=\"0\"> &nbsp;&nbsp;</i></a></div>\n";
		echo "</h4>\n";
		echo "</center>\n";
		if (is_browsable($filename))
		{
			list_zip("$current_dir/$filename");
		}
			else
		{
			$fp=@fopen("$current_dir/$filename", "r");
			if($fp)
			{
				echo "\n";
				while(!feof($fp))
				{
					$buffer=fgets($fp,4096);
					$buffer=txt_vers_html($buffer);
					$buffer=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$buffer);
					echo $buffer."<br>";
				}
				fclose($fp);
				echo "\n";
			}
			else
			{
				echo "$mess[31] : $current_dir/$filename";
			}
		}
		echo "<center>\n";
		echo "<hr>\n";
		echo "<a href=\"javascript:window.print()\"><i class='fa fa-print' alt=\"$mess[27]\" border=\"0\"> &nbsp;&nbsp;</i></a>\n";
		echo "<center><a href=\"index.${phpExt}?action=downloadfile&filename=$filename&directory=$directory\"><i class='fa fa-cloud-download' alt=\"$mess[23]\" width=\"20\" height=\"20\" border=\"0\"> &nbsp;&nbsp;</i></a>";
		echo "<a href=\"javascript:window.close()\"><i class='fa fa-chevron-left' alt=\"$mess[28]\" border=\"0\"> &nbsp;&nbsp;</i></a>\n";
		echo "<hr></center>\n";
		echo "</body>\n";
		echo "</html>\n";
		exit;
		break;

	
	default;
		$pagina['titulo'] = 'Documentos';
	
		// SEO
		//$pagina['meta']['robots'] = 0;
		//$pagina['meta']['canonical'] = 0;
		$pagina['meta']['meta_title'] = $pagina['titulo'];
		$pagina['meta']['meta_description'] = "Documentos públicos del ".$config['centro_denominacion'].". Programaciones didácticas de los departamentos, Plan de centro, Reglas de Organización y Funcionamiento y más documentos...";
		$pagina['meta']['meta_type'] = "website";
		$pagina['meta']['meta_locale'] = "es_ES";
		include("../inc_menu.php");
		show_contents();
		include("../inc_pie.php");
		break;
	}
?>