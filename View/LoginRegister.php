<?php
    session_start();
    require '../View/cortina.php';
    require '../View/Header.php';
    require '../Controller/conexion.php';
    $db = new Database();
    $conexion = $db->conectar();
    if($conexion === null){
        die("Error de la conexion a la base de datos");
    }
    
    if(isset($_SESSION['Usuario'])){
        header("location:PaginaPrincipal.php");
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
    <title>Login-Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
</head>
<body>
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
                       <img id="imagenOjo1" src="../Images/OjoCerrado.jpeg" height="10%" width="5%" 
                        style="position: absolute; top: 59%; right: 10px; transform: translateY(-50%); cursor: pointer;"
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
                       <img id="imagenOjo" src="../Images/OjoCerrado.jpeg" height="40px" width="5px" 
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