<?php
// $data = array(
//     'secret' => "0x65844e4505D7683D505BC7E3bc13C0f283A467F8",
//     'response' => $_POST['capcha']
// );
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://hcaptcha.com/siteverify");
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $response = curl_exec($ch);
// $responseData = json_decode($response);
// if($responseData->success) {
    session_start();
    include_once("../../m/SQLConexion.php");
    $sql = new SQLConexion();
    $password = $_POST['password'];
    $row = $sql->obtenerResultado("CALL sp_select_usuario_login('".test_input($_POST['email'])."')");
    if(isset($row[0]['id_usuario'])){
        if (password_verify($password, $row[0]['contrasena_usuario'])) {
            if($row[0]['id_estado_usuario'] == 2){
                $response_array['msg'] = 'Tu cuenta esta desactivada, contacta con el administrador';
            }else{
                $_SESSION['id_usuario_superchannel'] = $row[0]['id_usuario'];
                $_SESSION['nivel_usuario_superchannel'] = $row[0]['id_nivel_usuario'];
                $response_array['msg'] = 'success';
            }
        }else{
            $response_array['msg'] = 'Contraseña incorrecta, intente nuevamente.';
        }
    }else{
        $response_array['msg'] = 'este correo no esta asociado a ninguna cuenta';
    }
// } else {
//     $response_array['msg'] = 'Por favor verifica el captcha';
// }

header('Content-type: application/json');
echo json_encode($response_array);

function test_input($data) {
	return htmlspecialchars($data, ENT_QUOTES);
}