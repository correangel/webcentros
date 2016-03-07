<div id="content" class="container">
	
	<?php foreach ($libros as $libro): ?>
	<h2><?php echo $libro['nivel']; ?></h2>
	
	<table class="table table-bordered table-condensed table-striped table-hover">
		<thead>
			<tr>
				<th class="visible-xs">Libros de texto</th>
				<th class="hidden-xs col-sm-3">Asignatura / Materia</th>
				<th class="hidden-xs col-sm-3">Título del libro</th>
				<th class="hidden-xs col-sm-2">ISBN</th>
				<th class="hidden-xs col-sm-3">Autor</th>
				<th class="hidden-xs col-sm-1">Tipo</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i = 0; $i < count($libro['libros']); $i++): ?>
			<tr>
				<th class="visible-xs">
					<h5><?php echo $libro['libros'][$i]->titulo; ?></h5>
					<p><small>Autor: <?php echo $libro['libros'][$i]->autor; ?></small></p>
					<p><small>ISBN: <?php echo $libro['libros'][$i]->isbn; ?></small></p>
					<p><small>Tipo: <?php echo $libro['libros'][$i]->obligatorio; ?></small></p>
				</th>
				<td class="hidden-xs"><?php echo $libro['libros'][$i]->asignatura; ?></td>
				<td class="hidden-xs"><?php echo $libro['libros'][$i]->titulo; ?></td>
				<td class="hidden-xs"><?php echo $libro['libros'][$i]->isbn; ?></td>
				<td class="hidden-xs"><?php echo $libro['libros'][$i]->autor; ?></td>
				<td class="hidden-xs"><?php echo $libro['libros'][$i]->obligatorio; ?></td>
			</tr>
			<?php endfor; ?>
		</tbody>
	</table>
	
	<br>
	<?php endforeach; ?>

</div><!-- /.container -->