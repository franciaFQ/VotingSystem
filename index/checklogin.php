<?php
	session_start();

	include 'conexion.php';

	$carnet = "";
	$contra = "";

if (isset($_POST['carnet']) && isset($_POST['contra'])) {
	$carnet = $_POST['carnet'];
	$contra = $_POST['contra'];
}else{
	header('Location: logout.php');
}

if ($carnet == null || $contra == null)
{
    echo "<span class='text-center text-muted' style='color: yellow;'>Por favor, complete todos los campos.</span>";
}
else
{
	$consulta=$conn->query("SET NAMES 'utf8'");
	$consulta=$conn->prepare("select * from usuarios where carnet = ? and contrasena=?");
	$consulta->bindParam(1,$carnet);
	$consulta->bindParam(2,$contra);	

	try{
		if($consulta->execute()){
			$datos = $consulta->fetchAll();

			if ($datos==null) {
				echo "<span class='text-center text-muted' style='color: yellow;'>Usuario o contraseña incorrecto</span>";
				exit();
			}

			if ($datos[0][2] == "Votado" || $datos[0][2] == "votado" ) {
				echo "<span class='text-center text-muted' style='color: yellow;'>Ya votaste!!!</span>";
				exit();
			}
			//	var_dump($datos); echo "<br/>";
			/*		echo "Carnet " . $datos[0][0];echo "<br/>";
					echo "Nombre " . $datos[0][1];echo "<br/>";
					echo "Estado " . $datos[0][2];echo "<br/>";
					echo "Turno " . $datos[0][3][1];echo "<br/>";
					echo "Contraseña " . $datos[0][4];echo "<br/>";
					echo "Codigo tipo " . $datos[0][5];echo "<br/>";
			*/
			$tipo = $datos[0][5];

			$_SESSION['loggedin'] = true;
			$_SESSION['nombre'] = $datos[0][1];
			$_SESSION['carnet'] = $datos[0][0];
			$_SESSION['turno'] = $datos[0][3][1];
			$_SESSION['tipo'] = $tipo;
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (10 * 30) ;

		    switch ($tipo) {
		    	case '1':
		    	echo "<script>location.href = './votacion.php'</script>";
		    		//header('Location: votacion.php');
		    		break;
		    	case '2':
		    	echo "<script>location.href = './home.php'</script>";
		    		//header('Location: home.php');
		    		break;
		    	case '3':
		    	echo "<script>location.href = './home.php'</script>";
		    		//header('Location: home.php');
		    		break;
		    	default:
		    		echo "<span class='text-center text-muted' style='color: yellow;'>Error no se pudo iniciar sesión</span>";
		    		//header('Location: index.php');
		    		break;
		    }
		    
		}else{
			echo "<span class='text-center text-muted' style='color: yellow;'>Error no se pudo iniciar sesión</span>";
			//header('Location: index.php');
		}

		$conn=null;

	}catch(PDOExceptio $e){
		header('Location: logout.php');
	}
}
?>