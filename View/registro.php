
<?php
require '../Controller/conexion.php';

$cargo = $_POST["Cargo"];
$nombre = $_POST["Nombre"];
$apellido = $_POST["Apellido"];
$usuario = $_POST["Usuario"];
$tipo_doc = $_POST["Tipo_Doc"];
$correo = $_POST["Correo"];
$tel = $_POST["Tel"];
$pw = $_POST["pw"];

    $db = new Database();
    $conexion = $db->conectar();
    $query = "INSERT INTO registro (Cargo, Usuario, P_Nombre, P_Apellido, Tipo_Doc, Num_Doc, Correo, Telefono, Contrasenia) VALUES (:cargo, :usuario, :nombre, :apellido, :tipo_doc, :num_doc, :correo, :tel, :pw)";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':cargo', $cargo);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':tipo_doc', $tipo_doc);
    $stmt->bindParam(':num_doc', $num_doc); // Añadido
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':pw', $pw); // Sin encriptar
    
    // Ejecutar la consulta
    $stmt->execute();
?>

