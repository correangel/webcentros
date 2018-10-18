<?php
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

<?php
$opt_a2b = mysqli_query($db_con,"select opt_aut21 from matriculas_bach");
if (mysqli_num_rows($opt_aut2b) > 0) {}
	else{
mysqli_query($db_con,"ALTER TABLE  `matriculas_bach` ADD  `opt_aut21` INT( 1 ) NOT NULL ,
ADD  `opt_aut22` INT( 1 ) NOT NULL ,
ADD  `opt_aut23` INT( 1 ) NOT NULL ,
ADD  `opt_aut24` INT( 1 ) NOT NULL ,
ADD  `opt_aut25` INT( 1 ) NOT NULL ,
ADD  `opt_aut26` INT( 1 ) NOT NULL");
}

//Variable de Religión para repetidores de 1BACH
$rel1b = mysqli_query($db_con,"select religion1b from matriculas_bach");
if(mysqli_num_rows($rel1b)>0){}else{mysqli_query($db_con,"ALTER TABLE  matriculas_bach ADD  religion1b VARCHAR( 64 ) NOT NULL");}

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

// Asignaturas y Modalidades
include("../../intranet/admin/matriculas/config.php");

// Se procesan los datos enviados ppor el formulario
if(isset($_POST['enviar'])){
	foreach($_POST as $key => $val)
	{
		${$key} = $val;
		//echo "${$key} --> $val<br />";
	}
	// Comprobación de campos vacíos
	$nacimiento = str_replace("/","-",$nacimiento);
	$fecha0 = explode("-",$nacimiento);
	$fecha_nacimiento = "$fecha0[2]-$fecha0[1]-$fecha0[0]";
	$campos = "apellidos nombre nacido provincia nacimiento domicilio localidad padre dnitutor telefono1 telefono2 religion colegio sexo nacionalidad ";
	$itinerario1=substr($mod1,-1);
	$itinerario2=substr($mod2,-1);
	foreach($_POST as $key => $val)
	{		
		if ($mod1==1) {$optativa1=$optativa11;}elseif ($mod1==2) {$optativa1=$optativa12;}elseif($mod1==3){$optativa1=$optativa13;}elseif($mod1==4){$optativa1=$optativa14;}else{$optativa1="";}
		if ($key=="mod1") {
			if($optativa11=="" and $optativa12=="" and $optativa13=="" and $optativa14==""){
				$vacios.= "optativas de modalidad de 1BACH, ";
				$num+=1;
			}
	}
		
		if ($key=="mod2"){
							
			$n_o="";

				foreach (${opt2.$itinerario2} as $opt => $n_opt){
					foreach ($_POST as $clave=>$valor){
						if ($clave==$opt) {
							$n_o+=1;
							${optativa2b.$n_o}=$valor;
							if(${optativa2b.$n_o} == ""){
								$vacios.= "optativa2b".$n_o.", ";
								$num+=1;
							}
						}
					}
				}

			$n_o="";

				foreach ($opt_aut2 as $opt2 => $n_opt2){
					foreach ($_POST as $clave=>$valor){
						if ($clave==$opt2) {
							$n_o++;
							if(${opt_aut2.$n_o} == ""){
							$vacios.= "optativa libre ".$n_o.", ";
							$num+=1;
							}
						$tr_o = explode(", ",$n_opt2);
					}
				}
			}
		}

		if(strstr($campos,$key." ")==TRUE){
			if($val == ""){
				$vacios.= $key.", ";
				$num+=1;
			}
		}
	}

	if ($religion == "") {
		$vacios.= "religion, ";
		$num+=1;
	}
	if ($religion1b == "" and $curso=="2BACH" and $repetidor<>1) {
		$vacios.= "religion o alternativa de 1BACH, ";
		$num+=1;
	}
	if ($idioma1 == "") {
		$vacios.= "1º idioma, ";
		$num+=1;
	}
	if ($idioma2 == "" and $curso=="1BACH") {
		$vacios.= "2º idioma, ";
		$num+=1;
	}
	if ($curso=="2BACH" and ($itinerario2 > 2 and empty($optativa2))) {
		$vacios.= "asignatura de modalidad de 2, ";
		$num+=1;
	}
	if ($curso=="2BACH" and $repetidor == ""  and (empty($itinerario2))) {
		$vacios.= "modalidad de 2, ";
		$num+=1;
	}
	if ($curso=="2BACH" and $repetidor == ""  and (empty($itinerario1))) {
		$vacios.= "modalidad de1 1";
		$num+=1;
	}
	if ($curso=="2BACH" and $repetidor == "1" and empty($itinerario2)) {
		$vacios.= "modalidad de 2, ";
		$num+=1;
	}
	if ($curso=="1BACH" and empty($itinerario1)) {
		$vacios.= "modalidad de 1º, ";
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
		$cur_act = substr($curso,0,1)."º de BACHILLERATO";
		$cur_ant = $num_cur_ant . "º de BACHILLERATO";
		
		for ($i=1;$i<9;$i++){
			$adv= str_replace("optativa$i", "optativa de $cur_act  $i", $adv);
			$opt_bach=1;
		}
		echo $adv.'.\n';
		echo 'Rellena los campos mencionados y envía los datos de nuevo para poder registrar tu solicitud correctamente.")
 </script>
';
	}
	else{

		if (substr($curso,0,1)==2){
			for ($i = 1; $i < 10; $i++) {
				for ($z = $i+1; $z < 10; $z++) {
					if (${optativa2b.$i}>0) {
						if (${optativa2b.$i}==${optativa2b.$z}) {
							$opt_rep="1";
						}
					}
				}
			}
		}

		for ($i = 1; $i < 8; $i++) {
				for ($z = $i+1; $z < 8; $z++) {
					if (${opt_aut2.$i}>0) {
						if (${opt_aut2.$i}==${opt_aut2.$z}) {
							$opt_rep2="1";
						}
					}
				}
			}

		if ($curso=="2BACH" and $repetidor <> "1") {
			if (!($mod2==$mod1)){
				$incompat = 1;
			}
		}
		if (substr($curso,0,1)==1 and ($idioma1==$idioma2)){
			$idioma_rep="1";
		}

		if (substr($curso,0,1)==2 and ($idioma1=="Inglés" and ($ING21==1 or $ING22==1 or $ING23==1 or $ING24==1))){
			$idioma_rep_2B="1";
		}
		if (substr($curso,0,1)==2 and ($idioma1=="Francés" and ($FR21==1 or $FR22==1 or $FR23==1 or $FR24==1))){
			$idioma_rep_2B="1";
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
		elseif($enfermedad == "Otra enfermedad" and ($otraenfermedad == "")){
			$vacios.="otraenfermedad ";
			$msg_error = "No has escrito el nombre de la enfermedad del alumno. Rellena el nombre de la enfermedad y envía los datos de nuevo para poder registrar tu solicitud correctamente.";
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
			echo 'Parece que has seleccionado dos rutas incompatibles para el Transporte Escolar, y solo puedes seleccionar una ruta, hacia el Este o hacia el Oeste de '.$localidad_del_centro.'.\nElige una sola parada y vuelve a enviar los datos.")
 </script>
';
			$ruta_error = "";
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
			echo 'Parece que has seleccionado el mismo número de preferencia para varias optativas, y cada optativa debe tener un número de preferencia distinto.\nElige las optativas sin repetir el número de preferencia e inténtalo de nuevo.")
 </script>
';
		}
		elseif ($idioma_rep=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado el mismo idioma como primera y segunda, y cada idioma debe ser distinto.\nElige los idiomas sin repetir e inténtalo de nuevo.")
 </script>
';
		}
		elseif ($idioma_rep_2B=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado el primer idioma también como optativa preferida, y esto no puede suceder.\nElige una nueva optativa e inténtalo de nuevo.")
 </script>
';
		}
		elseif($incompat=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado una modalidad de 1º de Bachillerato incompatibles con la modalida elegida en 2º de Bachillerato. Si quieres optar por esta posibilidad ponte en contacto con Jefatura de Estudios.")
 </script>
';			
		}
		else{
			if (strlen($claveal) > 3) {$extra = " claveal = '$claveal'";}
			elseif (strlen($dni) > 3) {$extra = " dni = '$dni'";}
			else {$extra = " dnitutor = '$dnitutor' ";}

			if ($curso=="2BACH" and $itinerario2=='3') {
				$optativa2 = "Griego II";
			}
			elseif($curso=="2BACH" and $itinerario2=='4') {
				$optativa2 = "Economía de la Empresa";
			}
			elseif($curso=="2BACH" and $itinerario2<'3'){
				$optativa2='';
			}
			// El alumno ya se ha registrado anteriormente
			$ya_esta = mysqli_query($db_con,"select id from matriculas_bach where $extra");
			if (mysqli_num_rows($ya_esta) > 0) {
				$ya = mysqli_fetch_array($ya_esta);
				if (strlen($ruta_este) > 0 or strlen($ruta_oeste) > 0) {$transporte = '1';}
				if (empty($foto)) { $foto = "0";}
				$act_datos = "update matriculas_bach set apellidos='$apellidos', nombre='$nombre', nacido='$nacido', provincia='$provincia', nacimiento='$fecha_nacimiento', domicilio='$domicilio', localidad='$localidad', dni='$dni', padre='$padre', dnitutor='$dnitutor', madre='$madre', dnitutor2='$dnitutor2', telefono1='$telefono1', telefono2='$telefono2', religion='$religion', colegio='$colegio', otrocolegio='$otrocolegio', letra_grupo='$letra_grupo', idioma1='$idioma1', idioma2='$idioma2', religion = '$religion', observaciones = '$observaciones', promociona='$promociona', transporte='$transporte', ruta_este='$ruta_este', ruta_oeste='$ruta_oeste', curso='$curso', sexo = '$sexo', hermanos = '$hermanos', nacionalidad = '$nacionalidad', claveal = '$claveal', itinerario1 = '$itinerario1', itinerario2 = '$itinerario2', optativa1='$optativa1', optativa2='$optativa2', optativa2b1 = '$optativa2b1', optativa2b2 = '$optativa2b2', optativa2b3 = '$optativa2b3', optativa2b4 = '$optativa2b4', optativa2b5 = '$optativa2b5', optativa2b6 = '$optativa2b6', optativa2b7 = '$optativa2b7', optativa2b8 = '$optativa2b8', optativa2b9 = '$optativa2b9', repite = '$repetidor', enfermedad = '$enfermedad', otraenfermedad = '$otraenfermedad', foto='$foto', bilinguismo='$bilinguismo', divorcio='$divorcio', religion1b='$religion1b', opt_aut21='$opt_aut21', opt_aut22='$opt_aut22', opt_aut23='$opt_aut23', opt_aut24='$opt_aut24', opt_aut25='$opt_aut25', opt_aut26='$opt_aut26', opt_aut27='$opt_aut27' where id = '$ya[0]'";
				mysqli_query($db_con,$act_datos);
			}
			else{

				if (strlen($ruta) > 0) {$transporte = '1';}
				if (empty($foto)) { $foto = "0";}
				$con_matr =  "insert into matriculas_bach (apellidos, nombre, nacido, provincia, nacimiento, domicilio, localidad, dni, padre, dnitutor, madre, dnitutor2, telefono1, telefono2, colegio, otrocolegio, letra_grupo, correo, idioma1, idioma2, religion, optativa1, optativa2, optativa2b1, optativa2b2, optativa2b3, optativa2b4, optativa2b5, optativa2b6, optativa2b7, optativa2b8, optativa2b9, observaciones, curso, fecha, promociona, transporte, ruta_este, ruta_oeste, sexo, hermanos, nacionalidad, claveal, itinerario1, itinerario2, repite, enfermedad, otraenfermedad, foto, bilinguismo, divorcio, religion1b, opt_aut21, opt_aut22, opt_aut23, opt_aut24, opt_aut25, opt_aut26, opt_aut27) VALUES ('$apellidos',  '$nombre', '$nacido', '$provincia', '$fecha_nacimiento', '$domicilio', '$localidad', '$dni', '$padre', '$dnitutor', '$madre', '$dnitutor2', '$telefono1', '$telefono2', '$colegio', '$otrocolegio', '$letra_grupo', '$correo', '$idioma1', '$idioma2', '$religion', '$optativa1', '$optativa2', '$optativa2b1', '$optativa2b2', '$optativa2b3', '$optativa2b4', '$optativa2b5', '$optativa2b6', '$optativa2b7', '$optativa2b8', '$optativa2b9', '$observaciones', '$curso', now(), '$promociona', '$transporte', '$ruta_este', '$ruta_oeste', '$sexo', '$hermanos', '$nacionalidad', '$claveal', '$itinerario1', '$itinerario2', '$repetidor', '$enfermedad', '$otraenfermedad', '$foto', '$bilinguismo', '$divorcio', '$religion1b', '$opt_aut21', '$opt_aut22', '$opt_aut23', '$opt_aut24', '$opt_aut25', '$opt_aut26','$opt_aut27')";

				mysqli_query($db_con,$con_matr);
			}
			$ya_esta1 = mysqli_query($db_con,"select id from matriculas_bach where $extra");
			$ya_id = mysqli_fetch_array($ya_esta1);
			$id = $ya_id[0];
			if ($nuevo=="1") {
			}
			else{
				?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="iso-8859-1">
<title>Intranet &middot; <?php echo $nombre_del_centro; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description"
	content="Intranet del <?php echo $nombre_del_centro; ?>">
<meta name="author"
	content="IESMonterroso (https://github.com/IESMonterroso/intranet/)">

<link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
    <link rel="dns-prefetch" href="//code.jquery.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
<br />
<br />
<br />
<br />
<div class="alert alert-success"
	style="width: 600px; margin: auto; text-align: justify;"><br />
Los datos de la Matrícula se han registrado correctamente. En los
próximos días, el Director del Centro o Tutor entregará la documentación
al alumno. Este la llevará a casa para ser firmada por sus padres o
tutores legales. Una vez firmada se entregará en la Administración del
Centro con los documentos complementarios (fotocopia del DNI o Libro de
Familia, etc.). Si tienen alguna duda o surge algún problema, no duden
en ponerse en contacto con la Administración o Dirección del Centro. <br />
<br />
<form action="../notas/datos.php" method="post"
	enctype="multipart/form-data">
<center><input type="submit"
	value="Volver a la página personal del alumno"
	class="btn btn-primary btn-block btn-lg" /></center>
</form>
				<?php
				exit();
			}
		}
	}
}
?> 
<!DOCTYPE html>
<html>
  <head>
     <meta charset="iso-8859-1">
<title>Intranet &middot; <?php echo $nombre_del_centro; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description"
	content="Intranet del <?php echo $nombre_del_centro; ?>">
<meta name="author"
	content="IESMonterroso (https://github.com/IESMonterroso/intranet/)">

<link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
    <link rel="dns-prefetch" href="//code.jquery.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

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
</head>

<body>

<?php
// Rellenar datos a partir de las tablas alma o matriculas.

if ($claveal or $id) {
	if (!empty($id)) {
		$conditio = " id = '$id'";
	}
	else{
		if (strlen($claveal) > 3) {$conditio = " claveal = '$claveal'"; $conditio1 = $conditio;}
	}

	$curso = str_replace(" ","",$curso);
	$ya_matricula = mysqli_query($db_con,"select claveal, apellidos, nombre, id from matriculas_bach where ". $conditio ."");
	$ya_secundaria = mysqli_query($db_con,"select claveal, apellidos, nombre from alma_secundaria where ". $conditio1 ."");
	$ya_alma = mysqli_query($db_con,"select claveal, apellidos, nombre, unidad from alma where (curso like '1º de B%' or curso like '2º de B%' or curso like '4º de E%') and (". $conditio1 .")");

	// Comprobamos si el alumno se ha registrado ya
	$ya = mysqli_query($db_con,"select apellidos, nombre, nacido, provincia, nacimiento, domicilio, localidad, dni, padre, dnitutor, madre,
	dnitutor2, telefono1, telefono2, colegio, otrocolegio, letra_grupo, correo, idioma1, idioma2, religion, 
	itinerario1, itinerario2, optativa1, optativa2, optativa2b1, optativa2b2, optativa2b3, 
	optativa2b4, optativa2b5, optativa2b6, optativa2b7, optativa2b8, observaciones, curso, fecha, 
	promociona, transporte, ruta_este, ruta_oeste, sexo, hermanos, nacionalidad, claveal, itinerario1, itinerario2, repite, foto, enfermedad, otraenfermedad, bilinguismo, divorcio, religion1b, opt_aut21, opt_aut22, opt_aut23, opt_aut24, opt_aut25, opt_aut26, opt_aut27 from matriculas_bach where ". $conditio ."");

	// Ya se ha matriculado
	if (mysqli_num_rows($ya) > 0) {
		$datos_ya = mysqli_fetch_object($ya);
		$naci = explode("-",$datos_ya->nacimiento);
		$nacimiento = "$naci[2]-$naci[1]-$naci[0]";
		$apellidos = $datos_ya->apellidos; $id = $datos_ya->id; $nombre = $datos_ya->nombre; $nacido = $datos_ya->nacido; $provincia = $datos_ya->provincia; $domicilio = $datos_ya->domicilio; $localidad = $datos_ya->localidad; $dni = $datos_ya->dni; $padre = $datos_ya->padre; $dnitutor = $datos_ya->dnitutor; $madre = $datos_ya->madre; $dnitutor2 = $datos_ya->dnitutor2; $telefono1 = $datos_ya->telefono1; $telefono2 = $datos_ya->telefono2; $colegio = $datos_ya->colegio; $correo = $datos_ya->correo; $otrocolegio = $datos_ya->otrocolegio; $letra_grupo = $datos_ya->letra_grupo; $religion = $datos_ya->religion; $observaciones = $datos_ya->observaciones; $promociona = $datos_ya->promociona; $transporte = $datos_ya->transporte; $ruta_este = $datos_ya->ruta_este; $ruta_oeste = $datos_ya->ruta_oeste; $sexo = $datos_ya->sexo; $hermanos = $datos_ya->hermanos; $nacionalidad = $datos_ya->nacionalidad; $claveal = $datos_ya->claveal; $curso = $datos_ya->curso;  $itinerario1 = $datos_ya->itinerario1; $itinerario2 = $datos_ya->itinerario2; $optativa1 = $datos_ya->optativa1; $optativa2 = $datos_ya->optativa2; $optativa2b1 = $datos_ya->optativa2b1; $optativa2b2 = $datos_ya->optativa2b2; $optativa2b3 = $datos_ya->optativa2b3; $optativa2b4 = $datos_ya->optativa2b4; $optativa2b5 = $datos_ya->optativa2b5; $optativa2b6 = $datos_ya->optativa2b6; $optativa2b7 = $datos_ya->optativa2b7; $optativa2b8 = $datos_ya->optativa2b8; $repetidor = $datos_ya->repite; $idioma1 = $datos_ya->idioma1; $idioma2 = $datos_ya->idioma2; $foto = $datos_ya->foto; $enfermedad = $datos_ya->enfermedad; $otraenfermedad = $datos_ya->otraenfermedad; $bilinguismo = $datos_ya->bilinguismo; $divorcio = $datos_ya->divorcio; $religion1b = $datos_ya->religion1b;$opt_aut21 = $datos_ya->opt_aut21; $opt_aut22 = $datos_ya->opt_aut22; $opt_aut23 = $datos_ya->opt_aut23; $opt_aut24 = $datos_ya->opt_aut24; $opt_aut25 = $datos_ya->opt_aut25; $opt_aut26 = $datos_ya->opt_aut26; $opt_aut27 = $datos_ya->opt_aut27;
		$n_curso = substr($curso,0,1);
		if ($ruta_error == '1') {
			$ruta_este = "";
			$ruta_oeste = "";
		}
	}

	// Viene de Colegio de Secundaria
	elseif (mysqli_num_rows($ya_secundaria) > 0){
		$alma = mysqli_query($db_con,"select apellidos, nombre, provinciaresidencia, fecha, domicilio, localidad, dni, padre, dnitutor, concat(PRIMERAPELLIDOTUTOR2,' ',SEGUNDOAPELLIDOTUTOR2,', ',NOMBRETUTOR2), dnitutor2, telefono, telefonourgencia, correo, concat(PRIMERAPELLIDOTUTOR,' ',SEGUNDOAPELLIDOTUTOR,', ',NOMBRETUTOR), curso, sexo, nacionalidad, unidad, claveal, colegio from alma_secundaria where ". $conditio1 ."");
		if (mysqli_num_rows($alma) > 0) {
			$al_alma = mysqli_fetch_array($alma);
			$apellidos = $al_alma[0];  $nombre = $al_alma[1]; $nacido = $al_alma[5]; $provincia = $al_alma[2]; $nacimiento = $al_alma[3]; $domicilio = $al_alma[4]; $localidad = $al_alma[5]; $dni = $al_alma[6]; $padre = $al_alma[7]; $dnitutor = $al_alma[8];
			if (strlen($al_alma[9]) > 3) {$madre = $al_alma[9];	}else{ $madre = ""; }
			; $dnitutor2 = $al_alma[10]; $telefono1 = $al_alma[11]; $telefono2 = $al_alma[12]; $correo = $al_alma[13]; $padre = $al_alma[14];
			$n_curso_ya = $al_alma[15]; $sexo = $al_alma[16]; $nacionalidad = $al_alma[17]; $letra_grupo = substr($al_alma[18],-1); $claveal= $al_alma[19]; $colegio= $al_alma[20];
			$nacimiento= str_replace("/","-",$nacimiento);
			$curso="1BACH";
			$n_curso=substr($curso, 0, 1);
		}
	}

	// Es alumno del Centro
	elseif (mysqli_num_rows($ya_alma) > 0){
		$alma = mysqli_query($db_con,"select apellidos, nombre, provinciaresidencia, fecha, domicilio, localidad, dni, padre, dnitutor, concat(PRIMERAPELLIDOTUTOR2,' ',SEGUNDOAPELLIDOTUTOR2,', ',NOMBRETUTOR2), dnitutor2, telefono, telefonourgencia, correo, concat(PRIMERAPELLIDOTUTOR,' ',SEGUNDOAPELLIDOTUTOR,', ',NOMBRETUTOR), curso, sexo, nacionalidad, fechamatricula, claveal, unidad, combasi, curso, matriculas, localidadnacimiento from alma where (curso like '1º de B%' or curso like '2º de B%' or curso like '4º de E%') and (". $conditio1 .")");
		if (mysqli_num_rows($alma) > 0) {
			$al_alma = mysqli_fetch_array($alma);
			if (empty($curso)) {
				if (stristr("1º de B%",$al_alma[15])){$curso="2BACH";}
				if (stristr("2º de B%",$al_alma[15])){$curso="2BACH";}
				if (stristr("4º de E%",$al_alma[15])){$curso="1BACH";}
			}
			else{
				if (stristr("4º de E%",$al_alma[15])){$curso="1BACH";}
			}
			$n_curso = substr($curso,0,1);

			$apellidos = $al_alma[0];  $nombre = $al_alma[1]; $nacido = $al_alma[5]; $provincia = $al_alma[2]; $nacimiento = $al_alma[3]; $domicilio = $al_alma[4]; $localidad = $al_alma[5]; $dni = $al_alma[6]; $padre = $al_alma[7]; $dnitutor = $al_alma[8];
			if ($madre == "") { if (strlen($al_alma[9]) > 3) {$madre = $al_alma[9];	}else{ $madre = ""; }}
			if ($dnitutor2 == "") { $dnitutor2 = $al_alma[10];} if ($telefono1 == "") { $telefono1 = $al_alma[11]; } if ($telefono2 == "") { $telefono2 = $al_alma[12];} if ($correo == "") { $correo = $al_alma[13];} $padre = $al_alma[14];
			$n_curso_ya = $al_alma[15]; $sexo = $al_alma[16]; $nacionalidad = $al_alma[17]; $letra_grupo = substr($al_alma[20],-1); $claveal= $al_alma[19]; $combasi = $al_alma[21]; $unidad = $al_alma[20]; $curso_largo = $al_alma[22]; $matriculas = $al_alma[23]; $nacido = $al_alma[24];
			if (substr($curso,0,1) == substr($n_curso_ya,0,1)) {
				echo '
<script> 
 if(confirm("ATENCIÓN:\n ';
				echo 'Has elegido matricularte en el mismo Curso( ';
				echo strtoupper($n_curso_ya);
				echo ') que ya has estudiado este año. \nEsta situación sólo puede significar que estás absolutamente seguro de que vas a repetir el mismo Curso. Si te has equivocado al elegir Curso para el próximo año escolar, vuelve atrás y selecciona el curso correcto. De lo contrario, puedes continuar.")){}else{history.back()};
 </script>';
				/*if ($n_curso=="1") {
				 $repetidor = '1';
				 $repetidor1 = "1";
				 }*/
				$repetidor = '1';
				// ${repetidor.$n_curso} = "1";
			}
			$nacimiento= str_replace("/","-",$nacimiento);
			$colegio = 'I.E.S. Monterroso';
		}
	}
?>

<div id="content" class="container">
<div class="col-md-12">  

<br />

<table align="center" class="table table-bordered">
	<form id="form1" name="form1" method="post"
		action="matriculas_bach.php">
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
		case '1BACH' : $curso_matricula="PRIMERO"; break;
		case '2BACH' : $curso_matricula="SEGUNDO"; break;
	}
	?>
		<tr>
			<td colspan="4">
			<h4 class="text-center text-uppercase">SOLICITUD DE MATRÍCULA EN <?php echo $curso_matricula; ?>
			DE BACHILLERATO</h4>
			</td>
		</tr>

		<?php
		if (substr($curso,0,1) == substr($n_curso_ya,0,1) and (substr($n_curso_ya,0,1) == "1") and $cargo == '1') {$repite_1bach = "1";}
		if (substr($curso,0,1) == substr($n_curso_ya,0,1) and (substr($n_curso_ya,0,1) == "2") and $cargo == '1') {$repite_2bach = "1";}
		?>

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
			<div class="form-group"><label for="hermanos">Nº de Hijos</label>
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
			<?php if($curso == "1BACH"): 
				$cole_1=mysqli_query($db_con,"select distinct colegio from alma_secundaria order by colegio");
				?>
				<option value="<?php echo (isset($colegio)) ? $colegio : ''; ?>"><?php echo (isset($colegio)) ? $colegio : ''; ?></option>
				<?php while ($centros_adscritos=mysqli_fetch_array($cole_1)): ?>
				<option value="<?php echo $centros_adscritos[0]; ?>"
				<?php echo (isset($colegio) && $colegio == $centros_adscritos[0]) ? 'selected' : ''; ?>><?php echo $centros_adscritos[0]; ?></option>
				<?php endwhile; ?>
				<?php else: ?>
				<option value="<?php echo $nombre_del_centro; ?>"><?php echo $nombre_del_centro; ?></option>
				<?php endif; ?>
				<option value="Otro Centro">Otro Centro</option>
		</select> 
		</div>

		 <input style="<?php  if ($colegio == 'Otro Centro') {	echo "visibility:visible;";}else{	echo "visibility:hidden;";}?>" id = "otrocolegio" name="otrocolegio" value="<?php if (isset($otrocolegio)) { echo $otrocolegio ;} ?>" type="text" class="form-control" placeholder="Escribe aquí el nombre del Centro" />

		<input type="hidden" name="letra_grupo"	<?php echo "value = \"$letra_grupo\""; ?> />

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
			legal 1 <br><small class="text-muted">(con quien conviva el alumno/a y tenga atribuida su
			guarda y custodia)</small></label> <input type="text"
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
			<th class="table-active text-center text-uppercase"
			<?php echo ($curso != 1) ? ' colspan="2"' : '' ?>>Primer idioma
			extranjero</th>
			<?php if ($curso == 1): ?>
			<th class="table-active text-center text-uppercase">Segundo idioma
			extranjero</th>
			<?php endif ?>
			<th class="table-active text-center text-uppercase" colspan="2">Opción de
			enseñanza de religión o alternativa<br>
			<small class="text-muted text-center text-lowercase">(señale una)</small></th>
		</tr>
		<tr>
			<td <?php echo ($curso != 1) ? ' colspan="2"' : '' ?>>
			<?php $result10 = mysqli_query($db_con, "SELECT combasi FROM alma WHERE claveal='$claveal'"); ?>
				<?php $row10 = mysqli_fetch_array($result10); ?>
				<?php $exp_combasi1 = explode(':', $row10['combasi']); ?>
				<?php foreach ($exp_combasi1 as $codasi1): ?>
				<?php $result11 = mysqli_query($db_con, "SELECT abrev, nombre FROM asignaturas WHERE codigo='$codasi1' AND (abrev = 'ING' OR abrev = 'FRA')"); ?>
				<?php $row11 = mysqli_fetch_array($result11); ?>
				<?php if (!(empty($row11['nombre'])) && $n_curso=="2"): ?>
				<?php endif; ?>
				<?php endforeach; ?>


			<div class="form-group">
				<select class="form-control" id="idioma1"
				name="idioma1" onChange="valida(this.form)">
				<?php $result = mysqli_query($db_con, "SELECT combasi FROM alma WHERE claveal='$claveal'"); ?>
				<?php $row = mysqli_fetch_array($result); ?>
				<?php $exp_combasi = explode(':', $row['combasi']); ?>
				<?php foreach ($exp_combasi as $codasi): ?>
				<?php $result1 = mysqli_query($db_con, "SELECT abrev, nombre FROM asignaturas WHERE codigo='$codasi' AND (abrev = 'ING' OR abrev = 'FRA')"); ?>
				<?php $row1 = mysqli_fetch_array($result1); ?>
				<?php if (!(empty($row1['nombre'])) && $n_curso=="2"): ?>
				<?php $idio = 1; ?>
				<?php $id_1b = $row1['nombre']; ?>
				<option value="<?php echo $row1['nombre']; ?>"><?php echo $row1['nombre']; ?></option>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php if ($idio<>1 || $cargo=="1"): ?>
				<option value="Inglés"
				<?php echo (isset($idioma1) && $idioma1 == 'Inglés') ? 'selected' : ''; ?>>Inglés</option>
				<option value="Francés"
				<?php echo (isset($idioma1) && $idioma1 == 'Francés') ? 'selected' : ''; ?>>Francés</option>
				<?php endif; ?>
				</select> 
				<?php if (isset($idio) && $idio): ?> <small
				class="help-block">(El Idioma de 2º de Bachillerato debe ser el
			mismo que el Idioma de 1º de Bachillerato. Para otras opciones,
			consulta en Jefatura de Estudios.)</small> <?php endif; ?></div>
			</td>
			<?php if ($curso == 1): ?>
			<td>
			<div class="form-group"><select class="form-control" id="idioma2"
				name="idioma2" onChange="valida(this.form)">
				<option value="Francés"
				<?php echo (isset($idioma2) && $idioma2 == 'Francés') ? 'selected' : ''; ?>>Francés</option>
				<option value="Alemán"
				<?php echo (isset($idioma2) && $idioma2 == 'Alemán') ? 'selected' : ''; ?>>Alemán</option>
				<option value="Inglés"
				<?php echo (isset($idioma2) && $idioma2 == 'Inglés') ? 'selected' : ''; ?>>Inglés</option>
			</select></div>
			</td>
			<?php endif; ?>
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
			Educación para la Ciudadanía y los Derechos Humanos</label></div>
			</div>
			</td>
		</tr>


	<tr>
		<th class="table-active text-center" colspan="4"><strong>MODALIDAD
		Y ASIGNATURAS OPTATIVAS DE <?php echo $n_curso; ?>º DE BACHILLERATO </strong>
		<?php if($curso == "1BACH"){ ?>
		<p class="muted help-block"><small>Selecciona una asignatura optativa de Modalidad bajo el Itinerario elegido.</small>
		</p>
		<?php } else{ ?>
		<p class="muted help-block"><small>Las Asignaturas Optatives de 2º de BACHILLERATO están vinvuladas necesariamente con la Modalidad cursada en 1º de BACHILLERATO. Si decides cambiar de Modalidad al cursar 2º de BACHILLERATO debes indicarlo en la Jefatura de Estudios.</small>
		</p>
		<?php } ?>
		</th>
	</tr>

	
	<?php if($curso == "1BACH"): ?>
		<tr>
		<td colspan='4'>
		<table class="table table-bordered" style="width:100%">
		<tr>
		<?php foreach ($it1 as $n_it1=>$itiner1){ ?>
			<td style="width:25%; <?php if(stristr($vacios,"modalidad de 1º")==TRUE){echo 'background-color:#FFFF66;"';}?>">
			<div class="radio" id='it1'>
			<label class="radio"> 
				<input required type="radio" name="mod1" value="<?php echo $n_it1; ?>" <?php echo ($itinerario1 == $n_it1) ? 'checked' : ''; ?> /><strong><?php echo $itiner1; ?></strong>
			</label>
			</div>			
			</td>
			<?php } ?>
		</tr>
		<tr>
		<?php for ($i = 1; $i <= 4; $i++){ ?>
		
		<td style="width:25%;" >

		<?php if ($i==1) { echo "<p>Matemáticas<br>Física y Química<br>Dibujo Técnico<br>Tecnología Industrial</p>";}elseif($i==2){echo "<p>Matemáticas<br>Física y Química<br>Biología y Geología<br>Anatomía Aplicada</p>";} elseif($i==3){echo "<p>Latín I<br>Griego I<br>Patrimonio Cultural y Artístico<br>TIC I</p>";} elseif($i==4){echo "<p>Matemáticas de las Ciencias Sociales<br>Economía<br>Cultura Emprendedora<br>TIC I</p>";}?>

		<div class="form-group">
			<select class="form-control" name="optativa1<?php echo $i;?>"  <?php if(stristr($vacios,"optativas de modalidad de 1B")==TRUE and $mod1 == $i){echo 'style="background-color:#FFFF66;"';}?>>
			<option></option>
			<?php foreach (${opt1.$i} as $optit_1 => $nombre){ ?>
			<option value="<?php echo $optit_1; ?>"
				<?php echo (isset($optativa1) && $optativa1 == $optit_1 && ($itinerario1 == $i)) ? 'selected' : ''; ?>><?php echo $nombre; ?></option>

				
		<?php }?>
			</select>
		</div>
		</td>		
		<?php }?>
		</tr>
		</table>
		</td>
		</tr>
		<?php endif;?>

	<?php if ($curso == "2BACH"): ?>

		<?php
		$ano_escolar = substr($fin_curso,0,4);

		$it_anter = mysqli_query($db_con,"select itinerario1, optativa1 from matriculas_bach_".$ano_escolar." where claveal= '$claveal'");
		$it_anteri = mysqli_fetch_array($it_anter);
		$itin_anterior = $it_anteri[0];
		$opt_anterior = $it_anteri[1];
		

		if (empty($curso_largo)) {
			$cl = mysqli_query($db_con,"select curso from alma where claveal='$claveal'");
			$cl0 = mysqli_fetch_array($cl);
			$curso_largo = $cl0[0];
		}
		?>

		<tr>
		<?php foreach ($it2 as $n_it2=>$itiner2){ ?>
			<td class="text-center">
			<strong>
			<div class="radio" id='it1'>
			<label> <input required type="radio" name="mod2" value="<?php echo $n_it2; ?>" 
				<?php if(isset($itin_anterior) and ($itin_anterior == $n_it2)){ echo "checked";}elseif(isset($itin_anterior) and ($itin_anterior !== $n_it2)){ echo " disabled ";} else{} ?> 
				<?php echo ($itinerario2 == $n_it2) ? 'checked' : ''; ?> />
				<strong><?php echo $itiner2; ?></strong></label>
			</div>
			</strong>
			</td>
			<?php } ?>
		</tr>

		<tr>
		<?php for ($i = 1; $i <= 4; $i++): ?>
			<td>
			<div class="text-left">
			<p><?php echo ${it2.$i}[2]; ?></p>
			<p><?php echo ${it2.$i}[3]; ?></p>
			<?php 
			if($i<3){
				echo ${it2.$i}[4];
			} 
			elseif($i==3){
				echo ${it2.$i}[4];
			?>
			<input type="hidden" value="Griego II" name="optativa2">
			<?php } 
			elseif($i==4){
				echo ${it2.$i}[4];
			?>
			<input type="hidden" value="Economía de la Empresa" name="optativa2">
			<?php } 
			 ?>
			</td>
			<?php endfor; ?>
		</tr>
		<tr>
			<th colspan="4" class="table-active text-center">
				<span class="text-uppercase">Asignaturas específicas de Modalidad en Segundo de Bachillerato (4 horas lectivas).</span><br>
				<small class="help-block">(Marca con 1, 2, 3, etc. por orden de preferencia. En caso de que no haya un número suficiente de alumnos, se asignará la siguiente asignatura elegida.)</small>
			</th>
		</tr>
		<tr>
		<?php for ($i = 1; $i <= 4; $i++): ?>
			<td width="25%" <?php if((isset($opt_rep) && $opt_rep == 1 && $mod2 == $i) or (stristr($vacios,"optativa2b")==TRUE and $mod2 == $i)){echo 'style="background-color:#F2F5A9;"';}?>><?php $num1=""; $num_it = count(${opt2.$i}); ?>
			<?php foreach (${opt2.$i} as $optit_1 => $nombre): ?> <?php $num1 += 1; ?>
			<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label">
				<?php echo $nombre; ?></label>
				<select class="form-control col-sm-4" name="<?php echo $optit_1; ?>" id="<?php echo $optit_1; ?>" >
				<option value=""></option>
				<?php for ($z = 1; $z <= $num_it; $z++): ?>
				<option value="<?php echo $z; ?>"
					<?php if (isset($itinerario2) and $itinerario2==$i) {
						if(${optativa2b.$num1} == $z){ echo 'selected';} 
					}?>
					><?php echo $z; ?>
				</option>
			<?php endfor; ?>
			</select>
			</div>
			</div>

			<?php endforeach; ?></td>
			<?php endfor; ?>
		</tr>

		<tr>
			<th colspan="4" class="table-active text-center">
				<span class="text-uppercase">Asignaturas Optativas de 2º de Bachillerato (2 horas)</span>
				<p class="help-block">
					<small>(Debes seleccionar las asignaturas optativas en su orden de preferencia: 1, 2, 3, etc. Todos los alumnos cursan 1 optativa. En caso de que no haya un número suficiente de alumnos en la asignatura elegida, se asignará la siguiente opción.)</small>
				</p>
			</th>
		</tr>
		<tr>
			<td style="border-top: 0; text-align:left; <?php if(stristr($adv, "optativa libre")==TRUE) {echo 'background-color: #F2F5A9;';}?>" colspan="4" >
			<?php $num1 = ""; ?>
			<?php foreach ($opt_aut2 as $opt_2): ?>
			<?php $num1 += 1; ?>
			<div class="form-group form-inline">
			
				<select class="col-sm-1 form-control <?php echo (isset($opt_rep2) && $opt_rep2 == 1) ? 'has-error"' : '';?>" id="opt_aut2<?php echo $num1;?>" name="opt_aut2<?php echo $num1;?>">
				<option value=""></option>
				<?php for ($z = 1; $z < 8; $z++): ?>
				<option value="<?php echo $z;?>"<?php echo (${opt_aut2.$num1} == $z) ? 'selected':'';?>><?php echo $z; ?></option>
				<?php endfor; ?>
			</select>
			<label>
			&nbsp;&nbsp; <?php echo $opt_2; ?>
			</label>
			</div>
			<?php endforeach; ?> 
			</td>
		</tr>

		<?php if ($repetidor <> 1): ?>

		<!-- ASIGNATURAS OPTATIVAS DE PRIMERO DE BACHILLERATO -->
		
		<tr id="no_repite1">
			<th colspan="4" class="table-active text-center text-uppercase">
			Opciones de matriculación en 1º de Bachillerato<p class="help-block"><small class="text-lowercase">
			(Para solicitar una modalidad o vía diferente a la que ya has
			cursado debes pasar por Jefatura de Estudios)</small></p></th>
		</tr>
		<tr>
			<td colspan="4">
			<div class="form-group">
			<div class="checkbox">
				<label> 
					<input type="checkbox" name="bilinguismo"
				value="Si" <?php if($bilinguismo == 'Si'){echo "checked";} ?>> El alumno/a solicita participar en el programa de bilingüismo (Inglés) en 1º de BACHILLERATO 
				</label>
			</div>
			</div>
			</td>
		</tr>
<tr>
<tr>
	<td style="background-color: #eee;" colspan="4">
	<strong>Religión y Educación para la Ciudadanía</strong>
	</td>
</tr>
<tr>
		
			<td colspan="4">
			
			
			<table style="width: 100%; border: none; <?php if(stristr($vacios,"religion o alternativa de 1BACH")==TRUE) {echo 'background-color: #FFFF66;'; } ?>">
			<tr>
				<td valign=top style="border: none;width:50%">
				<input type="radio" name="religion1b" value="Religión Catolica"
					style="margin: 2px 2px"
		<?php if($religion1b == 'Religión Catolica'){echo "checked";} ?> required />
				Religi&oacute;n Cat&oacute;lica<br />
				<input type="radio"
					name="religion1b" value="Religión Islámica" style="margin: 2px 2px"
		<?php if($religion1b == 'Religión Islámica'){echo "checked";} ?>  required />
				Religi&oacute;n Isl&aacute;mica<br />
				<input type="radio" name="religion1b" value="Religión Judía"
					style="margin: 2px 2px"
		<?php if($religion1b == 'Religión Judía'){echo "checked";} ?>  required />
				Religi&oacute;n Jud&iacute;a
				</td>
				<td valign=top style="border: none"><input type="radio"
					name="religion1b" value="Religión Evangélica" style="margin: 2px 2px"
		<?php if($religion1b == 'Religión Evangélica'){echo "checked";} ?>  required />

				Religi&oacute;n Evang&eacute;lica<br />
				
				<input type="radio" name="religion1b" value="Valores Éticos"
					style="margin: 2px 2px"
		<?php if($religion1b == 'Valores Éticos'){echo "checked";} ?>  required />
				Educación para la Ciudadanía y los Derechos Humanos </td>
			</tr>
		</table>
			
			</td>
			
		</tr>


		<tr>
			<th colspan="4" class="table-active text-center text-uppercase">
				Modalidades y Optativas de 1º Bachillerato
			</th>
		</tr>
		

		<tr>
		<?php foreach ($it1 as $n_it1=>$itiner1){ ?>
			<td class="text-center" >
			<strong>
			<div class="radio" id='it1'>
			<label> 
				<input required type="radio" name="mod1" value="<?php echo $n_it1; ?>" 
				<?php if(isset($itin_anterior) and ($itin_anterior == $n_it1)){ echo "checked";}elseif(isset($itin_anterior) and ($itin_anterior !== $n_it2)){ echo " disabled ";} else{} ?> 
				<?php echo ($itinerario1 == $n_it1) ? 'checked' : ''; ?> />
				<strong><?php echo $itiner1; ?></strong>
			</label>
			</div>
			</strong>
			</td>
			<?php } ?>
		</tr>
		<tr>
		<?php for ($i = 1; $i <= 4; $i++){ ?>
		
		
		<td>
		<?php if ($i==1) { echo "<p>Matemáticas<br>Física y Química<br>Dibujo Técnico<br>Tecnología Industrial</p>";}elseif($i==2){echo "<p>Matemáticas<br>Física y Química<br>Biología y Geología<br>Anatomía Aplicada</p>";} elseif($i==3){echo "<p>Latín I<br>Griego I<br>Patrimonio Cultural y Artístico<br>TIC I</p>";} elseif($i==4){echo "<p>Matemáticas de las Ciencias Sociales<br>Economía<br>Cultura Emprendedora<br>TIC I</p>";}?>

		<div class="form-group">
		<select class="form-control" name="optativa1<?php echo $i;?>"  
			<?php if(stristr($vacios,"optativas de modalidad de 1B")==TRUE and $mod1 == $i){echo 'style="background-color:#FFFF66;"';}?>
			<?php //echo (isset($itin_anterior) and $itin_anterior !== $i) ? 'disabled' : ''; ?> >
		<option></option>
		<?php foreach (${opt1.$i} as $optit_1 => $nombre){ ?>
				<option value="<?php echo $optit_1; ?>"
				<?php echo (isset($optativa1) && $optativa1 == $optit_1 && ($itinerario1 == $i)) ? 'selected' : ''; ?>><?php echo $nombre; ?></option>

				
		<?php }?>
		</select>
		</div>
		</td>		
		<?php } ?>	
		</tr>
		
		<?php endif; ?>

		<?php endif; ?>

<!-- BILINGÜISMO -->
	<?php if(substr($curso, 0, 1) < 2): ?>
<tr>
	<td colspan="4">
	<div class="form-group">
	<div class="checkbox"><label> <input type="checkbox" name="bilinguismo"
		value="Si" <?php if($bilinguismo == 'Si'){echo "checked";} ?>> El
	alumno/a solicita participar en el programa de bilingüismo (Inglés) </label></div>
	</div>
	</td>
</tr>
	<?php endif; ?>
	
<!-- ENFERMEDADES -->
		<tr>
			<th class="table-active text-center" colspan="4"><span class="text-uppercase">Enfermedades del Alumno:</span><p class="help-block"><small>
			Señalar si el alumno tiene alguna enfermedad que es importante que el
			Centro conozca por poder afectar a la vida académica del alumno.</small></p></th>
		</tr>
		<tr>
			<td colspan="2" style="border-top: 0;">
			<p class="help-block"><small> Señalar si el alumno tiene alguna
	enfermedad que es importante que el Centro conozca por poder afectar a
	la vida académica del alumno.</small></p>

	<label for="enfermedad">Enfermedades del Alumno</label> 
	<select
		class="form-control" id="enfermedad" name="enfermedad"
		onChange="dimeEnfermedad()">
		<option value=""></option>
		<?php for ($i = 0; $i < count($enfermedades); $i++): ?>
		<option value="<?php echo $enfermedades[$i]['id']; ?>"
		<?php echo (isset($enfermedad) && $enfermedad == $enfermedades[$i]['id']) ? 'selected' : ''; ?>><?php echo $enfermedades[$i]['nombre']; ?></option>
		<?php endfor; ?>
	</select> 
	<br>
	 <input style="<?php  if ($enfermedad == 'Otra enfermedad') {	echo "visibility:visible;";}else{	echo "visibility:hidden;";}?>" id = "otraenfermedad" name="otraenfermedad" value="<?php if (isset($otraenfermedad)) { echo $otraenfermedad ;} ?>" type="text" class="form-control" placeholder="Escribe aquí el nombre de la enfermedad" />
			</td>

		<!-- DIVORCIOS -->			
			<td colspan="2" style="border-top: 0;">
			<p class="help-block"><small>
			Señalar si el alumno procede de padres divorciados y cual es la situación legal de la Guardia y Custodia respecto al mismo.</small></p>
		<div
				class="form-group col-sm-10">
			<label for="divorcio">Alumno con padres divorciados</label>					 
			<select
				class="form-control" id="divorcio" name="divorcio">
			<option value=""></option>	
				<?php for ($i = 0; $i < count($divorciados); $i++): ?>
				<option value="<?php echo $divorciados[$i]['id']; ?>"
				<?php echo (isset($divorcio) && $divorcio == $divorciados[$i]['id']) ? 'selected' : ''; ?>><?php echo $divorciados[$i]['nombre']; ?></option>
				<?php endfor; ?>
			</select>
			</div>
			</td>
		</tr>
		
		<!-- FOTO -->
		<tr>
			<th class="table-active text-center" colspan="4"><span class="text-uppercase">Foto del Alumno:</span><p class="help-block"><small>
			Desmarcar si la familia tiene algún inconveniente en que se publiquen en nuestra web fotografías del alumno por motivos educativos (Actividaes Complementarias y Extraescolares, etc.)</small></p></th>
		</tr>
		<tr>
			<td colspan="4" style="border-top: 0;">
		<div
				class="checkbox">
			<label for="foto"> 
			<?php if ($foto==1 or $foto=="") { $extra_foto = "checked";	} else {$extra_foto="";} ?>
			<input	type="checkbox" name = "foto"  id="foto" value = "1" <?php echo $extra_foto;?>>
			 Foto del Alumno </label>
			</div>
			</td>
		</tr>
		
		<!-- OBSERVACIONES -->
		<tr>
			<th class="table-active text-center" colspan="4"><span class="text-uppercase">Observaciones:</span><p class="help-block"><small>
			Indique aquellas cuestiones que considere sean importantes para
			conocimiento del Centro</small></p></th>
		</tr>
		<tr>
			<td colspan="4" style="border-top: 0;"><textarea class="form-control"
				id="observaciones" name="observaciones" rows="5"><?php echo (isset($observaciones)) ? $observaciones : ''; ?></textarea>
			</td>
		</tr>
		<tr>
		<td colspan="4" style="border-bottom: none">

		<center>
		<input type="hidden" name="curso" value="<?php echo $curso;?>" /> <input
			type="hidden" name="nuevo" value="<?php echo $nuevo;?>" /> <input
			type="hidden" name="curso_matricula"
			value="<?php echo $curso_matricula;?>" /> <input type="hidden"
			name="claveal" <?php echo "value = \"$claveal\""; ?> /> <?php 
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

<?php
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
	
</script>

<script languaje="javascript">
	function valida(form) {
		if (form1.idioma1.options[0].selected == true) {
		form1.idioma2.options[2].selected = false;
		}
		if (form1.idioma2.options[2].selected == true) {
		form1.idioma1.options[0].selected = false;
		}

		if (form1.idioma1.options[1].selected == true) {
		form1.idioma2.options[0].selected = false;
		}
		if (form1.idioma2.options[0].selected == true) {
		form1.idioma1.options[1].selected = false;
		}
	}
</script>
