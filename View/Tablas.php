<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <?php 
    session_start();

    include '../Controller/conexion.php';
    ?>
    <style>
        body {
            background-color: #f0f0f0; /* Color gris claro para el fondo de toda la página */
            background: linear-gradient(to bottom, #33afff, #7BB4E3);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }
        #formContainer {
            width: 800px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            padding: 20px;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
            opacity: 0;
            visibility: hidden;
            text-align: center;
            
        }
        #formContainer.open {
            opacity: 1;
            visibility: visible;
        }

        button {
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-control {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .w-25 {
            width: 25%;
        }
        
        /* Estilos para ocultar los controles en los inputs de tipo number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
        }
    </style>
</head>
<body>
    <button id="toggleButton">Mostrar Formulario</button>
    <center>
    <div id="formContainer">
        <center>
        <form action="#" method="POST">
            <h1>Registro de Productos</h1>
            <input type="text" id="nombre" placeholder="Nombre" class="form-control w-25">
            <input type="number" id="cantidad" placeholder="Cantidad" class="form-control w-25">
            <input type="text" id="proveedor" placeholder="Proveedor" class="form-control w-25">
            <input type="price" id="valor" placeholder="Valor" class="form-control w-25">
            <input type="text" id="ubicacion" placeholder="Ubicación" class="form-control w-25">
            <input type="date" id="fecha" placeholder="Fecha" class="form-control w-25">
            <input type="text" id="marca" placeholder="Marca" class="form-control w-25">
            <input type="number" id="codigo" placeholder="Código" class="form-control w-25">
            <input type="number" id="codigo_barras" placeholder="Código de barras" class="form-control w-25">
            <input type="text" id="descripcion" placeholder="Descripción" class="form-control w-25">
            
            <input type="submit" name="accion" value="Agregar Producto">
            <input type="submit" name="accion" value="Eliminar">
            <input type="submit" name="accion" value="Editar">
            <button type="button" id="closeButton">Cerrar</button>
        </form>
        </center>
    </div>
    </center>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('toggleButton');
            const formContainer = document.getElementById('formContainer');
            const closeButton = document.getElementById('closeButton');

            toggleButton.addEventListener('click', () => {
                if (formContainer.classList.contains('open')) {
                    formContainer.classList.remove('open');
                    toggleButton.textContent = 'Mostrar Formulario';
                } else {
                    formContainer.classList.add('open');
                    toggleButton.textContent = 'Ocultar Formulario';
                }
            });

            closeButton.addEventListener('click', () => {
                formContainer.classList.remove('open');
                toggleButton.textContent = 'Mostrar Formulario';
            });
        });
    </script>
</body>
</html>
<?php
/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];
    switch ($accion) {
        case 'agregar producto':
            $nombre = $_POST['nombre'] ?? '';
            $cantidad = $_POST['cantidad'] ?? '';
            $proveedor = $_POST['proveedor'] ?? '';
            $valor = $_POST['valor'] ?? '';
            $ubicacion = $_POST['ubicacion'] ?? '';
            $fecha = $_POST['fecha'] ?? '';
            $marca = $_POST['marca'] ?? '';
            $codigo = $_POST['codigo'] ?? '';
            $codigo_de_barras = $_POST['codigo_de_barras'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $categoria = $_POST['categoria'] ?? '';

            $insertardatos = "INSERT INTO productos (nombre, cantidad, proveedor, valor, ubicacion, fecha, marca, codigo, codigo_de_barras, descripcion, categoria) 
                              VALUES ('$nombre', '$cantidad', '$proveedor', '$valor', '$ubicacion', '$fecha', '$marca', '$codigo', '$codigo_de_barras', '$descripcion', '$categoria')";

            // Aquí deberías ejecutar la consulta usando `mysqli_query($enlace, $insertardatos);` y manejar posibles errores.
            break;
        case 'eliminar':
            // Lógica para eliminar
            break;
        case 'editar':
            // Lógica para editar
            break;
        case 'agregar':
            break;
    }
}*/
?>