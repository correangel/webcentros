<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed'); ?>

<!-- MODULO INFORMES DE TUTORIA -->

<a name="tutoria"></a>
<h3>Informes de tutoría</h3>

<?php $result = mysqli_query($db_con, "SELECT id, f_entrev, tutor FROM infotut_alumno WHERE claveal = '$claveal' ORDER BY f_entrev DESC"); ?>
<?php if (mysqli_num_rows($result)): ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Tutor/a</th>
				<th>Informe de tutoría</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($result)): ?>
			<tr>
				<td><?php echo strftime('%e %b', strtotime($row['f_entrev'])); ?></td>
				<td><?php echo $row['tutor']; ?></td>
				<td>
					<form action="imptutoria.php" method="post">
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
						<button type="submit" class="btn btn-primary">Descargar informe</button>
					</form>
				</td>
			</tr>
			<?php endwhile; ?>
			<?php mysqli_free_result($result); ?>
		</tbody>
	</table>
</div>

<?php else: ?>

<div class="justify-content-center">
	<p class="lead text-muted text-center p-5">No se han registrado informes de tutoría</p>
</div>

<?php endif; ?>

<hrA>

<h3>Informes de tareas</h3>

<?php $result = mysqli_query($db_con, "SELECT distinct id, fecha from tareas_alumnos where claveal = '$claveal'"); ?>
<?php if (mysqli_num_rows($result)): ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Informe de tareas</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($result)): ?>
			<tr>
				<td><?php echo strftime('%e %b', strtotime($row['fecha'])); ?></td>
				<td>
					<form action="imptareas.php" method="post">
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
						<button type="submit" class="btn btn-primary">Descargar informe</button>
					</form>
				</td>
			</tr>
			<?php endwhile; ?>
			<?php mysqli_free_result($result); ?>
		</tbody>
	</table>
</div>

<?php else: ?>

<div class="justify-content-center">
	<p class="lead text-muted text-center p-5">No se han registrado informes de tareas</p>
</div>

<?php endif; ?>
  
<!-- FIN MODULO INFORMES DE TUTORÍA -->
