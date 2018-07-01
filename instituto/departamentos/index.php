<?php
require_once("../../bootstrap.php");
require_once("../../config.php");

$icons = array(
	'Idiomas' => 'fa-language',
	'Inglés' => 'fa-language',
	'Alemán' => 'fa-language',
    'Biología y Geología' => 'fa-leaf',
    'Ciencias Naturales' => 'fa-leaf',
    'Ciencias Naturales y Física y Química' => 'fa-leaf',
	'Cultura Clásica' => 'fa-university',
    'Dibujo' => 'fa-paint-brush',
    'Educación Plástica, Audiovisual y Visual' => 'fa-paint-brush',
	'Plástica y Visual' => 'fa-paint-brush',
	'Economía' => 'fa-bar-chart',
	'FOL' => 'fa-bar-chart',
	'FOL y Economía' => 'fa-bar-chart',
	'Educación Física' => 'fa-futbol',
	'Filosofía' => 'fa-gavel',
	'Física y Química' => 'fa-flask',
	'Francés' => 'fa-language',
	'Geografía e Historia' => 'fa-globe',
	'Hostelería y Turismo' => 'fa-cutlery',
	'Religión' => 'fa-child',
	'Religión Católica' => 'fa-child',
	'Religión Evangélica' => 'fa-child',
	'Lengua Castellana y Literatura' => 'fa-book',
	'Matemáticas' => 'fa-superscript',
	'Música' => 'fa-music',
	'Orientación Educativa' => 'fa-compass',
	'Pedagogía Terapéutica ESO' => 'fa-compass',
	'Servicios Socioculturales y a la Comunidad' => 'fa-briefcase',
	'Tecnología' => 'fa-cogs',
	'Tecnología e Informática' => 'fa-tachometer',
	'Informática' => 'fa-desktop',
);

$departamentos = array();
$result = mysqli_query($db_con, "SELECT DISTINCT departamento FROM departamentos WHERE departamento <> 'Admin' AND departamento <> 'Administracion' AND departamento <> 'Conserjeria' AND departamento <> 'Educador' ORDER BY departamento ASC");
while ($row = mysqli_fetch_array($result)) {

        $componentes = array();
        $result_componentes = mysqli_query($db_con, "SELECT nombre, cargo FROM departamentos WHERE departamento = '".$row['departamento']."' ORDER BY nombre ASC");
        while ($row_componente = mysqli_fetch_array($result_componentes)) {
            $componente = array(
                'nombre'    => $row_componente['nombre'],
                'esJefe'    => ((stristr($row_componente['cargo'], '4') == true) ? '1' : '0')
            );

            array_push($componentes, $componente);
        }
        mysqli_free_result($result_componentes);
        unset($componente);

        $departamento = array(
            'nombre'        => $row['departamento'],
            'alias'         => strtolower(str_replace($acentos, $no_acentos, $row['departamento'])),
            'icono'         => ((array_key_exists($row['departamento'], $icons) == true) ? $icons[$row['departamento']] : 'fa-briefcase'),
            'componentes'   => $componentes
        );
    
        array_push($departamentos, $departamento);
}
mysqli_free_result($result);
unset($departamento);


$pagina['titulo'] = 'Departamentos';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Organización de departamentos, profesores y jefes de departamento del ".$config['centro_denominacion'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row">

                <?php foreach ($departamentos as $departamento): ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <a href="#" data-toggle="modal" data-target="#modal_<?php echo $departamento['alias']; ?>" class="btn btn-default btn-block btn-departamentos">
                        <span class="far <?php echo $departamento['icono']; ?> fa-fw fa-lg"></span>
                        <?php echo $departamento['nombre']; ?>
                    </a>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    
    <?php foreach ($departamentos as $departamento): ?>
    <div class="modal fade" id="modal_<?php echo $departamento['alias']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </button>
                    <h4 class="title title-up"><?php echo $departamento['nombre']; ?></h4>
                </div>
                <div class="modal-body">
                
                    <div class="pad30">
                        <h6><span class="far fa-group fa-fw"></span> Miembros del Departamento</h6>
                        <hr>
                        <ul class="fa-ul">
                            <?php foreach ($departamento['componentes'] as $componente): ?>
                            <li><span class="fa-li far fa-user"></span> <?php echo $componente['nombre']; ?><?php echo ($componente['esJefe'] == 1) ? ' <span class="text-muted"><strong>(Jefe/a de departamento)</strong></span>' : ''; ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <br>

                        <h6><span class="far fa-folder fa-fw"></span> Recursos</h6>
                        <hr>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo WEBCENTROS_DOMINIO; ?>documentos/index.php?&amp;directory=Departamentos/<?php echo urlencode(str_replace($acentos, $no_acentos_con_espacio, $departamento['nombre'])); ?>"><i class="far fa-file-text fa-fw"> </i>&nbsp;Documentos de <?php echo $departamento['nombre']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php include("../../inc_pie.php"); ?>