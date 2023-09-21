<?php
$categ_array = array(
    array(
        'id' => $categ_array_id1,
        'nombre' => $categ_array_nombre1,
        'url' => 'https://superchannel12.com/tag/1/3/piedras-negras',
        'tipo' => 'tag'
    ),
    array(
        'id' => $categ_array_id2,
        'nombre' => $categ_array_nombre2,
        'url' => 'https://superchannel12.com/tag/1/4/eagle-pass',
        'tipo' => 'tag'
    ),
    array(
        'id' => '34',
        'nombre' => 'Cinco Manantiales',
        'url' => 'https://superchannel12.com/sub-tag/1/34/cinco-manantiales',
        'tipo' => 'sub-tag',
    ),
    array(
        'id' => '35',
        'nombre' => 'Region Carbonifera',
        'url' => 'https://superchannel12.com/sub-tag/1/35/region-carbonifera',
        'tipo' => 'sub-tag',
    ),
    array(
        'id' => '36',
        'nombre' => 'Monclova',
        'url' => 'https://superchannel12.com/sub-tag/1/36/monclova',
        'tipo' => 'sub-tag',
    ),
    array(
        'id' => '37',
        'nombre' => 'Saltillo',
        'url' => 'https://superchannel12.com/sub-tag/1/37/saltillo',
        'tipo' => 'sub-tag',
    ),
    array(
        'id' => '40',
        'nombre' => 'Texas',
        'url' => 'https://superchannel12.com/sub-tag/1/40/texas-estados-unidos',
        'tipo' => 'sub-tag',
    ),
    array(
        'id' => '8',
        'nombre' => 'Nacional',
        'url' => 'https://superchannel12.com/tag/1/8/nacional',
        'tipo' => 'tag'
    ),
    array(
        'id' => '10',
        'nombre' => 'Estados Unidos',
        'url' => 'https://superchannel12.com/tag/1/10/estados-unidos',
        'tipo' => 'tag'
    ),
    array(
        'id' => '9',
        'nombre' => 'Mundo',
        'url' => 'https://superchannel12.com/tag/1/9/mundo',
        'tipo' => 'tag'
    ),
);
$div_c = '';
$inicio = 0;
foreach ($categ_array as $categ) {
    $inicio++;
    $categ_id = $categ['id'];
    $categ_nombre = $categ['nombre'];
    $categ_url = $categ['url'];
    $clase = '';
    if($inicio === 1){
        $clase = 'current_page';
    }
    $div_c .= "<a href='javascript:void(0)' id='cambiar_catg' data-id='$categ_id' class='$clase'>$categ_nombre</a>";
}
$noticias_c = '';
foreach ($categ_array as $categ) {
    $categ_id = $categ['id'];
    $tipo = $categ['tipo'];
    // Si es sub-tag
    if($tipo === 'sub-tag'){
        $sprod = 'sp_select_sub_categorias_ids';
    }else{
        $sprod = 'sp_select_categorias_ids';
    }
    $noticias_slides = new_row_noticia("CALL $sprod(0,10,$categ_id)");
    $noticias_c .= select_new_row_noticias_slider(0,10);
}

// $categorias = select_row_categorias(0,10);
// $noticias = select_new_row_noticias(0,10);
$noticias = 0;
echo <<<HTML
<div class="section-title">
    <h2>Noticias recientes</h2>
    <h4>Desliza para ver las notas</h4>
    <div class="li_categorias">
        $div_c
    </div>
</div>
<div class="ajax-wrapper fl-wrap">
    <div id="ajax-content" class="fl-wrap">
        <div class="ajax-inner fl-wrap">
            <div class="list-post-wrap">
                $noticias_c
            </div>
        </div>
    </div>
</div>
HTML;
?>