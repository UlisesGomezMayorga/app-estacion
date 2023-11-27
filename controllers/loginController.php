<?php 
	include('models/conexionUsers.php');
	include('views/login.html');
	include('controllers/mailer/tools.php');
	$ip = $_SERVER['REMOTE_ADDR'];
	$nav = $_SERVER['HTTP_USER_AGENT'];
	$navegador = explode(" G", $nav);	
	if(isset($_POST['btnLogin'])){
		$email = $_POST['user'];
		$pass = $_POST['pass'];
        if($email == 'admin-estacion' && $pass == 'admin1234'){
            $_SESSION['user'] = $email;
            header('Location:administrator');
        }
        $ssql = "SELECT * FROM `usuario`";
        $response = query($ssql);
        $usuarios = $response->fetch_all(MYSQLI_ASSOC);
        foreach ($usuarios as $key => $usuario) {
            if($usuario['email'] == $email){
                if($usuario['contraseña'] == $pass){
                    if($usuario['activo'] == 0){
                        echo "Su usuario aún no ha sido validado, revise su casilla de correo";
                        die();
                    }
                    if($usuario['bloqueado'] == 1 || $usuario['recupero'] == 1){
                        echo "Su usuario se encuentra bloqueado, revise su casilla de correo";
                        die();              
                    }
                    $token_action = $usuario['token_action'];
		       		$motivo = 'Nuevo inicio de sesión detectado';
		       		$mensaje = "<h3>Se ha detectado un inicio de sesión<br>Ip: $ip<br>Información del navegador y del sistema operativo: $navegador[0]<br>Si no fuiste tu, presiona el siguiente enlace para bloquear la cuenta: http://mattprofe.com.ar:81/alumno/3359/app_estacion/blocked&token=$token_action</h3>";
		       		sendMail($email,$motivo,$mensaje);
                    $_SESSION['user'] = $usuario['email'];
                    header('Location: panel');
                    die();
                }else{
                    echo("Contraseña incorrecta");
                    $token_action = $usuario['token_action'];
		       		$motivo = 'Nuevo inicio de sesión detectado';
		       		$mensaje = "<h3>Se ha detectado un intento de acceso a su cuenta.<br>Ip: $ip<br>Información del navegador y del sistema operativo: $navegador[0]<br>Si no fuiste tu, presiona el siguiente enlace para bloquear la cuenta: http://mattprofe.com.ar:81/alumno/3359/app_estacion/blocked&token=$token_action</h3>";
		       		sendMail($email,$motivo,$mensaje);
                    die();
                }
            }else{
            	echo("Credenciales Inválidas");
            }
        }
    }
?>