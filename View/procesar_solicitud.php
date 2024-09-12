<?php
require '../Controller/conexion.php';
$db = new Database();
$conexion = $db->conectar();

$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $id = $_POST['id'];

    if ($accion == 'aprobar') {
        // Obtener los detalles de la solicitud
        $sql = "SELECT * FROM solicitudes WHERE ID = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($solicitud) {
            $sql = "INSERT INTO pedido (Nombre, Cantidad, Proveedor, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $resultado = $stmt->execute([
                $solicitud['Nombre'],
                $solicitud['Cantidad'],
                $solicitud['Proveedor'],
                $solicitud['Valor'],
                $solicitud['Ubicacion'],
                $solicitud['Fecha'],
                $solicitud['Marca'],
                $solicitud['Codigo'],
                $solicitud['Descripcion']
            ]);

            if ($resultado) {
                // Eliminar de la tabla solicitudes después de aprobar
                $sql = "DELETE FROM solicitudes WHERE ID = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([$id]);

                $response['success'] = true;
            }
        }
    } elseif ($accion == 'rechazar') {
        // Eliminar de la tabla solicitudes
        $sql = "DELETE FROM solicitudes WHERE ID = ?";
        $stmt = $conexion->prepare($sql);
        $resultado = $stmt->execute([$id]);

        if ($resultado) {
            $response['success'] = true;
        }
    }

    echo json_encode($response);
}
?>
