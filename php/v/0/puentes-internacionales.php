<!DOCTYPE HTML>
<html lang="es" class="oscuro">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>SuperChannel12</title>
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="" />
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/plugins.css?1">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/style.css?v1.42">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/color.css?v1">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/dark.css?v1">
        <link rel="shortcut icon" href="https://superchannel12.com/<?php echo $server_name ?>.png">
    </head>
    <body>
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

        ?>
        
        <div id="main" style="padding-top:5%;">
        
<?php
include_once('php/v/0/header.php');
?>
<div class="video_carousel  lightgallery" style="padding-top:5%;" >
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php echo $banners; ?>
        </div>
        <div class="multi-pag"></div>
    </div>
</div>
<?php
echo $header_main;
$init = 9;
$end = 13;
$frames = '';
$numero = 0;
for ($i=$init; $i <= $end; $i++) { 
    $numero = $numero + 1;
    $puente = 'Puente camara '.$puente_num;
    $frame = $configuraciones[$i][2];
    if($frame != ''){
        $frames .= '
            <h2 class="puente_titulo">Puente camara '.$numero.'</h2>
            <div class="video-responsive full_vid">
                <iframe width="640" class="" height="360" src="'.$configuraciones[$i][2].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        ';
    }
}
echo $frames;
?>
