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
    header("location:PaginaPrincipal.php");
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
        .contenedor_todo{
            background-color: white;
            width: 380px;
            height: 450px;
            border-radius: 15px;
            text-align: center;
            margin: 10px;
        }
        .contenedor_todo form input{
            width: 80%;
            margin-top: 20px;
            padding: 10px;
            border: none;
            top: 45%;
            background: #f2f2f2;
            font-size: 16px;
            outline: none;

        }   
        .contenedor_todo form button{
        padding: 10px 40px;
        margin-top: 40px;
        border: none;
        font-size: 14px;
        background: #46A2FD;
        color: white;
        cursor: pointer;
        outline: none;
    }
        .contenedor_todo form h1{
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
            <h1>
                Recuperar Contraseña
            </h1>
            <input type="email" name="Verificacion" id="" placeholder="Correo Electronico">
            <br>
            <input type="password" name="pw" id="" placeholder="Nueva Contraseña">
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
// Conexión a la base de datos (asegúrate de definir la variable $conexion)

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el correo y la nueva contraseña del formulario
    $verificarCorreo = $_POST['Verificacion'];
    $nuevaPassword = $_POST['pw'];

    // Preparar la consulta para verificar si el correo existe
    $queryEmail = 'SELECT Correo FROM registro WHERE Correo = :correo';
    $stmtQuery = $conexion->prepare($queryEmail);
    $stmtQuery->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
    $stmtQuery->execute();
    $resultadoEmail = $stmtQuery->fetch(PDO::FETCH_ASSOC);

    // Verificar si el correo existe en la base de datos
    if ($resultadoEmail) {
        // Preparar la consulta para actualizar el token_password y token_request
        $updateToken = 'UPDATE registro SET token_password = :token_password, token_request = 1 WHERE Correo = :correo';
        $stmtUpdate = $conexion->prepare($updateToken);
        $stmtUpdate->bindParam(':token_password', $nuevaPassword, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
        $stmtUpdate->execute();
        echo "<script>
                alert('Correo enviado con éxito');
              </script>";

    } else {
        echo "<script>
                alert('Correo no válido');
              </script>";
    }
}
?>
   <!--           // Definir la consulta para obtener el token_request
              $token_request = 'SELECT token_request FROM registro WHERE Correo = :correo';
              $stmtRequest = $conexion->prepare($token_request);
              $stmtRequest->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
              
              // Ejecutar la consulta
              $stmtRequest->execute();
              
              // Obtener el resultado
              $resultado = $stmtRequest->fetchColumn(); // Esto obtiene el valor de la primera columna del primer registro

              if ($resultado == 1) {
                try {
                    // Actualizar los campos en la base de datos
                    $ChangePw = 'UPDATE registro 
                                 SET Contrasenia = (SELECT token_password FROM registro WHERE Correo = :correo), 
                                     token_password = NULL, 
                                     token_request = 0 
                                 WHERE Correo = :correo';
                                 
                    $stmtChange = $conexion->prepare($ChangePw);
                    
                    // Enlazar el parámetro del correo
                    $stmtChange->bindParam(':correo', $verificarCorreo, PDO::PARAM_STR);
                    
                    // Ejecutar la consulta
                    $stmtChange->execute();
                    
                    echo "<script>
                           alert('Contraseña cambiada exitosamente');
                       </script>";
                } catch (PDOException $e) {
                    echo "<script>
                           alert('Error: " . $e->getMessage() . "');
                          </script>";
                }
            }