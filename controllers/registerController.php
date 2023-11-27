<?php 

	include('models/conexionUsers.php');
	include('views/register.html');
	include('controllers/mailer/tools.php');

	if(isset($_POST['btnRegister'])){
		$email = $_POST['user'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		if($pass1 == $pass2){
	        $ssql = "SELECT * FROM `usuario` WHERE `email` = '$email'";
        	$response = query($ssql);
       		$resultado = $response->fetch_all(MYSQLI_ASSOC);
       		if($resultado == array()){
       			$token = md5($email);
       			$token_action = md5($pass1);
       			echo "usuario valido";
       			$ssql = "INSERT INTO `usuario`(`token`, `email`, `nombres`, `contraseña`,`token_action`) VALUES ('$token','$email','$email','$pass1','$token_action')";
       			query($ssql);
	       		$motivo = 'Creación de cuenta de App-Estacion';
	       		$mensaje = "<h3>Bienvenido a App-Estacion, un lugar donde puedes visualizar las estadisticas de multiples estaciones meteorológicas<br>Haga click aquí para habilitar su cuenta: http://mattprofe.com.ar:81/alumno/3359/app_estacion/validate&token=$token_action</h3>";
       			sendMail($email,$motivo,$mensaje);
       			echo("Se ha enviado un email de confirmación a tu cuenta de correo electrónico.");
       		}else{
       			echo 'Este email ya esta siendo utilizado por otro usuario. <a href="login">Desea iniciar sesión?</a>';
       		}
		}else{
			echo("Las contraseñas no coinciden");
		}
	}

 ?>