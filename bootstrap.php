<?php
// INFORMACIÓN DE LA SESIÓN
ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")  {
	ini_set("session.cookie_secure", 1);
}
ini_set("session.cookie_httponly", 1);
session_set_cookie_params(1800); // Duración de la sesión: 1800 segundos (30 minutos)
ini_set("session.gc_maxlifetime", 1800);
session_name("es");
session_start();

// Regeneramos ID de sesión
if (!isset($_SESSION['SERVER_GENERATED_SID_TIME']) || $_SESSION['SERVER_GENERATED_SID_TIME'] < (time() - 30)) {
  session_regenerate_id();
  $_SESSION['SERVER_GENERATED_SID_TIME'] = time();
}

// CONFIGURACIÓN INICIAL
error_reporting(0);
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'es_ES.UTF-8');

// OBTENEMOS LA URL DE LA PÁGINA WEB
if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) $_servername = $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
else $_servername = $_SERVER['SERVER_NAME'];
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") $_servername = "https://".$_servername."/";
else $_servername = "http://".$_servername."/";

// DEFINIMOS UNA CONSTANTE CON EL DOMINIO DE LA WEB Y EL DIRECTORIO DONDE ESTÁ INSTALADO
define("WEBCENTROS_DOMINIO", $_servername);
define("WEBCENTROS_DIRECTORY", __DIR__);

// OBTENEMOS LA CONFIGURACIÓN DE LA INTRANET
if (@file_exists("./intranet/config.php")) require_once("./intranet/config.php");
if (@file_exists("../intranet/config.php")) require_once("../intranet/config.php");
if (@file_exists("../../intranet/config.php")) require_once("../../intranet/config.php");
if (@file_exists("../../../intranet/config.php")) require_once("../../../intranet/config.php");
if (@file_exists("../../../../intranet/config.php")) require_once("../../../../intranet/config.php");
$db_con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']) or die("<h1>Error " . mysqli_connect_error() . "</h1>");
mysqli_query($db_con,"SET NAMES 'utf8'");

// ESCAPE DE CARACTERES PARA REALIZAR ALIAS, NECESARIO PARA GENERAR URL AMIGABLES
$acentos = array('.','_',' ','*','--',',',';',':','¡','!','"','\'','@','#','$','%','&','/','(',')','[',']','{','}','<','>','+','|','\\','·','=','¬','?','¿','^','º','ª','`','´','ñ','Ñ','ç','Á','É','Í','Ó','Ú','á','é','í','ó','ú','À','È','Ì','Ò','Ù','à','è','ì','ò','ù','Â','Ê','Î','Ô','Û','â','ê','î','ô','û','Ä','Ë','Ï','Ö','Ü','ä','ë','ï','ö','ü');
$no_acentos = array('','-','-','','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','N','c','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u');
$no_acentos_con_espacio = array('','-',' ','','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','N','c','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u');

// CARGAMOS LA FUNCIÓN DE FILTROS PARA EVITAR ATAQUES XSS EN LOS CAMPOS DE FORMULARIO
require_once(WEBCENTROS_DIRECTORY.'/plugins/cleanxss.php');

// COMPROBAMOS DATOS PARA LA CARGA DE MÓDULOS
$result_libros_texto = mysqli_query($db_con, "SELECT `isbn` FROM `libros_texto`") or die (mysqli_error($db_con));
if (mysqli_num_rows($result_libros_texto)) {
	$config['libros_texto'] = 1;
}
else {
	$config['libros_texto'] = 0;
}
mysqli_free_result($result_libros_texto);

// FUNCIONES GENERALES
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}

function cortarPalabras($texto, $longitud = 50, $puntos = "...") {
	$palabras_alt = array();

	$texto = trim(strip_tags($texto));
	$palabras = explode(' ', $texto);

	foreach ($palabras as $palabra) {
		// Eliminamos cadenas de caracteres superiores a 23 letras (la palabra más larga del castellano tiene 24 letras),
		// por lo que quiere decir que al usar strip_tags se han juntado varias palabras si se ha usado una tabla.
		if (strlen($palabra) < 24) array_push($palabras_alt, $palabra);
	}

	if (count($palabras) > $longitud) {
		return implode(' ', array_slice($palabras_alt, 0, $longitud)) ." ". $puntos;
	} else {
		return implode(' ', array_slice($palabras_alt, 0, $longitud));
	}
}

