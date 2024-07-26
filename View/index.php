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
                    <select name="cargo" required>
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
                    <select name="Cargo" required>
                        <option value="" selected disabled>Cargo</option>
                        <?php
                        while ($rowCargo = mysqli_fetch_assoc($resultCargo)) {
                            echo '<option value="' . $rowCargo['ID'] . '">' . $rowCargo['cargo'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" name="Nombre" placeholder="Primer Nombre" required>
                    <input type="text" name="Apellido" placeholder="Primer Apellido" required>
                    <input type="text" name="Usuario" placeholder="Usuario" required>
                    <select name="Tipo_Doc" required>
                        <option value="" selected disabled>Tipo de Documento</option>
                        <?php
                        while ($rowDoc = mysqli_fetch_assoc($resultDoc)) {
                            echo '<option value="' . $rowDoc['ID'] . '">' . $rowDoc['documento'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="number" name="Num_Doc" placeholder="Número de Documento" pattern="[0-9]" required>
                    <input type="text" name="Correo" placeholder="Correo Electrónico" required>
                    <input type="number" name="Tel" placeholder="Teléfono" pattern="[0-9]" required>
                    <input type="password" name="pw" placeholder="Contraseña" required>
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