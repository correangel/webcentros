<?php 
$acentos = array('.','-',' ','Á','É','Í','Ó','Ú','á','é','í','ó','ú');
$no_acentos = array('','_','_','A','E','I','O','U','a','e','i','o','u');

$icons = array(
	'idiomas' => 'fa-language',
	'aleman' => 'fa-language',
	'biologia_y_geologia' => 'fa-leaf',
	'cultura_clasica' => 'fa-university',
	'dibujo' => 'fa-paint-brush',
	'plastica_visual' => 'fa-paint-brush',
	'economia' => 'fa-bar-chart',
	'educacion_fisica' => 'fa-futbol-o',
	'filosofia' => 'fa-gavel',
	'fisica_y_quimica' => 'fa-flask',
	'formac_prof_basica_inform_y_comun' => 'fa-briefcase',
	'formacion_y_orientacion_laboral_y_economia' => 'fa-briefcase',
	'frances' => 'fa-language',
	'geografia_e_historia' => 'fa-globe',
	'hosteleria_y_turismo' => 'fa-cutlery',
	'ingles' => 'fa-language',
	'religion' => 'fa-child',
	'laboral_religion_(sec_ere)_jorcompleta' => 'fa-child',
	'religion_catolica' => 'fa-child',
	'religion_evangelica' => 'fa-child',
	'lengua_castellana_y_literatura' => 'fa-book',
	'matematicas' => 'fa-superscript',
	'musica' => 'fa-music',
	'orientacion_educativa' => 'fa-compass',
	'pedagogia_terapeutica_eso' => 'fa-compass',
	'servicios_socioculturales_y_a_la_comunidad' => 'fa-briefcase',
	'tecnologia' => 'fa-cogs',
	'tecnologia_e_informatica' => 'fa-tachometer',
	'informatica' => 'fa-desktop',
);
?>

<div id="content" class="container">
	
	<?php $i = 0; ?>
	<?php foreach($departamentos as $departamento): ?>
	
	<?php if($i%3 == 0): ?>
	<div class="row">
	<?php endif; ?>
		
		<div class="col-sm-4">
			
			<a href="<?php echo base_url().'departamentos/'.$departamento->alias ;?>" class="btn btn-default btn-block" style="text-align: left; padding: 20px 15px; color: #dd4814; font-weight: 500; margin-bottom: 20px; white-space: normal;">
				<span class="fa <?php echo (array_key_exists($departamento->alias, $icons) == true) ? $icons[$departamento->alias] : 'fa-briefcase'; ?> fa-fw fa-lg"></span>
				<?php echo $departamento->departamento; ?>
			</a>
		</div>
		
		
	<?php if($i%3 == 2): ?>
	</div>
	<?php endif; ?>
	
	<?php $i++; ?>
	<?php endforeach; ?>

</div><!-- /.container -->
