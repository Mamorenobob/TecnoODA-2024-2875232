<?php
require '../Controller/conexion.php';

// Conectar a la base de datos
$db = new Database();
$conexion = $db->conectar();

// Obtener el término de búsqueda
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Consulta SQL con filtrado
$sql = "SELECT h.*, e.descripcion AS estado_descripcion
        FROM historial h
        JOIN estado e ON h.estado_id = e.id
        WHERE h.Nombre LIKE :searchTerm";

$stmt = $conexion->prepare($sql);
$stmt->bindValue(':searchTerm', "%$searchTerm%");
$stmt->execute();
$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generar el HTML para los resultados
foreach ($historial as $registro) {
    $estadoClase = $registro['estado_descripcion'] == 'Aprobado' ? 'estado-aprobado' : 'estado-rechazado';
    echo "<tr class='{$estadoClase}'>";
    echo "<td>{$registro['Nombre']}</td>";
    echo "<td>{$registro['Cantidad']}</td>";
    echo "<td>{$registro['Proveedor']}</td>";
    echo "<td>{$registro['Valor']}</td>";
    echo "<td>{$registro['Ubicacion']}</td>";
    echo "<td>{$registro['Fecha']}</td>";
    echo "<td>{$registro['Marca']}</td>";
    echo "<td>{$registro['Codigo']}</td>";
    echo "<td>{$registro['Descripcion']}</td>";
    echo "<td>{$registro['estado_descripcion']}</td>";
    echo "</tr>";
}
?>
