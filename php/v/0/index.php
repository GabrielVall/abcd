<!DOCTYPE HTML>
<html lang="es" class="oscuro">
    <head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $server_name=="SuperChannel" ? 'G-Y1ZZ1HSYTE' : 'G-7ZLBYMJYMN'; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo $server_name=="SuperChannel" ? 'G-Y1ZZ1HSYTE' : 'G-7ZLBYMJYMN'; ?>');
        </script>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>
            <?php
                $client_ip = getClientIP();
                if($server_name == 'SuperChannel'){
                    $noticia = $sql->obtenerResultadoSimple("CALL sp_insert_vista_slide('".$client_ip."',1)");
                    echo 'Super Channel 12, Piedras Negras - Eagle Pass, Cinco Manantiales';
                }else if($server_name == 'RadioZocalo'){
                    $noticia = $sql->obtenerResultadoSimple("CALL sp_insert_vista_slide('".$client_ip."',2)");
                    echo 'Radio Zócalo, Piedras Negras - Eagle Pass, Cinco Manantiales, Acuña, Del Rio';
                }else{
                    $noticia = $sql->obtenerResultadoSimple("CALL sp_insert_vista_slide('".$client_ip."',3)");
                    echo 'La Primera - Torreon';
                }
            ?>
        </title>
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="" />
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/plugins.css?1">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/style.css?v1.45">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/color.css?v1">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/dark.css?v1">
        <link rel="shortcut icon" href="https://superchannel12.com/<?php echo $server_name ?>.png">
        <script async src='https://cdn.relappro.com/adservices/v4/relapads.lite.js'></script>
        <script>
            var adserviceslt = adserviceslt || {};
            adserviceslt.cmd = adserviceslt.cmd || [];
            adserviceslt.cmd.push(() => {
                adserviceslt.define('6ac49630-2442-4778-9332-46815118801b');
            });
        </script>
    </head>
    <body>
        <div id='relappro_01'>
            <script>
                var adserviceslt = adserviceslt || {};
                adserviceslt.cmd = adserviceslt.cmd || [];
                adserviceslt.cmd.push(() => {
                    adserviceslt.getAd('6ac49630-2442-4778-9332-46815118801b', 'relappro_01');
                });
            </script>
        </div>
        <div id="main">
<?php 
include_once('php/v/0/header.php'); 
echo $header_main; 
?>
<div class="content">
<?php 
    $noticias_row = new_row_noticia("CALL sp_select_ultimas_noticias2()");
    $videos_row = new_row_noticia("CALL sp_select_categ_ultimas_noticias2(56)");
    include_once('php/v/0/slider.php');
