<?php
  session_start();

	require '../View/cortina.php';
    require '../Controller/conexion.php';
    $db = new Database();
    $conexion = $db->conectar();

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
    <meta charset="UTF-8">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../Model/Css/CSS_Admin.css">
    <style>
        /* Mantén los estilos existentes */
        .container-user .menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .container-user .menu li {
            display: inline;
        }

        .container-user .menu li a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }

        .container-user .menu li a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
            position: relative;
        }

        .container-user .menu li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: blue;
            transition: width 0.3s ease;
            -webkit-transition: width 0.3s ease;
        }

        .container-user .menu li a:hover::after {
            width: 100%;
            left: 0;
            background: blue;
        }

        .container-user .menu li a:hover {
            color: blue;
        }

        .container-user .user-name {
            color: white;
            margin-left: 5px;
            left:-15px;
            position: relative;
            top:1px;
			font-size:15px;
			font-family: 'Poppins', sans-serif;
        }
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
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['Usuario']); ?></span>
                    <i class="fa-solid fa-user"></i>
                    <ul class="menu">
                        <span class="text"></span>
                        <li><a href="../View/cerrar_sesion.php" href="#">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="container-navbar">
        <nav class="navbar container">
            <i class="fa-solid fa-bars"></i>
            <ul class="menu">
                <li><a href="../View/Inventario.php">Inventario</a></li>
                <li><a href="../View/Historial.php">Historial</a></li>
                <li><a href="../View/enviar_productos.php">Revisar Productos Solicitados</a></li>
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
    </div>

    <section class="container-features">
        <br><br><br><br><br><br><!-- Otros contenidos -->

        <!-- Contenedor para mostrar la información del proveedor -->
        <div id="contact-info">
            <p id="company-name">Nombre de la empresa: </p>
            <p id="address">Dirección: </p>
            <p id="phone">Teléfono: </p>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
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
