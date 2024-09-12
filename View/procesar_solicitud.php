<?php
require '../Controller/conexion.php'; // Ajusta la ruta según la ubicación de tu archivo
$db = new Database();
$conexion = $db->conectar();

// Verificar que se ha enviado un ID y acción
if (!isset($_POST['id']) || !isset($_POST['accion'])) {
    echo json_encode(['success' => false, 'message' => 'ID o acción no definidos']);
    exit();
}

$id = intval($_POST['id']);
$accion = $_POST['accion']; // "aprobar" o "rechazar"

// Establecer el estado basado en la acción
if ($accion == 'aprobar') {
    $estado = 1; // Activado
} elseif ($accion == 'rechazar') {
    $estado = 0; // Desactivado
} else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    exit();
}

// Preparar la consulta SQL
$sql = "UPDATE solicitudes SET estado = :estado WHERE ID = :id";
$stmt = $conexion->prepare($sql);

// Ejecutar la consulta
try {
    $stmt->execute([':estado' => $estado, ':id' => $id]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
