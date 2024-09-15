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

if ($accion === 'aceptar') {
    $sql = "UPDATE pedido SET estado = 'aceptado' WHERE id = ?";
} elseif ($accion === 'rechazar') {
    $sql = "DELETE FROM pedido WHERE id = ?";
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    exit();
}

$stmt = $conexion->prepare($sql);
$result = $stmt->execute([$id]);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al procesar']);
}
?>
