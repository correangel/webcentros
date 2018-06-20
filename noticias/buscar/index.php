<?php
require_once("../../bootstrap.php");
require_once("../../config.php");

$query_sql = "";

if ( isset($_GET['q']) && (strlen(trim($_GET['q'])) > 3) ) {
    $query = isset($_GET['q']) ? xss_clean(trim($_GET['q'])) : '';
    $query = mysqli_real_escape_string($db_con, $query);
    $query_sql = "AND (titulo LIKE '$query%' OR titulo LIKE '% $query%' OR contenido LIKE '$query%' OR contenido LIKE '% $query%')";
}
elseif ( isset($_GET['q']) && ! (strlen(trim($_GET['q'])) > 3) ) {
    $msg_warning = true;
    $msg_warning_text = "Debe introducir al menos 3 caracteres para iniciar una búsqueda";
}

if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    $pag = intval($_GET['p']);
    $pag = ($pag > 1) ? $pag : 0;
}
else {
    $pag = 0;
}

$limite = 25;

$result = mysqli_query($db_con, "SELECT id, titulo, contenido, fechapub FROM noticias WHERE pagina LIKE '%2%' $query_sql ORDER BY fechapub DESC");
$total_noticias = mysqli_num_rows($result);
mysqli_free_result($result);

$total_pags = round($total_noticias / $limite);
$query_sig = $pag * $limite;

$noticias = array();
$result = mysqli_query($db_con, "SELECT id, titulo, contenido, fechapub FROM noticias WHERE pagina LIKE '%2%' $query_sql ORDER BY fechapub DESC LIMIT $query_sig , $limite");
while ($row = mysqli_fetch_array($result)) {

    $noticia = array(
        'id'        => $row['id'],
        'titulo'    => $row['titulo'],
        'fechapub'  => $row['fechapub'],
        'alias'     => mb_strtolower(str_replace($acentos, $no_acentos, $row['titulo']))
    );

    array_push($noticias, $noticia);
}
mysqli_free_result($result);
unset($noticia);

$pagina['titulo'] = 'Novedades en el instituto';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Buscar noticias y novedades en ".$config['centro_denominacion'];
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-9">

                    <form action="" method="get" autocomplete="off">
                        <label for="buscar"></label>
                        <div class="input-group input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons ui-1_zoom-bold"></i>
                            </span>
                            <input type="text" id="buscar" name="q" class="form-control" placeholder="Buscar una noticia" value="<?php echo xss_clean($_GET['q']); ?>" autocomplete="off">
                        </div>
                    </form>

                    <br>

                    <?php if (isset($msg_warning) && $msg_warning): ?>
                    <div class="alert alert-warning">
                        <?php echo $msg_warning_text; ?>
                    </div>
                    <br>
                    <?php endif; ?>

                    <?php if ($total_noticias > 0): ?>

                    <p class="text-muted text-right"><small><?php echo ($pag < 1) ? '1' : $pag; ?> - <?php echo ($total_noticias >= $limite) ? $limite : $total_noticias; ?> de <?php echo $total_noticias; ?> resultados</small></p>

                    <table class="table">
                        <tbody>
                            <?php foreach ($noticias as $noticia): ?>
                            <?php $url_noticia = WEBCENTROS_DOMINIO."noticias/".$noticia['id']."/".$noticia['alias']; ?>
                            <tr>
                                <td class="text-info" nowrap><?php echo strftime('%e %B %Y', strtotime($noticia['fechapub'])); ?></td>
                                <td><a href="<?php echo $url_noticia; ?>" class="black"><?php echo strip_tags($noticia['titulo']); ?></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <br>

                    <?php if ($total_pags > 1): ?>
                    <nav role="pagination">
                        <ul class="pagination justify-content-sm-center">
                            <?php if ($pag < 1): ?>
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
                            <?php else: ?>
                            <li class="page-item"><a class="page-link" href="<?php echo WEBCENTROS_DOMINIO; ?>noticias/buscar/?p=<?php echo ($pag - 1); ?><?php echo (isset($_GET['q'])) ? '&amp;q='.htmlspecialchars(strip_tags(trim($_GET['q'])), ENT_QUOTES, 'UTF-8') : ''; ?>">&laquo;</a></li>
                            <?php endif; ?>
                            <?php for ($num = 1; $num <= $total_pags; $num++): ?>
                            <li class="page-item<?php echo ($pag == $num || $pag == 0 && $num == 1) ? ' active' : ''; ?>"><a class="page-link" href="<?php echo WEBCENTROS_DOMINIO; ?>noticias/buscar/?p=<?php echo $num; ?><?php echo (isset($_GET['q'])) ? '&amp;q='.htmlspecialchars(strip_tags(trim($_GET['q'])), ENT_QUOTES, 'UTF-8') : ''; ?>"><?php echo $num; ?></a></li>
                            <?php endfor; ?>
                            <?php if ($pag < $total_pags): ?>
                            <li class="page-item"><a class="page-link" href="<?php echo WEBCENTROS_DOMINIO; ?>noticias/buscar/?p=<?php echo ($pag + 1); ?><?php echo (isset($_GET['q'])) ? '&amp;q='.htmlspecialchars(strip_tags(trim($_GET['q'])), ENT_QUOTES, 'UTF-8') : ''; ?>">&raquo;</a></li>
                            <?php else: ?>
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&raquo;</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <?php endif; ?>

                    <?php else: // ($total_noticias > 0) ?>

                    <div class="alert alert-warning">
                        Lo sentimos, no hemos encontrado resultados.
                    </div>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>
