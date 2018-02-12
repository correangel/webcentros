<?php
require_once("../../bootstrap.php");
require_once("../../config.php");

if (! isset($config['libros_texto']) || $config['libros_texto'] == 0) {
    include("../../error404.php");
}

$niveles = array();

$libros = array();
$result = mysqli_query($db_con, "SELECT isbn, ean, materia, editorial, titulo, nivel FROM textos_gratis ORDER BY nivel ASC, materia ASC");
while ($row = mysqli_fetch_array($result)) {

    $libro = array(
        'isbn'      => $row['isbn'],
        'ean'       => $row['ean'],
        'materia'   => $row['materia'],
        'editorial' => $row['editorial'],
        'titulo'    => $row['titulo'],
        'nivel'     => $row['nivel']
    );

    if (! in_array($row['nivel'], $niveles)) {
        array_push($niveles, $row['nivel']);
    }

    array_push($libros, $libro);
}
mysqli_free_result($result);
unset($libro);

$result = mysqli_query($db_con, "SELECT isbn, departamento, editorial, titulo, nivel FROM Textos ORDER BY nivel ASC, departamento ASC");
while ($row = mysqli_fetch_array($result)) {
    
    $libro = array(
        'isbn'      => $row['isbn'],
        'ean'       => '',
        'materia'   => $row['departamento'],
        'editorial' => $row['editorial'],
        'titulo'    => $row['titulo'],
        'nivel'     => $row['nivel']
    );

    if (! in_array($row['nivel'], $niveles)) {
        array_push($niveles, $row['nivel']);
    }

    array_push($libros, $libro);
}
mysqli_free_result($result);
unset($libro);

$pagina['titulo'] = 'Libros de texto';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Libros de texto";
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <?php foreach ($niveles as $nivel): ?>
            <h4><?php echo $nivel; ?></h4>

            <table class="table table-bordered table-striped" style="font-size: 0.75rem;">
                <thead>
                    <tr>
                        <th width="20%">Asignatura / Materia</th>
                        <th width="13%">ISBN</th>
                        <th width="13%">EAN</th>
                        <th width="23%">Editorial</th>
                        <th width="38%">Título</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libros as $libro): ?>
                    <?php if ($libro['nivel'] == $nivel): ?>
                    <tr>
                        <td><?php echo $libro['materia']; ?></td>
                        <td><?php echo $libro['isbn']; ?></td>
                        <td><?php echo $libro['ean']; ?></td>
                        <td><?php echo $libro['editorial']; ?></td>
                        <td><?php echo $libro['titulo']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endforeach; ?>
            
        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>