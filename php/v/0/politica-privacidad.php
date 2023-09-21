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

        $frames = '
            <div style="text-align:center;margin-bottom: 25px;">
                <h2 class="puente_titulo">Politica de privacidad</h2>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Su privacidad es importante para nosotros. es XHFJS, S.A. DE C.V. política para respetar su privacidad con respecto a cualquier información que podamos recopilar de usted a través de nuestro sitio web, https://superchannel12.com/, y otros sitios que poseemos y operamos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Solo solicitamos información personal cuando existe una verdadera necesidad para brindarle un servicio y/o para mejorar su experiencia con nosotros. Recopilamos toda la información utilizando medios justos y legales, con su conocimiento y consentimiento.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">XHFJS, S.A. DE C.V. solo retiene la información recopilada durante el tiempo que sea necesario para permitirnos brindarle el servicio solicitado. Protegeremos todos los datos almacenados dentro de los medios comercialmente aceptables para evitar pérdidas y robos, acceso no autorizado, divulgación, copia, uso o modificación.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">No compartiremos públicamente ninguna información de identificación personal, ni compartiremos información con terceros, excepto cuando lo exija la ley.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Nuestro sitio web puede tener enlaces a sitios externos que no son operados por XHFJS, S.A. DE C.V. Tenga en cuenta que no tenemos control sobre el contenido y las prácticas de estos sitios y no podemos aceptar responsabilidad alguna por sus respectivas políticas de privacidad.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Siempre tiene la libertad de rechazar nuestra solicitud de su información personal, en el entendimiento de que, como resultado, es posible que no podamos brindarle ciertos servicios deseados.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Su uso continuado de nuestro sitio web se considerará como la aceptación de nuestras prácticas en materia de privacidad e información personal. Si tiene alguna pregunta sobre cómo manejamos los datos de los usuarios y la información personal, no dude en contactarnos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Esta política es efectiva a partir del 1 de septiembre de 2019.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:50px 50px;">Puede contactar a XHFJS, S.A. DE C.V. en schrznpn@gmail.com, con cualquier pregunta o inquietud con respecto a esta política.
                </p>
            </div>
        ';
echo $frames;
?>
