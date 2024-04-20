-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-04-2024 a las 06:33:41
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
-- Estructura de tabla para la tabla `calificacion_detalle`
--

DROP TABLE IF EXISTS `calificacion_detalle`;
CREATE TABLE IF NOT EXISTS `calificacion_detalle` (
  `id_Usuario` int NOT NULL,
  `idPub` int NOT NULL,
  `calificacion` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_Usuario`,`idPub`),
  KEY `idPub` (`idPub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE IF NOT EXISTS `carrera` (
  `nomCarrera` varchar(70) NOT NULL,
  `acronimo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`nomCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`nomCarrera`, `acronimo`) VALUES
('Arquitectura', 'ARQ'),
('Ing. Bioquimica', 'IBQ'),
('Ing. Civil', 'IC'),
('Ing. Electrica', 'IE'),
('Ing. Gestion Empresarial', 'IGE'),
('Ing. Industrial', 'II'),
('Ing. Mecatronica', 'IM'),
('Ing. Quimica', 'IQ'),
('Ing. Sistemas Computacionales', 'ISC'),
('Lic. Administracion', 'LA');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComent`, `idPub`, `idUsuario`, `text_Coment`, `fecha_Coment`) VALUES
(1, 3, 5, 'Buen documento, me sirvio para mi tarea. Te RIFASTE Fernando!!', '2024-03-27'),
(9, 3, 4, 'WAAAAOOOOO esta suuper bonita, muchas graciasss por el aporte :D', '2024-03-28'),
(10, 5, 3, 'WAOS', '2024-03-31'),
(12, 4, 10, 'Este es uno de mis mejores aportes, disfruten :D', '2023-04-03'),
(13, 4, 5, 'Ya jalan los comentarios yeeeiiii :)\r\nPD: Buen aporte', '2023-04-03'),
(14, 4, 4, 'WOW Joorgeee eres un crackkkk. ', '2023-04-03'),
(15, 5, 10, 'Excelente aporte amigo ', '2024-04-03'),
(16, 5, 10, 'Excelente', '2024-04-14');

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
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `nomMateria` varchar(70) NOT NULL,
  `nomCarrera` varchar(70) NOT NULL,
  PRIMARY KEY (`nomMateria`,`nomCarrera`),
  KEY `nomCarrera` (`nomCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`nomMateria`, `nomCarrera`) VALUES
