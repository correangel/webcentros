<div id="content" class="container">
	
	<div class="row">
		
		<div class="col-sm-8">
			
			<div class="title-module">
				<h4>Noticias</h4>
			</div>
			
			<div class="list-group">
			  <a href="#" class="list-group-item"><span class="pull-right label label-info">1 oct, 2015</span> Cras justo odio</a>
			  <a href="#" class="list-group-item"><span class="pull-right label label-info">1 oct, 2015</span> Dapibus ac facilisis in</a>
			  <a href="#" class="list-group-item"><span class="pull-right label label-info">1 oct, 2015</span> Morbi leo risus</a>
			  <a href="#" class="list-group-item"><span class="pull-right label label-info">1 oct, 2015</span> Porta ac consectetur ac</a>
			  <a href="#" class="list-group-item"><span class="pull-right label label-info">1 oct, 2015</span> Vestibulum at eros</a>
			</div>
			
			<div style="margin-bottom: 40px;"></div>
			
			<div class="title-module">
				<h4>Programaciones y documentos</h4>
			</div>
			
			<div class="list-group">
			  <a href="#" class="list-group-item">
			  	<span class="pull-right label label-info">1 oct, 2015</span>
			  	<span class="fa fa-file-o fa-fw"></span> 
			  	Cras justo odio
			  </a>
			  <a href="#" class="list-group-item">
			  	<span class="pull-right label label-info">1 oct, 2015</span>
			  	<span class="fa fa-file-o fa-fw"></span> 
			  	Cras justo odio
			  </a>
			  <a href="#" class="list-group-item">
			  	<span class="pull-right label label-info">1 oct, 2015</span>
			  	<span class="fa fa-file-o fa-fw"></span> 
			  	Cras justo odio
			  </a>
			  <a href="#" class="list-group-item">
			  	<span class="pull-right label label-info">1 oct, 2015</span>
			  	<span class="fa fa-file-o fa-fw"></span> 
			  	Cras justo odio
			  </a>
			  <a href="#" class="list-group-item">
			  	<span class="pull-right label label-info">1 oct, 2015</span>
			  	<span class="fa fa-file-o fa-fw"></span> 
			  	Cras justo odio
			  </a>
			</div>
			
		</div>
		
		<div class="col-sm-4">
			
			<div class="title-module">
				<h4>Miembros del departamento</h4>
			</div>
			
			<ul class="fa-ul">
				<?php foreach ($componentes as $item): ?>
				<li><span class="fa-li fa fa-user"></span> <?php echo $item->profesor; ?> <?php echo (stristr($item->cargo, '4') == true) ? '<small><strong>(Jefe/a del Depto.)</strong></small>' : ''; ?></li>
				<?php endforeach; ?>
			</ul>
			
			<div style="margin-bottom: 40px;"></div>
			
			<div class="title-module">
				<h4>Contacto</h4>
			</div>
			
			<ul class="list-unstyled">
				<li><a href="call:+34<?php echo $this->config->item('centro_telefono'); ?>"><span class="fa fa-phone fa-fw"></span> <?php echo telefono($this->config->item('centro_telefono')); ?></a></li>
				<li><a href="mailto:<?php echo $alias; ?>@iesmonterroso.org"><span class="fa fa-envelope fa-fw"></span> Correo electrónico</a></li>
			</ul>
						
		</div>
		
	</div>

</div><!-- /.container -->
