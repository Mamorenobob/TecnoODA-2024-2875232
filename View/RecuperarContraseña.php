<?php

session_start();
require '../View/cortina.php';
require '../View/Header.php';
require '../Controller/conexion.php';

$db = new Database();
$conexion = $db->conectar();

if ($conexion === null) {
    die("Error de la conexión a la base de datos");
}

if (isset($_SESSION['Usuario'])) {
    header("location:bienvenido.php");
}

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Correo'])) {
    $correo = $_POST['Correo'];

    // Validar el formato del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = 'El formato del correo electrónico es inválido.';
    } else {
        // Preparar la consulta para buscar el correo electrónico
        $sql = "SELECT * FROM registro WHERE Correo = :email";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':email', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Generar un token para la recuperación de contraseña
            $token = bin2hex(random_bytes(50));

            // Guardar el token en la base de datos asociado con el usuario
            $sql = "UPDATE registro SET token_password = :token WHERE Correo = :email";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':email', $correo);
            $stmt->execute();

            // Enviar el correo electrónico
            $to = $correo;
            $subject = 'Recuperación de Contraseña';
            $message = "Haga clic en el siguiente enlace para recuperar su contraseña: \n";
            $message .= "http://tu-dominio.com/recuperar_contraseña.php?token=$token";
            $headers = 'From: no-reply@tu-dominio.com' . "\r\n" .
                       'Reply-To: no-reply@tu-dominio.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

            if (mail($to, $subject, $message, $headers)) {
                $mensaje = 'Se ha enviado un enlace de recuperación de contraseña a su correo electrónico.';
            } else {
                $mensaje = 'No se pudo enviar el correo electrónico. Por favor, intente de nuevo más tarde.';
            }
        } else {
            $mensaje = 'No existe un correo en la base de datos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Incluye tus archivos CSS aquí -->
</head>
<body>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Recuperar Password</div>
                </div>
                <div style="padding-top:30px" class="panel-body">
                    <?php if ($mensaje): ?>
                        <div class="alert <?php echo strpos($mensaje, 'error') !== false ? 'alert-danger' : 'alert-success'; ?> col-sm-12">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php endif; ?>
                    <form id="loginform" class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="email" type="email" class="form-control" name="Correo" placeholder="Correo electrónico" required>
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <button id="btn-login" type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
