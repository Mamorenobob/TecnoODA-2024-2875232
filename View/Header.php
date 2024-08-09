<style>
    .header{
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
</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Cuadros de Información</title>
    <style>
        /* Estilo para el contenedor de la imagen */
        #header-img {
            
            text-align: center; /* Centrar el contenido */
        }

        /* Estilo para los recuadros de texto */
        .message-box {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 20%; /* Anchura del recuadro */
            text-align: s right; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 800px;
        }
    </style>
</head>
<body>

 <div id="header-img">
        <img src="../Images/13.gif" alt="" style="width: 500px; height:auto; float: right; ">
    </div>

<!-- Recuadros de información debajo de la imagen -->
<div class="message-box">
    <!-- Contenido del primer cuadro -->
    <p>Este es el primer mensaje que aparece en el primer cuadro.</p>
</div>
<div class="message-box">
    <!-- Contenido del segundo cuadro -->
    <p>Este es el segundo mensaje que aparece en el segundo cuadro.</p>
</div>

</body>
</html>

