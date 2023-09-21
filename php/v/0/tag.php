<?php
// Seleciona los tags principales
$etiquetas = $sql->obtenerResultado("CALL sp_select_etiquetas_vista(20)");
$etiquetas_row = '';

foreach ($etiquetas as $etiqueta) {
    $id = $etiqueta['id_etiqueta'];
    $nombre_etiqueta = $etiqueta['etiqueta'];
    $slug = $etiqueta['slug_etiqueta'];
    $etiquetas_row .= "<a href='$actual_link/etiqueta/1/$id/$slug'>$nombre_etiqueta</a>";
}

$popular_tags = "
<div class='box-widget fl-wrap'>
    <div class='widget-title'>Etiquetas populares</div>
    <div class='box-widget-content'>
        <div class='tags-widget'>
            $etiquetas_row
        </div>
    </div>
</div>
";

?>