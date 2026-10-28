-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2017 a las 00:00:41
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--
CREATE DATABASE IF NOT EXISTS `empresa` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `empresa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componente`
--

DROP TABLE IF EXISTS `componente`;
CREATE TABLE `componente` (
  `idcomponente` int(4) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `idtipo` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `componente`
--

INSERT INTO `componente` (`idcomponente`, `nombre`, `descripcion`, `precio`, `idtipo`) VALUES
(1, 'Tarjeta wifi TPLINK 432', 'Tarjeta wifi fina, fina, que se conecta sin password a cualquier punto de acceso', '102.33', 1),
(2, 'intel i5 7200', 'Procesador de gama media Intel', '223.22', 2),
(3, 'ASUS H81M', 'Placa base Asus de gama alta', '324.90', 3),
(4, 'MODULO DDR4 16 GB', 'Modulo de memoria de 16 GB', '45.94', 4),
(5, 'Kingston SSD 240 GB', 'Disco SSD 240 GB de altas prestaciones', '90.25', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `idfactura` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `fecha`, `cliente`, `total`) VALUES
(1, '2017-06-15', 'Francisco Talamino', '325.55'),
(2, '2017-06-16', 'Joaquín Franco', '1066.58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

DROP TABLE IF EXISTS `linea`;
CREATE TABLE `linea` (
  `idlinea` int(5) NOT NULL,
  `idfactura` int(5) DEFAULT NULL,
  `idcomponente` int(5) DEFAULT NULL,
  `unidades` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`idlinea`, `idfactura`, `idcomponente`, `unidades`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 3, 3),
(4, 2, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `idtipo` int(3) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`idtipo`, `tipo`, `descripcion`) VALUES
(1, 'REDES', 'Material de redes: switches, routers, cables,...'),
(2, 'PROCESADORES', 'Procesadores para PC'),
(3, 'PLACAS BASE', 'Placas base para pc\'s'),
(4, 'MEMORIAS', 'Memorias RAM, SD y USB'),
(5, 'DISCOS', 'Discos duros convencionales y SSD');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`idcomponente`),
  ADD KEY `FK_TIPO` (`idtipo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`idlinea`),
  ADD KEY `FK_FACTURA` (`idfactura`),
  ADD KEY `FK_COMPONENTE` (`idcomponente`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idtipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `componente`
--
ALTER TABLE `componente`
  MODIFY `idcomponente` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `idlinea` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `idtipo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `componente`
--
ALTER TABLE `componente`
  ADD CONSTRAINT `FK_TIPO` FOREIGN KEY (`idtipo`) REFERENCES `tipo` (`idtipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `linea`
--
ALTER TABLE `linea`
  ADD CONSTRAINT `FK_COMPONENTE` FOREIGN KEY (`idcomponente`) REFERENCES `componente` (`idcomponente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FACTURA` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
