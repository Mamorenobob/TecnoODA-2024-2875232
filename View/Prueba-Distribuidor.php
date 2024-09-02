<?php
    session_start();
    require '../View/cortina.php';
    require '../View/Header.php';
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
    <link rel="stylesheet" href="D-Style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <label><a href="#">EMPRESA 1</a></label>
                <label><a href="#">EMPRESA 2</a></label>
                <label><a href="#">EMPRESA 3</a></label>
                <label><a href="#">EMPRESA 4</a></label>
            </ul>
        </nav>
    </header>
    <main>
        <section id="EMPRESA 1">
            <h2>EMPRESA 1</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="Images/1.png" alt="Imagen del producto">
        </section>
        <section id="EMPRESA 2">
            <h2>EMPRESA 2</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="Images/1.png" alt="Imagen del producto">
        </section>
        <section id="EMPRESA 3">
            <h2>EMPRESA 3</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="Images/1.png" alt="Imagen del producto">
        </section>
        <section id="EMPRESA 4">
            <h2>EMPRESA 4</h2>
            <p>Informacion del producto y vista previa.</p>
            <img src="Images/1.png" alt="Imagen del producto">
        </section>
    </main>
    <footer>
        <div class="cart-button-container">
          <img src="Images/car.png" alt="Imagen del carrito de envío" class="button" id="cart-button">
        </div>
      </footer>
        <form id="request-form" style="display: none; text-align: center; color: #000;">
            <h2>Solicitar productos</h2>
            <label for="product-name">Nombre del producto:</label>
            <input type="text" id="product-name" name="product-name"><br><br>
            <label for="quantity">Cantidad:</label>
            <input type="number" id="quantity" name="quantity"><br><br>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email"><br><br>
            <input type="submit" value="Enviar solicitud">
        </form>
    </footer>
    <script>
        document.getElementById("cart-button").addEventListener("click", function() {
            document.getElementById("request-form").style.display = "block";
        });
    </script>
</body>
</html>