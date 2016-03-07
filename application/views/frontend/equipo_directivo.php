<div id="content" class="container">
	
	<div class="row">
		
		<div class="col-md-8">
			
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
				<h4>Documentos</h4>
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
		
		<div class="col-md-4">
			
			<div class="title-module">
				<h4>Equipo directivo</h4>
			</div>
			
			<?php foreach ($equipo_directivo as $item): ?>	
			<div class="col-sm-6 col-md-12 media-organizacion">
				<div class="media">
				  <div class="media-left">
				  <?php if (! $item['imagen']): ?>
				  	<span class="fa-stack fa-2x fa-lg">
				  	  <i class="fa fa-circle fa-stack-2x text-muted"></i>
				  	  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
				  	</span>
				  <?php else: ?>
				  	<img class="media-object" src="<?php echo $item['imagen']; ?>" alt="<?php echo $item['nombre']; ?>" style="width: 64px !important;">
				  <?php endif; ?>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo $item['nombre']; ?></h4>
				    <p class="text-muted"><?php echo $item['cargo']; ?></p>
				    <ul class="list-unstyled">
				    	<li><a href="call:+34<?php echo $item['telefono']; ?>"><span class="fa fa-phone fa-fw"></span> <?php echo telefono($item['telefono']); ?></a></li>
				    	<li><a href="mailto:<?php echo $item['correo-e']; ?>"><span class="fa fa-envelope fa-fw"></span> <?php echo $item['correo-e']; ?></a></li>
				    </ul>
				  </div>
				</div>
			</div>
			<?php endforeach; ?>
						
		</div>
		
	</div>
	
	

</div><!-- /.container -->
