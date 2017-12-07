<?php
require('../config.php');

session_start();

define('INTRANET_DIRECTORY', __DIR__);


// COMPROBAMOS LA SESION
if ($_SESSION['alumno_autenticado'] != 1) {
	$_SESSION = array();
	session_destroy();
	
	header("Location:".WEBCENTROS_DOMINIO.'alumnado/salir.php');
	exit();
}

if (isset($_SESSION['dnitutor'])) {
	header("Location:".WEBCENTROS_DOMINIO.'alumnado/index.php');
	exit();
}


function validarContrasena($contrasena) {
	$result = preg_match("((?=.*\d)(?=.*[a-z])(?=.*[A-z])(?=.*[!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]).{8,12})", $contrasena);
	
	return $result;
}

function validarCorreo($correo) {
	$result = filter_var($correo, FILTER_VALIDATE_EMAIL);
	
	return $result;
}

// VALIDAMOS EL FORMULARIO
if (isset($_POST['submit'])) {

	$usuario = $_POST['usuario'];
	$codigo2 = $_POST['codigo2'];
	$codigo3 = $_POST['codigo3'];
	$correo  = $_POST['correo'];
	
	$codigo2_has_error = 0;
	$codigo3_has_error = 0;
	$correo_has_error = 0;
	
	// Comprobamos que los campos no esten vacíos
	if(empty($correo) || empty($codigo2) || empty($codigo3)) {
		$msg_error = "Todos los campos del formulario son obligatorios.";
		$codigo2_has_error = 1;
		$codigo3_has_error = 1;
		$correo_has_error = 1;
	}
	else {
		// Comprobamos si se cumple los requisitos de seguridad de la contraseña
		if (! validarContrasena($codigo2)) {	
			$msg_error = "La contraseña no cumple con los requisitos de seguridad.";
			$codigo2_has_error = 1;
		}
		else {
			// Comprobamos que las contraseñas coinciden
			if($codigo2 !== $codigo3) {
				$msg_error = "Las contraseñas no coinciden.";
				$codigo2_has_error = 1;
				$codigo3_has_error = 1;
			}
			else {
				// Comprobamos que la dirección de correo electrónico sea válida
				if(! validarCorreo($correo)) {
					$msg_error = "La dirección de correo electrónico no es válida.";
					$correo_has_error = 1;
				}
				else {
					// Obtenemos el hash de la contraseña
					$hash = sha1($codigo2);
					
					$result = mysqli_query($db_con, "UPDATE control SET pass='$hash', correo='$correo' WHERE claveal='".$_SESSION['claveal']."'");
					
					// Comprobamos si se ha relizado la consulta a la base de datos
					if(!$result) {
						$msg_error = "No se ha podido cambiar la contraseña, así que mejor te pongas en contacto con quien pueda arreglar el asunto.";
					}
					else {
						$_SESSION['cambiar_clave_alumno'] = 0;
						$_SESSION['correo'] = $correo;
						
						// Redirigimos a la página principal
						header("Location:"."index.php");
					}
				}
			}
		}
	}
}

$result = mysqli_query($db_con, "SELECT control.claveal, control.correo, CONCAT(alma.apellidos,', ',alma.nombre) AS alumno FROM alma JOIN control ON alma.claveal = control.claveal WHERE alma.claveal='".$_SESSION['claveal']."' LIMIT 1");
$row = mysqli_fetch_assoc($result);

$pagina['titulo'] = 'Cambiar la contraseña';
include("../inc_menu.php");
?>

	<div class="section">
		<div class="container">

			<!-- TITULO DE LA PAGINA -->
			<div class="marg-bottom15">
				<h2 style="display: inline;" class="mr-auto">Expediente académico del alumno/a</h2>
				<div style="display: inline;" class="pull-right hidden-print">
					<a href="salir.php" class="btn btn-primary btn-sm">Cerrar sesión</a>
				</div>
			</div>

			<br>
			
			<!-- MENSAJES -->
			<?php if(isset($msg_error)): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $msg_error; ?>
			</div>
			<?php endif; ?>
			
			<div class="row">
				
				<div class="col-sm-6">
					
					<div class="well">
						
						<form class="form-horizontal" method="post" action="">
							<fieldset>
								
								<div class="form-group">
								<label for="usuario" class="col-sm-4 control-label">Alumno/a</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $row['alumno']; ?>" readonly>
								</div>
							</div>
							
							<div id="form-group-codigo2"  class="form-group">
								<label for="codigo2" class="col-sm-4 control-label">Nueva contraseña</label>
								<div class="col-sm-8">
								<input type="password" class="form-control" id="codigo2" name="codigo2" placeholder="Nueva contraseña" maxlength="12">
								</div>
							</div>
							
							<div id="form-group-codigo3"  class="form-group">
								<label for="codigo3" class="col-sm-4 control-label">Repita la contraseña</label>
								<div class="col-sm-8">
								<input type="password" class="form-control" id="codigo3" name="codigo3" placeholder="Repita la contraseña" maxlength="12">
								</div>
							</div>
							
							<div id="form-group-email" class="form-group">
								<label for="correo" class="col-sm-4 control-label">Correo electrónico</label>
								<div class="col-sm-8">
								<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" value="<?php echo $row['correo'];?>">
								</div>
							</div>
								
								
								<div class="form-group">
								<div class="col-sm-8 col-sm-offset-4">
									<button type="submit" class="btn btn-primary" name="submit">Cambiar la contraseña</button>
									<?php if($_SESSION['cambiar_clave_alumno'] == 0): ?>
									<a href="index.php" class="btn btn-default">Volver</a>
									<?php endif; ?>
								</div>
								</div>
							</fieldset>
						</form>
						
					</div><!-- /.well -->
					
				</div><!-- /.col-sm-6 -->
				
				
				<div class="col-sm-6">
					
					<h3>Utilice una contraseña segura</h3>
					
					<p>A partir de este momento tendrás que usar tu nombre de usuario IdEA y esta clave para acceder a la intranet. La dirección de correo electrónico se usará para las notificaciones y para reiniciar la contraseña en caso de olvido.</p>
					
					<p>La clave debe cumplir las siguientes condiciones:</p>
					
					<ul class="">
						<li>Tener al menos una longitud de 8 caracteres y 12 como máximo.</li>
						<li>Contener al menos una letra, un número y un signo de puntuación o un símbolo.</li>
						<li>Los símbolos aceptados son !"#$%&amp;'()*+,-./:;&raquo;=>?@[\]^_`{|}~</li>
						<li>Las letras acentuadas y las eñes no están admitidas.</li>
						<li>No ser similar al nombre de usuario.</li>
						<li>No ser similar a su D.N.I. o pasaporte.</li>
					</ul>
					
				</div>
				
			</div><!-- /.row -->
			
		</div><!-- /.container -->
	</div>

<?php if($codigo2_has_error): ?>
    <script>$("#form-group-codigo2").addClass( "has-error" );</script>
<?php endif; ?>
<?php if($codigo3_has_error): ?>
    <script>$("#form-group-codigo3").addClass( "has-error" );</script>
<?php endif; ?>
<?php if($correo_has_error): ?>
    <script>$("#form-group-email").addClass( "has-error" );</script>
<?php endif; ?>

</body>
</html>
