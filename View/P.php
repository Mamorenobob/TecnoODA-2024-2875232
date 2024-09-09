<?php
  session_start();

	require '../View/cortina.php';
    require '../Controller/conexion.php';
    $db = new Database();
    $conexion = $db->conectar();
    if (isset($_GET['mensaje'])) {
        if ($_GET['mensaje'] == 'success') {
            echo "<script>alert('Producto agregado exitosamente');</script>";
        } elseif ($_GET['mensaje'] == 'error') {
            echo "<script>alert('Error al agregar el producto');</script>";
        }
    }

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
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="Stylesheet" href="../Model/Css/Fondo1.css">
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tecno ODA</title>
		<link rel="icon" href="logo.png">
		<link rel="stylesheet" href="../Model/Css/CSS_Admin.css" />
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
						<li><a href="#">Productos</a></li>
						<li><a href="#" id="toggleButton">Mostrar Formulario</a></li>
					</ul>

					<form class="search-form">
						<input type="search" placeholder="Buscar..." />
						<button class="btn-search">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</nav>
			</div>
		</header>
		<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>	
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Proveedor</th>
            <th>Valor</th>
            <th>Ubicación</th>
            <th>Fecha</th>
            <th>Marca</th>
            <th>Codigo de Barras</th>
            <th>Descripción</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $observar = "SELECT * FROM productos";
    $statement = $conexion->query($observar);

    if ($statement) {
        while ($filas = $statement->fetch(PDO::FETCH_ASSOC)) {
            $id = $filas['ID'];
            $nombre = $filas['Nombre'];
            $cantidad = $filas['Cantidad'];
            $proveedor = $filas['Proveedor'];
            $valor = $filas['Valor'];
            $ubicacion = $filas['Ubicacion'];
            $fecha = $filas['Fecha'];
            $marca = $filas['Marca'];
            $codigo = $filas['Codigo'];
            $descripcion = $filas['Descripcion'];

            echo '<tr align="center">
                    <td>' . $id . '</td>
                    <td>' . $nombre . '</td>
                    <td>' . $cantidad . '</td>
                    <td>' . $proveedor . '</td>
                    <td>' . $valor . '</td>
                    <td>' . $ubicacion . '</td>
                    <td>' . $fecha . '</td>
                    <td>' . $marca . '</td>
                    <td>' . $codigo . '</td>
                    <td>' . $descripcion . '</td>
                    <td>
                        <button onclick="openEditForm(' . "'" . $nombre . "','" . $cantidad . "','" . $proveedor . "','" . $valor . "','" . $ubicacion . "','" . $fecha . "','" . $marca . "','" . $codigo . "','" . $descripcion . "'" . ')">Editar</button>
                    </td>
                    <td>
                        <form action="../View/InsertarProductos.php" method="POST" onsubmit="return confirm(\'¿Estás seguro de eliminar este producto?\');">
                            <input type="hidden" name="id" value="' . $id . '">
                            <button type="submit" name="eliminar">Borrar</button>
                        </form>
                    </td>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='10'>No se encontraron productos.</td></tr>";
    }
    ?>
    </tbody>
</table>
    <!-- Formulario para agregar productos -->
    <center>
        <div id="formContainer">
            <center>
                <form action="../View/InsertarProductos.php" method="POST">
                    <h1>Registro de Productos</h1>
                    <input name="nombre" type="text" id="nombre" placeholder="Nombre" class="form-control w-25">
                    <input name="cantidad" type="number" id="cantidad" placeholder="Cantidad" class="form-control w-25">
                    <input name="proveedor" type="text" id="proveedor" placeholder="Proveedor" class="form-control w-25">
                    <input name="valor" type="number" id="valor" placeholder="Valor" class="form-control w-25">
                    <input name="ubicacion" type="text" id="ubicacion" placeholder="Ubicación" class="form-control w-25">
                    <input name="fecha" type="date" id="fecha" placeholder="Fecha" class="form-control w-25">
                    <input name="marca" type="text" id="marca" placeholder="Marca" class="form-control w-25">
                    <input name="codigo" type="number" id="codigo_barras" placeholder="Código de barras" class="form-control w-25">
                    <input name="descripcion" type="text" id="descripcion" placeholder="Descripción" class="form-control w-25">
                    
                    <input type="submit" name="enviar" value="Agregar Producto">
                   
                    <button type="button" id="closeButton">Cerrar</button>
                    
                </form>
            </center>
        </div>
    </center>

	<!-- Formulario para editar productos -->
	  <center>
    <div id="editFormContainer">
        <center>
            <form action="../View/InsertarProductos.php" method="POST">
                <h1>Editar Producto</h1>
                <!-- Campo oculto para el ID -->
                <input type="hidden" name="edit_id" id="edit_id">

                <input type="text" name="edit_nombre" id="edit_nombre" placeholder="Nombre" class="form-control w-25">
                <input type="number" name="edit_cantidad" id="edit_cantidad" placeholder="Cantidad" class="form-control w-25">
                <input type="text" name="edit_proveedor" id="edit_proveedor" placeholder="Proveedor" class="form-control w-25">
                <input type="number" name="edit_valor" id="edit_valor" placeholder="Valor" class="form-control w-25">
                <input type="text" name="edit_ubicacion" id="edit_ubicacion" placeholder="Ubicación" class="form-control w-25">
                <input type="date" name="edit_fecha" id="edit_fecha" placeholder="Fecha" class="form-control w-25">
                <input type="text" name="edit_marca" id="edit_marca" placeholder="Marca" class="form-control w-25">
                <input type="number" name="edit_codigo_barras" id="edit_codigo_barras" placeholder="Código de barras" class="form-control w-25">
                <input type="text" name="edit_descripcion" id="edit_descripcion" placeholder="Descripción" class="form-control w-25">
                
                <input type="submit" name="accion" value="Actualizar Producto">
               
                <button type="button" id="closeEditButton">Cerrar</button>
                
            </form>
        </center>
    </div>
</center>
        </div>
    </center>

	<script>
            function deleteRow(button) {
                const row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
                alert('Producto eliminado correctamente.');
            }


        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('toggleButton');
            const formContainer = document.getElementById('formContainer');
            const closeButton = document.getElementById('closeButton');
            const editFormContainer = document.getElementById('editFormContainer');
            const closeEditButton = document.getElementById('closeEditButton');

            toggleButton.addEventListener('click', () => {
                if (formContainer.classList.contains('open')) {
                    formContainer.classList.remove('open');
                    toggleButton.textContent = 'Mostrar Formulario';
                } else {
                    formContainer.classList.add('open');
                    toggleButton.textContent = 'Ocultar Formulario';
                }
            });

            closeButton.addEventListener('click', () => {
                formContainer.classList.remove('open');
                toggleButton.textContent = 'Mostrar Formulario';
            });

            closeEditButton.addEventListener('click', () => {
                editFormContainer.classList.remove('open');
            });
        });

        function openEditForm(nombre, cantidad, proveedor, valor, ubicacion, fecha, marca, codigo, descripcion) {
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_cantidad').value = cantidad;
            document.getElementById('edit_proveedor').value = proveedor;
            document.getElementById('edit_valor').value = valor;
            document.getElementById('edit_ubicacion').value = ubicacion;
            document.getElementById('edit_fecha').value = fecha;
            document.getElementById('edit_marca').value = marca;
            document.getElementById('edit_codigo_barras').value = codigo; // Corregido
            document.getElementById('edit_descripcion').value = descripcion;

            document.getElementById('editFormContainer').classList.add('open');
        }

        
    </script>

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
	</body>
</html>