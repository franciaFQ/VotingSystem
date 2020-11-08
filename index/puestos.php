<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Puesto</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
</head>
<body>
	<!-- SideBar -->
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
			  <h1 class="text-titles"><i class="zmdi zmdi-font zmdi-hc-fw"></i>Puestos de Usuarios<small>Administración</small></h1>
			</div>
			<p class="lead">Puestos Asignados:</p>
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
									    <form action="actions.php" method="POST">
									    	<div class="form-group label-floating">
											  <label class="control-label">Nombre de Puesto</label>
											  <input id="puesto" name="puesto" class="form-control" type="text">
											</div>
											<input type="hidden" name="acc" id="acc" value="puestadd">
										    
										    <p class="text-center">
										    	<input type="submit" class="btn btn-info btn-raised btn-sm" value="Agregar">
										    </p>
									    </form>
									</div>
								</div>
							</div>
						</div>

					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center" id="listPu">
									<thead>
										<tr>
											<th class="text-center">Codigo</th>
											<th class="text-center">Nombre de Puesto</th>
											<th class="text-center">Actualizar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>

<?php
		try{
			$getMark = $conn->prepare("SELECT * FROM puestos");
			$getMark->execute();
			$mark = $getMark->fetchAll();
			$veri = true;
			foreach ($mark as $mark) {
				echo "<tr>";
	    		echo '<td> '.$mark['codigo_puesto'] . ' </td>';
	    		echo '<td> '.$mark['nombre_puesto'] . ' </td>';
	    		
	    		echo '<td><a class="btn btn-success btn-raised btn-xs" data-toggle="modal" href="#edit' . $mark['codigo_puesto'] . '"><i class="zmdi zmdi-refresh"></i> Editar</a> </td>';
	    		echo '<td> <a class="btn btn-danger btn-raised btn-xs" data-toggle="modal" href="#del' . $mark['codigo_puesto'] . '"><i class="zmdi zmdi-delete"></i> Eliminar</a> </td>';
	    		echo "</tr>";

	    		include 'buttonP.php';
			}
		}catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		
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

		$(document).ready( function () {
		    $('#listPu').DataTable();
		} );
	</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	<style type="text/css">
   	.modal-backdrop {
        display: none;
   	}
   
</style>
</body>
</html>