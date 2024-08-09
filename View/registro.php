<?php
require '../Controller/conexion.php';

// Obtener datos del formulario
$cargo = $_POST["Cargo"];
$nombre = $_POST["Nombre"];
$apellido = $_POST["Apellido"];
$usuario = $_POST["Usuario"];
$tipo_doc = $_POST["Tipo_Doc"];
$num_doc = $_POST["Num_Doc"];
$correo = $_POST["Correo"];
$tel = $_POST["Tel"];
$pw = $_POST["pw"];

// Crear instancia de la base de datos y conectar
$db = new Database();
$conexion = $db->conectar();

// Consultar si alguno de los datos ya está registrado
$query = 'SELECT * FROM registro WHERE Usuario = :usuario OR Num_Doc = :num_doc OR Correo = :correo';
$stmt = $conexion->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':num_doc', $num_doc);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

// Verificar si la consulta encontró algún registro
if ($stmt->rowCount() > 0) {
    echo "<script>
        alert('El usuario, número de documento o correo ya están registrados');
        window.location = '../View/LoginRegister.php';
    </script>";
} else {
    // Preparar la consulta para insertar los nuevos datos
    $query = "INSERT INTO registro (Cargo, Usuario, P_Nombre, P_Apellido, Tipo_Doc, Num_Doc, Correo, Telefono, Contrasenia) VALUES (:cargo, :usuario, :nombre, :apellido, :tipo_doc, :num_doc, :correo, :tel, :pw)";
    $stmt = $conexion->prepare($query);
    
    // Encriptar la contraseña
    $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);
    
    // Asociar parámetros
    $stmt->bindParam(':cargo', $cargo);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':tipo_doc', $tipo_doc);
    $stmt->bindParam(':num_doc', $num_doc);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':pw', $hashed_pw); // Usar la contraseña encriptada
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>
            alert('Usuario ingresado exitosamente');
            window.location = '../View/LoginRegister.php';
        </script>";
    } else {
        echo "<script>
            alert('Hubo un error al ingresar los datos');
            window.location = '../View/LoginRegister.php';
        </script>";
    }
}
?>
