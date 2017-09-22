<?php
require('../config.php');

session_start();

define('INTRANET_DIRECTORY', __DIR__);

// COMPROBAMOS LA SESION
if ($_SESSION['alumno_autenticado'] != 1) {
	$_SESSION = array();
	session_destroy();
	
	if(isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {
		header('Location:'.WEBCENTROS_DOMINIO.'alumnado/salir.php');
		exit();
	}
	else {
		header("Location:".WEBCENTROS_DOMINIO.'alumnado/salir.php');
		exit();
	}
}

if($_SERVER['SCRIPT_NAME'] != '/alumnado/clave.php') {
	if($_SESSION['alumno_cambiar_clave']) {
		if(isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {
			header('Location:'.'https://'.WEBCENTROS_DOMINIO.'alumnado/clave.php');
			exit();
		}
		else {
			header("Location:".WEBCENTROS_DOMINIO.'alumnado/clave.php');
			exit();
		}
	}
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
					<a href="clave.php" class="btn btn-info btn-sm">Cambiar contraseña</a>
					<a href="salir.php" class="btn btn-primary btn-sm">Cerrar sesión</a>
				</div>
			</div>
			
			<?php $result = mysqli_query($db_con, "SELECT correo FROM control WHERE claveal='$claveal' LIMIT 1"); ?>
			<?php $row2 = mysqli_fetch_array($result); ?>
			<?php mysqli_free_result($result); ?>
			
			<?php $result = mysqli_query($db_con, "SELECT claveal, DNI, fecha, domicilio, telefono, padre, dnitutor, matriculas, telefonourgencia, paisnacimiento, correo, nacionalidad, edad, curso, unidad, numeroexpediente FROM alma WHERE claveal= '$claveal'"); ?>
			
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
								
								<dt class="col-sm-5">Año académico</dt>
								<dd class="col-sm-7"><?php echo $c_escolar; ?></dd>
								
								<dt class="col-sm-5">Curso</dt>
								<dd class="col-sm-7"><?php echo ($row['curso'] != "") ? $row['curso']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Unidad</dt>
								<dd class="col-sm-7"><?php echo ($row['unidad'] != "") ? $row['unidad']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Tutor</dt>
								<dd class="col-sm-7"><?php echo ($tutor != "") ? mb_convert_case($tutor, MB_CASE_TITLE, 'UTF-8'): '<span class="text-muted">Sin registrar</span>'; ?></dd>
								
								<dt class="col-sm-5">Repetidor/a</dt>
								<dd class="col-sm-7"><?php echo ($row['matriculas'] > 1) ? 'S�': 'No'; ?></dd>
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
						<li class="nav-item"><a class="nav-link active" href="#asistencia" role="tab" data-toggle="tab">Faltas de Asistencia</a></li>
						<li class="nav-item"><a class="nav-link" href="#convivencia" role="tab" data-toggle="tab">Problemas de Convivencia</a></li>
						<li class="nav-item"><a class="nav-link" href="#actividades" role="tab" data-toggle="tab">Actividades Extraescolares</a></li>
						<li class="nav-item"><a class="nav-link" href="#horario" role="tab" data-toggle="tab">Horario y Profesores</a></li>
						<li class="nav-item"><a class="nav-link" href="#recursos" role="tab" data-toggle="tab">Recursos Educativos</a></li>
						<li class="nav-item"><a class="nav-link" href="#evaluables" role="tab" data-toggle="tab">Actividades Evaluables</a></li>
						<li class="nav-item"><a class="nav-link" href="#evaluaciones" role="tab" data-toggle="tab">Notas de Evaluaciones</a></li>
						<li class="nav-item"><a class="nav-link" href="#mensajes" role="tab" data-toggle="tab">Mensajes del Centro</a></li>
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
						<div class="tab-pane" id="actividades">
						<?php include("actividades.php"); ?>
						</div>
						<div class="tab-pane" id="horario">
						<?php include("horarios.php"); ?>
						</div>
						<div class="tab-pane hidden-print" id="recursos">
						<?php include("recursos.php"); ?>
						</div>
						<div class="tab-pane" id="evaluables">
						<?php include("evaluables.php"); ?>
						</div>
						<div class="tab-pane" id="evaluaciones">
						<?php include("notas.php"); ?>
						</div>
						<div class="tab-pane hidden-print" id="mensajes">
						<?php include("mensajes.php"); ?>
						</div>
					</div>
					
				</div>
				
			</div><!-- /.row -->
			
			<?php else: ?>
			
			<br><br><br>
			<div class="text-center text-muted">
				<p class="lead">No hay información sobre el alumno/a en este curso.</p>
			</div>
			<br><br><br>
			
			<?php endif; ?>
		
		</div><!-- /.container -->
	</div>
	
	<?php if(isset($_GET['mod']) && $_GET['mod'] == 'recursos'): ?>
	<script>$('#nav_alumno a[href="#recursos"]').tab('show');</script>
	<?php endif; ?>
	
	<?php if(isset($_GET['mod']) && $_GET['mod'] == 'mensajes'): ?>
	<script>$('#nav_alumno a[href="#mensajes"]').tab('show');</script>
	<?php endif; ?>

    <?php include("../inc_pie.php"); ?>

</body>
</html>
