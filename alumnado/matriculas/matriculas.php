<?
require_once("../../bootstrap.php");
require_once('../../config.php');

// COMPROBAMOS LA SESION
if ($_SESSION['alumno_autenticado'] != 1) {
	$_SESSION = array();
	session_destroy();

	header('Location:'.WEBCENTROS_DOMINIO.'alumnado/logout.php');
	exit();
}

$claveal = $_SESSION['claveal'];

if (isset($_POST['curso'])) {
	$curso = $_POST['curso'];
}
elseif (isset($_GET['curso'])) {
	$curso = $_GET['curso'];
}
?>
<?
// Divorcios
$divorciados = array(
array(
													'id'     => 'Guarda y Custodia compartida por Madre y Padre',
													'nombre' => 'Guarda y Custodia compartida por Madre y Padre',
),
array(
													'id'     => 'Guarda y Custodia de la Madre',
													'nombre' => 'Guarda y Custodia de la Madre',
),
array(
													'id'     => 'Guarda y Custodia del Padre',
													'nombre' => 'Guarda y Custodia del Padre',
),
);


// Enfermedades
$enfermedades = array(
array(
													'id'     => 'Celiaquía',
													'nombre' => 'Celiaquía',
),
array(
													'id'     => 'Alergias a alimentos',
													'nombre' => 'Alergias a alimentos',
),
array(
													'id'     => 'Alergias respiratorias',
													'nombre' => 'Alergias respiratorias',
),
array(
													'id'     => 'Asma',
													'nombre' => 'Asma',
),
array(
													'id'     => 'Convulsiones febriles',
													'nombre' => 'Convulsiones febriles',
),
array(
													'id'     => 'Diabetes',
													'nombre' => 'Diabetes',
),
array(
													'id'     => 'Epilepsia',
													'nombre' => 'Epilepsia',
),
array(
													'id'     => 'Insuficiencia cardíaca',
													'nombre' => 'Insuficiencia cardíaca',
),
array(
													'id'     => 'Insuficiencia renal',
													'nombre' => 'Insuficiencia renal',
),
array(
													'id'     => 'Otra enfermedad',
													'nombre' => 'Otra enfermedad',
),
);

$transporte_este = array(
array(
												'id'     => 'Urb. Mar y Monte',
												'nombre' => 'Urb. Mar y Monte',
),
array(
												'id'     => 'Urb. Diana - Isdabe',
												'nombre' => 'Urb. Diana - Isdabe',
),
array(
												'id'     => 'Benamara - Benavista',
												'nombre' => 'Benamara - Benavista',
),
array(
												'id'     => 'Bel-Air',
												'nombre' => 'Bel-Air',
),
array(
												'id'     => 'Parada Bus Portillo Cancelada',
												'nombre' => 'Parada Bus Portillo Cancelada',
),
array(
												'id'     => 'Parque Antena',
												'nombre' => 'Parque Antena',
),
array(
												'id'     => 'El Pirata',
												'nombre' => 'El Pirata',
),
array(
												'id'     => 'El Velerín',
												'nombre' => 'El Velerín',
),
array(
												'id'     => 'El Padrón',
												'nombre' => 'El Padrón',
),
array(
												'id'     => 'Mc Donalds',
												'nombre' => 'Mc Donalds',
),
);

$transporte_oeste = array(
array(
												'id'     => 'Buenas Noches',
												'nombre' => 'Buenas Noches',
),
array(
												'id'     => 'Costa Galera',
												'nombre' => 'Costa Galera',
),
array(
												'id'     => 'Bahía Dorada',
												'nombre' => 'Bahía Dorada',
),
array(
												'id'     => 'Don Pedro',
												'nombre' => 'Don Pedro',
),
array(
												'id'     => 'Bahía Azul',
												'nombre' => 'Bahía Azul',
),
array(
												'id'     => 'G. Shell - H10',
												'nombre' => 'G. Shell - H10',
),
array(
												'id'     => 'Seghers Bajo (Babylon)',
												'nombre' => 'Seghers Bajo (Babylon)',
),
array(
												'id'     => 'Seghers Alto (Ed. Sierra Bermeja)',
												'nombre' => 'Seghers Alto (Ed. Sierra Bermeja)',
),
);

// OPTATIVAS Y MODALIDADES DE LOS DISTINTOS NIVELES
include("../../intranet/admin/matriculas/config.php");

