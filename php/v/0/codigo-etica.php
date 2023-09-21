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
                <h2 class="puente_titulo">Codigo Etica</h2>
                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">INTRODUCCION</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">En cumplimiento con el marco normativo vigente, ponemos a su disposición el Código de Ética, el cual constituye un esfuerzo por parte de la Industria de Radio y Televisión para comprometerse con sus audiencias y establecer directrices que los empresarios, directores, editores y reporteros deben seguir mediante criterios éticos para el tratamiento de la información y los contenidos que se presentan.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Este documento aspira a ser una herramienta útil para las audiencias, reconociendo que la participación de nuestras audiencias es clave para el éxito en la práctica diaria de nuestro trabajo.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Este código se nutre de la experiencia de los distintos trabajos que, en su momento, realizaron los presidentes del Consejo de Autorregulación y del Comité de Ética de la Cámara Nacional de la Industria de Radio y Televisión –CIRT–; institución a la que estamos afiliados.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Este código asegurará el cumplimiento de los derechos establecidos en los artículos 6° y 7° de la Constitución Política de los Estados Unidos Mexicanos.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPÍTULO I. OBJETO</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">El Código de Ética tiene como objetivo establecer los principios, objetivos, valores, deberes y obligaciones que deben regir el actuar de este concesionario de radiodifusión con la sociedad mediante comportamientos responsables.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">En el presente Código de Ética se incorporan determinados lineamientos con el fin de prevenir comportamientos de los que se pueda derivar algún tipo de daño a la sociedad o desprestigio para el ramo de la radiodifusión.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO II. ÁMBITO DE APLICACIÓN</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Para los efectos de este Código de Ética, por radiodifusor se entenderá cualquier persona física o moral titular de una concesión para prestar el servicio de radiodifusión mediante la propagación de ondas electromagnéticas de señales de audio o de audio y video asociado, haciendo uso, aprovechamiento o explotación de las bandas de frecuencias del espectro radioeléctrico atribuido por el Estado precisamente a tal servicio; con el que la población puede recibir de manera directa y gratuita las señales de su emisor utilizando los dispositivos idóneos para ello.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO III. PRINCIPIOS GENERALES</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">En materia de información, este concesionario de radiodifusión observará lo siguiente:
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Informará al público de una manera precisa, exhaustiva e imparcial, sobre los eventos y temas de importancia.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Presentará noticias e información sin distorsión. Las entrevistas podrán ser editadas siempre que el significado no se cambie o se distorsione.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; La sala de redacción deberá adoptar medidas para garantizar la autenticidad de todo el video y audio, incluyendo el material informativo adquirido del público, reporteros autónomos y otras fuentes, antes de difundirlo.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Reconocerá los errores rápidamente y los corregirá.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Tratará a las personas que son sujetos de noticias con decencia y sensibilidad especialmente cuando se trata de niños.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Se esforzará por comportarse de una manera cortés y considerada, recopilando la información de la manera más discreta posible.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Evitará distorsionar el carácter o la importancia de los acontecimientos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Distinguirá claramente las participaciones editoriales y comentarios del contexto informativo.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Procurará que sus transmisiones se mantengan dentro de los límites del respeto a la vida privada, a la dignidad personal y a la moral, y no ataquen los derechos de terceros, ni provoquen la comisión de algún delito o perturben el orden y la paz públicos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; La radio y la televisión deben ser espacios responsables de información, entretenimiento, cultura y convivencia.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">&bull; Se obligará a atender las recomendaciones del Defensor de las Audiencias que nombrará la CIRT y deberá coordinarse con el mismo para atender las quejas u observaciones de la audiencia.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO IV. TRATAMIENTO DE LA INFORMACIÓN</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Los contenidos deben estar libres de cualquier prejuicio. Toda corriente de pensamiento debe ser representada debidamente. No obstante, ser imparcial no implica abstenerse de asumir de manera legítima posturas editoriales. Los medios deberán distinguir en la medida de lo posible la información de la opinión y la publicidad o propaganda.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Los medios de comunicación deberán informar al público de una manera clara, precisa y exhaustiva, citando la fuente y respetando en todo momento los derechos de autor.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Los medios deberán verificar, tanto como sea posible en sus circunstancias, los hechos que reporten.Siempre que sea posible deberán recoger la información de primera mano; en su defecto, deberán buscar testigos presenciales.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Los medios deberán reflejar la diversidad cultural del país y del mundo, para lo cual la programación tendrá que ser plural, presentando diversas formas de pensar y proporcionando variedad de contenidos.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO V. COBERTURA INFORMATIVA DE LA VIOLENCIA</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Los medios debemos condenar y rechazar la violencia motivada por la delincuencia organizada,
                enfatizar en el impacto negativo que tiene en la población y fomentar la conciencia social en contra
                de la violencia.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Evitar el lenguaje y la terminología empleados por los delincuentes.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Abstenernos de usar inadecuadamente términos jurídicos que compliquen la comprensión de los
                procesos judiciales en contra de la delincuencia organizada.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Al informar sobre delitos y/o hechos presuntamente ilícitos, manejar la información de forma que
                se procure impedir que los delincuentes o presuntos delincuentes se conviertan en víctimas o
                héroes públicos, pues esto les ayuda a construir una imagen favorable ante la población, a convertir
                en tolerables sus acciones e, incluso, a ser imitados.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Omitir y desechar información que provenga de los grupos criminales con propósitos
                propagandísticos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">No convertirse en instrumento o en parte de los conflictos entre grupos de la delincuencia.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">La información que se difunda sobre el crimen organizado debe asignar a cada quien la
                responsabilidad que tenga sobre los hechos de violencia.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">La información que los medios presentemos debe respetar los derechos de las víctimas y de los
                menores de edad involucrados en hechos de violencia. Nunca debe darse información que ponga
                en riesgo su identidad.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO VI. PROGRAMACIÓN</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Los medios respetarán elementos como la raza, la nacionalidad, la religión, orientación sexual,
                estado civil o discapacidad física o mental de todas las personas y sólo harán referencia a ellos
                cuando sean relevantes e indispensables para la claridad de las noticias y en la medida en que
                generen algún valor para las audiencias. Se deberán evitar los estereotipos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Se vigilará que, tanto los contenidos como la publicidad, sean propicios para el público receptor de
                acuerdo con el horario de que se trate.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">En las transmisiones de radio y televisión se evitará el uso de lenguaje vulgar, obsceno o grosero;
                asimismo, se evitará el uso de expresiones que tiendan a la discriminación o que tengan la intención
                de ofender, y se tomará en cuenta al público al que va dirigido.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Se respetará, en todo momento, el derecho al honor, a la intimidad o privacidad, en especial cuando
                se trate de niños y adolescentes. Se considerará excepción a este principio los casos en que el
                comportamiento de un servidor público afecte el interés general o se trate de información de interés
                público.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Se observarán, al menos, los criterios y estándares que resulten de la legislación en materia de
                protección de la infancia.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO VII. DE LOS DERECHOS DE LAS AUDIENCIAS CON DISCAPACIDAD</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Con el objeto de que exista una igualdad real de oportunidades, las audiencias con discapacidad
                gozarán de los siguientes derechos:
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Contar con servicios de subtitulaje, doblaje al español y lengua de señas mexicanas para
                accesibilidad a personas con debilidad auditiva. Estos servicios deberán estar disponibles en, al
                menos, uno de los programas noticiosos de mayor audiencia a nivel nacional.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">A que se promueva el reconocimiento de sus capacidades, méritos y habilidades, así como la
                necesidad de su atención y respeto.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">A contar con mecanismos que les den accesibilidad para expresar sus reclamaciones, sugerencias y
                quejas a los Defensores de las Audiencias, siempre y cuando no represente una carga
                desproporcionada o indebida para el concesionario de radiodifusión.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Acceso a la guía de programación a través de un número telefónico o de portales de Internet del
                concesionario de radiodifusión en formatos accesibles para personas con discapacidad.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO VIII. PROTECCIÓN DE NIÑAS, NIÑOS Y ADOLESCENTES</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Este concesionario de radiodifusión, en materia de protección de niñas, niños y adolescentes se
                obliga a:
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Procurar difundir información y materiales que sean de interés social y cultural para niñas, niños y
                adolescentes, de conformidad con los objetivos de educación que dispone el artículo 3° de la
                Constitución y la Convención sobre los Derechos del Niño.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Evitar la emisión de información contraria a los objetivos de educación que dispone el artículo 3° de
                la Constitución y la Convención sobre los Derechos del Niño, y que sea perjudicial para su bienestar
                o contraria a los principios de paz, no discriminación y de respeto a todas las personas.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Procurar difundir información y materiales que contribuyan a orientar a las niñas, niños y
                adolescentes en el ejercicio de sus derechos, les ayude a un sano desarrollo y a protegerse a sí
                mismos de peligros que puedan afectar su vida o su salud.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Garantizar el respeto a los derechos fundamentales de los menores que participen en programas de
                televisión.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Evitar la incitación a los niños a la imitación de comportamientos perjudiciales o peligrosos para la
                salud.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Evitar la utilización de los conflictos personales y familiares como espectáculo.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Sensibilizar con los problemas de la infancia a todos los profesionales relacionados con la
                preparación de la programación.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Fomentar que los presentadores o conductores de programas en vivo adviertan las situaciones que
                puedan afectar a la protección de niñas, niños y adolescentes de forma que se minimicen los
                eventuales perjuicios que puedan causarles.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Propiciar el desarrollo armónico de la niñez.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Proporcionar diversión y coadyuvar en el proceso formativo en la infancia.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">La transmisión de programas y publicidad impropios para la niñez y la juventud deberán anunciarse
                como tales al público en el momento de iniciar la transmisión respectiva.
                </p>

                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO IX. DE LA PUBLICIDAD</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">La publicidad que se transmita se referirá a los bienes, productos y servicios, de tal forma que no cause confusión al público receptor, evitando aquella publicidad que haga mal uso del lenguaje mediante expresiones o imágenes vulgares u obscenas.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Al transmitirse deberá presentar las características o cualidades debidamente acreditadas de los bienes, productos y servicios a que se refiera:
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Distinguir entre noticia y publicidad y rechazar las formas híbridas que borran los límites entre las dos.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Mantener la misma calidad y niveles de audio y video durante la programación, incluidos los espacios publicitarios.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Tener especial cuidado en la publicidad pautada destinada al público infantil.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">En la publicidad destinada al público infantil no se permitirá:
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Promover o mostrar conductas ilegales, violentas o que pongan en riesgo su vida o integridad física, ya sea mediante personajes reales o animados.
                </p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">Presentar a niñas, niños o adolescentes como objeto sexual.
                </p>
                
                <p style="text-align:left;font-weight:700;line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">CAPITULO X. DEL DEFENSOR DE LAS AUDIENCIAS</p>
                <p style="line-height: 30px;font-size: medium;padding-right: 0px !important;margin:25px 50px;">El Defensor de las Audiencias funge como mediador y vínculo entre el público televidente o radioescucha y los medios de comunicación, por lo que, para el adecuado desempeño de las funciones que, en los Estatutos se le otorgan, deberá constreñirse a los principios y directrices señaladas en este Código.
                </p>

            </div>
        ';
echo $frames;
?>
