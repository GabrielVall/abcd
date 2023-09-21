<!DOCTYPE HTML>
<html lang="es" class="oscuro">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title><?php echo $server_name ?></title>
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="" />
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/plugins.css?1">
        <link type="text/css" rel="stylesheet" href="<?php echo $actual_link ?>/css/style.css?v1.42">
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


$url = str_replace(array('http://localhost', 'https://'), '', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$url = str_replace(array('localhost/proyectos/super_channel/','superchannel12.com/','radiozocalo.com.mx/'), '', $url);
$slash = explode("/", $url);




// eliminar primeros 3 elementos de un array
$tipo = $slash[0];
$num_pag = $slash[1];
$tag_id = $slash[2];
if(isset($slash[3])){
    $categoria_name = $slash[3];
}
$sp_total = "sp_select_total_noticias_autores";
$sp_busqueda = "sp_select_noticias_autor";
if($sp_total === 0){
    $cantidad = array();
    $inicio = 0;
    $final = 10;
    $categoria_name = $tag_id;
    $paginado = '';
    $publicaciones_rowtag = '';
}else{
    $total_noticias_tag = $sql->obtenerResultado("CALL ".$sp_total."({$tag_id})");
    $cantidad = seleccionar_cantidad($num_pag,$total_noticias_tag[0][0]);
    $paginado = crear_paginado($num_pag,$cantidad[2],$tag_id,$categoria_name,$tipo);
    $inicio = $cantidad[0];  
    $final = $cantidad[1];
    $publicaciones_rowtag = crear_div_busqueda("CALL ".$sp_busqueda."($inicio,$final,'".$tag_id."')");
}

$id_autor = $slash[2];

// Seleccionar datos del autor
$autor = $sql->obtenerResultado("CALL sp_buscar_autor_id('".$id_autor."')");
$vistas = $sql->obtenerResultado("CALL sp_count_vistas_autor('".$id_autor."')");
$total_vistas = thousandsCurrencyFormat($vistas[0][0]);
$id_usuario = $autor[0]['id_usuario'];
$nombre_autor = $autor[0]['nombre_autor'];
$apellido_autor = $autor[0]['apellido_autor'];
$descripcion_autor = $autor[0]['descripcion_autor'];
$fecha_registro_usuario = hace_tiempo($autor[0]['fecha_registro_usuario']);
$correo_usuario = $autor[0]['correo_usuario'];
$imagen_autor = select_imagen('usuarios',$id_usuario);
$nombre_completo = $nombre_autor.' '.$apellido_autor;

?>
<section class="autores_page">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="left_fix-bar fl-wrap" style="z-index: auto; position: relative; top: 0px;">
                    <div class="profile-card-wrap fl-wrap">
                        <div class="profile-card_media fl-wrap">
                            <img src="<?php echo $imagen_autor ?>" alt="">
                            <div class="profile-card_media_content">
                                <h4><?php echo $nombre_completo; ?></h4>
                                <h5>Autor desde <?php echo $fecha_registro_usuario; ?></h5>
                            </div>
                            <div class="profile-card-stats">
                                <ul>
                                    <li><span><?php echo thousandsCurrencyFormat($total_noticias_tag[0][0]); ?> </span>Articulos</li>
                                    <li><span><?php echo $total_vistas; ?></span> Visitas</li>
                                </ul>
                            </div>
                        </div>
                        <div class="profile-card_content">
                            <h4>Sobre el autor</h4>
                            <p class="autor_card"><?php echo $descripcion_autor; ?></p>
                            <div class="pc_contacts">
                                <ul>
                                    <li>
                                        <span>Correo:</span> <a href="mailto:<?php echo $correo_usuario; ?>"><?php echo $correo_usuario; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><div style="display: none; width: 365.172px; height: 562px; float: none;"></div>
            </div>
            <div class="col-md-8">
                <div class="main-container fl-wrap fix-container-init">
                    <div class="section-title">
                        <h3> Publicaciones de <?php echo $nombre_completo; ?>:</h3>
                    </div>
                    
                    <div class="grid-post-wrap">
                        <div class="row">
                            <div class='main-container fl-wrap fix-container-init'>
                                <div class='list-post-wrap'>
                                    <?php echo $publicaciones_rowtag ?>
                                </div>
                                <div class='clearfix'></div>
                                <?php echo $paginado ?>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>					
                </div>
            </div>
        </div>
    </div>
    <div class="limit-box fl-wrap"></div>
</section>