?>
<?php 
if($_SERVER['SERVER_NAME'] == 'radiozocalo.com.mx' || $_SERVER['SERVER_NAME'] == 'laprimera.com.mx'){
    $radios = array(
        array(
            'id' => '15',
             'src' => get_parm($configuraciones[14][2],0),
             'web' => get_parm($configuraciones[14][2],1),
        ),
        array(
            'id' => '16',
             'src' => get_parm($configuraciones[15][2],0),
             'web' => get_parm($configuraciones[15][2],1),
        ),
        array(
            'id' => '17',
             'src' => get_parm($configuraciones[16][2],0),
             'web' => get_parm($configuraciones[16][2],1),
        ),
        array(
            'id' => '18',
             'src' => get_parm($configuraciones[17][2],0),
             'web' => get_parm($configuraciones[17][2],1),
        ),
        array(
            'id' => '19',
             'src' => get_parm($configuraciones[18][2],0),
             'web' => get_parm($configuraciones[18][2],1),
        ),
        array(
            'id' => '20',
             'src' => get_parm($configuraciones[19][2],0),
             'web' => get_parm($configuraciones[19][2],1),
        )
    );
    $div_radio = '';
    foreach($radios as $radio){
            $src = $radio['src'];
            $id = $radio['id'];
            $web = $radio['web'];
            $imagen = select_imagen('radios',$id);
            $div_radio .= "
            <div class='swiper-slide'>
                <div class='grid-post-item  bold_gpi  fl-wrap'>
                    <div class='grid-post-media gpm_sing'>
                        <div class='bg' data-bg='$imagen'></div>
                        <div class='grid-post-media_title'>
                            <div class='footer_zocalo'>
                                <div class='main_div'>
                                    <button id='audio_play' class='button_audio' data-audio='$src'>
                                    <svg style='width:25px;padding-right:5px;' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z'></path></svg>
                                    <span id='text_but'>Escuchar</span>
                                    <div class='loader'>
                                        <span class='bar'></span>
                                        <span class='bar'></span>
                                        <span class='bar'></span>
                                    </div>
                                    </button> 
                                </div>
                                <div class='main_div web'>
                                    <button class='button_audio button_web' data-ref='$web'>
                                    <svg style='width:25px;padding-right:5px;' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'></path></svg>
                                        Ver página web
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
    }
?>
<audio controls style="display:none;" id="audio">
    <source src="" type="audio/ogg">
    Your browser does not support the audio element.
</audio>
 <section class="no-padding" style="margin-top:30px;">
    <div class="fs-carousel-wrap">
        <div class="fs-carousel-wrap_title">
            <div class="fs-carousel-wrap_title-wrap fl-wrap">
                <h4>Escucha tu estación favorita</h4>
                <h5>Enlaces directos a los canales de radio las 24 horas del día</h5>
            </div>
            <div class="abs_bg"></div>
            <div class="gs-controls">
                <div class="gs_button gc-button-next"><i class="fas fa-caret-right"></i></div>
                <div class="gs_button gc-button-prev"><i class="fas fa-caret-left"></i></div>
            </div>
        </div>
        <div class="fs-carousel fl-wrap">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php echo $div_radio; ?>
                    					
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<section>

    <div class="container">
    <div id="banner_app" style="
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 5em;
    ">
        

    </div>
        <div class="row">
            <div class="col-md-8">
                <div class="main-container fl-wrap fix-container-init">
                    <?php  include_once('php/v/0/noticias_recientes.php'); ?>
                    <div class="clearfix"></div>
                    <?php 
                        $cantidad_tag = 10;
                        $tag_id = 12;
                        include_once('php/v/0/noticias_categoria_vista.php');
                        echo $contenido_tag;
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar-content fl-wrap fix-bar">
                    <?php include_once('php/v/0/seguidores.php'); 
                        echo $siguenos_html;
                    ?>
                    <?php include_once('php/v/0/tag.php'); 
                        echo $popular_tags
                    ?>
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
    </div>
</section>
<!-- <section class="dark-bg no-bottom-padding">
    <div class="container">
    <div class="main-video-wrap fl-wrap">
            <div class="video-main-cont">
                <div class="video-section-title fl-wrap">
                    <h2>No te pierdas los videos más recientes</h2>
                    <a href="<?php // echo $actual_link.'/tag/1/56/video' ?>">Ver más <i class="fas fa-caret-right"></i></a>
                </div>
                <a class="video-holder vh-main fl-wrap  image-popup"  >
                    <div class="bg"></div>
                    <div class="overlay"></div>
                    <div class="big_prom"> <i class="fas fa-play"></i></div>
                </a>
                <div class="video-holder-title fl-wrap">
                    <div class="video-holder-title_item"><a href="#"></a></div>
                    <span class="video-date"><i class="far fa-clock"></i> <strong></strong></span>
                    <a class="post-category-marker" href="category.html"></a>
                </div>
                <div class="vh-preloader"></div>
            </div>
            <?php // include_once('php/v/0/videos.php'); ?>
        </div>
    </div>
    <div class="video_carousel-wrap fl-wrap">
        <div class="container">
        
        </div>
    </div>
</section> -->
<?php include_once('php/v/0/ultimas_entradas.php'); ?>
</div>