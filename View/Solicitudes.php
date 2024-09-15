    <?php
    session_start();
        require '../View/cortina.php';
        require '../Controller/conexion.php';
        require '../View/Header1.php';

        ?>
  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo.png" type="image/png">
    <script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
    <title>Solicitud de Productos</title>
    <style>
        /* Estilos para el formulario */
        .xFormContainer {
            width: 70%;
            max-width: 900px;
            margin: 30px auto;
            padding: 25px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            font-family: 'Arial', sans-serif;
        }

        .xFormHeader {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        .xFieldWrapper {
            margin-bottom: 20px;
        }

        .xFieldWrapper label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #555;
        }

        .xFieldWrapper input[type="text"],
        .xFieldWrapper input[type="number"],
        .xFieldWrapper input[type="date"],
        .xFieldWrapper textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .xFieldWrapper textarea {
            resize: vertical;
        }

        .xSubmitBtn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .xSubmitBtn:hover {
            background-color: #0056b3;
        }

        .xResultMessage {
            margin-top: 20px;
            padding: 15px;
            background-color: #eaf1ff;
            border: 1px solid #d0e3ff;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<nav>
        <div class="menu-toggle" id="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>

        </div>
        <ul class="nav-list" id="nav-list">
            <li><a href="">Solicitar Prodcutos</a></li>
            <li><a href="../View/Gestor.php">Regresar al Inicio</a></li>

        </ul>
    </nav>
    <div class="xFormContainer">
        <h1 class="xFormHeader">Solicitud de Productos</h1>
        <form id="dynamicForm" method="POST" action="procesar_formulario.php">
            <div class="xFieldWrapper">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="xFieldWrapper">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>
            <div class="xFieldWrapper">
                <label for="valor">Valor:</label>
                <input type="number" id="valor" name="valor" step="0.01" required>
            </div>
            <div class="xFieldWrapper">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required>
            </div>
            <div class="xFieldWrapper">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="xFieldWrapper">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
            </div>
            <div class="xFieldWrapper">
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" required>
            </div>
            <div class="xFieldWrapper">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>
            <div class="xFieldWrapper">
                <label for="proveedor">Proveedor:</label>
                <input type="text" id="proveedor" name="proveedor" required>
            </div>
            <button type="submit" class="xSubmitBtn" id="submitBtn" name="enviar">Enviar</button>
        </form>
        <div id="result" class="xResultMessage"></div>
    </div>
    <script src="Solicitudes.js"></script>
</body>
</html>
