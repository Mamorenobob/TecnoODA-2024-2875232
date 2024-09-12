<?php
require '../Controller/conexion.php';

$db = new Database();
$conexion = $db->conectar();

// Verificar si el parámetro 'id' está presente en la solicitud
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);  // Asegúrate de que el ID sea un entero

    // Dependiendo de la acción, realizar la operación correspondiente
    $sql = "UPDATE solicitudes SET estado = 'aprobado' WHERE ID = :id"; // Para aprobar
    // $sql = "DELETE FROM solicitudes WHERE ID = :id"; // Descomenta esta línea para rechazar

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