function ofuscarEmail($email) {
	$result = '';

	// Encode string using oct and hex character codes
	for ($i = 0; $i < strlen($email); $i++) {
		$result .= '&#x' . dechex(ord($email[$i])) . ';';
	}

	return $result;
}

function nombreProfesorTitle($nombre) {
	return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
}

function obtenerHoraTutoria($db_con, $dia, $hora) {

	if (empty($dia) && empty($hora)) {
		return false;
	}
	else {
		switch ($dia) {
			case '1': $diasem = "Lunes"; break;
			case '2': $diasem = "Martes"; break;
			case '3': $diasem = "Miércoles"; break;
			case '4': $diasem = "Jueves"; break;
			case '5': $diasem = "Viernes"; break;
			case '6': $diasem = "Sábado"; break;
			case '7': $diasem = "Domingo"; break;
		}

		$result = mysqli_query($db_con, "SELECT `hora_inicio`, `hora_fin` FROM `tramos` WHERE `hora` = '$hora' LIMIT 1");

		if (mysqli_num_rows($result)) {
			$row = mysqli_fetch_array($result);

			$hora_ini = substr($row['hora_inicio'], 0, 5);
			$hora_fin = substr($row['hora_fin'], 0, 5);

			return $diasem . " de " . $hora_ini . ' a ' . $hora_fin . ' horas';
		}
		else {
			return 1;
		}
	}
}

