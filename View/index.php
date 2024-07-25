<?php
    include_once "../TecnoODA/cortina.php";
    include_once "../TecnoODA/Header.php";
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
    <link rel="stylesheet" href="Css/Style.css">
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
                <form action="#" class="formulario__login">
                    <h2>Iniciar Sesion</h2>
                    <select required>
                        <option value="" selected disabled>Cargo</option>
                        <option value="Distribuidor">Distribuidor</option>
                        <option value="Gestor">Gestor</option>
                    </select>
                    <input type="text" placeholder="Usuario/Correo Electronico" required>
                    <input type="password" placeholder="Contraseña" required>
                    <button>Iniciar Sesion</button>
                </form>
                <form action="#" class="formulario__register">
                    <h2>Registrarse</h2>
                    <select required>
                        <option value="" selected disabled>Cargo</option>
                        <option value="Distribuidor">Distribuidor</option>
                        <option value="Gestor">Gestor</option>
                    </select>
                    <input type="text" placeholder="Primer Nombre" required>
                    <input type="text" placeholder="Primer Apellido" required>
                    <input type="text" placeholder="Usuario" required>
                    <select>
                        <option value="" selected dis>Tipo de Documento</option>
                        <option value="#">Tarjeta de Identidad</option>
                        <option value="#">Cedula de Cuidadania</option>
                        <option value="#">Cedula de Extranjeria</option>
                        <option value="#">NUIP</option>
                        <option value="#">Pasaporte</option>                        
                    </select>
                    <input type="text" placeholder="Numero de Documento" pattern="[0-9]" required>
                    <input type="text" placeholder="Correo Electronico" required>
                    <input type="text" placeholder="Telefono" pattern="[0-9]" required>
                    <input type="password" name="" id="" placeholder="Contraseña" required>
                    <button>Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <br><br><br><br><br>    <br><br><br><br><br>    <br><br><br><br><br>    <br><br><br><br><br>    <br><br><br><br><br>
    <footer>
        <?php
        include_once("../TecnoODA/Footer.php");
        ?>
    </footer>
    <script src="JavaScript/Script.js"></script>
</body>
</html>