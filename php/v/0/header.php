<?php
// Incluir el archivo de configuración PHP
include 'config/settings.php';
// Noticias que salen en el top de la pagina
$recientes = $sql->obtenerResultado("CALL sp_select_publicaciones_fecha2(5)");
$param_get = 0;
if($server_name == 'RadioZocalo' ){
    $param_get = 1;
}
// Links de redes sociales
$facebook = get_parm($configuraciones[0][2],$param_get);
$insta = get_parm($configuraciones[1][2],$param_get);
$yt = get_parm($configuraciones[2][2],$param_get);
$twitter = get_parm($configuraciones[7][2],$param_get);
$tv_en_vivo = get_parm($configuraciones[8][2],$param_get);
$noticias_recientes = '';
foreach ($recientes as $noticia) {
    $noticias = $sql->obtenerResultado("CALL sp_select_publicacion_id($noticia[0])");
    $url = $noticias[0]['URL'];
    $id_nt = $noticias[0]['id_publicacion'];
    $noticia = strip_tags($noticias[0]['titulo_publicacion']);
    $noticias_recientes.= "<li><a href='$actual_link/$id_nt/$url'>{$noticia}</a></li>";
}
$boton_acceso = '<span class="header-tooltip">Acceder</span>';
if( isset( $_SESSION['id_usuario_superchannel'] ) ){
    $boton_acceso = '<span class="header-tooltip" id="admin_return_btn">Regresar</span>';
}else{
    $boton_acceso = '<span class="header-tooltip">Acceder</span>';
}
// Opciones Barra de navegación
$header_options = array(
    $categorias_header[0],
    $categorias_header[1],
    array(
        'id' => '7',
        'nombre' => 'Coahuila',
        'slug' => 'coahuila',
        'sub_categorias' =>  array(
            array(
                'id_sub_categ' => '66',
                'sub_categ_name' => 'AcuÑa',
                'sub_categ_slug' => 'AcuÑa',
            ),
            array(
                'id_sub_categ' => '34',
                'sub_categ_name' => 'Cinco Manantiales',
                'sub_categ_slug' => 'cinco-manantiales',
            ),
            array(
                'id_sub_categ' => '35',
                'sub_categ_name' => 'Región Carbonífera',
                'sub_categ_slug' => 'region-carbonifera',
            ),
            array(
                'id_sub_categ' => '36',
                'sub_categ_name' => 'Monclova',
                'sub_categ_slug' => 'monclova',
            ),
            array(
                'id_sub_categ' => '37',
                'sub_categ_name' => 'Saltillo',
                'sub_categ_slug' => 'saltillo',
            ),
            array(
                'id_sub_categ' => '38',
                'sub_categ_name' => 'Torreón',
                'sub_categ_slug' => 'torreon',
            ),
        )
    ),
    array(
        'id' => '8',
        'nombre' => 'Nacional',
        'slug' => 'nacional',
        'sub_categorias' => null
    ),
    array(
        'id' => '10',
        'nombre' => 'EUA',
        'slug' => 'estados-unidos',
        'sub_categorias' =>  array(
            array(
                'id_sub_categ' => '41',
                'sub_categ_name' => 'Del Rio',
                'sub_categ_slug' => 'del-rio',
            ),
            array(
                'id_sub_categ' => '40',
                'sub_categ_name' => 'Texas',
                'sub_categ_slug' => 'texas-estados-unidos',
            ),
        )
    ),
    array(
        'id' => '9',
        'nombre' => 'Mundo',
        'slug' => 'mundo',
        'sub_categorias' => null
    ),
    array(
        'id' => '56',
        'nombre' => 'Videos',
        'slug' => 'video',
        'sub_categorias' => null
    )
);
$ul = '';
foreach($header_options as $header){
    $ul.= "<li class='main_li'><a href='$actual_link/tag/1/{$header['id']}/{$header['slug']}'>{$header['nombre']}</a>";
    if($header['sub_categorias'] != null){
        $ul.= "<ul>";
        foreach($header['sub_categorias'] as $sub_categ){
            $ul.= "<li><a href='$actual_link/sub-tag/1/{$sub_categ['id_sub_categ']}/{$sub_categ['sub_categ_slug']}'>{$sub_categ['sub_categ_name']}</a></li>";
        }
        $ul.= "</ul>";
    }
    $ul.= "</li>";
}
$busqueda = traer_row_busqueda('');
$configuraciones = $sql->obtenerResultado("CALL sp_select_configuraciones()");
$telefono_pub = get_parm($configuraciones[20][2],$param_get);
$edicion_impresa = '';
if($server_name != 'La Primera'){
    $edicion_impresa = '
    <a href="https://www.zocalo.com.mx/edicion-impresa/" class="float promo" style="background: none; position: fixed; bottom: 80px; right: 25px; color: rgb(255, 255, 255); text-align: center; z-index: 99; font-size: 1.5em; padding: 8px 16px; --darkreader-inline-bgimage:none; --darkreader-inline-bgcolor: initial; --darkreader-inline-color:#e8e6e3;" data-darkreader-inline-bgimage="" data-darkreader-inline-bgcolor="" data-darkreader-inline-color="">
        <img src="'.$actual_link.'/eim.webp" style="width:100%; max-width:180px !important;">

    </a>
    ';
}
$puentes_inter = '<li><a href="'.$actual_link.'/puentes-internacionales" style="width:160px; heigtht:40px;" >Puentes internacionales</a></li>';
$puentes_inter2 = '<div class="nd5 nds" ref="'.$actual_link.'/puentes-internacionales">
<div class="letter">
    <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:32px;" viewBox="0 0 576 512">
            <path d="M544 32C561.7 32 576 46.33 576 64C576 81.67 561.7 96 544 96H504V160H576V288C522.1 288 480 330.1 480 384V448C480 465.7 465.7 480 448 480H416C398.3 480 384 465.7 384 448V384C384 330.1 341 288 288 288C234.1 288 192 330.1 192 384V448C192 465.7 177.7 480 160 480H128C110.3 480 96 465.7 96 448V384C96 330.1 53.02 288 0 288V160H72V96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H544zM456 96H376V160H456V96zM248 96V160H328V96H248zM200 96H120V160H200V96z"/>
        </svg>
    </div>
    <span>Puentes Internacionales</span>
