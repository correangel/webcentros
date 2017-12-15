<?php defined('INTRANET_DIRECTORY') OR exit('No direct script access allowed'); 

if(isset($_POST['enviar'])) {
	
	$asunto = trim(mysqli_real_escape_string($db_con,	$_POST['asunto']));
	$mensaje = trim(mysqli_real_escape_string($db_con, $_POST['mensaje']));

	if (! empty($asunto) && ! empty($mensaje)) {

		if (isset($_SESSION['dnitutor'])) {
			$mensaje .= mysqli_real_escape_string('<br><p style="color: #000 !important; background-color: #fff !important;">Mensaje enviado por el tutor/a legal:</p><p style="color: #000 !important; background-color: #fff !important;">'.$_SESSION['nombretutor'].'</p>');
		}
		
		$result = mysqli_query($db_con, "INSERT INTO mensajes (dni, claveal, asunto, texto, ip, correo, unidad) VALUES ('$dni_responsable_legal', '".$_SESSION['claveal']."', '$asunto', '$mensaje', '".$_SESSION['direccion_ip']."', '".$_SESSION['correo']."', '$unidad')");
		
		if(! $result) {
			$msg_error = "Los campos del formulario son obligatorios.";
		}
		else {
			$msg_success = "El mensaje ha sido enviado correctamente.";
		}
		
	}
	else {
		$msg_error = "Los campos del formulario son obligatorios.";
	}
	
}

if(isset($_POST['leido'])){
	$verifica = $_POST['verifica'];
	
	$result = mysqli_query("SELECT recibidoprofe FROM mens_profes WHERE id_profe = '".$_POST['verifica']."'");
	$row = mysqli_fetch_array($result);

	if (! $row['recibidoprofe']) {
		mysqli_query($db_con, "UPDATE mens_profes SET recibidoprofe = '1' WHERE id_profe = '".$_POST['verifica']."'");
	
		$asunto_confirmacion = "Mensaje de confirmación";
		$mensaje = "El mensaje enviado a $nombrepil $apellido con el asunto \"$asunto\" ha sido entregado y leído en la web del centro.";
		
		mysqli_query($db_con, "INSERT INTO mensajes (dni, claveal, asunto, texto, ip, correo, unidad) VALUES ('$dni_responsable_legal', '".$_SESSION['claveal']."', '$asunto_confirmacion', '$mensaje', '".$_SESSION['direccion_ip']."', '".$_SESSION['correo']."', '$unidad')");
	}

}  
?>

<a name="mensajes"></a>
<h3>Mensajes</h3>

<br>

<?php if(isset($msg_error)): ?>
<div class="alert alert-danger">
	<?php echo $msg_error; ?>
</div>
<?php endif; ?>

<?php if(isset($msg_success)): ?>
<div class="alert alert-success">
	<?php echo $msg_success; ?>
</div>
<?php endif; ?>

<div class="row">
	
	<div class="col-sm-5">
		
		<div class="bg-clouds p-3 rounded">
			<h5>Mensajes recibidos</h5>
		
			<?php $query_mensajes = mysqli_query($db_con, "SELECT mens_texto.id, ahora, asunto, texto, c_profes.profesor, (SELECT recibidoprofe FROM mens_profes WHERE id_texto = mens_texto.id AND profesor LIKE '%$apellido, $nombrepil%' OR profesor LIKE '%".$_SESSION['claveal']."%' LIMIT 1) AS recibidoprofe FROM mens_texto JOIN c_profes ON mens_texto.origen = c_profes.idea WHERE ahora BETWEEN '".$config['curso_inicio']."' AND '".$config['curso_fin']."' AND (destino LIKE '%$apellido, $nombrepil%' OR destino LIKE '%".$_SESSION['claveal']."%' AND asunto NOT LIKE 'Mensaje de confirmación') ORDER BY ahora DESC"); ?>
			<?php if(mysqli_num_rows($query_mensajes)): ?>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tbody>
						<?php while ($mensajes_recibidos = mysqli_fetch_array($query_mensajes)): ?>
						<tr<?php echo (! $mensajes_recibidos['recibidoprofe']) ? ' class="success"' : ''; ?>>
							<td><a href="#" data-toggle="modal" data-target="#recibidos_<?php echo $mensajes_recibidos['id']; ?>" style="display: block;"><?php echo $mensajes_recibidos['asunto'];  ?><br /><small class="text-muted"><?php echo $mensajes_recibidos['profesor']; ?> - <?php echo $mensajes_recibidos['ahora']; ?></small></a></td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
			
			<?php else: ?>
			
			<div class="justify-content-center">
				<p class="lead text-muted text-center p-5">No ha recibido mensajes</p>
			</div>
			
			<?php endif; ?>
		</div>
		
		<hr>
		
		<div class="bg-clouds p-3 rounded">
			<h5>Mensajes enviados</h5>
			
			<?php $query_enviados = mysqli_query($db_con, "SELECT id, ahora, asunto, texto, recibidotutor FROM mensajes WHERE ahora BETWEEN '".$config['curso_inicio']."' AND '".$config['curso_fin']."' AND (claveal = '".$_SESSION['claveal']."' AND asunto NOT LIKE 'Mensaje de confirmación')"); ?>
			<?php if(mysqli_num_rows($query_enviados)): ?>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tbody>
						<?php while ($mensajes_enviados = mysqli_fetch_array($query_enviados)): ?>
						<tr>
							<td>
								<a href="#" data-toggle="modal" data-target="#enviados_<?php echo $mensajes_enviados['id']; ?>" style="display: block;">
									<?php echo $mensajes_enviados['asunto'];  ?><br />
									<small class="text-muted"><?php echo $apellido.', '.$nombrepil; ?> - <?php echo $mensajes_enviados['ahora']; ?></small>
									
									<?php
									if ($mensajes_enviados['recibidotutor']) {
										$leido_class = "text-success";
										$leido = "El tutor ha leido el mensaje";
										
										mysqli_query($db_con, "UPDATE mensajes SET recibidopadre = '1' WHERE id='".$mensajes_enviados['id']."' LIMIT 1");
									} 
									else {
										$leido_class = "text-muted";
										$leido = "El tutor aún no ha leido el mensaje";
									}
									?>
									<span class="fa fa-check fa-fw pull-right <?php echo $leido_class; ?>" data-toggle="tooltip" title="<?php echo $leido; ?>"></span>
								</a>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
			
			<?php else: ?>
			
			<div class="justify-content-center">
				<p class="lead text-muted text-center p-5">No ha enviado ningún mensaje</p>
			</div>
			
			<?php endif; ?>
		</div>
		
	</div>
	
	<div class="col-sm-6 col-sm-offset-1">
		
		<form method="post" action="index.php?mod=mensajes">
			
			<fieldset>
				<legend>Contactar con el tutor</legend>
				
				<div class="form-group">
					<label for="asunto">Asunto</label>
					<input type="text" class="form-control" id="asunto" name="asunto">
				</div>
				
				<div class="form-group">
					<label for="mensaje">Mensaje</label>
					<textarea type="text" class="form-control" id="mensaje" name="mensaje" rows="5"></textarea>
				</div>
				
				<button type="submit" class="btn btn-primary" name="enviar">Enviar mensaje</button>
				
			</fieldset>
			
		</form>
		
	</div>

