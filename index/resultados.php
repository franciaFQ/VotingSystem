<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Resultados</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

			if (isset($_GET["dato"])) {
				$turno  = $_GET["dato"];
				if ($turno=="M") {
					$titulo= "Resultados Matutino";
				}else{
					$titulo="Resultados Tarde";
				}
			}else{
				$turno = 'M';
				$titulo= "Resultados Matutino";
			}
		
	?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Resultados <small>votación</small></h1>
			</div>
			<p class="lead">Graficas de los resultados!</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
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
	                    echo "<li class='active'><a href='#" . $nPuesto . "' data-toggle='tab'>" . $nPuesto . "</a></li>";
	                  }else{
	                    echo "<li><a href='#" . $nPuesto . "' data-toggle='tab'>" . $nPuesto . "</a></li>";
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
	            foreach ($puestos as $puesto) {
	            	$nPuesto = $puesto['nombre_puesto'];

	              	if ($una <= 1) {
	                	echo "<div class='tab-pane fade active in' id='" . $nPuesto . "'>
	                    	<div class='container-fluid'>
		                      	<div class='row'>
		                        	<div class='col-xs-12 col-md-10 col-md-offset-1'>
			                        	<select class='custom-select'>
			                        		<option selected>Elija un turno...</option>
										    <option value='M'>Matutino</option>
										    <option value='T'>Tarde</option>
										</select>
										<h2>$titulo de $nPuesto</h2>
		                        	<div id='piechart" . $nPuesto . "''></div>";
		                $una++;
		            }else{
		                echo "<div class='tab-pane fade' id='" . $nPuesto . "'>
		                <select class='custom-select'>
			                        		<option selected>Elija un turno...</option>
										    <option value='M'>Matutino</option>
										    <option value='T'>Tarde</option>
										</select>
										<h2>$titulo de $nPuesto</h2>
		                <div id='piechart" . $nPuesto . "''></div>";
		            }
			?>

<script type="text/javascript">
// Load google charts

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {

	var data = google.visualization.arrayToDataTable([
	['Candidato', 'Votos'],

	<?php
		$consulta=$conn->query("SET NAMES 'utf8'");
		$consulta=$conn->query("select u.carnet, u.nombre, count(v.codigo_candidato) as total from votos v
			join usuarios u on u.carnet = v.codigo_candidato
			join candidatos c on c.codigo_candidato = u.carnet
			join puestos p on c.codigo_puesto = p.codigo_puesto
			where p.nombre_puesto = '$nPuesto' AND u.turno LIKE '%$turno' group by v.codigo_candidato");
		
		while ($row = $consulta->fetch()) {
	    	echo "['" . $row['nombre']."',". $row['total'] ."],";
		}
	?>
	]);
  

	// Optional; add a title and set the width and height of the chart
	var options = {'title':'Resultados de votación <?= $nPuesto?>', tooltip: { trigger: 'none' }, 'width':700, 'height':600};

	// Display the chart inside the <div> element with id="piechart"
	var chart = new google.visualization.PieChart(document.getElementById('piechart<?= $nPuesto?>'));

	var btnSave = document.getElementById('save-pdf');

	google.visualization.events.addListener(chart, 'ready', function () {
	    btnSave.disabled = false;
	});

  btnSave.addEventListener('click', function () {
    var doc = new jsPDF();
    doc.addImage(chart.getImageURI(), 0, 0);
    doc.save('resultados.pdf');
  	}, false);
	
	chart.draw(data, options);

}
</script>

			<?php
					if ($uno <= 1) {
		                  echo "<input class='btn btn-info btn-raised' id='save-pdf' type='button' value='Guardar como PDF' disabled />
		                  <br/><br/></div></div></div></div>";
		                  $uno++;
		            }else{
		                echo "</div>";
		            }
	            }//Cierre foreach ($puestos as $puesto) {
            ?>

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();

		$('select').on('change', function() {
			var turno = this.value;
			window.location.href = "resultados.php?dato=" + turno;			
		});

	</script>
	<style type="text/css">
   	.modal-backdrop {
        display: none;
   	}
</body>
</html>