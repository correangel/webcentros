<?php
require_once("../../config.php");
require('../../plugins/phpmailer/PHPMailerAutoload.php');

function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
            
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        return $_SERVER['REMOTE_ADDR'];
}

if (isset($_POST['submit'])) {
    $contacto_nombre = htmlspecialchars(strip_tags(trim($_POST['nombre'])), ENT_QUOTES, 'UTF-8');
    $contacto_apellidos = htmlspecialchars(strip_tags(trim($_POST['apellidos'])), ENT_QUOTES, 'UTF-8');
	$contacto_correo = htmlspecialchars(strip_tags(trim($_POST['email'])), ENT_QUOTES, 'UTF-8');
    $contacto_mensaje = htmlspecialchars(strip_tags(trim($_POST['mensaje'])), ENT_QUOTES, 'UTF-8');
    $contacto_nombre_completo = $contacto_nombre.' '.$contacto_apellidos;
	
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
            $mail->setFrom('no-reply@'.$_SERVER['SERVER_NAME'], $config['centro_denominacion']);
            $mail->AddReplyTo($contacto_correo, $contacto_nombre_completo);
			$mail->addAddress($config['centro_email'], $config['centro_denominacion']);
			$mail->Subject = 'Nuevo mensaje - '.$config['centro_denominacion'].' (Formulario de contacto)';
			$mail->msgHTML('<p>' . $contacto_mensaje . '</p><p><br></p><p><br></p><p>Nombre: ' . $contacto_nombre . '</p><p>Correo: ' . $contacto_correo . '</p><p>Dirección IP: ' . getRealIP() . '</p><p><br></p>');
			$mail->AltBody = $contacto_mensaje . "\n\nNombre: " . $contacto_nombre_completo . "\n\nCorreo: " . $contacto_correo . "\n\nDirección IP: " . getRealIP() ."\n\n";
			$mail->send();
			
			$msg_success = true;
			
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
                Su mensaje ha sido enviado correctamente. Le responderemos tan pronto como sea posible.
            </div>

            <br>
            <?php endif; ?>

            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-2 text-center">
                            <span class="fa fa-map-marker fa-5x text-primary"></span>
                        </div>
                        <div class="col-10">
                            <div class="description">
                                <h5 class="info-title"><?php echo $config['centro_denominacion']; ?><br><small>Centro código <?php echo $config['centro_codigo']; ?></small></h5>
                                <p><?php echo $config['centro_direccion']; ?>
                                    <br> <?php echo $config['centro_codpostal']; ?>, <?php echo $config['centro_localidad']; ?> (<?php echo $config['centro_provincia']; ?>)
                                    <br> Teléfono: (+34) <?php echo $config['centro_telefono']; ?>
                                    <br> Fax: (+34) <?php echo $config['centro_fax']; ?>
                                    <br> Correo-e: <?php echo $config['centro_email']; ?>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-round pull-right">Enviar mensaje</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div id="map" style="width: 100%; height: 500px;"></div>
    
    <script>
    function initMap() {
        var myLatLng = {lat: 36.429595, lng: -5.154449};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=[YOUR_KEY]&callback=initMap"></script>
    
    <?php include("../../inc_pie.php"); ?>