<?php
	if (!$verI) {
		header("location: ../logout.php");
	}
	$nombre_tipos = $_POST['nombreT'];	

	$consulta=$conn->prepare("INSERT INTO tipos (nombre_tipo) VALUES(?)");

	$consulta->bindParam(1, $nombre_tipos);
	
	if($consulta->execute()){
		echo "Datos almacenados";
	}else{
		echo "Error no se pudo almacenar los datos";
	}

?>