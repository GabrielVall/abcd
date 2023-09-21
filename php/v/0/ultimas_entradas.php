<?php
// Seleciona los tags principales
$row_ultimas_entradas0 = select_new_row_noticias(0,1,'ultima_entrada');
$row_ultimas_entradas1 = select_new_row_noticias(1,6,'ultimas_entradas');

echo <<<HTML
<section>
    <div class="container">
        <div class="section-title sect_dec">
            <h2>Ultimas entradas</h2>
            <h4>No te pierdas lo más reciente</h4>
        </div>
        <div class="row">
            <div class="col-md-5">
                
                    $row_ultimas_entradas0
                
            </div>
            <div class="col-md-7">
                <div class="picker-wrap-container fl-wrap">
                    <div class="picker-wrap-controls">
                        <ul class="fl-wrap">
                            <li><span class="pwc_up"><i class="fas fa-caret-up"></i></span></li>
                            <li><span class="pwc_pause"><i class="fas fa-pause"></i></span></li>
                            <li><span class="pwc_down"><i class="fas fa-caret-down"></i></span></li>
                        </ul>
                    </div>
                    <div class="picker-wrap fl-wrap">
                        <div class="list-post-wrap  fl-wrap">
                                $row_ultimas_entradas1
                        </div>
                    </div>
                    <div class="controls-limit fl-wrap"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="limit-box"></div>
</section>
HTML;
?>