<?php 
// Slides principales
$carpeta = 'slides';
$tipo = '1';
if($server_name == 'RadioZocalo' ){
    $carpeta = 'slides_radiozocalo';
    $tipo = '2';
}else if($server_name == 'La Primera'){
    $tipo = '3';
}
$slides = $sql->obtenerResultado("CALL sp_select_slides($tipo)");
$banners = '';
foreach ($slides as $slide){
    $id = $slide['id_slide'];
    $sponsor = $slide['enlace_anuncio'];
    $img = select_imagen('slides/'.$tipo.'/',$id);
    $banners .="
    <div class='swiper-slide no_bttom_shadow'>
        <div class='video-item fl-wrap'>
            <div class='video-item-img fl-wrap'>
                <img src='$img' data-link='$sponsor' data-id='$id' class='respimg'>
            </div>
        </div>
    </div>
    ";
}
// Primeras 3 noticias para adjuntar en el slider
$noticias_slides = new_row_noticia("CALL sp_select_etiquetas_ids(0,11,58)");
$slider = select_new_row_noticias_slider(0,11,'slider');
$min_slider = select_new_row_noticias_slider(0,11,'min_slider');

echo '
<div class="video_carousel  lightgallery">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            '.$banners.'
        </div>
        <div class="multi-pag"></div>
    </div>
</div>
<div class="hero-slider-wrap fl-wrap">
    <div class="hero-slider-container multi-slider fl-wrap full-height">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                '.$slider.'
            </div>
        </div>
        <div class="fs-slider_btn color-bg fs-slider-button-prev"><i class="fas fa-caret-left"></i></div>
        <div class="fs-slider_btn color-bg fs-slider-button-next"><i class="fas fa-caret-right"></i></div>
    </div>
    <div class="hero-slider_controls-wrap">
        <div class="container">
            <div class="hero-slider_controls-list multi-slider_control">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        '.$min_slider.'
                    </div>
                </div>
            </div>
            <div class="multi-pag"></div>
        </div>
    </div>
    <div class="slider-progress-bar act-slider">
        <span>
            <svg class="circ" width="30" height="30">
                <circle class="circ2" cx="15" cy="15" r="13" stroke="rgba(255,255,255,0.4)" stroke-width="1" fill="none" />
                <circle class="circ1" cx="15" cy="15" r="13" stroke="#e93314" stroke-width="2" fill="none" />
            </svg>
        </span>
    </div>
    </div>
    ';
?>