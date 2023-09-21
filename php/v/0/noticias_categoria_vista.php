<?php
// $deportes_row = new_row_noticia("CALL sp_select_categ_ultimas_noticias2(68)");
// Seleciona los tags principales
// $publicaciones_rowtag = select_new_row_categoria($deportes_row,'Deportes');
$noticias_slides = new_row_noticia("CALL sp_select_categorias_ids(0,3,68)");
$deportes = select_new_row_noticias_slider(0,3,'Deportes');

$noticias_slides = new_row_noticia("CALL sp_select_categorias_ids(0,3,69)");
$espectaculos = select_new_row_noticias_slider(0,3,'Deportes');

$contenido_tag = <<<HTML
<div class="section-title sect_dec">
    <h2>Deportes</h2>
</div>
<div class="grid-post-wrap">							
    <div class="more-post-wrap  fl-wrap">
    <div class="list-post-wrap list-post-wrap_column fl-wrap">
            <div class="row">
                $deportes
            </div>
        </div>
    </div>
</div>
<div class="section-title sect_dec">
    <h2>Espectáculos</h2>
</div>
<div class="grid-post-wrap">							
    <div class="more-post-wrap  fl-wrap">
    <div class="list-post-wrap list-post-wrap_column fl-wrap">
            <div class="row">
                $espectaculos
            </div>
        </div>
    </div>
</div>
HTML;
?>