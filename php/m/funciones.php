<?php
// Get domain
$domain = strip_tags($_SERVER['HTTP_HOST']);
if ($_SERVER['HTTP_HOST'] != 'localhost') {
    $actual_link = 'https://'.$domain;
} else {
    $actual_link = 'http://localhost/proyectos/super_channel';
}
$dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$meses = array('','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
function get_site_name(){
    global $actual_link;
    global $domain;
    if($domain == 'localhost'){
        return 'Local - SuperChannel';
    }else if($domain == 'superchannel12.com'){
        return 'SuperChannel';
    }else if($domain == 'radiozocalo.com.mx'){
        return 'RadioZocalo';
    }else if($domain == 'laprimera.com.mx'){
        return 'La Primera';
    }
}
$server_name = get_site_name();
if($server_name == 'RadioZocalo' || $server_name == 'La Primera'){
    $bottom_ref = $actual_link.'/estaciones';
    $text_ref = 'Estaciones';
    $icon_ref = 'radio';
}else{
    $bottom_ref = $actual_link.'/tv-en-vivo';
    $text_ref = 'TV en Vivo';
    $icon_ref = 'tv';
}

function detectar_pagina(){
    global $domain;
    // Remover protocolo y dominio de url
    $raw_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $sanitized_url = strip_tags($raw_url);
    $url = str_replace(array('http://localhost', 'https://'), '', $sanitized_url);
    $url = str_replace(array('localhost/proyectos/super_channel/',$domain.'/'), '', $url);
    $slashes = explode("/", $url);
    $f_slash =  $slashes[0];
    $slashes = count($slashes);
    switch (true) {
        case $f_slash == 'puentes-internacionales':
            return 'puentes-internacionales';
            break;
        case $f_slash == 'tv-en-vivo':
            return 'tv-en-vivo';
            break;
        case $f_slash == 'estaciones':
            return 'estaciones';
            break;
        case $f_slash == 'pronostico':
            return 'pronostico';
            break;
        case $f_slash == 'autor':
            return 'autor';
            break;
        case $f_slash == 'politica-privacidad';
            return 'politica-privacidad';
            break;
        case $f_slash == 'codigo-etica';
            return 'codigo-etica';
            break;
        case $slashes == 1:
            return 'index';
            break;
        case $slashes == 2:
            return 'noticia';
            break;
        case $slashes > 2:
            return 'tags';
            break;
    }
}
function get_id_noticia($data){
    global $domain;
    global $actual_link;

    $raw_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $sanitized_url = strip_tags($raw_url);
    $url = str_replace(array('http://localhost', 'https://'), '', $sanitized_url);
    $url = str_replace(array('localhost/proyectos/super_channel/', $domain.'/'), '', $url);
    $slashes = explode("/", $url);
    return $slashes[0];
}
function hacer_url($titulo){
    $titulo = preg_replace('/[^A-zÀ-ú0-9]/s',' ',$titulo);
    return clean($titulo);
}

function url_string($url){
    $url = trim(substr($url, strpos($url, '/') + 1));
    $url = trim(substr($url, strpos($url, '/') + 1));
    if ($_SERVER['HTTP_HOST'] != 'localhost') {
    $url = trim(substr($url, strpos($url, '/') + 1));
    }
    $url = urldecode($url);
    return $url;
}

function select_imagen($ruta,$id,$n_carpetas = 0,$n_carpetas_vista = 0){
    global $actual_link;
    $dir = '';
    for ($i=0; $i < $n_carpetas; $i++) { 
        $dir = $dir.'../';
    }
    $vista = '';
    for ($i=0; $i < $n_carpetas_vista; $i++) { 
        $vista = $vista.'../';
    }
    // Toma la ruta desde el controlador a la imagen
    $ruta_full = $dir.'images/'.$ruta.'/'.$id;
    // Toma la ruta desde el archivo a la imagen
    $ruta = $vista.'images/'.$ruta;
    // Si el directorio existe
    if(is_dir($ruta_full)){
        // Si existe más de un archivo (ignora '.','..')
        if(count(scandir($ruta_full)) > 2){
            $primer_archivo = scandir($ruta_full)[2];
            // Regresa la ruta del archivo a mostrar en la vista
            return $actual_link.'/'.$ruta.'/'.$id.'/'.$primer_archivo;
        }else{
            // Solo aparece cuando existe carpeta pero no la imagen
            return $actual_link.'/images/default.jpg?';
        }
    }else{
        // Solo aparece si no existe la carpeta, muestra la imagen por defecto de la carpeta
        return $actual_link.'/images/error.webp?1';
    }
    return $ruta;
}
function select_imagen_posted($ruta,$id,$n_carpetas = 3,$n_carpetas_vista = 0){
    global $actual_link;
    $dir = '';
    for ($i=0; $i < $n_carpetas; $i++) { 
        $dir = $dir.'../';
    }
    $vista = '';
    for ($i=0; $i < $n_carpetas_vista; $i++) { 
        $vista = $vista.'../';
    }
    // Toma la ruta desde el controlador a la imagen
    $ruta_full = $dir.'images/'.$ruta.'/'.$id;
    // Toma la ruta desde el archivo a la imagen
    $ruta = $vista.'images/'.$ruta;
    // Si el directorio existe
    if(is_dir($ruta_full)){
        // Si existe más de un archivo (ignora '.','..')
        if(count(scandir($ruta_full)) > 2){
            $primer_archivo = scandir($ruta_full)[2];
            // Regresa la ruta del archivo a mostrar en la vista
            return $actual_link.'/'.$ruta.'/'.$id.'/'.$primer_archivo;
        }else{
            // Solo aparece cuando existe carpeta pero no la imagen
            return $actual_link.'/images/default.jpg?';
        }
    }else{
        // Solo aparece si no existe la carpeta, muestra la imagen por defecto de la carpeta
        return $actual_link.'/images/error.webp?11';
    }
    return $ruta;
}
function formatear_fecha($fecha){
    global $dias;
    global $meses;
    $dia = date_format(date_create($fecha),"d");
    $year = date_format(date_create($fecha),"Y");
    $dia_text =  $dias[intval(date_format(date_create($fecha),"w"))];
    $mes_text =  $meses[intval(date_format(date_create($fecha),"m"))];
    return $dia_text.' '.$dia.' de '.$mes_text.' '.$year;
}
$logo_dominio = get_logo_dominio();
function get_logo_dominio(){
    global $actual_link;
    global $domain;
    if($domain == 'localhost'){
        $domain = 'superchannel12.com';
    }
    return $actual_link.'/images/logos/'.$domain.'/dark.png?';
}
function getClientIP(){
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
           return  $_SERVER["HTTP_X_FORWARDED_FOR"];  
    }else if (array_key_exists('REMOTE_ADDR', $_SERVER)) { 
           return $_SERVER["REMOTE_ADDR"]; 
    }else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
           return $_SERVER["HTTP_CLIENT_IP"]; 
    }
    return '';
}
function traer_row_busqueda($t = 2){
    return '<div>
                <input name="se" id="buscar_noticia" type="text" class="search" placeholder="Buscar..." value="">
                <button class="search-submit'.$t.'" id="buscar_noticia_btn"><i class="far fa-search"></i> </button>
            </div>
            <span id="validacion_busqueda" style="display:none;">Escribe algo antes de buscar...</span>';
}
function new_row_noticia($sp){
    global $sql;
    global $actual_link;
    $rows = $sql->obtenerResultado($sp);
    $rows_vista = '';
    $arreglo_noticias = array();
    foreach ($rows as $noticias_ids) {
        $id = $noticias_ids['id_publicacion'];
        $noticia = $sql->obtenerResultado("CALL sp_select_publicacion_id($id)");
        $imagen = select_imagen('publicaciones',$noticia[0]['id_publicacion']);
        $imagen_autor = select_imagen('usuarios',$noticia[0]['id_autor']);
        $tags = $sql -> obtenerResultado('CALL sp_select_etiquetas_publicacion_id('.$noticia[0]['id_publicacion'].')');
        $titulo = strip_tags($noticia[0]['titulo_publicacion']);
        // $titulo = decodeEmoticons($noticia[0]['titulo_publicacion']);
        $subtitulo = strip_tags($noticia[0]['subtitulo_publicacion']);
        // $subtitulo = decodeEmoticons($noticia[0]['subtitulo_publicacion']);
        $fecha = formatear_fecha($noticia[0]['fecha_publicacion']);
        $autor = $noticia[0]['autor'];
        $id_autor_pub =  $noticia[0]['id_autor_pub'];
        // http://localhost/proyectos/super_channel/autor/1/1/Luis%20Fernando
        $autor_url = $actual_link.'/autor/1/'.$id_autor_pub.'/'.$autor;
        $url =  $actual_link.'/'.$noticia[0]['id_publicacion'].'/'.makeUrl($noticia[0]['titulo_publicacion'],1000);
        $id_categoria = $noticia[0]['id_categoria_noticia'];
        $id_subcategoria = $noticia[0]['id_subcategoria'];
        $categoria = $noticia[0]['nombre_categoria_noticia'];
        $categoria_slug = $noticia[0]['slug_categoria_noticia'];
        array_push( $arreglo_noticias, 
                array(
                    'imagen' => $imagen,
                    'imagen_autor' => $imagen_autor,
                    'titulo' => $titulo,
                    'subtitulo' => $subtitulo,
                    'fecha' => $fecha,
                    'autor' => $autor,
                    'url' => $url,
                    'autor_url' => $autor_url,
                    'tags' => $tags,
                    'id_categoria' => $id_categoria,
                    'id_subcategoria' => $id_subcategoria,
                    'categoria' => $categoria,
                    'categoria_slug' => $categoria_slug,
                    'id' => $id
                )
        );
    }
    
    return $arreglo_noticias;
}
function select_new_row_noticias($inicio,$final,$tipo = 'noticias'){
    global $noticias_row;
    $row = '';
    for($i = $inicio; $i < $final; $i++ ){
        $row .= new_row($noticias_row[$i]['id_subcategoria'],$noticias_row[$i]['imagen'],$noticias_row[$i]['imagen_autor'],$noticias_row[$i]['titulo'],$noticias_row[$i]['subtitulo'],$noticias_row[$i]['fecha'],$noticias_row[$i]['autor'],$noticias_row[$i]['url'],$noticias_row[$i]['autor_url'],$noticias_row[$i]['tags'],$noticias_row[$i]['id_categoria'],$noticias_row[$i]['categoria'],$tipo,$noticias_row[$i]['id']);
    }
    return $row;
}
function select_new_row_noticias_slider($inicio,$final,$tipo = 'noticias'){
    global $noticias_slides;
    $noticias_row = $noticias_slides;
    $row = '';
    if(count($noticias_row) > 0){
        for($i = $inicio; $i < $final; $i++ ){
            if( $i >= count($noticias_row) ){

            }else{
                $row .= new_row($noticias_row[$i]['id_subcategoria'],$noticias_row[$i]['imagen'],$noticias_row[$i]['imagen_autor'],$noticias_row[$i]['titulo'],$noticias_row[$i]['subtitulo'],$noticias_row[$i]['fecha'],$noticias_row[$i]['autor'],$noticias_row[$i]['url'],$noticias_row[$i]['autor_url'],$noticias_row[$i]['tags'],$noticias_row[$i]['id_categoria'],$noticias_row[$i]['categoria'],$tipo);
            }
        }
    }
    return $row;
}
function select_new_row_categoria($noticias_row,$tipo = 'noticias'){
    $row = '';
    for($i = 0; $i < count($noticias_row); $i++ ){
        $row .= new_row($noticias_row[$i]['id_subcategoria'],$noticias_row[$i]['imagen'],$noticias_row[$i]['imagen_autor'],$noticias_row[$i]['titulo'],$noticias_row[$i]['subtitulo'],$noticias_row[$i]['fecha'],$noticias_row[$i]['autor'],$noticias_row[$i]['url'],$noticias_row[$i]['autor_url'],$noticias_row[$i]['tags'],$noticias_row[$i]['id_categoria'],$noticias_row[$i]['categoria'],$tipo,$noticias_row[$i]['id']);
    }
    return $row;
}
function select_row_categorias($inicio,$final){
    global $noticias_row;
    // enviamos todos las categorias a un arreglo separado
    $arreglo_categorias = array();
    $ids = array();
    for($i = $inicio; $i < $final; $i++ ){
        // Si el id esta en el arreglo ids
        if(!in_array($noticias_row[$i]['id_categoria'],$ids)){
            array_push($ids,$noticias_row[$i]['id_categoria']);
            array_push($arreglo_categorias,array($noticias_row[$i]['id_categoria'],$noticias_row[$i]['categoria']));
        }
    }
    $row = '';
    // imprimimos un link por cada elemento y el primero lleva una clase activa
    for($i = 0; $i < count($arreglo_categorias); $i++ ){
        $x = '';
        $nombre = $arreglo_categorias[$i][1];
        $id_categoria = $arreglo_categorias[$i][0];
        $row.= "<a href='javascript:void(0)' id='cambiar_catg' class='$x' data-id='$id_categoria'>$nombre</a>";
    }
    return $row;
}

