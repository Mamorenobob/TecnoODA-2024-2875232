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

    try {
        // Verificar si el correo existe
        $queryEmail = 'SELECT Correo FROM registro WHERE Correo = :correo';
        $stmtQuery = $conexion->prepare($queryEmail);
        $stmtQuery->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
        $stmtQuery->execute();
        $resultadoEmail = $stmtQuery->fetch(PDO::FETCH_ASSOC);

        if ($resultadoEmail) {
            // Enviar el correo con el enlace de recuperación
            $updateToken = 'UPDATE registro SET token_request = 1 WHERE Correo = :correo';
            $stmtUpdate = $conexion->prepare($updateToken);
            $stmtUpdate->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
            $stmtUpdate->execute();

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
                    $mail->Host       = 'smtp-mail.outlook.com'; 
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'TecnoODA@outlook.com'; 
                    $mail->Password   = 'holakase123*';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                    $mail->Port       = 587;
                    $mail->CharSet = 'utf8'; 
                
                    // Destinatario y contenido del correo
                    $mail->setFrom('TecnoODA@outlook.com', 'TecnoODA');
                    $mail->addAddress($verificarCorreo);
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperación de contraseña';
                    $mail->Body    = '<center><div style="text-align:center;"><div style=" background-color: #17202a; padding: 20px; border-radius: 10px; max-width: 400px; width: 8000px; text-align: center;">
                    <div style="font-size: 24px; font-weight: bold; margin-bottom: 10px; color:white;">Tecno O.D.A</div>
                    <p style="color:white;">Este es el correo para la solicitud que pediste para cambiar tu contraseña:</p>
                    <div style=" background-color: #566573; font-size: 24px; font-weight: bold; margin-top: 10px;"> <a href="http://localhost/TecnoODA/View/CambioDeContraseña.php?id=' . $userId . '">Recuperación de contraseña</a></div>
                    <div style="margin-top: 20px; text-align: left;">
                    </div>

                    </div>
                    </center>
                   ';
                
                    // Enviar el correo
                    $mail->send();
                    echo "<script>alert('Correo enviado con éxito');</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Error al enviar el correo: " . $mail->ErrorInfo . "');</script>";
                }
            } else {
                echo "<script>alert('Error al recuperar el ID de usuario');</script>";
            }
        } else {
            echo "<script>alert('Correo no válido');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error en la base de datos: " . $e->getMessage() . "');</script>";
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
            <input type="email" name="Verificacion" placeholder="Correo Electrónico" required>
            <br>
            <button type="submit">Aceptar</button>
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
