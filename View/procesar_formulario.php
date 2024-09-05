<?php
require '../Controller/conexion.php';
$db = new Database();
$conexion = $db->conectar();

// Verificar si se ha enviado un formulario para insertar un producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Guardar producto
    if (isset($_POST['enviar'])) {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $proveedor = $_POST['proveedor'];
        $valor = $_POST['valor'];
        $ubicacion = $_POST['ubicacion'];
        $fecha = $_POST['fecha'];
        $marca = $_POST['marca'];
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
    
        $sql = "INSERT INTO solicitudes (Nombre, Cantidad, Proveedor, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $resultado = $stmt->execute([$nombre, $cantidad, $proveedor, $valor, $ubicacion, $fecha, $marca, $codigo, $descripcion]);
    
        if ($resultado) {
            // Redirigir a paginata.php en caso de éxito
            header("Location: ../View/Gestor.php");
            exit(); // Asegúrate de usar exit() después de header()
        } else {
            // Redirigir a paginata.php en caso de error
            header("Location: ../View/Gestor.php?mensaje=error");
            exit(); // Asegúrate de usar exit() después de header()
        }
    }
}
?>