function crear_rows_noticias($procedimiento,$tipo = 0,$mostrar_no_encontrados = 0,$arreglo = 0){
    global $sql;
    $rows = $sql->obtenerResultado($procedimiento);
    $rows_vista = '';
    $rows_vista2 = '';
    foreach ($rows as $noticia) {
        $imagen = select_imagen('publicaciones',$noticia['id_publicacion']);
        $imagen_autor = select_imagen('usuarios',$noticia['id_autor']);
        $tag = $noticia['etiqueta'];
        $titulo = strip_tags($noticia['titulo_publicacion']);
        $subtitulo = strip_tags($noticia['subtitulo_publicacion']);
        // $titulo = decodeEmoticons($noticia['titulo_publicacion']);
        // $subtitulo = decodeEmoticons($noticia['subtitulo_publicacion']);
        $fecha = formatear_fecha($noticia['fecha_publicacion']);
        $autor = $noticia['autor'];
        $url = $noticia['URL'];
        if ($tipo == 4 && $arreglo == 1) {
            if ($rows_vista2 == '') {
                $rows_vista2 = crear_row_noticia($imagen,$tag,$titulo,$subtitulo,$fecha,$autor,$imagen_autor,$url,5);
            }else{
                $rows_vista .= crear_row_noticia($imagen,$tag,$titulo,$subtitulo,$fecha,$autor,$imagen_autor,$url,4);
            }
        }else{
            $rows_vista .= crear_row_noticia($imagen,$tag,$titulo,$subtitulo,$fecha,$autor,$imagen_autor,$url,$tipo);
        }
    }
    if($rows_vista == '' && $mostrar_no_encontrados == 1){
        return "<div class='col-md-12'>
            <script src='https://cdn.lordicon.com/lusqsztk.js'></script>
            <lord-icon
            src='https://cdn.lordicon.com/msoeawqm.json'
                trigger='hover'
                colors='primary:#121331,secondary:#e93314'
                style='width:250px;height:250px'>
            </lord-icon>
            <h1 style='font-size:2em;'>No se han encontrado resultados</h1>
        </div>";
    }else{
        if ($tipo == 4 && $arreglo == 1) {
            return array($rows_vista,$rows_vista2);
        }else{
            return $rows_vista;
        }
    }
}
function crear_row_noticia($imagen,$tag,$titulo,$subtitulo,$fecha,$autor,$imagen_autor,$url,$tipo = 0){
    global $actual_link;
    $url_noticia = $actual_link.'/'.$url;
    $tag_url = $actual_link.'/categoria/1/'.hacer_url($tag);
    // 2 para videos
    if($tipo == 0){
    $row = <<<HTML
    <div class='list-post fl-wrap'>
        <div class='list-post-media'>
            <a href='$url_noticia'>
                <div class='bg-wrap'>
                    <div class='bg' data-bg='$imagen' style='background-image: url($imagen);'></div>
                </div>
            </a>
            <span class='post-media_title'>Ver noticia</span>
        </div>
        <div class='list-post-content'>
            <a class='post-category-marker' href='$tag_url'>$tag</a>
            <h3><a href='$url_noticia'>$titulo</a></h3>
            <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
            <p>$subtitulo</p>
            <div class='author-link'><a href='author-single.html'><img src='$imagen_autor'>  <span>Por $autor</span></a></div>
        </div>
    </div>
HTML;
    }
    if($tipo == 1){
        $row = <<<HTML
        <div class="col-md-6">
            <div class="list-post fl-wrap">
                <a class="post-category-marker" href="category.html">$tag</a>
                <div class="list-post-media">
                    <a href="$url_noticia">
                        <div class="bg-wrap">
                            <div class="bg" data-bg="$imagen" style="background-image: url($imagen);"></div>
                        </div>
                    </a>
                    <span class="post-media_title">Ver noticia</span>
                </div>
                <div class="list-post-content">
                    <h3><a href="$url_noticia">$titulo</a></h3>
                    <span class="post-date"><i class="far fa-clock"></i>  $fecha</span>
                </div>
            </div>						  
        </div>
HTML;
        }
    if($tipo == 2){
        $row = <<<HTML
        <div class="video-item video-item_active fl-wrap" data-url="$url_noticia" data-video-link="https://www.youtube.com/watch?v=VLoqKdRxPSc">
            <div class="video-item-img fl-wrap">
                <img src="$imagen" class="respimg" alt="">
                <div class="play-icon"><i class="fas fa-play"></i></div>
            </div>
            <div class="video-item-title">
                <h4>$titulo</h4>
                <span class="video-date"><i class="far fa-clock"></i> <strong>$fecha</strong></span>
            </div>
            <a class="post-category-marker" href="category.html">Videos</a>
        </div>
HTML;
    }
    if($tipo == 3){
        $row = <<<HTML
        <div class="video-item video-item_active fl-wrap" data-url="$url_noticia" data-video-link="https://www.youtube.com/watch?v=VLoqKdRxPSc">
            <div class="video-item-img fl-wrap">
                <img src="$imagen" class="respimg" alt="">
                <div class="play-icon"><i class="fas fa-play"></i></div>
            </div>
            <div class="video-item-title">
                <h4>$titulo</h4>
                <span class="video-date"><i class="far fa-clock"></i> <strong>$fecha</strong></span>
            </div>
            <a class="post-category-marker" href="category.html">Videos</a>
        </div>
HTML;
    }
    if($tipo == 4){
        $row = <<<HTML
        <div class="list-post fl-wrap">
            <div class="list-post-media">
                <a href="post-single.html">
                    <div class="bg-wrap">
                        <div class="bg" data-bg="$imagen""></div>
                    </div>
                </a>
                <span class="post-media_title">Ver noticia</span>
            </div>
            <div class="list-post-content">
                <a class="post-category-marker" href="#">$tag</a>
                <h3><a href="$url_noticia">$titulo</a></h3>
                <span class="post-date"><i class="far fa-clock"></i> $fecha</span>
                <p>$titulo</p>
                <div class="author-link"><a href="author-single.html"><img src="$imagen_autor" alt="">  <span>Por $autor</span></a></div>
            </div>
        </div>
HTML;
    }
if($tipo == 5){
    $row = <<<HTML
    <div class="list-post fl-wrap">
            <a class="post-category-marker" href="#">$tag</a>
            <div class="list-post-media">
                <a href="$url_noticia">
                    <div class="bg-wrap">
                        <div class="bg" data-bg="$imagen"></div>
                    </div>
                </a>
                <span class="post-media_title">Ver noticia</span>
            </div>
            <div class="list-post-content">
                <h3><a href="post-single.html">$titulo</a></h3>
                <span class="post-date"><i class="far fa-clock"></i> $fecha</span>
                <p>$fecha</p>
                <div class="author-link"><a href="author-single.html"><img src="$imagen_autor" alt="">  <span>Por $autor</span></a></div>
            </div>
        </div>
HTML;
    }
    if($tipo == 6){
    $row = <<<HTML
    <div class="post-widget-item fl-wrap">
        <div class="post-widget-item-media">
            <a href="$url_noticia"><img src="$imagen" alt=""></a>
        </div>
        <div class="post-widget-item-content">
            <h4><a href="$url_noticia">$titulo</a></h4>
        </div>
    </div>
HTML;
    }
    return $row;
}

