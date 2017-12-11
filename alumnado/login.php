<?php 
require_once("../bootstrap.php");
require_once('../config.php');

$plugin_google_recaptcha = false;
if (isset($config['google_recaptcha']['site_key']) && $config['google_recaptcha']['site_key'] != 'YOUR_SITE_KEY' && isset($config['google_recaptcha']['secret']) && $config['google_recaptcha']['secret'] != 'YOUR_SECRET_CODE') {
    require_once('../plugins/recaptchalib.php');
	$plugin_google_recaptcha = true;
	$recaptcha_obligatorio = false;
}
session_start();

if (! isset($_SESSION['intentos'])) $_SESSION['intentos'] = 0;

$_SESSION['direccion_ip'] = getRealIP();

$_SESSION['alumno_autenticado'] = 0;

if (isset($_POST['submit'])) {
	
	$usuario	= xss_clean($_POST['user']);
	$clave		= xss_clean($_POST['clave']);

	if ($plugin_google_recaptcha && $_SESSION['intentos'] > 4) {
		$recaptcha_obligatorio = true;

		$response = null;
		$reCaptcha = new ReCaptcha($config['google_recaptcha']['secret']);
		$realIP = getRealIP();

		if (trim($_POST["g-recaptcha-response"])) {
			$response = $reCaptcha->verifyResponse(
				$realIP,
				$_POST["g-recaptcha-response"]
			);
		}
	}
	
	if ((! $plugin_google_recaptcha) || ($plugin_google_recaptcha && ! $recaptcha_obligatorio) || ($plugin_google_recaptcha && $recaptcha_obligatorio && $response != null && $response->success)) {
		
		// Comprobamos si se ha introducido la clave del usuario Administrador de la Intranet
		$result_admin = mysqli_query($db_con, "SELECT idea FROM c_profes WHERE idea = 'admin' AND pass = SHA1('$clave') LIMIT 1");
		$esAdmin = (mysqli_num_rows($result_admin) > 0) ? 1 : 0;
		mysqli_free_result($result_admin);

		// Comprobamos si se ha introducido el DNI del primer tutor legal registrado en la matrícula
		$result_tutor1 = mysqli_query($db_con, "SELECT dnitutor, primerapellidotutor, segundoapellidotutor, nombretutor FROM alma WHERE claveal = '$usuario' AND dnitutor = '$clave' LIMIT 1");
		$esTutorLegal1 = (mysqli_num_rows($result_tutor1) > 0) ? 1 : 0;
		if ($esTutorLegal1) {
			$row_tutor1 = mysqli_fetch_array($result_tutor1);
			if (! empty($row_tutor1['dnitutor']) && ! empty($row_tutor1['nombretutor'])) {
				$_SESSION['dnitutor'] = $row_tutor1['dnitutor'];
				$_SESSION['nombretutor'] = $row_tutor1['nombretutor'].' '.$row_tutor1['primerapellidotutor'].' '.$row_tutor1['segundoapellidotutor'];
			}
			else {
				$esTutorLegal1 = 0;
			}
		}

		// Comprobamos si se ha introducido el DNI del segundo tutor legal registrado en la matrícula
		$result_tutor2 = mysqli_query($db_con, "SELECT dnitutor2, primerapellidotutor2, segundoapellidotutor2, nombretutor2 FROM alma WHERE claveal = '$usuario' AND dnitutor2 = '$clave' LIMIT 1");
		$esTutorLegal2 = (mysqli_num_rows($result_tutor2) > 0) ? 1 : 0;
		if ($esTutorLegal2) {
			$row_tutor2 = mysqli_fetch_array($result_tutor2);
			if (! empty($row_tutor2['dnitutor2']) && ! empty($row_tutor2['nombretutor2'])) {
				$_SESSION['dnitutor'] = $row_tutor2['dnitutor2'];
				$_SESSION['nombretutor'] = $row_tutor2['nombretutor2'].' '.$row_tutor2['primerapellidotutor2'].' '.$row_tutor2['segundoapellidotutor2'];
			}	
			else {
				$esTutorLegal2 = 0;
			}
		}
		
		if ($esAdmin || $esTutorLegal1 || $esTutorLegal2) {
			$result = mysqli_query($db_con, "SELECT alma.claveal, alma.apellidos, alma.nombre, control.pass AS clave, alma.correo AS correo_matricula, control.correo FROM alma LEFT JOIN control ON alma.claveal = control.claveal WHERE alma.claveal='$usuario' LIMIT 1");
		}
		else {
			$result = mysqli_query($db_con, "SELECT alma.claveal, alma.apellidos, alma.nombre, control.pass AS clave, alma.correo AS correo_matricula, control.correo FROM alma LEFT JOIN control ON alma.claveal = control.claveal WHERE alma.claveal='$usuario' AND (alma.claveal='$clave' OR control.pass=SHA1('$clave')) LIMIT 1");
		}
		
		if (mysqli_num_rows($result)) {
			
			$usuario = mysqli_fetch_array($result);
			
			// Comprobamos si es la primera vez que el usuario accede
			if ((empty($usuario['clave']) && $clave == $usuario['claveal']) || sha1($clave) == $usuario['clave']) {

				// Registramos el acceso
				if (isset($_SESSION['nombretutor'])) {
					mysqli_query($db_con, "INSERT INTO reg_principal (pagina, fecha, ip, claveal, tutorlegal) VALUES ('".$_SERVER['REQUEST_URI']."', NOW(), '".$_SESSION['direccion_ip']."', '".$usuario['claveal']."', '".$_SESSION['nombretutor']."')");
				}
				else {
					mysqli_query($db_con, "INSERT INTO reg_principal (pagina, fecha, ip, claveal) VALUES ('".$_SERVER['REQUEST_URI']."', NOW(), '".$_SESSION['direccion_ip']."', '".$usuario['claveal']."')");
				}
				
				$_SESSION['alumno_autenticado'] = 1;
				$_SESSION['claveal'] = $usuario['claveal'];
				$_SESSION['cambiar_clave_alumno'] = 1;
				unset($_SESSION['intentos']);
				
				mysqli_query($db_con, "INSERT INTO control (claveal, pass, correo) VALUES ('".$usuario['claveal']."', SHA1($clave), '".$usuario['correo_matricula']."')");
				
				header("Location:".WEBCENTROS_DOMINIO."alumnado/clave.php");
				exit();
			}
			elseif (sha1($clave) == $usuario['clave'] || $esAdmin || $esTutorLegal1 || $esTutorLegal2) {

				// Registramos el acceso
				if (isset($_SESSION['nombretutor'])) {
					mysqli_query($db_con, "INSERT INTO reg_principal (pagina, fecha, ip, claveal, tutorlegal) VALUES ('".$_SERVER['REQUEST_URI']."', NOW(), '".$_SESSION['direccion_ip']."', '".$usuario['claveal']."', '".$_SESSION['nombretutor']."')");
				}
				elseif (! $esAdmin) {
					mysqli_query($db_con, "INSERT INTO reg_principal (pagina, fecha, ip, claveal) VALUES ('".$_SERVER['REQUEST_URI']."', NOW(), '".$_SESSION['direccion_ip']."', '".$usuario['claveal']."')");
				}

				$_SESSION['alumno_autenticado'] = 1;
				$_SESSION['claveal'] = $usuario['claveal'];
				$_SESSION['cambiar_clave_alumno'] = 0;
				unset($_SESSION['intentos']);
				
				header("Location:".WEBCENTROS_DOMINIO."alumnado/index.php");
				exit();
			}
			else {
				$msg_error = true;
				$msg_error_text = "NIE y/o contraseña incorrectos.";
				$_SESSION['intentos']++;
			}
			
		}
		else {
			$msg_error = true;
			$msg_error_text = "NIE y/o contraseña incorrectos.";
			$_SESSION['intentos']++;
		}
	}
	else {
		$msg_error = true;
		$msg_error_text = "Error en la comprobación reCAPTCHA. Inténtelo de nuevo.";
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
                    <form class="form" method="post" action="" autocomplete="off">
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
                                <input type="text" name="user" class="form-control" placeholder="Número de Identificación Escolar" value="<?php echo isset($_POST['user']) ? $_POST['user'] : ''; ?>" autocomplete="off">
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons objects_key-25 text-white"></i>
                                </span>
                                <input type="password" name="clave" placeholder="Contraseña" class="form-control" autocomplete="new-password">
                            </div>
							<?php if ($recaptcha_obligatorio): ?>
							 <div class="form-group text-center">
								<script src="https://www.google.com/recaptcha/api.js" async defer></script>
								<div class="g-recaptcha" data-sitekey="<?php echo $config['google_recaptcha']['site_key']; ?>" style="display: inline-block;"></div>
								<noscript>
								<div>
									<div style="width: 302px; height: 422px; position: relative;">
									<div style="width: 302px; height: 422px; position: absolute;">
										<iframe src="https://www.google.com/recaptcha/api/fallback?k=<?php echo $config['google_recaptcha']['site_key']; ?>"
												frameborder="0" scrolling="no"
												style="width: 302px; height:422px; border-style: none;">
										</iframe>
									</div>
									</div>
									<div style="width: 300px; height: 60px; border-style: none;
												bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
												background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
									<textarea id="g-recaptcha-response" name="g-recaptcha-response"
												class="g-recaptcha-response"
												style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
														margin: 10px 25px; padding: 0px; resize: none;" >
									</textarea>
									</div>
								</div>
								</noscript>
							</div>
							<?php endif; ?>
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