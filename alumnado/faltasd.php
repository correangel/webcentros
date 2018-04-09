<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed'); ?>

<!-- MODULO DETALLADO FALTAS DE ASISTENCIA -->

<?php
function tipo_falta($falta) {
	
	switch ($falta) {
		case 'J' : $tipo = 'Justificada'; break;
		case 'F' : $tipo = 'Injustificada'; break;
		case 'I' : $tipo = 'Injustificada'; break;
		case 'R' : $tipo = 'Retraso'; break;
	}
	
	return $tipo;
}
?>

<h3>Informe detallado de faltas de asistencia</h3>
<br>

<?php $result = mysqli_query($db_con, "SELECT DISTINCT fecha FROM FALTAS WHERE claveal = '$claveal' ORDER BY fecha DESC"); ?>
<?php if (mysqli_num_rows($result)): ?>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<?php for ($i = 1; $i < 7; $i++): ?>
				<th><?php echo $i; ?>ª hora</th>
				<?php endfor; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($result)): ?>
			<tr>
				<th><abbr data-bs="tooltip" title="<?php echo strftime('%A', strtotime($row['fecha'])); ?>"><?php echo $row['fecha']; ?></abbr></th>
				<?php for ($i = 1; $i < 7; $i++): ?>
				<?php $result_falta = mysqli_query($db_con, "SELECT DISTINCT asignaturas.abrev, asignaturas.nombre, falta FROM FALTAS JOIN asignaturas ON FALTAS.codasi = asignaturas.codigo  WHERE claveal = '$claveal' AND fecha = '".$row['fecha']."' AND hora = '$i' and abrev not like '%\_%'"); ?>
				<?php $row_falta = mysqli_fetch_array($result_falta); ?>
				<td>
					<span data-toggle="tooltip" title="<?php echo $row_falta['nombre']; ?>" style="cursor: default;">
						<span class="badge badge-default"><?php echo $row_falta['abrev']; ?></span>
					</span>
					
					<span data-toggle="tooltip" title="<?php echo tipo_falta($row_falta['falta']); ?>" style="cursor: default;">
					<?php echo ($row_falta['falta'] == "I" || $row_falta['falta'] == "F") ? '<span class="badge badge-danger">'.$row_falta['falta'].'</badge>' : ''; ?>
					<?php echo ($row_falta['falta'] == "R") ? '<span class="badge badge-warning">'.$row_falta['falta'].'</badge>' : ''; ?>
					<?php echo ($row_falta['falta'] == "J") ? '<span class="badge badge-success">'.$row_falta['falta'].'</badge>' : ''; ?>
					</span>
				</td>
				<?php endfor; ?>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php endif; ?>

<!-- FIN MODULO DETALLADO FALTAS DE ASISTENCIA -->
