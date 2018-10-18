<?php
require_once("../../bootstrap.php");
require_once("../../config.php");

$tutorias = array();
$result = mysqli_query($db_con, "SELECT DISTINCT `unidades`.`nomunidad`, `FTUTORES`.`tutor` FROM `unidades` JOIN `FTUTORES` ON `unidades`.`nomunidad` = `FTUTORES`.`unidad` ORDER BY `unidades`.`nomunidad` ASC");
while ($row = mysqli_fetch_array($result)) {

  $result_horario = mysqli_query($db_con, "SELECT `dia`, `hora` FROM `horw` WHERE `c_asig` = '117' AND (`a_grupo` = '".$row['nomunidad']."' OR `prof` = '".$row['tutor']."') LIMIT 1");
  $row_horario = mysqli_fetch_array($result_horario);
  $horario = obtenerHoraTutoria($db_con, $row_horario['dia'], $row_horario['hora']);
  if (empty($horario)) $horario = '<i>Sin definir</i>';
  mysqli_free_result($result_horario);

  $cursos = array();
  $result_cursos = mysqli_query($db_con, "SELECT `cursos`.`nomcurso` FROM `cursos` JOIN `unidades` ON `cursos`.`idcurso` = `unidades`.`idcurso` WHERE `unidades`.`nomunidad` = '".$row['nomunidad']."' ORDER BY `cursos`.`nomcurso` ASC");
  while ($row_cursos = mysqli_fetch_array($result_cursos)) {
    array_push($cursos, $row_cursos['nomcurso']);
  }

  $nomtutor = nombreProfesorTitle($row['tutor']);
  $exp_nomtutor = explode(',', $nomtutor);
  $nomtutor = $exp_nomtutor[1].' '.$exp_nomtutor[0];

  $tutoria = array(
  		'unidad'	=> $row['nomunidad'],
      'cursos'  => $cursos,
      'tutor'		=> $nomtutor,
      'horario'	=> $horario
  );

  array_push($tutorias, $tutoria);
  unset($row_horario);
  unset($horario);
}
mysqli_free_result($result);
unset($tutoria);


$pagina['titulo'] = 'Tutorías';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Tutorías y horarios de atención a padres del ".$config['centro_denominacion'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row">

                <div class="col-sm-12">

									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Unidad</th>
												<th>Tutor/a</th>
												<th>Horario de atención</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($tutorias as $tutoria): ?>
											<tr>
												<td>
													<h6><?php echo $tutoria['unidad']; ?></h6>
                          <?php foreach ($tutoria['cursos'] as $curso): ?>
                          <small class="text-muted"><?php echo $curso; ?></small><br>
                          <?php endforeach; ?>
												</td>
												<td><?php echo $tutoria['tutor']; ?></td>
												<td><?php echo $tutoria['horario']; ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>

                </div>

            </div>
        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>
