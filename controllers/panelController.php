<?php 

include('views/panel.html');
	include('models/conexionUsers.php');

	/* Captura la ip del cliente */
	$ip = $_SERVER['REMOTE_ADDR'];

	/* Protección para evitar leer una ip local */
	if($ip == "127.0.0.1")
		$ip = "181.47.205.193"; /* Usamos un ip pública */
	
	/* Consulta a la api para obtener más información de la ip */
	$web = file_get_contents("http://ipwho.is/".$ip);

	/* Convierte el json recuperado en un objeto */
	$response = json_decode($web);


	$latitud = $response->latitude;
	$longitud = $response->longitude;
	$pais = $response->country;

	$nav = $_SERVER['HTTP_USER_AGENT'];
	$navegador = explode(" G", $nav);
	$sistema = $navegador[1];
	$navegador = $navegador[0];

	$token = uniqid();

	$ssql = "INSERT INTO `tracker`(`token`, `ip`, `latitud`, `longitud`, `pais`, `navegador`, `sistema`) VALUES ('$token', '$ip', '$latitud', '$longitud', '$pais', '$navegador', '$sistema')";
	query($ssql);
 ?>