if($_POST['enviar'] =="Enviar los datos de la Matrícula"){

	foreach($_POST as $key => $val)
	{
		//echo"$key => $val<br />";
		${$key}=$val;
	}


	$nacimiento = str_replace("/","-",$nacimiento);
	$fecha0 = explode("-",$nacimiento);
	$fecha_nacimiento = "$fecha0[2]-$fecha0[1]-$fecha0[0]";
	$campos = "apellidos nombre nacido provincia nacimiento domicilio localidad padre dnitutor telefono1 telefono2 religion colegio optativa1 optativa2 optativa3 optativa4 sexo nacionalidad ";
	if (substr($curso,0,1)>1) {
		$campos.="optativa21 optativa22 optativa23 optativa24 ";
		if (substr($curso,0,1)=='4') {
			$campos.="optativa25 optativa26 optativa27 ";
		}
	}
	if (substr($curso,0,1)=='3') {
		$campos.="optativa5 optativa6 optativa7 ";
	}
	if (substr($curso,0,1)>3) {
		$campos.="itinerario ";
	}

	foreach($_POST as $key => $val)
	{
		if(strstr($campos,$key." ")==TRUE){
			if($val == ""){
				$vacios.= $key.", ";
				$num+=1;
			}
		}

	}
	if (substr($curso,0,1)=='3') {
		if (empty($matematicas3)) {
		$vacios.= "matematicas de 3º de ESO, ";
		$num+=1;
		}
	}
	if (substr($curso,0,1)<'4') {
		if (empty($act1)) {
		$vacios.= "Refuerzo o Ampliación de $curso, ";
		$num+=1;
		}
	}
	if ($itinerario) {
		if($itinerario == '2' and !empty($optativas4)){
			$optativas4="";
		}
		foreach ($opt4 as $opt){
			foreach ($_POST as $clave=>$valor){
				if (strstr($clave,$opt)==TRUE) {
					$n_o+=1;
					${optativa.$n_o}=$valor;
					if(${optativa.$n_o} == ""){
						$vacios.= "optativa".$n_o.", ";
						$num+=1;
					}
				}
			}
		}
	}
	if (($itinerario == '1' or $itinerario == '3') and empty($optativas4)) {
		$vacios.= "optativas4, ";
		$num+=1;
	}
		if ($itinerario == '1' and empty($ciencias4)) {
		$vacios.= "ciencias de 4 ESO, ";
		$num+=1;
	}
	if ($religion == "") {
		$vacios.= "religion, ";
		$num+=1;
	}
	if ($sexo == "") {
		$vacios.= "sexo, ";
		$num+=1;
	}
	// Control de errores
	if($num > 0){
		$adv = substr($vacios,0,-2);
		echo '
<script> 
 alert("Los siguientes datos son obligatorios y no los has rellenado en el formulario de inscripción:\n ';
		$num_cur = substr($curso,0,1);
		$num_cur_ant = $num_cur - 1;
		$cur_act = substr($curso,0,1)."º de ESO";
		$cur_ant = $num_cur_ant . "º de ESO";
		for ($i=1;$i<8;$i++){
			$adv= str_replace("optativa2$i", "optativa de $cur_ant $i", $adv);
		}
		for ($i=1;$i<5;$i++){
			$adv= str_replace("optativa$i", "optativa de $cur_act  $i", $adv);
		}
		echo $adv.'.\n';
		echo 'Rellena los campos mencionados y envía los datos de nuevo para poder registrar tu solicitud correctamente.")
 </script>
';
	}
	else{
		if (substr($curso,0,1)==4){
			if ($optativa1==$optativa2) {
				$opt_rep4 = 1;
			}				
		}
		else{
			for ($i = 1; $i < 8; $i++) {
				for ($z = $i+1; $z < 8; $z++) {
					if (${optativa.$i}>0) {
						if (${optativa.$i}==${optativa.$z}) {
							$opt_rep = 1;
						}
					}

				}
			}
		}
		if (substr($curso,0,1)>1){
			for ($i = 1; $i < 8; $i++) {
				for ($z = $i+1; $z < 8; $z++) {
					if (${optativa2.$i}>0) {
						if (${optativa2.$i}==${optativa2.$z}) {
							$opt_rep2="1";
						}
					}

				}
			}
		}
		if($colegio == "Otro Centro" and ($otrocolegio == "" or $otrocolegio == "Escribe aquí el nombre del Centro")){
			$vacios.="otrocolegio ";
			echo '
<script> 
 alert("No has escrito el nombre del Centro del que procede el alumno.\n';
			echo 'Rellena el nombre del Centro y envía los datos de nuevo para poder registrar tu solicitud correctamente.")
 </script>
';
		}
		elseif(strstr($nacimiento,"-") == FALSE){
			echo '
<script> 
 alert("ATENCIÓN:\n ';
			echo 'La fecha de nacimiento que has escrito no es correcta.\nEl formato adecuado para la fecha  es: dia-mes-año (01-01-1998).")
 </script>
';
		}
		elseif(strlen($ruta_este) > 0 and strlen($ruta_oeste) > 0){
			echo '
<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado dos rutas incompatibles para el Transporte Escolar, y sólo puedes seleccionar una ruta, hacia el Este o hacia el Oeste de Estepona.\nElige una sola parada y vuelve a enviar los datos.")
 </script>
';
			$ruta_error = "";
		}
		elseif(strlen($ruta_este) > 0 and strlen($ruta_oeste) > 0){
			echo '
<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado dos rutas incompatibles para el Transporte Escolar, y sólo puedes seleccionar una ruta, hacia el Este o hacia el Oeste de Estepona.\nElige una sola parada y vuelve a enviar los datos.")
 </script>
';
			$ruta_error = "";
		}
		elseif($enfermedad == "Otra enfermedad" and ($otraenfermedad == "" or $otraenfermedad == "Escribe aquí el nombre de la enfermedad")){
			$vacios.="otraenfermedad ";
			$msg_error = "No has escrito el nombre de la enfermedad del alumno. Rellena el nombre de la enfermedad y envía los datos de nuevo para poder registrar tu solicitud correctamente.";
		}
		elseif ($opt_rep=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado el mismo número de preferencia para varias optativas, y cada optativa debe tener un número de preferencia distinto.\nElige las optativas sin repetir el número de preferencia e inténtalo de nuevo.")
 </script>
';
		}
		elseif ($opt_rep2=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado el mismo número de preferencia para varias optativas del curso anterior, y cada optativa debe tener un número de preferencia distinto.\nElige las optativas del curso anterior sin repetir el número de preferencia e inténtalo de nuevo.")
 </script>
';
		}
		elseif ($opt_rep4=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado erroneamente la misma optativa en los dos campos en 4º de la ESO. Elige las optativas sin repetirlas e inténtalo de nuevo.")
 </script>
';
		}
		elseif (($itinerario == 1 and (stristr($optativas4,"ciencias")==TRUE or stristr($optativas4,"iniciac")==TRUE)) or ($itinerario == 3 and (stristr($optativas4,"biolog")==TRUE or stristr($optativas4,"econom")==TRUE))){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Has elegido una optativa de modalidad incompatible con el Itinerario seleccionado.\nElige la optativa correspondiente debajo del  Itinerario seleccionado e inténtalo de nuevo.")
 </script>
';
		}
		else{
			if (strlen($claveal) > 3) {$extra = " claveal = '$claveal'";}
			elseif (strlen($dni) > 3) {$extra = " dni = '$dni'";}
			else {$extra = " dnitutor = '$dnitutor' ";}

			// El alumno ya se ha registrado anteriormente
			$ya_esta = mysqli_query($db_con,"select id from matriculas where $extra");
			if (mysqli_num_rows($ya_esta) > 0) {
				$ya = mysqli_fetch_array($ya_esta);
				if (strlen($ruta_este) > 0 or strlen($ruta_oeste) > 0) {$transporte = '1';}
				if(!($itinerario=='1') and !($itinerario=='3')){$optativas4="";}
				if (empty($foto)) { $foto = "0";}
				$insert = "update matriculas set apellidos='$apellidos', nombre='$nombre', nacido='$nacido', provincia='$provincia', nacimiento='$fecha_nacimiento', domicilio='$domicilio', localidad='$localidad', dni='$dni', padre='$padre', dnitutor='$dnitutor', madre='$madre', dnitutor2='$dnitutor2', telefono1='$telefono1', telefono2='$telefono2', religion='$religion', colegio='$colegio', optativa1='$optativa1', optativa2='$optativa2', optativa3='$optativa3', optativa4='$optativa4', otrocolegio='$otrocolegio', letra_grupo='$letra_grupo', idioma='$idioma',  religion = '$religion', act1='$act1', observaciones='$observaciones', exencion='$exencion', bilinguismo='$bilinguismo', observaciones = '$observaciones', optativa21='$optativa21', optativa22='$optativa22', optativa23='$optativa23', optativa24='$optativa24', act21='$act21', act22='$act22', act23='$act23', act24='$act24', promociona='$promociona', transporte='$transporte', ruta_este='$ruta_este', ruta_oeste='$ruta_oeste', curso='$curso', sexo = '$sexo', hermanos = '$hermanos', nacionalidad = '$nacionalidad', claveal = '$claveal', optativas4 = '$optativas4', itinerario = '$itinerario', optativa5='$optativa5', optativa6='$optativa6', optativa7='$optativa7', diversificacion='$diversificacion', optativa25='$optativa25', optativa26='$optativa26', optativa27='$optativa27', enfermedad = '$enfermedad', otraenfermedad = '$otraenfermedad', foto='$foto', divorcio='$divorcio', matematicas3 = '$matematicas3', ciencias4 = '$ciencias4' where id = '$ya[0]'";
				mysqli_query($db_con,$insert);
			}
			else{

				if (strlen($ruta) > 0) {$transporte = '1';}
				if (empty($foto)) { $foto = "0";}
				$insert = "insert into matriculas (apellidos, nombre, nacido, provincia, nacimiento, domicilio, localidad, dni, padre, dnitutor, madre, dnitutor2, telefono1, telefono2, colegio, otrocolegio, letra_grupo, correo, idioma, religion, optativa1, optativa2, optativa3, optativa4, act1, observaciones, curso, exencion, bilinguismo, fecha, optativa21, optativa22, optativa23, optativa24, act21, act22, act23, act24, promociona, transporte, ruta_este, ruta_oeste, sexo, hermanos, nacionalidad, claveal, optativas4, itinerario, optativa5, optativa6, optativa7, diversificacion, optativa25, optativa26, optativa27, enfermedad, otraenfermedad, foto, divorcio, matematicas3, ciencias4) VALUES ('$apellidos',  '$nombre', '$nacido', '$provincia', '$fecha_nacimiento', '$domicilio', '$localidad', '$dni', '$padre', '$dnitutor', '$madre', '$dnitutor2', '$telefono1', '$telefono2', '$colegio', '$otrocolegio', '$letra_grupo', '$correo', '$idioma', '$religion', '$optativa1', '$optativa2', '$optativa3', '$optativa4', '$act1', '$observaciones', '$curso', '$exencion', '$bilinguismo', now(), '$optativa21', '$optativa22', '$optativa23', '$optativa24', '$act21', '$act22', '$act23', '$act24', '$promociona', '$transporte', '$ruta_este', '$ruta_oeste', '$sexo', '$hermanos', '$nacionalidad', '$claveal', '$optativas4', '$itinerario', '$optativa5', '$optativa6', '$optativa7', '$diversificacion', '$optativa25', '$optativa26', '$optativa27', '$enfermedad', '$otraenfermedad', '$foto', '$divorcio', '$matematicas3', '$ciencias4')";
				mysqli_query($db_con,$insert);
			}
			$ya_esta1 = mysqli_query($db_con,"select id from matriculas where $extra");
			$ya_id = mysqli_fetch_array($ya_esta1);
			$id = $ya_id[0];
			if ($nuevo=="1") {
				include("imprimir.php");
			}
			else{
				?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Miguel A. García">
    <meta name="description" content="IES Monterroso de Estepona. Oferta educativa: ESO, Bachillerato, Formación Profesional. Exámenes Trinity College. Programa Erasmus+. Información para familias.">
    <meta name="keywords" content="<?php echo $nombre_del_centro;?>, instituto educación secundaria, formación profesional, bachillerato, Estepona, Trinity, erasmus, e-smith, sme server">
  	<title>Solicitud de Matrícula</title>	
	 <link rel="stylesheet" href="//<?php echo $dominio;?>css/<?php echo $css_estilo; ?>">
	 <link rel="stylesheet" href="//<?php echo $dominio;?>css/font-awesome.min.css">
    <link rel="stylesheet" href="//<?php echo $dominio;?>css/personal.css">
</head>
<body>
<br />
<br />
<br />
<br />
<div class="alert alert-success"
	style="width: 500px; margin: auto; text-align: justify;"><br />
Los datos de la Matrícula se han registrado correctamente. En los
próximos días, el Director del Colegio o Tutor entregará la
documentación al alumno. Este la llevará a casa para ser firmada por sus
padres o tutores legales. Una vez firmada se entregará en la
Administración del Centro con los documentos complementarios (fotocopia
del DNI o Libro de Familia, etc.). Si tienen alguna duda o surge algún
problema, no duden en ponerse en contacto con la Administración o
Dirección del Centro. <br />
<br />
<form action="../notas/datos.php" method="post"
	enctype="multipart/form-data">
<center><input type="submit"
	value="Volver a la página personal del alumno"
	class="btn btn-warning btn-block btn-lg" /></center>
</form>

</div>
<br />
</body>
</html>

				<?
			}
			exit();
		}
	}
}
?>
<!DOCTYPE html>
<html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Miguel A. García">
    <meta name="description" content="IES Monterroso de Estepona. Oferta educativa: ESO, Bachillerato, Formación Profesional. Exámenes Trinity College. Programa Erasmus+. Información para familias.">
    <meta name="keywords" content="<?php echo $nombre_del_centro;?>, instituto educación secundaria, formación profesional, bachillerato, Estepona, Trinity, erasmus, e-smith, sme server">
  	<title>Solicitud de Matrícula</title>	
	
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
    <link rel="dns-prefetch" href="//code.jquery.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script type="text/javascript">
function confirmacion() {
	var answer = confirm("ATENCIÓN:\n Los datos que estás a punto de enviar pueden ser modificados a través de esta página hasta el próximo día 16 de Junio, fecha en la que se procederá al bloqueo del formulario para imprimirlo y entregarlo a los alumnos. Si necesitas cambiar los datos después de esa fecha deberás hacerlo a través de la Jefatura de Estudios. \nSi estás seguro que los datos son correctos y las opciones elegidas son las adecuadas, pulsa el botón ACEPTAR. De lo contrario, el boton CANCELAR te devuelve al formulario de matriculación, donde podrás realizar los cambios que consideres oportunos.")
	if (answer){
return true;
	}
	else{
return false;
	}
}
</script>

<script language="javascript">

function dameColegio(){ 
   	var indice = document.form1.colegio.selectedIndex 
   	var textoEscogido = document.form1.colegio.options[indice].text 
   	if(textoEscogido == "Otro Centro"){
    document.getElementById('otrocolegio').style.visibility='visible'; 
		}
	 }
	 
function dimeEnfermedad(){ 
   	var indice = document.form1.enfermedad.selectedIndex 
   	var textoEscogido = document.form1.enfermedad.options[indice].text 
   	if(textoEscogido == "Otra enfermedad"){
    document.getElementById('otraenfermedad').style.visibility='visible'; 
		}
	 }
	 	 
function it1(){ 
   	var indice = document.form1.itinerario.selectedIndex 
   	var textoEscogido = document.form1.itinerario.options[indice].value
   	if(textoEscogido == "1"){
    document.getElementById('otrocolegio').style.visibility='visible'; 
		}
	}


function contar(form,name) {
	  n = document.forms[form][name].value.length;
	  t = 300;
	  if (n > t) {
	    document.forms[form][name].value = document.forms[form][name].value.substring(0, t);
	  }
	  else {
	    document.forms[form]['result'].value = t-n;
	  }
	}
	
</script>

<style type="text/css">
<!--
table {
	width: 991px;
	border: 1px solid #aaa;
	border-collapse: collapse;
}

td {
	border: 1px solid #aaa
}

td .it {
	padding: 4px 6px;
	border-bottom: 1px dotted #ccc;
	border-top: 1px dotted #ccc;
}
-->
</style>
</head>

<body>

<?php

// Rellenar datos a partir de las tablas alma o matriculas.
if (($claveal or $id) and $curso) {
	if (!empty($id)) {
		$conditio = " id = '$id'";
	}
	else{
		$conditio = " claveal = '$claveal'";
		$conditio1 = $conditio;
	}

	$curso = str_replace(" ","",$curso);
	$n_curso = substr($curso,0,1);
	// Comprobación de padre con varios hijos en el Centro
	$ya_matricula = mysqli_query($db_con,"select claveal, apellidos, nombre, id from matriculas where ". $conditio ."");
	$ya_primaria = mysqli_query($db_con,"select claveal, apellidos, nombre from alma_primaria where ". $conditio1 ."");
	$ya_alma = mysqli_query($db_con,"select claveal, apellidos, nombre, unidad from alma where (curso like '1º de E%' or curso like '2º de E%' or curso like '3º de E%' or curso like '4º de E%') and (". $conditio1 .")");
	if (mysqli_num_rows($ya_matricula) == "0" and mysqli_num_rows($ya_primaria) == "0" and mysqli_num_rows($ya_alma) == "0") {
		?>
<div class="aviso3" align="justify"
	style="padding: 20px; margin-top: 40px;">El DNI que
has proporcionado no pertenece a ningún alumno de este Centro o de
alguno de los Colegios de Primaria adscritos, y el registro de la
Matrícula a través de esta página sólo está abierto para nuestros
alumnos. Si te has equivocado al introducir el DNI, vuelve atrás e
inténtalo de nuevo. Si no eres un alumno de este Centro o de sus
Colegios adscritos, ponte en contacto con la Administración para recibir
información sobre el proceso de matriculación.</div>
		<?
		exit();
	}

	if (substr($row_alma[3],0,2)=="1E"){$curso="2ESO";}
	if (substr($row_alma[3],0,2)=="2E"){$curso="3ESO";}
	if (substr($row_alma[3],0,2)=="3E"){$curso="4ESO";}

	// Comprobamos si el alumno se ha registrado ya
	$ya = mysqli_query($db_con,"select apellidos, id, nombre, nacido, provincia, nacimiento, domicilio, localidad, dni, padre, dnitutor, madre, dnitutor2, telefono1, telefono2, colegio, optativa1, optativa2, optativa3, optativa4, correo, exencion, bilinguismo, otrocolegio, letra_grupo, religion, observaciones, act1, act2, act3, act4, optativa21, optativa22, optativa23, optativa24, act21, act22, act23, act24, promociona, transporte, ruta_este, otrocolegio, ruta_oeste, sexo, hermanos, nacionalidad, claveal, optativas4, itinerario, optativa5, optativa6, optativa7, diversificacion, optativa25, optativa26, optativa27, curso, foto, enfermedad, otraenfermedad, matematicas3, divorcio, ciencias4 from matriculas where ". $conditio ."");

	// Ya se ha matriculado
	if (mysqli_num_rows($ya) > 0) {
		$datos_ya = mysqli_fetch_array($ya);
		$naci = explode("-",$datos_ya[5]);
		$nacimiento = "$naci[2]-$naci[1]-$naci[0]";
		$apellidos = $datos_ya[0]; $id = $datos_ya[1]; $nombre = $datos_ya[2]; $nacido = $datos_ya[3]; $provincia = $datos_ya[4]; $domicilio = $datos_ya[6]; $localidad = $datos_ya[7]; $dni = $datos_ya[8]; $padre = $datos_ya[9]; $dnitutor = $datos_ya[10]; $madre = $datos_ya[11]; $dnitutor2 = $datos_ya[12]; $telefono1 = $datos_ya[13]; $telefono2 = $datos_ya[14]; $colegio = $datos_ya[15]; $optativa1 = $datos_ya[16]; $optativa2 = $datos_ya[17]; $optativa3 = $datos_ya[18]; $optativa4 = $datos_ya[19]; $correo = $datos_ya[20]; $exencion = $datos_ya[21]; $bilinguismo = $datos_ya[22]; $otrocolegio = $datos_ya[23]; $letra_grupo = $datos_ya[24]; $religion = $datos_ya[25]; $observaciones = $datos_ya[26]; $act1 = $datos_ya[27]; $act2 = $datos_ya[28]; $act3 = $datos_ya[29]; $act4 = $datos_ya[30]; $optativa21 = $datos_ya[31]; $optativa22 = $datos_ya[32]; $optativa23 = $datos_ya[33]; $optativa24 = $datos_ya[34]; $act21 = $datos_ya[35]; $act22 = $datos_ya[36]; $act23 = $datos_ya[37]; $act24 = $datos_ya[38]; $promociona = $datos_ya[39]; $transporte = $datos_ya[40]; $ruta_este = $datos_ya[41]; $otrocolegio = $datos_ya[42]; $ruta_oeste = $datos_ya[43]; $sexo = $datos_ya[44]; $hermanos = $datos_ya[45]; $nacionalidad = $datos_ya[46]; $claveal = $datos_ya[47]; $optativas4 = $datos_ya[48]; $itinerario = $datos_ya[49]; $optativa5 = $datos_ya[50];$optativa6 = $datos_ya[51];$optativa7 = $datos_ya[52]; $diversificacion = $datos_ya[53];$optativa25 = $datos_ya[54];$optativa26 = $datos_ya[55];$optativa27 = $datos_ya[56]; $curso = $datos_ya[57]; $foto = $datos_ya[58]; $enfermedad = $datos_ya[59]; $otraenfermedad = $datos_ya[60]; $matematicas3 = $datos_ya[61]; $divorcio = $datos_ya[62]; $ciencias4 = $datos_ya[63];
		$n_curso = substr($curso,0,1);
		if ($ruta_error == '1') {
			$ruta_este = "";
			$ruta_oeste = "";
		}
	}

	// Viene de Colegio de Primaria
	elseif (mysqli_num_rows($ya_primaria) > 0){
		$alma = mysqli_query($db_con,"select apellidos, nombre, provinciaresidencia, fecha, domicilio, localidad, dni, padre, dnitutor, concat(PRIMERAPELLIDOTUTOR2,' ',SEGUNDOAPELLIDOTUTOR2,', ',NOMBRETUTOR2), dnitutor2, telefono, telefonourgencia, correo, concat(PRIMERAPELLIDOTUTOR,' ',SEGUNDOAPELLIDOTUTOR,', ',NOMBRETUTOR), curso, sexo, nacionalidad, claveal, colegio, unidad from alma_primaria where ". $conditio1 ."");

		if (mysqli_num_rows($alma) > 0) {
			$al_alma = mysqli_fetch_array($alma);
			$apellidos = $al_alma[0];  $nombre = $al_alma[1]; $nacido = $al_alma[5]; $provincia = $al_alma[2]; $nacimiento = $al_alma[3]; $domicilio = $al_alma[4]; $localidad = $al_alma[5]; $dni = $al_alma[6]; $padre = $al_alma[7]; $dnitutor = $al_alma[8];
			if (strlen($al_alma[9]) > 3) {$madre = $al_alma[9];	}else{ $madre = ""; }
			; $dnitutor2 = $al_alma[10]; $telefono1 = $al_alma[11]; $telefono2 = $al_alma[12]; $correo = $al_alma[13]; $padre = $al_alma[14];
			$n_curso_ya = $al_alma[15]; $sexo = $al_alma[16]; $nacionalidad = $al_alma[17];  $claveal= $al_alma[18]; $colegio= $al_alma[19];$letra_grupo = substr($al_alma[20],-1);
			$nacimiento= str_replace("/","-",$nacimiento);

		}
	}

	// Es alumno del Centro
	elseif (mysqli_num_rows($ya_alma) > 0){
		$alma = mysqli_query($db_con,"select apellidos, nombre, provinciaresidencia, fecha, domicilio, localidad, dni, padre, dnitutor, concat(PRIMERAPELLIDOTUTOR2,' ',SEGUNDOAPELLIDOTUTOR2,', ',NOMBRETUTOR2), dnitutor2, telefono, telefonourgencia, correo, concat(PRIMERAPELLIDOTUTOR,' ',SEGUNDOAPELLIDOTUTOR,', ',NOMBRETUTOR), curso, sexo, nacionalidad, matriculas, claveal, unidad, localidadnacimiento from alma where (curso like '1º de E%' or curso like '2º de E%' or curso like '3º de E%' or curso like '4º de E%') and (". $conditio1 .")");
		if (mysqli_num_rows($alma) > 0) {
			$al_alma = mysqli_fetch_array($alma);

			if (stristr("1º de E%",$al_alma[15])){$curso="2ESO";}
			if (stristr("2º de E%",$al_alma[15])){$curso="3ESO";}
			if (stristr("3º de E%",$al_alma[15])){$curso="4ESO";}
			$n_curso = substr($curso,0,1);

			$apellidos = $al_alma[0];  $nombre = $al_alma[1]; $nacido = $al_alma[5]; $provincia = $al_alma[2]; $nacimiento = $al_alma[3]; $domicilio = $al_alma[4]; $localidad = $al_alma[5]; $dni = $al_alma[6]; $padre = $al_alma[7]; $dnitutor = $al_alma[8];
			if ($madre == "") { if (strlen($al_alma[9]) > 3) {$madre = $al_alma[9];	}else{ $madre = ""; }}
			if ($dnitutor2 == "") { $dnitutor2 = $al_alma[10];} if ($telefono1 == "") { $telefono1 = $al_alma[11]; } if ($telefono2 == "") { $telefono2 = $al_alma[12];} if ($correo == "") { $correo = $al_alma[13];} $padre = $al_alma[14];
			$n_curso_ya = $al_alma[15]; $sexo = $al_alma[16]; $nacionalidad = $al_alma[17]; $letra_grupo = substr($al_alma[20],-1); $claveal= $al_alma[19]; $nacido = $al_alma[21];

			if (substr($curso,0,1) == substr($n_curso_ya,0,1)) {
				echo '
<script> 
 if(confirm("ATENCIÓN:\n ';
				echo 'Has elegido matricularte en el mismo Curso( ';
				echo strtoupper($n_curso_ya);
				echo ') que ya has estudiado este año. \nEsta situación sólo puede significar que estás absolutamente seguro de que vas a repetir el mismo Curso. Si te has equivocado al elegir Curso para el próximo año escolar, vuelve atrás y selecciona el curso correcto. De lo contrario, puedes continuar.")){}else{history.back()};
 </script>
 
';
			}
			$nacimiento= str_replace("/","-",$nacimiento);
			$colegio = 'I.E.S. Monterroso';
		}
	}

	?>
<div id="content" class="container">
<div class="col-md-12">  

<br />
<form id="form1" name="form1" method="post" action="matriculas.php">
<table align="center" class="table table-bordered">
	<!-- CABECERA: LOGOTIPO -->
	<thead>
		<tr>
			<td colspan="2" style="border-right: 0; height: 75px; vertical-align:middle;">
				<img class="img-responsive" src="../../ui-theme/img/encabezado_matricula.png" alt=""
				width="450"></td>
			<td colspan="2">
			<h4 class="text-uppercase"><strong>Consejería de Educación, Cultura y
			Deporte</strong></h4>
			<h5 class="text-uppercase"><strong><?php echo $nombre_del_centro; ?></strong></h5>
			</td>
		</tr>
	</thead>

	<!-- CUERPO -->
	<tbody>
	<?php
	// CURSO MATRICULA
	if (empty($n_curso)) $n_curso = substr($curso,0,1);

	switch ($curso) {
		case '1ESO' : $curso_matricula="PRIMERO"; break;
		case '2ESO' : $curso_matricula="SEGUNDO"; break;
		case '3ESO' : $curso_matricula="TERCERO"; break;
		case '4ESO' : $curso_matricula="CUARTO";  break;
	}
	?>
		<tr>
			<td colspan="4">
			<h4 class="text-center text-uppercase">SOLICITUD DE MATRÍCULA EN <?php echo $curso_matricula; ?>
			DE E.S.O.</h4>
			</td>
		</tr>

		<!-- DATOS PERSONALES DEL ALUMNO -->
		<tr>
			<th class="table-active text-center text-uppercase" colspan="4">Datos
			personales del alumno o alumna</th>
		</tr>
		<tr>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"apellidos, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="apellidos">Apellidos</label> <input type="text"
				class="form-control" id="apellidos" name="apellidos"
				value="<?php echo (isset($apellidos)) ? $apellidos : ''; ?>"
				maxlength="60"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"nombre, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="nombre">Nombre</label> <input type="text"
				class="form-control" id="nombre" name="nombre"
				value="<?php echo (isset($nombre)) ? $nombre : ''; ?>"
				maxlength="30"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"nacimiento, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="nacimiento">Fecha de nacimiento</label> <input
				type="text" class="form-control" id="nacimiento" name="nacimiento"
				value="<?php echo (isset($nacimiento)) ? $nacimiento : ''; ?>"
				maxlength="11" data-date-format="DD-MM-YYYY"
				data-date-viewmode="years"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"dni, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="dni">DNI / Pasaporte o equivalente</label> <input
				type="text" class="form-control" id="dni" name="dni"
				value="<?php echo (isset($dni)) ? $dni : ''; ?>" maxlength="10"></div>
			</td>
		</tr>
		<tr>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"nacionalidad, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="nacionalidad">Nacionalidad</label> <input type="text"
				class="form-control" id="nacionalidad" name="nacionalidad"
				value="<?php echo (isset($nacionalidad)) ? $nacionalidad : ''; ?>"
				maxlength="30"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"nacido, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="nacido">Nacido en</label> <input type="text"
				class="form-control" id="nacido" name="nacido"
				value="<?php echo (isset($nacido)) ? $nacido : ''; ?>"
				maxlength="30"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"provincia, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="provincia">Provincia</label> <input type="text"
				class="form-control" id="provincia" name="provincia"
				value="<?php echo (isset($provincia)) ? $provincia : ''; ?>"
				maxlength="30"></div>
			</td>
			<td>
			<p><strong>Sexo</strong></p>
			<div class="form-inline">
			<div
				class="form-group <?php echo (strstr($vacios,"sexo, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="sexo"
				value="hombre"
				<?php echo (isset($sexo) && $sexo == 'hombre' || $sexo == 'H') ? 'checked' : ''; ?>>
			&nbsp;Hombre </label></div>
			</div>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<div
				class="form-group <?php echo (strstr($vacios,"sexo, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="sexo"
				value="mujer"
				<?php echo (isset($sexo) && $sexo == 'mujer' || $sexo == 'M') ? 'checked' : ''; ?>>
			&nbsp;Mujer </label></div>
			</div>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<div
				class="form-group <?php echo (strstr($vacios,"domicilio, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="domicilio">Domicilio, calle, plaza o avenida y número</label>
			<input type="text" class="form-control" id="domicilio"
				name="domicilio"
				value="<?php echo (isset($domicilio)) ? $domicilio : ''; ?>"
				maxlength="60"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"localidad, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="localidad">Municipio / Localidad</label> <input
				type="text" class="form-control" id="localidad" name="localidad"
				value="<?php echo (isset($localidad)) ? $localidad : ''; ?>"
				maxlength="30"></div>
			</td>
			<td>
			<div class="form-group"><label for="hermanos">Nº de hijos</label>
			<input type="number" class="form-control" id="hermanos"
				name="hermanos"
				value="<?php echo (isset($hermanos)) ? $hermanos : '1'; ?>" min="1"
				max="99" maxlength="2"></div>
			</td>
		</tr>
		<tr>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"telefono1, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="telefono1">Teléfono</label> <input type="text"
				class="form-control" id="telefono1" name="telefono1"
				value="<?php echo (isset($telefono1)) ? $telefono1 : ''; ?>"
				maxlength="9"></div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"telefono2, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="telefono2">Teléfono urgencias</label> <input type="text"
				class="form-control" id="telefono2" name="telefono2"
				value="<?php echo (isset($telefono2)) ? $telefono2 : ''; ?>"
				maxlength="9"></div>
			</td>
			<td>
			<div class="form-group"><label for="correo">Correo electrónico</label>
			<input type="text" class="form-control" id="correo" name="correo"
				value="<?php echo (isset($correo)) ? $correo : ''; ?>"
				maxlength="120"></div>
			</td>
			<td rowspan="2">
			<div class="form-group <?php echo (strstr($vacios,"colegio, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="colegio">Centro de procedencia</label> 	
			<select name="colegio" class="form-control" id="colegio" onChange="dameColegio()">
			<option><?php echo $colegio; ?></option>
			<?php if($curso == "1ESO"): 
				$cole_1=mysqli_query($db_con,"select distinct colegio from alma_primaria order by colegio");
				?>
				<option value="<?php echo $nombre_del_centro; ?>"><?php echo $nombre_del_centro; ?></option>
				<?php while ($centros_adscritos=mysqli_fetch_array($cole_1)): ?>
				<option value="<?php echo $centros_adscritos[0]; ?>"><?php echo $centros_adscritos[0]; ?></option>
				<?php endwhile; ?>
				<?php else: ?>
				<option value="<?php echo $nombre_del_centro; ?>"><?php echo $nombre_del_centro; ?></option>
				<?php endif; ?>
				<option value="Otro Centro">Otro Centro</option>
		</select> 
		</div>

		 <input style="<?php  if ($colegio == 'Otro Centro') {	echo "visibility:visible;";}else{	echo "visibility:hidden;";}?>" id = "otrocolegio" name="otrocolegio" value="<?php if (isset($otrocolegio)) { echo $otrocolegio ;} ?>" type="text" class="form-control" placeholder="Escribe aquí el nombre del Centro" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<p class="help-block"><small>El centro podrá enviar comunicaciones
			vía SMS si proporciona el número de un teléfono móvil o por correo
			electrónico.</small></p>
			</td>
		</tr>
		<!-- DATOS DE LOS REPRESENTANTES O GUARDADORES LEGALES -->
		<tr>
			<th class="table-active text-center text-uppercase" colspan="4">Datos de
			los representantes o guardadores legales</th>
		</tr>
		<tr>
			<td colspan="3">
			<div
				class="form-group <?php echo (strstr($vacios,"padre, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="padre">Apellidos y nombre del representante o guardador
			legal 1 <p class="help-block"><small>(con quien conviva el alumno/a y tenga atribuida su
			guarda y custodia)</small></p></label> <input type="text"
				class="form-control" id="padre" name="padre"
				value="<?php echo (isset($padre)) ? $padre : ''; ?>" maxlength="60">
			</div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"dnitutor, ")==TRUE) ? 'has-error' : ''; ?>">
			<label for="dnitutor">DNI / NIE</label> <input type="text"
				class="form-control" id="dnitutor" name="dnitutor"
				value="<?php echo (isset($dnitutor)) ? $dnitutor : ''; ?>"
				maxlength="10"></div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<div class="form-group"><label for="madre">Apellidos y nombre del
			representante o guardador legal 2</label> <input type="text"
				class="form-control" id="madre" name="madre"
				value="<?php echo (isset($madre)) ? $madre : ''; ?>" maxlength="60">
			</div>
			</td>
			<td>
			<div
				class="form-group <?php echo ((isset($madre) && !empty($madre)) && (isset($dnitutor2) && empty($dnitutor2))) ? 'has-error' : ''; ?>">
			<label for="dnitutor2">DNI / NIE</label> <input type="text"
				class="form-control" id="dnitutor2" name="dnitutor2"
				value="<?php echo (isset($dnitutor2)) ? $dnitutor2 : ''; ?>"
				maxlength="10"></div>
			</td>
		</tr>

		<!-- TRANSPORTE ESCOLAR -->
		<tr>
			<th class="table-active text-center text-uppercase" colspan="4">Solicitud
			de transporte escolar</th>
		</tr>
		<tr>
			<td class="text-center" colspan="4">
			<div class="form-inline">

			<div class="form-group"><label for="ruta_este">Ruta Este:</label> <select
				class="form-control" id="ruta_este" name="ruta_este">
				<option value=""></option>
				<?php for ($i = 0; $i < count($transporte_este); $i++): ?>
				<option value="<?php echo $transporte_este[$i]['id']; ?>"
				<?php echo (isset($ruta_este) && $ruta_este == $transporte_este[$i]['id']) ? 'selected' : ''; ?>><?php echo $transporte_este[$i]['nombre']; ?></option>
				<?php endfor; ?>
			</select></div>

			&nbsp;&nbsp;&nbsp;&nbsp;

			<div class="form-group"><label for="ruta_oeste">Ruta Oeste:</label> <select
				class="form-control" id="ruta_oeste" name="ruta_oeste">
				<option value=""></option>
				<?php for ($i = 0; $i < count($transporte_oeste); $i++): ?>
				<option value="<?php echo $transporte_oeste[$i]['id']; ?>"
				<?php echo (isset($ruta_oeste) && $ruta_oeste == $transporte_oeste[$i]['id']) ? 'selected' : ''; ?>><?php echo $transporte_oeste[$i]['nombre']; ?></option>
				<?php endfor; ?>
			</select></div>

			</div>
			</td>
		</tr>

		<!-- PRIMER IDIOMA Y RELIGION O ALTERNATIVA -->
		<tr>
			<th class="table-active text-center" colspan="2">Idioma
			extranjero</th>
			<th class="table-active text-center" colspan="2">Opción de
			enseñanza de religión o alternativa<br>
			<p class="help-block"><small>(seleccione una opción)</small></p></th>
		</tr>
		<tr>
			<td colspan="2">
			<div class="form-group"><input type="text" class="form-control"
				name="idioma" value="Inglés" readonly>
			<p class="help-block"><small>Materia obligatoria</small></p>
			</div>
			</td>
			<td style="border-right: 0;">
			<div
				class="form-group <?php echo (strstr($vacios,"religion, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="religion"
				value="Religión Católica" required
				<?php if($religion == 'Religión Católica'){echo "checked";} ?>>
			Religión Catolica </label></div>
			</div>

			<div
				class="form-group <?php echo (strstr($vacios,"religion, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="religion"
				value="Religión Islámica" required
				<?php if($religion == 'Religión Islámica'){echo "checked";} ?>>
			Religión Islámica </label></div>
			</div>

			<div
				class="form-group <?php echo (strstr($vacios,"religion, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="religion"
				value="Religión Judía" required
				<?php if($religion == 'Religión Judía'){echo "checked";} ?>>
			Religión Judía </label></div>
			</div>
			</td>
			<td>
			<div
				class="form-group <?php echo (strstr($vacios,"religion, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="religion"
				value="Religión Evangélica" required
				<?php if($religion == 'Religión Evangélica'){echo "checked";} ?>>
			Religión Evangélica </label></div>
			</div>

			<div
				class="form-group <?php echo (strstr($vacios,"religion, ")==TRUE) ? 'has-error' : ''; ?>">
			<div class="radio"><label> <input type="radio" name="religion"
				value="Valores Éticos" required
				<?php if($religion == 'Valores Éticos'){echo "checked";} ?>>
			Valores Éticos</label></div>
			</div>
			</td>
		</tr>

	<?
	if ($n_curso < 3) {
		?>
	<tr>
		<th class="table-active text-center" colspan="2"><strong class="text-uppercase">Asignatura
		Optativa </strong><br />
		<p class="help-block"><small>(marca con 1, 2, 3, etc. por orden de preferencia. En caso de que no haya un número suficiente de alumnos, se asignará la siguiente asignatura elegida.)</small></p></th>
		<th class="table-active text-center" colspan="2">
		<strong class="text-uppercase">Programa de Refuerzo o Ampliación</strong><br />
		<p class="help-block"><small>Se elige una asignatura de refuerzo si
		el alumno tiene asignaturas suspensas del curso anterior; se elige
		asignatura de ampliación si el alumno pasa de curso sin suspensos. El
		Dpto. de Orientación decide finalmente.</small></p></th>
	</tr>
	<tr>
		<td colspan="2" 
		<?php if ($opt_rep == "1" or stristr($adv, "optativa de ".$n_curso."")) {
			echo " style='background-color:yellow;'";
		} ?>>
		
		<?
			$num1="";
			for ($i = 1; $i < 5; $i++) {
				if (substr($curso, 0, 1) == $i) {
					$num_optativas = count(${opt.$i})+1;
					foreach (${opt.$i} as $opt_1){
						$num1+=1;
						echo '<div class="col-sm-6"><span style="margin:2px 2px" >'.$opt_1.'</span><br /></div>';
						echo '<div><select class="form-control" name="optativa'.$num1.'" id="optativa'.$num1.'" >';
							
						echo '<option>'.${optativa.$num1}.'</option>';
						for ($z=1;$z<$num_optativas;$z++){
							echo '<option>'.$z.'</option>';
						}
						echo '</select></div>';
						echo '<br />';
					}
				}
			}
			?>
		</div>
		</td>
		<td valign=top colspan="2"><?php 
		$num1="";
		for ($i = 1; $i < 6; $i++) {
			if (substr($curso, 0, 1) == $i) {
				foreach (${a.$i} as $act_1){
					$n_a = count(${a.$i})+1;
					$num1+=1;
					if (${act.$num1} == '0') {${act.$num1}='';}
					echo '<div class="radio"><label>
					<input required type="radio" name = "act1" value="'.$num1.'"'; echo $sl;
					if($act1 == $num1){echo "checked";}
					echo " />";
					echo ''.$act_1.'</label></div>';
				}
			}
		}
		?></td>
	</tr>
	<?
	}
	elseif ($n_curso == 3) {
		?>
	<tr>
		<th class="table-active text-center" colspan="4"><strong class="text-uppercase">Asignaturas
		Optativas de 3º de ESO</strong><br />
		<p class="help-block"><small>(marca con 1, 2, 3, etc. por orden de preferencia. En caso de que no haya un número suficiente de alumnos, se asignará la siguiente asignatura elegida.)</small></p></th>
	</tr>
	<tr>
		<th class="table-active text-center" colspan="1">Matemáticas de 3º de
		E.S.O.</th>
		<th class="table-active text-center" colspan="3">Materias Optativas<br /></th>
	</tr>
	<tr>
		<td valign=top colspan="1"><?	
		echo "<div class='radio'><label><input type='radio' name = 'matematicas3' value='A' ";
		if ($matematicas3=="A") { echo "checked";}
		echo " required />Matemáticas Académicas (Orientadas al Bachillerato)</label><label class='radio'><input type='radio' name = 'matematicas3' value='B' ";
		if ($matematicas3=="B") { echo "checked";}
		echo " required />Matemáticas Aplicadas (Orientadas a la Formación Profesional)</label></div>";
		?></td>

		<td style='<?php if ($opt_rep == "1" or stristr($adv, "optativa de ".$n_curso."")) {
			echo "background-color:yellow;";
		} ?>'><?
		$num1="";
		for ($i = 1; $i < 8; $i++) {
			if (substr($curso, 0, 1) == $i) {
				foreach (${opt.$i} as $opt_1){
					$num1 += 1;
					if($num1<5){
					// echo '<span style="margin:2px 2px" >'.$opt_1.'</span><br />';
						echo '<span style="margin:2px 2px" >'.$opt_1.'</span><br />';
						echo '<select class="form-control col-sm-3" name="optativa'.$num1.'" id="optativa'.$num1.'" required>';

						echo '<option>'.${optativa.$num1}.'</option>';
							for ($z=1;$z<8;$z++){
								echo '<option>'.$z.'</option>';
							}
						echo '</select>';
						}
					}
					
			}
		}
		?>
	</td>
	<td></td>
	<td style='<?php if ($opt_rep == "1" or stristr($adv, "optativa de ".$n_curso."")) {
			echo "background-color:yellow;";
		} ?>'>

		<?php
		$num1 = "";
		for ($i = 1; $i < 8; $i++) {
			if (substr($curso, 0, 1) == $i) {
				foreach (${opt.$i} as $opt_1){
					$num1 += 1;
					if($num1>4){
						// echo '<span style="margin:2px 2px" >'.$opt_1.'</span><br />';
						echo '<span style="margin:2px 2px" >'.$opt_1.'</span><br />';
						echo '<select class="form-control col-sm-3" name="optativa'.$num1.'" id="optativa'.$num1.'" required>';

						echo '<option>'.${optativa.$num1}.'</option>';
						for ($z=1;$z<8;$z++){
							echo '<option>'.$z.'</option>';
						}
						echo '</select>';
					}
				}
			}
		}
		?></td>
	</tr>
	<tr>
		<th class="table-active text-center" colspan="4"><strong>Programa de Refuerzo o Ampliación</strong>
			<p class="help-block"><small>Se elige una asignatura de refuerzo si el alumno tiene
			asignaturas suspensas del curso anterior; se elige asignatura de
			ampliación si el alumno pasa de curso sin suspensos. El Departamento
			de Orientación decide finalmente.</small></p>
		</th>
	</tr>
	<tr>
		<td colspan="4">
			<?php $num1 = ''; ?> <?php for ($i = 1; $i < 8; $i++):?>
			<?php if (substr($curso, 0, 1) == $i): ?> <?php foreach (${a.$i} as $act_1): ?>
			<?php $n_a = count(${a.$i})+1; ?> <?php $num1 += 1; ?> <?php if (${act.$num1} == 0) ${act.$num1} = ''; ?>
			<div class="radio"><label> <input type="radio" required name="act1"
				value="<?php echo $num1; ?>"
				<?php echo ($act1 == $num1) ? 'checked' : ''; ?>> <?php echo $act_1; ?>
			</label>
			</div>
			<?php endforeach; ?> <?php endif; ?> <?php endfor; ?>
			</td>
	</tr>
	<?
	}
	else{
		// Peculiaridades de 4º de ESO

		?>
		<tr>
			<td colspan="4">

				<table style="width:100%" class="table table-bordered">
					<tr>
						<td style="width:66%; background-color:#E0F2F7;">
							<strong>Opción de Enseñanzas Académicas para la Iniciación al Bachillerato</strong>
						</td>	
						<td style="width:33%;background-color:#F7F2E0;">
							<strong>Opción de Enseñanzas Aplicadas para la Iniciación a la Formación Profesional</strong>
						</td>
					</tr>
				</table>

				<table style="width:100%" class="table table-condensed table-bordered">
					<tr>
				<?php for ($i = 1; $i < 4; $i++): ?>
						<td style="width:33%;<?php if($i==1 or $i==2){echo "background-color:#E0F2F7;";}else{echo "background-color:#F7F2E0";}?>">
							<div class="radio"><label> <input type="radio"
				id="itinerario<?php echo $i; ?>" name="itinerario" required
							<?php if($itinerario == $i){echo " checked";} ?>
				value="<?php echo $i; ?>"> <span class="text-uppercase"><strong>Itinerario
							<?php echo $i; ?></strong></span><br>
							<small><?php echo ${it4.$i}[0]; ?></small> </label>
							</div>
							
						</td>
				<?php endfor; ?>
					</tr>
					<tr>
		<?php for ($i = 1; $i < 4; $i++): ?>
			<td style="width:33%; 
		<?php if (stristr($adv, "optativas4") and $itinerario == $i) {echo "background-color:#E0F2F7;";}?>" class="text-left">
		<!-- ASIGNATURAS DE MODALIDAD -->


		<?php if($i == 1): ?>

							<table style="width:100%" class="table table-condensed table-bordered">
							<tr class="danger">
								<td>
							<p class="text-warning">Modalidad 1</p>
							<div class="form-check"><label> <input class="form-check-input" type="radio" id="ciencias4" name="ciencias4"
							<?php if($ciencias4 == 1){echo " checked";} ?> value="1" onClick='document.getElementById("optativa2").disabled=true;'> 
							<p class="text-info">Ingenieria y Arquitectura</p>
							</label>
							</div>
								</td>
								<td>
							<p class="text-warning">Modalidad 2</p>		
							<div class="form-check"><label> <input class="form-check-input" type="radio"
				id="ciencias4" name="ciencias4"
							<?php if($ciencias4 == 2){echo " checked";} ?> value="2" onClick='document.getElementById("optativa2").disabled=false;'> 
							<p class="text-info">Ciencias de la Salud y de la Tierra</p>
							</label>
							</div>
								</td>
							</tr>
						</table>
		<small class="text-info"><em>Asignaturas comunes y optativas de las 2 modalidades del Itinerario 1</em></small>
		<?php endif; ?>
		<?php if($i == 2): ?>
		<small class="text-info"><em>Asignaturas comunes del Itinerario <?php echo $i;?></em></small>
		<?php endif; ?>
		<?php if($i == 3): ?>
		<small class="text-info"><em>Asignaturas comunes y optativas del Itinerario 3</em></small>
		<?php endif; ?>
			<p class="form-control-static"><?php echo ${it4.$i}[1]; ?></p>
			<p class="form-control-static"><?php echo ${it4.$i}[2]; ?></p>

			<!-- Optativas de It. 1 --> <?php if($i == 1): ?>
			<p class="form-control-static"><?php echo ${it4.$i}[3]; ?></p>
			<div class="form-check">
			<div class="radio"><label> <input type="radio"
				class="form-check-input itinerario<?php echo $i; ?>" name="optativas4" value="Biología y Geología"
				<?php echo ($optativas4 == 'Biología y Geología') ? 'checked' : '' ; ?>>
				<?php echo ${it4.$i}[4]; ?>
			</label></div>
			</div>
			<div class="form-check">
			<div class="radio"><label> <input type="radio"
				class="form-check-input itinerario<?php echo $i; ?>" name="optativas4" value="Economía"
				<?php echo ($optativas4 == 'Economía') ? 'checked' : '' ; ?>>
				<?php echo ${it4.$i}[5]; ?>
			</label></div>
			</div>

			<!-- Optativas de It. 3 --> <?php elseif($i == 3): ?>
			<div class="form-check">
			<div class="radio"><label> <input type="radio"
				class="form-check-input itinerario<?php echo $i; ?>" name="optativas4" value="Ciencias Aplicadas"
				<?php echo ($optativas4 == 'Ciencias Aplicadas') ? 'checked' : '' ; ?>>
				<?php echo ${it4.$i}[3]; ?>
			</label></div>
			</div>
			<div class="form-check">
			<div class="radio"><label> <input type="radio"
				class="form-check-input itinerario<?php echo $i; ?>" name="optativas4" value="Iniciación Act. Emprend."
				<?php echo ($optativas4 == 'Iniciación Act. Emprend.') ? 'checked' : '' ; ?>>
				<?php echo ${it4.$i}[4]; ?>
			</label></div>
			</div>
			<?php else: ?>
			<p class="form-control-static"><?php echo ${it4.$i}[3]; ?></p>
			<?php endif; ?></td>
			<?php endfor; ?>
			</tr>


			</table>

			</td>
		</tr>
		<tr>
			<th class="table-active text-center" colspan="4"><strong class="text-uppercase">Asignaturas Optativas de 4º de ESO</strong><p class="help-block">
			<small>(marca con 1, 2, 3, etc. por orden de preferencia. En caso de que no haya un número suficiente de alumnos, se asignará la siguiente asignatura elegida.).<br> 
				<span class="text-warning">
					Todos los alumnos cursan 2 optativas, excepto la Opción de <mark><em>Ingeniería y Arquitectura</em></mark> del Itinerario de Ciencias que cursa 1 sola pues todos cursan TIC.
				</span></small></p></th>
		</tr>
		<tr>
			<td colspan="4">
			<div class="form <?php echo (isset($opt_rep4) && $opt_rep4 == 1) ? 'has-error"' : '' ; ?>">

			<?php $num1 = ""; ?>
			<div class="form-row">	
			<div class="form-group col-md-5">
			<label>
			Optativa 1
			</label>
			<select class="form-control" id="optativa1" name="optativa1" required>
				<option value=""></option>
				<?php foreach ($opt4 as $key=>$val): ?>
				<?php $num1++; ?>
				<option value="<?php echo $num1;?>"<?php echo ($optativa1 == $num1) ? 'selected':'';?>><?php echo $val; ?></option>
				<?php endforeach; ?>
			</select>

			</div>

			<?php $num2 = ""; ?>
			<div class="form-group offset-md-2 col-md-5">
			<label>
			Optativa 2
			</label>
			<select class="form-control" id="optativa2" name="optativa2" required <?php if($ciencias4==1){ echo "disabled";}?>>
				<option value=""></option>
				<?php foreach ($opt4 as $key2=>$val2): ?>
				<?php $num2++; ?>
				<?php if (stristr($val2, "idioma")==FALSE): ?>
				<option value="<?php echo $num2;?>"<?php echo ($optativa2 == $num2) ? 'selected':'';?>><?php echo $val2; ?></option>
				<?php endif; ?>
				<?php endforeach; ?>
			</select>

			</div>
			</div>
			
			</div>
			
			</td>
		</tr>

		
	<?php
	}
	?>
	<?php
	if (substr($curso, 0, 1) > 1) {
		if ($n_curso == 4) {
			?>
	<tr>
		<th class="table-active text-center text-uppercase" colspan="1"><strong>Matemáticas de 3º de ESO</strong><br />
		<small class="text-muted text-lowercase">(selecciona una de las opciones)</small></th>
		<th class="table-active text-center text-uppercase" colspan="3"><strong>Asignaturas
		Optativas de 3º de ESO</strong><br />
		<small class="text-muted text-lowercase">(marca con 1, 2, 3, etc. por orden de preferencia. En caso de que no haya un número suficiente de alumnos, se asignará la siguiente asignatura elegida.)</small></th>
	</tr>
	<tr>
			<td valign=top colspan="1"><?	
		echo "<div class='radio'><label><input type='radio' name = 'matematicas3' value='A' ";
		if ($matematicas3=="A") { echo "checked";}
		echo " required />Matemáticas Académicas</label><label class='radio'></label></div>
		<div class='radio'><label>
		<input type='radio' name = 'matematicas3' value='B' ";
		if ($matematicas3=="B") { echo "checked";}
		echo " required />Matemáticas Aplicadas</label></div>";
		?>
	</td>
		<td class="<?php echo (isset($opt_rep2) && $opt_rep2 == 1) ? 'has-error"' : '' ; ?>"><?
		$num1="";
		for ($i = 1; $i < 8; $i++) {
			if (substr($curso, 0, 1)-1 == $i) {
				foreach (${opt.$i} as $opt_1){
					$num1+=1;
					if ($num1<5) {					
					echo ''.$opt_1.'';
					echo '
					<select class="form-control col-sm-3" name="optativa2'.$num1.'" id="" required>';
					echo '<option>'.${optativa2.$num1}.'</option>';
					for ($z=1;$z<8;$z++){
						echo '<option>'.$z.'</option>';
					}
					echo '</select>';
					}
				}
			}
		}
		?></td>
		<td></td>
		<td colspan="1" class="<?php echo (isset($opt_rep2) && $opt_rep2 == 1) ? 'has-error"' : '' ; ?>"><?
		$num1="";
		for ($i = 1; $i < 8; $i++) {
			if (substr($curso, 0, 1)-1 == $i) {
				foreach (${opt.$i} as $opt_1){
					$num1+=1;
					if ($num1>4) {
					echo ''.$opt_1.'';
					echo '
					<select class="form-control col-sm-3" name="optativa2'.$num1.'" id="" required>';
					echo '<option>'.${optativa2.$num1}.'</option>';
					for ($z=1;$z<8;$z++){
						echo '<option>'.$z.'</option>';
					}
					echo '</select>';
					}
				}
			}
		}
		?></td>
	</tr>
		<tr>
		<th class="table-active text-center text-uppercase" colspan="4">Programa de Refuerzo o Ampliación de 3º de ESO
			<p class="help-block text-lowercase" text-muted><small>Se elige una asignatura de refuerzo si el alumno tiene
			asignaturas suspensas del curso anterior; se elige asignatura de
			ampliación si el alumno pasa de curso sin suspensos. El Departamento
			de Orientación decide finalmente.</small></p>
		</th>
	</tr>
	<tr>
		<td colspan="4"><?php $num1 = ''; ?> 
			<?php if (substr($curso, 0, 1) == 4): ?> <?php foreach ($a3 as $act_1): ?>
			<?php $n_a = count($a3)+1; ?> <?php $num1 += 1; ?> <?php if (${act.$num1} == 0) ${act.$num1} = ''; ?>
			<div class="radio"><label> <input required type="radio" name="act1"
				value="<?php echo $num1; ?>"
				<?php echo ($act1 == $num1) ? 'checked' : ''; ?>> <?php echo $act_1; ?>
			</label></div>
			<?php endforeach; ?> <?php endif; ?> 
		</td>
	</tr>
	<?
		}
		else{
			?>
	<tr>
		<th class="table-active text-center text-uppercase" colspan="4">
		ELECCIÓN DE ASIGNATURAS OPTATIVAS DE <?php echo substr($curso, 0, 1) - 1;?>º
		DE ESO<br /><small class="text-muted text-lowercase">
		(deben rellenarlo todos los alumnos, incluso si promocionan al curso
		siguiente)</small></th>
	</tr>
	<tr>
		<td class="table-active text-center text-uppercase" colspan="2"><strong>Asignatura
		Optativa </strong><br />
		<small class="text-muted text-lowercase">(marca con 1, 2, 3, etc. por orden de preferencia. En caso de que no haya un número suficiente de alumnos, se asignará la siguiente asignatura elegida.)</small></td>
		<td class="table-active text-center text-uppercase" colspan="2"><strong>Programa de refuerzo o alternativo</strong><br />
		<small CLASS="text-muted text-lowercase">Estudios en función del Informe de
		Tr&aacute;nsito elaborado por el Tutor y seleccionados por el Dept. de
		Orientación.</small></td>
	</tr>
	<tr>
		<td colspan="2"
		<?php if ($opt_rep2 == "1" or stristr($adv, "optativa de ".($n_curso-1)."")) {
			echo " style='background-color:yellow;'";
		} ?>>
<div class="form-group form-horizontal">
		<?
			$num_cur_opta = substr($curso, 0, 1)-1;
			$num_opta = count(${opt.$num_cur_opta})+1;
			$num1="";
			for ($i = 1; $i < $num_opta; $i++) {
				if ((substr($curso, 0, 1)-1) == $i) {
					foreach (${opt.$i} as $opt_1){
						$num1+=1;
						echo '<div class="col-md-6">'.$opt_1.'</div>';
						echo '<div class="col-md-3"><select class="form-control" name="optativa2'.$num1.'" id="">';
						echo '<option>'.${optativa2.$num1}.'</option>';
						for ($z=1;$z<$num_opta;$z++){
							echo '<option>'.$z.'</option>';
						}
						echo '</select>';
						echo '</div>';
					}
				}
			}
			?></div></td>
		<td valign=top colspan="2"><?php    
		$num1="";
		for ($i = 1; $i < 5; $i++) {
			if ((substr($curso, 0, 1) -1) == $i) {
				foreach (${a.$i} as $act_1){
					$n_a = count(${a.$i})+1;
					//	if($cargo == '1'){
					$num1+=1;
					if (${act.$num1} == '0') {${act.$num1}='';}
					echo '<div class="radio"><label><input required type="radio" name = "act21" value="'.$num1.'"'.$sl.'';
					if($act21 == $num1){echo "checked";}
					echo " />";
					echo ''.$act_1.'</label></div>';
				}
			}
		}
		}
		?></td>
	</tr>

	<?
	}
	?>

	<?php if(substr($curso, 0, 1)<3) { ?>
	<tr>
		<th class="table-active text-center text-uppercase" colspan="4">
		<?php 
		echo '<div class="checkbox"><label>
		<input'; 
		echo ' type="checkbox" name="exencion" value="1" '; echo " disabled"; if($exencion == '1'){echo "checked";} 
		echo " />"; ?>
		Exenci&oacute;n de la asignatura
		optativa (a rellenar por el Dep. de Orientaci&oacute;n previo acuerdo
		con la familia)</label></div></th>
	</tr>
	<?php }?>
	<?php if(substr($curso, 0, 1)>2) { ?>
	<tr>
		<td colspan="4" style="background-color: #dfdfdf">
			<div class="checkbox">
				<label><?
		echo '<input'; echo ' type="checkbox" name="diversificacion" value="1" '; echo " disabled"; if($diversificacion == '1'){echo "checked";} echo " />"; ?>
		El alumno participa en el Programa de Diversificación
			</label>
			</div>
		</td>
	</tr>
	<?php } ?>
	
	<!-- ENFERMEDADES -->
	<tr>
		<th class="table-active text-center text-uppercase" colspan="2">ENFERMEDADES DEL ALUMNO
		</th>
		<th class="table-active text-center text-uppercase" colspan="2">SITUACIÓN FAMILIAR
		</th>
	</tr>
	<tr>
		<td colspan="2">
		<p class="help-block"><small> Señalar si el alumno tiene alguna
		enfermedad que es importante que el Centro conozca por poder afectar a
		la vida académica del alumno.</small></p>

		<label for="enfermedad">Enfermedades del Alumno</label> <select
			class="form-control" id="enfermedad" name="enfermedad"
			onChange="dimeEnfermedad()">
			<option value=""></option>
			<?php for ($i = 0; $i < count($enfermedades); $i++): ?>
			<option value="<?php echo $enfermedades[$i]['id']; ?>"
			<?php echo (isset($enfermedad) && $enfermedad == $enfermedades[$i]['id']) ? 'selected' : ''; ?>><?php echo $enfermedades[$i]['nombre']; ?></option>
			<?php endfor; ?>
		</select> &nbsp;&nbsp;&nbsp;&nbsp; <input style="<?php  if ($enfermedad == 'Otra enfermedad') { echo "visibility:visible;";}else{	echo "visibility:hidden;";}?>" id = "otraenfermedad" name="otraenfermedad" <?php if(!($otraenfermedad == 'Escribe aquí el nombre de la enfermedad')){echo "value = \"$otraenfermedad\"";} ?>type="text" class="form-control" placeholder="Escribe aquí el nombre de la enfermedad" onClick="borrar()" />
		</td>
			<td colspan="2">
			<p class="help-block"><small>
			Señalar si el alumno procede de padres divorciados y cual es la situación legal de la Guarda y Custodia respecto al mismo.</small></p>
			<label for="divorcio">Alumno con padres divorciados</label>					 
			<select
				class="form-control" id="divorcio" name="divorcio">
			<option value=""></option>	
				<?php for ($i = 0; $i < count($divorciados); $i++): ?>
				<option value="<?php echo $divorciados[$i]['id']; ?>"
				<?php echo (isset($divorcio) && $divorcio == $divorciados[$i]['id']) ? 'selected' : ''; ?>><?php echo $divorciados[$i]['nombre']; ?></option>
				<?php endfor; ?>
			</select>
			</td>
	</tr>

	<!-- FOTO -->
	<tr>
		<th class="table-active text-center text-uppercase" colspan="4">FOTOGRAFÍA DEL ALUMNO</th>
	</tr>
	<tr>
		<td colspan="4" style="border-top: 0;">
		<p class="help-block"><small> Desmarcar si la familia tiene algún
		inconveniente en que se publiquen en nuestra web fotografías del
		alumno por motivos educativos (Actividades Complementarias y
		Extraescolares, etc.)</small></p>
		<div class="checkbox"><label for="foto"> <?php if ($foto==1 or $foto=="") { $extra_foto = "checked";	} else {$extra_foto="";} ?>
		<input type="checkbox" name="foto" id="foto" value="1"
		<?php echo $extra_foto;?>> Foto del Alumno </label></div>
		</td>
	</tr>
	<!-- OBSERVACIONES -->
	<tr>
		<th class="table-active text-center" colspan="4">OBSERVACIONES: <br />
		<small class="text-muted">Indique aquellas cuestiones que considere sean importantes para
		conocimiento del Centro. </small><br />
		<textarea name="observaciones" class="form-control" id="textarea" rows="5" onKeyDown="contar('form1','observaciones')"
			onkeyup="contar('form1','observaciones')"><?php echo $observaciones; ?></textarea>
		</th>
	</tr>

	<tr>
		<td colspan="4" style="border-bottom: none">

		<center>
		<input type="hidden" name="curso" value="<?php echo $curso;?>" /> <input
			type="hidden" name="nuevo" value="<?php echo $nuevo;?>" /> <input
			type="hidden" name="curso_matricula"
			value="<?php echo $curso_matricula;?>" /> <input type="hidden"
			name="claveal" <?php echo "value = \"$claveal\""; ?> /> 
			<input type="hidden" name="letra_grupo" value="<?php echo $letra_grupo;?>" /> 
			<?php 
			if (stristr($colegio,$nombre_corto)==TRUE) {
				if ($_SESSION['pasa_matricula'] == "1" or $_SESSION['admin']=="1") {
				echo '<input type="submit" name="enviar" value="Enviar los datos de la Matrícula" onClick="return confirmacion();" class="no_imprimir btn btn-primary btn-lg" />';
			}
			}
			else{

			if ($_SESSION['pasa_matricula'] == "1" or $_SESSION['admin']=="1") {
				echo '<input type="submit" name="enviar" value="Enviar los datos de la Matrícula" onClick="return confirmacion();" class="no_imprimir btn btn-primary btn-lg" />';
			}
			}
		 ?> 
		<br />
		</center>
		</td>
	</tr>
	</form>
</table>
<?
}
else{

	echo "<br /><div class='alert alert-danger' style='max-width:450px;margin:auto'><legend>Atenci&oacute;n:</legend><p>Parece que estás intentando abrir una página sin autorización. Me temo que no podemos continuar. Si eres alumno o tutor legal de un alumno de este Centro, procede a entrar mediante tus claves con la página de <b>Acceso para Alumnos</b></p></div>";

}
?> 

<br />
</div>
</div>

<?php include("../../inc_pie.php"); ?>

<script>
	$(function ()  
	{ 
		$('#nacimiento').datetimepicker({
			language: 'es',
			pickTime: false
		})
	});  
	
		$(document).ready(function() {
			// Selector de Enfermedad
			$('#enfermedad').change(function() {
				if($('#enfermedad').val() == 'Otra enfermedad') {
					$('#form-otraenfermedad').removeClass('hidden');
				}
				else {
					$('#form-otraenfermedad').addClass('hidden');
				}
			});
			// Selector de colegio
			$('#colegio').change(function() {
				if($('#colegio').val() == 'Otro Centro') {
					$('#form-otrocolegio').removeClass('hidden');
				}
				else {
					$('#form-otrocolegio').addClass('hidden');
				}
			});	
		
		// Selector de itinerarios
		$('#itinerario1').click(function() { 
			if($('#itinerario1').is(':checked')) {  
				$('.itinerario1').prop('disabled', false);
				
				$('.itinerario2').prop('disabled', true);
				$('.itinerario3').prop('disabled', true);
				$('.itinerario4').prop('disabled', true);
			}
		});
		
		$('#itinerario2').click(function() { 
			if($('#itinerario2').is(':checked')) {  
				$('.itinerario2').prop('disabled', false);
				
				$('.itinerario1').prop('disabled', true);
				$('.itinerario3').prop('disabled', true);
				$('.itinerario4').prop('disabled', true);
			}
		});
		
		$('#itinerario3').click(function() { 
			if($('#itinerario3').is(':checked')) {  
				$('.itinerario3').prop('disabled', false);
				
				$('.itinerario1').prop('disabled', true);
				$('.itinerario2').prop('disabled', true);
				$('.itinerario4').prop('disabled', true);
			}
		});
		
		$('#itinerario4').click(function() { 
			if($('#itinerario4').is(':checked')) {  
				$('.itinerario4').prop('disabled', false);
				
				$('.itinerario1').prop('disabled', true);
				$('.itinerario2').prop('disabled', true);
				$('.itinerario3').prop('disabled', true);
			}
		});
		
	});
	</script>