</div>
</div>';
$zocalosvg = '<div class="nd8 nds" target="_blank" ref="https://www.zocalo.com.mx/edicion-impresa/">
<div class="letter">
<img src="'.$actual_link.'/eim.webp" style="max-width:200px;">
</div>
</div>';
$pronostico_div = '<li class="ctg"><a href="'.$actual_link.'/pronostico">Pronostico del tiempo</a></li>';
if($server_name == 'La Primera'){
    $puentes_inter = '';
    $puentes_inter2 = '';
    $zocalosvg = '';
    $pronostico_div = '';
}
$header_main = <<<HTML
 $edicion_impresa
<div id="container-floating" >
    $zocalosvg
    <div class="nd7 nds" target="_blank" ref="https://wa.me/$telefono_pub">
        <div class="letter">
            <div class="icon">
                <svg style="max-width: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
            </div>
            <span>WhatsApp</span>
        </div>
    </div>
    <div class="nd6 nds" ref="$actual_link/pronostico">
        <div class="letter">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg"style="width:32px;" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 208c0-61.86 50.14-111.1 111.1-111.1c52.65 0 96.5 36.45 108.5 85.42C334.7 173.1 354.7 168 375.1 168c4.607 0 9.152 .3809 13.68 .8203l24.13-34.76c5.145-7.414 .8965-17.67-7.984-19.27L317.2 98.78L301.2 10.21C299.6 1.325 289.4-2.919 281.9 2.226L208 53.54L134.1 2.225C126.6-2.92 116.4 1.326 114.8 10.21L98.78 98.78L10.21 114.8C1.326 116.4-2.922 126.7 2.223 134.1l51.3 73.94L2.224 281.9c-5.145 7.414-.8975 17.67 7.983 19.27L98.78 317.2l16.01 88.58c1.604 8.881 11.86 13.13 19.27 7.982l10.71-7.432c2.725-35.15 19.85-66.51 45.83-88.1C137.1 309.8 96 263.9 96 208zM128 208c0 44.18 35.82 80 80 80c9.729 0 18.93-1.996 27.56-5.176c7.002-33.65 25.53-62.85 51.57-83.44C282.8 159.3 249.2 128 208 128C163.8 128 128 163.8 128 208zM575.2 325.6c.125-2 .7453-3.744 .7453-5.619c0-35.38-28.75-64-63.1-64c-12.62 0-24.25 3.749-34.13 9.999c-17.62-38.88-56.5-65.1-101.9-65.1c-61.75 0-112 50.12-112 111.1c0 3 .7522 5.743 .8772 8.618c-49.63 3.75-88.88 44.74-88.88 95.37C175.1 469 218.1 512 271.1 512h272c53 0 96-42.99 96-95.99C639.1 373.9 612.7 338.6 575.2 325.6z"/></svg>
            </div>
            <span>Pronostico del tiempo</span>
        </div>
    </div>
    $puentes_inter2

    <div class="nd4 nds" ref="$twitter">
        <div class="letter">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px;" viewBox="0 0 512 512">
                    <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                </svg>
            </div>
            <span>Twitter</span>
        </div>
    </div>
    
    <div class="nd3 nds" ref="$insta">
        <div class="letter">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px;" viewBox="0 0 448 512">
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                </svg>
            </div>
            <span>Instagram</span>
        </div>
    </div>

    <div class="nd2 nds" ref="$yt">
        <div class="letter">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px;" viewBox="0 0 576 512">
                    <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/>
                </svg>
            </div>
            <span>YouTube</span>
        </div>
    </div>
    
    <div class="nd1 nds" ref="$facebook">
        <div class="letter">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:32px;" viewBox="0 0 512 512">
                    <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                </svg> 
            </div>
            <span>Facebook</span>
        </div>
    </div>
    <div id="floating-button">
        <p class="plus">+</p>
        <img class="edit" src="https://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
    </div>
