<?php 
session_start();
require '../Controller/conexion.php'; // Asegúrate de que esta ruta sea correcta

// Crear una instancia de la clase Database y conectar
$db = new Database();
$conexion = $db->conectar();

// Verificar si la conexión fue exitosa
if ($conexion === null) {
    die('Error de conexión a la base de datos');
    
// Guardar el usuario y el cargo en la sesión
$_SESSION['Usuario'] = $usuario;
$_SESSION['Cargo'] = $cargo;

}
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
        $cargo = trim($row['Cargo']); // Asegúrate de que el valor no tenga espacios extra
        // Redirigir al usuario según su cargo
        switch ($cargo) {
            case 'Gestor':
                header("Location: ../View/PaginaPrincipal.php");
                break;
            case 'Proveedor':
                header("Location: ../View/Prueba-Proveedor1.php");
                break;
            case 'Distribuidor':
                header("Location: ../View/Moderador.php");
                break;
            default:
                // Si el cargo no coincide con ninguno de los casos, redirigir a una página de error o predeterminada
                header("Location: ../View/LoginRegister.php");
                break;
                    // Verificar si el usuario ya está autenticado
            if (isset($_SESSION['Usuario'])) {
                // Verificar el cargo en la sesión y redirigir en consecuencia
                if (isset($_SESSION['Cargo'])) {
                    switch ($_SESSION['Cargo']) {
                        case 'Gestor':
                            header("Location: ../View/PaginaPrincipal.php");
                            exit();
                        case 'Proveedor':
                            header("Location: ../View/Prueba-Proveedor1.php");
                            exit();
                        case 'Distribuidor':
                            header("Location: ../View/Moderador.php");
                            exit();
                        default:
                            header("Location: ../View/LoginRegister.php");
                            exit();
                    }
                } else {
                    // Si el cargo no está definido, redirige a una página de error
                    header("Location: ../View/LoginRegister.php");
                    exit();
    }
}
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
