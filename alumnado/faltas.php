<?php defined('WEBCENTROS_DIRECTORY') OR exit('No direct script access allowed'); ?>

<!-- MODULO RESUMEN FALTAS DE ASISTENCIA -->

<a name="faltas"></a>
<h3>Resumen de faltas de asistencia</h3>

<div class="row">

	<div class="col-sm-3">

		<?php $result = mysqli_query($db_con, "SELECT COUNT(*) AS total FROM FALTAS WHERE FALTAS.falta = 'F' and FALTAS.claveal = '$claveal'"); ?>
		<?php $total = 0; ?>
		<?php if (mysqli_num_rows($result)): ?>
		<?php $row = mysqli_fetch_array($result); ?>
		<?php $total = $row['total']; ?>
		<?php mysqli_free_result($result); ?>
		<?php endif; ?>

		<h4 class="text-info text-center">
			<?php echo $total; ?><br>
			<small class="text-muted text-uppercase">faltas injustificadas</small>
		</h4>

	</div>

	<div class="col-sm-3">

		<?php $result = mysqli_query($db_con, "SELECT COUNT(*) AS total FROM FALTAS WHERE FALTAS.falta = 'J' AND  FALTAS.claveal = '$claveal'"); ?>
		<?php $total = 0; ?>
		<?php if (mysqli_num_rows($result)): ?>
		<?php $row = mysqli_fetch_array($result); ?>
		<?php $total = $row['total']; ?>
		<?php mysqli_free_result($result); ?>
		<?php endif; ?>

		<h4 class="text-info text-center">
			<?php echo $total; ?><br>
			<small class="text-muted text-uppercase">faltas justificadas</small>
		</h4>

	</div>

	<div class="col-sm-3">

		<?php $result = mysqli_query($db_con, "SELECT COUNT(*) AS total FROM FALTAS WHERE FALTAS.falta = 'R' and FALTAS.claveal = '$claveal'"); ?>
		<?php $total = 0; ?>
		<?php if (mysqli_num_rows($result)): ?>
		<?php $row = mysqli_fetch_array($result); ?>
		<?php $total = $row['total']; ?>
		<?php mysqli_free_result($result); ?>
		<?php endif; ?>

		<h4 class="text-info text-center">
			<?php echo $total; ?><br>
			<small class="text-muted text-uppercase">retrasos injustificados</small>
		</h4>

	</div>

	<div class="col-sm-3">

		<?php $result = mysqli_query($db_con, "SELECT `fecha`, COUNT(`hora`) AS 'horas' FROM `FALTAS` WHERE `claveal` = '".$claveal."' AND `falta` = 'F' GROUP BY `fecha` HAVING `horas` = 6 ORDER BY `fecha` ASC, `hora` ASC"); ?>
		<?php $total = 0; ?>
		<?php $total = mysqli_num_rows($result); ?>

		<h4 class="text-info text-center">
			<?php echo $total; ?><br>
			<small class="text-muted text-uppercase">días completos injustificados</small>
		</h4>

	</div>

</div>

<br>

<!-- FIN MODULO RESUMEN FALTAS DE ASISTENCIA -->
