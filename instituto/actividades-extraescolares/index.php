<?php
require_once("../../config.php");

$anio_curso = substr($config['curso_actual'], 0, 4);
$anio_curso_sig = $anio_curso + 1;
$array_meses = array(
    9 => 'Septiembre '.$anio_curso, 
    10 => 'Octubre '.$anio_curso,
    11 => 'Noviembre '.$anio_curso,
    12 => 'Diciembre '.$anio_curso,
    1 => 'Enero '.$anio_curso_sig,
    2 => 'Febrero '.$anio_curso_sig,
    3 => 'Marzo '.$anio_curso_sig,
    4 => 'Abril '.$anio_curso_sig,
    5 => 'Mayo '.$anio_curso_sig,
    6 => 'Junio '.$anio_curso_sig,
    7 => 'Julio '.$anio_curso_sig,
    8 => 'Agosto '.$anio_curso_sig
);

$actividades_extraescolares = array();
$result = mysqli_query($db_con, "SELECT DISTINCT MONTH(c.fechaini) AS nummes FROM calendario AS c JOIN calendario_categorias AS cc ON c.categoria = cc.id WHERE c.categoria = 2 AND cc.espublico = 1 AND confirmado = 1 AND c.fechaini BETWEEN '".$config['curso_inicio']."' AND '".$config['curso_fin']."' ORDER BY MONTH(fechaini) ASC") or die (mysqli_error($db_con));
while ($row = mysqli_fetch_array($result)) {

        $actividades_mes = array();
        $result_actividades = mysqli_query($db_con, "SELECT id, nombre, descripcion, fechaini, horaini, fechafin, horafin, lugar, departamento, profesores, unidades, observaciones FROM calendario WHERE MONTH(fechaini) = '".$row['nummes']."' AND categoria = 2 AND confirmado = 1 AND fechaini BETWEEN '".$config['curso_inicio']."' AND '".$config['curso_fin']."' ORDER BY fechaini DESC, horaini DESC") or die (mysqli_error($db_con));
        while ($row_actividades = mysqli_fetch_array($result_actividades)) {
        
                $actividad_mes = array(
                    'id'            => $row_actividades['id'],
                    'nombre'        => $row_actividades['nombre'],
                    'descripcion'   => $row_actividades['descripcion'],
                    'fechaini'      => $row_actividades['fechaini'],
                    'horaini'       => $row_actividades['horaini'],
                    'fechafin'      => $row_actividades['fechafin'],
                    'horafin'       => $row_actividades['horafin'],
                    'lugar'         => $row_actividades['lugar'],
                    'departamento'  => $row_actividades['departamento'],
                    'profesores'    => $row_actividades['profesores'],
                    'unidades'      => $row_actividades['unidades'],
                    'observaciones' => $row_actividades['observaciones']
                );
            
                array_push($actividades_mes, $actividad_mes);
        }
        mysqli_free_result($result_actividades);
        unset($actividad_mes);

        $actividad = array(
            'nummes'        => $row['nummes'],
            'actividades'   => $actividades_mes
        );
    
        array_push($actividades_extraescolares, $actividad);
}
mysqli_free_result($result);
unset($actividad);

