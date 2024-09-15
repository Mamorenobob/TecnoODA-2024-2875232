<?php
session_start();
require '../Controller/conexion.php';
$db = new Database();
$conexion = $db->conectar();

$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $id = $_POST['id'];

    try {
        if ($accion == 'aprobar') {
            // Obtener los detalles de la solicitud
            $sql = "SELECT * FROM solicitudes WHERE ID = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id]);
            $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($solicitud) {
                // Insertar en la tabla pedido
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
                    // Insertar en la tabla historial
                    $sql = "INSERT INTO historial (Nombre, Cantidad, Proveedor, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion, estado_id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                        $solicitud['Descripcion'],
                        1 // Estado para "aprobado"
                    ]);

                    if ($resultado) {
                        // Eliminar de la tabla solicitudes
                        $sql = "DELETE FROM solicitudes WHERE ID = ?";
                        $stmt = $conexion->prepare($sql);
                        $stmt->execute([$id]);

                        $response['success'] = true;
                    }
                }
            }
        } elseif ($accion == 'rechazar') {
            // Obtener los detalles de la solicitud
            $sql = "SELECT * FROM solicitudes WHERE ID = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id]);
            $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($solicitud) {
                // Insertar en la tabla historial
                $sql = "INSERT INTO historial (Nombre, Cantidad, Proveedor, Valor, Ubicacion, Fecha, Marca, Codigo, Descripcion, estado_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                    $solicitud['Descripcion'],
                    2 // Estado para "rechazado"
                ]);

                if ($resultado) {
                    // Eliminar de la tabla solicitudes
                    $sql = "DELETE FROM solicitudes WHERE ID = ?";
                    $stmt = $conexion->prepare($sql);
                    $resultado = $stmt->execute([$id]);
                    
                    $response['success'] = true;
                }
            }
        }
    } catch (PDOException $e) {
        $response['message'] = 'Error de base de datos: ' . $e->getMessage();
    }

    echo json_encode($response);
}
