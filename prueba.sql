-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-06-2024 a las 23:19:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `spEditar_Tarea`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEditar_Tarea` (IN `p_idTarea` INT, IN `p_titulo` VARCHAR(100), IN `p_descripcion` VARCHAR(100), IN `p_fecha` VARCHAR(100))   BEGIN
    UPDATE tarea
    SET Titulo = p_titulo,
        Descripcion = p_descripcion,
        Fecha = p_fecha
    WHERE idTarea = p_idTarea;
END$$

DROP PROCEDURE IF EXISTS `spEliminar_Tarea`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminar_Tarea` (IN `p_id` INT)   BEGIN
    delete from tarea
    where idTarea=p_id;
END$$

DROP PROCEDURE IF EXISTS `spInsertar_Tarea`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertar_Tarea` (IN `p_titulo` VARCHAR(100), IN `p_descripcion` VARCHAR(100))   BEGIN
    INSERT INTO tarea (titulo, descripcion)
    VALUES (p_titulo, p_descripcion);
END$$

DROP PROCEDURE IF EXISTS `spMostrar_Tareas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMostrar_Tareas` ()   SELECT * from tarea$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `pais`, `edad`) VALUES
(3, 'Silvia', 'Venezuela', 25),
(4, 'Ramiro Perez', 'Uruguay', 35),
(5, 'Carlos', 'Colombia', 28),
(6, 'Cristian', 'Francia', 22),
(7, 'Roberto', 'Perú', 20),
(8, 'Mauricio', 'Venezuela', 41),
(9, 'Karina', 'México', 30),
(10, 'José', 'Chile', 19),
(11, 'Beatriz', 'Colombia', 25),
(13, '12', '12dddd', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `samsara_vehicles`
--

DROP TABLE IF EXISTS `samsara_vehicles`;
CREATE TABLE IF NOT EXISTS `samsara_vehicles` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `geofence` varchar(255) DEFAULT NULL,
  `timeInGeofence` int(11) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

DROP TABLE IF EXISTS `tarea`;
CREATE TABLE IF NOT EXISTS `tarea` (
  `idTarea` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Texto` varchar(100) NOT NULL,
  `Fecha` varchar(100) NOT NULL,
  PRIMARY KEY (`idTarea`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`idTarea`, `Titulo`, `Descripcion`, `Texto`, `Fecha`) VALUES
(21, 'dd', 'ddxx', '', ''),
(22, 'aaa34454', '4444xx', '', ''),
(23, 'aaa34454', '444466666666', '', ''),
(24, 'aaa34454', '4444tttttt', '', ''),
(25, '22', '22', '', ''),
(26, '3', '3', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
