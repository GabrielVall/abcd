<?php
include_once('php/m/funciones.php');
$wp = $configuraciones[3][2];
$tel = $configuraciones[4][2];
$pub = $configuraciones[5][2];
$contacto = $configuraciones[6][2];
if($server_name == 'RadioZocalo'){
    $nombre_footer = 'Radio Zócalo Noticias';
    $ref_footer  = '&#169; Radio Zócalo, S.A de C.V';
    $li_footer = '<li><a href="https://superchannel12.com/">SuperChannel 12</a></li>
                 <li><a href="https://www.zocalo.com.mx ">Periódico Zócalo</a></li>';
}else if($server_name == 'SuperChannel'){
    $nombre_footer = 'SuperChannel 12';
    $ref_footer  = '&#169; SuperChannel 12, 2023, XHFJS-TV S.A DE C.V';
    $li_footer = '<li><a href="https://radiozocalo.com.mx/">Radio Zócalo Noticias </a></li>
                  <li><a href="https://www.zocalo.com.mx ">Periódico Zócalo</a></li>';
}else if($server_name == 'La Primera'){
    $nombre_footer = 'La Primera';
    $ref_footer  = '&#169; La Primera, 2023, XHFJS-TV S.A DE C.V';
    $li_footer = '<li><a href="https://laprimera.com.mx/">La Primera Noticias </a></li>';
}
if($server_name == 'SuperChannel'){
    $pdf_pub = 'https://superchannel12.com/publicidad_superchannel.pdf';
}else{
    $pdf_pub = 'https://radiozocalo.com.mx/publicidad_radiozocalo.pdf';
}
echo <<<HTML
<footer class="fl-wrap main-footer">
    <div class="container">
        <div class="footer-widget-wrap fl-wrap">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-widget">
                        <div class="footer-widget-content">
                            <div class="footer-widget-title">Sobre nosotros </div>
                        </div>
                        <div class="footer-list footer-box fl-wrap">
                            <ul>
                                <li> <a href="https://api.whatsapp.com/send?phone=$wp"> WhatsApp: +$wp</a></li>
                                <li> <a href="tel:$tel"> Telefono: +$tel</a></li>
                                <li> <a href="tel:$pub"> Publicidad: +$pub</a></li>
                                <li> <a href="tel:$contacto"> Contacto: $contacto</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <div class="footer-widget-title">Siguenos</div>
                        <div class="footer-widget-content">
                            <div class="box-widget-content">
                                <div class="social-widget">
                                    <a href="$facebook" target="_blank" class="facebook-soc">
                                    <i class="fab fa-facebook-f"></i>
                                    <span class="soc-widget-title">Facebook</span>
                                    </a>
                                    <a href="$twitter" target="_blank" class="twitter-soc">
                                    <i class="fab fa-twitter"></i>
                                    <span class="soc-widget-title">Twitter</span>										
                                    </a> 
                                    <a href="$yt" target="_blank" class="youtube-soc">
                                    <i class="fab fa-youtube"></i>
                                    <span class="soc-widget-title">YouTube</span>										
                                    </a> 												
                                    <a href="$insta" target="_blank" class="instagram-soc">
                                    <i class="fab fa-instagram"></i>
                                    <span class="soc-widget-title">Instagram</span>												
                                    </a> 														
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom fl-wrap">
        <div class="container">
            <div class="copyright"><span> $ref_footer</span></div>
            <div class="to-top"> <i class="fas fa-caret-up"></i></div>
            <div class="subfooter-nav">
                <ul>
                    $li_footer
                    <li><a href="https://superchannel12.com/politica-privacidad">Politica de privacidad</a></li>
                    <li><a href="https://superchannel12.com/codigo-etica">Código de Ética</a></li>
                    <li><a href="$pdf_pub">Publicidad</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="aside-panel">
    <ul>
        <li class="light"> <a href="javascript:void(0)"><i id="icono" class="close  gg-sun"></i><span id="modo">Modo diurno</span></a></li>
    </ul>
</div>
<a href="$bottom_ref" class="float">
    <i class="fas fa-$icon_ref"></i> &nbsp; $text_ref
</a>

HTML;
?>