<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../Model/Css/Style2.css">
    <link rel="stylesheet" href="../Model/Css/index.css">
    <script src="../Model/JavaScript/index.js"></script>
    <style>
            header{
        width: 100%;
        height: 100px;
        margin: 0;
        backdrop-filter: blur(10px);
        background-color: rgba(333, 333, 333, 0.5);
        
    }
    img{
        width: 80px;
        margin: 10px;
        border-radius: 50px;
        
    }
    header button {
    margin-right: 20px;
    background-color: #337ab7; 
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
</head>
<body>
<header>
    <img src="../Images/logo.png" alt="Logo" class="logo-header">
    <nav style="display: flex; justify-content: flex-end; align-items: center;">
    <a href="../View/LoginRegister.php" target="_blank">
        <button style="background-color: #337ab7; color: #fff; padding: 10px 20px; border: none; border-radius: 50px; margin: 10px;">Registrate aqui</button>
    </a>
</nav>
</style>
</header>
    <main>
            <div class="carousel">
        <div class="carousel-images">
            <div class="carousel-item">
                <img src="../Images/carrusel/img1.jpg" alt="Imagen 1">
                <div class="text-overlay">Texto 1</div>
            </div>
            <div class="carousel-item">
                <img src="../Images/carrusel/img2.jpg" alt="Imagen 2">
                <div class="text-overlay">Texto 2</div>
            </div>
            <div class="carousel-item">
                <img src="../Images/carrusel/img3.jpg" alt="Imagen 3">
                <div class="text-overlay">Texto 3</div>
            </div>
            <div class="carousel-item">
                <img src="../Images/carrusel/img4.jpg" alt="Imagen 4">
                <div class="text-overlay">Texto 4</div>
            </div>
            <div class="carousel-item">
                <img src="../Images/carrusel/img5.jpg" alt="Imagen 5">
                <div class="text-overlay">Texto 5</div>
            </div>
            <div class="carousel-item">
                <img src="../Images/carrusel/img6.jpg" alt="Imagen 6">
                <div class="text-overlay">Texto 6</div>
            </div>
            <div class="carousel-item">
                <img src="../Images/carrusel/img7.jpg" alt="Imagen 7">
                <div class="text-overlay">Texto 7</div>
            </div>
        </div>
        <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
        <a class="next" onclick="moveSlide(1)">&#10095;</a>
    </div>

    <script src="script.js"></script>
    </main>
</body>
<?php
    require '../View/Footer.php';
?>
</html>