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
    background: linear-gradient(to bottom, #000000, #7BB4E3);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}
.todo{
    background-color: white;
    border: 10px;
    width: 450px;
    height: 750px;
    display: none;
}
    .contenedor{
        width: 400px;
        backdrop-filter: blur(15px);
        background-color: rgba(0,0,0,0.5);
        background: linear-gradient(to right, #000000, #7BB4E3);
        height: 720px;
        width: 400px;
        text-align: center;
        border-radius: 10px;
        color: #f0f0f0;
    }
    .hidden {
    display: none;
}
    
    </style>
</head>
<body>

<div class="container mt-5 position.relative">
        <div class="row">
            <div class="col">
            <form action="#" method="post" class registro>
            <button id="toggleButton">Donde</button>
            </form>
    <center>
<div class="todo">
    <div id="formContainer" class="hidden">
            <form action="#" method="post" class registro>
                
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control">
                        <label for="">cantidad:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">proveedor:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">valor:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">ubicacion:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">fecha:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">marca:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">codigo:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">codigo_de_barras:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">descripcion:</label>
                        <input type="numero" class="form-control w-25">
                        <label for="">categoria:</label>
                        <input type="numero" class="form-control w-25">
                    <input type="submit" name="accion" value="agregar producto">
                    <input type="submit" name="accion" value="eliminar">
                    <input type="submit" name="accion" value="editar">
                    
            </form>
    </div>
</div>
</center>






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
</body>
</html>
<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
        const formContainer = document.getElementById('formContainer');
        
        if (formContainer.classList.contains('hidden')) {
            formContainer.classList.remove('hidden');
            this.textContent = 'Ocultar Formulario';
        } else {
            formContainer.classList.add('hidden');
            this.textContent = 'Mostrar Formulario';
        }
    });
    </script>