<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed');

function nombremes($mes)
{
	switch ($mes) {
		case 1 : $nombre = "Enero"; break;
		case 2 : $nombre = "Febrero"; break;
		case 3 : $nombre = "Marzo"; break;
		case 4 : $nombre = "Abril"; break;
		case 5 : $nombre = "Mayo"; break;
		case 6 : $nombre = "Junio"; break;
		case 7 : $nombre = "Julio"; break;
		case 8 : $nombre = "Agosto"; break;
		case 9 : $nombre = "Septiembre"; break;
		case 10 : $nombre = "Octubre"; break;
		case 11 : $nombre = "Noviembre"; break;
		case 12 : $nombre = "Diciembre"; break;
	}

	return $nombre;
}
?>
<br>
<a name="actividades"></a>

<h3>Actividades evaluables</h3>
<br>
<?
$eventQuery = mysqli_query($db_con,"SELECT id, fechaini, unidades, nombre, asignaturas FROM calendario WHERE unidades like '%".$unidad."%' and date(fechaini)>'".$config['curso_inicio']."' and categoria > '2' order by fechaini");
if (mysqli_num_rows($eventQuery)>0) {
?>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <th class="text-center text-info">Unidades</th><th class="text-center text-info">Fecha</th><th class="text-center text-info">Actividad</th><th class="text-center text-info">Asignatura</th>
    </thead>
<?php  
while ($reg=mysqli_fetch_array($eventQuery)) {
  $asg = explode(';', $reg[4]);
  $asign = $asg[0];
?>
<tr><td><?php echo $reg[2];?></td><td nowrap><?php echo $reg[1];?></td><td><?php echo $reg[3];?></td><td><?php echo $asign ;?></td></tr>


<?
}
?>
</table>
</div>
<?php
}
else {
?>

<div class="justify-content-center">
	<p class="lead text-muted text-center p-5">No se han registrado actividades evaluables</p>
</div>
<?php } ?>


<br>
<hr>
<h3>Actividades extraescolares</h3>

<br>

<?php $result = mysqli_query($db_con, "SELECT DISTINCT MONTH(fechaini) AS mes, YEAR(fechaini) AS anio FROM calendario WHERE unidades LIKE '%$unidad%' AND fechaini > '".$config['curso_inicio']."' AND confirmado=1 ORDER BY fechaini DESC"); ?>

<?php if(mysqli_num_rows($result)): ?>

<?php while ($row = mysqli_fetch_array($result)): ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<th class="text-center text-info"><?php echo nombremes($row['mes']).', '.$row['anio']; ?></th>
		</thead>
		<tbody>
			<?php $result_actividad = mysqli_query($db_con, "SELECT nombre, descripcion, fechaini, horaini, fechafin, horafin, departamento, profesores FROM calendario WHERE unidades LIKE '%$unidad%' AND MONTH(fechaini)='".$row['mes']."' AND confirmado=1 ORDER BY fechaini DESC"); ?>
			<?php while ($row_actividad = mysqli_fetch_array($result_actividad)): ?>
			<tr>
				<td>
					<h4><span class="text-warning"><?php echo stripslashes($row_actividad['nombre']); ?></span><br><?php if(($row_actividad['fechaini'] == $row_actividad['fechafin']) && ($row_actividad['horaini'] == $row_actividad['horafin'])): ?><small class="text-muted">Todo el día</small><?php else: ?><small class="text-muted">Salida: <?php echo strftime('%A, %e de %B',strtotime($row_actividad['fechaini'])); ?> a las <?php echo strftime('%H:%M',strtotime($row_actividad['horaini'])); ?> | Regreso: <?php echo strftime('%A, %e de %B',strtotime($row_actividad['fechafin'])); ?> a las <?php echo strftime('%H:%M',strtotime($row_actividad['horafin'])); ?></small><?php endif; ?></h4>
					<p><?php echo stripslashes($row_actividad['descripcion']); ?></p>
					<hr>
					<p><strong>Departamento:</strong> <?php echo stripslashes($row_actividad['departamento']); ?></p>
					<?php
					$lista_profesores = "";

					$profesores = explode(';', $row_actividad['profesores']);

					$i = 0;
					while ($profesores[$i]) {
						$exp_profesor = explode(', ', $profesores[$i]);
						$nomprofesor = $exp_profesor[1];
						$apeprofesor = $exp_profesor[0];

						$lista_profesores .= $nomprofesor.' '.$apeprofesor.', ';
						$i++;
					}

					$lista_profesores = trim($lista_profesores, ', ');
					?>
					<p><strong>Profesores responsables:</strong> <?php echo $lista_profesores; ?></p>
				</td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php endwhile; ?>

<?php else: ?>

<div class="justify-content-center">
	<p class="lead text-muted text-center p-5">No se han registrado actividades extraescolares</p>
</div>

<?php endif; ?>

<hr>

