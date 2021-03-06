<?php
require_once('../bootstrap.php');
require_once('../config.php');
require_once("../intranet/pdf/mc_table.php");

class GranPDF extends PDF_MC_Table {
	function Header() {
		$this->SetTextColor(0, 122, 61);
		$this->Image( '../intranet/img/encabezado.jpg',25,14,53,'','jpg');
		$this->SetFont('ErasDemiBT','B',10);
		$this->SetY(15);
		$this->Cell(75);
		$this->MultiCell(170, 5, 'CONSEJERÍA DE EDUCACIÓN', 0,'R', 0);
		$this->Ln(15);
	}
	function Footer() {
		$this->SetTextColor(0, 122, 61);
		$this->Image( '../intranet/img/pie.jpg', 0, 160, 24, '', 'jpg' );
	}
}

if (! isset($config['alumnado']['ver_informes_tareas']) || ! $config['alumnado']['ver_informes_tareas']) {
	header('Location:'.'index.php');
	exit();
}
elseif(isset($_POST['id']) && !empty($_POST['id'])) {
	$id = $_POST['id'];
}
else {
	header('Location:'.'index.php');
	exit();
}

$MiPDF = new GranPDF('L', 'mm', 'A4');

$MiPDF->AddFont('NewsGotT','','NewsGotT.php');
$MiPDF->AddFont('NewsGotT','B','NewsGotTb.php');
$MiPDF->AddFont('ErasDemiBT','','ErasDemiBT.php');
$MiPDF->AddFont('ErasDemiBT','B','ErasDemiBT.php');
$MiPDF->AddFont('ErasMDBT','','ErasMDBT.php');
$MiPDF->AddFont('ErasMDBT','I','ErasMDBT.php');

$MiPDF->SetMargins(25, 20, 20);
$MiPDF->SetDisplayMode('fullpage');

$titulo = "Informe de tareas por expulsión";
$cuerpo = "";


$MiPDF->Addpage();

$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->Multicell(0, 5, mb_strtoupper($titulo, 'UTF-8'), 0, 'C', 0 );
$MiPDF->Ln(5);


$MiPDF->SetFont('NewsGotT', '', 12);


// INFORMACION DEL ALUMNO
$result = mysqli_query($db_con, "SELECT apellidos, nombre, tareas_alumnos.unidad, tareas_alumnos.id, tutor, fecha, duracion, claveal FROM tareas_alumnos, FTUTORES WHERE FTUTORES.unidad = tareas_alumnos.unidad and id='$id'");

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($row['claveal'] != $_SESSION['claveal']) {
	header('Location:'.'index.php');
	exit();
}

$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->Cell(25, 5, 'Alumno/a: ', 0, 0, 'L', 0);
$MiPDF->SetFont('NewsGotT', '', 12);
$MiPDF->Cell(80, 5, $row['apellidos'].', '.$row['nombre'], 0, 0, 'L', 0 );

$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->Cell(40, 5, 'Fecha de expulsión: ', 0, 0, 'L', 0);
$MiPDF->SetFont('NewsGotT', '', 12);
$MiPDF->Cell(55, 5, strftime('%e de %B de %Y',strtotime($row['fecha'])), 0, 0, 'L', 0 );

$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->Cell(15, 5, 'Días: ', 0, 0, 'L', 0);
$MiPDF->SetFont('NewsGotT', '', 12);
$MiPDF->Cell(15, 5, $row['duracion'], 0, 1, 'L', 0 );

$MiPDF->Ln(2);

$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->Cell(20, 5, 'Unidad: ', 0, 0, 'L', 0);
$MiPDF->SetFont('NewsGotT', '', 12);
$MiPDF->Cell(85, 5, $row['unidad'], 0, 0, 'L', 0 );

$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->Cell(20, 5, 'Tutor/a: ', 0, 0, 'L', 0);
$MiPDF->SetFont('NewsGotT', '', 12);
$MiPDF->Cell(40, 5, mb_convert_case($row['tutor'], MB_CASE_TITLE, "UTF-8"), 0, 1, 'L', 0 );

$MiPDF->Ln(5);

mysqli_free_result($result);


// TAREAS

$MiPDF->SetWidths(array(70, 65, 120));
$MiPDF->SetFont('NewsGotT', 'B', 12);
$MiPDF->SetTextColor(255, 255, 255);
$MiPDF->SetFillColor(61, 61, 61);

$MiPDF->Row(array('Asignatura / Materia', 'Profesor/a', 'Tarea'), 0, 6);	

$result = mysqli_query($db_con, "SELECT asignatura, tarea, confirmado, profesor FROM tareas_profesor WHERE id_alumno='$id'");

$MiPDF->SetTextColor(0, 0, 0);
$MiPDF->SetFont('NewsGotT', '', 12);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$MiPDF->Row(array($row['asignatura'], $row['profesor'], $row['tarea']), 1, 6);	
}

mysqli_free_result($result);


// SALIDA

$MiPDF->Output('Informe de tareas '.$id.'.pdf','D');

?>