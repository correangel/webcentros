		
		<div id="content" class="container">
			
			<div class="text-center" style="margin: 40px 0;">
				<h2><?php echo $this->config->item('centro_denominacion'); ?><br><small>Centro código <?php echo $this->config->item('centro_codigo'); ?></small></h2>
				<ul class="list-unstyled contact-info">
					<li><span class="fa fa-map-marker fa-fw"></span> <?php echo $this->config->item('centro_direccion'); ?><br><?php echo $this->config->item('centro_codpostal'); ?>, <?php echo $this->config->item('centro_localidad'); ?> (<?php echo $this->config->item('centro_provincia'); ?>)</li>
					<li><span class="fa fa-phone fa-fw"></span> Telf. <?php echo telefono($this->config->item('centro_telefono')); ?>&nbsp;/&nbsp;Fax. <?php echo telefono($this->config->item('centro_fax')); ?></li>
					<li><span class="fa fa-envelope fa-fw"></span> <?php echo safe_mailto($this->config->item('centro_correoe'), $this->config->item('centro_correoe')); ?></li>
				</ul>
			</div>
			
			<div class="row">
			
				<div class="col-sm-8 col-sm-offset-2">
				
					<form method="post" action="">
						
						<fieldset>
							
							<div class="row">
								
								<div class="col-sm-4">
									<div class="form-group">
										<label class="visible-xs" for="name">Nombre:</label>
										<input type="text" class="form-control" name="name" value="" placeholder="Nombre">
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label class="visible-xs" for="email">Correo electrónico:</label>
										<input type="text" class="form-control" name="email" value="" placeholder="Correo electrónico">
									</div>
								</div>
								
								<div class="col-sm-4">
									<div class="form-group">
										<label class="visible-xs" for="phone">Teléfono:</label>
										<input type="text" class="form-control" name="phone" value="" placeholder="Teléfono">
									</div>
								</div>
								
							</div>

							<div class="form-group">
								<label class="visible-xs" for="message">Mensaje:</label>
								<textarea class="form-control" name="message" placeholder="Mensaje" rows="4"></textarea>
							</div>
							
							<p class="text-center text-muted">
								<small><span class="text-danger">* Todos los campos son obligatorios.</span> Una vez que recibamos su mensaje le responderemos tan pronto como sea posible.</small>
							</p>
							
							<div class="text-center">
								<button class="btn btn-primary" name="send">Enviar</button>
							</div>
						
						</fieldset>
						
					</form>
				
				</div>
			
			</div>
			
		</div>
		
		<div style="margin-bottom: 80px;"></div>
		
		
		<!-- GOOGLE MAPS -->
		<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&amp;v=3.exp"></script>
		<script>
        function initialize() {
          var myLatlng = new google.maps.LatLng(36.429595, -5.154449);
          var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: {lat: 36.429595, lng: -5.154449},
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
        
          var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
          
          var contentString = '<div id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<div id="bodyContent">'+
              '<address><h5><strong><?php echo $this->config->item('centro_denominacion'); ?> (<?php echo $this->config->item('centro_codigo'); ?>)</strong></h5><?php echo $this->config->item('centro_direccion'); ?><br><?php echo $this->config->item('centro_codpostal'); ?>, <?php echo $this->config->item('centro_localidad'); ?> (<?php echo $this->config->item('centro_provincia'); ?>)<br><abbr title="Teléfono">Tlf.:</abbr> <?php echo telefono($this->config->item('centro_telefono')); ?> Fax: <?php echo telefono($this->config->item('centro_fax')); ?><br><?php echo $this->config->item('centro_correoe'); ?></address>'+
              '</div>'+
              '</div>';
        
          var infowindow = new google.maps.InfoWindow({
              content: contentString,
              maxWidth: 300
          });
          

        
          var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: '<?php echo $this->config->item('centro_denominacion'); ?>',
              icon: '<?php echo base_url().'assets/img/mark.png'; ?>',
          });
          
         infowindow.open(map,marker);
        }
        
        google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		
		<div id="map-canvas"></div>