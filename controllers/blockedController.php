<?php 
	include('models/conexionUsers.php');
	include('controllers/mailer/tools.php');
  include('views/text.html');
	$token_action = $_GET['token'];
	$date = date("Y-m-d H:i:s");
    $ssql = "UPDATE `usuario` SET `bloqueado`='1',`blocked_date`= '$date' WHERE `token_action` = '$token_action'";
    $response = query($ssql);
    if($response){
    	$ssql = "SELECT * FROM `usuario` WHERE `token_action` = '$token_action'";
    	$respuesta = query($ssql);
        $usuarios = $respuesta->fetch_all(MYSQLI_ASSOC);
        $email = $usuarios[0]['email'];
   		$motivo = 'Aviso de App-Estación';
   		$mensaje = "<h3>Su cuenta acaba de ser bloqueada<br> Presionando el siguiente enlace pdorá cambiar su contraseña: http://mattprofe.com.ar:81/alumno/3359/app_estacion/recovery</h3>";
   		sendMail($email,$motivo,$mensaje);
   		echo '<h1>Su cuenta se bloqueó con éxito, revise su correo electrónico</h1>';
    }else{
    	echo "<h1>El token no corresponde a ningún usuario</h1>";
    }
 ?>