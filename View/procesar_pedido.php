<?php
session_start();
require '../Controller/conexion.php';

$db = new Database();
$conexion = $db->conectar();
if ($conexion === null) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión']);
    exit();
}

$id = $_POST['id'];
$accion = $_POST['accion'];

// Preparar la consulta para seleccionar los datos del pedido
$sql_select = "SELECT * FROM pedido WHERE id = ?";
$stmt_select = $conexion->prepare($sql_select);
$stmt_select->execute([$id]);
$pedido = $stmt_select->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    echo json_encode(['success' => false, 'message' => 'Pedido no encontrado']);
    exit();
}

if ($accion === 'aceptar') {
    // Insertar en la tabla enviado
    $sql_insert = "INSERT INTO enviado (Nombre, Cantidad, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion, Proveedor, Estado_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $result_insert = $stmt_insert->execute([
        $pedido['Nombre'],
        $pedido['Cantidad'],
        $pedido['Valor'],
        $pedido['Ubicacion'],
        $pedido['Fecha'],
        $pedido['Marca'],
        $pedido['Codigo'],
        $pedido['Descripcion'],
        $pedido['Proveedor']
    ]);

    // Eliminar de la tabla pedido
    $sql_delete = "DELETE FROM pedido WHERE id = ?";
    $stmt_delete = $conexion->prepare($sql_delete);
    $result_delete = $stmt_delete->execute([$id]);

    $success = $result_insert && $result_delete;

} elseif ($accion === 'rechazar') {
    // Insertar en la tabla enviado con estado 'rechazado'
    $sql_insert = "INSERT INTO enviado (Nombre, Cantidad, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion, Proveedor, Estado_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 2)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $result_insert = $stmt_insert->execute([
        $pedido['Nombre'],
        $pedido['Cantidad'],
        $pedido['Valor'],
        $pedido['Ubicacion'],
        $pedido['Fecha'],
        $pedido['Marca'],
        $pedido['Codigo'],
        $pedido['Descripcion'],
        $pedido['Proveedor']
    ]);

    // Eliminar de la tabla pedido
    $sql_delete = "DELETE FROM pedido WHERE id = ?";
    $stmt_delete = $conexion->prepare($sql_delete);
    $result_delete = $stmt_delete->execute([$id]);

    $success = $result_insert && $result_delete;

} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    exit();
}

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al procesar']);
}
?>
