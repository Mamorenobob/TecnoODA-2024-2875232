<?php
    session_start();

    if(!isset($_SESSION['Usuario'])){
        echo'
            <script>
                alert("Por favor debes inicar sesion");
                window.location = "LoginRegister.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Model/Css/styleD.css">
    <link rel="icon" href="imagenes/logo.png">
    <title>Tecno ODA</title>
</head>
<body>
    <header id="arriba" class="parallax">
        <div id="header-img">
            <img src="../Images/logo.png">
            </style>
    
        </div>
            <div class="exp-text">
            <div>
                <h1>Tecno ODA</h1>
                <h3>2024</h3>
            </div>
        
        </div >  
        <div id="header-img">
        <img src="../Images/14.gif" alt="" style="float: right;">
        </div>
       
    </header>
    




    <nav id="menu">
        <ul>
            <li><a href="#menu">&#9776;</a></li>
            <li><a href="#">x</a></li>
            <li><a href="#productos">Productos</a></li>
            <li><a href="../View/cerrar_sesion.php"><button>Cerrar Sesion</button></a></li>
        </ul>
    </nav>




   
    </div>




    <aside id="educacion">
        <br>
        <hr>
        <ul>
            <li>
                <article>
                    <div class="edu-img">
                        <img src="imagenes/Producto1.jpeg">
                    </div>
                    <div class="edu-text">
                        <p class="periodo">Tipo de producto</p>
                        <p class="titulo">Producto</p>
                        <p class="descripcion">descripcion</p>
                    </div>
                </article>
            </li>  




            <li>
                <article>
                    <div class="edu-img">
                        <img src="imagenes/producto2.jpeg">
                    </div>
                    <div class="edu-text">
                        <p class="periodo">Tipo de producto</p>
                        <p class="titulo">Producto</p>
                        <p class="descripcion">descripcion</p>
                    </div>
                </article>
            </li>  




            <li>
                <article>
                    <div class="edu-img">
                        <img src="imagenes/producto3.jpeg">
                    </div>
                    <div class="edu-text">
                        <p class="periodo">Tipo de producto</p>
                        <p class="titulo">Producto</p>
                        <p class="descripcion">descripcion</p>
                    </div>
                </article>
            </li>  




            <li>
                <article>
                    <div class="edu-img">
                        <img src="imagenes/producto4.jpeg">
                    </div>
                    <div class="edu-text">
                        <p class="periodo">Tipo de producto</p>
                        <p class="titulo">Producto</p>
                        <p class="descripcion">descripcion</p>
                    </div>
                </article>
            </li>  




            <li>
                <article>
                    <div class="edu-img">
                        <img src="imagenes/producto5.jpeg">
                    </div>
                    <div class="edu-text">
                        <p class="periodo">Tipo de producto</p>
                        <p class="titulo">Producto</p>
                        <p class="descripcion">descripcion</p>
                    </div>
                </article>
            </li>  
        </ul>
    </aside>
    
        



     </section>
      
      
                </article>              
            </li>                                  
        </ul>
    </div>


