<?php
session_start();

// CONFIGURACIÓN INICIAL
error_reporting(0);
date_default_timezone_set('Europe/Madrid');
setlocale(LC_TIME, 'es_ES.UTF-8');

// OBTENEMOS LA URL DE LA PÁGINA WEB
if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) $servername = $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
else $servername = $_SERVER['SERVER_NAME'];
if (! $_SERVER['HTTPS']) $servername = "http://".$servername."/";
else $servername = "https://".$servername."/";

// DEFINIMOS UNA CONSTANTE CON EL DOMINIO DE LA WEB Y EL DIRECTORIO DONDE ESTÁ INSTALADO
define("WEBCENTROS_DOMINIO", $servername);
define("WEBCENTROS_DIRECTORY", __DIR__);

// OBTENEMOS LA CONFIGURACIÓN DE LA INTRANET
if (@file_exists("./intranet/config.php")) require_once("./intranet/config.php");
if (@file_exists("../intranet/config.php")) require_once("../intranet/config.php");
if (@file_exists("../../intranet/config.php")) require_once("../../intranet/config.php");
if (@file_exists("../../../intranet/config.php")) require_once("../../../intranet/config.php");
$db_con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']) or die("<h1>Error " . mysqli_connect_error() . "</h1>"); 
mysqli_query($db_con,"SET NAMES 'utf8'");

// ESCAPE DE CARACTERES PARA REALIZAR ALIAS, NECESARIO PARA GENERAR URL AMIGABLES
$acentos = array('.','_',' ','*','--',',',';',':','¡','!','"','\'','@','#','$','%','&','/','(',')','[',']','{','}','<','>','+','|','\\','·','=','¬','?','¿','^','º','ª','`','´','ñ','Ñ','ç','Á','É','Í','Ó','Ú','á','é','í','ó','ú','À','È','Ì','Ò','Ù','à','è','ì','ò','ù','Â','Ê','Î','Ô','Û','â','ê','î','ô','û','Ä','Ë','Ï','Ö','Ü','ä','ë','ï','ö','ü');
$no_acentos = array('','-','-','','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','N','c','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u');
$no_acentos_con_espacio = array('','-',' ','','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','N','c','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u');

// CARGAMOS LA FUNCIÓN DE FILTROS PARA EVITAR ATAQUES XSS EN LOS CAMPOS DE FORMULARIO
require_once(WEBCENTROS_DIRECTORY.'/plugins/cleanxss.php');

// COMPROBAMOS DATOS PARA LA CARGA DE MÓDULOS
$result = mysqli_query($db_con, "SELECT isbn FROM textos_gratis") or die (mysqli_error($db_con));
$libros_tabla1 = mysqli_num_rows($result);
mysqli_free_result($result);
$result = mysqli_query($db_con, "SELECT isbn FROM Textos") or die (mysqli_error($db_con));
$libros_tabla2 = mysqli_num_rows($result);
mysqli_free_result($result);
if ($libros_tabla1 || $libros_tabla2) {
	$config['libros_texto'] = 1;
}
else {
	$config['libros_texto'] = 0;
}
unset($libros_tabla1);
unset($libros_tabla2);

// FUNCIONES GENERALES
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
        
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    
    return $_SERVER['REMOTE_ADDR'];
}

function cortarTexto($texto, $numMaxCaract) {
	if (strlen($texto) <  $numMaxCaract){
		$textoCortado = $texto;
	}else{
		$textoCortado = substr($texto, 0, $numMaxCaract);
		$ultimoEspacio = strripos($textoCortado, " ");
 
		if ($ultimoEspacio !== false){
			$textoCortadoTmp = substr($textoCortado, 0, $ultimoEspacio);
			if (substr($textoCortado, $ultimoEspacio)){
				$textoCortadoTmp .= '...';
			}
			$textoCortado = $textoCortadoTmp;
		}elseif (substr($texto, $numMaxCaract)){
			$textoCortado .= '...';
		}
	}
 
	return $textoCortado;
}

function ofuscarEmail($email) {
	$result = '';

	// Encode string using oct and hex character codes
	for ($i = 0; $i < strlen($email); $i++) {
		$result .= '&#x' . dechex(ord($email[$i])) . ';';
	}

	return $result;
}

// Fin de archivo bootstrap.php
