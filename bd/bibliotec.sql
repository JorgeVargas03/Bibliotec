-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-04-2024 a las 05:22:38
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bibliotec`
--
CREATE DATABASE IF NOT EXISTS `bibliotec` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `bibliotec`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdmin` int NOT NULL AUTO_INCREMENT,
  `correo_Admin` varchar(100) NOT NULL,
  `contra_Admin` varchar(45) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdmin`, `correo_Admin`, `contra_Admin`) VALUES
(1, 'rebeca@hotmail.com', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `idComent` int NOT NULL AUTO_INCREMENT,
  `idPub` int NOT NULL,
  `idUsuario` int NOT NULL,
  `text_Coment` text NOT NULL,
  `fecha_Coment` date NOT NULL,
  PRIMARY KEY (`idComent`),
  KEY `fk_Comentario_Publicacion_idx` (`idPub`),
  KEY `fk_Comentario_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComent`, `idPub`, `idUsuario`, `text_Coment`, `fecha_Coment`) VALUES
(1, 3, 5, 'Buen documento, me sirvio para mi tarea. Te RIFASTE Fernando!!', '2024-03-27'),
(2, 3, 4, 'WAAAAOOOOO esta suuper bonita, muchas graciasss por el aporte :D', '2024-03-28'),
(3, 5, 3, 'WAOS', '2024-03-31'),
(8, 4, 10, 'Este es uno de mis mejores aportes, disfruten :D', '2023-04-03'),
(9, 4, 5, 'Ya jalan los comentarios yeeeiiii :)\r\nPD: Buen aporte', '2023-04-03'),
(10, 4, 4, 'WOW Joorgeee eres un crackkkk. ', '2023-04-03'),
(12, 5, 10, 'Excelente aporte amigo ', '2024-04-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insignia`
--