function sistemaPuntos($claveal) {
	global $db_con, $config;

  $fecha_hoy = date('Y-m-d');

  $total = 0; // Puntos acumulados para restar
  $max_puntos = 15; // Máximo de puntos que se pueden acumular
  $total_puntos = 12; // Número de puntos que se asignan a principio de curso o tras expulsión

  // COMPROBAMOS SI EL ALUMNO HA SIDO EXPULSADO DEL CENTRO
  // En ese caso, cuando el alumno se reincorpora al centro, recupera los 12 puntos.
  $sql_where = "";
  $result_expulsion = mysqli_query($db_con, "SELECT `fin` FROM `Fechoria` WHERE `claveal` = '".$claveal."' AND `expulsion` > 0 ORDER BY `id` DESC LIMIT 1");
  if (mysqli_num_rows($result_expulsion)) {
    $row_expulsion = mysqli_fetch_array($result_expulsion);
    $sql_where = " AND `FECHA` > '".$row_expulsion['fin']."' ";
  }

  // CONSULTAMOS PROBLEMAS REGISTRADOS DURANTE EL CURSO O TRAS ÚLTIMA EXPULSIÓN
	$sql_exec_leves = "SELECT COUNT(*) AS leves FROM `Fechoria` WHERE claveal = '".$claveal."' $sql_where AND grave = 'leve'";
	$result_leves = mysqli_query($db_con, $sql_exec_leves);
	$row_leves = mysqli_fetch_array($result_leves);

	$sql_exec_graves = "SELECT COUNT(*) AS graves FROM `Fechoria` WHERE claveal = '".$claveal."' $sql_where AND grave = 'grave'";
	$result_graves = mysqli_query($db_con, $sql_exec_graves);
	$row_graves = mysqli_fetch_array($result_graves);

	$sql_exec_mgraves = "SELECT COUNT(*) AS mgraves FROM `Fechoria` WHERE claveal = '".$claveal."' $sql_where AND grave = 'muy grave'";
	$result_mgraves = mysqli_query($db_con, $sql_exec_mgraves);
	$row_mgraves = mysqli_fetch_array($result_mgraves);


  if (mysqli_num_rows($result_leves) || mysqli_num_rows($result_graves) || mysqli_num_rows($result_mgraves)) {
    $leves = $row_leves['leves'] * 2; // Se quitan 2 puntos por cada parte leve
    $graves = $row_graves['graves'] * 4; // Se quitan 4 puntos por cada parte grave
    $mgraves = $row_mgraves['mgraves'] * 6; // Se quitan 6 puntos por cada parte muy grave

    $total = $leves + $graves + $mgraves;

    // COMPROBAMOS SI EL ALUMNO HA SIDO EXPULSADO AL AULA DE CONVIVENCIA
    // En ese caso, si el alumno ha asistido y ha realizado las tareas recupera 2 puntos.
    $result_aulaconv = mysqli_query($db_con, "SELECT `inicio_aula`, `fin_aula`, `horas` FROM `Fechoria` WHERE `claveal` = '".$claveal."' AND `aula_conv` > 0 ORDER BY `id` DESC LIMIT 1");
    if (mysqli_num_rows($result_aulaconv)) {
      $puntos_convivencia = 0;

      $row_aulaconv = mysqli_fetch_array($result_aulaconv);
      $result_aulaconv_asistencia = mysqli_query($db_con, "SELECT `hora`, `trabajo` FROM `convivencia` WHERE `claveal` = '".$claveal."' AND `fecha` BETWEEN '".$row_aulaconv['inicio_aula']."' AND '".$row_aulaconv['fin_aula']."'");
			if (mysqli_num_rows($result_aulaconv_asistencia)) {
				while ($row_aulaconv_asistencia = mysqli_fetch_array($result_aulaconv_asistencia)) {
	        if ((strstr($row_aulaconv['horas'], $row_aulaconv_asistencia['hora']) == true) && $row_aulaconv_asistencia['trabajo'] == 1) $puntos_convivencia = 2;
	        else $puntos_convivencia = 0;
	      }
			}

      $total -= $puntos_convivencia;
    }
  }

  // COMPROBAMOS EL NÚMERO DE SEMANAS QUE HAN PASADO DESDE PRINCIPIO DE CURSO O TRAS EXPULSIÓN
  // En ese caso, sumamos 0,15 puntos por buen comportamiento por cada semana
  if (isset($row_expulsion['fin'])) $fecha_inicio = $row_expulsion['fin'];
  else $fecha_inicio = $config['curso_inicio'];

  if ($fecha_hoy >= $fecha_inicio) {
		if ($fecha_hoy > $config['curso_fin']) $fecha_fin = $config['curso_fin'];
    else $fecha_fin = $fecha_hoy;

    $interval = date_diff(date_create($fecha_inicio), date_create($fecha_fin));
    $numero_semanas = floor($interval->format('%a')/7) * 0.15;
    $total -= $numero_semanas;
  }

  if (($total_puntos - $total) > $max_puntos) return $max_puntos;
  elseif (($total_puntos - $total) < 0) return 0;
  else return ($total_puntos - $total);
}

/*
	La función cmyk_rgb convierte un color CMYK en RGB y devuelve el código correspondiente
*/
function cmyk_rgb($c, $m, $y, $k) {
	$c = $c / 100;
	$m = $m / 100;
	$y = $y / 100;
	$k = $k / 100;

	$r = 1 - ($c * (1 - $k)) - $k;
	$g = 1 - ($m * (1 - $k)) - $k;
	$b = 1 - ($y * (1 - $k)) - $k;

	$r = round($r * 255);
	$g = round($g * 255);
	$b = round($b * 255);

	$rgb = $r . ', ' . $g . ', ' . $b;

	return $rgb;
}

/*
	La función rgb_hex convierte un color RGB en Hexadecimal y devuelve el código correspondiente
*/
function rgb_hex($r, $g, $b)
{

    $r = dechex($r);
    if (strlen($r)<2)
    $r = '0'.$r;

    $g = dechex($g);
    if (strlen($g)<2)
    $g = '0'.$g;

    $b = dechex($b);
    if (strlen($b)<2)
    $b = '0'.$b;

    return '#' . $r . $g . $b;
}

