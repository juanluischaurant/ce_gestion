-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2019 at 03:26 AM
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
-- Database: `ce_gestion_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `banco`
--

CREATE TABLE `banco` (
  `id_banco` int(11) NOT NULL COMMENT 'ID del banco de operación',
  `nombre_banco` varchar(255) COLLATE latin1_general_ci NOT NULL COMMENT 'Nombre del banco',
  `detalles_banco` varchar(255) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Descripción del banco'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `banco`
--

INSERT INTO `banco` (`id_banco`, `nombre_banco`, `detalles_banco`) VALUES
(1, 'Banco de Venezuela', 'El banco de Venezuela'),
(2, 'Bancaribe', 'El banco de Venezuela y el Caribe');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `serial_participante` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `cedula_cliente` int(11) NOT NULL,
  `nombres_cliente` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `apellidos_cliente` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_nacimiento_cliente` date DEFAULT NULL,
  `genero_cliente` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono_cliente` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `direccion_cliente` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_cliente` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `serial_participante`, `cedula_cliente`, `nombres_cliente`, `apellidos_cliente`, `fecha_nacimiento_cliente`, `genero_cliente`, `telefono_cliente`, `direccion_cliente`, `estado_cliente`) VALUES
(1, '000001', 22574648, 'Juan Luis', 'Chaurant', '1993-12-13', 'masculino', '04248900840', 'El Tigre, estado Anzoátegui', 1),
(2, '000002', 22456989, 'José Ramón', 'Guerra', '1980-10-12', 'masculino', '04248900840', 'El Tigre, Anzoátegui', 1),
(3, '000003', 8966910, 'Ana Maria', 'Lauro', '1990-06-16', 'femenino', '04248992342', 'El tigre, estado Anzoátegui', 1),
(4, '000002', 25874648, 'Sebastian', 'Alí', '2000-10-18', 'masculino', '04248880840', 'Los Robles, el Paseo', 1),
(5, NULL, 25678960, 'Jonathan', 'Díaz', '1994-10-11', 'masculino', '04148239584', 'Calle Cantaura, casa 45', 1),
(6, NULL, 8965910, 'Alicia', 'Zamora', '1964-03-03', 'femenino', '04141929292', '02835003093', 1);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `estado_curso` int(1) NOT NULL DEFAULT '1',
  `descripcion_curso` varchar(256) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre_curso`, `estado_curso`, `descripcion_curso`) VALUES
(1, 'Informática', 1, 'Para los amantes de la informática'),
(2, 'Cocina', 1, 'Para los amantes de la cocina'),
(3, 'Corte y Costura', 1, 'Para los amantes de la confección y la costura muy moderna');

-- --------------------------------------------------------

--
-- Table structure for table `estatus`
--

CREATE TABLE `estatus` (
  `id_estatus` int(11) NOT NULL,
  `nombre_estatus` varchar(25) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `estatus`
--

INSERT INTO `estatus` (`id_estatus`, `nombre_estatus`) VALUES
(1, 'Pago'),
(2, 'No pago');

-- --------------------------------------------------------

--
-- Table structure for table `facilitador`
--

CREATE TABLE `facilitador` (
  `id_facilitador` int(11) NOT NULL,
  `cedula_facilitador` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `nombre_facilitador` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `apellido_facilitador` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `fecha_nacimiento_facilitador` date DEFAULT NULL COMMENT 'Registra fecha de nacimiento del facilitador',
  `genero_facilitador` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono_1_facilitador` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono_2_facilitador` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `direccion_facilitador` varchar(355) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_facilitador` varchar(9) COLLATE latin1_general_ci NOT NULL DEFAULT 'Activo' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, 0 = Eliminado',
  `fecha_registro_facilitador` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `facilitador`
--

