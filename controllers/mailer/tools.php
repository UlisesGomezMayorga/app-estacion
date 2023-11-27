<?php

/*  Requiere por metodo post:

    send: valor "mail"
    destinatario: email del receptor
    motivo: motivo del mensaje que verá el receptor
    contenido: mensaje que verá el receptor, acepta etiquetas html
*/

include 'credenciales.php';
include 'Mailer/src/PHPMailer.php';
include 'Mailer/src/SMTP.php';
include 'Mailer/src/Exception.php';
function sendMail($destinatario,$motivo,$contenido){
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0 ;
    $mail->Host = HOSTER;
    $mail->Port = PORT;
    $mail->SMTPAuth = SMTP_AUTH; //
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Username = REMITENTE;
    $mail->Password = PASSWORD;

    $mail->setFrom(REMITENTE, NOMBRE);
    $mail->addAddress($destinatario);

    $mail->isHTML(true);

    $mail->Subject = utf8_decode($motivo);
    $mail->Body = utf8_decode($contenido);

    if(!$mail->send()){
        error_log("Mailer no se pudo enviar el correo!" );
        $body = array("errno" => 1, "error" => "No se pudo enviar.");
    }else{
        $body = array("errno" => 0, "error" => "Enviado con exito.");
    }   
    return $body;
}

 
?>


