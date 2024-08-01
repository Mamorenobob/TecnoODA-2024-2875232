
<?php
include '../Controller/conexion.php';

$cargo = $_POST["Cargo"];
$nombre = $_POST["Nombre"];
$apellido = $_POST["Apellido"];
$usuario = $_POST["Usuario"];
$tipo_doc = $_POST["Tipo_Doc"];
$num_doc = $_POST["Num_Doc"];
$correo = $_POST["Correo"];
$tel = $_POST["Tel"];
$pw = $_POST["pw"];

// Verificar si el correo ya existe en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM registro WHERE Correo = '$correo'");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo "<script>
        alert('Este correo ya está registrado, intenta con otro diferente');
        window.location = 'index.php';
    </script>";
    exit();
}
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM registro WHERE Usuario = '$usuario'");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo "<script>
        alert('Este usuario ya está registrado, intenta con otro diferente');
        window.location = 'index.php';
    </script>";
    exit();
}
$verificar_documento = mysqli_query($conexion, "SELECT * FROM registro WHERE Num_Doc = '$num_doc'");
$verificar_tipo = mysqli_query($conexion, "SELECT * FROM registro WHERE Tipo_Doc = '$tipo_doc'");
if(mysqli_num_rows($verificar_documento) > 0 && mysqli_num_rows($verificar_tipo) > 0){
    echo "<script>
        alert('Este numero y tipo de documento ya está registrado');
        window.location = 'index.php';
    </script>";
exit();
}


// Si el correo no existe, procedemos a insertar el nuevo registro
$guardar = "INSERT INTO registro (Cargo, Usuario, P_Nombre, P_Apellido, Tipo_Doc, Num_Doc, Correo, Telefono, Contrasenia) VALUES ('$cargo', '$usuario', '$nombre', '$apellido', '$tipo_doc', '$num_doc', '$correo', '$tel', '$pw')"; 
$ejecutar = mysqli_query($conexion, $guardar);

if ($ejecutar) {
    echo "<script>
            window.location = 'index.php';
        alert('Usuario registrado exitosamente');
    </script>";
} else {
    echo "<script>
    window.location = 'index.php';
alert('Intentelo nuevamente, No fuiste registrado');
</script>";
}
mysqli_close($conexion);
?>
