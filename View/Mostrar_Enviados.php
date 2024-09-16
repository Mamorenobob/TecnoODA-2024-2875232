<?php
session_start();
require '../View/cortina.php';
require '../Controller/conexion.php';
require '../View/Header1.php';

$db = new Database();
$conexion = $db->conectar();
if ($conexion === null) {
    die("Error de conexión a la base de datos");
}

if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 1)) {
    echo "<script>
            alert('No puedes acceder aquí. Debes iniciar sesión.');
            window.location = 'index.php';
          </script>";
    exit();
}

// Configuración de la paginación
$productosPorPagina = 5;
$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($paginaActual - 1) * $productosPorPagina;

// Consulta SQL para obtener los datos paginados
$sql = "SELECT * FROM enviado LIMIT :offset, :productosPorPagina";
$stmt = $conexion->prepare($sql);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':productosPorPagina', $productosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$enviados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener el total de productos para la paginación
$totalEnviados = $conexion->query("SELECT COUNT(*) FROM enviado")->fetchColumn();
$totalPaginas = ceil($totalEnviados / $productosPorPagina);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <link rel="stylesheet" href="../Model/Css/CSS_Admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
    <title>Pedidos Enviados</title>
    <style>
        .estado-verde {
            background-color: #d4edda;
            color: #155724;
        }
        .estado-rojo {
            background-color: #f8d7da;
            color: #721c24;
        }
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
    <nav class="navbar container">
        <i class="fa-solid fa-bars"></i>
        <ul class="menu">
            <li><a href="#">Productos Enviados</a></li>
            <li><a href="../View/Prueba-Distribuidor.php">Regresar al Inicio</a></li>
        </ul>
    </nav>

    <main>
        <div class="container mt-4">
            <h2 class="text-center" style="text-align:center; font-size:25px;">Pedidos Enviados</h2>
            <table class="table table-striped" style="text-align:center; position:relative; top:250px; left:-5px;">
                <thead>
                    <tr>
                        <th style="text-align:center; color:white;">Nombre</th>
                        <th style="text-align:center; color:white;">Cantidad</th>
                        <th style="text-align:center; color:white;">Valor</th>
                        <th style="text-align:center; color:white;">Ubicación</th>
                        <th style="text-align:center; color:white;">Fecha</th>
                        <th style="text-align:center; color:white;">Marca</th>
                        <th style="text-align:center; color:white;">Código</th>
                        <th style="text-align:center; color:white;">Descripción</th>
                        <th style="text-align:center; color:white;">Proveedor</th>
                        <th style="text-align:center; color:white;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enviados as $enviado): ?>
                        <tr class="<?= $enviado['estado_id'] == 1 ? 'estado-verde' : 'estado-rojo' ?>">
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Nombre']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Cantidad']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Valor']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Ubicacion']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Fecha']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Marca']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Codigo']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Descripcion']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= htmlspecialchars($enviado['Proveedor']) ?></td>
                            <td style="text-align:center; color:#5d6d7e;"><?= $enviado['estado_id'] == 1 ? 'Aceptado' : 'Rechazado' ?></td>
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
    </main>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
