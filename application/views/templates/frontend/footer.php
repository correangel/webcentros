    <footer>

    	<div class="container">

    		<div class="pull-left nofloat-xs">
    			<p style="display: inline;">&copy; <?php echo date('Y'); ?> <?php echo $this->config->item('centro_denominacion'); ?>. Todos los derechos reservados.</p>
    			<ol class="list-inline" style="display: inline;">
    				<li><?php echo anchor('aviso-legal/', 'Aviso legal'); ?></li>
    				<li><?php echo anchor('cookies/', 'Uso de cookies'); ?></li>
    			</ol>
    		</div>

    		<div class="pull-right nofloat-xs">
    			<ol class="list-inline">
    				<?php if ($this->config->item('social_facebook')): ?>
    				<li>
    					<a href="<?php echo $this->config->item('social_facebook'); ?>" target="_blank">
    						<span class="icon-social icon-facebook fa-stack fa-lg icon-gray">
    						  <i class="fa fa-circle fa-stack-2x"></i>
    						  <i class="fa fa-facebook fa-stack-1x"></i>
    						</span>
    					</a>
    				</li>
    				<?php endif; ?>
    				<?php if ($this->config->item('social_twitter')): ?>
    				<li>
    					<a href="<?php echo $this->config->item('social_twitter'); ?>" target="_blank">
    						<span class="icon-social icon-twitter fa-stack fa-lg icon-gray">
    						  <i class="fa fa-circle fa-stack-2x"></i>
    						  <i class="fa fa-twitter fa-stack-1x"></i>
    						</span>
    					</a>
    				</li>
    				<?php endif; ?>
    				<?php if ($this->config->item('social_gplus')): ?>
    				<li>
    					<a href="<?php echo $this->config->item('social_gplus'); ?>" target="_blank">
    						<span class="icon-social icon-google-plus fa-stack fa-lg icon-gray">
    						  <i class="fa fa-circle fa-stack-2x"></i>
    						  <i class="fa fa-google-plus fa-stack-1x"></i>
    						</span>
    					</a>
    				</li>
    				<?php endif; ?>
    				<?php if ($this->config->item('social_youtube')): ?>
    				<li>
    					<a href="<?php echo $this->config->item('social_youtube'); ?>" target="_blank">
    						<span class="icon-social icon-youtube fa-stack fa-lg icon-gray">
    						  <i class="fa fa-circle fa-stack-2x"></i>
    						  <i class="fa fa-youtube fa-stack-1x"></i>
    						</span>
    					</a>
    				</li>
    				<?php endif; ?>
    			</ol>
    		</div>

    	</div>


    </footer>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>

    <script>
	$(function(){

		$('[data-toggle="tooltip"]').tooltip()

		$(".navbar-toggle").click(function() {
			$("span.fa-toggle").toggle();
		});

		<?php if (! $this->agent->is_mobile()): ?>
		$(document).ready(function(){
		    $(".dropdown").hover(
		        function() {
		            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).show();
		            $(this).toggleClass('open');
		        },
		        function() {
		            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).hide();
		            $(this).toggleClass('open');
		        }
		    );
		});
		<?php endif; ?>

	});

	$(document).ready(function(){
	    $(".fancybox").fancybox({
	    	prevEffect		: 'none',
			nextEffect		: 'none',
			closeBtn		: false,
			helpers		: {
				title	: { type : 'inside' },
				buttons	: {}
			}
	    });
	});
    </script>

</body>
</html>
