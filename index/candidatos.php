<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Candidatos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<link rel="stylesheet" href="./css/main.css">
	<!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <style type="text/css">
    	#hideMe {
		    -webkit-animation: cssAnimation 4s forwards; 
		    animation: cssAnimation 4s forwards;
		    border-radius: 4px;
		}
		@keyframes cssAnimation {
		    0%   {opacity: 1;}
		    90%  {opacity: 1;}
		    100% {opacity: 0;}
		}
		@-webkit-keyframes cssAnimation {
		    0%   {opacity: 1;}
		    90%  {opacity: 1;}
		    100% {opacity: 0;}
		}
    </style>
</head>
<body>
	<?php
		if (isset($_SESSION['loggedin'])) {
    }
    else {
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Necesitas iniciar sesión para ver el contenido.</h4>
        <h4>O no tienes los privilegios de ver el contenido.</h4>
        <p><a href='logout.php'>Inicia Sesión aquí!</a></p></div>";
        exit;
    }

    if ($_SESSION['tipo']==3) {
    	include 'navbar.php';
    }elseif ($_SESSION['tipo']==2) {
    	include 'navbarT.php';
    }else{
    	echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Necesitas iniciar sesión para ver el contenido.</h4>
        <h4>O no tienes los privilegios de ver el contenido.</h4>
        <p><a href='logout.php'>Inicia Sesión aquí!</a></p></div>";
        exit;
    }
        include 'conexion.php';
	?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Candidatos <small>Agregar</small></h1>
			</div>
			<p class="lead"></p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form action="candidatosAgregar.php" enctype="multipart/form-data" method="post">
									    
									    <div class="form-group">
										      <label class="control-label">Carnet</label>
										      <div>
										        
                                          <select name="carne" class="form-control">      
                                           <?php
                                            $sql = $conn->query("SET NAMES 'utf8'");
                                            $sql = $conn->prepare('SELECT * FROM usuarios u where u.carnet NOT IN (select codigo_candidato from candidatos)AND u.codigo_tipo = 1');
                                            $sql->execute();
                                            $resultado = $sql->fetchAll();
                                            
                                            foreach ($resultado as $row) {
                                            echo '<option value='.$row["carnet"].'>';
                                            echo $row["nombre"]." ---------- ".$row["carnet"]." "."(".$row["turno"].")"."</option>";
                                            }
                                           
                                            $sql->closeCursor();
                                        ?>
										        </select>
										      </div>
										    </div>
									    
									    <label class="control-label">Puesto</label> <br>
									    <select name="cargo1" class="form-control">
									   
									    <?php
                                            $sql = $conn->query("SET NAMES 'utf8'");
                                            $sql = $conn->prepare('SELECT * FROM puestos');
                                            $sql->execute();
                                            $resultado = $sql->fetchAll();
                                            
                                            foreach ($resultado as $row) {
                                            echo '<option value='.$row["codigo_puesto"].'>';
                                                
                                                echo $row["nombre_puesto"]."</option>";
                                            }
                                           
                                            $sql->closeCursor();
                                        ?>
                                        </select>
									    	
										    <div class="form-group">
										      <label class="control-label">Foto</label>
										      <div>
										        <input type="text" readonly="" class="form-control" placeholder="Seleccione una imagen">
										        <input type="file" accept="image/* " name="foto" required="true">
										      </div>
										    </div>										   
                                            
										    <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised btn-sm" type="submit" value="Send File"><i class="zmdi zmdi-floppy"></i> Agregar candidato</button>
										    </p>
									    </form>
									    <?php
										    	if (isset($_GET['e'])) {
										    		echo "<div class='alert alert-danger' role='alert' id='hideMe'>Para coordinador y/o sub-coordinador debe ser de 3er o 2do año</div>";
										    	}
										    ?>
										</br></br></br>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center" id="listCan">
									<thead>
										<tr>
											<th class="text-center">Carnet</th>
											<th class="text-center">Nombre</th>
											<th class="text-center">Puesto</th>
											<th class="text-center">Turno</th>
											<th class="text-center">Imagen</th>
											
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>

<?php
		try{
			$url = "localhost:8081/Alexis/votacion/adp/";
            $getCandis = $conn->query("SET NAMES 'utf8'");
			$getCandis = $conn->prepare("SELECT c.codigo_candidato as carnet, u.nombre as nombre, p.nombre_puesto as puesto, u.turno, c.imagen FROM usuarios u inner join candidatos c on u.carnet = c.codigo_candidato inner join puestos p on p.codigo_puesto = c.codigo_puesto");
			$getCandis->execute();
			$candis = $getCandis->fetchAll();
			$veri = true;
			foreach ($candis as $candi) {
                
				echo "<tr>";
	    		echo '<td> '.$candi['carnet'] . ' </td>';
	    		echo '<td> '.$candi['nombre'] . ' </td>';
	    		echo '<td> '.$candi['puesto'] . ' </td>';
	    		echo '<td> '.$candi['turno'] . ' </td>';
	    		echo "<td><img alt=\"Candidato\" height=\"100\" width=\"100\" src=".$candi["imagen"]." /></td>";
                echo '<td> <a class="btn btn-danger btn-raised btn-xs" data-toggle="modal" href="#del' . $candi['carnet'] . '"><i class="zmdi zmdi-delete"></i> Eliminar</a> </td>';
                
	    		echo "</tr>";
	    		include ('borrarCandiBoton.php');
	    		}
		}catch(PDOExceptio $e){
			echo "Error: " . $e->getMessage();
		}

		$conn=null;
		
?>
										
									</tbody>
								</table>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--====== Scripts -->
	
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
	
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script>
     $(document).ready( function () {
        $('#listCan').DataTable();
    });      
    </script>
	
	<style type="text/css">
   	.modal-backdrop {
        display: none;
   	}
   
</style>
</body>
</html>