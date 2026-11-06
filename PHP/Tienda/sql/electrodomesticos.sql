-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2023 a las 15:26:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedidosejemplo`
--
CREATE DATABASE IF NOT EXISTS `electrodomesticos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `electrodomesticos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CodCat` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodCat`, `Nombre`, `Descripcion`) VALUES
(18, 'Lavadoras', 'Lavadoras con distintas capacidades y tamaños.'),
(19, 'Televisores', 'Televisores LED con TDT. Diversos tamaños expresados en pulgadas. Marcas: Samsung, LG, Sony, etc.'),
(20, 'Frigoríficos', 'Frigoríficos combi, de doble puerta y americanos. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `NUM_CLIENTE` int(7) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `DIRECCION` varchar(30) NOT NULL,
  `EMAIL` varchar(36) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`NUM_CLIENTE`, `DNI`, `NOMBRE`, `DIRECCION`, `EMAIL`, `PASSWORD`) VALUES
(1, '00000000A', 'admin', '', 'admin@admin.com', 'admin'),
(2, '11111111Z', 'Julia Rodríguez', 'calle Sevilla, 8', 'julia@ieshnosmachado.org', 'julia'),
(3, '22222222Z', 'Lola Ramírez', 'calle Conil, 20', 'lola@ieshnosmachado.org', 'lola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `num_ident` int(11) NOT NULL,
  `imagen` blob NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `tamano` varchar(15) NOT NULL DEFAULT '',
  `formato` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `NUM_PEDIDO` int(4) NOT NULL,
  `NUM_LINEA` int(11) NOT NULL,
  `COD_PRODUCTO` int(12) NOT NULL,
  `PRECIO` double(7,2) NOT NULL,
  `CANTIDAD` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`NUM_PEDIDO`, `NUM_LINEA`, `COD_PRODUCTO`, `PRECIO`, `CANTIDAD`) VALUES
(12, 11, 29, 1345.00, 2),
(12, 12, 31, 509.00, 1),
(13, 13, 36, 399.00, 1),
(13, 14, 32, 369.00, 1),
(14, 15, 34, 679.00, 2),
(14, 16, 26, 425.00, 1),
(15, 17, 31, 509.00, 2),
(15, 18, 37, 349.00, 1),
(16, 19, 28, 999.00, 1),
(16, 20, 36, 399.00, 1),
(16, 21, 31, 509.00, 1),
(17, 22, 26, 425.00, 1),
(17, 23, 30, 459.00, 2),
(17, 24, 35, 649.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `NUM_PEDIDO` int(4) NOT NULL,
  `CLIENTE` int(7) NOT NULL,
  `FECHA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`NUM_PEDIDO`, `CLIENTE`, `FECHA`) VALUES
(12, 2, '2023-01-04'),
(13, 2, '2023-01-04'),
(14, 2, '2023-01-04'),
(15, 3, '2023-01-04'),
(16, 3, '2023-01-04'),
(17, 3, '2023-01-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `CodProd` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Stock` int(11) NOT NULL,
  `precio` double DEFAULT NULL,
  `CodCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Stock`, `precio`, `CodCat`) VALUES
(26, 'TV LED 55\" - Samsung UE55AU7175UXXC', 'TV LED 55\" - Samsung UE55AU7175UXXC, UHD 4K, Crystal UHD, Smart TV, HDR10+, Tizen, Dolby D', 8, 425, 19),
(27, 'TV QLED 55\" - Samsung QE55Q60BAUXXC', 'TV QLED 55\" - Samsung QE55Q60BAUXXC, QLED 4K, Procesador QLED 4K Lite, Smart TV, Negro', 12, 649, 19),
(28, 'TV OLED 55\" - LG OLED55B26LA', 'TV OLED 55\" - LG OLED55B26LA, OLED 4K, Procesador ?7 Gen5 AI Processor 4K, Smart TV, DVB-T', 7, 999, 19),
(29, 'TV OLED 55\" - Samsung QE55S95BATXXC', 'TV OLED 55\" - Samsung QE55S95BATXXC, UHD 4K, Procesador Quantum 4K con IA, Smart TV, DVB-T', 8, 1345, 19),
(30, 'Lavadora carga frontal - Samsung WW90T534DTW/', 'Lavadora carga frontal - Samsung WW90T534DTW/S3, 9 Kg, EcoBubble, Auto-dosificación, 22 pr', 10, 459, 18),
(31, 'Lavadora carga frontal - Bosch WAU28PH1ES', 'Lavadora carga frontal - Bosch WAU28PH1ES, 9 kg, 1400 rpm, 15 Programas, Motor EcoSilence,', 11, 509, 18),
(32, 'Lavadora carga frontal - LG F2WT2008S3W', 'Lavadora carga frontal - LG F2WT2008S3W, 8 kg, 1200 rpm, 50 kWh, 14 programas, LED, 71 dB,', 9, 369, 18),
(33, 'Lavadora secadora - Candy Smart CSWS 4852DWE/', 'Lavadora secadora - Candy Smart CSWS 4852DWE/1-S, 8kg+5kg, 1400rpm, Vapor, Certificado Woo', 20, 399, 18),
(34, 'Frigorífico combi - Bosch KGN39VIEA', 'Frigorífico combi - Bosch KGN39VIEA, 368 l, 203 cm, No Frost, Acero inoxidable antihuellas', 8, 679, 20),
(35, 'Frigorífico combi - Haier 3D 60 Series 3 A3FE', 'Frigorífico combi - Haier 3D 60 Series 3 A3FE737CGJ, 371l, Total No Frost, 200cm, Motor In', 13, 649, 20),
(36, 'Frigorífico combi - Candy Fresco CCE3T618FW', 'Frigorífico combi - Candy Fresco CCE3T618FW, 344 l, Total No Frost, 185cm, Iluminación LED', 10, 399, 20),
(37, 'Frigorífico combi - Jocel JC253', 'Frigorífico combi - Jocel JC253, 253 l, 40 dB, 180 cm, Blanco', 19, 349, 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodCat`),
  ADD UNIQUE KEY `UN_NOM_CAT` (`Nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`NUM_CLIENTE`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`num_ident`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`NUM_LINEA`,`NUM_PEDIDO`),
  ADD KEY `NUM_PEDIDO` (`NUM_PEDIDO`),
  ADD KEY `COD_PRODUCTO` (`COD_PRODUCTO`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`NUM_PEDIDO`),
  ADD KEY `CLIENTE` (`CLIENTE`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`CodProd`),
  ADD KEY `CodCat` (`CodCat`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CodCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `NUM_CLIENTE` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `NUM_LINEA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `NUM_PEDIDO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `CodProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`num_ident`) REFERENCES `productos` (`CodProd`);

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_ibfk_1` FOREIGN KEY (`NUM_PEDIDO`) REFERENCES `pedidos` (`NUM_PEDIDO`),
  ADD CONSTRAINT `lineas_ibfk_2` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `productos` (`CodProd`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`CLIENTE`) REFERENCES `clientes` (`NUM_CLIENTE`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categoria` (`CodCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
