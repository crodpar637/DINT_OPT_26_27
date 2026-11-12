-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 20-11-2024 a las 23:27:59
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--
CREATE DATABASE IF NOT EXISTS `libreria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `libreria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `idgenero` int NOT NULL AUTO_INCREMENT,
  `genero` varchar(30) NOT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idgenero`, `genero`) VALUES
(1, 'Juvenil'),
(4, 'Romántico'),
(5, 'Ciencia ficción'),
(6, 'Novela'),
(9, 'Infantil'),
(12, 'Ficción épica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

DROP TABLE IF EXISTS `libro`;
CREATE TABLE IF NOT EXISTS `libro` (
  `idlibro` int NOT NULL AUTO_INCREMENT,
  `idgenero` int NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `imagen` varchar(150) NOT NULL,
  PRIMARY KEY (`idlibro`),
  KEY `FK_genero` (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idlibro`, `idgenero`, `titulo`, `autor`, `descripcion`, `imagen`) VALUES
(1, 1, 'Harry Potter y la piedra filosofal', 'J.K. Rowling', 'Un joven descubre que es un mago y comienza su aventura en Hogwarts.', 'https://images-na.ssl-images-amazon.com/images/I/81YOuOGFCJL.jpg'),
(2, 4, 'Orgullo y Prejuicio', 'Jane Austen', 'Una historia de amor y malentendidos en la Inglaterra del siglo XIX.', 'https://m.media-amazon.com/images/I/71HqC9TzbWL._SL1000_.jpg'),
(4, 5, '1984', 'George Orwell', 'Un mundo distópico dominado por un régimen totalitario.', 'https://images-na.ssl-images-amazon.com/images/I/91SZSW8qSsL.jpg'),
(5, 6, 'El Gran Gatsby', 'F. Scott Fitzgerald', 'La obsesión de un hombre por el sueño americano y su amor perdido', 'https://m.media-amazon.com/images/I/71lmSb-IajL._SL1500_.jpg'),
(6, 12, 'El señor de los anillos', 'J.R.R. Tolkien', 'La épica lucha entre el bien y el mal en la Tierra Media.', 'https://m.media-amazon.com/images/I/81jkb6N9+QL._SL1500_.jpg'),
(7, 6, 'Cien años de soledad', 'Gabriel García Márquez', 'La historia mágica y trágica de la familia Buendía en Macondo.', 'https://m.media-amazon.com/images/I/A1lNJP8sC6L._SL1500_.jpg'),
(8, 6, 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Un hidalgo pierde la cordura e inicia aventuras como caballero andante.', 'https://m.media-amazon.com/images/I/61-D06GIMQL._SL1330_.jpg'),
(9, 1, 'El Principito', 'Antoine de Saint-Exupéry', 'Un viaje poético sobre la vida, la amistad y el amor.', 'https://m.media-amazon.com/images/I/714Hvb52n-L._SL1500_.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `FK_genero` FOREIGN KEY (`idgenero`) REFERENCES `genero` (`idgenero`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