$pagina['titulo'] = 'Actividades extraescolares';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Actividades extraescolares del curso ".$config['curso_actual']." del ".$config['centro_denominacion'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-3">

                    <ul class="nav nav-pills nav-pills-no-round nav-pills-primary flex-column" role="tablist">
                        <?php $i = 0; ?>
                        <?php foreach ($array_meses as $nummes => $nommes): ?>
                        <li class="nav-item">
                            <a class="nav-link<?php echo ($i == 0) ? ' active' : ''; ?>" data-toggle="tab" href="#mes_<?php echo $nummes; ?>" role="tablist">
                                <?php echo $nommes; ?>
                            </a>
                        </li>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </ul>
                    
                </div>

                <div class="col-md-9">
                    <div class="tab-content">
                        <?php $i = 0; ?>
                        <?php foreach ($array_meses as $nummes => $nommes): ?>
                        <div class="tab-pane<?php echo ($i == 0) ? ' active' : ''; ?>" id="mes_<?php echo $nummes; ?>">
                            <h3><?php echo $nommes; ?></h3>

                            <?php $found_mes = array_search($nummes, array_column($actividades_extraescolares, 'nummes')); ?>
                            <?php if ($found_mes !== FALSE): ?>

                            <div id="actividad_mes_<?php echo $nummes; ?>" role="tablist">
                            <?php foreach ($actividades_extraescolares[$found_mes]['actividades'] as $actividad): ?>
                                <div class="card">
                                    <div class="card-header" role="tab" id="heading<?php echo $actividad['id']; ?>">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#actividad<?php echo $actividad['id']; ?>" aria-expanded="false" aria-controls="actividad<?php echo $actividad['id']; ?>">
                                        <strong><?php echo strftime('%e %b', strtotime($actividad['fechaini'])); ?></strong> - <?php echo $actividad['nombre']; ?>
                                        </a>
                                    </h5>
                                    </div>

                                    <div id="actividad<?php echo $actividad['id']; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $actividad['id']; ?>" data-parent="#actividad_mes_<?php echo $nummes; ?>">
                                    <div class="card-body">

                                        <?php if (! empty($actividad['descripcion'])): ?>
                                        <h6>Observaciones</h6>
                                        <p><?php echo $actividad['descripcion']; ?></p>
                                        <?php endif; ?>

                                        <?php if (! empty($actividad['observaciones'])): ?>
                                        <h6>Observaciones</h6>
                                        <p><?php echo $actividad['observaciones']; ?></p>
                                        <?php endif; ?>

                                        <hr>

                                        <dl class="row">
                                            <?php if ($actividad['fechaini'].' '.$actividad['horaini'] == $actividad['fechafin'].' '.$actividad['horafin']) : ?>
                                            <dt class="col-sm-3">Fecha:</dt>
                                            <dd class="col-sm-9">Todo el día</dd>
                                            <?php else: ?>
                                            <dt class="col-sm-3">Desde:</dt>
                                            <dd class="col-sm-9"><?php echo strftime('%e %B a las %H:%M horas', strtotime($actividad['fechaini'].' '.$actividad['horaini'])); ?></dd>

                                            <dt class="col-sm-3">Hasta:</dt>
                                            <dd class="col-sm-9"><?php echo strftime('%e %B a las %H:%M horas', strtotime($actividad['fechafin'].' '.$actividad['horafin'])); ?></dd>
                                            <?php endif; ?>

                                            <?php if (! empty($actividad['lugar'])): ?>
                                            <dt class="col-sm-3 text-truncate">Lugar:</dt>
                                            <dd class="col-sm-9"><?php echo $actividad['lugar']; ?></dd>
                                            <?php endif; ?>

                                            <?php if (! empty($actividad['departamento'])): ?>
                                            <dt class="col-sm-3 text-truncate">Departamento:</dt>
                                            <dd class="col-sm-9"><?php echo $actividad['departamento']; ?></dd>
                                            <?php endif; ?>

                                            <?php if (! empty($actividad['profesores'])): ?>
                                            <dt class="col-sm-3 text-truncate">Profesores acompañantes:</dt>
                                            <dd class="col-sm-9"><?php echo rtrim($actividad['profesores'],';'); ?></dd>
                                            <?php endif; ?>

                                            <?php if (! empty($actividad['unidades'])): ?>
                                            <dt class="col-sm-3 text-truncate">Grupos:</dt>
                                            <dd class="col-sm-9"><?php echo rtrim($actividad['unidades'],';'); ?></dd>
                                            <?php endif; ?>

                                        </dl>
                                    </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>

                            <?php else: ?>
                            <br><br>
                            <div class="text-center text-muted">
                                <span class="fa fa-calendar-o fa-4x"></span>
                                <p class="lead pad10">No hay actividades programadas</p>
                            </div>
                            <br><br>
                            <?php endif; ?>

                            <pre><?php print_r($actividades_extraescolares[8]['actividades']); ?></pre>
                        </div>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>