</div>

<?php $query_mensajes = mysqli_query($db_con, "SELECT mens_texto.id, ahora, asunto, texto, c_profes.profesor, (SELECT recibidoprofe FROM mens_profes WHERE id_texto = mens_texto.id AND profesor LIKE '%$apellido, $nombrepil%' OR profesor LIKE '%".$_SESSION['claveal']."%' LIMIT 1) AS recibidoprofe, (SELECT id_profe FROM mens_profes WHERE id_texto = mens_texto.id AND profesor LIKE '%$apellido, $nombrepil%' OR profesor LIKE '%".$_SESSION['claveal']."%' LIMIT 1) AS id_profe FROM mens_texto JOIN c_profes ON mens_texto.origen = c_profes.idea WHERE ahora BETWEEN '".$config['curso_inicio']."' AND '".$config['curso_fin']."' AND (destino LIKE '%$apellido, $nombrepil%' OR destino LIKE '%".$_SESSION['claveal']."%' AND asunto NOT LIKE 'Mensaje de confirmación') ORDER BY ahora DESC"); ?>
<?php if(mysqli_num_rows($query_mensajes)): ?>
<?php while ($mensajes_recibidos = mysqli_fetch_array($query_mensajes)): ?>
<div id="recibidos_<?php echo $mensajes_recibidos['id']; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="title title-up"><?php echo $mensajes_recibidos['asunto']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo html_entity_decode(stripslashes($mensajes_recibidos['texto'])); ?>
				<hr>
				<p><small>Enviado por <?php echo $mensajes_recibidos['profesor']; ?> el <?php echo $mensajes_recibidos['ahora']; ?></small></p>
      </div>
      <div class="modal-footer">
      	<?php if(! $mensajes_recibidos['recibidoprofe']): ?>
      	<form method="post" action="index.php?mod=mensajes">
	      	<input type="hidden" name="verifica" value="<?php echo $mensajes_recibidos['id_profe']; ?>">
	        <button type="submit" class="btn btn-default" name="leido">Cerrar</button>
	      </form>
	      <?php else: ?>
	      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      <?php endif; ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endwhile; ?>
<?php endif; ?>

<?php $query_enviados = mysqli_query($db_con, "SELECT id, ahora, asunto, texto, recibidotutor FROM mensajes WHERE ahora BETWEEN '".$config['curso_inicio']."' AND '".$config['curso_fin']."' AND (claveal = '".$_SESSION['claveal']."' AND asunto NOT LIKE 'Mensaje de confirmación')"); ?>
<?php if(mysqli_num_rows($query_enviados)): ?>
<?php while ($mensajes_enviados = mysqli_fetch_array($query_enviados)): ?>
<div id="enviados_<?php echo $mensajes_enviados['id']; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="title title-up"><?php echo $mensajes_enviados['asunto']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo html_entity_decode(stripslashes($mensajes_enviados['texto'])); ?>
				<hr>
				<p><small>Enviado por <?php echo $apellido.', '.$nombrepil; ?> el <?php echo $mensajes_enviados['ahora']; ?></small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endwhile; ?>
<?php endif; ?>