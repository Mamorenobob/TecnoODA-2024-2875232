<?php
session_start();
require '../View/cortina.php';
require '../Controller/conexion.php';
require '../View/Header1.php';

$db = new Database();
$conexion = $db->conectar();
if ($conexion === null) {
    die("Error de la conexión a la base de datos");
}

$productosPorPagina = 5;
$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($paginaActual - 1) * $productosPorPagina;

$producto = "SELECT * FROM pedido LIMIT :offset, :productosPorPagina";
$stmt = $conexion->prepare($producto);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':productosPorPagina', $productosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$resul = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener el total de productos para la paginación
$totalProductos = $conexion->query("SELECT COUNT(*) FROM pedido")->fetchColumn();
$totalPaginas = ceil($totalProductos / $productosPorPagina);

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
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <title>Proveedor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Model/Css/diseño.css">
    <style>
        /* Centrar los íconos de paginación */
        .pagination {
            justify-content: center;
        }

        .page-item .page-link {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-item .page-link {
            color: #007bff;
            border: 1px solid #dee2e6;
        }

        .page-item .page-link:hover {
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
    </style>
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
                        <a class="nav-link" id="productos-solicitados">Productos solicitados</a>
                    </li>
                    <label class="nav-item">
                        <a class="nav-link" href="#" id="contactar-tienda" data-toggle="modal" data-target="#modalContacto">Contactar Tienda</a>
                    </label>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
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

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <!-- Aquí puedes agregar cualquier otro contenido que necesites -->
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
                    </div>

                    <div id="tabla-productos" style="display: none;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="color:#3eff27; text-align:center;">Nombre</th>
                                    <th style="color:#3eff27; text-align:center;">Cantidad</th>
                                    <th style="color:#3eff27; text-align:center;">Valor</th>
                                    <th style="color:#3eff27; text-align:center;">Ubicación</th>
                                    <th style="color:#3eff27; text-align:center;">Fecha</th>
                                    <th style="color:#3eff27; text-align:center;">Marca</th>
                                    <th style="color:#3eff27; text-align:center;">Código</th>
                                    <th style="color:#3eff27; text-align:center;">Descripción</th>
                                    <th style="color:#3eff27; text-align:center;">Proveedor</th>
                                    <th style="color:#3eff27; text-align:center;">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-body">
                                <?php foreach ($resul as $pedido): ?>
                                    <tr data-id="<?= htmlspecialchars($pedido['ID']) ?>">
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Nombre']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Cantidad']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Valor']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Ubicacion']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Fecha']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Marca']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Codigo']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Descripcion']) ?></td>
                                        <td style="color:#3eff27; text-align:center;"><?= htmlspecialchars($pedido['Proveedor']) ?></td>
                                        <td>
                                            <button class="btn btn-success aceptar-btn">Aceptar</button>
                                            <button class="btn btn-danger rechazar-btn">Rechazar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Navegación de Paginación -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php if ($paginaActual > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=1" aria-label="First">
                                            <span aria-hidden="true">Primera</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?= $paginaActual - 1 ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                    <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
                                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($paginaActual < $totalPaginas): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?= $paginaActual + 1 ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?= $totalPaginas ?>" aria-label="Last">
                                            <span aria-hidden="true">Última</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mostrar productos solicitados
            document.getElementById("productos-solicitados").addEventListener("click", function() {
                var tabla = document.getElementById("tabla-productos");
                tabla.style.display = "block";
            });

            // Agregar eventos a los botones de aceptar y rechazar
            document.querySelectorAll('.aceptar-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var row = this.closest('tr');
                    var id = row.getAttribute('data-id');

                    if (confirm("¿Estás seguro de que deseas aceptar este pedido?")) {
                        // Llamada AJAX para aceptar el pedido
                        fetch('procesar_pedido.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `id=${id}&accion=aceptar`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Pedido aceptado.");
                                row.remove();
                            } else {
                                alert("Error al aceptar el pedido.");
                            }
                        });
                    }
                });
            });

            document.querySelectorAll('.rechazar-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var row = this.closest('tr');
                    var id = row.getAttribute('data-id');

                    if (confirm("¿Estás seguro de que deseas rechazar este pedido?")) {
                        // Llamada AJAX para rechazar el pedido
                        fetch('procesar_pedido.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `id=${id}&accion=rechazar`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Pedido rechazado.");
                                row.remove();
                            } else {
                                alert("Error al rechazar el pedido.");
                            }
                        });
                    }
                });
            });
        });
    </script>
    <br><br><br>
</body>
</html>
<?php

require '../View/Footer.php';
?>
