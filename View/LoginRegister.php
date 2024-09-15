<?php
    session_start();
    
    // Verificar si la sesión ya está activa
    if (isset($_SESSION['Usuario']) && isset($_SESSION['Cargo'])) {
        // Redirigir según el cargo
        switch ($_SESSION['Cargo']) {
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
                header("Location: ../View/P.php");
                break;
            default:
                // Si el cargo no coincide con ninguno de los casos, redirigir a una página predeterminada
                header("Location: ../View/index.php");
                break;
        }
        exit(); // Salir del script después de la redirección
    }    
    require '../View/cortina.php';
    require '../View/Header.php';
    require '../Controller/conexion.php';
    $db = new Database();
    $conexion = $db->conectar();
    if($conexion === null){
        die("Error de la conexion a la base de datos");
    }
    $queryCargo = "SELECT ID, cargo FROM cargo";
    $stmtCargo = $conexion->prepare($queryCargo);
    $stmtCargo->execute();
    $resultCargo = $stmtCargo->fetchAll(PDO::FETCH_ASSOC);

    $queryCargo2 = "SELECT ID, cargo FROM cargo";
    $stmtCargo2 = $conexion->prepare($queryCargo2);
    $stmtCargo2->execute();
    $resultCargo2 = $stmtCargo2->fetchAll(PDO::FETCH_ASSOC);

    $queryDoc = "SELECT ID, documento FROM documento";
    $stmtDoc = $conexion->prepare($queryDoc);
    $stmtDoc->execute();
    $resultDoc = $stmtDoc->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <title>Login-Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Model/Css/Style.css">
    <style>
        /* Ocultar los botones de incremento/decremento en los inputs de tipo number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
}
    </style>
        <div id="header-img">
        <img src="../Images/13.gif" alt="" style="width: 500px; height:auto; float: right; ">
    </div>
</head>
<style>
        /* Estilo para el contenedor de la imagen */
        #header-img {
            margin-bottom: 20px; /* Espacio debajo de la imagen */
            text-align: center; /* Centrar el contenido */
        }

        /* Estilo para los recuadros de texto */
        .message-1 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 650px;   /* Mueve el div 10px hacia abajo */
            left: 1400px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-2 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 600px;   /* Mueve el div 10px hacia abajo */
            left: 1400px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-3 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 700px;   /* Mueve el div 10px hacia abajo */
            left: 1400px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-4 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 750px;   /* Mueve el div 10px hacia abajo */
            left: 1400px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-5 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 800px;   /* Mueve el div 10px hacia abajo */
            left: 1400px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-6 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 850px;   /* Mueve el div 10px hacia abajo */
            left: 1400px;  /* Mueve el div 20px hacia la derecha */
        }
    </style>

<body>
    <!-- Recuadros de información debajo de la imagen -->
<div class="message-1">
    <!-- Contenido del primer cuadro -->
    <p></p>
</div>
<div class="message-2">
    <!-- Contenido del segundo cuadro -->
    <p></p>
</div>
<div class="message-3">
    <!-- Contenido del primer cuadro -->
    <p></p>
</div>
<div class="message-4">
    <!-- Contenido del segundo cuadro -->
    <p></p>
</div>
<div class="message-5">
    <!-- Contenido del segundo cuadro -->
    <p></p>
</div>
<div class="message-6">
    <!-- Contenido del segundo cuadro -->
    <p></p>
