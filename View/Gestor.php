<?php
  session_start();
  require '../View/cortina.php';
  require '../Controller/conexion.php';
  require '../View/Header1.php';

  // Verificar si el usuario no está autenticado
  if (!isset($_SESSION['Usuario']) || ($_SESSION['Cargo'] != 2)) {
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <link rel="stylesheet" href="../Model/Css/Gestor.css">
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
    <title>Gestor</title>
    <style>
        /* Estilos para el menú desplegable */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {background-color: #f1f1f1}
        .dropdown:hover .dropdown-content {display: block;}
        .dropdown:hover .dropbtn {background-color: #3e8e41;}

        /* Estilos para la información de contacto */
        #contact-info {
            display: none;
            margin-top: 20px;
        }
        #contact-info p {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <nav>
        <div class="menu-toggle" id="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-list" id="nav-list">
            <li><a href="../View/Inventario.php">Inventario</a></li>
            <li><a href="../View/Solicitudes.php">Solicitar Productos</a></li>
            <li><a href="../View/mostrar_solicitudes.php">Solicitudes</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Contactos Proveedor</a>
                <div class="dropdown-content">
                    <a href="#" data-provider="1">Proveedor 1</a>
                    <a href="#" data-provider="2">Proveedor 2</a>
                    <a href="#" data-provider="3">Proveedor 3</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="content">
        <!-- Contenedor para mostrar la información del proveedor -->
        <div id="contact-info">
            <p id="company-name">Nombre de la empresa: </p>
            <p id="address">Dirección: </p>
            <p id="phone">Teléfono: </p>
        </div>
    </div>

    <script>
        // Información de los proveedores (esto es solo un ejemplo)
        const providerData = {
            '1': {
                companyName: 'Empresa A',
                address: 'Calle Falsa 123',
                phone: '555-1234'
            },
            '2': {
                companyName: 'Empresa B',
                address: 'Avenida Siempre Viva 742',
                phone: '555-5678'
            },
            '3': {
                companyName: 'Empresa C',
                address: 'Boulevard del Sol 456',
                phone: '555-8765'
            }
        };

        document.querySelectorAll('.dropdown-content a').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                // Obtener el ID del proveedor seleccionado
                const providerId = this.getAttribute('data-provider');
                const data = providerData[providerId];

                // Mostrar la información del proveedor
                document.getElementById('contact-info').style.display = 'block';
                document.getElementById('company-name').textContent = `Nombre de la empresa: ${data.companyName}`;
                document.getElementById('address').textContent = `Dirección: ${data.address}`;
                document.getElementById('phone').textContent = `Teléfono: ${data.phone}`;
            });
        });
    </script>
</body>
</html>
<?php
    require '../View/Footer.php';
?>