DROP TABLE IF EXISTS `insignia`;
CREATE TABLE IF NOT EXISTS `insignia` (
  `idInsignia` int NOT NULL AUTO_INCREMENT,
  `tipo_Insig` varchar(45) NOT NULL,
  PRIMARY KEY (`idInsignia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
CREATE TABLE IF NOT EXISTS `publicacion` (
  `idPub` int NOT NULL AUTO_INCREMENT,
  `id_Usuario` int NOT NULL,
  `titulo_Pub` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha_Pub` date NOT NULL,
  `descrip_Pub` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `calif_Pub` decimal(10,0) NOT NULL,
  `carrera_Pub` varchar(45) NOT NULL,
  `materia_Pub` varchar(60) NOT NULL,
  `tipo_pub` varchar(45) NOT NULL,
  `archivo_Pub` varchar(100) NOT NULL,
  PRIMARY KEY (`idPub`),
  KEY `fk_Publicacion_Usuario1_idx` (`id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`idPub`, `id_Usuario`, `titulo_Pub`, `fecha_Pub`, `descrip_Pub`, `calif_Pub`, `carrera_Pub`, `materia_Pub`, `tipo_pub`, `archivo_Pub`) VALUES
(1, 1, 'Mi primera publicacion', '2024-03-18', 'Hola a todos amigos, mi primer aporte :)', '5', 'Ing. Sistemas Computacionales', 'Ingenieria de Software', 'Aporte', 'libroHTML.pdf'),
(2, 1, 'Curso de Cocina de Benigno', '2024-03-18', 'Hola a todos amigos, mi segundo aporte :)', '7', 'Ing. Sistemas Computacionales', 'Ingenieria de Software', 'Aporte', 'RecetasBenigno.pdf'),
(3, 1, 'Como resolver una Ecuacion Diferencial', '2024-03-18', 'Hola a todos amigos, mi tercer aporte :)', '10', 'Ing. Sistemas Computacionales', 'Ingenieria de Software', 'Aporte', 'EcuacionesDiferenciales.pdf'),
(4, 1, 'Curso de HTML+PHP', '2024-03-18', 'Les comparto mi libro de HTML', '10', 'Ing. Sistemas Computacionales', 'Ingenieria de Software', 'Aporte', 'libroHTML.pdf'),
(5, 1, 'Metodologia SCRUM', '2024-03-18', 'Lo que debes saber sobre la Metodologia Scrum', '10', 'Ing. Sistemas Computacionales', 'Ingenieria de Software', 'Aporte', 'SCRUM.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones_pendientes`
--

DROP TABLE IF EXISTS `publicaciones_pendientes`;
CREATE TABLE IF NOT EXISTS `publicaciones_pendientes` (
  `idPub` int NOT NULL AUTO_INCREMENT,
  `id_Usuario` int NOT NULL,
  `titulo_Pub` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha_Pub` date NOT NULL,
  `descrip_Pub` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `calif_Pub` decimal(10,2) NOT NULL,
  `carrera_Pub` varchar(45) NOT NULL,
  `materia_Pub` varchar(60) NOT NULL,
  `tipo_pub` varchar(45) NOT NULL,
  `archivo_Pub` varchar(100) NOT NULL,
  `estado_Pub` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPub`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `publicaciones_pendientes`
--

INSERT INTO `publicaciones_pendientes` (`idPub`, `id_Usuario`, `titulo_Pub`, `fecha_Pub`, `descrip_Pub`, `calif_Pub`, `carrera_Pub`, `materia_Pub`, `tipo_pub`, `archivo_Pub`, `estado_Pub`) VALUES
(1, 3, 'Eclipses', '2024-04-01', 'Mi aporte acerca de lo impresionantes que son los eclipses solares, y el como poder observarlos', '4.00', 'Ing. Civil', 'Dinamica de Materiales', 'Informativa', 'eclipses.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportecomentario`
--

DROP TABLE IF EXISTS `reportecomentario`;
CREATE TABLE IF NOT EXISTS `reportecomentario` (
  `idReporteCom` int NOT NULL AUTO_INCREMENT,
  `idComent` int NOT NULL,
  `fecha_Report` date NOT NULL,
  `motivo_Report` varchar(70) NOT NULL,
  `estado_Report` tinyint NOT NULL,
  PRIMARY KEY (`idReporteCom`),
  KEY `fk_ReporteComentario_Comentario1_idx` (`idComent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `reportecomentario`
--

INSERT INTO `reportecomentario` (`idReporteCom`, `idComent`, `fecha_Report`, `motivo_Report`, `estado_Report`) VALUES
(1, 1, '2024-03-28', 'Lenguaje inapropiado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportepublicación`
--

DROP TABLE IF EXISTS `reportepublicación`;
CREATE TABLE IF NOT EXISTS `reportepublicación` (
  `idReporte` int NOT NULL AUTO_INCREMENT,
  `idPub` int NOT NULL,
  `fecha_Report` date NOT NULL,
  `motivo_Report` varchar(60) NOT NULL,
  `estado_Report` tinyint(1) NOT NULL,
  PRIMARY KEY (`idReporte`),
  KEY `fk_ReportePublicación_Publicacion1_idx` (`idPub`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `reportepublicación`
--

INSERT INTO `reportepublicación` (`idReporte`, `idPub`, `fecha_Report`, `motivo_Report`, `estado_Report`) VALUES
(1, 3, '2024-04-03', 'Se registró contenido plagiado.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nom_Us` varchar(50) NOT NULL,
  `apell_Us` varchar(50) NOT NULL,
  `carrera_Us` varchar(60) NOT NULL,
  `semestre_Us` varchar(50) NOT NULL,
  `correo_Us` varchar(100) NOT NULL,
  `contra_Us` varchar(60) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nom_Us`, `apell_Us`, `carrera_Us`, `semestre_Us`, `correo_Us`, `contra_Us`) VALUES
(1, 'Jorge', 'Vargas', 'Ing. Sistemas Computacionales', '6', 'jorge@gmail.com', '12345678'),
(2, 'Maria', 'DB', 'Aquitectura', '7', 'mariadb@ittepic.edu.mx', '12345678'),
(3, 'Javier', 'DB', 'IC', '8', 'javierdb@ittepic.edu.mx', '$2y$10$gLoihHD8cQm7tBTvR8oN/.MlbnU8XjGEKWpK0.ZuSEMN/snUcWyDi'),
(4, 'Rebeca', 'Ramirez', 'Ing. Sistemas Computacionales', '6', 'Rebeca@ittepic.edu.mx', '$2y$10$gLoihHD8cQm7tBTvR8oN/.MlbnU8XjGEKWpK0.ZuSEMN/snUcWyDi'),
(5, 'Yvan', 'Acosta', 'Ing. Sistemas Computacionales', '6', 'yvfeacostaca@ittepic.edu.mx', '$2y$10$gLoihHD8cQm7tBTvR8oN/.MlbnU8XjGEKWpK0.ZuSEMN/snUcWyDi'),
(10, 'Jorge', 'Mendoza', 'Ing. Sistemas Computacionales', '8', 'joluvargaspa@ittepic.edu.mx', '$2y$10$tPxDnWlKfAuN35pCvnfdL.u9tLI9ByiK1ld62IVi50p63AwIpZkHO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_insignia`
--

DROP TABLE IF EXISTS `usuario_insignia`;
CREATE TABLE IF NOT EXISTS `usuario_insignia` (
  `idInsignia` int NOT NULL,
  `idUsuario` int NOT NULL,
  `cant` int NOT NULL,
  KEY `fk_Usuario_Insignia_Insignia1_idx` (`idInsignia`),
  KEY `fk_Usuario_Insignia_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_temp`
--

DROP TABLE IF EXISTS `usuario_temp`;
CREATE TABLE IF NOT EXISTS `usuario_temp` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nom_Us` varchar(50) NOT NULL,
  `apell_Us` varchar(50) NOT NULL,
  `carrera_Us` varchar(60) NOT NULL,
  `semestre_Us` varchar(50) NOT NULL,
  `correo_Us` varchar(100) NOT NULL,
  `contra_Us` varchar(60) NOT NULL,
  `token` varchar(5) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_Comentario_Publicacion` FOREIGN KEY (`idPub`) REFERENCES `publicacion` (`idPub`),
  ADD CONSTRAINT `fk_Comentario_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `fk_Publicacion_Usuario1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `reportecomentario`
--
ALTER TABLE `reportecomentario`
  ADD CONSTRAINT `fk_ReporteComentario_Comentario1` FOREIGN KEY (`idComent`) REFERENCES `comentario` (`idComent`);

--
-- Filtros para la tabla `reportepublicación`
--
ALTER TABLE `reportepublicación`
  ADD CONSTRAINT `fk_ReportePublicación_Publicacion1` FOREIGN KEY (`idPub`) REFERENCES `publicacion` (`idPub`);

--
-- Filtros para la tabla `usuario_insignia`
--
ALTER TABLE `usuario_insignia`
  ADD CONSTRAINT `fk_Usuario_Insignia_Insignia1` FOREIGN KEY (`idInsignia`) REFERENCES `insignia` (`idInsignia`),
  ADD CONSTRAINT `fk_Usuario_Insignia_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