INSERT INTO `facilitador` (`id_facilitador`, `cedula_facilitador`, `nombre_facilitador`, `apellido_facilitador`, `fecha_nacimiento_facilitador`, `genero_facilitador`, `telefono_1_facilitador`, `telefono_2_facilitador`, `direccion_facilitador`, `estado_facilitador`, `fecha_registro_facilitador`) VALUES
(1, '22574648', 'Ricardo Luis', 'Chaurant', NULL, 'masculino', '04248900840', '02834002094', 'Calle Anzoátegui, casa 64', '0', '2019-10-06 18:17:49'),
(2, '8965910', 'Maria José', 'Toledo', '1990-10-06', 'femenino', '04249094857', '02835098437', 'San José de Guanipa', '1', '2019-10-06 18:17:49'),
(3, '256978549', 'Cármen', 'Centeno', NULL, 'femenino', '04267931215', NULL, 'Lomas del Palomar IV', '1', '2019-10-06 18:35:54'),
(4, '8965614', 'Alexander', 'Carneiro', '1963-07-12', 'masculino', '04245685093', NULL, 'El Tigre, Calle Aragua', '1', '2019-10-06 18:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL COMMENT 'ID de la entidad, autogenerado',
  `fk_id_participante_1` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `fk_id_estatus_1` int(11) NOT NULL DEFAULT '1' COMMENT 'Referencia la tabla Estatus, el estatus de una isncripción puede ser: 1. Pago, 2. Por pagar',
  `fk_id_usuario_1` int(11) DEFAULT NULL COMMENT 'Referencia a la tabla usuarios, permite registrar que usuario realiza la operación',
  `fecha_inscripcion` date DEFAULT NULL COMMENT 'Fecha de inscripción proveida por el usuario',
  `hora_inscripcion` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora capturada automáticamente por el sistema',
  `hora_cancelada` datetime DEFAULT NULL COMMENT 'Hora en que se cancela el pago (puede no ser cancelado)',
  `monto_pagado` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero pagado por el cliente',
  `precio_total` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero total por los cursos adquiridos',
  `descuento` decimal(10,2) DEFAULT NULL COMMENT 'Cantidad de descuento ofertada al cliente al momento de realizar la inscripción',
  `precio_final` decimal(10,2) DEFAULT NULL COMMENT 'Monto total a cobrar al cliente',
  `activa` tinyint(1) DEFAULT '1' COMMENT 'Estado de la inscripción, usado para "eliminar el registro"'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `fk_id_participante_1`, `fk_id_estatus_1`, `fk_id_usuario_1`, `fecha_inscripcion`, `hora_inscripcion`, `hora_cancelada`, `monto_pagado`, `precio_total`, `descuento`, `precio_final`, `activa`) VALUES
