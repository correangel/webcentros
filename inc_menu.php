<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <?php if (isset($config['color_primario']) && cmykcolor($config['color_primario'])): ?>
    <meta name="theme-color" content="<?php echo cmykcolor($config['color_primario'], 'hex'); ?>">
    <meta name="msapplication-navbutton-color" content="<?php echo cmykcolor($config['color_primario'], 'hex'); ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo cmykcolor($config['color_primario'], 'hex'); ?>">
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/favicon.ico">

    <title><?php echo (isset($pagina['titulo']) && $pagina['titulo'] != '') ? strip_tags($pagina['titulo'])." - ".$config['centro_denominacion'] : $config['centro_denominacion']; ?> - Instituto de Educación Secundaria de <?php echo $config['centro_localidad']; ?></title>
    <?php $canonical_str = rtrim(str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']), '?'); ?>
    <?php if (! isset($pagina['meta']['canonical']) || $pagina['meta']['canonical'] = 0): ?>
    <link rel="canonical" href="<?php echo WEBCENTROS_DOMINIO.ltrim($canonical_str, '/'); ?>">
    <?php endif; ?>

    <?php if (! isset($pagina['meta']['robots']) || (isset($pagina['meta']['robots']) && $pagina['meta']['robots'] == 1)): ?>
    <!-- SEO -->
    <meta name="robots" content="index, follow">

    <?php if (isset($pagina['meta']['meta_autor'])): ?><meta name="author" content="<?php echo $pagina['meta']['meta_autor']; ?>"><?php endif; ?>
    <meta name="description" content="<?php echo $pagina['meta']['meta_description']; ?>">

    <meta itemprop="name" content="<?php echo $pagina['meta']['meta_title']; ?>">
    <meta itemprop="description" content="<?php echo $pagina['meta']['meta_description']; ?>">

    <meta property="og:title" content="<?php echo $pagina['meta']['meta_title']; ?>">
    <?php if (isset($pagina['meta']['meta_autor'])): ?>
    <meta property="og:author" content="<?php echo $pagina['meta']['meta_autor']; ?>">
    <?php endif; ?>
    <meta property="og:description" content="<?php echo $pagina['meta']['meta_description']; ?>">
    <meta property="og:type" content="<?php echo $pagina['meta']['meta_type']; ?>">
    <meta property="og:locale" content="<?php echo $pagina['meta']['meta_locale']; ?>">
    <meta property="og:site_name" content="<?php echo $config['centro_denominacion']; ?>">

    <meta property="og:url" content="<?php echo WEBCENTROS_DOMINIO.ltrim($canonical_str , '/'); ?>">

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo $pagina['meta']['meta_description']; ?>">
    <meta name="twitter:title" content="<?php echo $pagina['meta']['meta_title']; ?>">

    <?php else: ?>
    <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//stackpath.bootstrapcdn.com">
    <link rel="dns-prefetch" href="//code.jquery.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/css/now-ui-kit.css" rel="stylesheet" />
    <link href="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/css/my-style.css" rel="stylesheet" />
    <link href="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/css/personalize.css" rel="stylesheet" />

    <?php if (isset($_COOKIE["cookieconsent_status"]) && $_COOKIE["cookieconsent_status"] == "allow"): ?>
    <?php if ((! isset($pagina['meta']['robots']) || (isset($pagina['meta']['robots']) && $pagina['meta']['robots'] == 1)) && (isset($config['google_analytics']['tracking_id']) && ! empty($config['google_analytics']['tracking_id']))): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $config['google_analytics']['tracking_id']; ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo $config['google_analytics']['tracking_id']; ?>');
    </script>
    <?php endif; ?>
    <?php endif; ?>

    <?php if (isset($config['fondo_patron']) && intval($config['fondo_patron'])): ?>
    <style type="text/css">
    .my-header { background-image: url('<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/presets/bg<?php echo $config['fondo_patron']; ?>.png'); }
    </style>
    <?php endif; ?>
    <?php if (isset($config['color_primario']) && cmykcolor($config['color_primario'])): ?>
    <style type="text/css">
    .text-primary { color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?> !important; }
    .bg-primary { background-color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?> !important; }
    .border-primary { border-color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?> !important; }
    a, a:hover, a:focus, a:active { color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>; }
    a:hover { color: <?php echo cmykcolor($config['color_primario'], 'rgb', 'dark'); ?>; }
    a.text-primary, a:focus.text-primary, a:active.text-primary { color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?> !important; }
    a:hover.text-primary { color: <?php echo cmykcolor($config['color_primario'], 'rgb', 'dark'); ?> !important; }
    .btn-primary { background-color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?> !important; }
    .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover { background-color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?> !important; }
    .form-control:focus { border: 1px solid <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>; }
    .form-control:focus+.input-group-addon, .form-control:focus~.input-group-addon { border: 1px solid <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>; }
    .input-group-focus .input-group-addon { border-color: <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>; }
    .page-header[filter-data="login"] {
      background: rgba(44, 44, 44, 0.2);
      background: -webkit-linear-gradient(90deg, rgba(44, 44, 44, 0.2), <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>);
      background: -o-linear-gradient(90deg, rgba(44, 44, 44, 0.2), <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>);
      background: -moz-linear-gradient(90deg, rgba(44, 44, 44, 0.2), <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>);
      background: linear-gradient(0deg, rgba(44, 44, 44, 0.2), <?php echo cmykcolor($config['color_primario'], 'rgb'); ?>);
    }
    </style>
    <?php endif; ?>
</head>

<body class="index-page sidebar-collapse">
    <?php if (! navegadorSoportado()): ?>
    <div id="old-navigator" class="alert alert-warning alert-dismissible fade show" role="alert" style="position: fixed; top: 0; right: 0; left: 0; z-index: 1040; margin: 0; background-color: #FFF9C4; border-bottom: 2px solid #FFEE58; color: #333;">
      <div class="container">
        <h5 class="alert-heading">Su navegador no está soportado</h5>
        <p class="">Para acceder a esta web, le recomendamos usar la última versión de Mozilla Firefox, Google Chrome, Safari o Internet Explorer.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 2em; line-height: 20px; color: #666; opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <?php endif; ?>
    <nav class="fixed-top">
        <div class="navbar-lg d-none d-sm-none d-md-none d-lg-block">
          <div class="container">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <a class="navbar-brand-lg text-primary" href="<?php echo WEBCENTROS_DOMINIO; ?>">
                  <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/logo.png" height="80" class="d-inline-block" alt="">
                  <?php echo $config['centro_denominacion']; ?>
                </a>
                <?php if ((date('m') == 10 && date('d') >= 22) || (date('m') == 11 && date('d') <= 2)): ?>
                <?php include(WEBCENTROS_DIRECTORY . "/plugins/festivos/todoslossantos.php"); ?>
                <?php endif; ?>
              </div>

              <div class="p-2 text-muted" style="font-size: 1rem;">
                <i class="fas fa-phone fa-lg fa-fw fa-rotate-90"></i> <?php echo formatoTelefono($config['centro_telefono']); ?><?php echo (isset($config['centro_fax']) && $config['centro_fax']) ? ' - Fax: ' . formatoTelefono($config['centro_fax']) : ''; ?><br>
                <i class="fas fa-envelope fa-lg fa-fw"></i> <?php echo ofuscarEmail($config['centro_email']); ?>
              </div>
            </div>
          </div>
        </div>

        <div class="navbar navbar-expand-lg bg-primary">

          <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand d-block d-md-block d-lg-none" href="<?php echo WEBCENTROS_DOMINIO; ?>">
                    <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/logo.png" width="30" height="30" class="d-inline-block" alt="">
                    <?php echo $config['centro_denominacion']; ?>
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="menuInstituto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Instituto
                      </a>
                      <div class="dropdown-menu" aria-labelledby="menuInstituto">
                          <h6 class="dropdown-header">Organización</h6>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/equipo-directivo">Equipo directivo</a>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/departamentos">Departamentos</a>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/tutorias">Tutorías</a>
                          <?php if (isset($config['web_ampa']) && ! empty($config['web_ampa'])): ?>
                          <?php $pos = strpos($config['web_ampa'], WEBCENTROS_DOMINIO); ?>
                          <?php $_target = ($pos !== false) ? 0 : 1; ?>
                          <a class="dropdown-item" href="<?php echo $config['web_ampa']; ?>"<?php echo ($_target) ? ' target="_blank"' : ''; ?>>Asoc. de Madres y Padres</a>
                          <?php unset($pos); ?>
                          <?php unset($_target); ?>
                          <?php endif; ?>
                          <div class="dropdown-divider"></div>
                          <h6 class="dropdown-header">Información académica</h6>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/calendario">Calendario escolar</a>
                          <?php if (isset($config['libros_texto']) && $config['libros_texto']): ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/libros-texto">Libros de texto</a>
                          <?php endif; ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/actividades-extraescolares">Actividades extraescolares</a>
                          <?php if (isset($config['web_imagenes']) && ! empty($config['web_imagenes'])): ?>
                          <?php $pos = strpos($config['web_imagenes'], WEBCENTROS_DOMINIO); ?>
                          <?php $_target = ($pos !== false) ? 0 : 1; ?>
                          <a class="dropdown-item" href="<?php echo $config['web_imagenes']; ?>"<?php echo ($_target) ? ' target="_blank"' : ''; ?>>Imágenes y reportajes</a>
                          <?php unset($pos); ?>
                          <?php unset($_target); ?>
                          <?php endif; ?>
                          <?php if (isset($config['plan_centro']) && ! empty($config['plan_centro'])): ?>
                          <?php $pos = strpos($config['plan_centro'], WEBCENTROS_DOMINIO); ?>
                          <?php $_target = ($pos !== false) ? 0 : 1; ?>
                          <a class="dropdown-item" href="<?php echo $config['plan_centro']; ?>"<?php echo ($_target) ? ' target="_blank"' : ''; ?>>Plan de Centro</a>
                          <?php unset($pos); ?>
                          <?php unset($_target); ?>
                          <?php endif; ?>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="menuOfertaEducativa" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Oferta educativa
                      </a>
                      <div class="dropdown-menu" aria-labelledby="menuOfertaEducativa">
                          <h6 class="dropdown-header">Educación Obligatoria</h6>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/educacion-secundaria-obligatoria">Educación Secundaria Obligatoria</a>
                          <?php if (isset($config['educacion_bachiller']) && $config['educacion_bachiller']): ?>
                          <div class="dropdown-divider"></div>
                          <h6 class="dropdown-header">Bachillerato</h6>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/bachillerato">Bachillerato</a>
                          <?php endif; ?>
                          <?php if (isset($config['educacion_permanente']) && $config['educacion_permanente']): ?>
                          <div class="dropdown-divider"></div>
                          <h6 class="dropdown-header">Educación Permanente</h6>
                          <?php if (isset($config['educacion_permanente']['espa']) && $config['educacion_permanente']['espa']): ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/educacion-permanente/eso">Educación Secundaria para Personas Adultas (ESPA)</a>
                          <?php endif; ?>
                            <?php if (isset($config['educacion_permanente']['bachillerato']) && $config['educacion_permanente']['bachillerato']): ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/educacion-permanente/bachillerato">Bachillerato para Personas Adultas (BTOPA)</a>
                          <?php endif; ?>
                          <?php endif; ?>
                          <?php if (isset($config['educacion_cfgb']) && count($config['educacion_cfgb'])): ?>
                          <div class="dropdown-divider"></div>
                          <h6 class="dropdown-header">Formación Profesional Básica</h6>
                          <?php foreach ($config['educacion_cfgb'] as $cfgb): ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/formacion-profesional/<?php echo $cfgb['alias']; ?>"><?php echo $cfgb['nombre']; ?></a>
                          <?php endforeach; ?>
                          <?php endif; ?>
                          <?php if (isset($config['educacion_cfgm']) && count($config['educacion_cfgm'])): ?>
                          <div class="dropdown-divider"></div>
                          <h6 class="dropdown-header">Formación Profesional Inicial de Grado Medio</h6>
                          <?php foreach ($config['educacion_cfgm'] as $cfgm): ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/formacion-profesional/<?php echo $cfgm['alias']; ?>"><?php echo $cfgm['nombre']; ?></a>
                          <?php endforeach; ?>
                          <?php endif; ?>
                          <?php if (isset($config['educacion_cfgs']) && count($config['educacion_cfgs'])): ?>
                          <div class="dropdown-divider"></div>
                          <h6 class="dropdown-header">Formación Profesional Inicial de Grado Superior</h6>
                          <?php foreach ($config['educacion_cfgs'] as $cfgs): ?>
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>oferta-educativa/formacion-profesional/<?php echo $cfgs['alias']; ?>"><?php echo $cfgs['nombre']; ?></a>
                          <?php endforeach; ?>
                          <?php endif; ?>
                      </div>
                  </li>
                  <?php if (isset($config['mod_documentos']) && $config['mod_documentos']): ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo WEBCENTROS_DOMINIO; ?>documentos">Documentos</a>
                  </li>
                  <?php endif; ?>
                  <?php if (isset($config['web_biblioteca']) && ! empty($config['web_biblioteca'])): ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo $config['web_biblioteca']; ?>" target="_blank">Biblioteca</a>
                  </li>
                  <?php endif; ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo WEBCENTROS_DOMINIO; ?>alumnado">Alumnado</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo WEBCENTROS_DOMINIO; ?>intranet" target="_blank">Intranet</a>
                  </li>
              </ul>
              <ul class="navbar-nav">
                  <?php if (isset($_SESSION['alumno_autenticado']) && $_SESSION['alumno_autenticado']): ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="far fa-user-circle fa-lg fa-fw"></i> <?php echo $_SESSION['alumno']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="menuUsuario">
                      <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>alumnado/index.php">Expediente académico</a>
                      <?php if (! isset($_SESSION['dnitutor'])): ?>
                      <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>alumnado/clave.php">Cambiar contraseña</a>
                      <?php endif; ?>
                      <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>alumnado/logout.php">Cerrar sesión</a>
                    </div>
                  </li>
                  <?php endif; ?>
                  <li class="nav-item active">
                      <a class="nav-link" href="<?php echo WEBCENTROS_DOMINIO; ?>contacto">
                          <i class="now-ui-icons travel_info"></i>
                          <p>Te informamos</p>
                      </a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>

    <div class="wrapper">

    <?php if (! empty($pagina['titulo'])): ?>
    <div class="my-header">
        <div class="container">
            <h2 class="title"><?php echo $pagina['titulo']; ?></h2>
        </div>
    </div>
    <?php endif; ?>