('Administración de Empresas Constructoras I', 'Arquitectura'),
('Administración de Empresas Constructoras II', 'Arquitectura'),
('Administración de la Construcción I', 'Arquitectura'),
('Administración de la Construcción II', 'Arquitectura'),
('Análisis Crítico de la Arquitectura y el Arte I', 'Arquitectura'),
('Análisis Crítico de la Arquitectura y el Arte II', 'Arquitectura'),
('Análisis Proyectual', 'Arquitectura'),
('Análisis Crítico de la Arquitectura y el Arte III', 'Arquitectura'),
('Análisis Crítico de la Arquitectura y el Arte IV', 'Arquitectura'),
('Criterios para el Diseño Bioclimático Urbano y Arquitectónico', 'Arquitectura'),
('Desarrollo Sustentable', 'Arquitectura'),
('Disc. y Consid. Sobre el Conoc. de Pat. y de Paisaje en la Ciudad', 'Arquitectura'),
('Estética', 'Arquitectura'),
('Estructuras de Acero', 'Arquitectura'),
('Estructuras de Concreto', 'Arquitectura'),
('Estructuras I', 'Arquitectura'),
('Estructuras II', 'Arquitectura'),
('Fundamentos de Investigación', 'Arquitectura'),
('Fundamentos Teóricos del Diseño I', 'Arquitectura'),
('Fundamentos Teóricos del Diseño II', 'Arquitectura'),
('Geometría Descriptiva I', 'Arquitectura'),
('Geometría Descriptiva II', 'Arquitectura'),
('Gestión Urbanística', 'Arquitectura'),
('Historia y Teoría de la Proyectación del Paisajismo', 'Arquitectura'),
('Instalaciones I', 'Arquitectura'),
('Instalaciones II', 'Arquitectura'),
('Interv. Urb. y Arquitectónicas del Pat. y del Pai. d la Ciudad', 'Arquitectura'),
('Matemáticas Aplicadas a la Arquitectura', 'Arquitectura'),
('Met. e Instrum. Norm. en la Plan. y Dis. del Paisaje', 'Arquitectura'),
('Metodología para el Diseño', 'Arquitectura'),
('Pensamiento Arquitectónico Contemporáneo', 'Arquitectura'),
('Propiedades y Comportamiento de los Materiales', 'Arquitectura'),
('Taller de Construcción I', 'Arquitectura'),
('Taller de Construcción II', 'Arquitectura'),
('Taller de Diseño I', 'Arquitectura'),
('Taller de Diseño II', 'Arquitectura'),
('Taller de Diseño III', 'Arquitectura'),
('Taller de Diseño IV', 'Arquitectura'),
('Taller de Diseño V', 'Arquitectura'),
('Taller de Diseño VI', 'Arquitectura'),
('Taller de Expresión Plástica', 'Arquitectura'),
('Taller de Ética', 'Arquitectura'),
('Taller de Investigación I', 'Arquitectura'),
('Taller de Investigación II', 'Arquitectura'),
('Taller de Lenguaje Arquitectónico I', 'Arquitectura'),
('Taller de Lenguaje Arquitectónico II', 'Arquitectura'),
('Taller de Proyectos del Patrimonio y del Paisaje de la Ciudad', 'Arquitectura'),
('Topografía', 'Arquitectura'),
('Urbanismo I', 'Arquitectura'),
('Urbanismo II', 'Arquitectura'),
('Administración y Legislación de Empresas', 'Ing. Bioquimica'),
('Análisis de Alimentos', 'Ing. Bioquimica'),
('Análisis Instrumental', 'Ing. Bioquimica'),
('Aseguramiento de la Calidad', 'Ing. Bioquimica'),
('Auditoría Ambiental', 'Ing. Bioquimica'),
('Álgebra Lineal', 'Ing. Bioquimica'),
('Balance de Materia y Energía	', 'Ing. Bioquimica'),
('Biología Molecular', 'Ing. Bioquimica'),
('Biología', 'Ing. Bioquimica'),
('Bioquímica', 'Ing. Bioquimica'),
('Bioquímica del Nitrógeno y Regulación Genética', 'Ing. Bioquimica'),
('Biotecnología', 'Ing. Bioquimica'),
('Cálculo Diferencial', 'Ing. Bioquimica'),
('Cálculo Integral', 'Ing. Bioquimica'),
('Cálculo Vectorial', 'Ing. Bioquimica'),
('Ciencia de Alimentos', 'Ing. Bioquimica'),
('Cinética Química y Biológica', 'Ing. Bioquimica'),
('Comportamiento Organizacional', 'Ing. Bioquimica'),
('Control de la Contaminación Atmosférica', 'Ing. Bioquimica'),
('Desarrollo Sustentable', 'Ing. Bioquimica'),
('Dibujo asistido por computadora', 'Ing. Bioquimica'),
('Ecuaciones Diferenciales', 'Ing. Bioquimica'),
('Electromagnetismo', 'Ing. Bioquimica'),
('Estadística', 'Ing. Bioquimica'),
('Evaluación del Impacto Ambiental', 'Ing. Bioquimica'),
('Fenómenos de Transporte I', 'Ing. Bioquimica'),
('Fenómenos de Transporte II', 'Ing. Bioquimica'),
('Fisicoquímica', 'Ing. Bioquimica'),
('Fisiología Vegetal', 'Ing. Bioquimica'),
('Fisiología y Metabolismo Fúngico', 'Ing. Bioquimica'),
('Fisiología y Metabolismo Microbiano', 'Ing. Bioquimica'),
('Física', 'Ing. Bioquimica'),
('Formulación y Evaluación de Proyectos', 'Ing. Bioquimica'),
('Fundamentos de Investigación', 'Ing. Bioquimica'),
('Ingeniería de Alimentos', 'Ing. Bioquimica'),
('Ingeniería de Biorreactores', 'Ing. Bioquimica'),
('Ingeniería de Procesos', 'Ing. Bioquimica'),
('Ingeniería de Proyectos', 'Ing. Bioquimica'),
('Ingeniería Económica', 'Ing. Bioquimica'),
('Ingeniería y Gestión Ambiental', 'Ing. Bioquimica'),
('Instrumentación y Control', 'Ing. Bioquimica'),
('Manejo Integral de Residuos Sólidos Peligrosos', 'Ing. Bioquimica'),
('Microbiología', 'Ing. Bioquimica'),
('Operaciones Unitarias I', 'Ing. Bioquimica'),
('Operaciones Unitarias II', 'Ing. Bioquimica'),
('Operaciones Unitarias III', 'Ing. Bioquimica'),
('Programación y Métodos Numéricos', 'Ing. Bioquimica'),
('Química', 'Ing. Bioquimica'),
('Química Analítica', 'Ing. Bioquimica'),
('Química Orgánica I', 'Ing. Bioquimica'),
('Química Orgánica II', 'Ing. Bioquimica'),
('Seguridad e Higiene', 'Ing. Bioquimica'),
('Taller de Ética', 'Ing. Bioquimica'),
('Taller de Investigación I', 'Ing. Bioquimica'),
('Taller de Investigación II', 'Ing. Bioquimica'),
('Tecnología de Alimentos de Origen Animal', 'Ing. Bioquimica'),
('Tecnología de Alimentos de Origen Vegetal', 'Ing. Bioquimica'),
('Termodinámica', 'Ing. Bioquimica'),
('Tratamiento de Aguas Residuales', 'Ing. Bioquimica'),
('Abastecimiento de Agua', 'Ing. Civil'),
('Administración de la Construcción', 'Ing. Civil'),
('Alcantarillado', 'Ing. Civil'),
('Análisis Estructural', 'Ing. Civil'),
('Análisis Estructural Avanzado', 'Ing. Civil'),
('Álgebra Lineal', 'Ing. Civil'),
('Carreteras', 'Ing. Civil'),
('Cálculo Diferencial', 'Ing. Civil'),
('Cálculo Integral', 'Ing. Civil'),
('Cálculo Vectorial', 'Ing. Civil'),
('Construcción', 'Ing. Civil'),
('Costos y Presupuestos', 'Ing. Civil'),
('Desarrollo Empresarial', 'Ing. Civil'),
('Desarrollo Sustentable', 'Ing. Civil'),
('Dibujo en Ingeniería Civil', 'Ing. Civil'),
('Dinámica', 'Ing. Civil'),
('Diseño de Elementos de Acero', 'Ing. Civil'),
('Diseño de Elementos de Concreto Reforzado', 'Ing. Civil'),
('Diseño Estructural de Cimentaciones', 'Ing. Civil'),
('Diseño y Construcción de Pavimentos', 'Ing. Civil'),
('Ecuaciones Diferenciales', 'Ing. Civil'),
('Estática', 'Ing. Civil'),
('Formulación y Evaluación de Proyectos', 'Ing. Civil'),
('Fundamentos de Investigación', 'Ing. Civil'),
('Fundamentos de la Mecánica de los Medios Continuos', 'Ing. Civil'),
('Geología', 'Ing. Civil'),
('Hidráulica Básica', 'Ing. Civil'),
('Hidráulica de Canales', 'Ing. Civil'),
('Hidrología Superficial', 'Ing. Civil'),
('Instalaciones en los Edificios', 'Ing. Civil'),
('Maquinaria Pesada y Movimiento de Tierra', 'Ing. Civil'),
('Materiales y Procesos Constructivos', 'Ing. Civil'),
('Mecánica de Materiales', 'Ing. Civil'),
('Mecánica de Suelos', 'Ing. Civil'),
('Mecánica de Suelos Aplicada', 'Ing. Civil'),
('Métodos Numéricos', 'Ing. Civil'),
('Modelos de Optimización de Recursos', 'Ing. Civil'),
('Probabilidad y Estadística', 'Ing. Civil'),
('Proyectos Ejecutivos en Edificación e Infraestructura Urbana', 'Ing. Civil'),
('Proyectos Ejecutivos en Obras Hidráulicas e Ingeniería Sanitaria', 'Ing. Civil'),
('Proyectos Municipales', 'Ing. Civil'),
('Química', 'Ing. Civil'),
('Sistemas de Transporte', 'Ing. Civil'),
('Software en Ingeniería Civil', 'Ing. Civil'),
('Taller de Ética', 'Ing. Civil'),
('Taller de Investigación I', 'Ing. Civil'),
('Taller de Investigación II', 'Ing. Civil'),
('Tecnología del Concreto', 'Ing. Civil'),
('Topografía', 'Ing. Civil'),
('Auditoría Energética', 'Ing. Electrica'),
('Álgebra Lineal', 'Ing. Electrica'),
('Cálculo Diferencial', 'Ing. Electrica'),
('Cálculo Integral', 'Ing. Electrica'),
('Cálculo Vectorial', 'Ing. Electrica'),
('Centrales Eléctricas', 'Ing. Electrica'),
('Circuitos Eléctricos I', 'Ing. Electrica'),
('Circuitos Eléctricos II', 'Ing. Electrica'),
('Comunicación Humana', 'Ing. Electrica'),
('Control de Máquinas Eléctricas', 'Ing. Electrica'),
('Control I', 'Ing. Electrica'),
('Control II', 'Ing. Electrica'),
('Controlador Lógico Programable', 'Ing. Electrica'),
('Costos y Presupuesto de Proyectos Eléctricos', 'Ing. Electrica'),
('Desarrollo Humano Integral', 'Ing. Electrica'),
('Desarrollo Sustentable', 'Ing. Electrica'),
('Dibujo Asistido por Computadora', 'Ing. Electrica'),
('Domótica e Inmótica', 'Ing. Electrica'),
('Ecuaciones Diferenciales', 'Ing. Electrica'),
('Electromagnetismo', 'Ing. Electrica'),
('Electrónica Analógica', 'Ing. Electrica'),
('Electrónica Digital', 'Ing. Electrica'),
('Electrónica Industrial', 'Ing. Electrica'),
('Equipos Mecánicos', 'Ing. Electrica'),
('Física Moderna', 'Ing. Electrica'),
('Fuentes Renovables de Energía', 'Ing. Electrica'),
('Fundamentos de Investigación', 'Ing. Electrica'),
('Gestión Empresarial y Liderazgo', 'Ing. Electrica'),
('Instalaciones Eléctricas', 'Ing. Electrica'),
('Instalaciones Eléctricas Industriales', 'Ing. Electrica'),
('Instrumentación', 'Ing. Electrica'),
('Legislación en Materia Eléctrica', 'Ing. Electrica'),
('Máquinas Sincrónicas y de CD', 'Ing. Electrica'),
('Mecánica Clásica', 'Ing. Electrica'),
('Mecánica de Fluidos y Termodinámica', 'Ing. Electrica'),
('Mediciones Eléctricas', 'Ing. Electrica'),
('Métodos Numéricos', 'Ing. Electrica'),
('Modelado de Sistemas Eléctricos de Potencia', 'Ing. Electrica'),
('Motores de Inducción y Especiales', 'Ing. Electrica'),
('Probabilidad y Estadística', 'Ing. Electrica'),
('Programación', 'Ing. Electrica'),
('Pruebas y Mantenimiento Eléctrico', 'Ing. Electrica'),
('Química', 'Ing. Electrica'),
('Sistemas de Iluminación', 'Ing. Electrica'),
('Sistemas Eléctricos de Potencia', 'Ing. Electrica'),
('Sistemas Fotovoltaicos y Eólicos', 'Ing. Electrica'),
('Taller de Ética', 'Ing. Electrica'),
('Taller de Investigación I', 'Ing. Electrica'),
('Taller de Investigación II', 'Ing. Electrica'),
('Tecnología de los Materiales', 'Ing. Electrica'),
('Teoría Electromagnética', 'Ing. Electrica'),
('Transformadores', 'Ing. Electrica'),
('Administración de la Salud y Seguridad Ocupacional', 'Ing. Gestion Empresarial'),
('Álgebra Lineal', 'Ing. Gestion Empresarial'),
('Cadena de Suministros', 'Ing. Gestion Empresarial'),
('Calidad Aplicada a la Gestión Empresarial', 'Ing. Gestion Empresarial'),
('Cálculo Diferencial', 'Ing. Gestion Empresarial'),
('Cálculo Integral', 'Ing. Gestion Empresarial'),
('Comunicación Asertiva en la Era Digital', 'Ing. Gestion Empresarial'),
('Contabilidad Orientada a los Negocios', 'Ing. Gestion Empresarial'),
('Costos Empresariales', 'Ing. Gestion Empresarial'),
('Desarrollo Humano', 'Ing. Gestion Empresarial'),
('Desarrollo Sustentable', 'Ing. Gestion Empresarial'),
('Dinámica Social', 'Ing. Gestion Empresarial'),
('Diseño Organizacional', 'Ing. Gestion Empresarial'),
('Economía Empresarial', 'Ing. Gestion Empresarial'),
('El Emprendedor y la Innovación', 'Ing. Gestion Empresarial'),
('Entorno Macroeconómico', 'Ing. Gestion Empresarial'),
('Estadística Inferencial I', 'Ing. Gestion Empresarial'),
('Estadística Inferencial II', 'Ing. Gestion Empresarial'),
('Finanzas en las Organizaciones', 'Ing. Gestion Empresarial'),
('Fundamentos de Física', 'Ing. Gestion Empresarial'),
('Fundamentos de Gestión Empresarial', 'Ing. Gestion Empresarial'),
('Fundamentos de Investigación', 'Ing. Gestion Empresarial'),
('Fundamentos de Química', 'Ing. Gestion Empresarial'),
('Gestión de la Producción I', 'Ing. Gestion Empresarial'),
('Gestión de la Producción II', 'Ing. Gestion Empresarial'),
('Gestión del Capital Humano', 'Ing. Gestion Empresarial'),
('Gestión Estratégica', 'Ing. Gestion Empresarial'),
('Habilidades Directivas I', 'Ing. Gestion Empresarial'),
('Habilidades Directivas II', 'Ing. Gestion Empresarial'),
('Ingeniería de Procesos', 'Ing. Gestion Empresarial'),
('Ingeniería Económica', 'Ing. Gestion Empresarial'),
('Instrumentos de Presupuestación Empresarial', 'Ing. Gestion Empresarial'),
('Investigación de Operaciones', 'Ing. Gestion Empresarial'),
('Legislación Laboral', 'Ing. Gestion Empresarial'),
('Liderazgo Digital', 'Ing. Gestion Empresarial'),
('Marco Legal de las Organizaciones', 'Ing. Gestion Empresarial'),
('Mercadotecnia', 'Ing. Gestion Empresarial'),
('Mercadotecnia Electrónica', 'Ing. Gestion Empresarial'),
('Mercadotecnia Interacional', 'Ing. Gestion Empresarial'),
('Plan de Negocios', 'Ing. Gestion Empresarial'),
('Probabilidad y Estadística Descriptiva', 'Ing. Gestion Empresarial'),
('Proceso de Acreditación y Certificación', 'Ing. Gestion Empresarial'),
('Proyectos de Exportación', 'Ing. Gestion Empresarial'),
('Sistemas de Información de Mercadotecnia', 'Ing. Gestion Empresarial'),
('Software de Aplicación Ejecutivo', 'Ing. Gestion Empresarial'),
('Taller de Ética', 'Ing. Gestion Empresarial'),
('Taller de Investigación I', 'Ing. Gestion Empresarial'),
('Taller de Investigación II', 'Ing. Gestion Empresarial'),
('Administración de las Operaciones I', 'Ing. Industrial'),
('Administración de las Operaciones II', 'Ing. Industrial'),
('Administración de Proyectos', 'Ing. Industrial'),
('Administración del Mantenimiento', 'Ing. Industrial'),
('Algoritmos y Lenguajes de Programación', 'Ing. Industrial'),
('Análisis de la Realidad Nacional', 'Ing. Industrial'),
('Álgebra Lineal', 'Ing. Industrial'),
('Cálculo Diferencial', 'Ing. Industrial'),
('Cálculo Integral', 'Ing. Industrial'),
('Cálculo Vectorial', 'Ing. Industrial'),
('Control Estadístico de la Calidad', 'Ing. Industrial'),
('Desarrollo Sustentable', 'Ing. Industrial'),
('Dibujo Industrial', 'Ing. Industrial'),
('Economía', 'Ing. Industrial'),
('Electricidad y Electrónica Industrial', 'Ing. Industrial'),
('Ergonomía', 'Ing. Industrial'),
('Estadistica Inferencial II', 'Ing. Industrial'),
('Estadística Inferencial I', 'Ing. Industrial'),
('Estudio del Trabajo I', 'Ing. Industrial'),
('Estudio del Trabajo II', 'Ing. Industrial'),
('Física', 'Ing. Industrial'),
('Formulación y Evaluación de Proyectos', 'Ing. Industrial'),
('Fundamentos de Investigación', 'Ing. Industrial'),
('Gestión de Sistemas de Calidad Aplicados', 'Ing. Industrial'),
('Gestión de Costos', 'Ing. Industrial'),
('Gestión de los Sistemas de Calidad', 'Ing. Industrial'),
('Higiene y Seguridad Industrial', 'Ing. Industrial'),
('Ingeniería de Sistemas', 'Ing. Industrial'),
('Ingeniería Económica', 'Ing. Industrial'),
('Investigación de Operaciones I', 'Ing. Industrial'),
('Investigación de Operaciones II', 'Ing. Industrial'),
('Logística y Cadenas de Suministro', 'Ing. Industrial'),
('Medición y Mejoramiento de la Productividad', 'Ing. Industrial'),
('Mercadotecnia', 'Ing. Industrial'),
('Metrología y Normalización', 'Ing. Industrial'),
('Planeación Financiera', 'Ing. Industrial'),
('Planeación y Diseño de Instalaciones', 'Ing. Industrial'),
('Probabilidad y Estadistica', 'Ing. Industrial'),
('Procesos de Fabricación', 'Ing. Industrial'),
('Propiedad de los Materiales', 'Ing. Industrial'),
('Química', 'Ing. Industrial'),
('Relaciones Industriales', 'Ing. Industrial'),
('Simulación', 'Ing. Industrial'),
('Sistemas de Manufactura', 'Ing. Industrial'),
('Taller de Ética', 'Ing. Industrial'),
('Taller de Herramientas Intelectuales', 'Ing. Industrial'),
('Taller de Investigación I', 'Ing. Industrial'),
('Taller de Investigación II', 'Ing. Industrial'),
('Taller de Liderazgo', 'Ing. Industrial'),
('Administración y Contabilidad', 'Ing. Mecatronica'),
('Análisis de Circuitos Eléctricos', 'Ing. Mecatronica'),
('Análisis de Fluidos', 'Ing. Mecatronica'),
('Álgebra Lineal', 'Ing. Mecatronica'),
('Cálculo Diferencial', 'Ing. Mecatronica'),
('Cálculo Integral', 'Ing. Mecatronica'),
('Cálculo Vectorial', 'Ing. Mecatronica'),
('Ciencia e Ingeniería de Materiales', 'Ing. Mecatronica'),
('Circuitos Hidráulicos y Neumáticos', 'Ing. Mecatronica'),
('Control', 'Ing. Mecatronica'),
('Controladores Lógicos Programables', 'Ing. Mecatronica'),
('Desarrollo Sustentable', 'Ing. Mecatronica'),
('Dibujo Asistido por Computadora', 'Ing. Mecatronica'),
('Dinámica', 'Ing. Mecatronica'),
('Dinámica de Sistemas', 'Ing. Mecatronica'),
('Diseño de Elementos Mecánicos', 'Ing. Mecatronica'),
('Ecuaciones Diferenciales', 'Ing. Mecatronica'),
('Electromagnetismo', 'Ing. Mecatronica'),
('Electrónica Analógica', 'Ing. Mecatronica'),
('Electrónica de Potencia Aplicada', 'Ing. Mecatronica'),
('Electrónica Digital', 'Ing. Mecatronica'),
('Estadística y Control de Calidad', 'Ing. Mecatronica'),
('Estática', 'Ing. Mecatronica'),
('Formulación y Evaluación de Proyectos', 'Ing. Mecatronica'),
('Fundamentos de Investigación', 'Ing. Mecatronica'),
('Fundamentos de Termodinámica', 'Ing. Mecatronica'),
('Instrumentación Biomédica', 'Ing. Mecatronica'),
('Instrumentación', 'Ing. Mecatronica'),
('Internet de las Cosas (IOT)', 'Ing. Mecatronica'),
('Mantenimiento', 'Ing. Mecatronica'),
('Mantenimiento de Sistemas Mecatrónicos', 'Ing. Mecatronica'),
('Manufactura Avanzada', 'Ing. Mecatronica'),
('Manufactura Avanzada II', 'Ing. Mecatronica'),
('Máquinas Eléctricas', 'Ing. Mecatronica'),
('Mecanismos', 'Ing. Mecatronica'),
('Mecánica de Materiales', 'Ing. Mecatronica'),
('Metrología y Normalización', 'Ing. Mecatronica'),
('Métodos Numéricos', 'Ing. Mecatronica'),
('Microcontroladores', 'Ing. Mecatronica'),
('Procesos de Fabricación', 'Ing. Mecatronica'),
('Programación Avanzada', 'Ing. Mecatronica'),
('Programación Básica', 'Ing. Mecatronica'),
('Química', 'Ing. Mecatronica'),
('Redes Industriales, Protocolos de Comunicación y Buses de Campo', 'Ing. Mecatronica'),
('Robótica', 'Ing. Mecatronica'),
('Taller de Ética', 'Ing. Mecatronica'),
('Taller de Investigación I', 'Ing. Mecatronica'),
('Taller de Investigación II', 'Ing. Mecatronica'),
('Vibraciones Mecánicas', 'Ing. Mecatronica'),
('Análisis de Datos Experimentales', 'Ing. Quimica'),
('Análisis Instrumental', 'Ing. Quimica'),
('Auditoría Ambiental', 'Ing. Quimica'),
('Álgebra Lineal', 'Ing. Quimica'),
('Balance de Materia y Energía', 'Ing. Quimica'),
('Balance de Momento, Calor y Masa', 'Ing. Quimica'),
('Cálculo Diferencial', 'Ing. Quimica'),
('Cálculo Integral', 'Ing. Quimica'),
('Cálculo Vectorial', 'Ing. Quimica'),
('Control de la Contaminación Atmosférica', 'Ing. Quimica'),
('Desarrollo Sustentable', 'Ing. Quimica'),
('Dibujo asistido por computadora', 'Ing. Quimica'),
('Ecuaciones Diferenciales', 'Ing. Quimica'),
('Electricidad, Magnetismo y Óptica', 'Ing. Quimica'),
('Evaluación del Impacto Ambiental', 'Ing. Quimica'),
('Fisicoquímica I', 'Ing. Quimica'),
('Fisicoquímica II', 'Ing. Quimica'),
('Fundamentos de Investigación', 'Ing. Quimica'),
('Gestión de la Calidad', 'Ing. Quimica'),
('Ingeniería Ambiental', 'Ing. Quimica'),
('Ingeniería de Costos', 'Ing. Quimica'),
('Ingeniería de Proyectos', 'Ing. Quimica'),
('Instrumentación y Control', 'Ing. Quimica'),
('Laboratorio Integral I', 'Ing. Quimica'),
('Laboratorio Integral II', 'Ing. Quimica'),
('Laboratorio Integral III', 'Ing. Quimica'),
('Manejo Integral de Residuos Sólidos Peligrosos', 'Ing. Quimica'),
('Mecanismos de Transferencia', 'Ing. Quimica'),
('Mecánica Clásica', 'Ing. Quimica'),
('Métodos Numéricos', 'Ing. Quimica'),
('Procesos de Separación I', 'Ing. Quimica'),
('Procesos de Separación II', 'Ing. Quimica'),
('Procesos de Separación III', 'Ing. Quimica'),
('Programación', 'Ing. Quimica'),
('Química Analítica', 'Ing. Quimica'),
('Química Inorgánica', 'Ing. Quimica'),
('Química Orgánica I', 'Ing. Quimica'),
('Química Orgánica II', 'Ing. Quimica'),
('Reactores Químicos', 'Ing. Quimica'),
('Salud y Seguridad en el Trabajo', 'Ing. Quimica'),
('Simulación de Procesos', 'Ing. Quimica'),
('Síntesis y Optimización de Procesos', 'Ing. Quimica'),
('Taller de Administración Gerencial', 'Ing. Quimica'),
('Taller de Ética', 'Ing. Quimica'),
('Taller de Investigación I', 'Ing. Quimica'),
('Taller de Investigación II', 'Ing. Quimica'),
('Termodinámica', 'Ing. Quimica'),
('Tratamiento de Aguas Residuales', 'Ing. Quimica'),
('Administración de Base de Datos', 'Ing. Sistemas Computacionales'),
('Administración de Redes', 'Ing. Sistemas Computacionales'),
('Arquitectura de Computadoras', 'Ing. Sistemas Computacionales'),
('Álgebra Lineal', 'Ing. Sistemas Computacionales'),
('Bases de Datos NoSQL', 'Ing. Sistemas Computacionales'),
('Cálculo Diferencial', 'Ing. Sistemas Computacionales'),
('Cálculo Integral', 'Ing. Sistemas Computacionales'),
('Cálculo Vectorial', 'Ing. Sistemas Computacionales'),
('Conmutación y Enrutamiento en Redes de Datos', 'Ing. Sistemas Computacionales'),
('Contabilidad Financiera', 'Ing. Sistemas Computacionales'),
('Cultura Empresarial', 'Ing. Sistemas Computacionales'),
('Desarrollo de Aplicaciones Multiplataforma', 'Ing. Sistemas Computacionales'),
('Desarrollo de Servicios Web', 'Ing. Sistemas Computacionales'),
('Desarrollo Sustentable', 'Ing. Sistemas Computacionales'),
('Ecuaciones Diferenciales', 'Ing. Sistemas Computacionales'),
('Estructura de Datos', 'Ing. Sistemas Computacionales'),
('Física General', 'Ing. Sistemas Computacionales'),
('Fundamentos de Base de Datos', 'Ing. Sistemas Computacionales'),
('Fundamentos de Ingeniería de Software', 'Ing. Sistemas Computacionales'),
('Fundamentos de Investigación', 'Ing. Sistemas Computacionales'),
('Fundamentos de Programación', 'Ing. Sistemas Computacionales'),
('Fundamentos de Telecomunicaciones', 'Ing. Sistemas Computacionales'),
('Gestión de Proyectos de Software', 'Ing. Sistemas Computacionales'),
('Graficación', 'Ing. Sistemas Computacionales'),
('Habilidades Directivas Aplicadas a Empresas TICs', 'Ing. Sistemas Computacionales'),
('Ingeniería de Software', 'Ing. Sistemas Computacionales'),
('Inteligencia Artificial', 'Ing. Sistemas Computacionales'),
('Interfaces Web', 'Ing. Sistemas Computacionales'),
('Investigación de Operaciones', 'Ing. Sistemas Computacionales'),
('Lenguajes de Interfaz', 'Ing. Sistemas Computacionales'),
('Lenguajes y Autómatas I', 'Ing. Sistemas Computacionales'),
('Lenguajes y Autómatas II', 'Ing. Sistemas Computacionales'),
('Matemáticas Discretas', 'Ing. Sistemas Computacionales'),
('Métodos Numéricos', 'Ing. Sistemas Computacionales'),
('Principios Eléctricos y Aplicaciones Digitales', 'Ing. Sistemas Computacionales'),
('Probabilidad y Estadística', 'Ing. Sistemas Computacionales'),
('Programación Lógica y Funcional', 'Ing. Sistemas Computacionales'),
('Programación Orientada a Objetos', 'Ing. Sistemas Computacionales'),
('Programación Web', 'Ing. Sistemas Computacionales'),
('Química', 'Ing. Sistemas Computacionales'),
('Redes de Computadoras', 'Ing. Sistemas Computacionales'),
('Simulación', 'Ing. Sistemas Computacionales'),
('Sistemas Operativos', 'Ing. Sistemas Computacionales'),
('Sistemas Programables', 'Ing. Sistemas Computacionales'),
('Taller de Administración', 'Ing. Sistemas Computacionales'),
('Taller de Base de Datos', 'Ing. Sistemas Computacionales'),
('Taller de Ética', 'Ing. Sistemas Computacionales'),
('Taller de Investigación I', 'Ing. Sistemas Computacionales'),
('Taller de Investigación II', 'Ing. Sistemas Computacionales'),
('Taller de Sistemas Operativos', 'Ing. Sistemas Computacionales'),
('Tópicos Avanzados de Programación', 'Ing. Sistemas Computacionales'),
('Administración de la Calidad', 'Lic. Administracion'),
('Administración Financiera I', 'Lic. Administracion'),
('Administración Financiera II', 'Lic. Administracion'),
('Clínica Empresarial', 'Lic. Administracion'),
('Comportamiento Organizacional', 'Lic. Administracion'),
('Comunicación Corporativa', 'Lic. Administracion'),
('Consultoría Empresarial', 'Lic. Administracion'),
('Contabilidad General', 'Lic. Administracion'),
('Contabilidad Gerencial', 'Lic. Administracion'),
('Costos de Manufactura', 'Lic. Administracion'),
('Derecho Empresarial', 'Lic. Administracion'),
('Derecho Fiscal', 'Lic. Administracion'),
('Derecho Laboral y Seguridad Social', 'Lic. Administracion'),
('Desarrollo Organizacional', 'Lic. Administracion'),
('Desarrollo Sustentable', 'Lic. Administracion'),
('Diagnóstico y Evaluación Empresarial', 'Lic. Administracion'),
('Dinámica Social', 'Lic. Administracion'),
('Economía Empresarial', 'Lic. Administracion'),
('Economía Internacional', 'Lic. Administracion'),
('Estadística para la Administración I', 'Lic. Administracion'),
('Estadística para la Administración II', 'Lic. Administracion'),
('Estrategias de Negocios', 'Lic. Administracion'),
('Formulación y Evaluación de Proyectos', 'Lic. Administracion'),
('Función Administrativa I', 'Lic. Administracion'),
('Función Administrativa II', 'Lic. Administracion'),
('Fundamentos de Investigación', 'Lic. Administracion'),
('Fundamentos de Mercadotecnia', 'Lic. Administracion'),
('Gestión de la Retribución', 'Lic. Administracion'),
('Gestión Estratégica del Capital Humano I', 'Lic. Administracion'),
('Gestión Estratégica del Capital Humano II', 'Lic. Administracion'),
('Informática para la Administración', 'Lic. Administracion'),
('Innovación y Emprendedurismo', 'Lic. Administracion'),
('Macroeconomía', 'Lic. Administracion'),
('Matemáticas Aplicadas a la Administración', 'Lic. Administracion'),
('Matemáticas Financieras', 'Lic. Administracion'),
('Mercadotecnia Digital', 'Lic. Administracion'),
('Mezcla de Mercadotecnia', 'Lic. Administracion'),
('Métodos Cuantitativos para la Administración', 'Lic. Administracion'),
('Plan de Negocios', 'Lic. Administracion'),
('Procesos de Dirección', 'Lic. Administracion'),
('Procesos Estructurales', 'Lic. Administracion'),
('Producción', 'Lic. Administracion'),
('Sistemas de Información de Mercadotecnia', 'Lic. Administracion'),
('Sistemas Integrales de Información', 'Lic. Administracion'),
('Taller de Desarrollo Humano', 'Lic. Administracion'),
('Taller de Ética', 'Lic. Administracion'),
('Taller de Investigación I', 'Lic. Administracion'),
('Taller de Investigación II', 'Lic. Administracion'),
('Teoría General de la Administración', 'Lic. Administracion');

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
(5, 1, 'Metodologia SCRUM', '2024-03-18', 'Lo que debes saber sobre la Metodologia Scrum', '10', 'Ing. Sistemas Computacionales', 'Ingenieria de Software', 'Aporte', '../Publicacion.pdf');

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
  `carrera_Us` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `semestre_Us` varchar(50) NOT NULL,
  `correo_Us` varchar(100) NOT NULL,
  `contra_Us` varchar(60) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `carrera_Us` (`carrera_Us`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nom_Us`, `apell_Us`, `carrera_Us`, `semestre_Us`, `correo_Us`, `contra_Us`) VALUES
(1, 'Jorge', 'Vargas', 'Ing. Sistemas Computacionales', '6', 'jorge@gmail.com', '12345678'),
(2, 'Maria', 'DB', 'Arquitectura', '7', 'mariadb@ittepic.edu.mx', '12345678'),
(3, 'Javier', 'DB', 'Ing. Civil', '8', 'javierdb@ittepic.edu.mx', '$2y$10$gLoihHD8cQm7tBTvR8oN/.MlbnU8XjGEKWpK0.ZuSEMN/snUcWyDi'),
(4, 'Rebeca', 'Ramirez', 'Ing. Sistemas Computacionales', '6', 'Rebeca@ittepic.edu.mx', '$2y$10$gLoihHD8cQm7tBTvR8oN/.MlbnU8XjGEKWpK0.ZuSEMN/snUcWyDi'),
(5, 'Yvan', 'Acosta', 'Ing. Sistemas Computacionales', '6', 'yvfeacostaca@ittepic.edu.mx', '$2y$10$gLoihHD8cQm7tBTvR8oN/.MlbnU8XjGEKWpK0.ZuSEMN/snUcWyDi'),
(10, 'Jorge', 'Mendoza', 'Ing. Sistemas Computacionales', '8', 'joluvargaspa@ittepic.edu.mx', '$2y$10$KV8tBYdz5GKrauJb4hFp6uaOPWvjkBv8SxAB2AwQ1WxgVZlvrvvUe');

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
-- Filtros para la tabla `calificacion_detalle`
--
ALTER TABLE `calificacion_detalle`
  ADD CONSTRAINT `calificacion_detalle_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `calificacion_detalle_ibfk_2` FOREIGN KEY (`idPub`) REFERENCES `publicacion` (`idPub`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_Comentario_Publicacion` FOREIGN KEY (`idPub`) REFERENCES `publicacion` (`idPub`),
  ADD CONSTRAINT `fk_Comentario_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`nomCarrera`) REFERENCES `carrera` (`nomCarrera`);

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
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`carrera_Us`) REFERENCES `carrera` (`nomCarrera`);

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
