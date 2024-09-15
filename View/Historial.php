<?php
session_start();
require '../View/cortina.php';
require '../Controller/conexion.php';

// Conectar a la base de datos
$db = new Database();
$conexion = $db->conectar();

// Definir la cantidad de registros por página
$registrosPorPagina = 10;

// Obtener la página actual
$paginacionPagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$paginacionPagina = max($paginacionPagina, 1); // Asegurarse de que la página sea al menos 1

// Calcular el desplazamiento
$inicio = ($paginacionPagina - 1) * $registrosPorPagina;

// Obtener el término de búsqueda (por defecto es una cadena vacía)
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Consulta SQL con filtrado y LIMIT para la paginación
$sql = "SELECT h.*, e.descripcion AS estado_descripcion
        FROM historial h
        JOIN estado e ON h.estado_id = e.id
        WHERE h.Nombre LIKE :searchTerm
        LIMIT :inicio, :registrosPorPagina";

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($sql);
$stmt->bindValue(':searchTerm', "%$searchTerm%");
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener el total de registros para la paginación
$sqlTotal = "SELECT COUNT(*) AS total
             FROM historial h
             JOIN estado e ON h.estado_id = e.id
             WHERE h.Nombre LIKE :searchTerm";
$stmtTotal = $conexion->prepare($sqlTotal);
$stmtTotal->bindValue(':searchTerm', "%$searchTerm%");
$stmtTotal->execute();
$totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

// Calcular el total de páginas
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Verificar si el usuario está autenticado
if (!isset($_SESSION['Usuario']) || $_SESSION['Cargo'] != 9) {
    echo "<script>
            alert('No puedes acceder aquí. Debes iniciar sesión.');
            window.location = 'index.php';
          </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <title>Historial</title>
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="../Model/Css/CSS_Admin.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilos de estado */
        .estado-aprobado {
            background-color: #d4edda; /* Verde claro */
        }
        .estado-rechazado {
            background-color: #f8d7da; /* Rojo claro */
        }
        /* Estilos generales del contenedor */
        .container-features {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 auto;
            padding: 20px;
        }
        /* Estilos de la tabla */
        table {
            width: 100%;
            max-width: 1200px;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        /* Estilos de paginación */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 10px 15px;
            margin: 0 5px;
            text-decoration: none;
            color: #337ab7;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .pagination a:hover {
            background-color: #f0f0f0;
        }
        .pagination .active {
            background-color: #337ab7;
            color: #fff;
            border: 1px solid #337ab7;
        }
        .pagination .disabled {
            color: #ccc;
            cursor: not-allowed;
        }
        /* Estilos del título */
        .title {
            margin-top: 20px;
            font-size: 25px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="container-hero">
            <div class="container hero">
                <div class="customer-support">
                    <i class="fa-solid fa-headset"></i>
                    <div class="content-customer-support">
                        <span class="text">Soporte al cliente</span>
                        <span class="number">123-456-7890</span>
                    </div>
                </div>

                <div class="container-logo">
                    <link rel="icon" href="imagenes/logo.png">
                    <h1 class="logo"><a href="/">Tecno O.D.A</a></h1>
                </div>

                <div class="container-user">
                    <i class="fa-solid fa-user"></i>
                    <ul class="menu">
                        <span class="text"></span>
                        <li><a href="../View/cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-navbar">
            <nav class="navbar container">
                <i class="fa-solid fa-bars"></i>
                <ul class="menu">
                    <li><a href="">Historia</a></li>
                    <li><a href="../View/P.php">Regresar a la página principal</a></li>
                </ul>
                <form id="search-form" class="search-form" onsubmit="return buscar()">
                    <input type="text" id="search-input" placeholder="Buscar por nombre..." />
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </nav>
        </div>
    </header>
    <div class="title">Solicitudes</div>
    <section class="container-features">
        <table style="text-align:center; position:relative; top:-10px; left:125px">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                    <th>Valor</th>
                    <th>Ubicación</th>
                    <th>Fecha</th>
                    <th>Marca</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="historial-body">
                <?php if (empty($historial)) { ?>
                    <tr>
                        <td colspan="10" style="text-align: center;">No se ha generado ningún producto</td>
                    </tr>
                <?php } else {
                    foreach ($historial as $registro) {
                        $estadoClase = $registro['estado_descripcion'] == 'Aprobado' ? 'estado-aprobado' : 'estado-rechazado';
                        echo "<tr class='{$estadoClase}'>";
                        echo "<td>{$registro['Nombre']}</td>";
                        echo "<td>{$registro['Cantidad']}</td>";
                        echo "<td>{$registro['Proveedor']}</td>";
                        echo "<td>{$registro['Valor']}</td>";
                        echo "<td>{$registro['Ubicacion']}</td>";
                        echo "<td>{$registro['Fecha']}</td>";
                        echo "<td>{$registro['Marca']}</td>";
                        echo "<td>{$registro['Codigo']}</td>";
                        echo "<td>{$registro['Descripcion']}</td>";
                        echo "<td>{$registro['estado_descripcion']}</td>";
                        echo "</tr>";
                    }
                } ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($paginacionPagina > 1) { ?>
                <a href="?pagina=1" class="pagination-link">Primera</a>
                <a href="?pagina=<?php echo $paginacionPagina - 1; ?>" class="pagination-link">&laquo;</a>
            <?php } else { ?>
                <span class="pagination-link disabled">Primera</span>
                <span class="pagination-link disabled">&laquo;</span>
            <?php } ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                <a href="?pagina=<?php echo $i; ?>" class="<?php echo $i == $paginacionPagina ? 'pagination-link active' : 'pagination-link'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>

            <?php if ($paginacionPagina < $totalPaginas) { ?>
                <a href="?pagina=<?php echo $paginacionPagina + 1; ?>" class="pagination-link">&raquo;</a>
                <a href="?pagina=<?php echo $totalPaginas; ?>" class="pagination-link">Última</a>
            <?php } else { ?>
                <span class="pagination-link disabled">&raquo;</span>
                <span class="pagination-link disabled">Última</span>
            <?php } ?>
        </div>
    </section>

    <script>
        function buscar() {
            const searchTerm = document.getElementById('search-input').value;
            const formData = new FormData();
            formData.append('search', searchTerm);
            
            fetch('buscar_historial.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('historial-body').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
            return false; // Previene el envío del formulario
        }
    </script>
</body>
</html>