/*
	La función cmykcolor comprueba si el formato CMYK es válido y devuelve el código CSS.
	La variable $color recibe el color que el usuario ha proporcionado.
	La variable $output recibe el formato de color de salida: rgb o hex.
	La variable $tono modifica el color introducido por el usuario para aclarar
	(introduciendo el valor light) u oscurecer (introduciendo el valor dark).
*/
function cmykcolor($color, $output = false, $tono = false) {
		$tonalidad = 0;
		$color = str_replace('%', '', $color);
		$color = str_replace(' ', '', $color);

		if ($tono !== false) {
			switch ($tono) {
				case 'light'	: $tonalidad -= 10; break;
				case 'dark'		: $tonalidad += 10; break;
				default				: $tonalidad = 0;  break;
			}
		}

		$exp_cmyk = explode(',', $color);
		if (count($exp_cmyk) != 4) {
			die('Error CMYK Color : El número de valores del formato CMYK no es válido. Debe introducir 4 valores separados por coma.');
		}
		else {
			$cvalue = trim($exp_cmyk[0]);
			$mvalue = trim($exp_cmyk[1]);
			$yvalue = trim($exp_cmyk[2]);
			$kvalue = trim($exp_cmyk[3]);

			if ($tonalidad != 0) {
				if ($cvalue >= 10 && $cvalue <= 90) $cvalue = trim($exp_cmyk[0]) + $tonalidad;
				if ($mvalue >= 10 && $mvalue <= 90) $mvalue = trim($exp_cmyk[1]) + $tonalidad;
				if ($yvalue >= 10 && $yvalue <= 90) $yvalue = trim($exp_cmyk[2]) + $tonalidad;
				if ($kvalue >= 10 && $kvalue <= 90) $kvalue = trim($exp_cmyk[3]) + $tonalidad;
			}

			if (! ($cvalue >= 0 && $cvalue <= 100)) {
				die('Error CMYK Color : El porcentaje de color Cyan ' . $cvalue . ' no es válido. Debe ser un valor entre 0% y 100%.');
			}
			else if (! ($mvalue >= 0 && $mvalue <= 100)) {
				die('Error CMYK Color : El porcentaje de color Magenta ' . $mvalue . ' no es válido. Debe ser un valor entre 0% y 100%.');
			}
			else if (! ($yvalue >= 0 && $yvalue <= 100)) {
				die('Error CMYK Color : El porcentaje de color Yellow ' . $yvalue . ' no es válido. Debe ser un valor entre 0% y 100%.');
			}
			else if (! ($kvalue >= 0 && $kvalue <= 100)) {
				die('Error CMYK Color : El porcentaje de color blacK ' . $yvalue . ' no es válido. Debe ser un valor entre 0% y 100%.');
			}
			else {

			}

			$cmyk = 'cmyk(' . $cvalue . '%,' . $mvalue . '%,' . $yvalue . '%,' . $kvalue . '%)';

			if (! (preg_match("/cmyk\([0-9]{0,3}%,[0-9]{0,3}%,[0-9]{0,3}%,[0-9]{0,3}%\)/i", $cmyk))) {
				return false;
			}
			else {
				if ($output !== false) {
					switch ($output) {
						case 'rgb':
							return 'rgb(' . cmyk_rgb($cvalue, $mvalue, $yvalue, $kvalue) . ')';
							break;

						case 'hex':
							$rgb = cmyk_rgb($cvalue, $mvalue, $yvalue, $kvalue);
							$exp_rgb = explode(', ', $rgb);
							$r = trim($exp_rgb[0]);
							$g = trim($exp_rgb[1]);
							$b = trim($exp_rgb[2]);
							return rgb_hex($r, $g, $b);
							break;

						default:
							return $cmyk;
							break;
					}
				}
				else {
					return $cmyk;
				}
			}
		}
}

function formatoTelefono($telefono) {
	$telefono = str_replace(' ', '', $telefono);
	return substr($telefono, 0, 3) . ' ' . substr($telefono, 3, 2) . ' ' . substr($telefono, 5, 2) . ' ' . substr($telefono, 7, 2);
}

