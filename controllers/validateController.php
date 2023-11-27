<?php 
	include('models/conexionUsers.php');
	include('controllers/mailer/tools.php');

	// var_dump($_GET);
	$date = date("Y-m-d H:i:s");
	$token_action = $_GET['token'];
    $ssql = "UPDATE `usuario` SET `activo`='1',`active_date`= '$date' WHERE `token_action` = '$token_action'";
    $response = query($ssql);
    if($response){
    	$ssql = "SELECT * FROM `usuario` WHERE `token_action` = '$token_action'";
    	$respuesta = query($ssql);
        $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
        $email = $usuarios[0]['email'];
   		$motivo = 'Su cuenta se encuentra activa';
   		$mensaje = "<h3>Su cuenta acaba de ser habilitada.</h3>";
   		sendMail($email,$motivo,$mensaje);
   		echo 'Su cuenta se habilitó con éxito.<br> <a href="login">Presione aquí para iniciar sesión</a>';
    }else{
    	echo "El token no corresponde a ningún usuario";
    }
 ?>