<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed');
/*
*   CONFIGURACIÓN DE LA PÁGINA EXTERNA PARA CENTROS EDUCATIVOS
*/

// LOGOTIPO Y FAVICON
// Añade en la carpeta ui-theme/img/ los archivos logo.png y favicon.ico con el logotipo del centro
// Se recomienda que el archivo logo.png tenga unas dimensiones de entre 400 y 500 píxeles, y favicon.ico de 32 píxeles

// COLOR PRIMARIO
// Puede cambiar el color primario del sitio por cualquier otro en formato CMYK
// Utilice la página https://www.w3schools.com/colors/colors_cmyk.asp
$config['color_primario'] = "0%, 60%, 80%, 2%";

// Puede cambiar el patrón de fondo de los títulos de las páginas modificando el número de la variable.
// También puede añadir sus propios patrones subiendo los diseños a la carpeta ui-theme/img/presets/.
// Los valores posibles son del 1 al 7.
$config['fondo_patron'] = "1";

// PLAN ANUAL DE CENTRO
// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, el Plan anual de centro
// $config['plan_centro']   = "";

// SITIO WEB DE LA AMPA
// Introducir la URL de la web, blog de la AMPA
// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, el sitio web de la AMPA
// $config['web_ampa']      = "";

// SITIO WEB DE LA BIBLIOTECA
// Introducir la URL de la web, blog de la Biblioteca, por defecto, utiliza el enlace a BiblioWeb
// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, el sitio web de la Biblioteca
$config['web_biblioteca'] = "http://www.juntadeandalucia.es/averroes/centros-tic/".$config['centro_codigo']."/biblioweb/";

// SITIO WEB DE IMAGENES Y REPORTAJES
// Introducir la URL de la web Google Fotos, Flickr u otra donde se almacenen las imágenes y reportajes
$config['web_imagenes']   = "";

// PÁGINA DE ALUMNADO
// Si se establece estas variables a 1 o true, el alumno podrá ver y descargar los informes de tareas y tutoría
$config['alumnado']['ver_informes_tareas']  = 0;
$config['alumnado']['ver_informes_tutoria'] = 0;

// ICONOS BARRA LATERAL (SOLO 3 ICONOS)
// Introducir la URL de la imagen de los iconos de la barra lateral, título y enlace URL a donde dirigir a los usuarios
// Comentar / Descomentar este bloque para mostrar o no mostrar, respectivamente, los iconos en la barra lateral
$config['sidebar_icon'][0]['imagen']   = WEBCENTROS_DOMINIO."/ui-theme/img/png-icons/seneca.png";
$config['sidebar_icon'][0]['titulo']   = "Ir a Portal Séneca";
$config['sidebar_icon'][0]['enlace']   = "http://www.juntadeandalucia.es/educacion/portalseneca/web/seneca/inicio";

$config['sidebar_icon'][1]['imagen']   = WEBCENTROS_DOMINIO.'/ui-theme/img/png-icons/pasen.png';
$config['sidebar_icon'][1]['titulo']   = "Ir a Portal Pasen";
$config['sidebar_icon'][1]['enlace']   = "https://www.juntadeandalucia.es/educacion/portalseneca/web/pasen/inicio";

$config['sidebar_icon'][2]['imagen']   = WEBCENTROS_DOMINIO.'/ui-theme/img/png-icons/moodle.png';
$config['sidebar_icon'][2]['titulo']   = "Ir a Plataforma Moodle";
$config['sidebar_icon'][2]['enlace']   = "http://www.juntadeandalucia.es/averroes/centros-tic/".$config['centro_codigo']."/moodle2/";

// OFERTA EDUCATIVA
// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, información sobre el Bachillerato
// $config['educacion_bachiller'] = 1;

// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, información sobre el Educación Secundaria Para Adultos (ESPA)
// $config['educacion_permanente']['espa'] = 1;

// Comentar / Descomentar la línea para mostrar o no mostrar, respectivamente, información sobre el Bachillerato para adultos
// $config['educacion_permanente']['bachillerato'] = 1;


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
// En el campo 'url' se introduce la URL de la página todofp.es donde está la información del título.
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
// En el campo 'url' se introduce la URL de la página todofp.es donde está la información del título.
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

