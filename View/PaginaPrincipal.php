<?php
  session_start();
    require '../View/cortina.php';
    require '../Controller/conexion.php';

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Model/Css/styleD.css">
    <link rel="stylesheet" href="../Model/Css/PStyleD.css">
    <link rel="icon" href="imagenes/logo.png">
    <title>Tecno ODA</title>
    <div id="header-img">
        <img src="../Images/13.gif" alt="" style="width: 300px; float: right; ">
    </div>
    </head>
    <style>
        /*
        #header-img {
            margin-bottom: 20px;
            text-align: center; 
        }

    
        .message-1 {
            background-color: white; 
            border-radius: 10px;
            padding: 10px; 
            margin: 10px auto; /
            width: 25%; 
            text-align: center; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-right: 600px;
            position: absolute;
            top: 650px;   
            left: 1400px;  
        }
        .message-2 {
            background-color: white; 
            border-radius: 10px;
            padding: 10px; 
            margin: 10px auto; 
            width: 25%; 
            text-align: center; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-right: 600px;
            position: absolute;
            top: 600px;   
            left: 1400px;  
        }
        .message-3 {
            background-color: white; 
            border-radius: 10px;
            padding: 10px; 
            margin: 10px auto; 
            width: 25%; 
            text-align: center; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            margin-right: 600px;
            position: absolute;
            top: 700px;   
            left: 1400px;  
        }
        .message-4 {
            background-color: white;
            border-radius: 10px;
            padding: 10px; 
            margin: 10px auto; 
            width: 25%;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            margin-right: 600px;
            position: absolute;
            top: 750px;   
            left: 1400px;  
        }
        .message-5 {
            background-color: white; 
            border-radius: 10px;
            padding: 10px;
            margin: 10px auto;
            width: 25%; 
            text-align: center; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            margin-right: 600px;
            position: absolute;
            top: 800px;   
            left: 1400px;  
        }
        .message-6 {
            background-color: white;
            border-radius: 10px;
            padding: 10px; 
            margin: 10px auto; 
            width: 25%; 
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            margin-right: 600px;
            position: absolute;
            top: 850px;   
            left: 1400px;  
        }*/
    </style>
    
<body>
    
 <!--
<div class="message-1">
    
    <p></p>
</div>
<div class="message-2">
    
    <p></p>
</div>
<div class="message-3">
    
    <p></p>
</div>
<div class="message-4">
   
    <p></p>
</div>
<div class="message-5">
   
    <p></p>
</div>
<div class="message-6">
   
    <p></p>
</div> -->
    <header id="arriba" class="parallax">
        <div id="header-img">
            <img src="imagenes/logo.png">
        </div>
        <div class="exp-text">
            <div>
                <h1>Tecno ODA</h1>
                <h3>2024</h3>
            </div>
        </div>
    </header>

    <ul class="nav">
                <li><a href="">Productos</a></li>
            </ul>
        <button id="botonPrincipal">opciones</button>
        <div id="botonesDesplegables" class="oculto">
        
        <button>Opción 2</button>
        </div>
        <button><li><a href="../View/cerrar_sesion.php">Cerrar sesión</a></li></button>
    <aside id="educacion">
        <hr>
                <article>
                    <div class="edu-img">
                        <img src="imagenes/Producto1.jpeg">
                    </div>
                    <div class="edu-text">
                        <p class="periodo">Tipo de producto</p>
                        <p class="titulo">Producto</p>
                        <p class="descripcion">descripcion</p>
                    </div>
                </article>
    </aside>
</body>
<script src="boton.js"></script>
</html>