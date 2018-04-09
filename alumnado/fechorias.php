<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed'); ?>

<!-- MODULO PROBLEMAS DE CONVIVENCIA -->

<a name="convivencia"></a>
<h3>Problemas de convivencia</h3>

<?php $result = mysqli_query($db_con, "SELECT DISTINCT FALUMNOS.apellidos, FALUMNOS.nombre, FALUMNOS.unidad, Fechoria.fecha, 
Fechoria.notas, Fechoria.asunto, Fechoria.informa, Fechoria.claveal, grave FROM Fechoria, FALUMNOS WHERE FALUMNOS.claveal = Fechoria.claveal
 AND FALUMNOS.claveal = $claveal ORDER BY Fechoria.fecha DESC, FALUMNOS.unidad, FALUMNOS.apellidos"); ?>
<?php if (mysqli_num_rows($result)): ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover datatable2">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Conducta contraria</th>
				<th>Gravedad</th>
				<th>Profesor</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($result)): ?>
			<tr>
				<td><?php echo $row['fecha']; ?></td>
				<td><?php echo $row['asunto']; ?></td>
				<td><?php echo $row['grave']; ?></td>
				<td><?php echo $row['informa']; ?></td>
			</tr>
			<?php endwhile; ?>
			<?php mysqli_free_result($result); ?>
		</tbody>
	</table>
</div>

<?php $result = mysqli_query($db_con, "SELECT expulsion, inicio, fin, asunto, aula_conv, inicio_aula, fin_aula FROM Fechoria WHERE Fechoria.claveal = '$claveal' AND (expulsion > '0' OR aula_conv>0) AND Fechoria.fecha >= '".$config['curso_inicio']."' ORDER BY Fechoria.fecha"); ?>
<?php if (mysqli_num_rows($result)): ?>
<h3>Expulsiones</h3>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Expulsión</th>
				<th>Fecha</th>
				<th>Conducta contraria</th>
				<?php if (isset($config['alumnado']['ver_informes_tareas']) && $config['alumnado']['ver_informes_tareas']): ?>
				<th>Informe de tareas</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($result)): ?>
			<?php $inicio_exp = ($row['expulsion'] > '1') ? $row['inicio'] : $row['inicio_aula']; ?>
			<?php $final_exp = ($row['expulsion'] > '1') ? $row['fin'] : $row['fin_aula']; ?>
			<tr>
				<td><?php echo ($row['expulsion'] > '1') ? 'Expulsión del centro' : 'Aula de convivencia'; ?></td>
				<td><?php echo strftime('%e %b', strtotime($inicio_exp)); ?> al <?php echo strftime('%e %b', strtotime($final_exp)); ?></td>
				<td><?php echo $row['asunto']; ?></td>
				<?php if (isset($config['alumnado']['ver_informes_tareas']) && $config['alumnado']['ver_informes_tareas']): ?>
				<td>
					<?php $result_tareas = mysqli_query($db_con, "SELECT id FROM tareas_alumnos WHERE claveal = '".$claveal."' AND fecha = '".$inicio_exp."' AND fin = '".$final_exp."' LIMIT 1"); ?>
					<?php if (mysqli_num_rows($result_tareas)): ?>
					<?php $row_tareas = mysqli_fetch_array($result_tareas); ?>
					<form action="imptareas.php" method="post">
						<input type="hidden" name="id" value="<?php echo $row_tareas['id']; ?>">
						<button type="submit" class="btn btn-primary">Descargar informe</button>
					</form>
					<?php endif; ?>
				</td>
				<?php endif; ?>
			</tr>
			<?php endwhile; ?>
			<?php mysqli_free_result($result); ?>
		</tbody>
	</table>
</div>
<?php endif; ?>


<?php else: ?>

<div class="justify-content-center">
	<p class="lead text-muted text-center p-5">No se han registrado problemas de convicencia</p>
</div>

<?php endif; ?>
  
<!-- FIN MODULO PROBLEMAS DE CONVIVENCIA -->
