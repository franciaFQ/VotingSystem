<!DOCTYPE html>
<html lang="es">
<head>
	<title>Supérate Raíces </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<style type="text/css">
		#login{
			background-image: url("./assets/img/walkextrax.jpg");
			background-repeat: round;
		}
	</style>
</head>
<body class="cover" id="login">
	<form action="return false" onsubmit="return false" method="post" autocomplete="off" class="full-box logInForm">
		<p class="text-center text-muted" style="color: white;"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase" style="color: white;">Inicia sesión con tu cuenta</p>
		<div id="resultado"></div>
		<div class="form-group label-floating">
		  <label class="control-label" for="carnet">Carnet</label>
		  <input class="form-control" id="carnet" name="carnet" type="text">
		  <p class="help-block">Escribe tú carnet</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="contra">Contraseña</label>
		  <input class="form-control" id="contra" name="contra" type="password">
		  <p class="help-block">Escribe tú contraseña</p>
		</div>
		<div class="form-group text-center">
			<p><button class="btn btn-raised btn-danger" onclick="Validar(document.getElementById('carnet').value, document.getElementById('contra').value);">Accesar</button></p>
			<!-- <input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger"> -->
		</div>
	</form>
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();

		function Validar(user, pass)
        {
            $.ajax({
                url: "./checklogin.php",
                type: "POST",
                data: "carnet="+user+"&contra="+pass,
                success: function(resp){
                	$('#resultado').html(resp)
                }
            });
        }
	</script>
</body>
</html>