</div>
<div class="progress-bar-wrap">
    <div class="progress-bar color-bg"></div>
</div>
<header class="main-header">
    <div class="top-bar fl-wrap">
        <div class="container">
            <div class="date-holder">
                <span class="date_num sp"></span>
                <span class="date_month sp">C</span>
                <span class="date_year sp"> <i class="fas fa-drop"></i> <img style="width:32px;" src=""></span>
                <span class="date_num sp" style="display:none"></span>
                <span class="date_month sp" style="display:none"></span>
                <span class="date_year sp" style="display:none"> </span>
            </div>
            <div class="header_news-ticker-wrap">
                <div class="hnt_title">Recientes</div>
                <div class="header_news-ticker fl-wrap">
                    <ul>$noticias_recientes</ul>
                </div>
                <div class="n_contr-wrap">
                    <div class="n_contr p_btn"><i class="fas fa-caret-left"></i></div>
                    <div class="n_contr n_btn"><i class="fas fa-caret-right"></i></div>
                </div>
            </div>
            <ul class="topbar-social">
                <li><a href="$facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="$yt" target="_blank"><i class="fab fa-youtube"></i></a></li>
                <li><a href="$insta" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li><a href="$twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>
                $puentes_inter
            </ul>
        </div>
    </div>
    <!-- top bar end -->
    <div class="side_bar_menu">
        <div class="close_side_bar">
            <i class="gg-close"></i>
        </div>
        <img class="logo_spc" src="$logo_dominio" alt="">
        <div class="contenido_menu">
            <li class="ctg tiempo_fecha">
                <span>22 C°</span><span>12 Mayo 2022</span>
            </li>
            $ul
            <div class="media_social">
                <div class="icono_social"><a href="$facebook" target="_blank"><i class="gg-facebook"></i></a></div>
                <div class="icono_social"><a href="$twitter" target="_blank"><i class="gg-twitter"></i></a></div>
                <div class="icono_social"><a href="$yt" target="_blank"><i class="gg-youtube"></i></a></div>
                <div class="icono_social"><a href="$insta" target="_blank"><i class="gg-instagram"></i></a></div>
            </div>
            <li class="ctg">
                <a href="https://www.zocalo.com.mx/edicion-impresa/" class="ctg tv_icon">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 500 200" style="enable-background:new 0 0 500 200;" xml:space="preserve"><style type="text/css">.st0{fill:#C32122;}.st1{fill:#FFFFFF;}.st2{fill:#FFD737;}</style><g><g><path class="st0" d="M26.46,68.44h64.8c11.5,0,20.9,8.69,20.9,19.32v59.88c0,10.62-9.41,19.32-20.9,19.32h-64.8 c-11.5,0-20.9-8.69-20.9-19.32V87.76C5.55,77.13,14.96,68.44,26.46,68.44z"/></g><g><path class="st1" d="M71.2,85.55c-0.05,2.23,0.23,4.23-1.03,6.31c-10.39,17.12-20.66,34.31-30.96,51.49	c-0.21,0.35-0.4,0.72-0.64,1.17c0.3,0.08,0.52,0.19,0.74,0.19c5.97-0.02,11.95,0.07,17.87-0.92c2.96-0.49,5.48-1.83,7.23-4.31 c1.25-1.76,2.36-3.64,3.38-5.55c0.5-0.94,1.03-1.4,2.11-1.26c0.65,0.09,1.31,0.02,1.86,0.02c-0.58,6.18-1.15,12.22-1.71,18.21 c-17.49,0-35.06,0-52.83,0c0.21-2.32-0.42-4.68,1.04-7.09c10.35-17,20.56-34.08,30.82-51.13c0.23-0.38,0.44-0.77,0.78-1.37 c-2.35,0-4.47-0.05-6.58,0.01c-2.92,0.08-5.85,0.18-8.76,0.39c-4.51,0.32-7.58,2.74-9.49,6.76c-0.12,0.26-0.26,0.52-0.39,0.78 c-1.29,2.75-1.29,2.75-4.57,2.44c0-0.59,0-1.19,0-1.79c0-4.29,0.05-8.59-0.04-12.88c-0.04-1.94,0.85-2.82,2.77-2.46	c5.85,1.09,11.77,1.4,17.71,1.39c8.23-0.01,16.47-0.07,24.7-0.14C67.16,85.81,69.11,85.65,71.2,85.55z"/><path class="st1" d="M89.27,150.87c-5.46,0.48-11.04-3.44-11.05-10.7c-0.01-6.74,4.53-11.27,11.37-11.26 c6.49,0,10.92,4.45,10.91,10.97C100.49,146.87,95.34,151.35,89.27,150.87z"/></g></g><path class="st2" d="M451.15,163.44H164.64c-25.16,0-45.75-20.59-45.75-45.75v0c0-25.16,20.59-45.75,45.75-45.75h286.51 c25.16,0,45.75,20.59,45.75,45.75v0C496.9,142.86,476.31,163.44,451.15,163.44z"/><g><path d="M148.14,109.58v7.99h9.4v3.64h-9.4v8.34h10.57v3.64h-15.03v-27.25h15.03v3.64H148.14z"/><path d="M180.7,107.64c2.18,1.11,3.86,2.7,5.05,4.78c1.19,2.07,1.78,4.5,1.78,7.26s-0.59,5.17-1.78,7.2 c-1.19,2.04-2.87,3.6-5.05,4.68c-2.18,1.08-4.72,1.62-7.61,1.62h-8.89v-27.21h8.89C175.98,105.98,178.52,106.53,180.7,107.64z M180.4,126.96c1.7-1.72,2.54-4.15,2.54-7.28c0-3.16-0.85-5.62-2.54-7.4c-1.7-1.77-4.14-2.66-7.32-2.66h-4.42v19.93h4.42 C176.26,129.55,178.7,128.69,180.4,126.96z"/><path d="M196.41,105.98v27.21h-4.46v-27.21H196.41z"/><path d="M202.66,112.36c1.24-2.11,2.92-3.76,5.05-4.95c2.13-1.19,4.46-1.78,6.99-1.78c2.9,0,5.47,0.71,7.73,2.13	c2.26,1.42,3.9,3.44,4.91,6.05h-5.36c-0.7-1.44-1.68-2.51-2.94-3.21c-1.25-0.7-2.7-1.06-4.35-1.06c-1.8,0-3.41,0.41-4.82,1.21 c-1.41,0.81-2.51,1.97-3.31,3.48c-0.8,1.51-1.19,3.28-1.19,5.29c0,2.01,0.4,3.77,1.19,5.28c0.8,1.51,1.9,2.68,3.31,3.5 c1.41,0.82,3.01,1.23,4.82,1.23c1.64,0,3.09-0.35,4.35-1.06c1.25-0.7,2.23-1.77,2.94-3.21h5.36c-1.02,2.61-2.66,4.62-4.91,6.03	c-2.26,1.41-4.83,2.11-7.73,2.11c-2.56,0-4.89-0.59-7.01-1.78c-2.11-1.19-3.79-2.84-5.03-4.95c-1.24-2.11-1.86-4.5-1.86-7.16 S201.42,114.47,202.66,112.36z"/><path d="M237.01,105.98v27.21h-4.46v-27.21H237.01z"/><path d="M248.31,131.68c-2.13-1.19-3.81-2.85-5.05-4.97c-1.24-2.13-1.86-4.52-1.86-7.18s0.62-5.05,1.86-7.16	c1.24-2.11,2.92-3.76,5.05-4.95c2.13-1.19,4.46-1.78,6.99-1.78c2.56,0,4.9,0.59,7.03,1.78c2.13,1.19,3.8,2.84,5.03,4.95	c1.23,2.11,1.84,4.5,1.84,7.16s-0.61,5.06-1.84,7.18c-1.23,2.13-2.9,3.79-5.03,4.97c-2.13,1.19-4.47,1.78-7.03,1.78	C252.76,133.46,250.43,132.87,248.31,131.68z M260.11,128.35c1.41-0.82,2.51-2,3.31-3.52c0.8-1.53,1.19-3.29,1.19-5.3 c0-2.01-0.4-3.77-1.19-5.29c-0.8-1.51-1.9-2.67-3.31-3.48c-1.41-0.81-3.01-1.21-4.82-1.21c-1.8,0-3.41,0.41-4.82,1.21	c-1.41,0.81-2.51,1.97-3.31,3.48c-0.8,1.51-1.19,3.28-1.19,5.29c0,2.01,0.4,3.78,1.19,5.3c0.8,1.53,1.9,2.7,3.31,3.52 s3.01,1.23,4.82,1.23C257.1,129.59,258.7,129.18,260.11,128.35z M259.33,100.15l-8.65,4.27v-3.29l8.65-4.78V100.15z"/><path d="M295.93,133.19h-4.46l-13.43-20.32v20.32h-4.46v-27.25h4.46l13.43,20.28v-20.28h4.46V133.19z"/><path d="M316.45,105.98v27.21h-4.46v-27.21H316.45z"/><path d="M350.98,105.98v27.21h-4.46v-18.64l-8.3,18.64h-3.09l-8.34-18.64v18.64h-4.46v-27.21h4.82l9.55,21.34l9.51-21.34H350.98z"/><path d="M374.9,118c-0.65,1.23-1.7,2.23-3.13,2.99c-1.44,0.77-3.28,1.15-5.52,1.15h-4.93v11.04h-4.46v-27.21h9.4 c2.09,0,3.86,0.36,5.3,1.08c1.45,0.72,2.53,1.69,3.25,2.92c0.72,1.23,1.08,2.6,1.08,4.11C375.88,115.47,375.55,116.77,374.9,118z M370.04,117.35c0.84-0.77,1.25-1.86,1.25-3.27c0-2.98-1.68-4.46-5.05-4.46h-4.93v8.89h4.93 C367.94,118.51,369.21,118.12,370.04,117.35z"/><path d="M394.28,133.19l-6.26-10.88h-3.41v10.88h-4.46v-27.21h9.4c2.09,0,3.86,0.37,5.3,1.1c1.45,0.73,2.53,1.71,3.25,2.94 c0.72,1.23,1.08,2.6,1.08,4.11c0,1.78-0.52,3.39-1.55,4.83c-1.03,1.45-2.62,2.43-4.76,2.96l6.73,11.28H394.28z M384.61,118.74h4.93 c1.67,0,2.93-0.42,3.78-1.25c0.85-0.83,1.27-1.96,1.27-3.37c0-1.41-0.42-2.51-1.25-3.31c-0.84-0.8-2.1-1.19-3.8-1.19h-4.93V118.74z"/><path d="M409.35,109.58v7.99h9.4v3.64h-9.4v8.34h10.57v3.64h-15.03v-27.25h15.03v3.64H409.35z"/><path d="M429.43,132.5c-1.46-0.64-2.61-1.55-3.45-2.72c-0.84-1.17-1.25-2.54-1.25-4.11h4.78c0.1,1.17,0.57,2.14,1.39,2.9
		c0.82,0.76,1.98,1.14,3.46,1.14c1.54,0,2.74-0.37,3.6-1.12c0.86-0.74,1.29-1.7,1.29-2.88c0-0.91-0.27-1.66-0.8-2.23	c-0.54-0.57-1.2-1.02-2-1.33c-0.8-0.31-1.9-0.65-3.31-1.02c-1.77-0.47-3.22-0.95-4.33-1.43c-1.11-0.48-2.06-1.23-2.84-2.25 c-0.78-1.02-1.17-2.37-1.17-4.07c0-1.57,0.39-2.94,1.17-4.11c0.78-1.17,1.88-2.07,3.29-2.7c1.41-0.63,3.04-0.94,4.89-0.94
		c2.64,0,4.8,0.66,6.48,1.98c1.68,1.32,2.62,3.13,2.8,5.42h-4.93c-0.08-0.99-0.55-1.84-1.41-2.54c-0.86-0.7-2-1.06-3.41-1.06	c-1.28,0-2.32,0.33-3.13,0.98c-0.81,0.65-1.21,1.59-1.21,2.82c0,0.84,0.25,1.52,0.76,2.06c0.51,0.54,1.15,0.96,1.94,1.27 c0.78,0.31,1.85,0.65,3.21,1.02c1.8,0.5,3.27,0.99,4.4,1.49c1.14,0.5,2.1,1.26,2.9,2.29c0.8,1.03,1.19,2.41,1.19,4.13
		c0,1.38-0.37,2.69-1.12,3.91c-0.74,1.23-1.83,2.21-3.25,2.96c-1.42,0.74-3.1,1.12-5.03,1.12 C432.54,133.46,430.89,133.14,429.43,132.5z"/><path d="M465.45,127.63h-11.39l-1.96,5.56h-4.66l9.75-27.25h5.17l9.75,27.25h-4.7L465.45,127.63z M464.2,123.99l-4.42-12.65 l-4.46,12.65H464.2z"/></g></svg>

                </a>
            </li>
            <li class="ctg">
                <a href="$actual_link/tv-en-vivo" class="ctg tv_icon"><i class="fas fa-tv" style="font-size:1em;"></i> TV en vivo</a>
            </li>
            <li class="ctg">
                <a href="https://radiozocalo.com.mx/estaciones" class="ctg tv_icon"><i class="fas fa-radio" style="font-size:1em;"></i> Estaciones</a>
            </li>
        </div>
    </div>
    <div class="header-inner fl-wrap">
        <div class="container">
            <!-- logo holder  -->
            <div class="navleft">
                <i class="gg-menu-left"></i>
            </div>
            <a href="$actual_link" class="logo-holder"><img class="logo_spc" src="$logo_dominio" alt=""></a>
            <!-- logo holder end -->
            <a href="$actual_link/busqueda/1/" class="search_btn"><i class="far fa-search"></i></a>
            <!-- header-search-wrap -->
            <!-- <div class="srf_btn htact show-reg-form"><i class="fal fa-user"></i> $boton_acceso</div>
            <div class="header-search-wrap novis_sarch">
                <div class="widget-inner">
                    $busqueda
                </div>
            </div> -->
        
            <div class="nav-holder main-menu">
                <nav>
                    <ul>
                        <li>
                            <a href="$actual_link" class="main_text_header">SuperChannel</i></a>
                            <a href="javascript:void(0)" class="date-clima"><span>23 ºC</span> <span> 12 MAY 2022 </span></a>
                            <a href="$actual_link">Inicio</i></a>
                        </li>
                        $ul
                        $pronostico_div
                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
        </div>
    </div>
