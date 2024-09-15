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
    
        $sql = "INSERT INTO productos (Nombre, Cantidad, Proveedor, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $resultado = $stmt->execute([$nombre, $cantidad, $proveedor, $valor, $ubicacion, $fecha, $marca, $codigo, $descripcion]);
    
        if ($resultado) {
            // Redirigir a paginata.php en caso de éxito
            header("Location: ../View/Inventario.php?mensaje=sucess");
            exit(); // Asegúrate de usar exit() después de header()
        } else {
            // Redirigir a paginata.php en caso de error
            header("Location:  ../View/Inventario.php?mensaje=error");
            exit(); // Asegúrate de usar exit() después de header()
        }
    }
    

   // Editar producto
if (isset($_POST['accion']) && $_POST['accion'] == 'Actualizar Producto') {
    $id = $_POST['edit_id'];  // ID del producto (campo oculto en el formulario)
    $nombre = $_POST['edit_nombre'];
    $cantidad = $_POST['edit_cantidad'];
    $proveedor = $_POST['edit_proveedor'];
    $valor = $_POST['edit_valor'];
    $ubicacion = $_POST['edit_ubicacion'];
    $fecha = $_POST['edit_fecha'];
    $marca = $_POST['edit_marca'];
    $codigo = $_POST['edit_codigo_barras'];
    $descripcion = $_POST['edit_descripcion'];

    $sql = "UPDATE productos SET Nombre = ?, Cantidad = ?, Proveedor = ?, Valor = ?, Ubicacion = ?, Fecha = ?, Marca = ?, Codigo = ?, Descripcion = ? 
            WHERE ID = ?";
    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute([$nombre, $cantidad, $proveedor, $valor, $ubicacion, $fecha, $marca, $codigo, $descripcion, $id]);

    if ($resultado) {
        // Redirigir a paginata.php en caso de éxito
        header("Location: ../View/Inventario.php?mensaje=sucess");
        exit(); // Asegúrate de usar exit() después de header()
    } else {
        // Redirigir a paginata.php en caso de error
        header("Location:  ../View/Inventario.php?mensaje=error");
        exit(); // Asegúrate de usar exit() después de header()
    }
}


    // Eliminar producto
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
    
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $resultado = $stmt->execute([$id]);
    
        if ($resultado) {
            // Redirigir a paginata.php en caso de éxito
            header("Location: ../View/Inventario.php?mensaje=sucess");
            exit(); // Asegúrate de usar exit() después de header()
        } else {
            // Redirigir a paginata.php en caso de error
            header("Location:  ../View/Inventario.php?mensaje=error");
            exit(); // Asegúrate de usar exit() después de header()
        }
    }
}
?>