/*
$config['educacion_cfgs'][0]['nombre'] = "";
$config['educacion_cfgs'][0]['url']    = "";
$config['educacion_cfgs'][0]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgs'][0]['nombre']));

$config['educacion_cfgs'][1]['nombre'] = "";
$config['educacion_cfgs'][1]['url']    = "";
$config['educacion_cfgs'][1]['alias']  = mb_strtolower(str_replace($acentos, $no_acentos, $config['educacion_cfgs'][1]['nombre']));
*/

// ORGANIGRAMA COMPLETO DEL EQUIPO DIRECTIVO
// Completar las variables con los datos correspondientes. No es necesario borrar o comentar estas variables, si están vacías no se mostrará información
$config['eqdirectivo_direccion']['nombre']                    = $config['directivo_direccion'];
$config['eqdirectivo_direccion']['cargo']                     = "Director/a";
$config['eqdirectivo_direccion']['telefono']                  = "";
$config['eqdirectivo_direccion']['correoe']                   = "";

$config['eqdirectivo_vicedireccion']['nombre']                = "";
$config['eqdirectivo_vicedireccion']['cargo']                 = "Vicedirector/a";
$config['eqdirectivo_vicedireccion']['telefono']              =  "";
$config['eqdirectivo_vicedireccion']['correoe']               = "";

$config['eqdirectivo_jefatura']['nombre']                     = $config['directivo_jefatura'];
$config['eqdirectivo_jefatura']['cargo']                      = 'Jefe/a de estudios';
$config['eqdirectivo_jefatura']['telefono']                   = "";
$config['eqdirectivo_jefatura']['correoe']                    = "";

$config['eqdirectivo_jefatura_adjunta']['nombre']             = "";
$config['eqdirectivo_jefatura_adjunta']['cargo']              = "Jefe/a de estudios adjunto/a";
$config['eqdirectivo_jefatura_adjunta']['telefono']           = "";
$config['eqdirectivo_jefatura_adjunta']['correoe']            = "";

$config['eqdirectivo_jefatura_adjunta2']['nombre']            = "";
$config['eqdirectivo_jefatura_adjunta2']['cargo']             = "Jefe/a de estudios adjunto/a";
$config['eqdirectivo_jefatura_adjunta2']['telefono']          = "";
$config['eqdirectivo_jefatura_adjunta2']['correoe']           = "";

$config['eqdirectivo_jefatura_adultos']['nombre']             = "";
$config['eqdirectivo_jefatura_adultos']['cargo']              = "Jefe/a de estudios (EPA)";
$config['eqdirectivo_jefatura_adultos']['telefono']           = "";
$config['eqdirectivo_jefatura_adultos']['correoe']            = "";

$config['eqdirectivo_jefatura_adjunta_adultos']['nombre']     = "";
$config['eqdirectivo_jefatura_adjunta_adultos']['cargo']      = "Jefe/a de estudios adjunto/a (EPA)";
$config['eqdirectivo_jefatura_adjunta_adultos']['telefono']   = "";
$config['eqdirectivo_jefatura_adjunta_adultos']['correoe']    = "";

$config['eqdirectivo_secretaria']['nombre']                   = $config['directivo_secretaria'];
$config['eqdirectivo_secretaria']['cargo']                    = "Secretario/a";
$config['eqdirectivo_secretaria']['telefono']                 = "";
$config['eqdirectivo_secretaria']['correoe']                  = "";


// CÓDIGO PERSONALIZADO EN BLOQUE DE CONTENIDO DE LA PÁGINA DE INICIO
// Es necesario descomentar el bloque correspondiente y rellenarlo de la siguiente manera:
// En el campo 'titulo' se escribe el nombre del módulo, que aparecerá en la parte superior. Si se deja en blanco se mostrará el contenido HTML únicamente.
// En el campo 'html' se escribe el código HTML de lo que necesite añadir, por ejemplo: menú de enlaces, imágenes, vídeos, etc.
// ¡CUIDADO! Es necesario escribir una barra inversa para escapar el caracter comilla (') correctamente (\')
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

/*
$config['content_html']['top'][0]['titulo'] = "";
$config['content_html']['top'][0]['html'] = '';
*/

