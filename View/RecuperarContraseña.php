<?php
session_start();
require '../View/cortina.php';
require '../View/Header.php';
require '../Controller/conexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../View/PHPMailer-master/src/Exception.php';
require '../View/PHPMailer-master/src/PHPMailer.php';
require '../View/PHPMailer-master/src/SMTP.php';
require_once('../Controller/conexion.php');
$db = new Database();
$conexion = $db->conectar();

if ($conexion === null) {
    die("Error de la conexión a la base de datos");
}

if (isset($_SESSION['Usuario'])) {
    header("location:PaginaPrincipal.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $verificarCorreo = $_POST['Verificacion'];
    $nuevaPassword = $_POST['pw'];

    try {
        // Verificar si el correo existe
        $queryEmail = 'SELECT Correo FROM registro WHERE Correo = :correo';
        $stmtQuery = $conexion->prepare($queryEmail);
        $stmtQuery->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
        $stmtQuery->execute();
        $resultadoEmail = $stmtQuery->fetch(PDO::FETCH_ASSOC);

        if ($resultadoEmail) {
            // Actualizar el token_password y token_request
            $updateToken = 'UPDATE registro SET token_password = :token_password, token_request = 1 WHERE Correo = :correo';
            $stmtUpdate = $conexion->prepare($updateToken);
            $stmtUpdate->bindParam(':token_password', $nuevaPassword, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
            $stmtUpdate->execute();

            // Enviar el correo con el enlace de recuperación
            $token_query = 'SELECT id FROM registro WHERE Correo = :correo';
            $stmtTokenQuery = $conexion->prepare($token_query);
            $stmtTokenQuery->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
            $stmtTokenQuery->execute();
            $userId = $stmtTokenQuery->fetchColumn();

            if ($userId) {
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host       = 'smtp-mail.outlook.com'; // El servidor SMTP
                    $mail->SMTPAuth   = true;                     // Habilitar la autenticación SMTP
                    $mail->Username   = 'TecnoODA@outlook.com';  // Tu dirección de correo electrónico
                    $mail->Password   = 'Dmc1231069*';            // Tu contraseña de correo electrónico
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar el cifrado TLS
                    $mail->Port       = 587;                      // Puerto TCP para TLS
                
                    // Destinatario y contenido del correo
                    $mail->setFrom('TecnoODA@outlook.com', 'TecnoODA');
                    $mail->addAddress($verificarCorreo);
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperación de contraseña';
                    $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, por favor, visita la página de <a href="http://localhost/TecnoODA/View/LoginRegister.php?id=' . $userId . '">Recuperación de contraseña</a>';
                
                    // Enviar el correo
                    $mail->send();
                    echo "<script>alert('Correo enviado con éxito');</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Error al enviar el correo: " . $mail->ErrorInfo . "');</script>";
                }
            } else {
                echo "<script>
                       alert('Error al recuperar el ID de usuario');
                   </script>";
            }
        } else {
            echo "<script>
                   alert('Correo no válido');
               </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
               alert('Error en la base de datos: " . $e->getMessage() . "');
           </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../Model/Css/Style.css">
    <style>
        .contenedor_todo {
            background-color: white;
            width: 380px;
            height: 450px;
            border-radius: 15px;
            text-align: center;
            margin: 10px;
        }
        .contenedor_todo form input {
            width: 80%;
            margin-top: 20px;
            padding: 10px;
            border: none;
            top: 45%;
            background: #f2f2f2;
            font-size: 16px;
            outline: none;
        }
        .contenedor_todo form button {
            padding: 10px 40px;
            margin-top: 40px;
            border: none;
            font-size: 14px;
            background: #46A2FD;
            color: white;
            cursor: pointer;
            outline: none;
        }
        .contenedor_todo form h1 {
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
            color: #46A2FD;
        }
    </style>
</head>
<body>
    <center>
    <div class="contenedor_todo">
        <form action="#" method="POST">
            <h1>Recuperar Contraseña</h1>
            <input type="email" name="Verificacion" placeholder="Correo Electrónico">
            <br>
            <input type="password" name="pw" placeholder="Nueva Contraseña">
            <br>
            <button>Aceptar</button>
        </form>
    </div>
    </center>
</body>
<footer>
<?php
    require '../View/Footer.php';
?>
</footer>
</html>
<?php
$db = new Database();
$conexion = $db->conectar();

if ($conexion === null) {
    die("Error de la conexión a la base de datos");
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        // Preparar la consulta para obtener el correo y token_password
        $query = 'SELECT Correo, token_password FROM registro WHERE id = :id';
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Actualizar Contrasenia y poner token_password a NULL
            $updateQuery = 'UPDATE registro SET Contrasenia = token_password, token_password = NULL, token_request = 0 WHERE id = :id';
            $stmtUpdate = $conexion->prepare($updateQuery);
            $stmtUpdate->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmtUpdate->execute();

            echo "<script>
                   alert('Contraseña cambiada exitosamente');
                   window.location.href = '../View/LoginRegister.php';
               </script>";
        } else {
            echo "<script>
                   alert('ID de usuario no válido');
                   window.location.href = '../View/LoginRegister.php';
               </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
               alert('Error en la base de datos: " . $e->getMessage() . "');
           </script>";
    }
} else {

}
?>
