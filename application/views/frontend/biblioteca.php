<div id="content" class="container">
	
	<div class="row">
		
		<div class="col-sm-3" style="margin-top: 15px;">
		
			<form method="get" action="">
				
				<fieldset>
					<legend>Buscar libro</legend>
					
					<div class="form-group">
						<label for="autor">Autor</label>
						<input type="text" class="form-control" id="autor" name="autor" value="<?php echo $this->input->get('autor'); ?>" maxlength="120">
					</div>
				
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $this->input->get('titulo'); ?>" maxlength="120">
					</div>
				
					<div class="form-group">
						<label for="editorial">Editorial</label>
						<input type="text" class="form-control" id="editorial" name="editorial" value="<?php echo $this->input->get('editorial'); ?>" maxlength="120">
					</div>
				
					<div class="form-group">
						<label for="isbn">ISBN</label>
						<input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $this->input->get('isbn'); ?>" maxlength="120">
					</div>
						
					<button type="submit" class="btn btn-primary btn-block" style="margin-top: 24px;">Buscar libro</button>
					
				</fieldset>
				
			</form>
			
		</div>
		
		<div class="col-sm-9">
		
			<?php if ($buscar == true && count($libros) > 0): ?>
			<div id="resultados">
			
				<h3>Resultados de la búsqueda (<?php echo $res = count($libros); ?> resultado<?php if($res > 1) echo 's'; ?>)</h3>
			
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>ISBN</th>
							<th>Título</th>
							<th>Autor</th>
							<th>Editorial</th>
							<th>Págs.</th>
							<th>Año de edición</th>
							<th>Ubicación</th>
							<th>Ejemp.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($libros as $libro): ?>
						<tr>
							<td nowrap><?php echo stripslashes($libro->ISBN); ?></td>
							<td><?php echo stripslashes($libro->Titulo); ?></td>
							<td><?php echo stripslashes($libro->Autor); ?></td>
							<td><?php echo stripslashes($libro->Editorial); ?></td>
							<td><?php echo stripslashes($libro->extension); ?></td>
							<td><?php echo stripslashes($libro->anoEdicion); ?></td>
							<td><?php echo stripslashes($libro->ubicacion); ?></td>
							<td><?php echo stripslashes($libro->ejemplares); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			
			</div>
			
			<?php elseif ($buscar == true && count($libros) == 0): ?>
			
			<div class="text-center text-muted" style="margin-top: 120px;">
				<span class="fa fa-book fa-5x"></span>
				<h4>No se han encontrado ejemplares con los datos proporcionados</h4>
				<p>Escriba el nombre del autor, título, editorial o ISBN del libro que desea buscar.</p>
			</div>
			
			<?php else: ?>
				
			<div class="text-center text-muted" style="margin-top: 120px;">
				<span class="fa fa-book fa-5x"></span>
				<h4>Actualmente tenemos <?php echo $tlibros = number_format($info_bd['rows'], 0, ',', '.'); ?> libro<?php if ($tlibros > 1) echo 's'; ?> registrado<?php if ($tlibros > 1) echo 's'; ?></h4>
				<p>Escriba el nombre del autor, título, editorial o ISBN del libro que desea buscar.</p>
				<p><small>Última actualización el <?php echo strftime('%e.%m.%Y a las %H:%Mh', strtotime($info_bd['update_time'])); ?></small></p>
			</div>
			
			<?php endif; ?>
			
		</div>
	
	</div>
	

</div><!-- /.container -->