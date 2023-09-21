<?php
// Seleciona los tags principales
$row_videos = select_new_row_categoria($videos_row,'Videos');

echo <<<HTML
<div class="video-links-wrap">
        $row_videos	
</div>
HTML;
?>