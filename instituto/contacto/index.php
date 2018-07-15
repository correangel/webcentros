<?php
require_once("../../bootstrap.php");
require_once("../../config.php");
require_once('../../plugins/phpmailer/PHPMailerAutoload.php');

$plugin_google_recaptcha = false;
if (isset($config['google_recaptcha']['site_key']) && $config['google_recaptcha']['site_key'] != 'YOUR_SITE_KEY' && isset($config['google_recaptcha']['secret']) && $config['google_recaptcha']['secret'] != 'YOUR_SECRET_CODE') {
    require_once('../../plugins/recaptchalib.php');
    $plugin_google_recaptcha = true;
}

if (isset($_POST['submit'])) {
    $contacto_nombre = xss_clean(trim($_POST['nombre']));
    $contacto_apellidos = xss_clean(trim($_POST['apellidos']));
	  $contacto_correo = xss_clean(trim($_POST['email']));
    $contacto_mensaje = xss_clean(trim($_POST['mensaje']));
    $contacto_nombre_completo = $contacto_nombre.' '.$contacto_apellidos;

    if ($plugin_google_recaptcha) {
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

	if (! empty($contacto_nombre) && ! empty($contacto_apellidos) && ! empty($contacto_correo) && ! empty($contacto_mensaje)) {


		if (! filter_var($contacto_correo, FILTER_VALIDATE_EMAIL)) {
			$msg_error = true;
			$msg_error_text = "El correo electrónico no es válido.";
    }
		elseif (strlen($contacto_mensaje) > 1000) {
			$msg_error = true;
			$msg_error_text = "El mensaje supera los 1000 caracteres de longitud.";
		}
		else {

            $mail = new PHPMailer;
            $mail->setFrom('no-reply@'.$_SERVER['SERVER_NAME'], utf8_decode($config['centro_denominacion']));
            $mail->AddReplyTo($contacto_correo, utf8_decode($contacto_nombre_completo));
            $mail->addAddress($config['centro_email'], utf8_decode($config['centro_denominacion']));
            $mail->Subject = utf8_decode('Nuevo mensaje - '.$config['centro_denominacion'].' (Formulario de contacto)');
            $mail->msgHTML(utf8_decode('<p>' . $contacto_mensaje . '</p><p><br></p><p><br></p><p>Nombre: ' . $contacto_nombre_completo . '</p><p>Correo: ' . $contacto_correo . '</p><p>Dirección IP: ' . getRealIP() . '</p><p><br></p>'));
            $mail->AltBody = utf8_decode($contacto_mensaje . "\n\nNombre: " . $contacto_nombre_completo . "\n\nCorreo: " . $contacto_correo . "\n\nDirección IP: " . getRealIP() ."\n\n");

            if ($plugin_google_recaptcha) {
                if ($response != null && $response->success) {
                    $result_send = $mail->send();
                    if ($result_send) {

                        $mail_copy = new PHPMailer;
                        $mail_copy->setFrom('no-reply@'.$_SERVER['SERVER_NAME'], utf8_decode($config['centro_denominacion']));
                        $mail_copy->addAddress($contacto_correo, utf8_decode($contacto_nombre_completo));
                        $mail_copy->Subject = utf8_decode('Copia de su mensaje en la web del '.$config['centro_denominacion']);
                        $mail_copy->msgHTML(utf8_decode('<p>Hola ' . $contacto_nombre . '. </p><p>Gracias por contactar con nosotros. A continuación, le enviamos la copia del mensaje enviado a la Dirección del centro:</p><p>' . $contacto_mensaje . '</p><p><br></p><p>Le responderemos tan pronto como sea posible.</p><p>No responda a este correo electrónico. Este buzón no se supervisa y no recibirá respuesta.</p>'));
                        $mail_copy->AltBody = utf8_decode("Hola " . $contacto_nombre . ". \nGracias por contactar con nosotros. A continuación, le enviamos la copia del mensaje enviado a la Dirección del centro: \n" . $contacto_mensaje . " \n\nLe responderemos tan pronto como sea posible. \nNo responda a este correo electrónico. Este buzón no se supervisa y no recibirá respuesta.\n");
                        $result_copy_send = $mail_copy->send();

                        $msg_success = true;
                    }
                    else {
                        $msg_error = true;
				                $msg_error_text = "Error al envíar el mensaje. Inténtelo de nuevo más tarde.";
                    }
                }
                else {
                    $msg_error = true;
				            $msg_error_text = "Error en la comprobación reCAPTCHA. Inténtelo de nuevo.";
                }
            }
            else {
                $result_send = $mail->send();
                if ($result_send) {

                    $mail_copy = new PHPMailer;
                    $mail_copy->setFrom('no-reply@'.$_SERVER['SERVER_NAME'], $config['centro_denominacion']);
                    $mail_copy->addAddress($contacto_correo, $contacto_nombre_completo);
                    $mail_copy->Subject = utf8_decode('Copia de su mensaje en la web del '.$config['centro_denominacion']);
                    $mail_copy->msgHTML(utf8_decode('<p>Hola ' . $contacto_nombre . '. </p><p>Gracias por contactar con nosotros. A continuación, le enviamos la copia del mensaje enviado a la Dirección del centro:</p><p>' . $contacto_mensaje . '</p><p><br></p><p>Le responderemos tan pronto como sea posible.</p><p>No responda a este correo electrónico. Este buzón no se supervisa y no recibirá respuesta.</p>'));
                    $mail_copy->AltBody = utf8_decode("Hola " . $contacto_nombre . ". \nGracias por contactar con nosotros. A continuación, le enviamos la copia del mensaje enviado a la Dirección del centro: \n" . $contacto_mensaje . " \n\nLe responderemos tan pronto como sea posible.\nNo responda a este correo electrónico. Este buzón no se supervisa y no recibirá respuesta.\n");
                    $result_copy_send = $mail_copy->send();

                    $msg_success = true;
                }
                else {
                    $msg_error = true;
                    $msg_error_text = "Error al envíar el mensaje. Inténtelo de nuevo más tarde.";
                }
            }

		}
	}
	else {
		$msg_error = true;
		$msg_error_text = "Todos los campos son obligatorios.";
	}
}

$pagina['titulo'] = 'Información y contacto';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Información de contacto. Número de téléfono, FAX y correo electrónico del ".$config['centro_denominacion'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <?php if (isset($msg_error) && $msg_error): ?>
            <div class="alert alert-danger">
                <strong>Error:</strong> <?php echo $msg_error_text; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($msg_success) && $msg_success): ?>
            <div class="alert alert-success">
                Su mensaje ha sido enviado correctamente. Le hemos enviado una copia del mensaje a su correo electrónico. Le responderemos tan pronto como sea posible.
            </div>

            <br>
            <?php endif; ?>

            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-2 text-center">
                            <span class="fas fa-map-marker-alt fa-5x text-primary"></span>
                        </div>
                        <div class="col-10">
                            <div class="description">
                                <h5 class="info-title"><?php echo $config['centro_denominacion']; ?><br><small>Centro código <?php echo $config['centro_codigo']; ?></small></h5>
                                <p><?php echo $config['centro_direccion']; ?>
                                    <br> <?php echo $config['centro_codpostal']; ?>, <?php echo $config['centro_localidad']; ?> (<?php echo $config['centro_provincia']; ?>)
                                    <br> Teléfono: (+34) <?php echo $config['centro_telefono']; ?>
                                    <br> Fax: (+34) <?php echo $config['centro_fax']; ?>
                                    <br> Correo-e: <?php echo ofuscarEmail($config['centro_email']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-6 pr-2">
                                    <label>Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="now-ui-icons users_circle-08"></i>
                                        </span>
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-2">
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="now-ui-icons text_caps-small"></i>
                                            </span>
                                            <input type="text" name="apellidos" placeholder="Apellidos" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="now-ui-icons ui-1_email-85"></i>
                                    </span>
                                    <input type="email" name="email" placeholder="Correo electrónico" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mensaje</label>
                                <textarea name="mensaje" class="form-control" id="message" rows="6" placeholder="Mensaje" maxlenght="1000"></textarea>
                            </div>

                            <?php if ($plugin_google_recaptcha): ?>

                            <div class="row">
                                <div class="col-md-8">
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
                                            <div style="width: 300px; height: 60px; border-style: none; bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px; background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
                                            <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;">
                                            </textarea>
                                            </div>
                                        </div>
                                        </noscript>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-round pull-right">Enviar mensaje</button>
                                </div>
                            </div>

                            <?php else: ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-round pull-right">Enviar mensaje</button>
                                </div>
                            </div>

                            <?php endif; ?>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php if (isset($config['google_maps']['api_key']) && $config['google_maps']['api_key'] != 'YOUR_API_CODE' && isset($config['google_maps']['latitud']) && isset($config['google_maps']['longitud'])): ?>
    <div id="map" style="width: 100%; height: 500px;"></div>

    <script>
    function initMap() {
        var myLatLng = {lat: <?php echo $config['google_maps']['latitud']; ?>, lng: <?php echo $config['google_maps']['longitud']; ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: <?php echo (isset($config['google_maps']['zoom'])) ? $config['google_maps']['zoom'] : 15; ?>,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: '<?php echo $config['centro_denominacion']; ?>',
            icon: '<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/pin.png',
        });
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['google_maps']['api_key']; ?>&callback=initMap"></script>
    <?php endif; ?>

    <?php include("../../inc_pie.php"); ?>
