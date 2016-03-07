<div id="content" class="container">

	<div class="row">
	
		<div class="col-sm-9">
		
			<h1 class="blog-item-title"><?php echo anchor('noticias/' . $noticia->alias_categoria . '/' . $noticia->alias, $noticia->titulo); ?></h1>
			
			<ul class="list-inline blog-info">
				<li><?php echo $noticia->autor; ?></li>
				<li><?php echo anchor('noticias/' . $noticia->alias_categoria, $noticia->nombre_categoria); ?></li>
				<li><?php echo strftime("%e %b, %Y %H:%Mh", strtotime($noticia->fechapub)); ?></li>
			</ul>
			
			<?php if ($noticia->imagen_cab != NULL): ?>
			<img class="img-responsive" src="<?php echo $noticia->imagen_cab; ?>" alt="<?php echo $noticia->titulo; ?>">
			
			<br>
			<?php elseif ($noticia->video_cab != NULL): ?>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe width="560" height="315" src="<?php echo $noticia->video_cab; ?>" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<br>
			<?php endif; ?>
			
			<p><?php echo $noticia->contenido; ?></p>
			
			<br>
			
			<ul class="list-inline">
				<li>
					<?php 
					$atts = array(
					              'width'      => '600',
					              'height'     => '400',
					              'scrollbars' => 'yes',
					              'status'     => 'yes',
					              'resizable'  => 'yes',
					              'screenx'    => '0',
					              'screeny'    => '0'
					            );
					echo anchor_popup('http://www.facebook.com/share.php?u='.base_url().'noticias/' . $noticia->alias, '<span class="icon-social icon-facebook fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span>', $atts);
					?>
				</li>
				<li>
					<?php 
					$atts = array(
					              'width'      => '600',
					              'height'     => '400',
					              'scrollbars' => 'yes',
					              'status'     => 'yes',
					              'resizable'  => 'yes',
					              'screenx'    => '0',
					              'screeny'    => '0'
					            );
					echo anchor_popup('http://twitter.com/home?status='.$noticia->titulo.' '.base_url().'noticias/' . $noticia->alias, '<span class="icon-social icon-twitter fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span>', $atts);
					?>
				</li>
				<li>
					<?php 
					$atts = array(
					              'width'      => '600',
					              'height'     => '400',
					              'scrollbars' => 'yes',
					              'status'     => 'yes',
					              'resizable'  => 'yes',
					              'screenx'    => '0',
					              'screeny'    => '0'
					            );
					echo anchor_popup('https://plus.google.com/share?url='.base_url().'noticias/' . $noticia->alias, '<span class="icon-social icon-google-plus fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span>', $atts);
					?>
				</li>
				<li>
					<a href="mailto:destinatario@dominio.com?subject=<?php echo $noticia->titulo; ?>&amp;body=<?php echo base_url().'noticias/' . $noticia->alias; ?>">
						<span class="icon-social fa-stack fa-lg icon-gray">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-envelope-o fa-stack-1x"></i>
						</span>
					</a>
				</li>
			</ul>
		</div><!-- /.col-sm-9 -->
		
		<div class="col-sm-3">
			
			<section class="" style="margin-bottom: 40px;">
				<div class="title-module">
					<h4>Actividades</h4>
				</div>
				
				<?php echo $this->calendar->generate(); ?>
			</section>
			
			<section class="" style="margin-bottom: 40px;">
				<div class="title-module">
					<h4>Nuestras páginas</h4>
				</div>
			
				<ul class="fa-ul">
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://erasmusmonterroso.blogspot.com.es', 'Erasmus+ con Alemania', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://iesmonterroso.org/dbiblioteca/', 'Biblioteca', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://misionesdegrupo.blogspot.com.es', 'Misiones de grupo', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://iesmonterroso2014.blogspot.com.es', 'Blog viaje 2º Bachillerato', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://feiemonterroso.blogspot.com.es', 'Departamento de Formación', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://allegralia.blogspot.com.es', 'Blog de Música', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('https://sectionfle.wordpress.com', 'Blog de Francés', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://bilimonterroso.symbaloo.com/', 'Blog de Bilinguismo', array('target' => '_blank')); ?></li>
					<li><span class="fa-li fa fa-external-link"></span> <?php echo anchor('http://trinity.iesmonterroso.org', 'Pruebas del Trinity', array('target' => '_blank')); ?></li>
				</ul>
			</section>
			
		</div><!-- /col-sm-3 -->
		
	</div><!-- /.row -->
	
</div><!-- /.content -->