</div>
    <main>

        <div class="contenedorTodo">

            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesion para entrar en la pagina</p>
                    <button id="btn-login">Iniciar Sesion</button>
                </div>
                <div class="caja_trasera-register">
                    <h3>¿Aun no tienes cuenta?</h3>
                    <p>Registrate para que puedas iniciar sesion</p>
                    <button id="btn-register">Registrarse</button>
                </div>
            </div>
            <div class="contenedor-login-register">
                <form action="login.php" class="formulario__login" method="POST">
                    <h2>Iniciar Sesion</h2>
                    <select name="cargo" required style="cursor: pointer;">
                        <option value="" selected disabled>Cargo</option>
                        <?php foreach ($resultCargo as $rowCargo): ?>
                            <option value="<?php echo htmlspecialchars($rowCargo['ID']); ?>"><?php echo htmlspecialchars($rowCargo['cargo']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text"  name="Usuario" placeholder="Usuario/Correo Electronico" required>
                    <div class="pw">
                       <input type="password" name="contrasenia" id="contrasena" placeholder="Contraseña" required autocomplete="off">
                       <img id="imagenOjo1" src="../Images/OjoCerrado.jpeg" height="8%" width="5%" 
                        style="position: absolute; top: 56%; right: 10px; transform: translateY(-50%); cursor: pointer;"
                        onmousedown="mostrarContrasena()" 
                        onmouseup="ocultarContrasena()">
                    </div>
                    <button>Iniciar Sesion</button>
                    <a href="RecuperarContraseña.php"><h4>Restablecer contraseña</h4></a>
                </form>
                <form method="POST" action="registro.php" class="formulario__register">
                    <h2>Registrarse</h2>
                    <select name="Cargo" required style="cursor: pointer;">
                        <option value="" selected disabled>Cargo</option>
                        <?php foreach ($resultCargo2 as $rowCargo2): ?>
                            <option value="<?php echo htmlspecialchars($rowCargo2['ID']); ?>"><?php echo htmlspecialchars($rowCargo2['cargo']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name="Nombre" placeholder="Primer Nombre" required>
                    <input type="text" name="Apellido" placeholder="Primer Apellido" required>
                    <input type="text" name="Usuario" placeholder="Usuario" required>
                    <select name="Tipo_Doc" required style="cursor: pointer;">
                        <option value="" selected disabled>Tipo de Documento</option>
                        <?php foreach ($resultDoc as $rowDoc): ?>
                            <option value="<?php echo htmlspecialchars($rowDoc['ID']); ?>"><?php echo htmlspecialchars($rowDoc['documento']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="Num_Doc" placeholder="Numero de Documento" step="any" required>
                    <input type="email" name="Correo" placeholder="Correo Electrónico" required>
                    <input type="number" name="Tel" placeholder="Teléfono" required>
                    <div class="pw">
                       <input type="password" name="pw" id="contrasena1" placeholder="Contraseña" required autocomplete="off">
                       <img id="imagenOjo" src="../Images/OjoCerrado.jpeg" height="8%" width="5%"
                        style="position: absolute; top: 77.5%; right: 10px; transform: translateY(-50%); cursor: pointer;"
                        onmousedown="mostrarContrasena()" 
                        onmouseup="ocultarContrasena()">
                    </div>
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <br><br><br><br><br>    <br><br><br><br><br>    <br><br><br><br><br>    <br><br><br><br><br>    <br><br><br><br><br>
    <footer>
        <?php
            require '../View/Footer.php';
        ?>
    </footer>
    <script src="../Model/JavaScript/Script.js"></script>
</body>
</html>
<script>
    let contrasenaInput = document.getElementById("contrasena");
    let contrasenaInput1 = document.getElementById("contrasena1");
    let imagenOjo = document.getElementById("imagenOjo");
    let imagenOjo1 = document.getElementById("imagenOjo1");

    function mostrarContrasena() {
        contrasenaInput.type = "text";
        contrasenaInput1.type = "text";
        imagenOjo.src = "../Images/OjoAbierto.jpeg"; // Cambia la imagen al presionar
        imagenOjo1.src = "../Images/OjoAbierto.jpeg";
    }
  
    function ocultarContrasena() {
        contrasenaInput.type = "password";
        contrasenaInput1.type = "password";
        imagenOjo.src = "../Images/OjoCerrado.jpeg"; // Cambia la imagen al soltar
        imagenOjo1.src = "../Images/OjoCerrado.jpeg";
}
</script>
<?php
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
                    header("Location: ../View/P.php");
                    break;
                default:
                    // Si el cargo no coincide con ninguno de los casos, redirigir a una página de error o predeterminada
                    header("Location: ../View/LoginRegister.php");
                    break;
            }
            exit();
        } else {
            // Si el cargo del formulario no coincide con el cargo de la base de datos
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <center><strong>Usuario o contraseña incorrectos</strong></center>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "../View/LoginRegister.php";
                }, 3500); // Retrasa la redirección 3 segundos para que el usuario pueda ver el mensaje
            </script>
             ';
        }
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <center><strong>Usuario o contraseña incorrectos</strong></center>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "../View/LoginRegister.php";
            }, 3500); // Retrasa la redirección 3 segundos para que el usuario pueda ver el mensaje
        </script>
         ';
    }
}
