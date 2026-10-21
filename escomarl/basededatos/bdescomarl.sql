-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2026 a las 16:56:51
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
(1, '12345678', 'Consumidor Final', '3000000000', 'general@esenciaco.com', '2026-09-16');

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
(1, 'Administrador', 'Principal', 'admin', 'admin123', 'Administrador', 'Gerente', '3000000000', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblfacturas`
--

CREATE TABLE `tblfacturas` (
  `IdFactura` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `FechaFactura` datetime DEFAULT current_timestamp(),
  `TotalVenta` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'BAHARA KING', 1, '60000.00', 20, 'bahara_king.jpg'),
(2, 'ASAD', 1, '60000.00', 15, 'asad.jpg'),
(3, 'INVICTUS', 1, '60000.00', 10, 'invictus.jpg'),
(4, 'YARA', 1, '60000.00', 12, 'yara.jpg'),
(5, 'CAROLINA HERRERA', 1, '65000.00', 8, 'ch.jpg'),
(6, 'YARA CANDY', 1, '60000.00', 10, 'yara_candy.jpg'),
(7, 'Frasco Lujo 100ml', 2, '12000.00', 50, 'frasco_lujo.jpg'),
(8, 'ANDROSTENOL', 3, '90000.00', 15, 'androstenol.jpg');

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
(1, 'Administrador', 'admin', '1234', 1, '2026-09-23 13:38:34');

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
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblempleados`
--
ALTER TABLE `tblempleados`
  MODIFY `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblfacturas`
--
ALTER TABLE `tblfacturas`
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tblsexo`
--
ALTER TABLE `tblsexo`
  MODIFY `IdSexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
