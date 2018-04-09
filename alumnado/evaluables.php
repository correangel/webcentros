<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed'); 

$query_evaluables = mysqli_query($db_con, "SELECT DISTINCT notas_cuaderno.profesor AS nomprofesor, asignaturas.NOMBRE AS nomasignatura, notas_cuaderno.id AS idactividad, notas_cuaderno.nombre AS nomactividad, notas_cuaderno.fecha AS fecactividad FROM notas_cuaderno JOIN asignaturas ON notas_cuaderno.asignatura = asignaturas.CODIGO WHERE notas_cuaderno.curso LIKE '%$unidad%' AND notas_cuaderno.visible_nota=1");
?>

<a name="evaluables"></a>
<h3>Actividades evaluables</h3>

<br>

<?php if(mysqli_num_rows($query_evaluables)): ?>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Actividad</th>
      <th>Asignatura</th>
      <th>Fecha</th>
      <th>Calificación</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($actividad = mysqli_fetch_array($query_evaluables)): ?>
    <tr>
      <td><?php echo $actividad['nomactividad'];  ?></td>
      <td><?php echo $actividad['nomasignatura']; ?></td>
      <td><?php echo $actividad['fecactividad'];  ?></td>
      <?php
      $query_calificacion = mysqli_query($db_con, "SELECT nota FROM datos WHERE claveal='$claveal' AND id='".$actividad['idactividad']."'");
      $actividad_nota = mysqli_fetch_array($query_calificacion);
      ?>
      <td><?php echo $actividad_nota['nota']; ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php else: ?>

<div class="justify-content-center">
	<p class="lead text-muted text-center p-5">No se han registrado actividades evaluables</p>
</div>

<?php endif; ?>