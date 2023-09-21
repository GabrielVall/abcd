<!DOCTYPE HTML>
<html lang="es" class="oscuro">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title><?php echo $server_name; ?></title>
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
        <div id="main">
<?php
include_once('php/v/0/header.php');
echo $header_main;
include_once('php/v/0/tag.php');
include_once('php/v/0/seguidores.php');
$url = str_replace(array('http://localhost', 'https://'), '', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$url = str_replace(array('localhost/proyectos/super_channel/','superchannel12.com/','radiozocalo.com.mx/','laprimera.com.mx/'), '', $url);
$slash = explode("/", $url);
// eliminar primeros 3 elementos de un array
$tipo = $slash[0] ?? '';
$num_pag = $slash[1] ?? '';
$tag_id = $slash[2] ?? '';
$categoria_name = isset($slash[3]) ? transform_titulo($slash[3]) : null;

$sp_total = 0;
$sp_busqueda = 0;

if ($tipo == 'tag') {
    $sp_total = "sp_select_total_categorias";
    $sp_busqueda = "sp_select_categorias_ids";
} else if ($tipo == 'sub-tag') {
    $sp_total = "sp_select_total_sub_categorias";
    $sp_busqueda = "sp_select_sub_categorias_ids";
} else if ($tipo == 'etiqueta') {
    $sp_total = "sp_select_total_etiquetas";
    $sp_busqueda = "sp_select_etiquetas_ids";
} else if ($tipo == 'busqueda') {
    // Leave $sp_total and $sp_busqueda as 0
}

if ($sp_total === 0) {
    $cantidad = [];
    $inicio = 0;
    $final = 10;
    $categoria_name = transform_titulo($tag_id);
    $paginado = '';
    $publicaciones_rowtag = '';
} else {
    $total_noticias_tag = $sql->obtenerResultado("CALL " . $sp_total . "({$tag_id})");

    if (!empty($total_noticias_tag) && isset($total_noticias_tag[0][0])) {
        $cantidad = seleccionar_cantidad($num_pag, $total_noticias_tag[0][0]);
        $paginado = crear_paginado($num_pag, $cantidad[2], $tag_id, $categoria_name, $tipo);
        $inicio = $cantidad[0];
        $final = $cantidad[1];
        $publicaciones_rowtag = crear_div_busqueda("CALL " . $sp_busqueda . "($inicio,$final,'" . $tag_id . "')");
    } else {
        $publicaciones_rowtag = '';
        $paginado = '';
    }
}

if (empty($publicaciones_rowtag) && $sp_busqueda !== 0) {
    $publicaciones_rowtag = "
        <div class='col-md-12'>
            <script src='https://cdn.lordicon.com/lusqsztk.js'></script>
            <lord-icon
                src='https://cdn.lordicon.com/msoeawqm.json'
                trigger='hover'
                colors='primary:#121331,secondary:#e93314'
                style='width:250px;height:250px'>
            </lord-icon>
            <h1 style='font-size:2em;'>No se han encontrado resultados</h1>
        </div>
    ";
    $paginado = '';
} else if ($sp_busqueda === 0) {
    $publicaciones_rowtag = "
        <span id='busqueda_row_tag' data-busqueda='{$categoria_name}' data-final='10'></span>
        <svg id='svg_carga' viewbox='0 0 128 128' width='100%' height='100%'>
            <path class='doc' d='M0-0.00002,0,3.6768,0,124.32,0,128h4.129,119.74,4.129v-3.6769-120.65-3.6768h-4.129-119.74zm8.2581,7.3537,111.48,0,0,113.29-111.48,0zm13.626,25.048,0,7.3537,57.806,0,0-7.3537zm0,19.12,0,7.3537,84.232,0,0-7.3537zm0,17.649,0,7.3537,84.232,0,0-7.3537zm0,19.12,0,7.3537,84.232,0,0-7.3537z7z'/>
            <path class='magnify' d='M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z'/>
        </svg>
        <h3 class='searching_text'>Buscando resultados para: {$categoria_name}...</h3>
    ";
    $paginado = '';
}

$busqueda = traer_row_busqueda();

echo "
<div class='content'>
    <div class='breadcrumbs-header fl-wrap'>
        <div class='container'>
            <div class='breadcrumbs-header_url'>
                <a href='$actual_link'>Inicio</a><span>$tipo</span><span>$categoria_name</span>
            </div>
            <div class='scroll-down-wrap'>
                <div class='mousey'>
                    <div class='scroller'></div>
                </div>
                <span>Deliza para ver más</span>
            </div>
        </div>
    </div>
    <section>
        <div class='container'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='main-container fl-wrap fix-container-init'>
                        <div class='section-title'>
                            <h2>$categoria_name</h2>
                        </div>
                        <div class='list-post-wrap'>
                            $publicaciones_rowtag		
                        </div>
                        <div class='clearfix'></div>
                        $paginado
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='sidebar-content fl-wrap fixed-bar fixbar-action' style='z-index: auto; position: relative; top: 0px;'>
                        <div class='box-widget fl-wrap'>
                            <div class='box-widget-content'>
                                <div class='search-widget fl-wrap'>
                                    $busqueda
                                </div>
                            </div>
                        </div>
                        <span id='categorias_populares'>
                            <!-- Loader -->
                            <i class='gg-spinner'></i>
                        </span>
                        $popular_tags
                        $siguenos_html				
                    </div><div style='display: none; width: 411.297px; height: 1712.55px; float: none;'></div>
                    <!-- sidebar  end -->
                </div>
            </div>
            <div class='limit-box fl-wrap'></div>
        </div>
    </section>
    </div>
";

?>