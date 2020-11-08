<?php
	if (!isset($_SESSION['loggedin'])) {
		header("location: logout.php");
	}
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
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/avatar.png" alt="UserIcon">
					<figcaption class="text-center text-titles"><?= $_SESSION['nombre'] ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>

			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="usuarios.php"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Alumnos</a>
						</li>
						<li>
							<a href="candidatos.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Candidatos</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-plus-circle-o-duplicate zmdi-hc-fw"></i> Extra <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="puestos.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Puestos</a>
						</li>
						<li>
							<a href="tipos.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Tipos de Usuario</a>
						</li>
						<li>
							<a href="reinicio.php"><i class="zmdi zmdi-refresh zmdi-hc-fw"></i> Reiniciar votación</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Votación <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="resultados.php"><i class="zmdi zmdi-share zmdi-hc-fw"></i> Resultados</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>