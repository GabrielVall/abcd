<?php
// Si tiene www, elimínelo
$host = $_SERVER['HTTP_HOST'];
if (strpos($host, 'www') !== false) {
    $host = str_replace('www.', '', $host);
    header("Location: https://$host/");
}

// Mostrar errores
include_once("php/m/SQLConexion.php");
include_once('php/m/funciones.php');
session_start();
$sql = new SQLConexion();
$configuraciones = $sql->obtenerResultado("CALL sp_select_configuraciones()");
$page = explode('/', substr($_SERVER['REQUEST_URI'], 1), 2);

// Incluye la página detectada
$pag = detectar_pagina();
include_once('php/v/0/' . $pag . '.php');

// Incluye el pie de página
include_once('php/v/0/footer.php');
?>
<div class="modal_bg" style="display:none;">
    <div class="modal_main">
        <div class="top_modal">
            <img src="<?php echo htmlspecialchars($actual_link) ?>/notif.gif" class="w-100">
        </div>
        <div class="bottom_modal">
            <div class="titulo_modal">
                ¡No te pierdas lo último en noticias!
            </div>
            <div class="text_modal">
                Activa las notificaciones para saber cuándo hay nuevas noticias.
            </div>
            <div class="close-button" id="cerrar_boton_notificacion">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js?" async=""></script>
<?php
if ($actual_link == 'https://superchannel12.com') {
    $key_onesignal = '63c06cdb-08b6-4806-b15d-f97fc454d699';
} else if ($actual_link == 'https://radiozocalo.com.mx') {
    $key_onesignal = '3c6ea9dc-363a-4571-b3fa-f2f8fe384284';
} else if ($actual_link == 'https://laprimera.com.mx') {
    $key_onesignal = 'f370c1e3-1126-4e01-bb35-09712e639e73';
}
?>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: '<?php echo htmlspecialchars($key_onesignal); ?>',
        });
    });
</script>
<script src='https://js.hcaptcha.com/1/api.js?render=explicit' async defer></script>
<script src="<?php echo htmlspecialchars($actual_link) ?>/js/jquery.min.js?v"></script>
<script src="<?php echo htmlspecialchars($actual_link) ?>/js/plugins.js?v"></script>
<script src="<?php echo htmlspecialchars($actual_link) ?>/js/scripts.js?v1.25"></script>
<script src="<?php echo htmlspecialchars($actual_link) ?>/js/main.js?0.35"></script>
<!-- <script src="<?php echo htmlspecialchars($actual_link) ?>/js/funciones-nativo.js?0.2"></script> -->
</html>