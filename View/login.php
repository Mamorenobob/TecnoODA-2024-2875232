<?php 
session_start();
require '../Controller/conexion.php'; // Asegúrate de que esta ruta sea correcta

// Crear una instancia de la clase Database y conectar
$db = new Database();
$conexion = $db->conectar();

// Verificar si la conexión fue exitosa
if ($conexion === null) {
    die('Error de conexión a la base de datos');
}

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['Usuario'])) {
    header("location: PaginaPrincipal.php");
    exit(); // Asegúrate de que el script no continúe ejecutándose después del redireccionamiento
}

// Procesar el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'];
    $contrasenia = $_POST['contrasenia'];

    // Prepara la consulta para verificar las credenciales del usuario
    $query = "SELECT Cargo FROM registro WHERE Usuario = :usuario AND Contrasenia = :contrasenia";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasenia', $contrasenia);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Verificar si se encontró un resultado
    if ($stmt->rowCount() > 0) {
        // Obtener el cargo del usuario
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cargo = $row['Cargo'];

        // Guardar el usuario en la sesión
        $_SESSION['Usuario'] = $usuario;

        // Redirigir al usuario según su cargo
        switch ($cargo) {
            case 2:
                header("Location: ../View/PaginaPrincipal.php");
                break;
            case 8:
                header("Location: ../View/Prueba-Proveedor1.php");
                break;
            case 1:
                header("Location: ../View/Moderador.php");
                break;
            default:
                // Si el cargo no coincide con ninguno de los casos, redirigir a una página de error o predeterminada
                header("Location: ../View/LoginRegister.php");
                break;
        }
        exit();
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location = '../View/LoginRegister.php';
            </script>";
    }
}
?>