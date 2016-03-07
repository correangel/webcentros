<div id="content" class="container">

	<?php
	if ($contenido->ruta) {
		$data = file_get_contents($contenido->ruta);
		
		preg_match_all('/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/', $data, $coincidencias, PREG_SET_ORDER);
		
		$i = 0;
		foreach ($coincidencias as $valor) {
		
			if ($i == 12) {
				$valor[0] = str_replace('<a href="/todofp/' ,'<a target="_blank" href="http://www.todofp.es/todofp/', $valor[0]);
			    echo $valor[0].'</div></div>';
		   	}
		    $i++;
		}
	}
	else {
		echo $contenido->contenido;
	}
	?>

</div><!-- /.container -->