<?php

if(unlink('../../../images/'.$_POST['dir'].'/'.$_POST['file_path'])){
    $response_array['status']='success';
}
else{
    $response_array['status']='error';
}
header('Content-type: application/json');
echo json_encode($response_array);