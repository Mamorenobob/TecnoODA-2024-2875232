<?php
    session_start();
    require '../View/cortina.php';
    require '../Controller/conexion.php';
    require '../View/Header1.php';
    // Verificar si el usuario no está autenticado
    if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 1)) {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <link rel="stylesheet" href="../Model/Css/CSS_Admin.css" />
    <script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar container">
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
						<li><a href="">Productos Enviados</a></li>
                        <li><a href="../View/Prueba-Distribuidor.php">Regresar al Inicio</a></li>

					</ul>
				</nav>
</body>
</html>