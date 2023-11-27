<?php 

	include('models/conexionUsers.php');
	include('controllers/mailer/tools.php');
	$ip = $_SERVER['REMOTE_ADDR'];
	$nav = $_SERVER['HTTP_USER_AGENT'];
	$navegador = explode(" G", $nav);	
	$date = date("Y-m-d H:i:s");
	$token_action = $_GET['token'];
	$ssql = "SELECT * FROM `usuario` WHERE `token_action` = '$token_action'";
	$response = query($ssql);
	$respuesta = $response->fetch_all(MYSQLI_ASSOC);
	if($respuesta != array()){
		include 'views/reset.html';
		if(isset($_POST['btnChange'])){
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];
			if($pass1 == $pass2){
    			$ssql = "UPDATE `usuario` SET `contraseña`='$pass1', `bloqueado`='0', `recupero`='0',`update_date`= '$date' WHERE `token_action` = '$token_action'";
    			$response = query($ssql);
    			$email = $respuesta[0]['email'];
    			$motivo = 'Aviso de App-Estación';
		       	$mensaje = "<h3>Su contraseña ha sido reestablecida. Fue usted?<br>Ip: $ip<br>Información del navegador y del sistema operativo: $navegador[0]<br>Si no fuiste tu, presiona el siguiente enlace para bloquear la cuenta: http://mattprofe.com.ar:81/alumno/3359/app_estacion/blocked&token=$token_action</h3>";
		   		sendMail($email,$motivo,$mensaje);
		   		echo 'Su cuenta se reestableció con éxito <a href="login">Presione aquí para iniciar sesión</a>';
			}else{
				echo("las contraseñas no coinciden");
			}
		}
	}else{
		echo "Token no válido, comprobar ingreso.";
	}

 ?>