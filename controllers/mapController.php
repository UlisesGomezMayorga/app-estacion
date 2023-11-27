<?php 

	if($_SESSION['user'] != 'admin-estacion'){
		header('Location: panel');
	}

	include 'views/map.html';
 ?>