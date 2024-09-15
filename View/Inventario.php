<?php
    session_start();
  
      require '../View/cortina.php';
      require '../Controller/conexion.php';
      require '../View/Header1.php';
      $db = new Database();
      $conexion = $db->conectar();
  
      // Verificar si el usuario no está autenticado
      if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 9) ) {
        if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 2)){
            echo "<script>
            alert('No puedes acceder aquí. Debes iniciar sesión.');
            window.location = 'index.php';
          </script>";

        exit();
        }
      }
    if (isset($_GET['mensaje'])) {
        if ($_GET['mensaje'] == 'success') {
            echo "<script>alert('Producto agregado exitosamente');</script>";
        } elseif ($_GET['mensaje'] == 'error') {
            echo "<script>alert('Error al agregar el producto');</script>";
        }
    }
    $url = '../View/Inventario.php'; // Valor por defecto

// Verifica el valor de $_SESSION['Cargo'] y ajusta la URL según corresponda
switch ($_SESSION['Cargo']) {
    case 2:
        $url = '../View/Gestor.php';
        break;
    case 9:
        $url = '../View/P.php';
        break;
    // Agrega más casos si es necesario
    default:
        $url = '../View/index.php'; // URL por defecto si no hay coincidencia
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <link rel="stylesheet" href="../Model/Css/CSS_Admin.css" />
    <script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
    <title>Inventario</title>
    <style>
        #formContainer {
            position: relative;
            width: 600px;
            background-color: #f1f1f1;
            border: 3px solid #110e0e;
            padding: 20px;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
            opacity: 0;
            visibility: hidden;
            text-align: center;
            border-radius: 10px;
            z-index: 10; /* Asegura que esté sobre la tabla */
            top: 50px;
            left:650px;
        }

        #formContainer.open, #editFormContainer.open {
            opacity: 1;
            visibility: visible;
        }
        #editFormContainer{    position: relative;
            width: 600px;
            background-color: #f1f1f1;
            border: 3px solid #110e0e;
            padding: 20px;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
            opacity: 0;
            visibility: hidden;
            text-align: center;
            border-radius: 10px;
            z-index: 10; /* Asegura que esté sobre la tabla */
            top: -700px;
            left:650px;

        }

  

        button {
            margin-bottom: 10px;
            padding: 10px 20px;
            background: linear-gradient(to bottom, #ffffff, #ccc);
            color: rgb(0, 0, 0);
            border-radius: 20px;
            cursor: pointer;
            border: 5px solid #0217d6;
        }

        button:hover {
            background-color: #000000;
        }

        .form-control {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 4px solid #000000;
            border-radius: 4px;
        }

        .w-25 {
            width: 25%;
        }

        h1 {
            font-family: 'Times New Roman', Times, serif;
            color: rgb(0, 0, 0);
        }

        #backButton {
            position: absolute;
            top: 10px;
            right: 20px;
            color: #000000;
            background: linear-gradient(to bottom, #ffffff, #ccc);
            border: 5px solid #0217d6;
            border-radius: 20px;
            width: 10%;
        }

        img {
            border: 3px solid #1e1596;
            display: block;
            width: 7%;
            border: 3px solid #1100ff;
            border-radius: 20px;
            position: absolute;
            top: 800px;
            left: 10px;
        }

        table {
            position: absolute;
            display: block;
            top: 150px;
            left: 40px;
            z-index: 1; /* Asegura que esté detrás del formulario */
            opacity: 0.8; /* Ajusta la opacidad si quieres que sea más tenue */
        }
                

        /* Estilo para los recuadros de texto */
        .message-1 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 1050px;   /* Mueve el div 10px hacia abajo */
            right: 800px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-2 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 1100px;   /* Mueve el div 10px hacia abajo */
            right: 800px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-3 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 1150px;   /* Mueve el div 10px hacia abajo */
            right: 800px;  /* Mueve el div 20px hacia la derecha */
        }
        .message-4 {
            background-color: white; /* Fondo blanco */
            border-radius: 10px;
            padding: 10px; /* Espaciado interno */
            margin: 10px auto; /* Espacio entre recuadros y centrado */
            width: 25%; /* Anchura del recuadro */
            text-align: center; /* Texto centrado dentro del recuadro */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            margin-right: 600px;
            position: absolute;
            top: 1200px;   /* Mueve el div 10px hacia abajo */
            right: 800px;  /* Mueve el div 20px hacia la derecha */
        }
        .toggleButton{
            position: relative;
            left: 850px;
        }
   
    </style>
</head>
<body>
<nav class="navbar container">
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
                       <li><a href="">Inventario</a></li>
                        <li><a href="<?php echo $url; ?>">Regresar al Inicio</a></li>
                        
					</ul>
				</nav>

    <!-- Recuadros de información debajo de la imagen -->
<div class="message-1">
    <!-- Contenido del primer cuadro -->
    <p>              </p>
</div>
<div class="message-2">
    <!-- Contenido del segundo cuadro -->
    <p>                </p>
</div>
<div class="message-3">
    <!-- Contenido del primer cuadro -->
    <p>                   </p>
</div>
<div class="message-4">
    <!-- Contenido del segundo cuadro -->
    <p>               </p>
</div>


<table style="text-align:center;position:absolute;left:250px;top:200px;">
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
    <button id="toggleButton" class="toggleButton">Mostrar Formulario</button>

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
</body>
</html>