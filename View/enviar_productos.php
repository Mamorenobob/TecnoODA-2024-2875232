<?php
  session_start();

	require '../View/cortina.php';
    require '../Controller/conexion.php';
    $db = new Database();
    $conexion = $db->conectar();
    $sql = "SELECT * FROM solicitudes";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si el usuario no está autenticado
    if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 9)) {
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

		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tecno ODA</title>
		<link rel="icon" href="logo.png">
		<link rel="stylesheet" href="../Model/Css/CSS_Admin.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
						<li><a href="../View/cerrar_sesion.php" href="#" >Cerrar sesión</a></li>
						</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="container-navbar">
				<nav class="navbar container">
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
                        <li><a href="../View/enviar_productos.php" >Revisar Productos Solicitados</a></li>
                        <li><a href="../View/P.php">Regresar a la página principal</a></li>
					</ul>

				</nav>
			</div>
		</header>

<section class="container-features">
        <h1 style='text-align:center;'>Solicitudes</h1>
        <br><br><br><br><br><br>
        
    <table style='text-align:center; top:200px;'>
        <thead>
            <tr>
                <th style='text-align:center;'>Nombre</th>
                <th style='text-align:center;'>Cantidad</th>
                <th style='text-align:center;'>Proveedor</th>
                <th style='text-align:center;'>Valor</th>
                <th style='text-align:center;'>Ubicación</th>
                <th style='text-align:center;'>Fecha</th>
                <th style='text-align:center;'>Marca</th>
                <th style='text-align:center;'>Código</th>
                <th style='text-align:center;'>Descripción</th>
                <th style='text-align:center;'>Aprobar</th>
                <th style='text-align:center;'>Rechazar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($solicitudes)) { ?>
                <tr>
                    <td colspan="11" style="text-align: center;">No hay solicitudes registradas.</td>
                </tr>
            <?php } else {
                foreach ($solicitudes as $solicitud) { ?>
                    <tr data-id="<?php echo $solicitud['ID']; ?>">
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Nombre']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Cantidad']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Proveedor']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Valor']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Ubicacion']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Fecha']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Marca']); ?></td>
                        <td style='text-align:center;'><?php echo htmlspecialchars($solicitud['Codigo']); ?></td>
                        <td class="descripcion" style='text-align:center;'><?php echo htmlspecialchars($solicitud['Descripcion']); ?></td>
                        <td style='text-align:center;'>
                            <a href="javascript:void(0);" onclick="aprobar(<?php echo $solicitud['ID']; ?>)" class="btn btn-success"><i class="fa-solid fa-check"></i></a>
                        </td>
                        <td style='text-align:center;'>
                            <a href="javascript:void(0);" onclick="rechazar(<?php echo $solicitud['ID']; ?>)" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
                        </td>

                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
        <div id="contenedor_info"></div>
</section>
        <nav>

		<section class="banner">
			<div class="content-banner">
			</div>
		</section>

		<main class="main-content">
			<section class="container container-features">
				<div class="social-icons">
                    <span class="instagram">
                    <i class="fa-brands fa-instagram"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
				<div class="social-icons">
                    <span class="twitter">
                    <i class="fa-brands fa-twitter"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
				<div class="social-icons">
                    <span class="facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
				<div class="social-icons">
                    <span class="facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                    </span>
					<div class="social-icons">
					</div>
				</div>
			</section>
		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script src="../Model/JavaScript/Admin.js"></script>
	</body>
</html>
<script>
function aprobar(id) {
    fetch('../View/procesar_solicitud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            id: id,
            accion: 'aprobar'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`tr[data-id="${id}"]`).style.backgroundColor = 'green';
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function rechazar(id) {
    fetch('../View/procesar_solicitud.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            id: id,
            accion: 'rechazar'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`tr[data-id="${id}"]`).remove();
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>