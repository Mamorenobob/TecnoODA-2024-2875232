<?php
require '../Controller/conexion.php'; // Ajusta la ruta según la ubicación de tu archivo
$db = new Database();
$conexion = $db->conectar();

$sql = "SELECT * FROM solicitudes";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
    <link rel="stylesheet" href="../Model/Css/Solicitud.css"> <!-- Ajusta la ruta si es necesario -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Solicitudes</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Proveedor</th>
                <th>Valor</th>
                <th>Ubicación</th>
                <th>Fecha</th>
                <th>Marca</th>
                <th>Código</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($solicitudes)) { ?>
                <tr>
                    <td colspan="9" style="text-align: center;">No hay solicitudes registradas.</td>
                </tr>
            <?php } else {
                foreach ($solicitudes as $solicitud) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($solicitud['Nombre']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Cantidad']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Proveedor']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Valor']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Ubicacion']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Fecha']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Marca']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Codigo']); ?></td>
                        <td><?php echo htmlspecialchars($solicitud['Descripcion']); ?></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</body>
</html>
