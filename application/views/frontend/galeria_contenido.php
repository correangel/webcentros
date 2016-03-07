<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">


<style type="text/css">
.gallery
{
    display: inline-block;
    margin-top: 20px;
}
</style>
  

<div id="content" class="container">
	
	<div class="row">
		
		<div class="list-group gallery">
			<?php foreach ($galeria as $item): ?>
			<div class="col-sm-4 col-xs-6 col-md-3 col-lg-3">
			    <a class="thumbnail fancybox" rel="ligthbox" href="data:image/jpeg;base64,<?php echo base64_encode($item->imagen); ?>" title="<?php echo $item->nombre; ?> <?php echo ($item->descripcion) ? '- '.$item->descripcion : ''; ?>">
			        <img class="img-responsive" alt="<?php echo $item->nombre; ?>" src="data:image/jpeg;base64,<?php echo base64_encode($item->imagen); ?>" />
			    </a>
			</div>
			<?php endforeach; ?>
		</div>
		
	</div>

</div><!-- /.container -->