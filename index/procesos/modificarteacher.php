<?php

	include '../conexion.php';

	$carnet = $_POST['carnete'];
	$nombre = $_POST['namee'];
	$contra = $_POST['contrae'];
	
	try{
		$consulta=$conn->prepare("update usuarios set nombre=?, contrasena=? where (carnet=?)");

		$consulta->bindParam(3,$carnet);
		$consulta->bindParam(1,$nombre);
		$consulta->bindParam(2,$contra);

		if($consulta->execute()){
			header("location:../teachers.php");
		}else{
			header("location:../teachers.php");
		}

	}catch(PDOException $e){
		header("location:../teachers.php");
	}
	

?>