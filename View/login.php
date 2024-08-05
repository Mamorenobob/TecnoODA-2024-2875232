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
        header("location:PaginaPrincipal.php");
        exit(); // Asegúrate de que el script no continúe ejecutándose después del redireccionamiento
    }

    // Procesar el inicio de sesión
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = $_POST['Usuario'];
        $contrasenia = $_POST['contrasenia'];

        // Prepara la consulta
        $query = "SELECT * FROM registro WHERE usuario = :usuario AND contrasenia = :contrasenia";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasenia', $contrasenia);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Verificar si se encontró un resultado
        if ($stmt->rowCount() > 0) {
            $_SESSION['Usuario'] = $usuario;
            header("Location: PaginaPrincipal.php");
            exit();
        } else {
            echo "<script>
                    alert('Usuario o contraseña incorrectos');
                    window.location = '../View/LoginRegister.php';
                </script>
            ";
        }
    }
?>