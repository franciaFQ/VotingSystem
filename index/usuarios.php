<?php 
session_start();
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<link rel="stylesheet" href="./css/main.css">

	<!-- Datatables -->
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
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Alumnos <small>Administración</small></h1>
			</div>
			<p class="lead">Ingreso de Alumnos y su edición.</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Agregar</a></li>
					  	<li><a href="#list" data-toggle="tab">Listar</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form action="return false" onsubmit="return false" id="formulario">
											<div class="form-group">
										      <label class="control-label">Lista de Alumnos CSV: </label>
										      <div>
										        <input type="text" readonly="" class="form-control" placeholder="Browse...">
										        <input type="file" accept=".csv" id="archivos" required="true">
										      </div>
										    </div>
										    <p class="text-center">
										    	<button class="btn btn-info btn-raised btn-sm" id="enviar"><i class="zmdi zmdi-floppy"></i> Guardar</button>
										    </p>
									    <div id="respuestaD">
									    	
									    </div>
									    </form>
									</div>
								</div>
							</div>
						</div>

					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center display" id="usuariosT">
									<thead>
										<tr>
											<th class="text-center">Carnet</th>
											<th class="text-center">Nombre</th>
											<th class="text-center">Estado</th>
											<th class="text-center">Turno</th>
											<th class="text-center">Editar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
		<?php
		try{
			$getUsers = $conn->query("SET NAMES 'utf8'");
			$getUsers = $conn->prepare("SELECT u.carnet, u.nombre, u.estado, u.turno FROM usuarios u where u.codigo_tipo = 1");
			$getUsers->execute();
			$users = $getUsers->fetchAll();
			$veri = true;
			foreach ($users as $user) {
				$code = $user['carnet'];
				$nameC = $user['nombre'];
				echo "<tr>";
	    		echo '<td> '. $code . ' </td>';
	    		echo '<td> '. $nameC . ' </td>';
	    		echo '<td> '. $user['estado'] . ' </td>';
	    		echo '<td> '. $user['turno'] . ' </td>';
	    		echo '<td><a class="btn btn-success btn-raised btn-xs" data-toggle="modal" href="#edit' . $code . '"><i class="zmdi zmdi-refresh"></i> Editar</a> </td>';
	    		echo '<td> <a class="btn btn-danger btn-raised btn-xs" data-toggle="modal" href="#del' . $code . '"><i class="zmdi zmdi-delete"></i> Eliminar</a> </td>';
	    		echo "</tr>";
	    		include ('button.php');
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
		//Iniciamos nuestra función jquery.
$(function(){
	$('#enviar').click(SubirAlumnos); //Capturamos el evento click sobre el boton con el id=enviar	y ejecutamos la función seleccionado.
});


function SubirAlumnos(){	
		var archivos = document.getElementById("archivos");//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
		var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
		//Creamos una instancia del Objeto FormDara.
		var archivos = new FormData();
		/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
		Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
		indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
		for(i=0; i<archivo.length; i++){
			archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
		}

		/*Ejecutamos la función ajax de jQuery*/		
		$.ajax({
			url:'./file/subir.php', //Url a donde la enviaremos
			type:'POST', //Metodo que usaremos
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			data:archivos, //Le pasamos el objeto que creamos con los archivos
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache:false //Para que el formulario no guarde cache
		}).done(function(resp) {
			$("#respuestaD").html(resp);
		});
	}
	</script> <!-- Integramos nuestro script que contendra nuestras funciones Javascript-->

	<script>
		$.material.init();
	</script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script>
     $(document).ready( function () {
        $('#usuariosT').DataTable();
    });
    </script>

    <style type="text/css">
   	.modal-backdrop {
        display: none;
   	}
   
</style>
</body>
</html>