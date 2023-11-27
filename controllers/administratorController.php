<?php 
	include('models/conexionUsers.php');

	if($_SESSION['user'] != 'admin-estacion'){
		header('Location: panel');
	}

	$conn = new mysqli('mattprofe.com.ar', '3359', 'conejo.abeto.jugo', '3359');
	$sql = "SELECT ip, latitud, longitud, COUNT(token) as cantidad_accesos FROM tracker GROUP BY ip";
	$result = $conn->query($sql);

	// Verificar si hay resultados
	if ($result->num_rows > 0) {
	    // Crear un array para almacenar los resultados
	    $clientes = array();

	    // Iterar sobre los resultados y agregar al array
	    while($row = $result->fetch_assoc()) {
	        $cliente = array(
	            "ip" => $row["ip"],
	            "latitud" => $row["latitud"],
	            "longitud" => $row["longitud"],
	            "cantidad_accesos" => $row["cantidad_accesos"]
	        );
	        $clientes[] = $cliente;
	    }
	    $cant_clientes = count($clientes);
	}
	$tpl = file_get_contents('views/administrator.html');
	$tpl = str_replace('{{USUARIOS_REGISTRADOS}}', $cant_clientes, $tpl);
	echo $tpl;
	// include 'views/administrator.html';
 ?>