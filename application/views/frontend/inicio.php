<div id="content" class="container">

	<div class="row">
		<div class="col-md-8 col-lg-9">

			<div class="title-module">
				<h4>Noticias</h4>

				<div class="pull-right">
					<ul id="news-tabs" class="list-inline">
						<li class="active"><a href="#news-all" aria-controls="news-all" role="tab" data-toggle="tab">Todas las noticias</a></li>
						<li><a href="#news-important" aria-controls="news-important" role="tab" data-toggle="tab">Destacadas</a></li>
					</ul>
				</div>
			</div>

			<div id="news-tabs" class="tab-content">
			  <div role="tabpanel" class="tab-pane fade in active" id="news-all">
			  	<?php if(count($noticias) < 1): ?>

			  		<div class="text-center" style="padding: 50px 0;">
			  	  	<span class="fa fa-newspaper-o fa-5x text-muted"></span>
							<p></p>
			  	  	<p class="lead text-muted">No hay noticias en este momento.</p>
			  	</div>

			  	<?php else: ?>

				<?php

				function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
				{
						$datetime1 = date_create($date_1);
						$datetime2 = date_create($date_2);

						$interval = date_diff($datetime1, $datetime2);

						return $interval->format($differenceFormat);
				}

				foreach ($noticias as $item):

				$today = date('Y-m-d H:i:s');
				$datepub = $item->fechapub;

				$datepub_days = dateDifference($today, $datepub, '%a');
				$datepub_hours = dateDifference($today, $datepub, '%h');
				$datepub_minutes = dateDifference($today, $datepub, '%i');
				$datepub_seconds = dateDifference($today, $datepub, '%s');

				if ($datepub_days < 1) {
					if ($datepub_hours < 1) {
						if ($datepub_minutes < 1) {
							$plural = ($datepub_seconds > 1) ? 's' : '';
							$fecha_noticia = 'Hace ' . $datepub_seconds . ' segundo'.$plural;
						}
						else {
							$plural = ($datepub_minutes > 1) ? 's' : '';
							$fecha_noticia = 'Hace ' . $datepub_minutes . ' minuto'.$plural;
						}
					}
					else {
						$plural = ($datepub_hours > 1) ? 's' : '';
						$fecha_noticia = 'Hace ' . $datepub_hours . ' hora'.$plural;
					}
				}
				else {
					$fecha_noticia = strftime("%d.%m.%Y", strtotime($item->fechapub));
				}
				?>
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-xs-4 col-lg-4" style="margin-bottom: 5px;">
						<?php if ($item->imagen_cab != NULL): ?>
						<a href="<?php echo 'noticias/' . $item->alias_categoria . '/' . $item->alias; ?>">
							<?php if(! empty($item->fechafinpub)): ?>
							<div class="news-triangle"></div>
							<div class="news-triangle-icon">
								<span class="fa fa-star-o fa-fw"></span>
							</div>
							<?php endif; ?>
							<img class="img-responsive" src="<?php echo $item->imagen_cab; ?>" alt="<?php echo $item->titulo; ?>">
						</a>
						<?php elseif ($item->video_cab != NULL): ?>
						<div class="embed-responsive embed-responsive-16by9">
							<?php if(! empty($item->fechafinpub)): ?>
							<div class="news-triangle"></div>
							<div class="news-triangle-icon">
								<span class="fa fa-star-o fa-fw"></span>
							</div>
							<?php endif; ?>
							<iframe width="560" height="315" src="<?php echo $item->video_cab; ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						<?php else: ?>
						<div class="blog-noimage" align="center">
							<a href="<?php echo 'noticias/' . $item->alias_categoria . '/' . $item->alias; ?>">
								<?php if(! empty($item->fechafinpub)): ?>
								<div class="news-triangle"></div>
								<div class="news-triangle-icon">
									<span class="fa fa-star-o fa-fw"></span>
								</div>
								<?php endif; ?>
								<img class="img-responsive" src="<?php echo base_url().'assets/img/logo.gif'; ?>" alt="<?php echo $item->titulo; ?>">
							</a>
						</div>
						<?php endif; ?>
					</div>
					<div class="col-xs-8 col-lg-8">
						<ul class="list-inline blog-info hidden-xs">
							<li><?php echo $item->autor; ?></li>
							<li><?php echo anchor('noticias/' . $item->alias_categoria, $item->nombre_categoria); ?></li>
							<li><?php echo $fecha_noticia; ?></li>
						</ul>
						<section>
						<h2 class="blog-item-title"><?php echo anchor('noticias/' . $item->alias_categoria . '/' . $item->alias, $item->titulo); ?></h2>

						<p><?php echo ellipsize($item->contenido, 244); ?></p>
						</section>
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
								echo anchor_popup('http://www.facebook.com/share.php?u='.base_url().'noticias/' . $item->alias, '<span class="icon-social icon-facebook fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span>', $atts);
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
								echo anchor_popup('http://twitter.com/home?status='.$item->titulo.' '.base_url().'noticias/' . $item->alias, '<span class="icon-social icon-twitter fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span>', $atts);
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
								echo anchor_popup('https://plus.google.com/share?url='.base_url().'noticias/' . $item->alias, '<span class="icon-social icon-google-plus fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span>', $atts);
								?>
							</li>
							<li>
								<a href="mailto:destinatario@dominio.com?subject=<?php echo $item->titulo; ?>&amp;body=<?php echo base_url().'noticias/' . $item->alias; ?>">
									<span class="icon-social fa-stack fa-lg icon-gray">
									  <i class="fa fa-circle fa-stack-2x"></i>
									  <i class="fa fa-envelope-o fa-stack-1x"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<hr>
				<?php endforeach; ?>

				<!-- PAGINACIÓN Y BÚSQUEDA -->
				<div class="row">

					<div class="col-sm-7">

					  <?php echo $this->pagination->create_links(); ?>

					</div>

					<div class="col-sm-5">
						<div class="form-group has-feedback">
						  <input type="text" class="form-control" placeholder="Buscar&hellip;">
						  <span class="fa fa-search form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>

				</div>

				<?php endif; ?>
			  </div>

			  <div role="tabpanel" class="tab-pane fade in" id="news-important">
			  	<?php if(count($noticias_destacadas) < 1): ?>

			  	<div class="text-center" style="padding: 50px 0;">
				  	<span class="fa fa-fire fa-5x text-muted"></span>
						<p></p>
				  	<p class="lead text-muted">No hay noticias destacadas en este momento.</p>
				</div>

			  	<?php else: ?>

			  	<?php foreach ($noticias_destacadas as $item): ?>

			  	<div class="row" style="margin-bottom: 20px;">
			  		<div class="col-xs-4 col-lg-4">
			  			<?php if ($item->imagen_cab != NULL): ?>
			  			<a href="<?php echo base_url().'noticias/' . $item->alias; ?>">
			  				<?php if(! empty($item->fechafinpub)): ?>
			  				<div class="news-triangle"></div>
			  				<div class="news-triangle-icon">
			  					<span class="fa fa-star-o fa-fw"></span>
			  				</div>
			  				<?php endif; ?>
			  				<img class="img-responsive" src="<?php echo $item->imagen_cab; ?>" alt="<?php echo $item->titulo; ?>">
			  			</a>
			  			<?php elseif ($item->video_cab != NULL): ?>
			  			<div class="embed-responsive embed-responsive-16by9">
			  				<?php if(! empty($item->fechafinpub)): ?>
			  				<div class="news-triangle"></div>
			  				<div class="news-triangle-icon">
			  					<span class="fa fa-star-o fa-fw"></span>
			  				</div>
			  				<?php endif; ?>
			  				<iframe width="560" height="315" src="<?php echo $item->video_cab; ?>" frameborder="0" allowfullscreen></iframe>
			  			</div>
			  			<?php else: ?>
			  			<div class="blog-noimage" align="center">
			  				<a href="<?php echo base_url().'noticias/' . $item->alias; ?>">
			  					<?php if(! empty($item->fechafinpub)): ?>
			  					<div class="news-triangle"></div>
			  					<div class="news-triangle-icon">
			  						<span class="fa fa-star-o fa-fw"></span>
			  					</div>
			  					<?php endif; ?>
			  					<img class="img-responsive" src="<?php echo base_url().'assets/img/logo.gif'; ?>" alt="<?php echo $item->titulo; ?>">
			  				</a>
			  			</div>
			  			<?php endif; ?>
			  		</div>
			  		<div class="col-xs-8 col-lg-8">
			  			<ul class="list-inline blog-info">
			  				<li><?php echo $item->autor; ?></li>
			  				<li><?php echo anchor('#', $item->nombre); ?></li>
			  				<li><?php echo strftime("%e %B, %Y %H:%Mh", strtotime($item->fechapub)); ?></li>
			  			</ul>
			  			<section>
			  			<h2 class="blog-item-title"><?php echo anchor('noticias/' . $item->alias, $item->titulo); ?></h2>

			  			<p><?php echo ellipsize($item->contenido, 244); ?></p>
			  			</section>
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
			  					echo anchor_popup('http://www.facebook.com/share.php?u='.base_url().'noticias/' . $item->alias, '<span class="icon-social icon-social-facebook fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span>', $atts);
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
			  					echo anchor_popup('http://twitter.com/home?status='.$item->titulo.' '.base_url().'noticias/' . $item->alias, '<span class="icon-social icon-social-twitter fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span>', $atts);
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
			  					echo anchor_popup('https://plus.google.com/share?url='.base_url().'noticias/' . $item->alias, '<span class="icon-social icon-social-gplus fa-stack fa-lg icon-gray"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span>', $atts);
			  					?>
			  				</li>
			  				<li>
			  					<a href="mailto:destinatario@dominio.com?subject=<?php echo $item->titulo; ?>&amp;body=<?php echo base_url().'noticias/' . $item->alias; ?>">
			  						<span class="icon-social icon-social-mail fa-stack fa-lg icon-gray">
			  						  <i class="fa fa-circle fa-stack-2x"></i>
			  						  <i class="fa fa-envelope-o fa-stack-1x"></i>
			  						</span>
			  					</a>
			  				</li>
			  			</ul>
			  		</div>
			  	</div>

			  	<hr>
			  	<?php endforeach; ?>

			  	<?php endif; ?>
			  </div>
			</div><!-- /.tab-content -->

		</div><!-- /.col-sm-8 -->


		<div class="col-md-4 col-lg-3">

			<section class="" style="margin-bottom: 40px;">
				<div class="title-module">
					<h4>Actividades</h4>
				</div>

				<div class="row">

					<div class="col-xs-5 col-md-12">
						<?php echo $this->calendar->generate(); ?>
					</div>

					<div class="col-xs-7 col-md-12">
						<h5 class="text-muted">Próximas actividades&hellip;</h5>
						<ul id="calendar-list" class="list-unstyled">
							<li>
								<a href="#" style="display: block;">
									<div class="pull-left" style="width: 45px; margin-right: 15px;">
										<div style="background-color: #dd4814; text-transform: uppercase; font-size: 0.875em; font-weight: 400; text-align: center; border: 1px solid #dedede; color: #fff; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-bottom-left-radius: 0; -webkit-border-bottom-left-radius: 0; -moz-border-radius-bottomleft: 0; border-bottom-right-radius: 0; -webkit-border-bottom-right-radius: 0; -moz-border-radius-bottomright: 0;">oct</div>
										<div style="text-align: center; border: 1px solid #dedede; color: #777; border-top: none; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-top-left-radius: 0; -webkit-border-top-left-radius: 0; -moz-border-radius-topleft: 0; border-top-right-radius: 0; -webkit-border-top-right-radius: 0; -moz-border-radius-topright: 0;">16</div>
									</div>

									Actividad 1<br>
									<small>17:00h - 17:30h</small>
								</a>
							</li>
							<li>
								<a href="#" style="display: block;">
									<div class="pull-left" style="width: 45px; margin-right: 15px;">
										<div style="background-color: #dd4814; text-transform: uppercase; font-size: 0.875em; font-weight: 400; text-align: center; border: 1px solid #dedede; color: #fff; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-bottom-left-radius: 0; -webkit-border-bottom-left-radius: 0; -moz-border-radius-bottomleft: 0; border-bottom-right-radius: 0; -webkit-border-bottom-right-radius: 0; -moz-border-radius-bottomright: 0;">oct</div>
										<div style="text-align: center; border: 1px solid #dedede; color: #777; border-top: none; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-top-left-radius: 0; -webkit-border-top-left-radius: 0; -moz-border-radius-topleft: 0; border-top-right-radius: 0; -webkit-border-top-right-radius: 0; -moz-border-radius-topright: 0;">16</div>
									</div>

									Actividad 2<br>
									<small>17:00h - 17:30h</small>
								</a>
							</li>
						</ul>
					</div>

				</div>

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

			<section class="" style="margin-bottom: 40px;">
				<div class="title-module">
						<h4>Erasmus+ de la EACEA</h4>
					</div>

					<a href="#" data-toggle="modal" data-target="#modal_erasmus">
						<img class="img-responsive img-thumbnail" src="<?php echo base_url().'assets/img/erasmus_charter.jpg'; ?>" alt="Erasmus+ de la EACEA">
					</a>

				</div>

				<div class="modal fade" id="modal_erasmus" tabindex="-1" role="dialog">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Erasmus+ de la EACEA</h4>
				      </div>
				      <div class="modal-body">
				        <img class="img-responsive img-thumbnail" src="<?php echo base_url().'assets/img/erasmus_charter.jpg'; ?>" alt="Erasmus+ de la EACEA">
				      </div>
				    </div>
				  </div>
				</div>
			</section>

		</div><!-- /col-md-4 -->

	</div><!-- /.row -->

</div><!-- /.container -->