function cerrar_tags($html) {
    preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);

    $closedtags = $result[1];
    $len_opened = count($openedtags);

    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
}


function clean($string) {
    $string = strip_tags($string);  // Remove HTML tags
    $string = str_replace(' ', '-', $string); // Replace spaces with dashes
    $string = preg_replace('/[^A-Za-zÀ-ÖØ-öø-ÿ0-9\-]/', '', $string); // Removes special chars.
    return $string;
}
 function seleccionar_cantidad($pagina_actual,$total){
     $noticias_por_pagina = 10;
     if($pagina_actual == 1){
            $inicio = 0;
     }else{
            $inicio = ($pagina_actual - 1) * $noticias_por_pagina;
     }
     $paginas = $total / $noticias_por_pagina;
     $paginas = ROUND($paginas);
    return array($inicio, $noticias_por_pagina, $paginas);
 }
 function crear_paginado($pagina,$total_paginas,$id,$slug,$tipo){
    global $actual_link;
    // Limitar paginado a 5 páginas
    $total_paginas = $total_paginas;
    $inicio_paginas = $pagina - 5;
    if($inicio_paginas < 1){
        $inicio_paginas = 1;
    }
    $paginado = '<div class="pagination">';
    if($pagina > 1){
        $prev = $pagina - 1;
        $paginado .= '<a href="'.$actual_link.'/'.$tipo.'/'.$prev.'/'.$id.'/'.$slug.'" class="prev-next"><i class="fas fa-caret-left"></i></a>';
    }
     for ($i=$inicio_paginas; $i < $total_paginas+1; $i++) {
         if($i < $pagina + 5){
            $clase = '';
            if($i == $pagina){
                $clase = 'current-page';
            }
            $paginado = $paginado . '<a href="'.$actual_link.'/'.$tipo.'/'.$i.'/'.$id.'/'.$slug.'" class="'.$clase.'">'.$i.'</a>';
        }
     }
     if($pagina < $total_paginas){
        $next = $pagina + 1;
        $paginado = $paginado . '<a href="'.$actual_link.'/'.$tipo.'/'.$next.'/'.$id.'/'.$slug.'" class="nextposts-link"><i class="fas fa-caret-right"></i></a>';
     }
    $paginado .= '</div>';
    return $paginado;
 }
 function hacer_noticia($noticia){
    //  Remove background color styles and color 
    $noticia = preg_replace('/background-color: (.*?);/', '', $noticia);
    // remove color styles
    $noticia = preg_replace('/color: (.*?);/', '', $noticia);
    //  Remove all p and h tags from string
    // $noticia = strip_tags($noticia, '<p><h1><h2><h3><h4><h5><h6><a>');
    // replace all twitter links
    // $noticia = preg_replace('/\b(https?:\/\/)?(www\.)?twitter\.com\/\S+\/status\/\S+\b/i', '<blockquote class="twitter-tweet" data-lang="es"> <a href=$0"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>', $noticia);
    // replace all instagram links but not iframes
    // $noticia = preg_replace('/\b(https?:\/\/)?(www\.)?instagram\.com\/p\/\S+\b/i', '<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="$0"></blockquote> <script async src="//www.instagram.com/embed.js"></script>', $noticia);
    // replace youtube links to embed links
    // $noticia = preg_replace('/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', '<div class="video-responsive"><iframe src="https://www.youtube.com/embed/$2" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>', $noticia);
    return $noticia;
 }

 function crear_div_busqueda($sp,$posted = 0){
    global $sql;
    $tags = $sql -> obtenerResultado($sp);
    $total_rows = count($tags);
    $div = '';
    for ($i=0; $i < $total_rows; $i++) {
        if($posted === 'Posted'){
            $div .= crear_div_posted($tags[$i]['id_publicacion']);
        }else{
            $div .= crear_div($tags[$i]['id_publicacion']);
        }
    }
    return $div;
 }

 function crear_div($id){
     global $sql;
     global $actual_link;
        $noticia = $sql -> obtenerResultado("CALL sp_select_publicacion_id($id)");
        if($noticia){
            $imagen = select_imagen('publicaciones',$noticia[0]['id_publicacion']); 
            $imagen_autor = select_imagen('usuarios',$noticia[0]['id_autor']);
            $tags = $sql -> obtenerResultado('CALL sp_select_etiquetas_publicacion_id('.$noticia[0]['id_publicacion'].')');
            $titulo = strip_tags($noticia[0]['titulo_publicacion']);
            $subtitulo = strip_tags($noticia[0]['subtitulo_publicacion']);
            // $titulo = decodeEmoticons($noticia[0]['titulo_publicacion']);
            // $subtitulo = decodeEmoticons($noticia[0]['subtitulo_publicacion']);
            $fecha = formatear_fecha($noticia[0]['fecha_publicacion']);
            $autor = $noticia[0]['autor'];
            $id_autor_pub = $noticia[0]['id_autor_pub'];
            // http://localhost/proyectos/super_channel/autor/1/1/Luis%20Fernando
            $autor_url = $actual_link.'/autor/1/'.$id_autor_pub.'/'.$autor;
            $url =  $actual_link.'/'.$noticia[0]['id_publicacion'].'/'.makeUrl($noticia[0]['titulo_publicacion'],500);
            $id_categoria = $noticia[0]['id_categoria_noticia'];
            $id_sub_categoria = $noticia[0]['id_subcategoria'];
            $categoria = $noticia[0]['nombre_categoria_noticia'];
            $categoria_slug = $noticia[0]['slug_categoria_noticia'];
            return new_row($id_sub_categoria,$imagen,$imagen_autor,$titulo,$subtitulo,$fecha,$autor,$url,$autor_url,$tags,$id_categoria,$categoria);    
        }else{
            return '';
        }
        
 }

 function crear_div_posted($id){
    global $sql;
    global $actual_link;
       $noticia = $sql -> obtenerResultado("CALL sp_select_publicacion_id($id)");
       if($noticia){
           $imagen = select_imagen_posted('publicaciones',$noticia[0]['id_publicacion']); 
           $imagen_autor = select_imagen_posted('usuarios',$noticia[0]['id_autor']);
           $tags = $sql -> obtenerResultado('CALL sp_select_etiquetas_publicacion_id('.$noticia[0]['id_publicacion'].')');
           $titulo = strip_tags($noticia[0]['titulo_publicacion']);
           $subtitulo = strip_tags($noticia[0]['subtitulo_publicacion']);
           //$titulo = decodeEmoticons($noticia[0]['titulo_publicacion']);
           //$subtitulo = decodeEmoticons($noticia[0]['subtitulo_publicacion']);
           $fecha = formatear_fecha($noticia[0]['fecha_publicacion']);
           $autor = $noticia[0]['autor'];
           $id_autor_pub = $noticia[0]['id_autor_pub'];
           // http://localhost/proyectos/super_channel/autor/1/1/Luis%20Fernando
           $autor_url = $actual_link.'/autor/1/'.$id_autor_pub.'/'.$autor;
           $url =  $actual_link.'/'.$noticia[0]['id_publicacion'].'/'.makeUrl($noticia[0]['titulo_publicacion'],500);
           $id_categoria = $noticia[0]['id_categoria_noticia'];
           $id_sub_categoria = $noticia[0]['id_subcategoria'];
           $categoria = $noticia[0]['nombre_categoria_noticia'];
           $categoria_slug = $noticia[0]['slug_categoria_noticia'];
           return new_row($id_sub_categoria,$imagen,$imagen_autor,$titulo,$subtitulo,$fecha,$autor,$url,$autor_url,$tags,$id_categoria,$categoria);    
       }else{
           return '';
       }
       
}

 function new_row($id_sub_categoria,$imagen,$imagen_autor,$titulo,$subtitulo,$fecha,$autor,$url,$autor_url,$tags,$id_categoria,$nombre_categ,$tipo = 0,$id = 0){
    global $actual_link;
    $tags_text = '';
    $primer_tag = '';
    if($tipo == 'Videos'){
       $id = get_video($id);
    }
    if(is_array($tags)){
        foreach($tags as $tag){
            $tag_nombre = $tag['etiqueta'];
            $tag_id = $tag['id_etiqueta'];
            $slug = $tag['slug_etiqueta'];
            $tags_text .= "<a class='post-category-marker' href='$actual_link/etiqueta/1/$tag_id/$slug'>$tag_nombre</a>";
        }
        if(isset($tags[0]['etiqueta'])){
            $tag_nombre = $tags[0]['etiqueta'];
            $tag_id = $tags[0]['id_etiqueta'];
            $slug = $tags[0]['slug_etiqueta'];
            $primer_tag= "<a class='post-category-marker' href='$actual_link/etiqueta/1/$tag_id/$slug'>".$tag_nombre."</a>";    
        }else{
            $tag_nombre = '';
            $tag_id = '';
            $slug = '';
            $primer_tag= '';
        }
        
    }
    switch (true) {
        case $tipo === 'Videos':
            return 
            "<div class='video-item video-item_active fl-wrap' data-url='$url' data-video-link='$id'>
                <div class='video-item-img fl-wrap'>
                    <img src='$imagen' class='respimg' alt=''>
                    <div class='play-icon'><i class='fas fa-play'></i></div>
                </div>
                <div class='video-item-title'>
                    <h4>$titulo</h4>
                    <span class='video-date'><i class='far fa-clock'></i> <strong>$fecha</strong></span>
                </div>
                <a class='post-category-marker' href='$actual_link/tag/1/56/video'>Videos</a>
            </div>";
        break;
        case $tipo === 'Deportes':
            return 
            "<div class='col-md-6'>
                <div class='list-post fl-wrap'>
                    $primer_tag
                        <div class='list-post-media'>
                            <a href='$url'>
                                <div class='bg-wrap'>
                                    <div class='bg' data-bg='$imagen' style='background-image: url($imagen);'></div>
                                </div>
                            </a>
                            <span class='post-media_title'>Ver noticia</span>
                        </div>
                    <div class='list-post-content'>
                        <h3><a href='$url'>$titulo</a></h3>
                        <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                    </div>
                </div>
            </div>";
        break;
        case $tipo === 'ultimas_entradas':
            return 
            "<div class='list-post fl-wrap'>
                <div class='list-post-media'>
                    <a href='$url'>
                        <div class='bg-wrap'>
                            <div class='bg' data-bg='$imagen''></div>
                        </div>
                    </a>
                    <span class='post-media_title'>Ver noticia</span>
                </div>
                <div class='list-post-content'>
                   $tags_text
                    <h3><a href='$url'>$titulo</a></h3>
                    <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                    <p>$titulo</p>
                    <div class='author-link'><a href='$autor_url'><img src='$imagen_autor' alt=''>  <span>Por $autor</span></a></div>
                </div>
            </div>";
        break;
        case $tipo === 'ultima_entrada':
            return 
            "<div class='list-post-wrap list-post-wrap_column list-post-wrap_column_fw'>
                <div class='list-post fl-wrap'>
                $primer_tag
                <div class='list-post-media'>
                    <a href='$url'>
                        <div class='bg-wrap'>
                            <div class='bg' data-bg='$imagen'></div>
                        </div>
                    </a>
                    <span class='post-media_title'>Ver noticia</span>
                </div>
                <div class='list-post-content'>
                    <h3><a href='$url'>$titulo</a></h3>
                    <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                    <p>$fecha</p>
                    <div class='author-link'><a href='$autor_url'><img src='$imagen_autor' alt=''>  <span>Por $autor</span></a></div>
                </div>
            </div>
            </div>
            <a href='$url' class='dark-btn fl-wrap'> Ver nota completa </a>
            ";
        break;
        case $tipo === 'right_div':
            return
            "<div class='post-widget-item fl-wrap'>
                <div class='post-widget-item-media'>
                    <a href='$url'><img src='$imagen' alt=''></a>
                </div>
                <div class='post-widget-item-content'>
                    <h4><a href='$url'>$titulo</a></h4>
                </div>
            </div>";
            break;
        case $tipo === 'related':
            return 
            "<div class='col-md-6'>
                <div class='list-post fl-wrap'>
                    $primer_tag
                        <div class='list-post-media'>
                            <a href='$url'>
                                <div class='bg-wrap'>
                                    <div class='bg' data-bg='$imagen' style='background-image: url($imagen);'></div>
                                </div>
                            </a>
                            <span class='post-media_title'>Ver noticia</span>
                        </div>
                    <div class='list-post-content'>
                        <h3><a href='$url'>$titulo</a></h3>
                        <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                    </div>
                </div>";
            break;
        case $tipo === 'slider':
            return
            "<div class='swiper-slide'>
                <div class='bg-wrap'>
                    <div class='bg' data-bg='$imagen' data-swiper-parallax='40%'></div>
                    <div class='overlay'></div>
                </div>
                <div class='hero-item fl-wrap'>
                    <div class='container'>
                        $tags_text
                        <div class='clearfix'></div>
                        <h2><a href='$url'>$titulo</a></h2>
                        <h4>$subtitulo</h4>
                        <div class='clearfix'></div>
                        <div class='author-link'><a href='$autor_url'><img src='$imagen_autor'>  <span>Por $autor</span></a></div>
                        <span class='post-date'><i class='far fa-clock'></i>  $fecha</span>
                    </div> 
                </div>
            </div>";
            break;
        case $tipo === 'min_slider':
            return
            "<div class='swiper-slide'>
                    <div class='hsc-list_item fl-wrap'>
                        <div class='hsc-list_item-media'>
                            <div class='bg-wrap'>
                                <div class='bg' data-bg='$imagen'></div>
                            </div>
                        </div>
                        <div class='hsc-list_item-content fl-wrap'>
                            <h4>$titulo</h4>
                            <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                        </div>
                    </div>
                </div>";
            break;
        default:
            return 
            "<div class='list-post fl-wrap' data-categoria='$id_categoria' data-sub-categoria='$id_sub_categoria'>
                <div class='list-post-media'>
                    <a href='$url'>
                        <div class='bg-wrap'>
                            <div class='bg' data-bg='$imagen' style='background-image: url($imagen);'></div>
                        </div>
                    </a>
                    <span class='post-media_title'>Ver noticia</span>
                </div>
                <div class='list-post-content'>
                    $tags_text
                    <h3><a href='$url'>$titulo</a></h3>
                    <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                    <p>$subtitulo</p>
                    <div class='author-link'><a href='$autor_url'><img src='$imagen_autor'>  <span>Por $autor</span></a></div>
                </div>
            </div>";
        break;
    }
}
function decodeEmoticons($src) {
    $replaced = preg_replace("/\\\\u([0-9A-F]{1,4})/i", "&#x$1;", $src);
    $result = mb_convert_encoding($replaced, "UTF-16", "HTML-ENTITIES");
    $result = mb_convert_encoding($result, 'utf-8', 'utf-16');
    return $result;
}

