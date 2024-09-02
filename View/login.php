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

// Procesar el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'];
    $contrasenia = $_POST['contrasenia'];
    $cargoFormulario = $_POST['cargo'];  // El cargo que se envía desde el formulario

    // Prepara la consulta para verificar las credenciales del usuario y el cargo
    $query = "SELECT Cargo FROM registro WHERE Usuario = :usuario AND Contrasenia = :contrasenia";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasenia', $contrasenia);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Verificar si se encontró un resultado
    if ($stmt->rowCount() > 0) {
        // Obtener el cargo del usuario de la base de datos
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cargoBD = $row['Cargo'];  // Cargo guardado en la base de datos

        // Comparar el cargo del formulario con el cargo de la base de datos
        if ($cargoFormulario == $cargoBD) {
            // Guardar el usuario y el cargo en la sesión
            $_SESSION['Usuario'] = $usuario;
            $_SESSION['Cargo'] = $cargoBD;  // Guardar el cargo en la sesión

            // Redirigir al usuario según su cargo
            switch ($cargoBD) {
                case 1:
                    header("Location: ../View/Prueba-Distribuidor.php");
                    break;
                case 2:
                    header("Location: ../View/Gestor.php");
                    break;
                case 8:
                    header("Location: ../View/Prueba-Proveedor1.php");
                    break;
                case 9:
                    header("Location: ../View/PaginaPrincipal.php");
                    break;
                default:
                    // Si el cargo no coincide con ninguno de los casos, redirigir a una página de error o predeterminada
                    header("Location: ../View/LoginRegister.php");
                    break;
            }
            exit();
        } else {
            // Si el cargo del formulario no coincide con el cargo de la base de datos
            echo "<script>
                    alert('El cargo no coincide con nuestros registros');
                    window.location = '../View/LoginRegister.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location = '../View/LoginRegister.php';
            </script>";
    }
}
?>
