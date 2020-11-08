<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Teachers</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
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
    }else{
    	echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Necesitas iniciar sesión para ver el contenido.</h4>
        <h4>O no tienes los privilegios de ver el contenido.</h4>
        <p><a href='logout.php'>Inicia Sesión aquí!</a></p></div>";
        exit;
    }
		include 'conexion.php';
		$verI = true;

	?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Teachers <small>Registro</small></h1>
			</div>
			
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

									    <form  id="frmajax" method="POST" action="">
									    	<div class="form-group label-floating">
											  <label class="control-label">Carnet</label>
											  <input class="form-control" type="text" name="carnet" required="">
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Nombre</label>
											  <input class="form-control" type="text" name="nombre" required="">
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Contraseña</label>
											  <input class="form-control" type="text" name="contra" required="" type="password">
											</div>
											
										    <p class="text-center">
										    	<button class="btn btn-info btn-raised btn-sm" id="agregar"><i class="zmdi zmdi-floppy"></i> Guardar</button>
										    </p>
	
									    </form>

									    <?php

							if(isset($_POST['carnet']) && isset($_POST['nombre'])){
								require_once "./procesos/insertarteacher.php";
							}
							?>
									</div>
								</div>
							</div>
						</div>


					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center" id="teacherList">
									<thead>
										<tr>
											<th class="text-center">Carnet</th>
											<th class="text-center">Nombre</th>
											<th class="text-center">Contraseña</th>
											
											<th class="text-center">Editar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
							<tbody>
							 <?php
							
							require_once "./procesos/listarteacher.php";
							
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
        $('#teacherList').DataTable();
    });      
    </script>
    <style type="text/css">
   	.modal-backdrop {
        display: none;
   	}
   
</style>
</body>
</html>