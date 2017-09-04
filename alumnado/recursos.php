<?php defined('INTRANET_DIRECTORY') OR exit('No direct script access allowed'); 

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
?>

<a name="recursos"></a>
<h3>Recursos educativos</h3>

<br>
<?php $doc_dir = "../documentos/uploads/"; ?>
<?php $unidad_dir = "Recursos educativos/$unidad/"; ?>
<?php $directory = isset($_GET['directory']) ? $_GET['directory'].'/' : ''; ?>
<?php $list = glob($doc_dir.$unidad_dir.$directory."*"); ?> 

<?php if($directory != ""): ?>
<ol class="breadcrumb">
  <li><a href="index.php?mod=recursos">Inicio</a></li>
  <?php $exp_directory = explode('/', rtrim($directory, '/')); ?>
  <?php foreach ($exp_directory as $split_directory): ?>
  <li><a href="index.php?mod=recursos&amp;directory=<?php echo $split_directory; ?>"><?php echo $split_directory; ?></a></li>
  <?php endforeach; ?>
</ol>
<?php endif; ?>

<?php if($list): ?>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Tamaño</th>
      <th>Descargar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($list as $file): ?>
    <?php $exp_filename = explode('/', $file); ?>
    <?php $filename = array_pop($exp_filename); ?>
    <tr>
    	<?php if(is_dir($file)): ?>
    	<td><a href="index.php?mod=recursos&amp;directory=<?php echo $directory.$filename; ?>"><?php echo $filename; ?></a></td>
    	<td>Carpeta</td>
    	<td></td>
    	<?php else: ?>
    	<td><?php echo $filename; ?></td>
    	<td><?php echo human_filesize(filesize($file)); ?></td>
    	<td><a href="../documentos/index.php?action=downloadfile&amp;filename=<?php echo $filename; ?>&amp;directory=<?php echo rtrim($unidad_dir, '/').rtrim('/'.$directory, '/'); ?>"><span class="fa fa-download fa-fw"></span> Descargar</a></td>
    	<?php endif; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>

<h3 class="text-muted">No hay recursos educativos en este directorio.</h3>
<br>

<?php endif; ?>