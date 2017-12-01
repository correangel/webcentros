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

// DEFINIMOS UNA CONSTANTE CON EL DOMINIO DE LA WEB 
define("WEBCENTROS_DOMINIO", $servername);

// OBTENEMOS LA CONFIGURACIÓN DE LA INTRANET
if (@file_exists("./intranet/config.php")) require_once("./intranet/config.php");
if (@file_exists("../intranet/config.php")) require_once("../intranet/config.php");
if (@file_exists("../../intranet/config.php")) require_once("../../intranet/config.php");
if (@file_exists("../../../intranet/config.php")) require_once("../../../intranet/config.php");
$db_con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']) or die("<h1>Error " . mysqli_connect_error() . "</h1>"); 
mysqli_query($db_con,"SET NAMES 'utf8'");

// ESCAPE DE CARACTERES PARA REALIZAR ALIAS, NECESARIO PARA GENERAR URL AMIGABLES
$acentos = array('.','_',' ','*','--',',',';',':','¡','!','"','\'','@','#','$','%','&','/','(',')','[',']','{','}','<','>','+','|','\\','·','=','¬','?','¿','^','º','ª','`','´','ñ','ç','Á','É','Í','Ó','Ú','á','é','í','ó','ú','À','È','Ì','Ò','Ù','à','è','ì','ò','ù','Â','Ê','Î','Ô','Û','â','ê','î','ô','û','Ä','Ë','Ï','Ö','Ü','ä','ë','ï','ö','ü');
$no_acentos = array('','-','-','','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','c','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u');
$no_acentos_con_espacio = array('','-',' ','','-','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','c','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u');

/*
*
*   CONFIGURACIÓN DE LA PÁGINA EXTERNA PARA CENTROS EDUCATIVOS
*
*/

// LOGOTIPO Y FAVICON
// Añade en la carpeta webcentros/ui-theme/img/ los archivos logo.png y favicon.ico con el logotipo del centro
// Se recomienda que el archivo logo.png tenga unas dimensiones de entre 400 y 500 píxeles, y favicon.ico de 32 píxeles

// BIBLIOTECA
// Introducir la URL de la web, blog de la Biblioteca, por defecto, utiliza el enlace a BiblioWeb
$config['biblioteca'] = "http://www.juntadeandalucia.es/averroes/centros-tic/".$config['centro_codigo']."/biblioweb/";

// IMAGENES Y REPORTAJES
// Introducir la URL de la web Google Fotos, Flickr u otra donde se almacenen las imágenes y reportajes
$config['imagenes'] = "";

// OFERTA EDUCATIVA
// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, información sobre el Bachillerato
// $config['educacion_bachiller'] = 1;

// FORMACIÓN PROFESIONAL BÁSICA
// Es necesario descomentar el bloque correspondiente y rellenarlo de la siguiente manera:
// En el campo 'nombre' se introduce el nombre del título correspondiente, por ejemplo: Informática y Comunicaciones
// En el campo 'url' se introduce la URL de la página todofp.es donde está la información del título
// El campo 'alias' se rellena automáticamente con lo que haya escrito en el campo 'nombre' o puede escribir el alias que crea adecuado
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

$config['educacion_cfgb'][0]['nombre'] = "Informática y Comunicaciones";
$config['educacion_cfgb'][0]['url']    = "http://www.todofp.es/que-como-y-donde-estudiar/que-estudiar/familia/loe/informatica-comunicaciones/informatica-comunicaciones.html";
$config['educacion_cfgb'][0]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgb'][0]['nombre']));

/*
$config['educacion_cfgb'][1]['nombre'] = "";
$config['educacion_cfgb'][1]['url']    = "";
$config['educacion_cfgb'][1]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgb'][1]['nombre']));
*/

// FORMACIÓN PROFESIONAL GRADO MEDIO
// Es necesario descomentar el bloque correspondiente y rellenarlo de la siguiente manera:
// En el campo 'nombre' se introduce el nombre del título correspondiente, por ejemplo: Sistemas Microinformáticos y Redes
// En el campo 'url' se introduce la URL de la página todofp.es donde está la información del título, por ejemplo: 
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

/*
$config['educacion_cfgm'][0]['nombre'] = "";
$config['educacion_cfgm'][0]['url']    = "";
$config['educacion_cfgm'][0]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgm'][0]['nombre']));

$config['educacion_cfgm'][1]['nombre'] = "";
$config['educacion_cfgm'][1]['url']    = "";
$config['educacion_cfgm'][1]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgm'][1]['nombre']));
*/

// FORMACIÓN PROFESIONAL GRADO SUPERIOR
// Es necesario descomentar el bloque correspondiente y rellenarlo de la siguiente manera:
// En el campo 'nombre' se introduce el nombre del título correspondiente, por ejemplo: Administración de Sistemas Informáticos en Red
// En el campo 'url' se introduce la URL de la página todofp.es donde está la información del título, por ejemplo: 
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

/*
$config['educacion_cfgs'][0]['nombre'] = "";
$config['educacion_cfgs'][0]['url']    = "";
$config['educacion_cfgs'][0]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgs'][0]['nombre']));

$config['educacion_cfgs'][1]['nombre'] = "";
$config['educacion_cfgs'][1]['url']    = "";
$config['educacion_cfgs'][1]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgs'][1]['nombre']));
*/

