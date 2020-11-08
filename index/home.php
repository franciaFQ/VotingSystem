<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
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
			  <h1 class="text-titles">Inicio</h1>
			</div>
		</div>
		<div class="full-box text-center" style="padding: 30px 10px;">
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Administrador
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-account"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?= $countJefe ?></p>
					<small>Registrados</small>
				</div>
			</article>
			<article class="full-box tile">
				<div class="full-box tile-title text-center text-titles text-uppercase">
					Teacher
				</div>
				<div class="full-box tile-icon text-center">
					<i class="zmdi zmdi-male-alt"></i>
				</div>
				<div class="full-box tile-number text-titles">
					<p class="full-box"><?= $countAdmin ?></p>
					<small>Registrados</small>
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
					<p class="full-box"><?= $countAlum ?></p>
					<small>Registrados</small>
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
					<p class="full-box"><?= $countCandi ?></p>
					<small>Registrados</small>
				</div>
			</article>
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
</body>
</html>