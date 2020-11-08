<?php
	include 'conexion.php';
	
	$accion = $_POST['accCand'];
    
	try{
	switch ($accion) {
		case 'del':
            $id = $_POST['idDCand'];
            $sqlop = $conn->query("SET NAMES 'utf8'");
            $sqlop = $conn->prepare("SELECT imagen from candidatos where codigo_candidato ='".$id."'");
            $sqlop->execute();
            $resultado = $sqlop->fetchAll();
            
            unlink($resultado[0][0]);
            
			$delete = $conn->query("SET NAMES 'utf8'");
			$delete = $conn->prepare("delete from candidatos where codigo_candidato='". $id ."'");
			$resultD = $delete->execute();
			//$conn->null;
            
            $sqlop->closeCursor();
                                        
			header('location:candidatos.php');
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