// ORGANIGRAMA COMPLETO QUIPO DIRECTIVO
// Completar las variables con los datos correspondientes. No es necesario borrar o comentar estas variables, si están vacías no se mostrará información
$config['eqdirectivo_direccion']['nombre']            = $config['directivo_direccion'];
$config['eqdirectivo_direccion']['cargo']             = "Director/a";
$config['eqdirectivo_direccion']['telefono']          = "";
$config['eqdirectivo_direccion']['correoe']           = "";

$config['eqdirectivo_vicedireccion']['nombre']        = "";
$config['eqdirectivo_vicedireccion']['cargo']         = "Vicedirector/a";
$config['eqdirectivo_vicedireccion']['telefono']      = "";
$config['eqdirectivo_vicedireccion']['correoe']       = "";

$config['eqdirectivo_jefatura']['nombre']             = $config['directivo_jefatura'];
$config['eqdirectivo_jefatura']['cargo']              = 'Jefe/a de estudios';
$config['eqdirectivo_jefatura']['telefono']           = "";
$config['eqdirectivo_jefatura']['correoe']            = "";

$config['eqdirectivo_jefatura_adjunta']['nombre']     = "";
$config['eqdirectivo_jefatura_adjunta']['cargo']      = "Jefe/a de estudios adjunto/a";
$config['eqdirectivo_jefatura_adjunta']['telefono']   = "";
$config['eqdirectivo_jefatura_adjunta']['correoe']    = "";

$config['eqdirectivo_secretaria']['nombre']           = $config['directivo_secretaria'];
$config['eqdirectivo_secretaria']['cargo']            = "Secretario/a";
$config['eqdirectivo_secretaria']['telefono']         = "";
$config['eqdirectivo_secretaria']['correoe']          = "";

// CÓDIGO PERSONALIZADO EN LA BARRA LATERAL DE LA PÁGINA DE INICIO
// Es necesario descomentar el bloque correspondiente y rellenarlo de la siguiente manera:
// En el campo 'titulo' se escribe el nombre del módulo, que aparecerá en la parte superior. Si se deja en blanco se mostrará el contenido HTML únicamente.
// En el campo 'html' se escribe el código HTML de lo que necesite añadir, por ejemplo: menú de enlaces, imágenes, vídeos, etc.
// ¡CUIDADO! Es necesario escribir una barra inversa para escapar el caracter comilla (') correctamente (\')
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

$config['sidebar_html'][0]['titulo'] = "Enlaces de interés";
$config['sidebar_html'][0]['html'] = '
<ul class="list-unstyled">
    <li><a href="http://www.juntadeandalucia.es/educacion/portals/web/ced" target="_blank">Consejería de Educación</li>
    <li><a href="http://www.mecd.gob.es/portada-mecd/" target="_blank">Ministerio de Educación, Cultura y Deporte</li>
    <li><a href="https://www.juntadeandalucia.es/educacion/portaldocente/" target="_blank">Portal Docente</li>
    <li><a href="http://www.juntadeandalucia.es/educacion/portals/web/becas-y-ayudas" target="_blank">Portal de Becas y Ayudas</li>
    <li><a href="http://www.juntadeandalucia.es/educacion/webportal/web/convivencia-escolar" target="_blank">Portal de Convivencia Escolar</li>
    <li><a href="http://www.juntadeandalucia.es/educacion/portals/web/escolarizacion" target="_blank">Portal de Escolarización</li>
    <li><a href="http://www.juntadeandalucia.es/educacion/webportal/web/portal-de-igualdad" target="_blank">Portal de Igualdad</li>
    <li><a href="http://www.juntadeandalucia.es/educacion/webportal/web/lecturas-y-bibliotecas-escolares" target="_blank">Portal de Lectura y Biblioteca escolares</li>
    <li><a href="http://www.juntadeandalucia.es/educacion/webportal/web/portal-de-plurilinguismo" target="_blank">Portal de Plurilingüismo</li>
    <li><a href="http://www.juntadeandalucia.es/temas/estudiar/universidad/acceso.html" target="_blank">Prueba de Acceso a la Universidad</li>
    <li><a href="http://www.juntadeandalucia.es/temas/estudiar/fp/pruebas-acceso.html" target="_blank">Prueba de Acceso a Ciclos Formativos</li>
    <li><a href="https://www.juntadeandalucia.es/educacion/secretariavirtual/" target="_blank">Secretaría Virtual de los centros educativos</li>    
</ul>
';

$config['sidebar_html'][1]['titulo'] = "";
$config['sidebar_html'][1]['html'] = '
<a href="http://www.codapa.org/wp-content/uploads/2011/09/gderechos-secundaria.pdf" target="_blank">
    <img class="img-responsive" src="'.WEBCENTROS_DOMINIO.'ui-theme/img/gderechos-secundaria.png" alt="Guía de derechos y responsabilidades de las familias andaluzas en la educación">
</a>
';

/*
$config['sidebar_html'][2]['titulo'] = "";
$config['sidebar_html'][2]['html'] = '';
*/

// GOOGLE MAPS API
// Consigue la clave para usar la API de Google Maps en https://developers.google.com/maps/documentation/javascript/?hl=es-419
// Puedes obtener las coordenadas de tu centro educativo en https://www.coordenadas-gps.com
//$config['google_maps']['api_key'] = 'YOUR_CODE';
//$config['google_maps']['latitud'] = 36.4295948;
//$config['google_maps']['longitud'] = -5.154448600000023;