(2, 3, 1, NULL, NULL, '2019-09-28 17:32:11', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(3, 3, 1, NULL, NULL, '2019-09-29 08:31:19', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(4, 3, 1, NULL, NULL, '2019-09-29 08:32:22', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(5, 3, 1, NULL, NULL, '2019-09-29 08:32:37', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(6, 3, 1, NULL, NULL, '2019-09-29 08:34:07', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(7, 3, 1, NULL, NULL, '2019-09-29 08:34:32', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(8, 3, 1, NULL, NULL, '2019-09-29 08:37:59', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(9, 3, 1, NULL, NULL, '2019-09-29 08:38:35', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(10, 4, 1, NULL, NULL, '2019-09-29 12:54:43', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(11, 1, 1, NULL, NULL, '2019-09-29 14:01:36', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(12, 5, 1, NULL, NULL, '2019-10-04 22:16:41', NULL, '55000.00', '100000.00', '0.00', '100000.00', 1),
(13, 5, 1, NULL, NULL, '2019-10-04 22:17:19', NULL, '55000.00', '100000.00', '0.00', '100000.00', 1),
(14, 4, 1, NULL, NULL, '2019-10-05 15:47:03', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(15, 4, 1, NULL, NULL, '2019-10-05 15:48:42', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(16, 4, 1, NULL, NULL, '2019-10-05 15:50:08', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(17, 4, 1, NULL, NULL, '2019-10-05 15:52:01', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(18, 4, 1, NULL, NULL, '2019-10-05 16:00:49', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(19, 2, 1, NULL, NULL, '2019-10-06 00:22:23', NULL, '60000.00', '50000.00', '0.00', '50000.00', 1),
(20, 3, 1, NULL, NULL, '2019-10-06 08:41:15', NULL, '50000.00', '50000.00', '0.00', '50000.00', 1),
(21, 5, 1, NULL, NULL, '2019-10-06 08:50:30', NULL, '55000.00', '50000.00', '0.00', '50000.00', 1),
(22, 5, 1, NULL, NULL, '2019-10-06 08:51:16', NULL, '55000.00', '50000.00', '0.00', '50000.00', 1),
(23, 2, 1, NULL, NULL, '2019-10-06 08:52:52', NULL, '60000.00', '0.00', '0.00', '0.00', 1),
(24, 6, 1, NULL, NULL, '2019-10-06 11:55:15', NULL, '65000.00', '100000.00', '0.00', '100000.00', 1),
(25, 1, 1, NULL, NULL, '2019-10-18 23:17:02', NULL, '60000.00', '0.00', '0.00', '0.00', 1),
(26, 1, 1, NULL, NULL, '2019-10-18 23:17:31', NULL, '60000.00', '0.00', '0.00', '0.00', 1),
(27, 1, 1, NULL, NULL, '2019-10-18 23:19:37', NULL, '60000.00', '0.00', '0.00', '0.00', 1),
(28, 1, 1, NULL, NULL, '2019-10-18 23:22:27', NULL, '60000.00', '0.00', '0.00', '0.00', 1),
(29, 1, 1, NULL, NULL, '2019-10-18 23:23:23', NULL, '60000.00', '0.00', '0.00', '0.00', 1),
(30, 6, 1, NULL, '2019-10-19', '2019-10-19 12:39:35', NULL, '50000.00', '45000.00', '0.00', '45000.00', 1),
(31, 2, 1, NULL, '2019-10-19', '2019-10-19 12:44:25', NULL, '60000.00', '45000.00', '0.00', '45000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion_curso`
--

CREATE TABLE `inscripcion_curso` (
  `id_inscripcion_curso` int(11) NOT NULL,
  `fk_id_inscripcion_1` int(11) DEFAULT NULL,
  `fk_id_curso_1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `inscripcion_curso`
--

INSERT INTO `inscripcion_curso` (`id_inscripcion_curso`, `fk_id_inscripcion_1`, `fk_id_curso_1`) VALUES
(18, 2, 3),
(19, 3, 1),
(20, 4, 1),
(21, 5, 1),
(22, 6, 1),
(23, 7, 1),
(24, 8, 1),
(25, 9, 1),
(26, 10, 3),
(27, 11, 3),
(28, 13, 3),
(29, 13, 1),
(30, 14, 3),
(31, 15, 3),
(32, 16, 3),
(33, 17, 3),
(34, 18, 3),
(35, 19, 3),
(36, 20, 3),
(37, 21, 3),
(38, 22, 3),
(39, 23, 8),
(40, 24, 1),
(41, 24, 3),
(42, 25, 8),
(43, 26, 8),
(44, 27, 8),
(45, 28, 8),
(46, 29, 8),
(47, 30, 8),
(48, 31, 8);

-- --------------------------------------------------------

--
-- Table structure for table `instancia`
--

CREATE TABLE `instancia` (
  `id_instancia` int(11) NOT NULL,
  `fk_id_curso_1` int(11) NOT NULL,
  `fk_id_facilitador_1` int(11) DEFAULT NULL,
  `fk_id_periodo_1` int(11) DEFAULT NULL,
  `fk_id_locacion_1` int(11) DEFAULT NULL,
  `turno_instancia` varchar(6) COLLATE latin1_general_ci DEFAULT NULL,
  `cupos_instancia` int(4) DEFAULT NULL,
  `precio_instancia` decimal(10,2) DEFAULT NULL COMMENT 'Precio a pagar para la inscripción',
  `estado_instancia` int(1) NOT NULL DEFAULT '1',
  `descripcion_instancia` varchar(256) COLLATE latin1_general_ci DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente la instancia',
  `cupos_instancia_ocupados` int(11) NOT NULL DEFAULT '0' COMMENT 'Cuenta el total de participantes inscritos en un curso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `instancia`
--

INSERT INTO `instancia` (`id_instancia`, `fk_id_curso_1`, `fk_id_facilitador_1`, `fk_id_periodo_1`, `fk_id_locacion_1`, `turno_instancia`, `cupos_instancia`, `precio_instancia`, `estado_instancia`, `descripcion_instancia`, `cupos_instancia_ocupados`) VALUES
(1, 1, 1, 1, 1, 'tarde', 17, '50000.00', 1, 'abierto ahoraa', 0),
(3, 2, 1, 1, 1, 'mañana', 8, '50000.00', 1, 'abierto ahora', 0),
(8, 3, 2, 1, 1, NULL, 13, '45000.00', 1, 'Sin Descripción', 13);

-- --------------------------------------------------------

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id_locacion` int(11) NOT NULL,
  `nombre_locacion` varchar(85) COLLATE latin1_general_ci NOT NULL,
  `direccion_locacion` varchar(355) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `locacion`
--

INSERT INTO `locacion` (`id_locacion`, `nombre_locacion`, `direccion_locacion`) VALUES
(1, 'CNP', '8va carrera sur detrás del colegio Carnevali.'),
(2, 'Oficina IRFA El Tigre', 'Octava carrera sur');

-- --------------------------------------------------------

--
-- Table structure for table `pago_de_inscripcion`
--

CREATE TABLE `pago_de_inscripcion` (
  `id_pago` int(11) NOT NULL,
  `fk_id_inscripcion` int(11) DEFAULT NULL,
  `fk_id_banco` int(11) DEFAULT NULL,
  `fk_id_tipo_operacion` int(11) NOT NULL,
  `fk_id_pagador` int(11) NOT NULL,
  `serial_pago` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `numero_operacion` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `monto_operacion` decimal(10,2) DEFAULT NULL,
  `fecha_operacion` date NOT NULL,
  `fecha_registro_operacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura hora de registro de la operación',
  `estado_pago` int(11) NOT NULL DEFAULT '1' COMMENT 'Registra si un pago ha sido utilizado o eliminado. 1 = Nuevo, 0 = Elliminado, 2 = Utilizado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pago_de_inscripcion`
--

INSERT INTO `pago_de_inscripcion` (`id_pago`, `fk_id_inscripcion`, `fk_id_banco`, `fk_id_tipo_operacion`, `fk_id_pagador`, `serial_pago`, `numero_operacion`, `monto_operacion`, `fecha_operacion`, `fecha_registro_operacion`, `estado_pago`) VALUES
(5, NULL, 1, 2, 1, 'efe-000001', '45674456', '50000.00', '2019-09-23', '2019-10-05 17:25:36', 1),
(6, 30, 1, 2, 1, 'efe-000002', '54687895', '50000.00', '2019-09-23', '2019-10-05 17:25:36', 2),
(8, NULL, 1, 1, 2, 'tra-000002', '45678879', '40000.00', '2019-09-24', '2019-10-05 17:25:36', 1),
(9, 20, 2, 1, 3, 'tra-000014', '45678545678', '50000.00', '2019-09-28', '2019-10-05 17:25:36', 1),
(10, 18, 1, 1, 4, 'tra-000023', '24356456567', '50000.00', '2019-09-30', '2019-10-05 17:25:36', 1),
(11, 29, 1, 2, 1, 'efe-000006', '4567495821', '60000.00', '2019-09-17', '2019-10-05 17:25:36', 2),
(12, 22, 1, 1, 5, 'tra-000025', '15467890', '55000.00', '2019-10-04', '2019-10-05 17:25:36', 1),
(13, NULL, 1, 2, 1, 'efe-000008', '54687895', '60000.00', '2019-10-05', '2019-10-05 17:25:36', 1),
(15, NULL, 1, 1, 1, 'tra-000026', '', '60000.00', '2019-10-05', '2019-10-05 17:25:36', 1),
(16, 31, 1, 2, 2, 'efe-000009', '234587964567', '60000.00', '2019-10-05', '2019-10-05 17:29:11', 2),
(17, 24, 1, 1, 6, 'tra-000027', '456765678909', '65000.00', '2019-10-06', '2019-10-06 11:52:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `cedula_participante` int(11) NOT NULL,
  `nombres_participante` varchar(95) COLLATE latin1_general_ci NOT NULL,
  `apellidos_participante` varchar(95) COLLATE latin1_general_ci NOT NULL,
  `fecha_nacimiento_participante` date NOT NULL,
  `genero_participante` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono_participante` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `direccion_participante` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_participante` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id_participante`, `cedula_participante`, `nombres_participante`, `apellidos_participante`, `fecha_nacimiento_participante`, `genero_participante`, `telefono_participante`, `direccion_participante`, `estado_participante`) VALUES
(1, 22574648, 'Juan Luis', 'Chaurant', '1993-12-13', 'masculino', '04248900840', 'El Tigre, estado Anzoátegui', 1),
(2, 8247642, 'Manuel José', 'Colmenáres', '2001-08-15', 'masculino', '04248779086', 'Urbanización Choronó', 1),
(3, 22860367, 'Nathalia', 'Monger', '1993-10-24', 'femenino', '04248900555', 'El Tigre, estado Anzoátegui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `mes_inicio_periodo` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `mes_cierre_periodo` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `year_periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `mes_inicio_periodo`, `mes_cierre_periodo`, `year_periodo`) VALUES
(1, 'Septiembre', 'Diciembre', 2019),
(2, 'Enero', 'Marzo', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `descripcion` varchar(256) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre`, `descripcion`) VALUES
(1, 'superadmin', 'con todos los permisos en el sistema'),
(2, 'admin', 'permisos parciales en el sistema'),
(3, 'usuario', 'puede realizar ciertas operaciones en el sistema');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `id_tipo_de_operacion` int(11) NOT NULL,
  `tipo_de_operacion` varchar(35) COLLATE latin1_general_ci NOT NULL,
  `conteo_operaciones` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tipo_de_operacion`
--

INSERT INTO `tipo_de_operacion` (`id_tipo_de_operacion`, `tipo_de_operacion`, `conteo_operaciones`) VALUES
(1, 'Transferencia', 27),
(2, 'Efectivo', 9),
(3, 'Exonerado', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombres_usuario` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `apellidos_usuario` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `email_usuario` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `username_usuario` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `password_usuario` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `fk_rol_id_1` int(11) DEFAULT NULL,
  `estado_usuario` varchar(45) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres_usuario`, `apellidos_usuario`, `email_usuario`, `username_usuario`, `password_usuario`, `fk_rol_id_1`, `estado_usuario`) VALUES
(0, 'Johan', 'Basil', 'johan@cecal.com', 'johan-1213', '98ce34038035debf9af5d5482829aeddfb543f7e', 1, 'activo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id_banco`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id_estatus`);

--
-- Indexes for table `facilitador`
--
ALTER TABLE `facilitador`
  ADD PRIMARY KEY (`id_facilitador`);

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `fk_id_participante_1` (`fk_id_participante_1`),
  ADD KEY `fk_id_estatus_1` (`fk_id_estatus_1`),
  ADD KEY `fk_id_usuario_1` (`fk_id_usuario_1`);

--
-- Indexes for table `inscripcion_curso`
--
ALTER TABLE `inscripcion_curso`
  ADD PRIMARY KEY (`id_inscripcion_curso`),
  ADD KEY `fk_id_inscripcion_1` (`fk_id_inscripcion_1`),
  ADD KEY `inscripcion_instancia_ibfk_1` (`fk_id_curso_1`);

--
-- Indexes for table `instancia`
--
ALTER TABLE `instancia`
  ADD PRIMARY KEY (`id_instancia`),
  ADD KEY `fk_id_curso_1` (`fk_id_curso_1`),
  ADD KEY `fk_id_facilitador_1` (`fk_id_facilitador_1`),
  ADD KEY `fk_id_periodo_1` (`fk_id_periodo_1`),
  ADD KEY `fk_id_locacion_1` (`fk_id_locacion_1`);

--
-- Indexes for table `locacion`
--
ALTER TABLE `locacion`
  ADD PRIMARY KEY (`id_locacion`);

--
-- Indexes for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_id_banco` (`fk_id_banco`),
  ADD KEY `fk_id_tipo_operacion` (`fk_id_tipo_operacion`),
  ADD KEY `fk_id_pagador` (`fk_id_pagador`),
  ADD KEY `fk_id_inscripcion` (`fk_id_inscripcion`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexes for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  ADD PRIMARY KEY (`id_tipo_de_operacion`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`),
  ADD UNIQUE KEY `username_usuario` (`username_usuario`),
  ADD KEY `fk_rol_id_1` (`fk_rol_id_1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banco`
--
ALTER TABLE `banco`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del banco de operación', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id_estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilitador`
--
ALTER TABLE `facilitador`
  MODIFY `id_facilitador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la entidad, autogenerado', AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `inscripcion_curso`
--
ALTER TABLE `inscripcion_curso`
  MODIFY `id_inscripcion_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `instancia`
--
ALTER TABLE `instancia`
  MODIFY `id_instancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locacion`
--
ALTER TABLE `locacion`
  MODIFY `id_locacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `id_tipo_de_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`fk_id_participante_1`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`fk_id_estatus_1`) REFERENCES `estatus` (`id_estatus`),
  ADD CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`fk_id_usuario_1`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `inscripcion_curso`
--
ALTER TABLE `inscripcion_curso`
  ADD CONSTRAINT `inscripcion_curso_ibfk_1` FOREIGN KEY (`fk_id_inscripcion_1`) REFERENCES `inscripcion` (`id_inscripcion`),
  ADD CONSTRAINT `inscripcion_instancia_ibfk_1` FOREIGN KEY (`fk_id_curso_1`) REFERENCES `instancia` (`id_instancia`);

--
-- Constraints for table `instancia`
--
ALTER TABLE `instancia`
  ADD CONSTRAINT `instancia_ibfk_1` FOREIGN KEY (`fk_id_curso_1`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `instancia_ibfk_2` FOREIGN KEY (`fk_id_facilitador_1`) REFERENCES `facilitador` (`id_facilitador`),
  ADD CONSTRAINT `instancia_ibfk_3` FOREIGN KEY (`fk_id_periodo_1`) REFERENCES `periodo` (`id_periodo`),
  ADD CONSTRAINT `instancia_ibfk_4` FOREIGN KEY (`fk_id_locacion_1`) REFERENCES `locacion` (`id_locacion`);

--
-- Constraints for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_1` FOREIGN KEY (`fk_id_banco`) REFERENCES `banco` (`id_banco`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_2` FOREIGN KEY (`fk_id_tipo_operacion`) REFERENCES `tipo_de_operacion` (`id_tipo_de_operacion`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_3` FOREIGN KEY (`fk_id_pagador`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_4` FOREIGN KEY (`fk_id_inscripcion`) REFERENCES `inscripcion` (`id_inscripcion`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_rol_id_1`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
