<?php
require_once("../bootstrap.php");
require_once('../config.php');

session_start();
session_regenerate_id();

define('INTRANET_DIRECTORY', __DIR__);

// COMPROBAMOS LA SESION
if ($_SESSION['alumno_autenticado'] != 1) {
	$_SESSION = array();
	session_destroy();
	
	header('Location:'.WEBCENTROS_DOMINIO.'alumnado/salir.php');
	exit();
}

// FORZAMOS EL CAMBIO DE CONTRASEÑA
if(isset($_SESSION['cambiar_clave_alumno']) && $_SESSION['cambiar_clave_alumno']) {
	header('Location:'.WEBCENTROS_DOMINIO.'alumnado/clave.php');
	exit();
}

$claveal = $_SESSION['claveal'];
$c_escolar = (date('n') > 6) ?  date('Y').'/'.(date('y')+1) : (date('Y')-1).'/'.date('y');

if ($claveal) {
  $result1 = mysqli_query($db_con, "SELECT DISTINCT apellidos, nombre, unidad, claveal, claveal1, numeroexpediente, dnitutor FROM alma WHERE claveal = '$claveal' ORDER BY apellidos");
 	
	if ($row1 = mysqli_fetch_array($result1)) {
	  $unidad = $row1['unidad'];
	  $claveal1 = $row1['claveal1'];
	  $apellido = $row1['apellidos'];
	  $nombrepil = $row1['nombre'];
	  $dni_responsable_legal = $row1['dnitutor'];
  } 
}

if (isset($_POST['subirFotografia'])) {

	$fotografia = $_FILES['foto']['tmp_name'];
	
	if (empty($claveal) || empty($fotografia)) {
		$msg_error = "Todos los campos del formulario son obligatorios.";
	}
	else {
		
		if ($_FILES['foto']['type'] != 'image/jpeg') {
			$msg_error = "El formato del archivo no es válido.";
		}
		else {
			require_once('../plugins/class.Images.php');
			$image = new Image($fotografia);
			$image->resize(240,320,'crop');
			$image->save($claveal, '../intranet/xml/fotos/', 'jpg');
			
			$file_content = mysqli_real_escape_string($db_con, file_get_contents('../intranet/xml/fotos/'.$claveal.'.jpg'));
			$file_size = filesize('../intranet/xml/fotos/'.$claveal.'.jpg');
			
			// Eliminamos posibles imagenes que hayan en la tabla
			mysqli_query($db_con, "DELETE FROM fotos WHERE nombre='".$claveal.".jpg'");
			
			// Insertamos la foto en la tabla, esto es útil para la página externa
			mysqli_query($db_con, "INSERT fotos (nombre, datos, fecha, tamaño) VALUES ('".$claveal.".jpg', '$file_content', '".date('Y-m-d H:i:s')."', '".$file_size."')");
			
			$msg_success = "La fotografía se ha actualizado.";
		}
		
	}
}

$pagina['titulo'] = $nombrepil.' '.$apellido;

$pagina['meta']['robots'] = 0;
$pagina['meta']['canonical'] = 0;