function thousandsCurrencyFormat($num) {

    if($num>1000) {
  
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
  
          return $x_display;
  
    }
  
    return $num;
  }
function limitar_texto($string,$length=1000) {
    // limit text 30 chars
    $string = strip_tags($string);
    if (strlen($string) > $length) {
        // truncate string
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');
        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    $replace =
    array (
        'Ã¡'=>'á', 'Ã©'=>'é', 'Ã'=>'í', 'Ã³'=>'ó', 'Ãº'=>'ú', 'Ã½'=>'ý'
    );
    $string1 = strtr($string,$replace);
    // Replace accents to normal letters
    $unwanted_array = 
    array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
        'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', '\\'=>'-'
    );
    $string = strtr( $string1, $unwanted_array );
    // transform uppercase to lowercase
    $string = strtolower($string);
    return $string;
}

function limitar_texto2($string){
    $unwanted_array = 
    array (
        'Ã¡'=>'á', 'Ã©'=>'é', 'Ã'=>'í', 'Ã³'=>'ó', 'Ãº'=>'ú', 'Ã½'=>'ý'
    );
    $string = strtr($string,$unwanted_array);
    return $string;
}
function makeUrl($string, $length = 1000) {
    $string = html_entity_decode(strip_tags($string)); // Convert HTML entities to their corresponding characters

    if (strlen($string) > $length) {
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }

    $unwanted_array = array(
        'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
        'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y'
    );
    
    $string = strtr($string, $unwanted_array);

    // Keep only alphanumeric characters and replace space with dash
    $string = preg_replace("/[^a-zA-Z0-9 -]/", "", $string);
    $string = str_replace(' ', '-', $string);

    // Convert to lowercase
    $string = strtolower($string);
    
    return $string;
}
function texto_compartir($string,$length=60) {
    // limit text 30 chars
    $string = strip_tags($string);
    if (strlen($string) > $length) {
        // truncate string
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');
        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    return $string;
}
function get_parm($array, $num){
    // Array split
    $array = explode(',', $array);
    // if array has more than one element
    if(count($array) > 1){
        // return the specified element
        return strip_tags($array[$num]);
    } else {
        // return the first element
        return strip_tags($array[0]);
    }
}
function hace_tiempo($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'año(s)',
        'm' => 'mes(es)',
        'w' => 'semana(s)',
        'd' => 'dia(s)',
        'h' => 'hora(s)',
        'i' => 'minuto(s)',
        's' => 'segundo(s)',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ?  'hace ' . implode(', ', $string)  : 'justo ahora';
}

function get_video($id){
    global $sql;
    $noticia = $sql->obtenerResultado("CALL sp_select_video_publicacion($id)");
    $iframe_video =  $noticia[0][0];
    // transform iframe to embed by regex
    preg_match('/src="([^"]+)"/', $iframe_video, $match);
    return $match[1];
}

function transform_titulo($titulo){
    // transform url string to title
    $titulo = strip_tags(urldecode($titulo)); // Remove HTML tags and decode URL
    // UPPERCASE ALL LETTERS
    $titulo = strtoupper($titulo);
    // transform hyphen to space
    $titulo = str_replace('-', ' ', $titulo);
    return $titulo;
}