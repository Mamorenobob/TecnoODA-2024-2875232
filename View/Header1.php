    <?php
     if (isset($_SESSION['Usuario']) && isset($_SESSION['Cargo'])) {
    }    
    ?>
    <style>
        header {
            background-color: #4B0082; /* Fondo púrpura profundo */
        }

        .container-hero {
            display: flex;
            justify-content: center;
        }

        .container.hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
        }

        .customer-support, .container-logo, .container-user {
            display: flex;
            align-items: center;
        }

        .customer-support i, .container-user i {
            font-size: 24px;
            color: white;
            margin-right: 10px;
        }

        .content-customer-support .text, .content-customer-support .number {
            display: block;
            color: white;
        }

        .container-logo .logo a {
            font-size: 24px;
            color: white;
            text-decoration: none;
        }

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
        }

        nav {
            background-color: #2E0854; /* Fondo púrpura más oscuro */
            padding: 10px 0;
        }

        .menu-toggle {
            display: none; /* Ocultar el toggle en pantallas grandes */
        }

        .nav-list {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-list li {
            margin: 0 15px;
        }

        .nav-list li a {
            color: white;
            text-decoration: none;
            position: relative;
            padding: 5px 0;
        }

        .nav-list li a::after {
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

        .nav-list li a:hover::after {
            width: 100%;
            left: 0;
            background: blue;
        }

        .nav-list li a:hover {
            color: blue;
        }

        /* Estilos para pantallas pequeñas */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
                cursor: pointer;
            }

            .menu-toggle .bar {
                display: block;
                width: 25px;
                height: 3px;
                margin: 5px auto;
                background-color: white;
            }

            .nav-list {
                display: none;
                flex-direction: column;
                align-items: center;
            }

            .nav-list.active {
                display: flex;
            }

            .nav-list li {
                margin: 10px 0;
            }
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
                        <li><a href="../View/cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
