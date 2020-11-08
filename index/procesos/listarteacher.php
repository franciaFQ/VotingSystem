<?php
	if (!$verI) {
		header("location: ../logout.php");
	}
		try{
			$getUsers = $conn->query("SET NAMES 'utf8'");
			$getUsers = $conn->prepare("SELECT u.carnet, u.nombre, u.contrasena FROM usuarios u where u.codigo_tipo = 2");
			$getUsers->execute();
			$users = $getUsers->fetchAll();
			$veri = true;
			foreach ($users as $user) {
				$carnet = $user['carnet'];
				echo "<tr>";
	    		echo '<td> '.$carnet. ' </td>';
	    		echo '<td> '.$user['nombre'] . ' </td>';
	    		echo '<td> '.$user['contrasena'] . ' </td>';
	    		
	    		echo '<td><a class="btn btn-success btn-raised btn-xs" data-toggle="modal" href="#edit' . $carnet . '"><i class="zmdi zmdi-refresh"></i> Editar</a> </td>';
	    		echo '<td> <a data-toggle="modal" href="#del' . $carnet . '" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i> Eliminar</a> </td>';
	    		echo "</tr>";


	    		include ('./modalesT.php');
			}
		}catch(PDOExceptio $e){
			echo "Error: " . $e->getMessage();
		}
		
		?>