<?php
  session_start();
    require '../View/cortina.php';
    require '../Controller/conexion.php';
    require '../View/Header.php';
    // Verificar si el usuario no está autenticado
    if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 2)) {
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
    <link rel="stylesheet" href="../Model/Css/Gestor.css">
    <script src="../Model/JavaScript/Gestor.js"></script>
    <title>Gestor</title>
</head>
<body>
<li><a href="../View/cerrar_sesion.php">Cerrar sesión</a></li>
    <nav>
        <div class="menu-toggle" id="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-list" id="nav-list">
            <li><a href="#" data-file="Taablas1.php">Tablas</a></li>
            <li><a href="#">Solicitar Productos</a></li>
            <li><a href="#">Solicitudes</a></li>
            <li><a href="#">Contactos Proveedor</a></li>

        </ul>
    </nav>
    <div id="content">
        <!-- Aquí se cargará el contenido -->
    </div>
</body>
</html>
<?php
    require '../View/Footer.php';
?>