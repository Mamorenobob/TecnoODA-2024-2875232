<?php
  session_start();

	require '../View/cortina.php';
    require '../Controller/conexion.php';
    $db = new Database();
    $conexion = $db->conectar();

    // Verificar si el usuario no está autenticado
    if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 9)) {
        echo "<script>
                alert('No puedes acceder aquí. Debes iniciar sesión.');
                window.location = 'index.php';
              </script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tecno ODA</title>
		<link rel="icon" href="logo.png">
		<link rel="stylesheet" href="../Model/Css/CSS_Admin.css" />
	</head>
	<body>
		<header>
			<div class="container-hero">
				<div class="container hero">
					<div class="customer-support">
						<i class="fa-solid fa-headset"></i>
						<div class="content-customer-support">
							<span class="text">Soporte al cliente</span>
							<span class="number">123-456-7890</span>
						</div>
					</div>

					<div class="container-logo">
						<link rel="icon" href="imagenes/logo.png">
						<h1 class="logo"><a href="/">Tecno O.D.A</a></h1>
					</div>

					<div class="container-user">
						<i class="fa-solid fa-user"></i>
						<ul class="menu">
						<span class="text"></span>
						<li><a href="../View/cerrar_sesion.php" href="#" >Cerrar sesión</a></li>
						</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="container-navbar">
				<nav class="navbar container">
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
                        <li><a href="#" data-file="../View/Crear_Tablas.php">Tablas</a></li>
                        <li><a href="../View/enviar_productos.php" >Revisar Productos Solicitados</a></li>
                        <li><a href="#" data-file="mostrar.solicitudes.php">Solicitudes</a></li>
                        <li><a href="#">Contactos Proveedor</a></li>
					</ul>

					<form class="search-form">
						<input type="search" placeholder="Buscar..." />
						<button class="btn-search">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</nav>
			</div>
		</header>

<section class="container-features">
        <br><br><br><br><br><br><!-- Otros contenidos -->

        <!-- Contenedor para mostrar la información cargada -->
        <div id="contenedor_info"></div>
</section>
        <nav>

		<section class="banner">
			<div class="content-banner">
			</div>
		</section>

		<main class="main-content">
			<section class="container container-features">
				<div class="social-icons">
                    <span class="instagram">
                    <i class="fa-brands fa-instagram"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
				<div class="social-icons">
                    <span class="twitter">
                    <i class="fa-brands fa-twitter"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
				<div class="social-icons">
                    <span class="facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
				<div class="social-icons">
                    <span class="facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
			</section>
		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script src="../Model/JavaScript/Admin.js"></script>
	</body>
</html>
