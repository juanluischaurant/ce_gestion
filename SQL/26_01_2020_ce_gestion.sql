-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 04:28 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `26_01_2020_ce_gestion`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_pago_nuevo` (IN `id_banco` INT(2), IN `id_tipo_de_operacion` INT(1), IN `cedula_titular` INT(8), IN `numero_referencia_bancaria` VARCHAR(45), IN `monto_operacion` DECIMAL(10,2), IN `fecha_operacion` DATE)  BEGIN 

 INSERT INTO `pago_de_inscripcion`(`id_banco`, `id_tipo_de_operacion`, `cedula_titular`, `numero_referencia_bancaria`, `monto_operacion`, `fecha_operacion`) 
 VALUES (id_banco, id_tipo_de_operacion, cedula_titular, numero_referencia_bancaria, monto_operacion, fecha_operacion);
  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE `accion` (
  `id` int(11) NOT NULL COMMENT 'ID de la tabla',
  `username` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Referencia al usuario del sistema que realizó la acción',
  `id_tipo_accion` int(2) NOT NULL COMMENT 'Referencia al tipo de acción realizada',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la acción realizada',
  `tabla_afectada` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tabla afectada por la operación',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura automáticamente la hora de creación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`id`, `username`, `id_tipo_accion`, `descripcion`, `tabla_afectada`, `fecha_registro`) VALUES
(1, 'johan-1213', 2, 'CÉDULA: 23432288', 'PERSONA', '2020-01-30 19:50:16'),
(4, 'johan-1213', 2, 'CÉDULA: 11244320', 'PARTICIPANTE', '2020-01-30 20:17:57'),
(5, 'johan-1213', 2, 'CÉDULA: 11244320', 'TITULAR', '2020-01-30 20:17:58'),
(6, 'johan-1213', 2, 'CÉDULA: 25344269', 'PARTICIPANTE', '2020-01-30 21:27:39'),
(7, 'johan-1213', 2, 'CÉDULA: 25344269', 'TITULAR', '2020-01-30 21:27:39'),
(8, 'johan-1213', 3, 'CÉDULA: 23432288', 'PERSONA', '2020-01-30 21:36:30'),
(9, 'johan-1213', 3, 'CÉDULA: 23432288', 'PERSONA', '2020-02-02 12:10:31'),
(10, 'johan-1213', 3, 'CÉDULA: 11244320', 'PERSONA', '2020-02-02 13:50:21'),
(11, 'johan-1213', 2, 'CÉDULA: 1861618', 'PERSONA', '2020-02-03 21:13:40'),
(12, 'johan-1213', 2, 'CÉDULA: 1861618', 'PARTICIPANTE', '2020-02-03 21:14:57'),
(13, 'johan-1213', 2, 'CÉDULA: 1861618', 'TITULAR', '2020-02-03 21:14:58'),
(14, 'johan-1213', 2, 'CÉDULA: 16571826', 'PERSONA', '2020-02-03 21:24:13'),
(15, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-03 21:25:59'),
(16, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-04 15:40:27'),
(17, 'johan-1213', 3, 'CÉDULA: 23432288', 'PERSONA', '2020-02-04 23:54:00'),
(18, 'johan-1213', 3, 'CÉDULA: 25344269', 'PERSONA', '2020-02-05 00:21:16'),
(19, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-08 20:55:11'),
(20, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-08 20:55:50'),
(21, 'johan-1213', 3, 'CÉDULA: 1861618', 'PERSONA', '2020-02-08 21:17:51'),
(22, 'johan-1213', 3, 'CÉDULA: 1861618', 'PERSONA', '2020-02-08 21:18:41'),
(23, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-09 13:47:31'),
(24, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-09 17:32:24'),
(25, 'johan-1213', 3, 'CÉDULA: 12438628', 'PERSONA', '2020-02-09 17:50:29'),
(26, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-10 08:24:11'),
(27, 'johan-1213', 3, 'ID CURSO: 17', 'CURSO', '2020-02-10 19:36:01'),
(28, 'johan-1213', 2, 'ID CURSO: 18', 'CURSO', '2020-02-10 19:43:24'),
(29, 'johan-1213', 1, 'ID CURSO: 18', 'CURSO', '2020-02-10 19:45:02'),
(30, 'johan-1213', 4, 'ID CURSO: 18', 'CURSO', '2020-02-10 19:46:48'),
(31, 'johan-1213', 3, 'ID PERIODO: 4', 'PERIODO', '2020-02-10 19:51:57'),
(32, 'johan-1213', 2, 'ID PERIODO: 5', 'PERIODO', '2020-02-10 19:57:23'),
(33, 'johan-1213', 2, 'ID LOCACIÓN: 5', 'LOCACIÓN', '2020-02-10 20:05:49'),
(34, 'johan-1213', 3, 'ID LOCACIÓN: 5', 'LOCACIÓN', '2020-02-10 20:06:48'),
(35, 'johan-1213', 2, 'CÉDULA: 27380945', 'TITULAR', '2020-02-10 20:16:28'),
(36, 'johan-1213', 2, 'CÉDULA: 27380945', 'PARTICIPANTE', '2020-02-10 20:20:07'),
(37, 'johan-1213', 3, 'CÉDULA: 27380945', 'PARTICIPANTE', '2020-02-10 20:22:05'),
(38, 'johan-1213', 2, 'CÉDULA: 8477827', 'FACILITADOR', '2020-02-10 20:24:53'),
(39, 'johan-1213', 4, 'CÉDULA: 12438628', 'FACILITADOR', '2020-02-10 20:25:45'),
(40, 'johan-1213', 1, 'CÉDULA: 12438628', 'FACILITADOR', '2020-02-10 20:25:49'),
(41, 'johan-1213', 3, 'CÉDULA: 16571826', 'PERSONA', '2020-02-10 20:26:04'),
(42, 'johan-1213', 2, 'CÉDULA: 30254533', 'TITULAR', '2020-02-10 21:24:24'),
(43, 'johan-1213', 2, 'ID: 20', 'PAGO', '2020-02-10 21:57:37'),
(44, 'johan-1213', 2, 'ID: 0', 'PAGO', '2020-02-10 23:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `banco`
--

CREATE TABLE `banco` (
  `id` int(2) NOT NULL COMMENT 'ID del banco de operación',
  `nombre` varchar(55) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del banco',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `banco`
--

INSERT INTO `banco` (`id`, `nombre`, `fecha_registro`) VALUES
(1, 'Banco de Venezuela', '2020-01-26 16:28:04'),
(2, 'Bancaribe', '2020-01-26 16:28:04'),
(3, 'Mercantil', '2020-01-26 16:28:04'),
(4, 'No aplica', '2020-01-26 16:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL COMMENT 'ID de la tabla',
  `serial` varchar(15) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Serial único del curso',
  `id_nombre_curso` int(4) NOT NULL COMMENT 'Referencia al nombre del curso',
  `cedula_facilitador` int(8) DEFAULT NULL COMMENT 'Cedula del facilitador que dicta el curso',
  `id_periodo` int(11) DEFAULT NULL COMMENT 'Período en que se dicta el curso',
  `id_locacion` int(11) DEFAULT NULL COMMENT 'Locación en que se dicta el curso',
  `id_turno` int(1) NOT NULL COMMENT 'Turno en que se dicta el curso',
  `cupos` int(4) DEFAULT NULL COMMENT 'Total de cupos en el curso',
  `precio` decimal(10,2) DEFAULT NULL COMMENT 'Precio a pagar para la inscripción',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Determina el estado de el curso. 1 = Activa, 2 = Desactivada',
  `descripcion` varchar(256) COLLATE utf8_spanish_ci DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente el curso',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id`, `serial`, `id_nombre_curso`, `cedula_facilitador`, `id_periodo`, `id_locacion`, `id_turno`, `cupos`, `precio`, `estado`, `descripcion`, `fecha_registro`, `fecha_modificacion`) VALUES
