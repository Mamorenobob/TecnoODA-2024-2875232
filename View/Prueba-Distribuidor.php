<?php
    session_start();
    require '../View/cortina.php';
    //require '../View/Header.php';
    require '../Controller/conexion.php';

    // Verificar si el usuario no está autenticado
    if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 1)) {
        echo "<script>
                alert('No puedes acceder aquí. Debes iniciar sesión.');
                window.location = 'index.php';
              </script>";
        exit();
    }
    

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribución de Tecnología</title>
    <link rel="stylesheet" href="../Model/Css/D-Style.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <label class="nav-item active">
                        <a class="nav-link" href="../View/cerrar_sesion.php">Cerrar Sersion</a>
                    </label>
    </header>
    <main>
        <section id="EMPRESA 1">
            <h2>EMPRESA 1</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="../Images/1.png" alt="Imagen del producto">
        </section>
        <section id="EMPRESA 2">
            <h2>EMPRESA 2</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="../Images/1.png" alt="Imagen del producto">
        </section>
        <section id="EMPRESA 3">
            <h2>EMPRESA 3</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="../Images/1.png" alt="Imagen del producto">
        </section>
        <section id="EMPRESA 4">
            <h2>EMPRESA 4</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="../Images/1.png" alt="Imagen del producto">
        </section>
    </main>
    <footer>
        <div class="cart-button-container">
          <img src="../Images/car.png" alt="Imagen del carrito de envío" class="button" id="cart-button">
        </div>
<footer>
    <form id="request-form" action="procesar_formulario2.php" method="POST" style="display: block; text-align: center; color: #000;">
        <h2>Solicitar productos</h2>
        <div class="form-group">
            <label for="empresa">Empresa:</label>
            <select id="empresa" name="empresa">
                <option value="">Seleccione una empresa</option>
                <option value="Empresa 1">Empresa 1</option>
                <option value="Empresa 2">Empresa 2</option>
                <option value="Empresa 3">Empresa 3</option>
                <option value="Empresa 4">Empresa 4</option>
            </select><br><br>
            <label for="Nombre">Nombre del producto:</label>
            <input type="text" id="productName" name="productName"><br><br>
            <label for="marca">Marca del producto:</label>
            <input type="text" id="marca" name="marca"><br><br>
            <label for="codigo">Codigo:</label>
            <input type="number" id="codigo" name="codigo"><br><br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad"><br><br>
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor"><br><br>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"><br><br>
            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion"><br><br>
            <label for="proveedor">Proveedor:</label>
            <input type="text" id="proveedor" name="proveedor"><br><br>
            <button type="submit" id="submitBtn" name="enviar">Enviar</button>
            <script src="Solicitudes.js"></script>
        </div>
    </form>
</footer>
    <script>
        document.getElementById("cart-button").addEventListener("click", function() {
            document.getElementById("request-form").style.display = "block";
        });
    </script>
</body>
</html>
<?php
    require '../View/Footer.php';
?>