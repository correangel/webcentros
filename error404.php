<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed');
header('HTTP/1.0 404 Not Found', true, 404);

$pagina['titulo'] = 'No se ha encontrado la página';
include("inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-8 text-center">

                    <br>
                    <span class="fa fa-meh-o fa-4x"></span>
                    <h3>¡Lo sentimos!</h3>

                    <p class="lead">La página que buscas no existe.<br>Quizá has escrito mal la dirección o nosotros hemos eliminado la página.</p>
                    
                    <br>

                    <a href="javascript:history.go(-1);" class="btn btn-primary btn-lg">Volver</a>
                    <br><br>

                </div>

            </div>
        </div>
    </div>

    <?php include("inc_pie.php"); ?>
<?php exit; ?>