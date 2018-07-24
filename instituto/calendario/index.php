<?php
require_once("../../bootstrap.php");
require_once("../../config.php");
require('../../plugins/calendar.class.php');

$curso = substr($config['curso_actual'], 0, 4);

$cal = new calendar();

$cal->enableNonMonthDays();
$cal->enableYear();

$cal->addEvent('Inicio curso E.S.O., Bachillerato y F.P.', substr($config['curso_inicio'],0,4), 9, substr($config['curso_inicio'],8,2), '#');
$cal->addEvent('Fin días lectivos', substr($config['curso_fin'],0,4), 6, substr($config['curso_fin'],8,2), '#');

// DIAS FESTIVOS
$result = mysqli_query($db_con, "SELECT fecha, nombre FROM festivos");

if (mysqli_num_rows($result)) {

    while ($row = mysqli_fetch_array($result)) {
        $fecha = explode('-', $row['fecha']);
        $fecha_anio = $fecha[0];
        substr($fecha[1],0,1)==0 ? $fecha_mes = substr($fecha[1],1,2) : $fecha_mes = $fecha[1];
        substr($fecha[2],0,1)==0 ? $fecha_dia = substr($fecha[2],1,2) : $fecha_dia = $fecha[2];

        $cal->addEvent($row['nombre'], $fecha_anio, $fecha_mes, $fecha_dia, '#');
    }

}


$pagina['titulo'] = 'Calendario escolar <small>Curso '.$config['curso_actual'].'</small>';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Calendario escolar del curso ".$config['curso_actual']." de la provincia de ".$config['centro_provincia'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row">

                <div class="col-lg-4">
                <?php $cal->display(9, $curso); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(10, $curso); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(11, $curso); ?>
                </div>

            </div><!-- ./row -->

            <div class="row">

                <div class="col-lg-4">
                <?php $cal->display(12, $curso); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(1, $curso+1); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(2, $curso+1); ?>
                </div>

            </div><!-- ./row -->

            <div class="row">

                <div class="col-lg-4">
                <?php $cal->display(3, $curso+1); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(4, $curso+1); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(5, $curso+1); ?>
                </div>

            </div><!-- ./row -->

            <div class="row">

                <div class="col-lg-4">
                <?php $cal->display(6, $curso+1); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(7, $curso+1); ?>
                </div>

                <div class="col-lg-4">
                <?php $cal->display(8, $curso+1); ?>
                </div>

            </div><!-- ./row -->

        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>
