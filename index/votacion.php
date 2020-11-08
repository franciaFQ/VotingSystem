<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Votacion | Supérate</title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
  <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['tipo']==1) {
      $turno = $_SESSION['turno'];
    }
    else {
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Necesitas iniciar sesión para ver el contenido.</h4>
        <h4>O no tienes los privilegios de ver el contenido.</h4>
        <p><a href='logout.php'>Inicia Sesión aquí!</a></p></div>";
        exit;
    }

    include 'conexion.php';
  ?>

	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Supérate Raíces <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo" >
				<figure class="full-box">
					<img src="./assets/img/avatar.png" alt="UserIcon">
					<figcaption class="text-center text-titles"><?= $_SESSION['nombre'] ?></figcaption>
				</figure>
			</div>
			
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage" />
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar" style="background-color: #06D5B5;">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left"></li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header" style="position: relative; text-align: center;">
			  <h1 class="text-titles">Bienvenido</h1>
			  <h4><b>Indicaciones:</b></h4> 
			  	<li>Dar click en el Boton <b>Votar</b> en la parte inferior del candidato por el cual desea votar.</li>
				<li>Una vez Seleccionado los Candidatos a tu Eleccion Proceder a dar click en el boton de abajo con el nombre de <b>Finalizar Votacion</b></li>
				<li style="color: red;"><b>Ojo</b> Debes de Seleccionar todos los candidatos de cada puesto para finalizar el proceso</li>
			</div>
		</div>
		<div class="full-box text-center" style="padding: 30px 10px;">


  <div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px; background-color: #1ED605;">
          <?php
            try{
                $getPuesto = $conn->prepare("select * from puestos");
                $getPuesto->execute();
                $puestos = $getPuesto->fetchAll();
                $vez = 1;
                foreach ($puestos as $puesto) {
                  $nPuesto = $puesto['nombre_puesto'];

                  if ($vez <= 1) {
                    $vez++;
                    echo "<li class='active'><a href='#' data-toggle='tab'>" . $nPuesto . "</a></li>";
                  }else{
                    echo "<li><a href='#' data-toggle='tab'>" . $nPuesto . "</a></li>";
                  }
                }
                $getPuesto=null;
            }catch(PDOExceptio $e){
                echo "Error: " . $e->getMessage();
            }

            echo "
            </ul><div id='myTabContent' class='tab-content'>";
            $una = 1;
            $uno = 1;
            $l = 1;
            foreach ($puestos as $puesto) {
              $getCandis = null;

                
              $cierre = "";
              $nPuesto = $puesto['nombre_puesto'];

              if ($una <= 1) {
                echo "<div class='tab-pane fade active in' id='" . $nPuesto . "'>
                    <div class='container-fluid'>
                      <p><h2>Candidatos para el puesto de " . $nPuesto . "</h2></p>
                      <div class='row'>
                        <div class='col-xs-12 col-md-12'>
                            <div class='col-xs-12 col-md-12'><br><br>";
                $una++;
              }else{
                echo "<div class='tab-pane fade' id='" . $nPuesto . "'>
                <p><h2>Candidatos para el puesto de " . $nPuesto . "</h2></p>
                    <div class='container' style='position: relative; left: 100px;'><br>
                    <br>";
              }

              try{
                $getCandis=$conn->query("SET NAMES 'utf8'");
                $getCandis = $conn->prepare("SELECT c.codigo_candidato as carnet, u.nombre as nombre, p.nombre_puesto as puesto, c.imagen, u.turno FROM usuarios u inner join candidatos c on u.carnet = c.codigo_candidato inner join puestos p on p.codigo_puesto = c.codigo_puesto where p.nombre_puesto = '$nPuesto' AND u.turno LIKE '%$turno'");
                $getCandis->execute();
                $candis = $getCandis->fetchAll();

                if (isset($puestos[$l][1])) {
                  $getCandisA=$conn->query("SET NAMES 'utf8'");
                  $getCandisA = $conn->prepare("SELECT c.codigo_candidato as carnet, u.nombre as nombre, p.nombre_puesto as puesto, c.imagen, u.turno FROM usuarios u inner join candidatos c on u.carnet = c.codigo_candidato inner join puestos p on p.codigo_puesto = c.codigo_puesto where p.nombre_puesto = '".$puestos[$l][1]."' AND u.turno LIKE '%$turno'");
                  $getCandisA->execute();
                  $candisA = $getCandisA->fetchAll();
                  if(empty($candisA)){
                    $candisA = false;
                  }else{
                    $candisA = true;
                  }
                }else{
                    $candisA = false;
                }
                
                foreach ($candis as $candi) {
                  $cierre .= "</div>";
                  echo "<div class='row'>
                    <div class='col-xs-6 col-md-3'>
                      <div class='thumbnail'>
                        <a href='#' class='thumbnail'>
                          <img src=".$candi["imagen"]." alt='...' style=' width: 270px; height: 230px;'>
                        </a>
                        <div class='caption '>
                          <h3>".$candi["nombre"]."</h3>
                          <p>".$candi["carnet"]." </p>
                          <form action='return false' onsubmit='return false'>
                          <input type='hidden' value='".$candi["carnet"]."' id='".$candi["carnet"]."' name='carnet'>
                          <input type='hidden' value='".$nPuesto."' id='puestoF' name='puestoF'>";
                          if ($candisA) {
                            echo "<input type='hidden' value='".$puestos[$l][1]."' id='puestoD' name='puestoD'>
                            <p><button class='btn btn-raised btn-danger' onclick=\"votar(document.getElementById('".$candi["carnet"]."').value,document.getElementById('puestoF').value,document.getElementById('puestoD').value);\">Votar</button></p>";
                          }else{
                            echo "<p>
                              <button href='#' class='btn-exit-systemA btn-success' style='height: 50px; width: 200px;' onclick=\"finalizarVotar(document.getElementById('".$candi["carnet"]."').value,document.getElementById('puestoF').value);\">Finalizar Votacion</button></p>";
                          }
                          echo "
                          </form>
                        </div>
                      </div>
                    </div>";
                }

                echo $cierre;

                if ($uno <= 1) {
                  echo "</div></div></div></div></div>";
                  $uno++;
                }else{
                  echo "</div></div>";
                } 

                echo "<!--=======================Corte==============================-->

                    ";
              }catch(PDOExceptio $e){
                 echo "Error: " . $e->getMessage();
              }

              $l++;
            }
        $conn=null;
      ?> 	
					

<!--======FIN Secretarias-->


	</div>
  </div></div></div>
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

    function votar(carnet, puesto, despues)
        {
          var direc='#'+puesto;
            $.ajax({
                url: "./votar.php",
                type: "POST",
                data: "carnet="+carnet+"&desp="+despues,
                success: function(resp){
                $(direc).html(resp)
                }
            });
        }
    function finalizarVotar(carnet, puesto)
        {
          var direc='#'+puesto;
            $.ajax({
                url: "./votar.php",
                type: "POST",
                data: "carnet="+carnet+"&fin=true",
                success: function(resp){
                $(direc).html(resp)
                }
            });
        } 
	</script>
</body>
</html>