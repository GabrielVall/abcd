<?php
    $id_publi= get_id_noticia($_SERVER['REQUEST_URI']);
    // Contar la visita
    $client_ip = getClientIP();
    $noticia = $sql->obtenerResultadoSimple("CALL sp_agregar_visita_publicacion('".$id_publi."','".$client_ip."')");

    $noticia = $sql->obtenerResultado("CALL sp_select_noticia_id_url('".$id_publi."')");
    $visitas = $noticia[0]['vistas'];
    $autor_url = $actual_link.'/autor/1/'.$noticia[0]['id_autor'].'/'.$noticia[0]['autor'];
    $imagen = select_imagen('publicaciones',$noticia[0]['id_publicacion']);
    $extension = pathinfo($imagen, PATHINFO_EXTENSION);
    if($extension == 'jpg'){
        $extension = 'jpeg';
    }
    $configuraciones = $sql->obtenerResultado("CALL sp_select_configuraciones()");
    if($server_name == 'RadioZocalo' ){
        $param_get = 1;
    }else{
        $param_get = 0;
    }
    $telefono_pub = get_parm($configuraciones[20][2],$param_get);
    $imagen_autor = select_imagen('usuarios',$noticia[0]['id_usuario']);
    $titulo = strip_tags($noticia[0]['titulo_publicacion']);
    // $titulo = decodeEmoticons($noticia[0]['titulo_publicacion']);
    $titulo_og = limitar_texto($titulo);
    $subtitulo = strip_tags($noticia[0]['subtitulo_publicacion']);
    // $subtitulo = decodeEmoticons($noticia[0]['subtitulo_publicacion']);
    $titulo_compartir_nota = texto_compartir($titulo,1000);
    $subtitulo_compartir_nota = texto_compartir($noticia[0]['subtitulo_publicacion'],1000);
    $fecha = formatear_fecha($noticia[0]['fecha_publicacion']);
    $contenido_test = decodeEmoticons(hacer_noticia($noticia[0]['contenido_publicacion']));
    $contenido = limitar_texto2($contenido_test);
    $autor = $noticia[0]['autor'];
    $descripcion = $noticia[0]['descripcion_autor'];
    $id_cat =  $noticia[0]['id_categoria_noticia'];
    $categoria = '<a href="'.$actual_link.'/tag/1/'.$noticia[0]['id_categoria_noticia'].'/'.$noticia[0]['nombre_categoria_noticia'].'">'.$noticia[0]['nombre_categoria_noticia'].'</a>';
    if(!$noticia[0]['nombre_subcategoria'] == ''){
        $subcategoria = '<a href="'.$actual_link.'/sub-tag/1/'.$noticia[0]['id_subcategoria'].'/'.$noticia[0]['nombre_subcategoria'].'">'.$noticia[0]['nombre_subcategoria']. '</a>';
    }else{
        $subcategoria = '';
    }
    
    include_once('php/v/0/header.php');
    // Select etiquetas
    $etiquetas  = $sql->obtenerResultado("CALL sp_select_etiquetas_pub('".$id_publi."')");
    $etiquetas_pub = '';
    $etiqueta_main = '';
    $id_etiqueta = '';
    if(count($etiquetas) > 0){
        foreach ($etiquetas as $etiqueta) {
            $etiquetas_pub .= '<a href="'.$actual_link.'/etiqueta/1/'.$etiqueta['id_etiqueta'].'/'.$etiqueta['etiqueta'].'">'.$etiqueta['etiqueta'].'</a>';
        }
        $etiqueta_main = $etiquetas[0]['etiqueta'];
        $id_etiqueta = $etiquetas[0]['id_etiqueta'];
    }
    
    //Selecciona la noticia anterior
    $prev_noticia = $sql->obtenerResultado("CALL sp_select_noticia_prev('".$id_publi."')");
    if(isset($prev_noticia)){
        $imagen_prev = select_imagen('publicaciones',$prev_noticia[0]['id_publicacion']);
        $titulo_prev = strip_tags($prev_noticia[0]['titulo_publicacion']);
        // $titulo_prev = decodeEmoticons($prev_noticia[0]['titulo_publicacion']);
        $id_prev = $prev_noticia[0]['id_publicacion'];
        $titulo_url_prev = $prev_noticia[0]['URL'];
        $url_prev = $actual_link.'/'.$id_prev.'/'.$titulo_url_prev;
        $anterior = "
            <a href='$url_prev' class='single-post-nav_prev spn_box'>
                <div class='spn_box_img'>
                    <img src='$imagen_prev' class='respimg'>
                </div>
                <div class='spn-box-content'>
                    <span class='spn-box-content_subtitle'><i class='fas fa-caret-left'></i> Publicación anterior</span>
                    <span class='spn-box-content_title'>$titulo_prev</span>
                </div>
            </a>
        ";
    }
    //Selecciona la noticia siguiente
    $next_noticia = $sql->obtenerResultado("CALL sp_select_noticia_next($id_publi)");
    // Si el arreglo no esta vacio
    if(count($next_noticia) > 0){
        $imagen_next = select_imagen('publicaciones',$next_noticia[0]['id_publicacion']);
        $titulo_next = strip_tags($next_noticia[0]['titulo_publicacion']);
        // $titulo_next = decodeEmoticons($next_noticia[0]['titulo_publicacion']);
        $id_next = $next_noticia[0]['id_publicacion'];
        $titulo_url_next = strip_tags($next_noticia[0]['URL']);
        $url_next = $actual_link.'/'.$id_next.'/'.$titulo_url_next;
    }else{
        $imagen_next = '';
        $titulo_next = '';
        $id_next = '';
        $url_next = '';
    }
    //Selecciona las publicaciones relacionadas
    $cantidad_tag = 2;
    $tag_id = $id_etiqueta;
    // Selecciona la noticia anterior de la misma categoria
    $prev_noticia_cat = $sql->obtenerResultado("CALL sp_select_noticia_prev_tag('".$id_publi."','".$id_cat."')");
    $prev_noticia_cat_row =  "";
    if($prev_noticia_cat){
        $id_prev_cat_row = $prev_noticia_cat[0]['id_publicacion'];
        $prev_img_noticia_cat = select_imagen('publicaciones',$prev_noticia_cat[0]['id_publicacion']);
        $prev_noticia_cont = strip_tags($prev_noticia_cat[0]['titulo_publicacion']);
        // $prev_noticia_cont = decodeEmoticons($prev_noticia_cat[0]['titulo_publicacion']);
        $titulo_url_cont = limitar_texto($prev_noticia_cat[0]['URL']);
        $prev_noticia_cat_row = "
        <div class='box-widget fl-wrap'>
            <div class='box-widget-content'>
                <div class='banner-widget fl-wrap'>
                    <div class='bg-wrap bg-parallax-wrap-gradien'>
                        <div class='bg' data-bg='$prev_img_noticia_cat'></div>
                    </div>
                    <div class='banner-widget_content'>
                        <h5>$prev_noticia_cont</h5>
                        <a href='$actual_link/$id_prev_cat_row/$titulo_url_cont' class='btn float-btn color-bg small-btn'>Ver noticia</a>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
    include_once('php/v/0/tag.php');
    include_once('php/v/0/seguidores.php'); 
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];    
    $link = "https://" . $host . $url;
    // Seleciona las ultimas entradas
    $noticias_row = new_row_noticia("CALL sp_select_ultimas_noticias2()");
    $row_ultimas_entradas = select_new_row_noticias(0,4,'right_div');
    // sp_select_ultimas_rel
    // Seleciona los tags principales
    $publicaciones_rowtag2 = select_new_row_noticias(5,9,'right_div');
    // $publicaciones_rowtag2 = crear_rows_noticias("CALL sp_select_publicaciones_fecha_tag(0,4,$tag_id,0,0)",6);
    $deportes_row = select_new_row_noticias(0,4,'Deportes');
    
    $contenido_tag = "
    <div class='grid-post-wrap'>							
        <div class='more-post-wrap  fl-wrap'>
        <div class='list-post-wrap list-post-wrap_column fl-wrap'>
                <div class='row'>
                    $deportes_row
                </div>
            </div>
        </div>
    </div>";
    
    $row_entradas_relacionadas = "
    <div class='grid-post-wrap'>							
        <div class='more-post-wrap  fl-wrap'>
        <div class='list-post-wrap list-post-wrap_column fl-wrap'>
                <div class='row'>
                    $publicaciones_rowtag2
                </div>
            </div>
        </div>
    </div>";
    $busqueda = traer_row_busqueda();
    echo "
    <!DOCTYPE HTML>