include('../inc_menu.php');
?>

	<div class="section">
		<div class="container">
			
			<!-- TITULO DE LA PAGINA -->
			<div class="marg-bottom15">
				<h2 style="display: inline;" class="mr-auto">Expediente académico del alumno/a</h2>
				<div style="display: inline;" class="pull-right hidden-print">
					<?php if (! isset($_SESSION['dnitutor'])): ?>
					<a href="clave.php" class="btn btn-info btn-sm">Cambiar contraseña</a>
					<?php endif; ?>
					<a href="salir.php" class="btn btn-primary btn-sm">Cerrar sesión</a>
				</div>
			</div>

			<?php if (isset($_SESSION['dnitutor'])): ?>
			<div class="alert alert-info">
				Ha iniciado sesión como <?php echo $_SESSION['nombretutor']; ?>, tutor/a legal de <?php echo $nombrepil; ?> <span style="border-bottom: 1px dotted #fff; cursor: help;" data-toggle="popover" data-placement="bottom" data-content="Los tutores legales registrados en la matrícula de su hijo/a en este centro tienen acceso al expediente académico utilizando su respectivo DNI como contraseña. Los accesos que realicen a este informe quedarán registrados, incluyendo fecha y dirección IP de su ordenador actual. Puede solicitar un documento con los accesos realizados a este informe en Jefatura de Estudios.">¿qué significa esto?</span>
			</div>
			<?php endif; ?>
			
			<?php $result = mysqli_query($db_con, "SELECT correo FROM control WHERE claveal='$claveal' LIMIT 1"); ?>
			<?php $row2 = mysqli_fetch_array($result); ?>
			<?php mysqli_free_result($result); ?>
			
			<?php $result = mysqli_query($db_con, "SELECT claveal, DNI, fecha, domicilio, telefono, padre, dnitutor, matriculas, telefonourgencia, paisnacimiento, correo, nacionalidad, edad, curso, unidad, numeroexpediente, segsocial FROM alma WHERE claveal= '$claveal'"); ?>
			
			<?php if ($row = mysqli_fetch_array($result)): ?>
			<?php $result_tutor = mysqli_query($db_con, "SELECT tutor FROM FTUTORES WHERE unidad = '".$row['unidad']."' LIMIT 1"); ?>
			<?php $row_tutor = mysqli_fetch_array($result_tutor); ?>
			<?php $exp_tutor = explode(", ",$row_tutor['tutor']); ?>
			<?php $tutor = trim($exp_tutor[1]." ".$exp_tutor[0]); ?>
			<!-- SCAFFOLDING -->
			<div class="card-box card-box-secondary">
			<div class="row">
				
				<!-- COLUMNA IZQUIERDA -->
				<div class="col-sm-2 text-center hidden-xs">
					<?php $foto = '../intranet/xml/fotos/'.$claveal.'.jpg'; ?>
					<?php if (file_exists($foto)): ?>
					<?php $foto_usuario = 'data:image/png;base64,'.base64_encode(file_get_contents($foto)); ?>
					<img class="img-thumbnail" src="<?php echo $foto_usuario; ?>" alt="<?php echo $apellido.', '.$nombrepil; ?>">
					<?php else: ?>
					<h2><span class="fa fa-user fa-fw fa-4x"></span></h2>
					<?php endif; ?>
					
					<a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#subirFotografia"><small>Subir o cambiar foto</small></a>
				</div><!-- /.col-sm-2 -->
				
				
				<!-- COLUMNA DERECHA -->
				<div class="col-sm-10">
					
					<div class="row">
					
						<div class="col-sm-6">
							
							<dl class="row">
								<dt class="col-sm-5">DNI / Pasaporte</dt>
								<dd class="col-sm-7"><?php echo ($row['DNI'] != "") ? $row['DNI']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Fecha de nacimiento</dt>
								<dd class="col-sm-7"><?php echo ($row['fecha'] != "") ? $row['fecha']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Edad</dt>
								<dd class="col-sm-7"><?php echo ($row['edad'] != "") ? $row['edad'].' años': '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Domicilio</dt>
								<dd class="col-sm-7"><?php echo ($row['domicilio'] != "") ? $row['domicilio']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Nacionalidad</dt>
								<dd class="col-sm-7"><?php echo ($row['nacionalidad'] != "") ? $row['nacionalidad']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Teléfono</dt>
								<dd class="col-sm-7"><?php echo ($row['telefono'] != "") ? $row['telefono']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Teléfono urgencias</dt>
								<dd class="col-sm-7"><?php echo ($row['telefonourgencia'] != "") ? $row['telefonourgencia']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Correo electrónico</dt>
									<?php 
									if ($row['correo'] != "") {
										$correo = $row['correo'];
									}
									elseif($row2['correo'] != "") {
										$correo = $row2['correo'];
									}
									else {
										$correo = '<span class="text-muted">Sin registrar</span>';
									}
									?>
								<dd class="col-sm-7"><?php echo $correo ?></dd>
								
								<dt class="col-sm-5">Representante legal</dt>
								<dd class="col-sm-7"><?php echo ($row['padre'] != "") ? $row['padre']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
							</dl>
							
						</div><!-- /.col-sm-6 -->
						
						<div class="col-sm-6">

							<dl class="row">
								<dt class="col-sm-5"><abbr data-bs="tooltip" title="Número de Identificación Escolar">N.I.E.</abbr></dt>
								<dd class="col-sm-7"><?php echo ($row['claveal'] != "") ? $row['claveal']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Nº Expediente</dt>
								<dd class="col-sm-7"><?php echo ($row['numeroexpediente'] != "") ? $row['numeroexpediente']: '<span class="text-muted">Sin registrar</span>'; ?></dd>

								<dt class="col-sm-5">Nº Seguridad Social</dt>
								<dd class="col-sm-7"><?php echo ($row['segsocial'] != "") ? $row['segsocial']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Año académico</dt>
								<dd class="col-sm-7"><?php echo $c_escolar; ?></dd>
								
								<dt class="col-sm-5">Curso</dt>
								<dd class="col-sm-7"><?php echo ($row['curso'] != "") ? $row['curso']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Unidad</dt>
								<dd class="col-sm-7"><?php echo ($row['unidad'] != "") ? $row['unidad']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Tutor</dt>
								<dd class="col-sm-7"><?php echo ($tutor != "") ? mb_convert_case($tutor, MB_CASE_TITLE, 'UTF-8'): '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Repetidor/a</dt>
								<dd class="col-sm-7"><?php echo ($row['matriculas'] > 1) ? 'Sí': 'No'; ?></dd>
							</dl>
							
						</div><!-- /.col-sm-6 -->
						
					</div><!-- /.row -->
					
				</div><!-- /.col-sm-10 -->
				
			</div><!-- /.row -->
			</div><!-- /.well -->
			
			
			<div class="row">
			
				<div class="col-sm-12">
				
					<style class="text/css">
					@media print {
						.body {
							margin: 0;
							padding: 0;
						}
						#intro {
							display: none;
						}
						.tab-content>.tab-pane {
							display: block;
							visibility: inherit;
						}
					}
					</style>
					
					<ul id="nav_alumno" class="nav nav-tabs nav-tabs-neutral justify-content-center" data-background-color="orange" role="tablist">
						<?php $tab1 = 1; ?>
						<li class="nav-item"><a class="nav-link active" href="#asistencia" role="tab" data-toggle="tab">Asistencia</a></li>
						<li class="nav-item"><a class="nav-link" href="#convivencia" role="tab" data-toggle="tab">Convivencia</a></li>
						<li class="nav-item"><a class="nav-link" href="#evaluaciones" role="tab" data-toggle="tab">Calificaciones</a></li>
						<li class="nav-item"><a class="nav-link" href="#actividades" role="tab" data-toggle="tab">Extraescolares</a></li>
						<li class="nav-item"><a class="nav-link" href="#evaluables" role="tab" data-toggle="tab">Actividades</a></li>
						<li class="nav-item"><a class="nav-link" href="#horario" role="tab" data-toggle="tab">Horario</a></li>
						<?php if (isset($config['alumnado']['ver_informes_tutoria']) && $config['alumnado']['ver_informes_tutoria']): ?>
						<li class="nav-item"><a class="nav-link" href="#tutoria" role="tab" data-toggle="tab">Tutoría</a></li>
						<?php endif; ?>
						<li class="nav-item"><a class="nav-link" href="#mensajes" role="tab" data-toggle="tab">Mensajes</a></li>
					</ul>

					<br>
					
					<div class="tab-content">
						<div class="tab-pane active" id="asistencia">
						<?php include("faltas.php"); ?>
						<?php include("faltasd.php"); ?>
						</div>
						<div class="tab-pane" id="convivencia">
						<?php include("fechorias.php"); ?>
						</div>
						<div class="tab-pane" id="evaluaciones">
						<?php include("notas.php"); ?>
						</div>
						<div class="tab-pane" id="actividades">
						<?php include("actividades.php"); ?>
						</div>
						<div class="tab-pane" id="evaluables">
						<?php include("evaluables.php"); ?>
						</div>
						<div class="tab-pane" id="horario">
						<?php include("horarios.php"); ?>
						</div>
						<?php if (isset($config['alumnado']['ver_informes_tutoria']) && $config['alumnado']['ver_informes_tutoria']): ?>
						<div class="tab-pane" id="tutoria">
						<?php include("tutoria.php"); ?>
						</div>
						<?php endif; ?>
						<div class="tab-pane" id="mensajes">
						<?php include("mensajes.php"); ?>
						</div>
					</div>
					
				</div>
				
			</div><!-- /.row -->
			
			<!-- MODAL SUBIDA FOTOGRAFIA -->
			<div class="modal fade" id="subirFotografia" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header justify-content-center">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="title title-up">Subir o cambiar fotografía</h4>
							</div>
							<div class="modal-body">
								<div class="bg-clouds p-3 rounded">
									<div class="form-group">
										<label for="foto">Suba o actualice la fotografía. El formato debe ser JPEG.</label>
										<input type="file" class="form-control" id="foto" name="foto" accept="image/jpg">
									</div>
								</div>

								<hr>

								<div class="help-block">
									<p>La foto debe cumplir la norma especificada:</p>
									<ul>
										<li>Tener el fondo de un único color, liso y claro.</li>
										<li>La foto ha de ser reciente y tener menos de 6 meses de antigüedad.</li>
										<li>Foto tipo carnet, la imagen no puede estar inclinada, tiene que mostrar la cara claramente de frente.</li>
										<li>Fotografía de cerca que incluya la cabeza y parte superior de los hombros, la cara ocuparía un 70-80% de la fotografía.</li>
										<li>Fotografía perfectamente enfocada y clara.</li>
									</ul>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" name="subirFotografia" class="btn btn-primary">Subir fotografía</button>
							</div>
						</div><!-- /.modal-content -->
					</form>
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			
			<?php else: ?>
			
			<div class="justify-content-center">
				<p class="lead text-muted text-center p-5">No hay información de este alumno/a</p>
			</div>
			
			<?php endif; ?>
		
		</div><!-- /.container -->
	</div>
	
	<?php include("../inc_pie.php"); ?>
	
	<script>
		<?php if(isset($_GET['mod']) && $_GET['mod'] == 'recursos'): ?>
		$('#nav_alumno a[href="#recursos"]').tab('show');
		<?php elseif (isset($_GET['mod']) && $_GET['mod'] == 'mensajes'): ?>
		$('#nav_alumno a[href="#mensajes"]').tab('show');
		<?php endif; ?>
	</script>

</body>
</html>
