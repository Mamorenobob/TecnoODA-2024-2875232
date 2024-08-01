<?php
    session_start();
    if(isset($_SESSION['Usuario'])){
        header("location:bienvenido.php");
    }
    include_once "../View/cortina.php";
    include_once "../View/Header.php";
    include '../Controller/conexion.php';
    $queryCargo = "SELECT ID, cargo FROM cargo";
    $resultCargo = mysqli_query($conexion, $queryCargo);
    $queryCargo2 = "SELECT ID, cargo FROM cargo";
    $resultCargo2 = mysqli_query($conexion, $queryCargo2);
    
    $queryDoc = "SELECT ID, documento FROM documento";
    $resultDoc = mysqli_query($conexion, $queryDoc);
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
                        <?php
                        while ($rowCargo = mysqli_fetch_assoc($resultCargo)) {
                            echo '<option value="' . $rowCargo['ID'] . '">' . $rowCargo['cargo'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text"  name="Usuario" placeholder="Usuario/Correo Electronico" required>
                    <input type="password" name="contrasenia" placeholder="Contraseña" required>
                    <button>Iniciar Sesion</button>
                </form>
                <form method="POST" action="registro.php" class="formulario__register">
                    <h2>Registrarse</h2>
                    <select name="Cargo" required style="cursor: pointer;">
                        <option value="" selected disabled>Cargo</option>
                        <?php
                        while ($rowCargo2 = mysqli_fetch_assoc($resultCargo2)) {
                            echo '<option value="' . $rowCargo2['ID'] . '">' . $rowCargo2['cargo'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" name="Nombre" placeholder="Primer Nombre" required>
                    <input type="text" name="Apellido" placeholder="Primer Apellido" required>
                    <input type="text" name="Usuario" placeholder="Usuario" required>
                    <select name="Tipo_Doc" required style="cursor: pointer;">
                        <option value="" selected disabled>Tipo de Documento</option>
                        <?php
                        while ($rowDoc = mysqli_fetch_assoc($resultDoc)) {
                            echo '<option value="' . $rowDoc['ID'] . '">' . $rowDoc['documento'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="number" name="Num_Doc" placeholder="Numero de Documento" step="any" required>
                    <input type="email" name="Correo" placeholder="Correo Electrónico" required>
                    <input type="number" name="Tel" placeholder="Teléfono" required>
                    <div class="pw">
                       <input type="password" name="pw" id="contrasena" placeholder="Contraseña" required autocomplete="off">
                       <img id="imagenOjo" src="../Images/" 
                        style=" height: 40px;; width:5px;position: absolute; top: 77.5%; right: 10px; transform: translateY(-50%); cursor: pointer;"
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
        include_once("../View/Footer.php");
        ?>
    </footer>
    <script src="../Model/JavaScript/Script.js"></script>
</body>
</html>
<script>
    let contrasenaInput = document.getElementById("contrasena");
    let imagenOjo = document.getElementById("imagenOjo");

    function mostrarContrasena() {
        contrasenaInput.type = "text";
        imagenOjo.src = "Images/OjoAbierto.jpeg"; // Cambia la imagen al presionar
    }
  
    function ocultarContrasena() {
        contrasenaInput.type = "password";
        imagenOjo.src = "Images/OjoCerrado.jpeg"; // Cambia la imagen al soltar
}
</script>