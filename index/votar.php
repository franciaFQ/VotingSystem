<?php
session_start();
	include 'conexion.php';

	$carnet = $_POST['carnet'];
	$fin = false;

	if (isset($_POST['fin'])) {
		$fin=true;
	}else{
		$despu = $_POST['desp'];
	}

	try{
        $consulta=$conn->query("SET NAMES 'utf8'");
		$consulta=$conn->prepare("INSERT INTO votos(codigo_candidato) VALUES(?)");

		$consulta->bindParam(1,$carnet);
		if ($consulta->execute()) {

			if ($fin) {
                $conn->query("SET NAMES 'utf8'");
				$sql = "update usuarios set estado='Votado' where (carnet='".$_SESSION['carnet']."')";
				$edit = $conn->prepare($sql);
				$resultE = $edit->execute();
				
				echo "<p><a href='logout.php' class='btn btn-primary' role='button' >GRACIAS POR VOTAR</a></p>";

			}else{
				echo "<p><a href='#".$despu."' data-toggle='tab' class='btn btn-primary' role='button' >Siguiente</a></p>";
			}
			
		}else{
			echo "Error no se pudo almacenar los datos";
		}

	}catch(Exception $e){
		header('location:votacion.php');
	}
?>