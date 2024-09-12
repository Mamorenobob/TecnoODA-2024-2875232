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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Tus estilos aquí */
    </style>
</head>
<body>
    <h1>Solicitudes</h1>
    <table style='text-align:center;'>
        <thead>
            <tr>
                <th style='text-align:center;'>Nombre</th>
                <th style='text-align:center;'>Cantidad</th>
                <th style='text-align:center;'>Proveedor</th>
                <th style='text-align:center;'>Valor</th>
                <th style='text-align:center;'>Ubicación</th>
                <th style='text-align:center;'>Fecha</th>
                <th style='text-align:center;'>Marca</th>
                <th style='text-align:center;'>Código</th>
                <th style='text-align:center;'>Descripción</th>
                <th style='text-align:center;'>Aprobar</th>
                <th style='text-align:center;'>Rechazar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($solicitudes)) { ?>
                <tr>
                    <td colspan="11" style="text-align: center;">No hay solicitudes registradas.</td>
                </tr>
            <?php } else {
                foreach ($solicitudes as $solicitud) { ?>
                    <tr data-id="<?php echo $solicitud['ID']; ?>">
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Nombre']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Cantidad']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Proveedor']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Valor']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Ubicacion']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Fecha']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Marca']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Codigo']); ?></td>
                        <td class="descripcion" style='text-align:center;'><?php echo htmlspecialchars($solicitud['Descripcion']); ?></td>
                        <td style='text-align:center;'>
                            <a href="procesar_solicitud.php?action=aprobar&id=<?php echo $solicitud['ID']; ?>" class="btn btn-success"><i class="fa-solid fa-check"></i></a>
                        </td>
                        <td style='text-align:center;'>
                            <a href="procesar_solicitud.php?action=rechazar&id=<?php echo $solicitud['ID']; ?>" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</body>
</html>
<script>
function aprobar(id) {
    if (confirm('¿Estás seguro de que deseas aprobar este producto?')) {
        fetch('../View/procesar_solicitud.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                id: id,
                accion: 'aprobar'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`tr[data-id="${id}"]`).style.backgroundColor = 'green';
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function rechazar(id) {
    if (confirm('¿Estás seguro de que deseas rechazar este producto?')) {
        fetch('../View/procesar_solicitud.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                id: id,
                accion: 'rechazar'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`tr[data-id="${id}"]`).remove();
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

</script>