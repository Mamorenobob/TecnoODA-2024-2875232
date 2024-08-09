<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../Model/Css/Style2.css">
</head>
<body>
    <header>
        <nav>
            <a href="../View/LoginRegister.php" target="_blank">
                <button style="background-color: #337ab7; color: #fff; padding: 20px 30px; border: none; border-radius: 80px; cursor:pointer">Registrate aqui</button>
              </a>
        </nav>
    </header>
    <main>
    
        <section class="descripcion">
            <div class="slider-container">
                <div class="slider-item">
                    <img src="../Images/logo.png" alt="Imagen 1">
                    <h2>Bienvenido a nuestra aplicacion</h2>
                    <p>Somos TECNO O.D.A un aplicativo que se caracteriza por mejorar la facilidad a la hora de generar solicitudes de equipos tecnologicos necesarios.</p>
                </div>
                <div class="slider-item">
                    <img src="../Images/logo.png" alt="Imagen 2">
                    <h2>Descripcion de productos</h2>
                    <p> Ayudamos a la eficacia tanto del proveedor como del usuario, siendo nosotros intermediarios para su soliciitud y brindar la mejor experiencia posible.</p>
                </div>
        
    </main>
    <script>
        let sliderIndex = 0;
        const sliderItems = document.querySelectorAll(".slider-item");

        function slideNext() {
            sliderIndex = (sliderIndex + 1) % sliderItems.length;
            updateSlider();
        }

        function updateSlider() {
            sliderItems.forEach((item, index) => {
                if (index === sliderIndex) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }

        function mostrarLogin() {
            document.getElementById("formulario-login").style.display = "block";
        }

        // Inicializar el slider
        updateSlider();
        setInterval(slideNext, 3000); // Cambiar imagen cada 3 segundos
    </script>
</body>
<?php
    require '../View/Footer.php';
?>
</html>