<?php 
    session_start();

    include '../Controller/conexion.php';

    $Usuario = $_POST["Usuario"];
    $contrasena = $_POST["contrasenia"];
    $cargo = $_POST["cargo"];

    $validar_login = mysqli_query($conexion, "SELECT * FROM registro WHERE Cargo ='$cargo' AND Contrasenia = '$contrasena' AND Usuario ='$Usuario' OR Correo = '$Usuario'");
    if (mysqli_num_rows($validar_login) > 0){
        $_SESSION['Usuario'] = $Usuario;
        header("location: bienvenido.php");
        exit();
    }
    else{
        echo "<script>
        alert('Usuario incorrecto, por favor verifique los datos ingresados');
        window.location = 'index.php';
        </script>";
        exit();
    }
?>