<html lang='es' class='oscuro'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
        <title>$titulo</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
        <meta name='robots' content='index, follow' />
        <meta name='keywords' content='' />
        <meta charset='utf-8'>
        <link type='text/css' rel='stylesheet' href='$actual_link/css/plugins.css?1'>
        <link type='text/css' rel='stylesheet' href='$actual_link/css/style.css?v1.42'>
        <link type='text/css' rel='stylesheet' href='$actual_link/css/color.css?v1'>
        <link type='text/css' rel='stylesheet' href='$actual_link/css/dark.css?v1.1'>
        <link rel='shortcut icon' href='https://superchannel12.com/$server_name.png'>
        <meta name='description' content='$subtitulo'/>
        <meta property='og:title' content='$titulo_compartir_nota' />
        <meta property='og:url' content='https://$domain/$id_publi/' />
        <meta property='og:description' content='$subtitulo_compartir_nota' />
        <meta property='og:image' content='$imagen' />
        <meta property='og:image:url' content='$imagen'>
        <meta property='og:type' content='article' />
        <meta property='og:locale' content='es_MX' />
        <meta property='og:image:secure_url' content='$imagen' />
        <meta property='og:image:type' content='image/$extension' />
        
        <meta name='twitter:card' content='summary_large_image' />
        <meta name='twitter:site' content='@SuperChannel_12' />
        <meta name='twitter:title' content='$titulo_compartir_nota' />
        <meta name='twitter:description' content='$subtitulo_compartir_nota' />
        <meta name='twitter:image' content='$imagen' />
        <meta property='fb:app_id' content='1782233748880937'>
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
        <div id='main'>
        ".$header_main."
    <div class='content'>
        <div class='breadcrumbs-header fl-wrap'>
            <div class='container'>
                <div class='breadcrumbs-header_url'>
                    <a href='$actual_link'>Inicio</a>
                    $categoria
                    $subcategoria
                    <span>$titulo</span>
                </div>
                <div class='scroll-down-wrap'>
                    <div class='mousey'>
                        <div class='scroller'></div>
                    </div>
                    <span>Desliza para ver</span>
                </div>
            </div>
        </div>
        <!--section   -->
        <section>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-8'>
                        <div class='main-container fl-wrap fix-container-init'>
                            <!-- single-post-header  -->
                            <div class='single-post-header fl-wrap'>
                            <div style='display: flex;justify-content: space-between;'>
                                    <a class='post-category-marker' href=''>$etiqueta_main</a>
                                </div>
                                <div class='clearfix'></div>
                                <h1>$titulo</h1>
                                <h4>$subtitulo</h4>
                                <div class='clearfix'></div>
                                <div class='author-link'><a href='$autor_url'><img src='$imagen_autor' alt=''>  <span>Por $autor</span></a></div>
                                <span class='post-date'><i class='far fa-clock'></i> $fecha</span>
                                <ul class='post-opt'>
                                    <li><i class='fal fa-eye'></i>  $visitas </li>
                                </ul>
                                <a class='whatsapp-soc customShareIcon' target='_blank' href='https://api.whatsapp.com/send?text=$link' data-action='share/whatsapp/share'>
                                    <i class='fab fa-whatsapp' aria-hidden='true'></i>
                                </a>
                                <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>
                                <a class='twitter-soc customShareIcon' href='https://twitter.com/share?url=$link' >
                                    <i class='fab fa-twitter' aria-hidden='true'></i>
                                </a>
                                <a class='facebook-soc customShareIcon' href='https://www.facebook.com/sharer/sharer.php?u=$link' >
                                    <i class='fab fa-facebook' aria-hidden='true'></i>
                                </a>
                                <a class='email-soc customShareIcon' target='_blank' href='mailto:?subject=$link' >
                                    <i class='fab fa fa-envelope' aria-hidden='true'></i>
                                </a>
                            </div>
                            <div class='single-post-content spc_column fl-wrap'>
                                <div class='clearfix'></div>
                                <div class='restartcss noticiaCSS single-post-content_text has-drop-cap' id='no_font_chage'>
                                    <img src='$imagen'>
                                    <div id='containerDocumento' class='Plength noticiaPading'>
                                    $contenido
                                    </div> 
                                </div>
                                    <div class='noticiaPading'>
                                        <a id='btn_escuchar_noticia' class='botonNota' style='float:right;'>
                                            <i class='fas fa-volume-up'></i>  Reproducir Nota
                                        </a>
                                    </div>                                    
                                <div class='single-post-footer fl-wrap'>
                                    <div class='post-single-tags'>
                                        <span class='tags-title'><i class='fas fa-tag'></i> Etiquetas : </span>
                                        <div class='tags-widget'>
                                            $etiquetas_pub
                                        </div>
                                    </div>
                                </div>
                                <!-- single-post-nav'   -->
                                <div class='single-post-nav fl-wrap'>
                                    $anterior
                                    <a href='$url_next' class='single-post-nav_next spn_box'>
                                        <div class='spn_box_img'>
                                            <img src='$imagen_next' class='respimg' alt=''>
                                        </div>
                                        <div class='spn-box-content'>
                                            <span class='spn-box-content_subtitle'>Siguiente publicación <i class='fas fa-caret-right'></i></span>
                                            <span class='spn-box-content_title'>$titulo_next</span>
                                        </div>
                                    </a>
                                </div>
                                <!-- single-post-nav'  end   -->
                            </div>
                            <!-- single-post-content  end   -->
                            <div class='limit-box2 fl-wrap'></div>
                            <!-- post-author-->                                   
                            <div class='post-author fl-wrap'>
                                <div class='author-img'>
                                    <img src='$imagen_autor' alt=''>	
                                </div>
                                <div class='author-content fl-wrap'>
                                    <h5>Escrito por: <a href='$autor_url'>$autor</a></h5>
                                    <p>$descripcion</p>
                                </div>
                                <div class='profile-card-footer fl-wrap'>
                                    <a href='$autor_url' class='post-author_link'>Ver más del autor <i class='fas fa-caret-right'></i></a>
                                </div>
                            </div>
                            <!--post-author end-->		
                            <div class='more-post-wrap  fl-wrap'>
                                <div class='pr-subtitle prs_big'>Entradas relacionadas</div>
                                $contenido_tag
                            </div>
                            <!--comments  -->
                            <div id='comments' class='single-post-comm fl-wrap'>
                                <div class='pr-subtitle prs_big'>Comentarios</div>
                                
                                <div class='clearfix'></div>
                                <!-- Agregar comentarios de facebook -->
                                <div id='fb-root'></div>
                                <script async defer crossorigin='anonymous' src='https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v13.0' nonce='ZyJULuon'></script>
                                <div style='background:white;' class='fb-comments' data-href='$link' data-width='100%' data-numposts='2' data-mobile data-order-by='reverse_time'></div>
                                <!--end respond-->
                            </div>
                            <!--comments end -->					  
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <!-- sidebar   -->
                        <div class='sidebar-content fl-wrap fixed-bar'>
                            <!-- box-widget -->
                            <div class='box-widget fl-wrap'>
                                <div class='box-widget-content'>
                                    <div class='search-widget fl-wrap'>
                                        $busqueda
                                    </div>
                                </div>
                            </div>
                            <!-- box-widget  end -->						
                            <!-- box-widget -->
                            $prev_noticia_cat_row
                            <!-- box-widget  end -->					
                            <!-- box-widget -->
                            <span id='categorias_populares'>
                                <i class='gg-spinner'></i>
                            </span>
                            <!-- box-widget -->
                            $popular_tags
                            <!-- box-widget  end -->						
                            <!-- box-widget -->
                            $siguenos_html
                            <!-- box-widget  end -->						
                            <!-- box-widget -->
                            <div class='box-widget fl-wrap'>
                                <div class='box-widget-content'>
                                    <!-- content-tabs-wrap -->
                                    <div class='content-tabs-wrap tabs-act tabs-widget fl-wrap'>
                                        <div class='content-tabs fl-wrap'>
                                            <ul class='tabs-menu fl-wrap no-list-style'>
                                                <li class='current'><a href='#tab-popular'> Relacionadas </a></li>
                                                <li><a href='#tab-resent'>Recientes</a></li>
                                            </ul>
                                        </div>
                                        <!--tabs -->                       
                                        <div class='tabs-container'>
                                            <!--tab -->
                                            <div class='tab'>
                                                <div id='tab-popular' class='tab-content first-tab'>
                                                    <div class='post-widget-container fl-wrap'>
                                                        <!-- post-widget-item -->
                                                        $row_entradas_relacionadas
                                                    </div>
                                                </div>
                                            </div>
                                            <!--tab  end-->
                                            <!--tab -->
                                            <div class='tab'>
                                                <div id='tab-resent' class='tab-content'>
                                                    <div class='post-widget-container fl-wrap'>
                                                        <!-- post-widget-item -->
                                                        $row_ultimas_entradas
                                                        <!-- post-widget-item end -->													
                                                    </div>
                                                </div>
                                            </div>
                                            <!--tab end-->							
                                        </div>
                                        <!--tabs end-->  
                                    </div>
                                    <!-- content-tabs-wrap end -->
                                </div>
                            </div>
                            <!-- box-widget  end -->					
                        </div>
                        <!-- sidebar  end -->
                    </div>
                </div>
                <div class='limit-box fl-wrap'></div>
            </div>
        </section>
        <!-- section end -->
        <!-- section  -->
        <div class='gray-bg ad-wrap fl-wrap'>
            <div class='content-banner-wrap'>
                <img src='images/all/banner.jpg' class='respimg' alt=''>
            </div>
        </div>
        <!-- section end -->
    </div>
    ";