(2, 'INF-1-0001', 1, 25568648, 1, 1, 1, 10, '150000.00', 1, 'Sin Descripción', '2020-01-27 17:43:16', '2020-01-27 20:17:14'),
(3, 'INF-1-0002', 1, 25568648, 2, 1, 1, 10, '150000.00', 1, 'Sin Descripción', '2020-01-27 17:43:50', '2020-01-27 17:43:50'),
(6, 'REF-4-000001', 4, 25568648, 4, 1, 2, 7, '100000.00', 1, 'Reparación y mantenimiento preventivo', '2020-01-27 19:03:38', '2020-02-05 13:44:25'),
(7, 'REP-2-000001', 2, 10935423, 4, 1, 2, 10, '150000.00', 1, 'Enfoque en mantenimiento preventivo y correctivo', '2020-02-03 21:20:51', '2020-02-09 16:48:06'),
(17, 'COR-3-000001', 3, 25568648, 4, 3, 1, 15, '150000.00', 1, 'Elaboración de pantalones y camisas de vestir para damas, caballeros y niños además de ropa interior, entre otros', '2020-02-10 11:36:13', '2020-02-10 19:36:01'),
(18, 'REP-2-000002', 2, 16571826, 4, 3, 2, 15, '150000.00', 1, 'Enfoque en mantenimiento preventivo', '2020-02-10 19:43:23', '2020-02-10 19:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `facilitador`
--

CREATE TABLE `facilitador` (
  `cedula_persona` int(8) NOT NULL,
  `fecha_contratacion` date DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, Inactivo = Eliminado',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `facilitador`
--

INSERT INTO `facilitador` (`cedula_persona`, `fecha_contratacion`, `estado`, `fecha_registro`) VALUES
(8466825, NULL, 1, '2020-02-10 20:24:24'),
(8477827, NULL, 1, '2020-02-10 20:24:52'),
(10935423, NULL, 1, '2020-01-26 19:59:54'),
(12438628, NULL, 0, '2020-02-09 17:47:22'),
(16571826, NULL, 1, '2020-02-03 21:27:00'),
(25568648, NULL, 1, '2020-01-26 19:35:26'),
(27380945, NULL, 1, '2020-01-26 19:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int(11) NOT NULL COMMENT 'ID de la entidad, autogenerado',
  `cedula_participante` int(8) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `id_curso` int(11) NOT NULL COMMENT 'Referencia a la tabla Cursos',
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero a pagar por los cursos inscritos',
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora capturada automáticamente por el sistema',
  `fecha_modificacion` datetime DEFAULT NULL COMMENT 'Hora en que se modifica la inscripción',
  `estado` int(1) DEFAULT '1' COMMENT 'Estado de la inscripción, usado para "desactivar el registro". 1 = Activo, 0 = Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `cedula_participante`, `id_curso`, `costo`, `fecha_registro`, `fecha_modificacion`, `estado`) VALUES
(2, 8466825, 2, '150000.00', '2020-01-28 20:30:16', NULL, 1),
(3, 25344269, 2, '150000.00', '2020-02-02 10:49:03', NULL, 1),
(4, 1861618, 2, '150000.00', '2020-02-03 21:17:26', NULL, 1),
(5, 16571826, 2, '150000.00', '2020-02-03 21:32:04', NULL, 1),
(6, 11244320, 7, '150000.00', '2020-02-04 21:01:32', NULL, 1),
(7, 18465322, 7, '150000.00', '2020-02-08 09:29:37', NULL, 1),
(8, 18465322, 6, '100000.00', '2020-02-08 11:08:20', NULL, 1),
(9, 25344269, 6, '100000.00', '2020-02-08 20:54:17', NULL, 1),
(10, 1861618, 6, '100000.00', '2020-02-08 20:59:35', NULL, 1),
(11, 11244320, 2, '150000.00', '2020-02-08 21:57:33', NULL, 0),
(12, 12438628, 2, '100000.00', '2020-02-08 21:59:51', NULL, 1),
(13, 18465322, 2, '150000.00', '2020-02-10 21:22:41', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id` int(2) NOT NULL,
  `nombre` varchar(85) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre para mostrar en la interfáz de usuario',
  `direccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ubicación de la locación',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Para desactivar locación, el valor: 0. Para activar locación, el valor: 1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `locacion`
--

INSERT INTO `locacion` (`id`, `nombre`, `direccion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'Casa del Periodista', 'Detrás del Liceo Alberto Carnevali 2', 1, '2019-11-17 16:26:58', '2020-02-09 17:25:51'),
(2, 'Sede IRFA', '8va carrera sur', 1, '2019-11-17 16:26:58', '2020-02-02 12:05:20'),
(3, 'NAF El Tigrito', 'Al lado de la cancha, San José de Guanipa', 1, '2020-01-06 14:37:57', '2020-01-06 14:37:57'),
(4, 'Complejo Cultural Simón Rodriguez', 'Av. Peñalver, calle 10. El Tigre', 1, '2020-02-09 17:15:05', '2020-02-10 09:37:04'),
(5, 'Complejo Cultural San José de Guanipa', 'El Tigrito diagonal a Conelsa', 1, '2020-02-10 20:05:49', '2020-02-10 20:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(2) NOT NULL COMMENT 'ID de la tabla',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del menú',
  `enlace` varchar(250) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Controlador al que se relaciona este menú'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `enlace`) VALUES
(1, 'Inicio', 'dashboard'),
(2, 'Cursos', 'gestion/curso'),
(3, 'Usuarios', 'administrador/usuario'),
(4, 'Permisos', 'administrador/permisos'),
(5, 'Personas', 'gestion/persona'),
(6, 'Historial Pagos', 'reportes/historial_pagos'),
(7, 'Relación de Cursos', 'reportes/relacion'),
(8, 'Reportes Accion', 'reportes/accion'),
(9, 'Resumen Anual', 'reportes/resumen_anual'),
(10, 'Historial de inscripciones', 'reportes/historial_inscripciones'),
(12, 'Facilitador', 'gestion/facilitador'),
(13, 'Titular', 'gestion/titular'),
(14, 'Periodo', 'gestion/periodo'),
(15, 'Locacion', 'gestion/locacion'),
(16, 'Participante', 'gestion/participante'),
(17, 'Inscripcion', 'movimientos/inscripcion'),
(18, 'Pago', 'movimientos/pago'),
(20, 'Nombre Curso', 'gestion/nombre_curso');

-- --------------------------------------------------------

--
-- Table structure for table `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `id` int(1) NOT NULL,
  `nombre` varchar(35) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del nivel académico del participante',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Determina si un nivel está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `nivel_academico`
--

INSERT INTO `nivel_academico` (`id`, `nombre`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'Bachillerato', 1, '2020-01-08 10:17:34', '2020-01-08 14:09:56'),
(2, 'Diversificado', 1, '2020-01-08 10:16:49', '2020-01-08 14:09:53'),
(3, 'Otro', 1, '2020-01-08 10:18:01', '2020-01-08 10:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `nombre_curso`
--

CREATE TABLE `nombre_curso` (
  `id` int(4) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_horas` int(4) DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `nombre_curso`
--

INSERT INTO `nombre_curso` (`id`, `descripcion`, `cantidad_horas`, `estado`, `fecha_registro`) VALUES
(1, 'Informática', 100, 1, '2020-01-26 16:27:54'),
(2, 'Reparación de Computadoras', 120, 1, '2020-01-26 16:27:54'),
(3, 'Corte y Costura', 120, 1, '2020-01-26 16:27:54'),
(4, 'Refrigeración', 150, 1, '2020-01-26 16:27:54'),
(5, 'Aprendíz de Farmacia', 150, 1, '2020-02-11 08:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `pago_de_inscripcion`
--

CREATE TABLE `pago_de_inscripcion` (
  `id` int(11) NOT NULL COMMENT 'ID único asignado por la base de datos',
  `cedula_titular` int(8) NOT NULL COMMENT 'Cédula de la persona titular',
  `id_banco` int(2) DEFAULT '4' COMMENT 'Banco donde se realiza la operación. Se le asigna por defecto el valor 4, correspondiente al registro de banco "No Aplica"',
  `id_tipo_de_operacion` int(1) NOT NULL COMMENT 'Referencia al tipo de operación',
  `numero_referencia_bancaria` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Número único de referencia bancaria',
  `monto_operacion` decimal(10,2) DEFAULT '0.00' COMMENT 'Monto de la operación',
  `fecha_operacion` date NOT NULL COMMENT 'Fecha en que se realizó la operación',
  `fecha_devolucion` date DEFAULT NULL COMMENT 'Valor opcional que captura la fecha en que un pago sea devuelto',
  `id_inscripcion` int(11) DEFAULT NULL COMMENT 'ID de la inscripción a la que se asocia el pago, al registrar el pago, este valor es NULL',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura hora de registro de la operación',
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Hora en que se modifica el registro',
  `estatus_pago` int(1) NOT NULL DEFAULT '1' COMMENT 'Registra si un pago ha sido utilizado o desactivado: 0 =  Desactivado, 1 = Nuevo, 2 = Utilizado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `pago_de_inscripcion`
--

INSERT INTO `pago_de_inscripcion` (`id`, `cedula_titular`, `id_banco`, `id_tipo_de_operacion`, `numero_referencia_bancaria`, `monto_operacion`, `fecha_operacion`, `fecha_devolucion`, `id_inscripcion`, `fecha_registro`, `fecha_modificacion`, `estatus_pago`) VALUES
(1, 12438628, 3, 1, '010843220454', '150000.00', '2020-01-27', NULL, 2, '2020-01-27 23:39:43', '2020-01-28 20:30:17', 2),
(2, 12438628, 3, 1, '010843220444', '150000.00', '2020-01-28', NULL, 8, '2020-01-28 17:01:46', '2020-02-08 20:34:49', 2),
(3, 11244320, 1, 1, '010244350282', '150000.00', '2020-01-07', NULL, 6, '2020-01-30 23:16:22', '2020-02-04 21:01:32', 2),
(6, 23432288, 3, 1, '010843220385', '150000.00', '2020-01-30', NULL, 3, '2020-01-30 23:33:06', '2020-02-08 20:36:05', 2),
(11, 23432288, 4, 3, '', '0.00', '2020-01-31', NULL, 7, '2020-01-31 09:19:18', '2020-02-08 09:29:38', 2),
(12, 1861618, 3, 1, '010843225664', '150000.00', '2020-02-03', NULL, 4, '2020-02-03 21:16:38', '2020-02-03 21:17:27', 2),
(13, 25344269, 4, 2, '', '150000.00', '2020-02-08', NULL, 9, '2020-02-08 20:38:22', '2020-02-08 21:57:54', 2),
(14, 1861618, 3, 1, '010842334412', '150000.00', '2020-02-08', NULL, 10, '2020-02-08 20:59:07', '2020-02-08 20:59:35', 2),
(15, 11244320, 4, 2, '', '150000.00', '2020-02-08', NULL, NULL, '2020-02-08 21:57:10', '2020-02-10 17:30:49', 1),
(16, 12438628, 3, 1, '0108444322543', '150000.00', '2020-02-08', NULL, 12, '2020-02-08 21:59:38', '2020-02-10 15:37:00', 2),
(17, 11244320, 4, 3, NULL, '0.00', '2020-02-10', '2020-02-10', NULL, '2020-02-10 16:07:37', '2020-02-10 17:23:35', 4),
(18, 8965910, 1, 1, '010203442245', '150000.00', '2020-02-13', NULL, 13, '2020-02-10 16:29:12', '2020-02-10 21:22:55', 3),
(19, 23432288, 3, 1, '010843220856', '150000.00', '2020-02-10', '2020-02-11', NULL, '2020-02-10 19:28:33', '2020-02-10 19:30:21', 4),
(20, 25568648, 4, 2, NULL, '150000.00', '2020-02-10', NULL, NULL, '2020-02-10 21:57:37', NULL, 1),
(21, 1861618, 4, 2, '', '150000.00', '2020-02-10', NULL, NULL, '2020-02-10 23:46:55', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `cedula_persona` int(8) NOT NULL COMMENT 'Referencia a la tabla Persona',
  `id_nivel_academico` int(1) NOT NULL COMMENT 'Referente al nivel academico del participante',
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`cedula_persona`, `id_nivel_academico`, `estado`, `fecha_registro`) VALUES
(1861618, 3, 1, '2020-02-03 21:14:57'),
(2582893, 3, 1, '2020-02-09 08:49:04'),
(7294645, 2, 1, '2020-01-30 14:43:34'),
(8456789, 2, 1, '2020-02-10 08:50:13'),
(8466825, 3, 1, '2020-01-27 14:49:24'),
(8965910, 3, 1, '2020-01-30 16:22:30'),
(11244320, 2, 1, '2020-01-30 20:17:57'),
(12438628, 3, 1, '2020-02-08 21:58:51'),
(16571826, 3, 1, '2020-02-03 21:28:02'),
(18465322, 1, 1, '2020-01-30 14:35:39'),
(23432288, 3, 1, '2020-01-30 20:15:59'),
(25344269, 3, 1, '2020-01-30 21:27:38'),
(25568648, 3, 1, '2020-02-10 08:58:40'),
(27380945, 3, 1, '2020-02-10 20:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `periodo`
--

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `periodo`
--

INSERT INTO `periodo` (`id`, `fecha_inicio`, `fecha_culminacion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, '2020-01-13', '2020-04-15', 1, '2019-11-15 17:01:36', '2020-02-08 15:40:02'),
(2, '2019-09-10', '2019-12-14', 1, '2019-11-17 17:43:41', '2020-01-01 16:23:03'),
(3, '2019-12-26', '2019-12-31', 1, '2020-01-03 00:00:00', '2020-02-08 14:22:17'),
(4, '2020-06-17', '2020-09-02', 1, '2020-01-06 14:33:04', '2020-02-10 19:51:10'),
(5, '2020-10-01', '2020-12-16', 1, '2020-02-10 19:57:23', '2020-02-10 19:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `id` int(2) NOT NULL COMMENT 'ID de la tabla',
  `id_menu` int(2) DEFAULT NULL,
  `id_rol` int(2) DEFAULT NULL,
  `read` int(1) DEFAULT NULL COMMENT 'lectura',
  `insert` int(1) DEFAULT NULL COMMENT 'insertar',
  `update` int(1) DEFAULT NULL COMMENT 'actualizar',
  `delete` int(1) DEFAULT NULL COMMENT 'borrar',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`id`, `id_menu`, `id_rol`, `read`, `insert`, `update`, `delete`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 2, 3, 1, 0, 0, 0, '2020-02-06 18:33:42', '2020-02-06 18:51:44'),
(2, 2, 1, 1, 1, 1, 1, '2020-02-06 18:33:42', '0000-00-00 00:00:00'),
(3, 2, 2, 1, 0, 0, 0, '2020-02-06 18:33:42', '2020-02-10 00:15:01'),
(4, 3, 1, 1, 1, 1, 1, '2020-02-06 18:33:42', '0000-00-00 00:00:00'),
(5, 4, 1, 1, 1, 1, 1, '2020-02-06 18:33:42', '0000-00-00 00:00:00'),
(6, 5, 3, 1, 1, 0, 0, '2020-02-06 18:33:42', '2020-02-09 22:02:52'),
(7, 5, 1, 1, 1, 1, 1, '2020-02-06 18:33:42', '0000-00-00 00:00:00'),
(13, 4, 3, 1, 0, 0, 0, '2020-02-06 19:30:32', '0000-00-00 00:00:00'),
(15, 3, 3, 1, 0, 0, 0, '2020-02-06 20:08:32', '0000-00-00 00:00:00'),
(21, 5, 2, 1, 1, 0, 0, '2020-02-09 22:06:04', '0000-00-00 00:00:00'),
(22, 6, 2, 0, 0, 0, 0, '2020-02-09 22:50:20', '0000-00-00 00:00:00'),
(23, 6, 1, 1, 1, 1, 1, '2020-02-09 22:51:45', '0000-00-00 00:00:00'),
(24, 7, 2, 0, 0, 0, 0, '2020-02-09 22:59:40', '0000-00-00 00:00:00'),
(25, 8, 2, 0, 0, 0, 0, '2020-02-09 23:13:38', '0000-00-00 00:00:00'),
(26, 8, 1, 1, 1, 1, 1, '2020-02-09 23:13:59', '0000-00-00 00:00:00'),
(27, 9, 2, 0, 0, 0, 0, '2020-02-09 23:15:51', '0000-00-00 00:00:00'),
(28, 9, 1, 1, 1, 1, 1, '2020-02-09 23:16:04', '0000-00-00 00:00:00'),
(29, 10, 1, 1, 1, 1, 1, '2020-02-09 23:18:11', '0000-00-00 00:00:00'),
(30, 7, 1, 1, 1, 1, 1, '2020-02-09 23:20:01', '2020-02-09 23:26:59'),
(31, 12, 2, 1, 0, 0, 0, '2020-02-09 23:45:49', '0000-00-00 00:00:00'),
(32, 12, 1, 1, 1, 1, 1, '2020-02-09 23:48:34', '0000-00-00 00:00:00'),
(33, 13, 2, 1, 1, 0, 0, '2020-02-10 00:02:23', '2020-02-10 00:12:48'),
(34, 13, 1, 1, 1, 1, 1, '2020-02-10 00:03:34', '0000-00-00 00:00:00'),
(35, 14, 2, 1, 0, 0, 0, '2020-02-10 00:28:08', '0000-00-00 00:00:00'),
(36, 14, 1, 1, 1, 1, 1, '2020-02-10 00:29:09', '0000-00-00 00:00:00'),
(37, 15, 2, 1, 0, 0, 0, '2020-02-10 00:31:58', '0000-00-00 00:00:00'),
(38, 15, 1, 1, 1, 1, 1, '2020-02-10 00:36:01', '0000-00-00 00:00:00'),
(39, 16, 2, 1, 1, 0, 0, '2020-02-10 01:04:18', '2020-02-10 01:25:55'),
(40, 16, 1, 1, 1, 1, 1, '2020-02-10 01:06:45', '0000-00-00 00:00:00'),
(41, 17, 2, 1, 1, 0, 0, '2020-02-10 01:15:09', '0000-00-00 00:00:00'),
(42, 18, 2, 1, 1, 0, 0, '2020-02-10 01:21:10', '2020-02-10 01:21:28'),
(43, 18, 1, 1, 1, 1, 1, '2020-02-10 01:22:06', '0000-00-00 00:00:00'),
(44, 17, 1, 1, 1, 1, 1, '2020-02-10 12:15:47', '0000-00-00 00:00:00'),
(45, 20, 1, 1, 1, 0, 1, '2020-02-11 13:36:41', '2020-02-11 13:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `cedula` int(8) NOT NULL COMMENT 'Cédula de la persona',
  `primer_nombre` varchar(95) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Nombres de la persona',
  `primer_apellido` varchar(95) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Apellidos de la persona',
  `segundo_nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `segundo_apellido` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Genero de la persona',
  `fecha_nacimiento` date NOT NULL COMMENT 'Fecha de nacimiento (se utiliza para calcular la edad)',
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Teléfono de contacto de la persona',
  `correo_electronico` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Correo electrónico',
  `direccion` varchar(155) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Dirección de residencia',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Determina si una persona está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura automáticamente la hora de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Hora en que se modifica la inscripción'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`cedula`, `primer_nombre`, `primer_apellido`, `segundo_nombre`, `segundo_apellido`, `genero`, `fecha_nacimiento`, `telefono`, `correo_electronico`, `direccion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1861618, 'José', 'Amaya', NULL, NULL, '1', '1954-09-02', '02832411769', 'alguien@gmail.com', 'Calle 26 norte, Quinta Elise, El Tigre', 1, '2020-02-03 21:13:40', '2020-02-08 21:18:41'),
(2582893, 'Esteban', 'Chaurant ', 'De Jesus', 'Zamora', '1', '1995-12-26', '04141929294', 'alguien@servidor.com', 'Aveneda 2 Casa N° 118 Sector Cincuentenario ', 1, '2020-01-26 16:27:45', '2020-01-31 10:35:21'),
(4965328, 'Johan', 'Bach', NULL, NULL, '1', '1960-10-13', '04165843323', 'alguien@servidor.com', 'El Tigrito, Campo Norte, casa #230', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(7294645, 'Marco', 'Aurelio', NULL, NULL, '1', '1965-09-25', '04149675848', 'alguien@servidor.com', 'El Tigrito, Campo Norte', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(8456789, 'Carmen', 'Martínez', NULL, NULL, '2', '1965-11-25', '04162839768', 'alguien@servidor.com', '17 de diciembre, calle 25', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(8466825, 'Manuel', 'Contreras', 'Alejandro', NULL, '1', '1964-10-06', '04243254403', 'alguien@servidor.com', 'El Tigre, carretera negra', 1, '2020-01-26 16:27:45', '2020-01-31 10:35:38'),
(8477818, 'Felix', 'Blackman', NULL, NULL, '1', '1965-05-27', '04248113920', 'alguien@servidor.com', 'El Tigre, detrás de La Cascada', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(8477827, 'Gregorio', 'Velásquez', NULL, NULL, '1', '1964-06-27', '02834002095', 'alguien@servidor.com', 'El Tigre, Chaguaramos', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(8965910, 'Alicia', 'Zamora', NULL, NULL, '2', '1967-03-03', '04242929292', 'alguien@servidor.com', 'EL Tigre, Chaguaramos', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(9458635, 'Edgardo', 'Saá', NULL, NULL, '1', '1969-09-04', '04249485560', 'alguien@servidor.com', 'Av. La Paz, urb. Chimire.', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(10935423, 'Luis', 'Amaya', NULL, NULL, '1', '1969-09-09', '04262286355', 'amayale69@gmail.com', 'Calle 26 Norte, Quinta EILIS, El Tigre', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(10939925, 'Freddy', 'Miranda', NULL, NULL, '1', '0000-00-00', '', '', '', 1, '2020-01-26 16:27:45', '2020-02-02 17:53:24'),
(11244320, 'Carmen', 'Carvajal', NULL, NULL, '2', '1985-01-30', '02832351229', 'carmencarvajal12@gmail.com', 'Pueblo nuevo, avenida 10, casa 158', 1, '2020-01-30 17:43:11', '2020-01-30 17:43:11'),
(12275704, 'José', 'Astudillo', NULL, NULL, '1', '1975-11-03', '04248965754', 'alguien@servidor.com', 'El Tigrito, Chimire', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(12438628, 'Yulimar', 'Fajardo', 'Celidett', 'Rojas', '2', '1975-10-20', '04247684312', '04247684312', 'El Tigre, detrás de Campo Oficina', 1, '2020-01-26 16:27:45', '2020-02-09 17:50:29'),
(12504138, 'Alfredo', 'Bizcochea', NULL, NULL, '1', '1976-06-28', '04248070018', 'alguien@servidor.com', 'Calle Independencia, #16, 17 de Diciembre', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(16571826, 'Rafael', 'Valera', NULL, NULL, '1', '1983-07-19', '04148295205', 'valera.rafaels@gmail.com', 'El Tigre', 1, '2020-02-03 21:24:13', '2020-02-08 20:55:50'),
(18465322, 'Sebastian', 'Pino', NULL, NULL, '1', '1999-01-28', '04123251529', 'sebastian@servidor.com', 'Sector Casco Viejo, calle aragua, casa 122', 1, '2020-01-30 14:10:54', '2020-01-30 14:10:54'),
(22574648, 'Juan', 'Chaurant', 'Luis', 'Zamora', '1', '1993-12-13', '04248900840', 'alguien@servidor.com', 'El Tigre, edo. Anzoátegui', 1, '2020-01-26 16:27:45', '2020-01-31 10:36:44'),
(23254648, 'Felipe', 'Rondón', NULL, NULL, '1', '1999-09-23', '04245643943', 'alguien@servidor.com', 'El Tigre, estado Anzoátegui', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(23432288, 'Fernando', 'Rosas', NULL, NULL, '1', '2005-01-30', '04267931205', 'fernando0130@gmail.com', 'Buena vista 4, calle 10, casa 14', 1, '2020-01-30 19:50:16', '2020-02-04 23:54:00'),
(23454648, 'Daniel', 'Fernández', 'Fernando', NULL, '1', '1994-12-14', '04243211514', 'alguien@servidor.com', 'Calle 10, sector Morichal. Casa #14', 1, '2020-01-26 16:27:45', '2020-01-31 10:36:58'),
(23857463, 'Katty', 'Otero', NULL, NULL, '2', '1995-12-14', '04142354465', 'alguien@servidor.com', 'Urb. Los Naranjos, calle 5', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(24322878, 'Jesús', 'Alcantara', NULL, NULL, '1', '1999-12-24', '04243254499', 'alguien@servidor.com', 'Av. Libertador, cruce con calle 12 ', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(24688325, 'Edgar', 'Pacheco', NULL, NULL, '1', '1999-11-24', '04243251215', 'alguien@servidor.com', 'Urb. Los Naranjos, calle 5', 1, '2019-12-26 16:27:45', '2020-02-09 08:10:15'),
(25344269, 'Maria', 'Díaz', NULL, NULL, '2', '2008-04-06', '04243251544', 'maria@server.com', 'Sector Pueblo Nuevo, calle 24, casa 13', 1, '2020-01-30 17:33:11', '2020-02-05 00:21:16'),
(25456257, 'Jesus', 'Farias', 'Alejandro', NULL, '1', '1993-12-26', '04141929295', 'jesusfarias@gmail.com', 'La Charneca, calle 24, casa 25', 1, '2020-01-26 17:14:00', '2020-01-31 10:37:15'),
(25468978, 'Asena', 'Vural', NULL, NULL, '2', '1999-11-20', '04245694548', 'alguien@servidor.com', 'Av. Franca, El Tigre', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(25568648, 'Mario', 'Bustamante', NULL, NULL, '1', '1997-12-04', '04245645456', 'alguien@servidor.com', 'El Tigre, estado Anzoátegui', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(25657342, 'Fernando', 'La Rosa', NULL, NULL, '1', '1994-12-09', '04167922205', 'alguien@servidor.com', 'La California, el Tigrito', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(25678432, 'Joselyn', 'Marín', NULL, NULL, '2', '1996-10-13', '04267242295', 'alguien@servidor.com', 'Av. Carabobo, cruce con calle 10', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(27380945, 'Samuel Andrés', 'Requena Abache', NULL, NULL, '1', '1999-11-21', '04248812413', 'alguien@servidor.com', 'Urb. Virgen del Valle c/ Santa Rosa P130', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(27546895, 'Yorman', 'Pérez', NULL, NULL, '1', '2019-11-06', '', 'alguien@servidor.com', '', 0, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(27865343, 'José', 'Lopez', NULL, NULL, '1', '2000-10-20', '04167843304', 'alguien@servidor.com', 'El Tigre, antes del estadio', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(29176244, 'Felipe', 'Gómez', NULL, NULL, '1', '2000-12-25', '04243445699', 'alguien@servidor.com', 'El Tigre, pueblo nuevo', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45'),
(30254533, 'Ariana', 'Díaz', NULL, NULL, '2', '1999-01-13', '04243253324', 'alguien@servidor.com', 'Casco Viejo, cassa #125', 1, '2020-01-26 16:27:45', '2020-01-26 16:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` int(1) NOT NULL,
  `funcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del rol (Administrador, Gestor y Asesor)',
  `descripcion` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripción de la funcionalidad de cada rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `funcion`, `descripcion`) VALUES
(1, 'Administrador', 'Con todos los permisos en el sistema'),
(2, 'Asistente', 'Puede realizar operaciones relacionadas a la gestión de la organización pero no puede devolver pagos ni cambiar permisos de usuario '),
(3, 'Gestor', 'puede realizar ciertas operaciones en el sistema');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_de_accion`
--

CREATE TABLE `tipo_de_accion` (
  `id` int(1) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_notificacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Será utilizado para generar determinado tipo de alerta en la interfáz de usuario',
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipo_de_accion`
--

INSERT INTO `tipo_de_accion` (`id`, `nombre`, `tipo_notificacion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'DESACTIVAR', 'alert-danger', 1, '2018-11-11 06:29:06', '2020-01-30 19:56:58'),
(2, 'INSERTAR', 'alert-success', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(3, 'MODIFICAR', 'alert-info', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(4, 'ACTIVAR', 'alert-danger', 1, '2020-02-10 19:46:19', '2020-02-10 19:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `id` int(1) NOT NULL COMMENT 'ID de la operación',
  `tipo` varchar(35) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Describe el tipo de operación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipo_de_operacion`
--

INSERT INTO `tipo_de_operacion` (`id`, `tipo`) VALUES
(1, 'Transferencia'),
(2, 'Efectivo'),
(3, 'Exonerado');

-- --------------------------------------------------------

--
-- Table structure for table `titular`
--

CREATE TABLE `titular` (
  `cedula_persona` int(8) NOT NULL COMMENT 'Referencia a la tabla Persona',
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `titular`
--

INSERT INTO `titular` (`cedula_persona`, `estado`, `fecha_registro`) VALUES
(1861618, 1, '2020-02-03 21:14:57'),
(7294645, 1, '2020-01-30 15:02:23'),
(8965910, 1, '2020-01-30 16:22:30'),
(10935423, 1, '2020-02-03 21:22:36'),
(11244320, 1, '2020-01-30 20:17:58'),
(12438628, 1, '2020-01-26 17:23:09'),
(23432288, 1, '2020-01-30 20:16:00'),
(25344269, 1, '2020-01-30 21:27:39'),
(25568648, 1, '2020-02-02 18:51:42'),
(27380945, 1, '2020-02-10 20:16:28'),
(30254533, 1, '2020-02-10 21:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `turno`
--

CREATE TABLE `turno` (
  `id` int(1) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `nombre` varchar(6) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Almacena los turnos en los que la institución oferta sus cursos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `turno`
--

INSERT INTO `turno` (`id`, `nombre`) VALUES
(1, 'Mañana'),
(2, 'Tarde');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cedula_persona` int(8) NOT NULL,
  `id_rol` int(2) NOT NULL COMMENT 'Rol del ususario',
  `estado` int(1) DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`username`, `password`, `cedula_persona`, `id_rol`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
('adminis', '98ce34038035debf9af5d5482829aeddfb543f7e', 22574648, 1, 1, '2020-01-26 16:27:49', '2020-01-30 12:10:36'),
('amayale', '5d1705794b848e420a6c9755df70e3d82a189108', 10935423, 1, 1, '2020-01-26 16:27:49', '2020-01-26 16:27:49'),
('asistente', '98ce34038035debf9af5d5482829aeddfb543f7e', 9458635, 2, 1, '2020-01-26 16:27:49', '2020-01-26 16:27:49'),
('esteban-a', '98ce34038035debf9af5d5482829aeddfb543f7e', 2582893, 2, 1, '2020-02-10 23:16:27', '2020-02-10 23:16:27'),
('gestor', '98ce34038035debf9af5d5482829aeddfb543f7e', 8965910, 3, 1, '2020-01-26 16:27:49', '2020-01-26 16:27:49'),
('johan-1213', '98ce34038035debf9af5d5482829aeddfb543f7e', 4965328, 1, 1, '2020-01-26 16:27:49', '2020-01-26 16:27:49');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_cursos_activos`
-- (See below for the actual view)
--
CREATE TABLE `vista_cursos_activos` (
`ano_inicio_periodo` int(4)
,`mes_inicio_periodo` int(2)
,`nombre_curso` varchar(45)
,`cedula_facilitador` int(8)
,`facilitador` varchar(191)
,`nombre_locacion` varchar(85)
,`cupos` int(4)
,`cupos_curso_ocupados` bigint(21)
,`estado` int(1)
);

-- --------------------------------------------------------

--
-- Structure for view `vista_cursos_activos`
--
DROP TABLE IF EXISTS `vista_cursos_activos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cursos_activos`  AS  select year(`periodo`.`fecha_inicio`) AS `ano_inicio_periodo`,month(`periodo`.`fecha_inicio`) AS `mes_inicio_periodo`,`nombre_curso`.`descripcion` AS `nombre_curso`,`persona`.`cedula` AS `cedula_facilitador`,concat(`persona`.`primer_nombre`,' ',`persona`.`primer_apellido`) AS `facilitador`,`locacion`.`nombre` AS `nombre_locacion`,`curso`.`cupos` AS `cupos`,count(`inscripcion`.`cedula_participante`) AS `cupos_curso_ocupados`,`curso`.`estado` AS `estado` from ((((((`periodo` join `curso` on((`curso`.`id_periodo` = `periodo`.`id`))) join `nombre_curso` on((`nombre_curso`.`id` = `curso`.`id_nombre_curso`))) join `inscripcion` on((`inscripcion`.`id_curso` = `curso`.`id`))) join `facilitador` on((`curso`.`cedula_facilitador` = `facilitador`.`cedula_persona`))) join `persona` on((`facilitador`.`cedula_persona` = `persona`.`cedula`))) join `locacion` on((`locacion`.`id` = `curso`.`id_locacion`))) where ((`curso`.`estado` = 1) and (`inscripcion`.`estado` = 1)) group by `inscripcion`.`cedula_participante` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accion_fk_tipo_accion` (`id_tipo_accion`),
  ADD KEY `accion_fk_usuario` (`username`);

--
-- Indexes for table `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banco_unique_nombre` (`nombre`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_fk_nombre_curso` (`id_nombre_curso`),
  ADD KEY `curso_fk_facilitador` (`cedula_facilitador`),
  ADD KEY `curso_fk_periodo` (`id_periodo`),
  ADD KEY `curso_fk_locacion` (`id_locacion`),
  ADD KEY `curso_fk_turno` (`id_turno`);

--
-- Indexes for table `facilitador`
--
ALTER TABLE `facilitador`
  ADD UNIQUE KEY `facilitador_unique_cedula` (`cedula_persona`);

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inscripcion_fk_participante` (`cedula_participante`),
  ADD KEY `inscripcion_fk_curso` (`id_curso`);

--
-- Indexes for table `locacion`
--
ALTER TABLE `locacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locacion_unique_nombre` (`nombre`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_unique_enlace` (`enlace`);

--
-- Indexes for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nombre_curso`
--
ALTER TABLE `nombre_curso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_curso_unique` (`descripcion`);

--
-- Indexes for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pago_de_inscripcion_fk_titular` (`cedula_titular`),
  ADD KEY `pago_de_inscripcion_fk_inscripcion` (`id_inscripcion`),
  ADD KEY `pago_de_inscripcion_fk_banco` (`id_banco`),
  ADD KEY `pago_de_inscripcion_fk_tipo_de_operacion` (`id_tipo_de_operacion`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD UNIQUE KEY `participante_unique_cedula` (`cedula_persona`),
  ADD KEY `participante_fk_nivel_academico` (`id_nivel_academico`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permiso_unique_rol_menu` (`id_menu`,`id_rol`),
  ADD KEY `permiso_fk_rol` (`id_rol`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`cedula`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_de_accion`
--
ALTER TABLE `tipo_de_accion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titular`
--
ALTER TABLE `titular`
  ADD UNIQUE KEY `titular_unique_cedula` (`cedula_persona`);

--
-- Indexes for table `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `usuario_unique_username` (`username`),
  ADD KEY `usuario_fk_persona` (`cedula_persona`),
  ADD KEY `usuario_fk_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `banco`
--
ALTER TABLE `banco`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID del banco de operación', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la entidad, autogenerado', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `locacion`
--
ALTER TABLE `locacion`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nombre_curso`
--
ALTER TABLE `nombre_curso`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único asignado por la base de datos', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_de_accion`
--
ALTER TABLE `tipo_de_accion`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT COMMENT 'ID de la operación', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `turno`
--
ALTER TABLE `turno`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT COMMENT 'Referencia a la tabla Participante', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `accion_fk_tipo_accion` FOREIGN KEY (`id_tipo_accion`) REFERENCES `tipo_de_accion` (`id`),
  ADD CONSTRAINT `accion_fk_usuario` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_fk_facilitador` FOREIGN KEY (`cedula_facilitador`) REFERENCES `facilitador` (`cedula_persona`),
  ADD CONSTRAINT `curso_fk_locacion` FOREIGN KEY (`id_locacion`) REFERENCES `locacion` (`id`),
  ADD CONSTRAINT `curso_fk_nombre_curso` FOREIGN KEY (`id_nombre_curso`) REFERENCES `nombre_curso` (`id`),
  ADD CONSTRAINT `curso_fk_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id`),
  ADD CONSTRAINT `curso_fk_turno` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id`);

--
-- Constraints for table `facilitador`
--
ALTER TABLE `facilitador`
  ADD CONSTRAINT `facilitador_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`);

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `inscripcion_fk_participante` FOREIGN KEY (`cedula_participante`) REFERENCES `participante` (`cedula_persona`);

--
-- Constraints for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD CONSTRAINT `pago_de_inscripcion_fk_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_tipo_de_operacion` FOREIGN KEY (`id_tipo_de_operacion`) REFERENCES `tipo_de_operacion` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_titular` FOREIGN KEY (`cedula_titular`) REFERENCES `titular` (`cedula_persona`);

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_fk_nivel_academico` FOREIGN KEY (`id_nivel_academico`) REFERENCES `nivel_academico` (`id`),
  ADD CONSTRAINT `participante_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`);

--
-- Constraints for table `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `permiso_fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

--
-- Constraints for table `titular`
--
ALTER TABLE `titular`
  ADD CONSTRAINT `titular_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`),
  ADD CONSTRAINT `usuario_fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
