<?php
include_once("../../m/SQLConexion.php");
include_once('../../m/funciones.php');
$sql = new SQLConexion();
$popular_cat = $sql->obtenerResultado("CALL sp_select_categorias_populares()");
$popular_rows = "";
foreach ($popular_cat as $popular_row) {
    $nombre_popular_row = $popular_row['nombre_categoria_noticia'];
    $id = $popular_row['id_categoria_noticia'];
    $total_popular_row = $sql->obtenerResultado("CALL sp_select_count_categ_id($id)");
    $total = thousandsCurrencyFormat($total_popular_row[0][0]);
    $url = $actual_link . "/tag/1/" . $id . "/" . $popular_row['slug_categoria_noticia'];
    $popular_rows .= "<li><a href='$url'>$nombre_popular_row</a><span>$total</span></li>";
}
$categorias_populares ="
<div class='box-widget fl-wrap'>
    <div class='widget-title'>Categorias</div>
    <div class='box-widget-content'>
        <ul class='cat-wid-list'>
            $popular_rows
        </ul>
    </div>
</div>";
echo $categorias_populares;