<?php
require_once("../../bootstrap.php");
require_once("../../config.php");

$icons = array(
    'Alemán' => 'fas fa-language',
    'Biología y Geología' => 'fas fa-dna',
    'Biología y Geología y Física y Química' => 'fas fa-dna',
    'Ciencias Naturales' => 'fas fa-dna',
    'Ciencias Naturales y Física y Química' => 'fas fa-dna',
    'Cultura Clásica' => 'fas fa-university',
    'Dibujo' => 'fas fa-pencil-ruler',
    'Economía' => 'fas fa-chart-bar',
    'Educación Física' => 'fas fa-football-ball',
    'Educación Plástica, Audiovisual y Visual' => 'fas fa-pencil-ruler',
    'FOL' => 'fas fa-chart-bar',
    'FOL y Economía' => 'fas fa-chart-bar',
    'Filosofía' => 'fas fa-universal-access',
    'Física y Química' => 'fas fa-vial',
    'Francés' => 'fas fa-language',
    'Francés y Alemán' => 'fas fa-language',
    'Geografía e Historia' => 'fas fa-globe-africa',
    'Hostelería y Turismo' => 'fas fa-cocktail',
    'Informática' => 'fas fa-desktop',
    'Interculturalidad' => 'fas fa-child',
    'Idiomas' => 'fas fa-language',
    'Inglés' => 'fas fa-language',
    'Religión' => 'fas fa-church',
    'Religión Católica' => 'fas fa-church',
    'Religión Evangélica' => 'fas fa-church',
    'Lengua Castellana y Literatura' => 'fas fa-font',
    'Matemáticas' => 'fas fa-superscript',
    'Música' => 'fas fa-music',
    'Orientación Educativa' => 'far fa-compass',
    'Pedagogía Terapéutica ESO' => 'fas fa-compass',
    'Plástica y Visual' => 'fas fa-paint-brush',
    'Servicios a la Comunidad' => 'fas fa-people-carry',
    'Tecnología' => 'fab fa-laptop-code',
    'Tecnología e Informática' => 'fas fa-laptop-code',
    'Formac. Prof. Básica Inform. y Comun.' => 'fas fa-laptop-code',
    'Convenio O.N.C.E. Maestros' => 'fas fa-blind',
    'PROFESOR ADICIONAL' => 'fas fa-user-plus'
);

$departamentos = array();
$result = mysqli_query($db_con, "SELECT DISTINCT departamento FROM departamentos WHERE departamento <> 'Admin' AND departamento <> 'Administracion' AND departamento <> 'Conserjeria' AND departamento <> 'Educador' AND departamento not like '' ORDER BY departamento ASC");
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
            'icono'         => ((array_key_exists($row['departamento'], $icons) == true) ? $icons[$row['departamento']] : 'fas fa-briefcase'),
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
                        <span class="<?php echo $departamento['icono']; ?> fa-fw fa-lg"></span>
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
                            <li><a href="<?php echo WEBCENTROS_DOMINIO; ?>documentos/Departamentos/<?php echo urlencode(str_replace($acentos, $no_acentos_con_espacio, $departamento['nombre'])); ?>"><i class="far fa-file-alt fa-fw"> </i>&nbsp;Documentos de <?php echo $departamento['nombre']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php include("../../inc_pie.php"); ?>
