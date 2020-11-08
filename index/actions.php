<?php
	include 'conexion.php';
	
	$accion = $_POST['acc'];

	try{
	switch ($accion) {
		case 'del':
			$id = $_POST['idD'];
			$delete = $conn->prepare("delete from usuarios where carnet='". $id ."'");
			$resultD = $delete->execute();
			$conn->null;
			header('location:usuarios.php');
			break;

		case 'edit':			
			$estadoE = $_POST['estadoe'];
			$turnoE = $_POST['turnoe'];
			$nameE = $_POST['namee'];
			$idE = $_POST['idE'];
			$sql = "update usuarios set nombre='".$nameE."', estado='".$estadoE."', turno='".$turnoE."' where (carnet='".$idE."')";
			$edit = $conn->prepare($sql);
			$resultE = $edit->execute();
			$conn->null;
			header('location:usuarios.php');
			break;
//Puestos
		case 'puestedit':
		$codigo = $_POST['idE'];
		$puesto = $_POST['namee'];
		$sql = "update puestos set nombre_puesto='".$puesto."' where (codigo_puesto='".$codigo."')";
		$edit = $conn->prepare($sql);
			$resultEp = $edit->execute();
			$conn->null;
			header('location:puestos.php');
			break;

		case 'puestadd':
		$puesto = $_POST['puesto'];
		$sql = "INSERT INTO puestos ( nombre_puesto) VALUES ('$puesto')";
		$add = $conn->prepare($sql);
			$resultEp = $add->execute();
			$conn->null;
			header('location:puestos.php');
			break;

		case 'puestdel':
		$codigo = $_POST['idD'];
		$sql = "Delete from puestos where (codigo_puesto = '$codigo')";
		$del = $conn->prepare($sql);
			$resultEp = $del->execute();
			$conn->null;
			header('location:puestos.php');
			break;	
//Tipos
		case 'tiposdel':
		$codigo_tipo = $_POST['idD'];
		$consulta=$conn->prepare("delete from tipos where (codigo_tipo = ?)");
		$consulta->bindParam(1,$codigo_tipo);
		$resultEp = $consulta->execute();
			$conn->null;
			header('location:tipos.php');
			break;
		
		case 'tiposedit':
		$codigo = $_POST['idE'];
		$nombre = $_POST['namee'];

		$sql = "UPDATE tipos SET nombre_tipo = ? WHERE (codigo_tipo = ?)";
		$del = $conn->prepare($sql);
		$del->bindParam(1,$nombre);
		$del->bindParam(2,$codigo);
			$resultEp = $del->execute();
			$conn->null;
			header('location:tipos.php');
			break;

		case 'allV':
			$sql = "delete from votos where codigo_candidato = codigo_candidato";
			$edit = $conn->prepare($sql);
			if ($edit->execute()>0) {
				echo "Ocurrio un error";
			}
			$conn->null;
			header('location:reinicio.php');
			break;
		case 'allC':
			$sql = "delete from candidatos where codigo_candidato = codigo_candidato";
			$edit = $conn->prepare($sql);
			if ($edit->execute()>0) {
				echo "Ocurrio un error";
			}
			$conn->null;
			header('location:reinicio.php');
			break;
		case 'all':
			$sql = "delete from usuarios where codigo_tipo = 1";
			$edit = $conn->prepare($sql);
			if ($edit->execute()>0) {
				echo "Ocurrio un error";
			}
			$conn->null;
			header('location:reinicio.php');
			break;		
		default:
			header('location:logout.php');
			break;
	}
}catch(Exception $e){
	echo "No se pudo completar la operación revise las refencias de candidatos.";
	echo "Regresar <a href='./candidatos.php'>Aquí</a>";
}
?>