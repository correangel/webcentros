<div id="content" class="container">
	
	<?php 
	function nombre_mes($num_mes) {
	
		$nombre_mes = "";
		
		switch ($num_mes) {
			case 1 : $nombre_mes = 'Enero'; break;
			case 2 : $nombre_mes = 'Febrero'; break;
			case 3 : $nombre_mes = 'Marzo'; break;
			case 4 : $nombre_mes = 'Abril'; break;
			case 5 : $nombre_mes = 'Mayo'; break;
			case 6 : $nombre_mes = 'Junio'; break;
			case 7 : $nombre_mes = 'Julio'; break;
			case 8 : $nombre_mes = 'Agosto'; break;
			case 9 : $nombre_mes = 'Septiembre'; break;
			case 10 : $nombre_mes = 'Octubre'; break;
			case 11 : $nombre_mes = 'Noviembre'; break;
			case 12 : $nombre_mes = 'Diciembre'; break;
		}
		
		return $nombre_mes;
		
	}
	?>
	
	<?php if(empty($meses_actividades)): ?>
	
	<div class="row">
	
		<div class="col-sm-12" style="padding: 100px 50px;">
		
				
			<p class="lead text-center">No se han registrado actividades extraescolares para este curso escolar</p>
			
		
		</div>
		
	</div>
	
	<?php else: ?>
	
	<div class="row">
	
		<div class="col-sm-2">
			
			<!-- Nav tabs -->
			<ul class="nav nav-pills nav-stacked" role="tablist" style="margin-top: 15px;">
				<?php $i = 0; ?>
				<?php foreach ($meses_actividades as $mes): ?>
				<li<?php echo ($i == 0) ? ' class="active"' : ''; ?>><a href="#<?php echo nombre_mes($mes->num_mes); ?>" aria-controls="<?php echo nombre_mes($mes->num_mes); ?>" role="tab" data-toggle="tab"><?php echo ($mes->num_mes < 7) ? nombre_mes($mes->num_mes).' '.($anio_curso + 1) : nombre_mes($mes->num_mes).' '.$anio_curso; ?> <span class="label label-default pull-right"><?php echo $mes->num_actividades; ?></span></a></li>
				<?php $i++; ?>
				<?php endforeach; ?>
			</ul>
			
		</div>
		
		<div class="col-sm-10">
			
			<!-- Tab panes -->
			<div class="tab-content">
				<?php $i = 0; ?>
				<?php foreach ($meses_actividades as $mes): ?>
				<div role="tabpanel" class="tab-pane<?php echo ($i == 0) ? ' active' : ''; ?>" id="<?php echo nombre_mes($mes->num_mes); ?>">
					
					<h2><?php echo ($mes->num_mes < 7) ? nombre_mes($mes->num_mes).' '.($anio_curso + 1) : nombre_mes($mes->num_mes).' '.$anio_curso; ?></h2>
					
					<div class="panel-group" id="mes<?php echo nombre_mes($mes->num_mes); ?>" role="tablist" aria-multiselectable="true">
					  <?php $j = 1; ?>
					  <?php foreach (${activ.$mes->num_mes} as $actividad): ?>
						<div class="panel panel-default">
						  <div class="panel-heading" role="tab" id="encabezado<?php echo $j; ?>">
						    <h4 class="panel-title">
						      <a role="button" data-toggle="collapse" data-parent="#mes<?php echo nombre_mes($mes->num_mes); ?>" href="#<?php echo nombre_mes($mes->num_mes).$j; ?>" aria-expanded="true" aria-controls="encabezado<?php echo $j; ?>" style="display: block;">
						       <?php echo stripslashes($actividad->nombre); ?>
						      </a>
						    </h4>
						  </div>
						  <div id="<?php echo nombre_mes($mes->num_mes).$j; ?>" class="panel-collapse collapse<?php echo ($j == 1) ? ' in' : ''; ?>" role="tabpanel" aria-labelledby="encabezado<?php echo $j; ?>">
						    <div class="panel-body">
						     	
						     	<?php if (! empty($actividad->unidades)): ?>
								<dl class="dl-horizontal">
									<dt>Unidades</dt>
									<dd>
										<?php $unidades = explode(';', $actividad->unidades); ?>
										<?php foreach($unidades as $unidad): ?>
											<div class="label label-info"><?php echo trim($unidad); ?></div>
										<?php endforeach; ?>
									</dd>
								</dl>
								<?php endif; ?>
								
								<?php if (! empty($actividad->descripcion)): ?>
								<dl class="dl-horizontal">
									<dt>Descripción</dt>
									<dd><?php echo stripslashes($actividad->descripcion); ?></dd>
								</dl>
								<?php endif; ?>
								
								<dl class="dl-horizontal">
									<dt>Fecha de inicio</dt>
									<dd><?php echo strftime('%A, %e de %B a las %H:%M horas', strtotime($actividad->fechaini.' '.$actividad->horaini)); ?></dd>
								</dl>
								
								<dl class="dl-horizontal">
									<dt>Fecha de finalización</dt>
									<dd><?php echo strftime('%A, %e de %B a las %H:%M horas', strtotime($actividad->fechafin.' '.$actividad->horafin)); ?></dd>
								</dl>
								
								<?php if (! empty($actividad->lugar)): ?>
								<dl class="dl-horizontal">
									<dt>Lugar</dt>
									<dd><?php echo $actividad->lugar; ?></dd>
								</dl>
								<?php endif; ?>
								
								<?php if (! empty($actividad->departamento)): ?>
								<dl class="dl-horizontal">
									<dt>Departamento</dt>
									<dd><?php echo stripslashes($actividad->departamento); ?></dd>
								</dl>
								<?php endif; ?>
								
								<?php if (! empty($actividad->profesores)): ?>
								<dl class="dl-horizontal">
									<dt>Profesores tutores</dt>
									<dd>
										<?php $profesores = explode(';', $actividad->profesores); ?>
										<ul class="list-inline">
										<?php foreach($profesores as $profesor): ?>
										<?php $nom_profesor = explode(', ', $profesor); ?>
											<li><?php echo trim($nom_profesor[1].' '.$nom_profesor[0]); ?></li>
										<?php endforeach; ?>
										</ul>
									</dd>
									
								</dl>
								<?php endif; ?>
								
								<?php if (! empty($actividad->observaciones)): ?>
								<dl class="dl-horizontal">
									<dt>Información adicional</dt>
									<dd><?php echo stripslashes($actividad->observaciones); ?></dd>
								</dl>
								<?php endif; ?>
						    </div>
						  </div>
						</div>
						<?php $j++; ?>
					  <?php endforeach; ?>
					</div>
				
				</div>
				<?php $i++; ?>
				<?php endforeach; ?>
			</div>
			
			<p><small>Las fechas de las actividades son aproximadas. Pueden variar en función de la actividad, o bien si la misma se realiza fuera del instituto.</small></p>
			
		</div>
	
	</div>
	
	<?php endif; ?>
	

</div><!-- /.container -->