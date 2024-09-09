<?php
    session_start();
    require '../View/cortina.php';
    require '../Controller/conexion.php';
    // Verificar si el usuario no está autenticado
    if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 8)) {
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
    <title>Prueba-Proveedor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Model/Css/diseño.css">
</head>
<body>
    <!-- contenido -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Productos Electrónicos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../View/index.php">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="productos-solicitados" href="#">Productos solicitados</a>
                    </li>
                    <label class="nav-item">
                        <a class="nav-link" href="#" id="contactar-tienda" data-toggle="modal" data-target="#modalContacto">Contactar Tienda</a>
                    </label>
                    <li class="nav-item active">
                        <a class="nav-link" href="../View/cerrar_sesion.php">Cerrar Sersion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
    <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="nav-item">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Lista de Tiendas</h2>
                    <ul id="lista-tiendas"></ul>
                    <div id="informacion-tienda"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 style="color: #fcfcfc; font-size: 80px;"class="text-center">Productos Electrónicos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="carrusel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carrusel" data-slide-to="0" class="active"></li>
                            <li data-target="#carrusel" data-slide-to="1"></li>
                            <li data-target="#carrusel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../Images/1.png" class="d-block w-100 img-fluid" style="height: 500px; width: 100%; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Producto 1</h5>
                                <p style="color: #ffffff;">Descripción del producto 1</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../Images/3.png" alt="Producto 2" class="d-block w-100 img-fluid" style="height: 500px; width: 100%; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Producto 2</h5>
                                <p style="color: #ffffff;">Descripción del producto 2</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../Images/2.png" alt="Producto 3" class="d-block w-100 img-fluid" style="height: 500px; width: 100%; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Producto 3</h5>
                                <p style="color: #ffffff;">Descripción del producto 3</p>
                            </div>
                        </div>
                    </div>
                        <a class="carousel-control-prev" href="#carrusel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                            </a>
                        <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                            <span class="sr-only">Siguiente</span>

                            <div id="tabla-productos" style="display: none;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="color: #FFFFFF;">Nombre</th>
                                            <th style="color: #FFFFFF;">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-body" style="color: #00698f;">
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                document.getElementById("productos-solicitados").addEventListener("click", function() {
                                    var tabla = document.getElementById("tabla-productos");
                                    tabla.style.display = "block";
                                    
                                    
                                    var productos = [
                                        { nombre: "Producto 1", cantidad: 10 },
                                        { nombre: "Producto 2", cantidad: 20 },
                                        { nombre: "Producto 3", cantidad: 30 }
                                    ];
                                    
                                    var tablaBody = document.getElementById("tabla-body");
                                    tablaBody.innerHTML = "";
                                    
                                    productos.forEach(function(producto) {
                                        var row = document.createElement("tr");
                                        var nombreCell = document.createElement("td");
                                        var cantidadCell = document.createElement("td");
                                        
                                       
                                        nombreCell.style.color = "#00FF00";
                                        cantidadCell.style.color = "#00FF00"; 
                                        
                                        nombreCell.textContent = producto.nombre;
                                        cantidadCell.textContent = producto.cantidad;
                                        
                                        row.appendChild(nombreCell);
                                        row.appendChild(cantidadCell);
                                        
                                        tablaBody.appendChild(row);
                                    });
                                });
                                // Tabla de productos

                                document.getElementById("contactar-tienda").addEventListener("click", function() {
                                    var tiendas = [
                                        { nombre: "Tienda 1", direccion: "Calle 1", telefono: "123456789", email: "tienda1@gmail.com" },
                                        { nombre: "Tienda 2", direccion: "Calle 2", telefono: "987654321", email: "tienda2@gmail.com" },
                                        { nombre: "Tienda 3", direccion: "Calle 3", telefono: "555555555", email: "tienda3@gmail.com" }
                                    ];
                                    
                                    var listaTiendas = document.getElementById("lista-tiendas");
                                    listaTiendas.innerHTML = "";
                                    
                                    tiendas.forEach(function(tienda) {
                                        var item = document.createElement("li");
                                        item.textContent = tienda.nombre;
                                        item.addEventListener("click", function() {
                                            var informacionTienda = document.getElementById("informacion-tienda");
                                            informacionTienda.innerHTML = "";
                                            informacionTienda.innerHTML = `
                                                <h3>${tienda.nombre}</h3>
                                                <p>Dirección: ${tienda.direccion}</p>
                                                <p>Teléfono: ${tienda.telefono}</p>
                                                <p>Email: ${tienda.email}</p>
                                            `;
                                        });
                                        listaTiendas.appendChild(item);
                                    });
                                });
                            </script>
                                    