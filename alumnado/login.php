<?php 
require('../config.php');

session_start(); 

function getRealIP() {
 
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
      return $_SERVER['HTTP_CLIENT_IP'];
     
  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
 
  return $_SERVER['REMOTE_ADDR'];
}

$_SESSION['direccion_ip'] = getRealIP();

$_SESSION['alumno_autenticado'] = 0;

if (isset($_POST['submit'])) {
	
	$usuario	= mysqli_real_escape_string($db_con, $_POST['user']);
	$clave		= mysqli_real_escape_string($db_con, $_POST['clave']);
	
	$result_admin = mysqli_query($db_con, "SELECT pass FROM c_profes WHERE nombre = 'Administrador' LIMIT 1");
	$row_result_admin = mysqli_fetch_array($result_admin);
	$clave_admin = $row_result_admin['pass'];
	
	$result = mysqli_query($db_con, "SELECT alma.claveal, apellidos, nombre, control.pass, alma.correo AS correo_matricula, control.correo FROM alma LEFT JOIN control ON alma.claveal = control.claveal WHERE alma.claveal='$usuario' AND (alma.claveal='$clave' OR control.pass=SHA1('$clave')) LIMIT 1");
	
	if (mysqli_num_rows($result)) {
		
		$usuario = mysqli_fetch_array($result);
		
		$_SESSION['alumno_autenticado'] = 1;
		
		$_SESSION['claveal'] = $usuario['claveal'];
		
		// Registramos el acceso
		mysqli_query($db_con, "INSERT INTO reg_principal (pagina, fecha, ip, claveal) VALUES ('".$_SERVER['REQUEST_URI']."', NOW(), '".$_SESSION['direccion_ip']."', '".$usuario['claveal']."')");
		
		// PRIMERA VEZ QUE EL USUARIO ACCEDE
		if ($clave == $usuario['claveal']) {
		
			$_SESSION['cambiar_clave_alumno'] = 1;
			
			mysqli_query($db_con, "INSERT INTO control (claveal, pass, correo) VALUES ('".$usuario['claveal']."', SHA1($clave), '".$usuario['correo_matricula']."')");
			
			header("Location:".WEBCENTROS_DOMINIO."alumnado/clave.php");
			exit();
		}
		elseif (sha1($clave) == $usuario['pass']) {
			
			$_SESSION['cambiar_clave_alumno'] = 0;
			
			header("Location:".WEBCENTROS_DOMINIO."alumnado/index.php");
			exit();
		}
		else {
			$msg_error = true;
			$msg_error_text = "Nombre de usuario y/o contraseña incorrectos.";
		}
		
	}
	else {
		$msg_error = true;
		$msg_error_text = "Nombre de usuario y/o contraseña incorrectos.";
	}
	
}

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = "Información del alumno";
$pagina['meta']['meta_description'] = "Información académica del alumno. Consulta de Problemas de convivencia, Faltas de asistencia, Boletín de notas, Horario escolar y más...";
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include('../inc_menu.php');
?>
	
	<div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(../ui-theme/img/login.jpg)"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                    <form class="form" method="post" action="">
                        <div class="header header-primary text-center">
                            <div class="logo-container" style="margin-bottom: 50px;">
                                <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/logo.png" width="125" alt="">
                            </div>
						</div>
						<?php if (isset($msg_error) && $msg_error): ?>
						<div class="alert alert-warning">
							<?php echo $msg_error_text; ?>
						</div>
						<?php endif; ?>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08 text-white"></i>
                                </span>
                                <input type="text" name="user" class="form-control" placeholder="Número de Identificación Escolar" value="<?php echo $_POST['user']; ?>">
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons objects_key-25 text-white"></i>
                                </span>
                                <input type="password" name="clave" placeholder="Contraseña" class="form-control">
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<?php include('../inc_pie.php'); ?>