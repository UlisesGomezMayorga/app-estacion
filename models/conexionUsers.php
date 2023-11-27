<?php 

	define('HOST', 'mattprofe.com.ar');
	define('USER', '3359');
	define('PASS', 'conejo.abeto.jugo');
	define('DB', '3359');
	

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