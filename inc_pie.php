<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed'); ?>

    <div class="section section-resources bg-clouds">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="https://www.mecd.gob.es/portada-mecd/" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/png-icons/mefp.png" class="pad10" alt="">
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="https://www.mecd.gob.es/educacion/mc/fse/fse.html" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/png-icons/fse.png" class="pad10" alt="">
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.juntadeandalucia.es/educacion/cga/portal/" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/png-icons/cga.png" class="pad10" alt="">
                    </a>
                </div>
                 <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="https://www.juntadeandalucia.es/educacion/portalaverroes/portada" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/png-icons/averroes.png" class="pad10" alt="">
                    </a>
                </div>
                 <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.juntadeandalucia.es/educacion/portals/web/buenas-practicas-educativas" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/png-icons/bpe.png" class="pad10" alt="">
                    </a>
                </div>
                 <div class="col-sm-6 col-md-4 col-lg-2 text-center">
                    <a href="http://www.formajoven.org" target="_blank">
                        <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/png-icons/formajoven.png" class="pad10" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <nav>
                <ul>
                    <li><a href="<?php echo WEBCENTROS_DOMINIO; ?>aviso-legal">Aviso legal y Política de Cookies</a></li>
                </ul>
            </nav>
            <div class="copyright">
                © <?php echo date('Y'); ?>, <?php echo $config['centro_denominacion']; ?>
            </div>
        </div>
    </footer>

    </div><!-- ./wrapper -->

    <!-- Core JS Files -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Plugin for Cookie Consent, full documentation here: https://cookieconsent.insites.com -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/plugins/bootstrap-switch.js"></script>
    <!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!-- Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/now-ui-kit.js" type="text/javascript"></script>
    <?php if (((date('d') >= 17 && date('m') == 12) || (date('d') <= 6 && date('m') == 1)) && stristr($_SERVER['REQUEST_URI'], '/alumnado') == false ): ?>
    <script src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/js/snowfall.jquery.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
        $(document).snowfall({
            deviceorientation: false,
            round: true,
            minSize: 1,
            maxSize:8,
            flakeColor: '#f6f6f6',
            flakeCount: 250
        });
    });
    </script>
    <?php endif; ?>
    <?php if (stristr($_SERVER['REQUEST_URI'], '/alumnado/login.php') == true): ?>
    <script>
    $(document).ready(function(){
        // Deshabilitamos el botón
        $("button[type=submit]").attr("disabled", "disabled");

        // Cuando se presione una tecla en un input del formulario
        // realizamos la validación
        $('input').keyup(function(){
                // Validamos el formulario
                var validated = true;
                if($('#user').val().length < 6) validated = false;
                if($('#clave').val().length < 6) validated = false;

        // Si el formulario es válido habilitamos el botón, en otro caso
        // lo volvemos a deshabilitar
        if(validated) $("button[type=submit]").removeAttr("disabled");
        else $("button[type=submit]").attr("disabled", "disabled");

        });

        $('input:first').trigger('keyup');
    });
    </script>
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js" type="text/javascript"></script>
    <script>
    $(".carousel").swipe({

      swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

        if (direction == 'left') $(this).carousel('next');
        if (direction == 'right') $(this).carousel('prev');
        if (direction == null){
          var currentItem = $("#carousel .carousel-item.active");
          window.open(currentItem.data('href'));
        }

      },
      threshold: 0,
      allowPageScroll: "vertical",
    });
    </script>

</body>
</html>
