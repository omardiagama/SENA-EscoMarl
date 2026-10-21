-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2026 a las 18:21:42
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdescomarl`
--
CREATE DATABASE IF NOT EXISTS `bdescomarl` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bdescomarl`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategorias`
--

CREATE TABLE `tblcategorias` (
  `IdCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblcategorias`
--

INSERT INTO `tblcategorias` (`IdCategoria`, `NombreCategoria`) VALUES
(1, 'Esencias'),
(2, 'Frascos'),
(3, 'Gotas / Feromonas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblclientes`
--

CREATE TABLE `tblclientes` (
  `IdCliente` int(11) NOT NULL,
  `Documento` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NombreCompleto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Celular` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UltimaVisita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblclientes`
--

INSERT INTO `tblclientes` (`IdCliente`, `Documento`, `NombreCompleto`, `Celular`, `Correo`, `UltimaVisita`) VALUES
(1, '12345678', 'Consumidor Final', '3000000000', 'general@esenciaco.com', '2026-09-16'),
(2, '1022970676', 'Omar Stiven Cabrera Diagama', '3332670578', 'omardiagama@gmail.com', '2026-10-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldetallefactura`
--

CREATE TABLE `tbldetallefactura` (
  `IdFactura` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioAplicado` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbldetallefactura`
--

INSERT INTO `tbldetallefactura` (`IdFactura`, `IdProducto`, `Cantidad`, `PrecioAplicado`) VALUES
(1, 6, 2, '60000.00'),
(2, 9, 10, '15000.00'),
(3, 8, 1, '90000.00'),
(4, 3, 2, '60000.00'),
(5, 2, 2, '60000.00'),
(6, 8, 1, '90000.00'),
(7, 3, 1, '60000.00'),
(8, 8, 1, '90000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempleados`
--

CREATE TABLE `tblempleados` (
  `IdEmpleado` int(11) NOT NULL,
  `Nombres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Apellidos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Usuario` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contrasena` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Rol` enum('Administrador','Empleado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Empleado',
  `Cargo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Vendedor',
  `Telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IdSexo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblempleados`
--

INSERT INTO `tblempleados` (`IdEmpleado`, `Nombres`, `Apellidos`, `Usuario`, `Contrasena`, `Rol`, `Cargo`, `Telefono`, `IdSexo`) VALUES
(1, 'Omar Stiven', 'Cabrera Diagama', 'Odia', '1022970676', 'Administrador', 'Desarrollador', '3332670578', 2),
(2, 'Malory Camila', 'Sanchez Lopez', 'MaloSanchez', '1140920322', 'Administrador', 'Desarrollador', '3104026780', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblfacturas`
--

CREATE TABLE `tblfacturas` (
  `IdFactura` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `FechaFactura` datetime DEFAULT current_timestamp(),
  `TotalVenta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `Estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblfacturas`
--

INSERT INTO `tblfacturas` (`IdFactura`, `IdCliente`, `IdEmpleado`, `FechaFactura`, `TotalVenta`, `Estado`) VALUES
(1, 1, 1, '2026-10-14 07:37:47', '120000.00', 'Inhabilitada'),
(2, 1, 1, '2026-10-14 07:37:53', '150000.00', 'Inhabilitada'),
(3, 1, 1, '2026-10-14 07:38:01', '90000.00', 'Inhabilitada'),
(4, 1, 1, '2026-10-14 07:39:29', '120000.00', 'Inhabilitada'),
(5, 1, 1, '2026-10-14 07:40:52', '120000.00', 'Inhabilitada'),
(6, 1, 1, '2026-10-14 07:42:46', '90000.00', 'Inhabilitada'),
(7, 1, 1, '2026-10-14 07:44:12', '60000.00', 'Inhabilitada'),
(8, 2, 1, '2026-10-14 08:07:24', '90000.00', 'Inhabilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductos`
--

CREATE TABLE `tblproductos` (
  `IdProducto` int(11) NOT NULL,
  `NombreProducto` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Precio` decimal(12,2) NOT NULL,
  `Stock` int(11) NOT NULL DEFAULT 0,
  `Imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblproductos`
--

INSERT INTO `tblproductos` (`IdProducto`, `NombreProducto`, `IdCategoria`, `Precio`, `Stock`, `Imagen`) VALUES
(1, 'BAHARA KING', 1, '60000.00', 20, '1791987221_6acf8e15a6c54.jpg'),
(2, 'ASAD', 1, '60000.00', 13, '1791987167_6acf8ddf9cb13.jpg'),
(3, 'INVICTUS', 1, '60000.00', 7, '1791982535_6acf7bc77ebd4.jpg'),
(4, 'YARA', 1, '60000.00', 12, '1791982914_6acf7d4204048.jpg'),
(5, 'CAROLINA HERRERA', 1, '65000.00', 8, '1791987293_6acf8e5d567fc.jpg'),
(6, 'YARA CANDY', 1, '60000.00', 7, '1791987330_6acf8e823277c.jpg'),
(7, 'Frasco Lujo 100ml', 2, '12000.00', 50, '1791987374_6acf8eae81a4e.png'),
(8, 'ANDROSTENOL', 1, '90000.00', 12, '1791987402_6acf8ecacddd1.jpg'),
(9, 'Esencia Flora', 1, '15000.00', 0, '1791987496_6acf8f2836401.jpg'),
(11, 'SEN INTIMO', 3, '12000.00', 35, '1792412562_6ad60b92f1259.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsexo`
--

CREATE TABLE `tblsexo` (
  `IdSexo` int(11) NOT NULL,
  `NombreSexo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tblsexo`
--

INSERT INTO `tblsexo` (`IdSexo`, `NombreSexo`) VALUES
(1, 'Femenino'),
(2, 'Masculino'),
(3, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol_id`, `created_at`) VALUES
(1, 'Omar Stiven Cabrera Diagama', 'Odia', '1022970676', 1, '2026-09-23 13:38:34'),
(2, 'Malory Camila Sanchez Lopez', 'MaloSanchez', '1140920322', 1, '2026-10-19 12:58:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblcategorias`
--
ALTER TABLE `tblcategorias`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  ADD PRIMARY KEY (`IdCliente`),
  ADD UNIQUE KEY `Documento` (`Documento`);

--
-- Indices de la tabla `tbldetallefactura`
--
ALTER TABLE `tbldetallefactura`
  ADD PRIMARY KEY (`IdFactura`,`IdProducto`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `tblempleados`
--
ALTER TABLE `tblempleados`
  ADD PRIMARY KEY (`IdEmpleado`),
  ADD UNIQUE KEY `Usuario` (`Usuario`),
  ADD KEY `IdSexo` (`IdSexo`);

--
-- Indices de la tabla `tblfacturas`
--
ALTER TABLE `tblfacturas`
  ADD PRIMARY KEY (`IdFactura`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdEmpleado` (`IdEmpleado`);

--
-- Indices de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdCategoria` (`IdCategoria`);

--
-- Indices de la tabla `tblsexo`
--
ALTER TABLE `tblsexo`
  ADD PRIMARY KEY (`IdSexo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblcategorias`
--
ALTER TABLE `tblcategorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblclientes`
--
ALTER TABLE `tblclientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblempleados`
--
ALTER TABLE `tblempleados`
  MODIFY `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblfacturas`
--
ALTER TABLE `tblfacturas`
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tblsexo`
--
ALTER TABLE `tblsexo`
  MODIFY `IdSexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbldetallefactura`
--
ALTER TABLE `tbldetallefactura`
  ADD CONSTRAINT `tbldetallefactura_ibfk_1` FOREIGN KEY (`IdFactura`) REFERENCES `tblfacturas` (`IdFactura`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbldetallefactura_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `tblproductos` (`IdProducto`);

--
-- Filtros para la tabla `tblempleados`
--
ALTER TABLE `tblempleados`
  ADD CONSTRAINT `tblempleados_ibfk_1` FOREIGN KEY (`IdSexo`) REFERENCES `tblsexo` (`IdSexo`);

--
-- Filtros para la tabla `tblfacturas`
--
ALTER TABLE `tblfacturas`
  ADD CONSTRAINT `tblfacturas_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `tblclientes` (`IdCliente`),
  ADD CONSTRAINT `tblfacturas_ibfk_2` FOREIGN KEY (`IdEmpleado`) REFERENCES `tblempleados` (`IdEmpleado`);

--
-- Filtros para la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD CONSTRAINT `tblproductos_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `tblcategorias` (`IdCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
