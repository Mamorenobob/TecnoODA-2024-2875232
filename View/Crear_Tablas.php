
<?php
require '../Controller/conexion.php';
$db = new Database();
$conexion = $db->conectar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para Crear Tabla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Model/Css/Fondo1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Crear Tabla</h2>
        <form id="createTableForm" method="POST" action="Crear_Tablas.php">
            <div class="mb-3">
                <label for="tableName" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="tableName" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Crear Tabla</button>
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];

    // Escapar el nombre de la tabla para evitar inyecciones SQL
    $nombre = preg_replace('/[^a-zA-Z0-9_]/', '', $nombre);

    // Suponiendo que estás utilizando MySQL
    $create = "CREATE TABLE `$nombre` (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Nombre VARCHAR(25),
        Cantidad INT,
        Valor INT,
        Ubicacion VARCHAR(30),
        Fecha DATE,
        Marca VARCHAR(25),
        Codigo INT,
        Descripcion VARCHAR(255),
        Proveedor VARCHAR(30)
    );";

    try {
        // Asumiendo que $conexion es una instancia válida de PDO
        $stmt = $conexion->prepare($create);
        $stmt->execute();
        if($stmt){
            echo "<script>alert('Tabla creada con éxito.');
            </script>";
            header('Location:../View/P.php');
        }else{
            echo "Error al crear la tabla: " . $e->getMessage();
            header('Location:../View/P.php');
        }
    } catch (PDOException $e) {
        echo "Error al crear la tabla: " . $e->getMessage();
    }
}
?>