/*
$config['content_html']['bottom'][0]['titulo'] = "";
$config['content_html']['bottom'][0]['html'] = '';
*/

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
    <li><a href="https://www.mecd.gob.es/portada-mecd/" target="_blank">Ministerio de Educación</li>
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

// CAROUSEL
// Comente / descomente el bloque para ocultar o mostrar, respectivamente, un carousel de imagenes en la página principal.
// En el campo 'imagen' se escribe la URL completa de la imagen. La imagen debe tener un tamaño de 1218 x 580 pixeles. Este campo es obligatorio.
// En el campo 'titulo' se escribe el título de la noticia, que aparecerá en la parte superior. Si se deja en blanco se mostrará el contenido únicamente.
// En el campo 'contenido' se escribe el texto o código HTML del contenido que desee añadir para acompañar a la imagen. Este campo es opcional.
// En el campo 'enlace' se escribe la URL a la que desee que el usuario vaya si hace click en la imagen. Este campo es opcional.
// ¡CUIDADO! Es necesario escribir una barra inversa para escapar el caracter comilla (') correctamente (\')
// Consejo: Es importante optimizar las imagenes para la publicación en la web, de esta manera conseguimos que la página cargue mucho más rápido
// y los usuarios ahorren megas en dispositivos móviles. Utiliza la página https://imagecompressor.com/es/ para comprimir las imagenes.
// Puede añadir tantos bloques como necesite, solo debe cambiar el número del array multidimensional: [0], [1], [2],...

$config['carousel'][0]['imagen'] = WEBCENTROS_DOMINIO . 'ui-theme/img/slide/slide1.jpeg';
$config['carousel'][0]['titulo'] = 'Escolarización oferta parcial diferenciada 2018/19';
$config['carousel'][0]['contenido'] = '<p>Presencial, semipresencial y distancia.</p><p>Plazo de solicitudes:<br>Del 10 al 25 de junio</p>';
$config['carousel'][0]['enlace'] = 'http://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/escolarizacion/oferta-parcial';

$config['carousel'][1]['imagen'] = WEBCENTROS_DOMINIO . 'ui-theme/img/slide/slide2.jpeg';
$config['carousel'][1]['titulo'] = 'Idiomas en Escuelas Oficiales de Idiomas (EOI)';
$config['carousel'][1]['contenido'] = '<p>Modalidades presencial y semipresencial.</p><p>Plazo de matriculación:<br>Del 1 al 10 de julio</p>';
$config['carousel'][1]['enlace'] = 'http://www.juntadeandalucia.es/educacion/portals/web/educacion-permanente/idiomas/tramitacion';

$config['carousel'][2]['imagen'] = WEBCENTROS_DOMINIO . 'ui-theme/img/slide/slide3.jpeg';
$config['carousel'][2]['titulo'] = 'Educación para personas adultas';
$config['carousel'][2]['contenido'] = '<p>Modalidades presencial y semipresencial.</p><ul><li>ESO</li><li>Bachillerato</li></ul><p>Plazo de matriculación:<br>Del 1 al 10 de julio</p>';
$config['carousel'][2]['enlace'] = 'http://www.juntadeandalucia.es/educacion/portals/web/educacion-permanente';

// GOOGLE ANALYTICS
// Consigue el ID de seguimiento para usar la API de Google Analytics en https://analytics.google.com/analytics/
//$config['google_analytics']['tracking_id'] = 'YOUR_GA_TRACKING_ID';

// GOOGLE MAPS API
// Consigue la clave para usar la API de Google Maps Javascript en https://console.cloud.google.com/
// Puedes obtener las coordenadas de tu centro educativo en https://www.coordenadas-gps.com
//$config['google_maps']['api_key'] = 'YOUR_API_KEY';
//$config['google_maps']['latitud'] = 36.4295948;
//$config['google_maps']['longitud'] = -5.154448600000023;
//$config['google_maps']['zoom'] = 15;

// GOOGLE reCAPTCHA
// Consigue la clave para usar la API de Google reCAPTCHA v2 en https://www.google.com/recaptcha/admin/create
// Copia la clave del sitio y la clave secreta en las siguientes variables de configuración
//$config['google_recaptcha']['site_key'] = 'YOUR_SITE_KEY';
//$config['google_recaptcha']['secret'] = 'YOUR_SECRET_CODE';

// Fin de archivo config.php
