<?php 
	include('controllers/mailer/tools.php');

	include 'views/recovery.html';
	include('models/conexionUsers.php');
	$date = date("Y-m-d H:i:s");

	if(isset($_POST['btnRecovery'])){
		$email = $_POST['user'];
		$ssql = "SELECT * FROM `usuario` WHERE `email` = '$email'";
        $response = query($ssql);
        $resultado = $response->fetch_all(MYSQLI_ASSOC);
        if($resultado != array()){
			$token = $resultado[0]['token_action'];
    	    $ssql = "UPDATE `usuario` SET `recupero`='1',`recover_date`= '$date' WHERE `token_action` = '$token'";
			$response = query($ssql);
	   		$motivo = 'Aviso de reestablecimiento';
   			$mensaje = "<h3Su cuenta se encuentra en proceso de reestablecimiento<br>Presione en el siguiente link para reestablecer su cuenta: http://mattprofe.com.ar:81/alumno/3359/app_estacion/reset&token=$token .</h3>";
   			sendMail($email,$motivo,$mensaje);
   			echo 'Se envió un correo de reestablecimiento a su casilla de correo';
        }else{
        	echo 'Este email no se encuentra registrado <br> <a href="register">El email no se encuentra registrado, registrese aquí</a>';
        }
	}


 ?>