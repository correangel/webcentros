<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title><?php echo (isset($titulo)) ? strip_tags($titulo). ' - ' . $this->config->item('centro_denominacion') : $this->config->item('centro_denominacion'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <![endif]-->
    
    <link rel="canonical" href="<?php echo base_url(); ?>">
    <meta name="description" content="">
    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=PT+Sans:400,300,600&amp;subset=cyrillic,latin">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->
	
	<style>
	body {
		font-size: 14px;
		line-height: 1.6;
		text-rendering: optimizeLegibility;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}
	
	a {
		color: #dd4814;
	}
	
	a:hover {
		color: #dd4814;
	}
	
	p {
		color: #555;
	}
	
	footer {
		margin-top: 20px;
		margin-bottom: 20px;
		font-size: 0.875em;
	}
	
	footer p {
		line-height: 35px;
	}
	
	.icon-gray {
		color: #f7f7f7;
	}
	
	.icon-gray i:last-child {
		color: #555;
	}
	
	.icon-gray:hover {
		color: #ddd;
	}
	
	h1, h2, h3, h4 {
		color: #555;
		font-family: 'PT Sans';
		font-weight: normal; 
	}
	
	h1 {
		font-size: 28px;
		line-height: 35px;
	}
	
	h2 {
		font-size: 24px;
		line-height: 33px;
	}
	
	h3 {
		font-size: 20px;
		line-height: 27px;
	}
	
	h4 {
		font-weight: 600;
	}
	
	#content {
	 	margin-top: 20px;
	 	margin-bottom: 20px;	
	}
	
	.breadcrumbs {
		overflow: hidden;
		padding: 10px 0 6px;
		border-bottom: solid 1px #eee;
		background: #f7f7f7;
	}
	
	.breadcrumbs h1 {
		color: #666;
		font-size: 28px;
		margin-top: 8px;
	}
	
	.breadcrumb {
		padding: 8px 15px;
		margin-top: 10px;
		margin-bottom: 10px;
		list-style: none;
		background-color: #f5f5f5;
	}
	
	.breadcrumb a {
		color: #777;
	}
	
	.breadcrumb a:hover {
		color: #dd4814;
		text-decoration: none; 
	} 
	
	.breadcrumb li.active {
		color: #dd4814;
		text-decoration: none;
	}
	
	.title-module {
		display: block;
		margin: 10px 0 25px 0;
		border-bottom: 2px dotted #eee;
	}
	
	.title-module h4 {
		margin: 0 0 -2px 0;
		padding-bottom: 5px;
		display: inline-block;
		border-bottom: 2px solid #dd4814;
	}
	
	
	ul.blog-info li, ul.blog-info li a {
		color: #555;
		font-style: italic;
		font-size: 12px;
		line-height: 12px;
	}
	
	ul.blog-info li a:hover {
		color: #dd4814;
	}
		
	ul.blog-info li:first-child::before {
		margin-right: 0px;
		content: ' ';
	}
	
	ul.blog-info li::before {
		margin-right: 13px;
		content: '/';
	}
	
	h2.blog-item-title {
		font-size: 22px;
		margin: 0 0 15px;
		line-height: 30px;
		font-weight: 400;
	}
	
	h2.blog-item-title a {
		text-transform: inherit;	
	}
	
	.blog-noimage {
		padding: 0;
		background-color: #f7f7f7;
	}
	
	.blog-noimage img {
		padding: 20px 30px;
	}
	
	.navbar {
		background: rgba(255, 255, 255, 1);
		margin: 0;
		border: 0;
		border-bottom: 2px solid #eee;
		border-radius: 0;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
	}
	
	.navbar-toggle {
		background-color: transparent;
		background-image: none;
		border: 1px solid transparent;
		border-radius: 4px;
		color: #dd4814 !important;
	}
	
	
	.navbar.navbar-inverse {
		background: rgba(0, 0, 0, .75);
	}
	
	.navbar.navbar-inverse a.navbar-brand {
		color: #eee !important;
	}
	
	a.navbar-brand {
		color: #dd4814 !important;
		font-weight: 500;
	}
	
	.navbar-nav>li>a {
		font-weight: 500;
		color: #333;
		padding: 15px 25px;
	}
	
	.navbar-nav>li>a:hover, .nav .open>a:hover, .nav .open>a:focus {
		color: #dd4814;
	}
	
	.navbar-brand-img {
		height: 28px !important;
		width: auto !important;
		margin-top: -4px;
	}
	
	a#navbar-text-info {
		background-color: #dd4814;
		font-weight: 500;
		white-space: nowrap;
		text-decoration: none;
		text-transform: uppercase;
		color: #fff !important;
		margin-top: 9.555px;
		margin-bottom: 7px;
		padding: 4px 10px;
	}
	
	a#navbar-text-info:hover {
		text-decoration: none;
	}
	
	.caret-up {
	    width: 0; 
	    height: 0; 
	    border-left: 4px solid rgba(0, 0, 0, 0);
	    border-right: 4px solid rgba(0, 0, 0, 0);
	    border-bottom: 4px solid;
	    
	    display: inline-block;
	    margin-left: 2px;
	    vertical-align: middle;
	}
	
	.paddingtop {
		padding-top: 20px;
	}
	
	.margintop {
		margin-top: 20px;
	}
	
	.marginright10 {
		margin-right: 10px;
	}
	
	.margin20 {
		margin-top: 20px;
		margin-bottom: 20px;
	}
	
	.table-calendar td {
		width: 14.2857% !important;
	}
	
	
	.table-calendar-home.table {
		border: 0;
		border-spacing: 7px;
		border-collapse: separate;
	}
	
	.table-calendar-home.table>tbody>tr>td, 
	.table-calendar-home.table>tbody>tr>th, 
	.table-calendar-home.table>tfoot>tr>td, 
	.table-calendar-home.table>tfoot>tr>th, 
	.table-calendar-home.table>thead>tr>td, 
	.table-calendar-home.table>thead>tr>th {
		border: 0;
		width: 14.285%;
		font-size: 0.875em;
	}
	
	.table-calendar-home th {
		font-size: 14px !important;
	}
	
	.table-calendar-home tr td {
		padding: 1px !important;
		line-height: 26px !important;
		color: #555;
	}
	
	
	.active-green {
		background-color: green;
		border-radius: 25px;
		-moz-border-radius: 25px;
		-webkit-border-radius: 25px;
		font-weight: bold;
		color: #fff;
	}
	
	.today {
		background-color: #dd4814;
		border-radius: 25px;
		-moz-border-radius: 25px;
		-webkit-border-radius: 25px;
		font-weight: bold;
		color: #fff;
	}
	
	a.link-logo {
		display: block;
		text-align: center;
	}
	
	a.link-logo img {
		opacity: 0.5;
		-webkit-backface-visibility: hidden;
		-moz-backface-visibility: hidden;
		-ms-backface-visibility: hidden;
		backface-visibility: hidden;
		-webkit-transition: opacity 0.2s ease-in;
		-moz-transition: opacity 0.2s ease-in;
		-o-transition: opacity 0.2s ease-in;
		transition: opacity 0.2s ease-in;
		margin: 0 auto;
		margin-bottom: 20px;
	}
	
	a.link-logo:hover img {
		opacity: 1;
	}
	
	/* BLOCKS */
	
	.block {
		padding: 10px 20px;
		margin-bottom: 20px;
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
	}
	
	.block * {
		color: #fff;
	}
	
	.block-default {
		background-color: #fafafa;
	}
	
	.block.block-default * {
		color: #555;
	}
	
	.block-red {
		background-color: #e74c3c;
	}
	
	.block-blue {
		background-color: #3498db;
	}
	
	.block-dark {
		background-color: #555;
	}
	
	.block-green {
		background-color: #72c02c;
	}
	
	.block-yellow {
		background-color: #f1c40f;
	}
	
	#news-tabs li.active {
		font-weight: 600;
	}
	
	/* NEWS */
	.news-triangle {
		position: absolute;
		width: 0;
		height: 0;
		border-style: solid;
		border-width: 90px 90px 0 0;
		border-color: #bd2020 transparent transparent transparent;
		line-height: 0px;
		_border-color: #bd2020 #000000 #000000 #000000;
		_filter: progid:DXImageTransform.Microsoft.Chroma(color='#000000');
		z-index: 20;
	}
	
	.news-triangle-icon {
		position: absolute;
		font-size: 1.8em;
		padding: 7px 10px;
		color: #fff;
		z-index: 25;
	}
	
	/* CALENDAR */
	#calendar-list li:first-child {
		border-top: 2px dotted #eee;
	}
	
	#calendar-list li {
		padding: 7px 0;
		border-bottom: 2px dotted #eee;
	}
	
	#calendar-list li a {
		color: #333;
		font-weight: 500;
	}
	
	#calendar-list li a small {
		color: #777;
	}
	
	#calendar-list li a:hover {
		color: #dd4814;
		text-decoration: none;
	}
	
	/* FORMS */
	
	.form-control {
		border: 2px solid #ecf0f1;
		color: #34495e;
		font-size: 14px;
		line-height: 1.467;
		padding: 8px 12px;
		height: 40px;
		-webkit-appearance: none;
		border-radius: 6px;
		-webkit-box-shadow: none;
		box-shadow: none;
		-webkit-transition: border .25s linear, color .25s linear, background-color .25s linear;
		transition: border .25s linear, color .25s linear, background-color .25s linear;
		z-index: 10;
	}
	
	.form-control:focus {
		border-color: #dd4814;
		box-shadow: none;
		-webkit-box-shadow: none;
		z-index: 10;
	}
	
	.form-control-feedback {
		line-height: 36px !important;
		color: #777;
	}
	
	.btn {
		color: #FFF;
		padding: 10px 20px;
		margin: 15px 0;
		font-family: "Open Sans", Helvetica, Arial, sans-serif;
		font-size: 14px;
		font-weight: 600;
		text-shadow: none;
		border: none;
		border-radius: 4px;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
	}
	
	.btn-primary {
		background: #ee7044 !important;
		box-shadow: 0 2px #dd4814 !important;
	}
	.btn-primary:hover, .btn-primary:focus {
		background: #dd4805 !important;
	}
	
	.btn-default {
		background: #f5f5f5 !important;
		border: 2px solid #dedede;
		box-shadow: 0;
		
	}
	
	.btn-default:hover {
		border: 2px solid #dd4814;
	}
	
	
	.input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group {
		margin-left: -2px;
	}
	
	/* PAGINATION */
	.pagination {
		margin: 0;
	}
	
	.pagination>li>a, .pagination>li>span {
		border: 2px solid #ecf0f1;
		color: #34495e;
		font-size: 14px;
		padding: 8px 12px;
		margin-left: -2px;
	}
	
	.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
		background-color: #dd4814;
		border-color: #df3a01;
	}
	
	/* MAP */
	#map-canvas {
		width: 100%;
		height: 450px;
	}
	
	/* WELL */
	
	.well {
		border: 1px solid #eee;
		box-shadow: none;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		border-radius: 4px;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
	}
	
	/* MEDIA - ORGANIZACION */
	.media-organizacion {
		margin-bottom: 1.35em;
	}
	
	/* #### Mobile Phones Portrait or Landscape #### */
	
	@media screen and (max-width: 1200px) {
		.navbar-text-lg {
			font-size: 18px;
			margin-top: 11px;
			margin-bottom: 7px;
			white-space: nowrap;
		}
		
		.navbar-nav>li>a {
			padding: 15px 20px;
		}
	}
	
	@media screen and (max-width: 768px) {
		.icon-social {
			font-size: 2em;
		}
		
		.nofloat-xs {
			float: none !important;
			text-align: center;
		}
		
		#map-canvas {
			width: 100%;
			height: 400px;
		}
	}
	
	@media screen and (max-device-width: 640px) and (orientation: landscape) {
		#map-canvas {
			float: right;
			width: 50%;
			height: 450px;
		}
	}
	
	
	@media screen and (max-device-width: 640px) and (orientation: portrait) {
	 	.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
	 		width: 100% !important;
	 	}
	}
	/*
	
	.dropdown-menu {
		border-radius: 0;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		border-top: 4px solid #4585f2;
		box-shadow: 0 3px 3px rgba(0, 0, 0, .3), 0 0 0 2px #fff inset;
	}
	
	.dropdown-header {
		border-bottom: 1px solid #eee;
		color: #666;
		font-size: 14px;
		font-weight: 700;
		margin: 0 0 12px;
		padding: 8px 12px;
		text-transform: uppercase
	}
	*/
	li.mega-dropdown.open a.dropdown-toggle:before {
		border-top-color: transparent;
		border-left-color: transparent;
		border-bottom-color: #dd4814;
		border-right-color: transparent;
		border-style: solid;
		border-width: 0 8px 8px;
		content: '';
		margin-left: -8px;
		pointer-events: none;
		position: absolute;
		bottom: 100%;
		left: 50%;
		width: 0;
		height: 0;
		top: auto;
		bottom: 0
	}
	.mega-dropdown {
		position: static !important;
	}
	
	.mega-dropdown-menu {
		margin: 0 auto;
		left: 0;
		right: 0;
	    padding: 20px 0px;
	    width: 1150px;
	    -webkit-box-shadow: none;
	    border-radius: 0;
	    -webkit-border-radius: 0;
	    -moz-border-radius: 0;
	    border: 0;
	    border-top: 4px solid #dd4814;
	    box-shadow: 0 3px 3px rgba(0, 0, 0, .3);
	    background-color: #f7f7f7;
	}
	.mega-dropdown-menu > li > ul:first-child {
		padding: 0;
		margin: 0;
	}
	.mega-dropdown-menu > li > ul {
	  padding: 0;
	  margin: 20px 0 0 0;
	}
	.mega-dropdown-menu > li > ul > li {
	  list-style: none;
	}
	.mega-dropdown-menu > li > ul > li > a {
	  display: block;
	  color: #222;
	  padding: 8px 12px;
	}
	.mega-dropdown-menu > li ul > li > a:hover,
	.mega-dropdown-menu > li ul > li > a:focus {
	  text-decoration: none;
	  color: #dd4814;
	}
	.mega-dropdown-menu .dropdown-header {
	  border-bottom: 1px solid #eee;
	  color: #666;
	  font-size: 14px;
	  font-weight: 700;
	  margin: 0 0 12px;
	  padding: 8px 12px;
	  text-transform: uppercase
	}
	
	@media screen and (max-width: 1200px) {
		.mega-dropdown-menu {
		    width: 970px;
		}
	}
	
	@media screen and (max-width:940px) {
		.mega-dropdown-menu {
		    width: 100%;
		}
	}
	
	/* SOCIAL ICONS */
	span.icon-facebook:hover>i:first-child { color: #3b5998; }
	span.icon-twitter:hover>i:first-child { color: #55acee; }
	span.icon-google-plus:hover>i:first-child { color: #dd4b39; }
	span.icon-youtube:hover>i:first-child { color: #cb2027; }
	span.icon-social:hover>i:last-child { color: #fff; }
	
	#news-tabs>li::after {
		content: '•';
		font-weight: 600;
		color: #666 !important;
		margin-left: 15px;
	}
	
	#news-tabs>li:last-child::after {
		content: '';
		margin-left: 0;
	}
	</style>
	
  </head>
  
  <body>
      <div class="navbar navbar-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo base_url(); ?>" class="navbar-brand">
            <img src="<?php echo base_url().'assets/img/logo.gif'; ?>" alt="<?php echo $this->config->item('centro_denominacion'); ?>" class="pull-left marginright10 navbar-brand-img" />
            <?php echo $this->config->item('centro_denominacion'); ?>
            </a>
            <button id="navbar-toggle" class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="fa fa-bars fa-fw fa-lg fa-toggle"></span>
              <span class="fa fa-times fa-fw fa-lg fa-toggle" style="display: none"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li class="dropdown mega-dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="instituto">Instituto</a>
                <ul class="dropdown-menu mega-dropdown-menu" aria-labelledby="instituto">
    				<li class="col-sm-4">
    					<ul>
		        			<li class="dropdown-header">Organización</li>
		        			<li><?php echo anchor('equipo-directivo/', 'Equipo directivo'); ?></li>
		        			<li><?php echo anchor('departamentos/', 'Departamentos'); ?></li>
		        			<li><?php echo anchor('#', 'A.M.P.A. Bacalaureatus'); ?></li>
		        		</ul>
		        		
		        		<ul>
		        			<li class="dropdown-header">Documentación</li>
		        			<li><?php echo anchor('#', 'Plan del centro'); ?></li>
		        		</ul>
		        	</li>
		        	<li class="col-sm-4">
		        		<ul>
			        		<li class="dropdown-header">Información académica</li>
			        		<li><?php echo anchor('horarios-atencion/', 'Horarios de atención'); ?></li>
			        		<li><?php echo anchor('biblioteca/', 'Fondos de la Biblioteca'); ?></li>
			        		<li><?php echo anchor('actividades/', 'Actividades extraescolares'); ?></li>
		        			<li><?php echo anchor('calendario/', 'Calendario escolar 2015/16'); ?></li>
		        			<li><?php echo anchor('libros-texto/', 'Libros de texto'); ?></li>
		        			<li><?php echo anchor('imagenes/', 'Imágenes y reportajes'); ?></li>
		        		</ul>
		        	</li>
		        	<li class="col-sm-4">
		        		<ul>
		        			<li class="dropdown-header">Programas y proyectos</li>
		        			<li><?php echo anchor('http://www.juntadeandalucia.es/educacion/webportal/web/lecturas-y-bibliotecas-escolares', 'Lectura y Biblioteca', array('target' => '_blank')); ?></li>
		        			<li><?php echo anchor('http://www.juntadeandalucia.es/educacion/webportal/web/convivencia-escolar', 'Convivencia escolar', array('target' => '_blank')); ?></li>
		        			<li><?php echo anchor('#', 'Deporte en la Escuela', array('target' => '_blank')); ?></li>
		        			<li><?php echo anchor('#', 'Escuela TIC 2.0', array('target' => '_blank')); ?></li>
		        			<li><?php echo anchor('http://www.juntadeandalucia.es/educacion/webportal/web/portal-de-plurilinguismo', 'Centro Bilingüe Inglés', array('target' => '_blank')); ?></li>
		        			<li><?php echo anchor('http://www.juntadeandalucia.es/educacion/webportal/web/portal-de-plurilinguismo', 'Plan de Acompañamiento', array('target' => '_blank')); ?></li>
		        			<li><?php echo anchor('http://www.juntadeandalucia.es/educacion/webportal/web/portal-de-plurilinguismo', 'Forma Joven', array('target' => '_blank')); ?></li>
		        		</ul>
		        	</li>
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="estudios">Oferta educativa</a>
                <ul class="dropdown-menu mega-dropdown-menu" aria-labelledby="estudios">
                	<li class="col-sm-4">
                		<ul>
                		  <li class="dropdown-header">Educación Obligatoria</li>
		                  <li><?php echo anchor('oferta-educativa/educacion-secundaria-obligatoria', 'Educación Secundaria Obligatoria'); ?></li>
		                </ul>
		                <ul>
		                  <li class="dropdown-header">Educación Post-Obligatoria</li>
		                  <li><?php echo anchor('oferta-educativa/bachillerato', 'Bachillerato (LOE)'); ?></li>
		                  <li><?php echo anchor('oferta-educativa/bachillerato', 'Bachillerato (LOMCE)'); ?></li>
		                </ul>
		            </li>
		            <li class="col-sm-4">
		            	<ul>
		            		<li role="presentation" class="dropdown-header">Formación Profesional</li>
		            		<li><?php echo anchor('oferta-educativa/informatica-y-comunicaciones', 'F.P. Básica en Informática y Comunicaciones'); ?></li>
		            		<li><?php echo anchor('oferta-educativa/atencion-a-personas-en-situacion-de-dependencia', 'F.P. Grado Medio en Atención a Personas en Situación de Dependencia'); ?></li>
		            		<li><?php echo anchor('oferta-educativa/guia-informacion-y-asistencias-turisticas', 'F.P. Grado Superior en Guía, Información y Asistencias Turísticas'); ?></li>
		            	</ul>
		            </li>
		            <li class="col-sm-4">
		            	<ul>
		            		<li role="presentation" class="dropdown-header">Pruebas de Acceso</li>
		            		<li><?php echo anchor('oferta-educativa/pau', 'Prueba de Acceso a la Universidad'); ?></li>
		            		<li><?php echo anchor('oferta-educativa/pau', 'Prueba de Acceso a Ciclos Formativos'); ?></li>
		            		<li></li>
		            	</ul>
		            </li>
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="alumnado">Alumnado</a>
                <ul class="dropdown-menu mega-dropdown-menu" aria-labelledby="alumnado" style="width: 450px !important; padding-top: 0;">
                	<li class="col-sm-12" style="background-color: #333; border-bottom: 1px solid #eee;">
                		<ul>
                			<li>
                				<a href="#" style="font-weight: bold; color: #fff; padding: 15px 8px;">
                					<span class="fa fa-stack fa-lg icon-gray">
            						  <i class="fa fa-circle fa-stack-2x"></i>
            						  <i class="fa fa-user fa-stack-1x"></i>
            						</span>
                					Iniciar sesión
                				</a>
                			</li>
                		</ul>
                    </li>
                    <li class="col-sm-12" style="background-color: #fff; border-bottom: 1px solid #eee; padding: 8px 0; margin-bottom: 8px;">
                    	<ul>
                    		<li><a href="#" style="text-align: center; color: #555; font-weight: 600; text-transform: uppercase;"><span class="fa fa-user-plus fa-fw fa-lg"></span> Solicitud de matrícula</a></li>
                    	</ul>
                    </li>
                    <li class="col-sm-4">
                    	<ul>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-user-secret fa-fw fa-3x"></span><br>Datos personales</a></li>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-bar-chart fa-fw fa-3x"></span><br>Evaluaciones</a></li>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-gavel fa-fw fa-3x"></span><br>Convivencia</a></li>
                    	</ul>
                    </li>
                    <li class="col-sm-4">
                    	<ul>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-calendar-o fa-fw fa-3x"></span><br>Agenda</a></li>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-tasks fa-fw fa-3x"></span><br>Actividades</a></li>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-clock-o fa-fw fa-3x"></span><br>Asistencia</a></li>
                    	</ul>
                    </li>
                    <li class="col-sm-4">
                    	<ul>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-book fa-fw fa-3x"></span><br>Libros de texto</a></li>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-comments-o fa-fw fa-3x"></span><br>Mensajes</a></li>
                    		<li><a href="#" style="font-size: 0.875em; text-align: center; color: #555;"><span class="fa fa-graduation-cap fa-fw fa-3x"></span><br>Plat. Moodle</a></li>
                    	</ul>
                    </li>
                </ul>
              </li>
              <li><?php echo anchor('http://iesmonterroso.org/dbiblioteca/', 'Biblioteca'); ?></li>
              <li><?php echo anchor('https://iesmonterroso.org/intranet/', 'Intranet'); ?></li>
            </ul>
  
            <div class="nav navbar-nav navbar-right hidden-xs">
            	<?php echo anchor('contacto/', 'Infórmate <span class="fa fa-chevron-right fa-fw"></span>', array('id' => 'navbar-text-info', 'class' => 'navbar-text text-center')); ?>
            </div>
  
          </div>
        </div>
      </div>
      