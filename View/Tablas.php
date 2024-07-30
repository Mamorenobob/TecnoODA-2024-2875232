<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <style>
        body {
    background-color: #f0f0f0; /* Color gris claro para el fondo de toda la página */
    background: linear-gradient(to bottom, #000000, #7BB4E3);
}
        table {
            color:white;
            border: 1px solid black;
            overflow-y: scroll; /* Activa el desplazamiento vertical */
            border-collapse: collapse; /* Combina los bordes para que no se dupliquen */
        }
        th, td {
            background:black;
            border: 1px solid black; /* Bordes internos */
            padding: 8px; /* Espaciado interno de las celdas */
            text-align: left; /* Alineación del texto */
        }
        h1{ 
           
        }
        <style>
        .up-and-down {
            width: 100px;
            height: 100px;
            background-color: #3498db;
            display: inline-block;
            animation: upAndDown 2s infinite;
        }

        @keyframes upAndDown {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }
        .registro {
    display: none; /* Oculto por defecto */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Efecto de "grisar" */
    justify-content: center;
    align-items: center;
}
    </style>
</head>
<body>

<div class="container mt-5 position.relative">
        <div class="row">
            <div class="col">
                <center>
            <tr>REGISTRO PRODUCTO</tr>
</center>
<table class="table table-dark" id="table">
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>cantidad</th>
                        <th>proveedor</th>
                        <th>valor</th>
                        <th>ubicacion</th>
                        <th>fecha</th>
                        <th>marca</th>
                        <th>codigo</th>
                        <th>codigo_de_barras</th>
                        <th>descripcion</th>
                        <th>categoria</th>
                    </tr>

            <form action="#" method="post">
        <table>
            <td>
                <div class="text-center"> resgistro producto</div>
            <div class="form-control borde-white">
                <label for="">Nombre:</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-control border-white">
                <label for="">cantidad:</label>
                <input type="numero" class="form-control w-25">
            </div>
            </div>
            <div class="form-control border-white">
                <label for="">proveedor:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">valor:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">ubicacion:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">fecha:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">marca:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">codigo:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">codigo_de_barras:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">descripcion:</label>
                <input type="numero" class="form-control w-25">
            </div>
            <div class="form-control border-white">
                <label for="">categoria:</label>
                <input type="numero" class="form-control w-25">
            </div>
    <input type="submit" name="accion" value="agregar producto">
    <input type="submit" name="accion" value="eliminar">
    <input type="submit" name="accion" value="editar">
</td>
</form>
</table>
    





<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    }
}
?>



 

</body>
</html>
