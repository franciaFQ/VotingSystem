<?php

	include '../conexion.php';

	$carnet = $_POST['idD'];
	
	$consulta2 = $conn->prepare("DELETE FROM usuarios WHERE carnet=:carnet");
	$consulta2->bindParam(":carnet", $carnet);
	$conn = null;
	if($consulta2->execute()){
		echo "El teacher se elimino con exito";
		header('Location: ../teachers.php#list');
	}else{
		echo "Error: El teacher no se elimino";
		header('Location: ../teachers.php#list');
	}

?>	