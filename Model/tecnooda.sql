-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2024 a las 01:28:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnooda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ID` int(11) NOT NULL,
  `cargo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID`, `cargo`) VALUES
(1, 'Distribuidor'),
(2, 'Gestor'),
(8, 'Proveedor'),
(9, 'Administrador\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `ID` int(11) NOT NULL,
  `documento` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`ID`, `documento`) VALUES
(7, 'Tarjeta de Identidad'),
(8, 'Cedula de Ciudadania'),
(9, 'Cedula de Extranjeria'),
(10, 'Pasaporte'),
(11, 'NIUP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviado`
--

CREATE TABLE `enviado` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Ubicacion` varchar(30) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Marca` varchar(25) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Proveedor` varchar(30) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enviado`
--

INSERT INTO `enviado` (`ID`, `Nombre`, `Cantidad`, `Valor`, `Ubicacion`, `Fecha`, `Marca`, `Codigo`, `Descripcion`, `Proveedor`, `estado_id`) VALUES
(2, 'Nintendo Switch', 100, 5200000, 'Bogota', '2024-09-25', 'Nintendo', 2147483647, 'Que se encuentre en buen estado y en total funcionalidad', 'Nintendo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Aprobado'),
(2, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Ubicacion` varchar(30) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Marca` varchar(25) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Proveedor` varchar(30) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`ID`, `Nombre`, `Cantidad`, `Valor`, `Ubicacion`, `Fecha`, `Marca`, `Codigo`, `Descripcion`, `Proveedor`, `estado_id`) VALUES
(1, 'Johan', 555, 44444, '44', '0004-04-04', '4', 44, '4', '4', 1),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(5, '11', 1, 1, '1', '0111-01-01', '1', 1, '1', '1', 2),
(6, 'hola', 1000, 15151, NULL, '5555-05-05', 'sasas', 1114, 'sasasa', 'hola', 1),
(7, 'Mayonesa', 30, 60000, 'Calle #46 16', '2024-09-15', 'Pollito', 0, 'Sabrosa mayonesa', 'Unilevel', 2),
(8, 'Mouse', 30000, 1300000, 'Calle 9 # 26 16', '2006-10-17', 'Sampicolino', 36, 'Un mouse delicoso', 'Katronix', 1),
(9, 'Nintendo Switch', 100, 5200000, 'Bogota', '2024-09-25', 'Nintendo', 2147483647, 'Que se encuentre en buen estado y en total funcionalidad', 'Nintendo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Ubicacion` varchar(30) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Marca` varchar(25) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Proveedor` varchar(30) DEFAULT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`ID`, `Nombre`, `Cantidad`, `Valor`, `Ubicacion`, `Fecha`, `Marca`, `Codigo`, `Descripcion`, `Proveedor`, `estado`) VALUES
(23, 'Johan', 555, 44444, '44', '0004-04-04', '4', 44, '4', '4', ''),
(24, 'hola', 1000, 15151, NULL, '5555-05-05', 'sasas', 1114, 'sasasa', 'hola', ''),
(25, 'Mouse', 30000, 1300000, 'Calle 9 # 26 16', '2006-10-17', 'Sampicolino', 36, 'Un mouse delicoso', 'Katronix', 'aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Ubicacion` varchar(30) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Marca` varchar(25) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Proveedor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Cantidad`, `Valor`, `Ubicacion`, `Fecha`, `Marca`, `Codigo`, `Descripcion`, `Proveedor`) VALUES
(9, 'Tablet', 5, 450000, 'Bogota', '2024-08-17', 'Asus', 1000001, 'Se encuentran en un bien estado y estas listas para la venta', 'Jusepe'),
(10, 'Tablet', 5, 450000, 'Bogota', '2024-08-17', 'Asus', 1000001, 'Se encuentran en un bien estado y estas listas para la venta', 'Jusepe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `ID` int(11) NOT NULL,
  `Cargo` int(11) DEFAULT NULL,
  `Usuario` varchar(255) DEFAULT NULL,
  `P_Nombre` varchar(20) DEFAULT NULL,
  `P_Apellido` varchar(20) DEFAULT NULL,
  `Tipo_Doc` int(11) DEFAULT NULL,
  `Num_Doc` varchar(15) DEFAULT NULL,
  `Correo` varchar(30) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Contrasenia` varchar(20) DEFAULT NULL,
  `Direccion` varchar(30) DEFAULT NULL,
  `token_password` varchar(30) DEFAULT NULL,
  `token_request` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID`, `Cargo`, `Usuario`, `P_Nombre`, `P_Apellido`, `Tipo_Doc`, `Num_Doc`, `Correo`, `Telefono`, `Contrasenia`, `Direccion`, `token_password`, `token_request`) VALUES
(2, 1, 'a', 'a', 'a', 7, '1', '1', '1', '1', NULL, NULL, NULL),
(3, 1, 'Ale', 'Mauro', 'Moreno', 7, NULL, 'gokussjxddd1@gmail.com', '3213639957', '159', NULL, NULL, 0),
(5, 1, 's', 's', 's', 7, NULL, 'a@gmail.com', '321', '12', NULL, NULL, NULL),
(7, 8, 'Contacto', 'Contacto', 'Correo', 7, NULL, 'TecnoODA@outlook.com', '1', 'pato5', NULL, NULL, 0),
(8, 2, 'Andres', 'Andres', 'Vasquez', 8, NULL, 'martinesandres526@gmail.com', '3248757667', 'andres123', NULL, NULL, 0),
(9, 1, 'Tecno', 'a', 'a', 7, NULL, 'TecnoODA@outlook.com', '121', '123', NULL, NULL, 1),
(10, 2, 'Demond', 'Ale', 'Mor', 7, '1456788410', 'mamoreno.bob@gmail.com', '321459782', '123456789', NULL, NULL, 0),
(11, 8, 'ZDELMAXZ', 'Cris', 'Pam', 8, '156456165', 'camilo.milo177@gmail.com', '3215616', '123', NULL, NULL, 0),
(12, 9, 'Pes', 'Pepe', 'Pasa', 7, '1561561', 'pepito@gmail.com', '321654987', '1', NULL, NULL, NULL),
(13, 2, 'Ramona_CasaLimpia', 'Ramona', 'Sanchez', 9, '553319160', 'RamonaCasaLimpia_VivaColombia@', '3212995560', 'Ramona123', NULL, NULL, NULL),
(14, 2, 'Pep', 'Pepito', 'Suarez', 8, '1155548420', 'Pep@gmail.com', '3111548790', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Ubicacion` varchar(30) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Marca` varchar(25) DEFAULT NULL,
  `Codigo` int(11) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Proveedor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `enviado`
--
ALTER TABLE `enviado`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_estado` (`estado_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cargo` (`Cargo`),
  ADD KEY `Tipo_Doc` (`Tipo_Doc`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `enviado`
--
ALTER TABLE `enviado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enviado`
--
ALTER TABLE `enviado`
  ADD CONSTRAINT `estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`Cargo`) REFERENCES `cargo` (`ID`),
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`Tipo_Doc`) REFERENCES `documento` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
