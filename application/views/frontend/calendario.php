<div id="content" class="container">
	
	<?php $anio_inicio = substr($this->config->item('curso_actual'), 0, -3); ?>
	<?php $mes_inicio = 9; ?>
	
	<?php for ($i = 0; $i < 12; $i++): ?>
		<?php if($mes_inicio > 12) { $anio_inicio = 2016; $mes_inicio = 1; } ?>
		
		<?php if($i%3 == 0): ?>
		<div class="row">
		<?php endif; ?>
		
		<div class="col-sm-4">
			<div class="row">
				<div class="col-xs-6 col-sm-12">
					<?php echo $this->calendar->generate($anio_inicio, $mes_inicio, (isset(${'cal_'.$anio_inicio.'_'.$mes_inicio})) ? ${'cal_'.$anio_inicio.'_'.$mes_inicio} : false); ?>
				</div>
				
				<div class="col-xs-6 col-sm-12 visible-xs">
					<h5>Días festivos</h5>
					
					<?php if (isset(${'cal_'.$anio_inicio.'_'.$mes_inicio})): ?>
					<ol class="list-unstyled">
					<?php foreach(${'cal_'.$anio_inicio.'_'.$mes_inicio} as $dia => $nombre): ?>
						<li><span class="label label-danger"><?php echo $dia; ?></span> <?php echo $nombre; ?></li>
					<?php endforeach; ?>
					</ol>
					<?php else: ?>
					<p class="text-muted">No hay días festivos</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
		<?php if($i%3 == 2): ?>
		</div>
		<?php endif; ?>
		
		<?php $mes_inicio++; ?>
	<?php endfor; ?>

</div><!-- /.container -->