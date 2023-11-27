<?php 

	define('HOST', 'localhost');
	define('USER', 'alumno');
	define('PASS', 'alumno');
	define('DB', 'julio');
	

	function dbConnect(){
		$db = new mysqli(HOST, USER, PASS, DB);

		if($db->connect_errno){
			echo ("Error de conexión con la base de datos");
			exit();	
		}
		
		return $db;	
	}

	function query($ssql){
		$db = dbConnect();
		
		$response = $db->query($ssql); 

		if($db->errno){
			echo "ERROR QUERY: ".$db->error;
			exit();	
		}

		return $response;
	}


 ?>