function obtenerColorImagen($imagen) {
	$im = imagecreatefromjpeg($imagen);

	$rTotal = 0;
	$gTotal = 0;
	$bTotal = 0;
	$total = 0;

	for ($x = 0; $x < imagesx($im); $x++) {
			for ($y = 0; $y < imagesy($im); $y++) {
					$rgb = imagecolorat($im, $x, $y);
					$r   = ($rgb >> 16) & 0xFF;
					$g   = ($rgb >> 8) & 0xFF;
					$b   = $rgb & 0xFF;
					$rTotal += $r;
					$gTotal += $g;
					$bTotal += $b;
					$total++;
			}
	}

	$rPromedio = round($rTotal/$total);
	$gPromedio = round($gTotal/$total);
	$bPromedio = round($bTotal/$total);

	return array(
		'r' => $rPromedio,
		'g' => $gPromedio,
		'b' => $bPromedio
	);

}

function getBrowser($u_agent) {
  if (empty($u_agent)) {
      $u_agent = 'Agente de usuario no detectado';
  }
  $bname = 'Navegador desconocido';
  $bversion= "";
  $ub = "Navegador desconocido";
  $platform = 'Dispositivo desconocido';
  $pname = "";
  $pversion= "";

  $u_agent = str_replace('; es-es', '', $u_agent);
  $u_agent = str_replace('; en-us', '', $u_agent);
  $u_agent = str_replace('; en-uk', '', $u_agent);

  // First get the platform?
  if (preg_match('/android/i', $u_agent)) {
    $platform_name = 'Android';
    $pname = 'Android';
  } elseif (preg_match('/ubuntu/i', $u_agent)) {
    $platform = 'Ubuntu';
    $pname = 'Ubuntu';
  } elseif (preg_match('/Linux Mint/i', $u_agent)) {
    $platform = 'Linux Mint';
    $pname = 'Linux Mint';
  } elseif (preg_match('/x11; linux/i', $u_agent)) {
    $platform = 'GNU/Linux';
    $pname = 'GNU/Linux';
  } elseif (preg_match('/linux/i', $u_agent)) {
    $platform = 'Linux';
    $pname = 'Linux';
  } elseif (preg_match('/iPhone/i', $u_agent)) {
    $platform = 'iPhone iOS';
    $pname = 'iPhone OS';
  } elseif (preg_match('/iPad/i', $u_agent)) {
    $platform = 'iPad iOS';
    $pname = 'iPad; CPU OS';
  } elseif (preg_match('/mac os x 10_13|mac os x 10_12/i', $u_agent)) {
    $platform = 'macOS';
    $pname = 'Mac OS X';
  } elseif (preg_match('/mac os x 10_11|mac os x 10_10|mac os x 10_9/i', $u_agent)) {
    $platform = 'OS X';
    $pname = 'Mac OS X';
  } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'Mac OS X';
    $pname = 'Mac OS X';
  } elseif (preg_match('/windows nt 10/i', $u_agent)) {
    $platform = 'Windows 10';
    $pname = 'Windows';
  } elseif (preg_match('/windows nt 6.3/i', $u_agent)) {
    $platform = 'Windows 8.1';
    $pname = 'Windows';
  } elseif (preg_match('/windows nt 6.2/i', $u_agent)) {
    $platform = 'Windows 8';
    $pname = 'Windows';
  } elseif (preg_match('/windows nt 6.1/i', $u_agent)) {
    $platform = 'Windows 7';
    $pname = 'Windows';
  } elseif (preg_match('/windows nt 6.0/i', $u_agent)) {
    $platform = 'Windows Vista';
    $pname = 'Windows';
  } elseif (preg_match('/windows nt 5.1/i', $u_agent)) {
    $platform = 'Windows XP';
    $pname = 'Windows';
  } elseif (preg_match('/windows nt 5.0/i', $u_agent)) {
    $platform = 'Windows 2000';
    $pname = 'Windows';
  } elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'Windows';
    $pname = 'Windows';
  }

  if ($pname != "" && $pname != 'Windows') {
    // finally get the correct version number
    $known = array($pname, $ub, 'other');
    if ($pname == 'Android') {
      $pattern = '#(?<platform>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|0-9_|a-zA-Z.|a-zA-Z_]*;[0-9]*([a-zA-Z]*[-| ])*[a-zA-Z]*[-| ]*[0-9]*[-]*[a-zA-Z]*[-]*[0-9]*)#';
    }
    else {
      $pattern = '#(?<platform>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|0-9_|a-zA-Z.|a-zA-Z_]*)#';
    }
    if (!preg_match_all($pattern, $u_agent, $matches)) {
      // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['platform']);
    if ($i > 1) {
      //we will have two since we are not using 'other' argument yet
      //see if version is before or after the name
      if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $pversion= str_replace('_', '.', $matches['version'][0]);
      } else {
        $pversion= str_replace('_', '.', $matches['version'][1]);
      }
    } elseif ($i == 1) {
      $pversion= str_replace('_', '.', $matches['version'][0]);
    }
    // check if we have a number
    if ($pversion==null || $pversion=="") {
      $pversion="";
    }
    elseif ($pname == 'Android') {
      $pversion = str_replace(' es-es; ', '', $pversion);
      $exp_pversion = explode(';', $pversion);
      $platform = ltrim(trim($exp_pversion[1]).' - Android', ' - ');
      $pversion = trim($exp_pversion[0]);
    }
  }


  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
    $bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif(preg_match('/Edge/i',$u_agent)) {
    $bname = 'Microsoft Edge';
    $ub = "Edge";
  } elseif(preg_match('/Firefox/i',$u_agent)) {
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  } elseif(preg_match('/Chrome/i',$u_agent)) {
    $bname = 'Google Chrome';
    $ub = "Chrome";
  } elseif(preg_match('/Safari/i',$u_agent)) {
    $bname = 'Safari';
    $ub = "Safari";
  } elseif(preg_match('/Opera/i',$u_agent)) {
    $bname = 'Opera';
		$ub = "Opera";
	} elseif(preg_match('/Vivaldi/i',$u_agent)) {
    $bname = 'Vivaldi';
    $ub = "Vivaldi";
  } elseif(preg_match('/Netscape/i',$u_agent)) {
    $bname = 'Netscape';
    $ub = "Netscape";
  }
  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
      // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i > 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $bversion= $matches['version'][0];
    } else {
        $bversion= $matches['version'][1];
    }
  } elseif ($i == 1) {
    $bversion= $matches['version'][0];
  }
  // check if we have a number
  if ($bversion==null || $bversion=="") {$bversion="";}
  return array(
    'userAgent'         => $u_agent,
    'browser_name'      => $bname,
    'browser_version'   => $bversion,
    'platform_name'     => $pname,
    'platform'          => $platform,
    'platform_version'  => $pversion,
    'pattern'           => $pattern
  );
}

function navegadorSoportado() {
	$ua = getBrowser($_SERVER['HTTP_USER_AGENT']);
	$plataforma = $ua['platform'];
	$plataforma_version = $ua['platform_version'];
	$navegador = $ua['browser_name'];
	$navegador_version = $ua['browser_version'];

	if ($navegador == 'Google Chrome' && $navegador_version > 45) return true;
	elseif ($navegador == 'Mozilla Firefox' && $navegador_version > 38) return true;
	elseif ($navegador == 'Opera' && $navegador_version > 30) return true;
	elseif ($navegador == 'Internet Explorer' && $navegador_version > 10) return true;
	elseif ($navegador == 'Microsoft Edge' && $navegador_version > 12) return true;
	elseif ($navegador == 'Safari' && $navegador_version > 9) return true;
	elseif ($plataforma == 'iPhone iOS' && $plataforma_version > 9) return true;
	elseif ($plataforma == 'iPad iOS' && $plataforma_version > 9) return true;
	elseif ($plataforma == 'Android' && $plataforma_version > 4.4) return true;
	else return false;
}
// Fin de archivo bootstrap.php
