<?php		
	include_once("../../m/SQLConexion.php");
	$sql = new SQLConexion();
	
	$row_instalacion = $sql->obtenerResultado("CALL sp_select_dispositivo1('".$_POST['uuid']."' )");

	if($row_instalacion[0][0] ==0) {	
		$rpta = $sql->obtenerResultadoSimple("CALL sp_insert_dispositivo1('".$_POST['token']."', '".$_POST['uuid']."' )");
		
		if($rpta){			
			$response_array['status'] = 'success';
		}	
		else{
			$response_array['status'] = 'error';
		}
	}
	else if($row_instalacion[0][0] ==1) {
		$rpta = $sql->obtenerResultadoSimple("CALL sp_update_dispositivo1('".$_POST['token']."', '".$_POST['uuid']."' )");
		
		if($rpta){			
			$response_array['status'] = 'success';			
		}	
		else{
			$response_array['status'] = 'error';			
		}
	}
	
	header('Content-type: application/json');
    echo json_encode($response_array);
?>