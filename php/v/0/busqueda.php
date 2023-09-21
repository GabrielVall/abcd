<?php
include_once("../../m/SQLConexion.php");
include_once('../../m/funciones.php');
$sql = new SQLConexion();
$inicio = (int)$_POST['primera_pagina'];
$final = (int)$_POST['primera_pagina']+10;
$busqueda = filter_var(transform_titulo($_POST['busqueda']),FILTER_SANITIZE_STRING);
$publicaciones_rowtag = crear_div_busqueda("CALL sp_busqueda_noticia_ids($inicio,$final,'".$busqueda."')",'Posted');
if($publicaciones_rowtag != ''){
    echo $publicaciones_rowtag;
}