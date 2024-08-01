<?php
    session_start();

    if(!isset($_SESSION['Usuario'])){
        echo'
            <script>
                alert("Por favor debes inicar sesion");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hola
    <a href="cerrar_sesion.php">Cerrar</a>
</body>
</html>