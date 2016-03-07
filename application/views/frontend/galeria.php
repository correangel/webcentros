<div id="content" class="container">
		
	<div class="row">
		
		<?php foreach ($galeria as $item_galeria): ?>
		<?php if (stristr($item_galeria->fechapub, '2015') == TRUE && $item_galeria->numfotos): ?>
		<div class="col-xs-6 col-sm-4 col-md-3">
			<div class="thumbnail">
				<a href="<?php echo 'imagenes/'.$item_galeria->alias.'/'; ?>">
					<?php if($item_galeria->imagen): ?>
					<img class="img-responsive" src="data:image/jpg;base64,<?php echo base64_encode($item_galeria->imagen); ?>" alt="<?php echo $item_galeria->titulo; ?>">
					<?php else: ?>
					<img class="img-responsive" src="http://placehold.it/350x250" alt="<?php echo $item_galeria->titulo; ?>">
					<?php endif; ?>
					<div class="caption" style="position: absolute; width: 253px; bottom: 0; color: #fff; margin-bottom: 20px;">
						<h4 class="album-title" style="font-weight: 400; color: #fff; text-shadow: 0 1px 1px black; line-height: 20px; word-break: break-word; margin: 0"><?php echo $item_galeria->titulo; ?></h4>
						<span style="text-shadow: 0 1px 1px black; font-weight: 500;"><?php echo $item_galeria->numfotos; ?> fotos <span class="metadot" style="margin: 0 5px; font-size: 18px; font-weight: 800">&middot;</span> <?php //echo $item_galeria->vistas; ?> vistas</span>
					</div>
			     </a>
		    </div>
		</div>
		<?php endif; ?>
		<?php endforeach; ?>
		
	</div>

</div><!-- /.container -->
