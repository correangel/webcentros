<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed'); ?>

    <div class="section section-resources bg-clouds">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.juntadeandalucia.es/educacion/portalseneca/web/seneca/inicio" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/seneca.png" class="pad10" alt="">
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="https://www.juntadeandalucia.es/educacion/portalseneca/web/pasen/inicio" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/pasen.png" class="pad10" alt="">
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.juntadeandalucia.es/educacion/cga/portal/" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/cga.png" class="pad10" alt="">
                    </a>
                </div>
                 <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="https://www.juntadeandalucia.es/educacion/portalaverroes/portada" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/averroes.png" class="pad10" alt="">
                    </a>
                </div>
                 <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.juntadeandalucia.es/averroes/centros-tic/<?php echo $config['centro_codigo']; ?>/moodle2/" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/moodle.png" class="pad10" alt="">
                    </a>
                </div>
                 <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.formajoven.org" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/formajoven.png" class="pad10" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <nav>
                <ul>
                    <li><a href="<?php echo WEBCENTROS_DOMINIO; ?>aviso-legal">Aviso legal</a></li>
                </ul>
            </nav>
            <div class="copyright">
                © <?php echo date('Y'); ?>, <?php echo $config['centro_denominacion']; ?>
            </div>
        </div>
    </footer>

    </div><!-- ./wrapper -->

     <!-- BLOQUE COOKIES -->
     <div id="barraCookies" style="display: none;">
        <div class="inner">
            <a href="javascript:void(0);" class="btn btn-primary btn-sm float-right" onclick="permitirCookie();">&times;</a>
            <p class="pad10">Usamos cookies para personalizar su experiencia. Si continúa navegando consideramos que acepta el uso de cookies. <a class="text-white" href="<?php echo WEBCENTROS_DOMINIO; ?>aviso-legal" target="_blank"><strong>Más información</strong></a></p>
        </div>
    </div>
    <!-- FIN BLOQUE COOKIES -->

    <!-- Core JS Files -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/plugins/bootstrap-switch.js"></script>
    <!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!-- Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/now-ui-kit.js" type="text/javascript"></script>

</body>
</html>