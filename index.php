<?php 

	session_start();

	$_ROUTE = explode("/", $_GET["seccion"]);

	if($_ROUTE[0]!=""){
		$section = $_ROUTE[0];

		if(!file_exists("controllers/{$section}Controller.php")){
			$section = "error404";
		}

	}else{
		$section = "landing";
	}
	


	if(!isset($_SESSION['user'])){
		if($section == 'detalle' || $section == 'panel'){
			$section = "landing";
		}
	}

	if(isset($_SESSION['user'])){
		if($section == 'login' || $section == 'register' || $section == 'blocked' || $section == 'landing' || $section == 'recovery' || $section == 'reset' || $section == 'validate'){
			$section = "panel";
		}
	}
	include "controllers/{$section}Controller.php";

 ?>