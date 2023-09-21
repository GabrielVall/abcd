<?php		
    include_once("../../m/SQLConexion.php");
	$sql = new SQLConexion();
	
	$rpta = $sql->obtenerResultadoSimple("CALL sp_update_token1('".$_POST['uuid']."', '".$_POST['token']."' )");
	
	if($rpta){			
		$response_array['status'] = 'success';		
	}	
	else{
		$response_array['status'] = 'error';		
	}
	
	header('Content-type: application/json');
    echo json_encode($response_array);
?>