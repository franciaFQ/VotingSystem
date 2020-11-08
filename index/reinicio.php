<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Reinicio</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<link rel="stylesheet" href="./css/main.css">
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

		try{
			$getRes = $conn->prepare("select count(carnet) as est, (SELECT count(carnet) FROM usuarios WHERE codigo_tipo = 2 ) AS admin, (SELECT count(carnet) FROM usuarios WHERE codigo_tipo = 3 ) AS jefe, (SELECT count(codigo_candidato) FROM candidatos ) AS candi from usuarios where codigo_tipo = 1");
			$getRes->execute();
			$res = $getRes->fetchAll();

			foreach ($res as $col) {
	    		$countAlum = $col['est'];
	    		$countAdmin = $col['admin'];
	    		$countJefe = $col['jefe'];
	    		$countCandi = $col['candi'];
			}
		}catch(PDOExceptio $e){
			echo "Error: " . $e->getMessage();
		}
	?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles">Reinicio</h1>
			</div>
		</div>
		<div class="full-box text-center" style="padding: 30px 10px;">
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Votos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-account"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><a class="btn btn-warning btn-raised btn-xs" data-toggle="modal" href="#delallV"><i class="zmdi zmdi-delele"></i> Eliminar a todos</a></p>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Candidatos
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-male-female"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><a class="btn btn-warning btn-raised btn-xs" data-toggle="modal" href="#delallC"><i class="zmdi zmdi-delele"></i> Eliminar a todos</a></p>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Estudiantes
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-face"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><a class="btn btn-warning btn-raised btn-xs" data-toggle="modal" href="#delall"><i class="zmdi zmdi-delele"></i> Eliminar a todos</a></p>
				</div>
			</article>
		</div>
	</section>
<!-- Delete all votos-->
    <div class="modal fade" id="delallV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar todos los Votos</h4></center>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center><strong>En realidad desea eliminar todos los votos?</strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <form method="POST" action="actions.php">
                        <input type="hidden" name="acc" id="acc" value="allV">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->	
<!-- Delete all candidatos-->
    <div class="modal fade" id="delallC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar todos los Candidatos</h4></center>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center><strong>En realidad desea eliminar a todos los candidatos?</strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <form method="POST" action="actions.php">
                        <input type="hidden" name="acc" id="acc" value="allC">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->
<!-- Delete all alumnos-->
    <div class="modal fade" id="delall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar todos los Estudiantes</h4></center>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center><strong>En realidad desea eliminar a todos los estudiantes?</strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <form method="POST" action="actions.php">
                        <input type="hidden" name="acc" id="acc" value="all">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->
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
</body>
</html>