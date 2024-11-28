-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2024 a las 22:49:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `templanza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `ID` int(11) NOT NULL,
  `Estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`ID`, `Estado`) VALUES
(1, 'En Stock'),
(2, 'Sin Stock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Precio_Compra` int(11) DEFAULT NULL,
  `Precio_Venta` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Total_Compra` int(11) DEFAULT NULL,
  `Total_Venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`ID`, `Nombre`, `Fecha`, `Precio_Compra`, `Precio_Venta`, `Cantidad`, `Total_Compra`, `Total_Venta`) VALUES
(1, 'Chaqueta', '2024-11-28', 50000, 70000, 10, 500000, 700000),
(2, 'Pantalon', '2024-11-28', 5000, 10000, 12, 60000, 120000),
(3, 'Pantalon', '2024-11-28', 5000, 10000, 12, 60000, 120000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Precio_Compra` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Precio_Venta` int(11) DEFAULT NULL,
  `id_estados` int(11) DEFAULT NULL,
  `Total_Compra` int(11) DEFAULT NULL,
  `Total_Venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Precio_Compra`, `Cantidad`, `Precio_Venta`, `id_estados`, `Total_Compra`, `Total_Venta`) VALUES
(1, 'Buso', 30000, 5, 100000, 1, 150000, 500000),
(3, 'Pantalon', 40000, 5, 60000, 1, NULL, NULL),
(4, 'Boxer', 25000, 0, 30000, 2, NULL, NULL),
(5, 'Camisa', 20000, 10, 40000, 1, 200000, 400000),
(6, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(7, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(8, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(9, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(10, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(11, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(12, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(13, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(14, 'Camisa', 20000, 5, 40000, 1, NULL, NULL),
(15, 'Chaqueta', 50000, 10, 70000, 1, 500000, 700000),
(16, 'Pantalon', 5000, 12, 10000, 1, 60000, 120000),
(17, 'Pantalon', 5000, 12, 10000, 1, 60000, 120000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID`, `Nombre`, `Pass`) VALUES
(1, 'Brayan', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_estado` (`id_estados`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_estado` FOREIGN KEY (`id_estados`) REFERENCES `estados` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
