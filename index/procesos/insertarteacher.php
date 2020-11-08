<?php
	if (!$verI) {
		header("location: ../logout.php");
	}
	$carnet = $_POST['carnet'];
	$nombre = $_POST['nombre'];
	$contra = $_POST['contra'];
	$tipo = 2;
	

	$consulta=$conn->prepare("INSERT INTO usuarios(carnet,nombre,codigo_tipo,contrasena) VALUES(?,?,?,?)");

	$consulta->bindParam(1,$carnet);
	$consulta->bindParam(2,$nombre);
	$consulta->bindParam(3,$tipo);
	$consulta->bindParam(4,$contra);

	if($consulta->execute()){
		echo "Datos almacenados";
	}else{
		echo "Error no se pudo almacenar los datos";
	}


?>

	 
		
