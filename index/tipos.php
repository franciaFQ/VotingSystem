<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Tipos de Usuarios</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<!-- Datatables -->
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
		$verT = true;
	?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>Tipos de Usuarios<small>Administracion</small></h1>
			</div>
			<p class="lead">Tipos de usuarios</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo</a></li>
					  	<li><a href="#list" data-toggle="tab">Lista </a></li>
					  	</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form id="frmajax" method="POST" action="">
											<div class="form-group label-floating">
											  <label class="control-label">Nombre de Tipos de Usuarios</label>
											  <input class="form-control" type="text" id="nombreT" name="nombreT">
											</div>
										
										    <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
										    </p>
									    </form>
									    <?php
							if(isset($_POST['nombreT'])){
								require_once "./procesos/insertartipos.php";
							}
							?>
									</div>
								</div>
							</div>
						</div>

					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center" id="listTi">
									<thead>
										<tr>
											<th class="text-center">Codigo</th>
											<th class="text-center">Nombre de Tipos de Usuarios</th>
											<th class="text-center">Actualizar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>				
									<tbody>
										<?php
											try{
												$getType = $conn->prepare("SELECT codigo_tipo, nombre_tipo FROM tipos");
												$getType->execute();
												$type = $getType->fetchAll();
												$veri = true;
												foreach ($type as $type) {
													echo "<tr>";
										    		echo '<td> '.$type['codigo_tipo'] . ' </td>';
										    		echo '<td> '.$type['nombre_tipo'] . ' </td>';
										    		
										    		echo '<td><a class="btn btn-success btn-raised btn-xs" data-toggle="modal" href="#edit' . $type['codigo_tipo'] . '"><i class="zmdi zmdi-refresh"></i> Editar</a> </td>';
	    											echo '<td> <a class="btn btn-danger btn-raised btn-xs" data-toggle="modal" href="#del' . $type['codigo_tipo'] . '"><i class="zmdi zmdi-delete"></i> Eliminar</a> </td>';
										    		echo "</tr>";

										    		include 'buttonT.php';
												}
											}catch(PDOExceptio $e){
												echo "Error: " . $e->getMessage();
											}
											
										?>
									</tbody>
								</table>
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
        $('#listTi').DataTable();
    });      
    </script>

    <style type="text/css">
   		.modal-backdrop {
        	display: none;
   		}
	</style>
</body>
</html>