</header>
<div class="main-register-container">
    <div class="reg-overlay close-reg-form"></div>
    <div class="main-register-holder">
        <div class="main-register-wrap fl-wrap vis_mr">
            <div class="main-register_bg">
                <div class="bg-wrap">
                    <div class="bg par-elem " data-bg="images/bg/1.jpg" style="background-image: url('$logo_dominio');"></div>
                    <div class="overlay"></div>
                </div>
                <div class="mg_logo"><img src="$logo_dominio" alt=""></div>
            </div>
            <div class="main-register tabs-act ">
                <ul class="tabs-menu">
                    <li class="current" style="width:100%;"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Acceder</a></li>
                </ul>
                <div class="close-modal close-reg-form"><i class="fal fa-times"></i></div>
                <!--tabs -->
                <div id="tabs-container">
                    <div class="tab">
                        <!--tab -->
                        <div id="tab-1" class="tab-content first-tab">
                            <div class="custom-form">
                                <div  >
                                    <label>Correo electrónico<span>*</span> </label>
                                    <input name="email" id="correo" type="text" onclick="this.select()" value="">
                                    <label>Contraseña <span>*</span> </label>
                                    <input name="password" id="password" type="password" onclick="this.select()" value="">
                                    <div class="filter-tags">
                                        <div id="h-captcha"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button id="login_btn" class="log-submit-btn color-bg"><span>Acceder</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="wrapper">
HTML;

?>
