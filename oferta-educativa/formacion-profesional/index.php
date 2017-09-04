<?php
require_once("../../config.php");

if (! isset($config['educacion_cfgb']) && ! isset($config['educacion_cfgm']) && ! isset($config['educacion_cfgs'])) {
    include("../../error404.php");
}

$alias = strip_tags($_GET['alias']);

$tieneCFGB = 0;
if (isset($config['educacion_cfgb'])) {
    $tieneCFGB = 1;
    $clave_cfgb = array_search($alias, array_column($config['educacion_cfgb'], 'alias'));
}

$tieneCFGM = 0;
if (isset($config['educacion_cfgm'])) {
    $tieneCFGM = 1;
    $clave_cfgm = array_search($alias, array_column($config['educacion_cfgm'], 'alias'));
}

$tieneCFGS = 0;
if (isset($config['educacion_cfgs'])) {
    $tieneCFGS = 1;
    $clave_cfgs = array_search($alias, array_column($config['educacion_cfgs'], 'alias'));
}

if ($tieneCFGB && $clave_cfgb !== FALSE) {
    $tipo_ciclo = "Ciclo Formativo Básico (FPB)";
    $pagina['titulo'] = 'Título Profesional Básico en '.$config['educacion_cfgb'][$clave_cfgb]['nombre'];
    $url = $config['educacion_cfgb'][$clave_cfgb]['url'];
}
elseif ($tieneCFGM && $clave_cfgm !== FALSE) {
    $tipo_ciclo = "Ciclo Formativo de Grado Medio (FPIGM)";
    $pagina['titulo'] = 'Técnico en '.$config['educacion_cfgm'][$clave_cfgm]['nombre'];
    $url = $config['educacion_cfgm'][$clave_cfgm]['url'];
}
elseif ($tieneCFGS && $clave_cfgs !== FALSE) {
    $tipo_ciclo = "Ciclo Formativo de Grado Superior (FPIGS)";
    $pagina['titulo'] = 'Técnico Superior en '.$config['educacion_cfgs'][$clave_cfgs]['nombre'];
    $url = $config['educacion_cfgs'][$clave_cfgs]['url'];
}
else {
    include("../../error404.php");
}

$data = file_get_contents($url);
preg_match_all('|<div class="elemento">(.*?)</div>|is', $data, $cap);

$contenido = '';
$i = 0;
foreach ($cap[0] as $valor) {
    if ($i < (count($cap[0]) - 1)) {
        $valor = str_replace('h3', 'h4', $valor);
        $valor = str_replace('<span class="subir-listado"><a href="#indice">Subir</a></span>', '', $valor);
        $valor = str_replace('<span class="br"><em>Salto de línea</em></span>', '', $valor);
        $valor = str_replace(' class="elemento"', '', $valor);
        $valor = str_replace(' class="cte"', '', $valor);
        $valor = str_replace(' class="ta-justify"', '', $valor);
        $valor = str_replace('href="/todofp/', 'target="_blank" href="http://todofp.es/todofp/', $valor);
        $contenido .= $valor.'</div>';
    }
    $i++;
}

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Información sobre ".$tipo_ciclo." en ".$pagina['titulo'];
$pagina['meta']['meta_type'] = "article";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-8">
                    <?php echo $contenido; ?>
                </div>
            
            </div>

        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>