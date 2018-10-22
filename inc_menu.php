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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
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
    <nav class="fixed-top">
        <div class="navbar-lg d-none d-sm-none d-md-none d-lg-block">
          <div class="container">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <a class="navbar-brand-lg text-primary" href="<?php echo WEBCENTROS_DOMINIO; ?>">
                  <img src="<?php echo WEBCENTROS_DOMINIO; ?>ui-theme/img/logo.png" height="80" class="d-inline-block" alt="">
                  <?php echo $config['centro_denominacion']; ?>
                </a>
                <?php if ((date('m') == 10 && date('d') >= 22) || (date('m') == 11 && date('d') <= 10)): ?>
                <style>
                div.animation1{-webkit-animation-name:animation1;-webkit-animation-duration:4s;-webkit-animation-iteration-count:infinite;animation-name:animation1;animation-duration:4s;animation-iteration-count:infinite}@-webkit-keyframes animation1{0%{-webkit-transform:translateY(0px)}50%{-webkit-transform:translateY(-5px)}100%{-webkit-transform:translateY(0px)}}@keyframes animation1{0%{transform:translateY(0px)}50%{transform:translateY(-5px)}100%{transform:translateY(0px)}}div.animation2{-webkit-animation-name:animation2;-webkit-animation-duration:4s;-webkit-animation-iteration-count:infinite;animation-name:animation2;animation-duration:4s;animation-iteration-count:infinite}@-webkit-keyframes animation2{0%{-webkit-transform:translateX(0px)}50%{-webkit-transform:translateX(-5px)}100%{-webkit-transform:translateX(0px)}}@keyframes animation2{0%{transform:translateX(0px)}50%{transform:translateX(-5px)}100%{transform:translateX(0px)}}
                </style>
                <div class="d-lg-none d-xl-block" style="position: absolute; top: 53px; margin-left: -100px; width: 60px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-trees fa-w-20 fa-3x">
                    <g class="text-muted">
                      <path fill="currentColor" d="M298.42 288h30.63c9.01 0 16.98-5 20.78-13.06 3.8-8.04 2.55-17.26-3.28-24.05L268.42 160h28.89c9.1 0 17.3-5.35 20.86-13.61 3.52-8.13 1.86-17.59-4.24-24.08L203.66 4.83c-6.03-6.45-17.28-6.45-23.32 0L70.06 122.31c-6.1 6.49-7.75 15.95-4.24 24.08C69.39 154.65 77.59 160 86.69 160h28.89l-78.14 90.91c-5.81 6.78-7.06 15.99-3.27 24.04C37.97 283 45.93 288 54.95 288h30.63L5.69 378.49c-6 6.79-7.36 16.09-3.56 24.26 3.75 8.05 12 13.25 21.01 13.25H160v24.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L224 440.45V416h136.87c9.01 0 17.26-5.2 21.01-13.25 3.8-8.17 2.44-17.47-3.56-24.26L298.42 288zm335.89 90.49L554.42 288h30.63c9.01 0 16.98-5 20.78-13.06 3.8-8.04 2.55-17.26-3.28-24.05L524.42 160h28.89c9.1 0 17.3-5.35 20.86-13.61 3.52-8.13 1.86-17.59-4.24-24.08L459.66 4.83c-6.03-6.45-17.28-6.45-23.32 0l-95.06 101.26c11.09 15.37 13.97 35.3 6.34 52.96-4 9.27-10.38 17.03-18.26 22.68l41.54 48.32c13.93 16.25 17.04 39.23 7.94 58.52-4.19 8.89-10.46 16.24-18.11 21.58l41.62 47.15c8.65 9.8 13.34 14.15 13.65 26.69v56.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L480 440.45V416h136.87c9.01 0 17.26-5.2 21.01-13.25 3.79-8.17 2.43-17.47-3.57-24.26z" class=""></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 73px; margin-left: 150px; width: 33px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576.34 512">
                    <g class="orange" transform="translate(0 0)">
                      <path fill="currentColor" d="M352 113.21v-77.4c0-6.06-3.42-11.6-8.84-14.31l-39.6-19.8c-8.37-4.19-18.54-.32-22.01 8.37L244 103.93C257.27 99.2 271.57 96 288 96c25.16 0 46.23 6.12 64 17.21zm143.3 39.92c-31.61-27.03-78.8-31.69-116.51-15.05 3.07 3.97 6.52 7.38 9.21 11.92 8.32 14.27 14.5 31.78 19.11 51.62-3.69-8.81-7.96-16.87-12.86-24.12-22.67-33-58.08-49.5-106.25-49.5s-83.58 16.5-106.25 49.5c-4.9 7.25-9.17 15.3-12.86 24.11 4.61-19.84 10.78-37.34 19.11-51.61 2.69-4.54 6.13-7.95 9.21-11.92-37.71-16.64-84.9-11.98-116.51 15.05-107.6 92.01-107.6 241.72 0 333.74 38.63 33.03 100.82 33.34 140.12 1.25C238.65 503.51 260.72 512 288 512s49.35-8.49 67.19-23.88c39.3 32.09 101.49 31.78 140.12-1.25 107.59-92.01 107.59-241.73-.01-333.74z"></path>
                    </g>
                    <g style="color: #ffec99;" transform="translate(100 0)">
                      <path fill="currentColor" d="M215.48,281l41.15-66.67c2.33-4.57,8.6-4.42,12,0L309.78,281c1.66,3.25,0.9,10-6,10h-82.29 C214.58,291,213.79,284.31,215.48,281z M55.48,281l41.15-66.67c2.33-4.57,8.6-4.42,12,0L149.78,281c1.66,3.25,0.9,10-6,10H61.48 C54.58,291,53.79,284.31,55.48,281z M364.43,348.6c-5.96,17.04-12.75,28.62-18.7,36.96c-9.38,12.94-21.34,23.8-35.19,32.99 c-0.25-8.62-7.23-15.55-15.91-15.55h-16c-8.84,0-16,7.16-16,16v21.48c-23.46,6.88-50.16,10.52-79.98,10.52 c-29.85,0-56.56-3.65-80.02-10.51V419c0-8.84-7.16-16-16-16h-16c-8.7,0-15.71,6.97-15.92,15.63c-13.71-9.08-25.53-19.79-34.75-32.51 c-6.12-8.59-13.02-20.31-19.04-37.46c-4.87-13.89,10.56-26.15,23.24-18.67c32.94,19.44,70.39,32.74,110.47,38.84V387 c0,8.84,7.16,16,16,16h16c8.84,0,16-7.16,16-16v-14.26c0.01,0,0.01,0,0.02,0c58.38,0,112.72-15.74,158.54-42.79 C353.85,322.47,369.28,334.72,364.43,348.6z"></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 61px; margin-left: 400px; width: 50px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="text-muted">
                      <path fill="currentColor" d="M378.31 378.49L298.42 288h30.63c9.01 0 16.98-5 20.78-13.06 3.8-8.04 2.55-17.26-3.28-24.05L268.42 160h28.89c9.1 0 17.3-5.35 20.86-13.61 3.52-8.13 1.86-17.59-4.24-24.08L203.66 4.83c-6.03-6.45-17.28-6.45-23.32 0L70.06 122.31c-6.1 6.49-7.75 15.95-4.24 24.08C69.38 154.65 77.59 160 86.69 160h28.89l-78.14 90.91c-5.81 6.78-7.06 15.99-3.27 24.04C37.97 283 45.93 288 54.95 288h30.63L5.69 378.49c-6 6.79-7.36 16.09-3.56 24.26 3.75 8.05 12 13.25 21.01 13.25H160v24.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L224 440.45V416h136.86c9.01 0 17.26-5.2 21.01-13.25 3.8-8.17 2.44-17.47-3.56-24.26z" class=""></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 53px; margin-left: 490px; width: 60px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="text-muted">
                      <path fill="currentColor" d="M496 235c-10.67-16-25-27.67-43-35h1c8.67-16 11.83-32.5 9.5-49.5s-9.17-31.67-20.5-44S417.83 86 401.5 82s-32.83-2.33-49.5 5c-2.67-24.67-13.17-45.33-31.5-62S280.67 0 256 0s-46.17 8.33-64.5 25-28.83 37.33-31.5 62c-16.67-7.33-33.17-9-49.5-5S80.33 94.17 69 106.5s-18.17 27-20.5 44S49.67 184 59 200c-18 7.33-32.33 19-43 35S0 268.67 0 288c0 26.67 9.33 49.33 28 68s41.33 28 68 28h128v56.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L288 440.45V384h128c26.67 0 49.33-9.33 68-28s28-41.33 28-68c0-19.33-5.33-37-16-53z"></path>
                    </g>
                  </svg>
                </div>
                <div class="animation2" style="position: absolute; top: 10px; margin-left: 450px; width: 35px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="black">
                      <path fill="currentColor" d="M558.44 129.7c-7.64-17.82-29.25-24.81-45.88-14.83L411.83 175.3 384 64l-42.67 32h-42.67L256 64l-27.83 111.3-100.74-60.44c-16.63-9.98-38.24-2.99-45.88 14.83L0 320l49.62-16.54c27.38-9.13 57.48 1.2 73.49 25.21L160 384l11.82-11.82c27.54-27.54 73.09-24.3 96.46 6.85L320 448l51.72-68.97c23.37-31.16 68.91-34.39 96.46-6.85L480 384l36.88-55.33c16.01-24.01 46.11-34.34 73.49-25.21L640 320l-81.56-190.3z"></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 55px; margin-left: 565px; width: 30px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="black">
                      <path fill="currentColor" d="M544 32h-16.36C513.04 12.68 490.09 0 464 0c-44.18 0-80 35.82-80 80v20.98L12.09 393.57A30.216 30.216 0 0 0 0 417.74c0 22.46 23.64 37.07 43.73 27.03L165.27 384h96.49l44.41 120.1c2.27 6.23 9.15 9.44 15.38 7.17l22.55-8.21c6.23-2.27 9.44-9.15 7.17-15.38L312.94 384H352c1.91 0 3.76-.23 5.66-.29l44.51 120.38c2.27 6.23 9.15 9.44 15.38 7.17l22.55-8.21c6.23-2.27 9.44-9.15 7.17-15.38l-41.24-111.53C485.74 352.8 544 279.26 544 192v-80l96-16c0-35.35-42.98-64-96-64zm-80 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z"></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 77px; margin-left: 570px; width: 30px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="black">
                      <path fill="currentColor" d="M496 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h480c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zm-48-256C448 85.96 362.04 0 256 0S64 85.96 64 192v224h384V192z"></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 77px; margin-left: 610px; width: 30px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="black">
                      <path fill="currentColor" d="M496 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h480c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zm-48-256C448 85.96 362.04 0 256 0S64 85.96 64 192v224h384V192zm-96-8c0 8.84-7.16 16-16 16h-56v128c0 8.84-7.16 16-16 16h-16c-8.84 0-16-7.16-16-16V200h-56c-8.84 0-16-7.16-16-16v-16c0-8.84 7.16-16 16-16h56v-48c0-8.84 7.16-16 16-16h16c8.84 0 16 7.16 16 16v48h56c8.84 0 16 7.16 16 16v16z"></path>
                    </g>
                  </svg>
                </div>
                <div class="d-lg-none d-xl-block animation1" style="color: #adb5bd; position: absolute; top: 45px; margin-left: 650px; width: 40px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g>
                      <path fill="currentColor" d="M186.1.09C81.01 3.24 0 94.92 0 200.05v263.92c0 14.26 17.23 21.39 27.31 11.31l24.92-18.53c6.66-4.95 16-3.99 21.51 2.21l42.95 48.35c6.25 6.25 16.38 6.25 22.63 0l40.72-45.85c6.37-7.17 17.56-7.17 23.92 0l40.72 45.85c6.25 6.25 16.38 6.25 22.63 0l42.95-48.35c5.51-6.2 14.85-7.17 21.51-2.21l24.92 18.53c10.08 10.08 27.31 2.94 27.31-11.31V192C384 84 294.83-3.17 186.1.09zM128 224c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm128 0c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"></path>
                    </g>
                  </svg>
                </div>
                <div class="d-lg-none d-xl-block" style="position: absolute; top: 53px; margin-left: 700px; width: 60px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="text-muted">
                      <path fill="currentColor" d="M496 235c-10.67-16-25-27.67-43-35h1c8.67-16 11.83-32.5 9.5-49.5s-9.17-31.67-20.5-44S417.83 86 401.5 82s-32.83-2.33-49.5 5c-2.67-24.67-13.17-45.33-31.5-62S280.67 0 256 0s-46.17 8.33-64.5 25-28.83 37.33-31.5 62c-16.67-7.33-33.17-9-49.5-5S80.33 94.17 69 106.5s-18.17 27-20.5 44S49.67 184 59 200c-18 7.33-32.33 19-43 35S0 268.67 0 288c0 26.67 9.33 49.33 28 68s41.33 28 68 28h128v56.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L288 440.45V384h128c26.67 0 49.33-9.33 68-28s28-41.33 28-68c0-19.33-5.33-37-16-53z"></path>
                    </g>
                  </svg>
                </div>
                <div style="position: absolute; top: 79px; margin-left: 860px; width: 26px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="black">
                      <path fill="currentColor" d="M496 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h480c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zm-48-256C448 85.96 362.04 0 256 0S64 85.96 64 192v224h384V192zm-96-8c0 8.84-7.16 16-16 16h-56v128c0 8.84-7.16 16-16 16h-16c-8.84 0-16-7.16-16-16V200h-56c-8.84 0-16-7.16-16-16v-16c0-8.84 7.16-16 16-16h56v-48c0-8.84 7.16-16 16-16h16c8.84 0 16 7.16 16 16v48h56c8.84 0 16 7.16 16 16v16z"></path>
                    </g>
                  </svg>
                </div>
                <div class="d-lg-none d-xl-block" style="position: absolute; top: 79px; margin-left: 940px; width: 26px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="black">
                      <path fill="currentColor" d="M496 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h480c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zm-48-256C448 85.96 362.04 0 256 0S64 85.96 64 192v224h384V192z"></path>
                    </g>
                  </svg>
                </div>
                <div class="d-lg-none d-xl-block" style="position: absolute; top: 53px; margin-left: 1150px; width: 60px; z-index: 10">
                  <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-trees fa-w-20 fa-3x">
                    <g class="text-muted">
                      <path fill="currentColor" d="M298.42 288h30.63c9.01 0 16.98-5 20.78-13.06 3.8-8.04 2.55-17.26-3.28-24.05L268.42 160h28.89c9.1 0 17.3-5.35 20.86-13.61 3.52-8.13 1.86-17.59-4.24-24.08L203.66 4.83c-6.03-6.45-17.28-6.45-23.32 0L70.06 122.31c-6.1 6.49-7.75 15.95-4.24 24.08C69.39 154.65 77.59 160 86.69 160h28.89l-78.14 90.91c-5.81 6.78-7.06 15.99-3.27 24.04C37.97 283 45.93 288 54.95 288h30.63L5.69 378.49c-6 6.79-7.36 16.09-3.56 24.26 3.75 8.05 12 13.25 21.01 13.25H160v24.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L224 440.45V416h136.87c9.01 0 17.26-5.2 21.01-13.25 3.8-8.17 2.44-17.47-3.56-24.26L298.42 288zm335.89 90.49L554.42 288h30.63c9.01 0 16.98-5 20.78-13.06 3.8-8.04 2.55-17.26-3.28-24.05L524.42 160h28.89c9.1 0 17.3-5.35 20.86-13.61 3.52-8.13 1.86-17.59-4.24-24.08L459.66 4.83c-6.03-6.45-17.28-6.45-23.32 0l-95.06 101.26c11.09 15.37 13.97 35.3 6.34 52.96-4 9.27-10.38 17.03-18.26 22.68l41.54 48.32c13.93 16.25 17.04 39.23 7.94 58.52-4.19 8.89-10.46 16.24-18.11 21.58l41.62 47.15c8.65 9.8 13.34 14.15 13.65 26.69v56.45l-30.29 48.4c-5.32 10.64 2.42 23.16 14.31 23.16h95.96c11.89 0 19.63-12.52 14.31-23.16L480 440.45V416h136.87c9.01 0 17.26-5.2 21.01-13.25 3.79-8.17 2.43-17.47-3.57-24.26z" class=""></path>
                    </g>
                  </svg>
                </div>
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
                          <a class="dropdown-item" href="<?php echo WEBCENTROS_DOMINIO; ?>instituto/tutorias">Tutorías y horarios</a>
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
