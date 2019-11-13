-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 03:25 AM
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
-- Database: `test_ce_gestion_2019_10_20`
--

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE `accion` (
  `id_accion` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_tipo_accion` int(2) DEFAULT NULL,
  `descripcion_accion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tabla_afectada` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`id_accion`, `fk_id_usuario`, `fk_id_tipo_accion`, `descripcion_accion`, `tabla_afectada`, `fecha_creacion`) VALUES
(1, 0, 2, 'PERSONA ID: 20', 'PERSONA', '2019-11-13 01:50:30');

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
  `fk_id_persona_1` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `serial_cliente` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_cliente` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_cliente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `fk_id_persona_1`, `serial_cliente`, `estado_cliente`, `fecha_registro_cliente`) VALUES
(1, 3, NULL, 1, '2019-10-24 14:17:41'),
(2, 8, NULL, 1, '2019-10-28 21:36:19'),
(3, 11, NULL, 1, '2019-10-30 12:15:56'),
(4, 12, NULL, 1, '2019-10-30 20:09:44'),
(5, 13, NULL, 1, '2019-10-31 15:44:18'),
(6, 14, NULL, 1, '2019-11-02 17:37:18'),
(7, 15, NULL, 1, '2019-11-05 22:25:47'),
(8, 16, NULL, 1, '2019-11-05 23:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `estado_curso` int(1) NOT NULL DEFAULT '1',
  `descripcion_curso` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `veces_instanciado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre_curso`, `estado_curso`, `descripcion_curso`, `veces_instanciado`) VALUES
(1, 'Informática', 1, 'Dirigído a estudiantes de informática', 1),
(2, 'Reparación de Computadoras', 1, 'Para los que le gusta botar tornillo', 0),
(3, 'Corte y Costura', 1, 'Para quienes fabrican ropa', 1);

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
  `estado_facilitador` varchar(9) COLLATE latin1_general_ci NOT NULL DEFAULT '1' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, 0 = Eliminado',
  `fecha_registro_facilitador` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro',
  `fk_id_persona_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `facilitador`
--

INSERT INTO `facilitador` (`id_facilitador`, `estado_facilitador`, `fecha_registro_facilitador`, `fk_id_persona_3`) VALUES
(1, '1', '2018-07-19 00:00:00', 1),
(2, '1', '2019-10-22 23:07:26', 3),
(4, '1', '2019-10-22 23:15:36', 5),
(9, '1', '2019-10-23 23:57:11', 6),
(10, '1', '2019-10-30 20:58:34', 11);

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
(3, 2, 1, NULL, '2019-10-24', '2019-10-24 22:00:23', NULL, '55000.00', '60000.00', '0.00', '60000.00', 1),
(4, 2, 1, NULL, '2019-10-30', '2019-10-30 12:25:35', NULL, '34900.00', '60000.00', '0.00', '60000.00', 1),
(5, 3, 1, NULL, '2019-10-30', '2019-10-30 14:56:51', NULL, '60000.00', '60000.00', '0.00', '60000.00', 1),
(6, 3, 1, NULL, '2019-10-30', '2019-10-30 15:01:06', NULL, '60000.00', '60000.00', '0.00', '60000.00', 1),
(7, 5, 1, NULL, '2019-10-31', '2019-10-31 16:04:09', NULL, '650000.00', '0.00', '0.00', '0.00', 1),
(8, 3, 1, NULL, '2019-11-02', '2019-11-02 20:05:18', NULL, '60000.00', '60000.00', '0.00', '60000.00', 1),
(9, 3, 1, NULL, '2019-11-02', '2019-11-02 21:08:07', NULL, '34900.00', '60000.00', '0.00', '60000.00', 1),
(10, 6, 1, NULL, '2019-11-02', '2019-11-02 23:02:20', NULL, '60000.00', '60000.00', '0.00', '60000.00', 1),
(11, 8, 1, NULL, '2019-11-05', '2019-11-05 22:28:41', NULL, '120000.00', '125000.00', '0.00', '125000.00', 1),
(12, 9, 1, NULL, '2019-11-05', '2019-11-05 23:17:48', NULL, '150000.00', '60000.00', '0.00', '60000.00', 1);

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
(1, 3, 1),
(2, 6, 1),
(3, 7, 3),
(4, 8, 1),
(5, 9, 1),
(6, 10, 1),
(7, 11, 7),
(8, 11, 1),
(9, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `instancia`
--

CREATE TABLE `instancia` (
  `id_instancia` int(11) NOT NULL,
  `serial_instancia` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `fk_id_curso_1` int(11) NOT NULL,
  `fk_id_facilitador_1` int(11) DEFAULT NULL,
  `fk_id_periodo_1` int(11) DEFAULT NULL,
  `fk_id_locacion_1` int(11) DEFAULT NULL,
  `fk_id_turno_instancia_1` int(11) NOT NULL COMMENT 'Referencia a la tabla turno_instancia',
  `cupos_instancia` int(4) DEFAULT NULL,
  `precio_instancia` decimal(10,2) DEFAULT NULL COMMENT 'Precio a pagar para la inscripción',
  `estado_instancia` int(1) NOT NULL DEFAULT '1',
  `descripcion_instancia` varchar(256) COLLATE latin1_general_ci DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente la instancia',
  `cupos_instancia_ocupados` int(11) NOT NULL DEFAULT '0' COMMENT 'Cuenta el total de participantes inscritos en un curso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `instancia`
--

INSERT INTO `instancia` (`id_instancia`, `serial_instancia`, `fk_id_curso_1`, `fk_id_facilitador_1`, `fk_id_periodo_1`, `fk_id_locacion_1`, `fk_id_turno_instancia_1`, `cupos_instancia`, `precio_instancia`, `estado_instancia`, `descripcion_instancia`, `cupos_instancia_ocupados`) VALUES
(1, '', 1, 1, 1, 1, 4, 15, '60000.00', 1, 'Sin Descripción', 7),
(3, '', 2, 4, 1, 1, 4, 5, '60000.00', 1, 'Sin Descripción', 1),
(7, '', 3, 9, 1, 1, 3, 5, '65000.00', 1, 'Sin Descripción', 1),
(11, '', 2, 1, 1, 1, 3, 5, '65000.00', 1, 'Dictado en la mañana', 0),
(13, '', 2, 1, 1, 1, 3, 5, '60000.00', 1, 'Otro de computadoras', 0),
(14, '', 2, 1, 1, 1, 3, 5, '60000.00', 1, 'Otro de computadoras', 0),
(15, '', 3, 10, 1, 1, 4, 5, '60000.00', 1, 'Corte y costura', 0),
(16, 'Inf-000001', 1, 9, 1, 1, 4, 5, '60000.00', 1, 'Más programación', 0);

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
(1, 'Casa del Periodista', 'Detrás del Liceo Alberto Carnevali');

-- --------------------------------------------------------

--
-- Table structure for table `pago_de_inscripcion`
--

CREATE TABLE `pago_de_inscripcion` (
  `id_pago` int(11) NOT NULL,
  `fk_id_inscripcion` int(11) DEFAULT NULL,
  `fk_id_banco` int(11) DEFAULT NULL,
  `fk_id_tipo_operacion` int(11) NOT NULL,
  `fk_id_cliente` int(11) NOT NULL,
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

INSERT INTO `pago_de_inscripcion` (`id_pago`, `fk_id_inscripcion`, `fk_id_banco`, `fk_id_tipo_operacion`, `fk_id_cliente`, `serial_pago`, `numero_operacion`, `monto_operacion`, `fecha_operacion`, `fecha_registro_operacion`, `estado_pago`) VALUES
(1, 3, 1, 1, 1, 'tra-000028', '463467894321', '55000.00', '2019-10-24', '2019-10-24 19:28:11', 2),
(2, 8, 1, 2, 1, 'efe-000010', '345623425467', '60000.00', '2019-10-24', '2019-10-24 20:08:14', 2),
(3, 9, 1, 2, 1, 'efe-000011', '0102456594345', '34900.00', '2019-10-24', '2019-10-24 20:42:33', 2),
(5, 6, 1, 1, 3, 'tra-000029', '456879854658', '60000.00', '2019-10-28', '2019-10-30 14:45:44', 2),
(6, 7, 1, 1, 5, 'tra-000030', '456789564578', '650000.00', '2019-10-31', '2019-10-31 15:49:23', 2),
(7, 10, 1, 1, 6, 'tra-000031', '0102132414532323', '60000.00', '2019-11-02', '2019-11-02 23:01:16', 2),
(8, 11, 1, 1, 7, 'tra-000032', '425343549234', '120000.00', '2019-11-05', '2019-11-05 22:27:06', 2),
(9, 12, 1, 1, 8, 'tra-000033', '234578091343', '150000.00', '2019-11-05', '2019-11-05 23:13:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `fk_id_persona_2` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `serial_participante` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_participante` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_participante` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id_participante`, `fk_id_persona_2`, `serial_participante`, `estado_participante`, `fecha_registro_participante`) VALUES
(1, 1, NULL, 1, '2019-10-24 11:36:38'),
(2, 7, NULL, 1, '2019-10-24 12:08:58'),
(3, 11, NULL, 1, '2019-10-30 14:56:14'),
(4, 12, NULL, 1, '2019-10-30 20:30:01'),
(5, 13, NULL, 1, '2019-10-31 15:52:42'),
(6, 14, NULL, 1, '2019-11-02 16:34:32'),
(7, 3, NULL, 1, '2019-11-02 19:21:13'),
(8, 15, NULL, 1, '2019-11-05 22:27:54'),
(9, 16, NULL, 1, '2019-11-05 23:15:10');

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
(1, 'Enero', 'Marzo', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `persona_id` int(11) NOT NULL,
  `cedula_persona` int(11) NOT NULL,
  `nombres_persona` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `apellidos_persona` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `genero_persona` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_nacimiento_persona` date NOT NULL,
  `telefono_persona` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `direccion_persona` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_persona` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_persona` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`persona_id`, `cedula_persona`, `nombres_persona`, `apellidos_persona`, `genero_persona`, `fecha_nacimiento_persona`, `telefono_persona`, `direccion_persona`, `estado_persona`, `fecha_registro_persona`) VALUES
(1, 22574648, 'Juan Luis', 'Chaurant Zamora', '1', '1993-12-13', '04248900840', 'El Tigre, edo. Anzoátegui', 1, '2019-11-06 17:11:32'),
(3, 8965910, 'Alicia', 'Zamora', '2', '1967-03-03', '04242929292', 'EL Tigre, Chaguaramos', 1, '2019-11-06 17:11:32'),
(5, 9458635, 'Edgardo', 'Saá', '1', '1969-09-04', '04249485560', 'Av. La Paz, urb. Chimire.', 1, '2019-11-06 17:11:32'),
(6, 7294645, 'Marco', 'Aurelio', '1', '1965-09-25', '04149675848', 'El Tigrito, Campo Norte', 0, '2019-11-06 17:11:32'),
(7, 4965328, 'Johan', 'Bach', '1', '1960-10-13', '04165843323', 'El Tigrito, Campo Norte, casa #230', 0, '2019-11-06 17:11:32'),
(8, 25468978, 'Asena', 'Vural', '2', '1999-11-20', '04245694548', 'Av. Franca, El Tigre', 1, '2019-11-06 17:11:32'),
(9, 27865343, 'José', 'Lopez', '1', '2000-10-20', '04167843304', 'El Tigre, antes del estadio', 1, '2019-11-06 17:11:32'),
(10, 23254648, 'Felipe', 'Rondón', '1', '1999-09-23', '04245643943', 'El Tigre, estado Anzoátegui', 1, '2019-11-06 17:11:32'),
(11, 12438628, 'Yulimar Celidett', 'Fajardo Rojas', '2', '1975-10-20', '04247684312', 'El Tigre, detrás de Campo Oficina', 1, '2019-11-06 17:11:32'),
(12, 25678432, 'Joselyn', 'Marín', '2', '1996-10-13', '04267242295', 'Av. Carabobo, cruce con calle 10', 1, '2019-11-06 17:11:32'),
(13, 12275704, 'José', 'Astudillo', '1', '1975-11-03', '04248965754', 'El Tigrito, Chimire', 1, '2019-11-06 17:11:32'),
(14, 8477818, 'Felix', 'Blackman', '1', '1965-05-27', '04248113920', 'El Tigre, detrás de La Cascada', 1, '2019-11-06 17:11:32'),
(15, 25568648, 'Mario', 'Bustamante', '1', '1997-12-04', '04245645456', 'El Tigre, estado Anzoátegui', 1, '2019-11-06 17:11:32'),
(16, 2582893, 'Esteban de Jesus', 'Chaurant Zamora', '1', '1995-12-26', '04141929294', 'Aveneda 2 Casa N|° 118 Sector Cincuentenario ', 1, '2019-11-06 17:11:32'),
(18, 27546895, 'Yorman', 'Pérez', '1', '2019-11-06', '', '', 1, '2019-11-06 17:47:45'),
(19, 23857463, 'Katty', 'Otero', '2', '1995-12-14', '04142354465', 'Urb. Los Naranjos, calle 5', 1, '2019-11-12 21:45:02'),
(20, 25657342, 'Fernando', 'La Rosa', '1', '1994-12-09', '04167922205', 'La California, el Tigrito', 1, '2019-11-12 21:50:30');

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
-- Table structure for table `tipo_de_accion`
--

CREATE TABLE `tipo_de_accion` (
  `id_tipo_accion` int(2) NOT NULL,
  `nombre_tipo_accion` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `alerta_tipo_accion` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `estado_tipoaccion` int(1) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipo_de_accion`
--

INSERT INTO `tipo_de_accion` (`id_tipo_accion`, `nombre_tipo_accion`, `alerta_tipo_accion`, `estado_tipoaccion`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'ELIMINAR', 'alert-danger', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(2, 'INSERTAR', 'alert-success', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(3, 'MODIFICAR', 'alert-info', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05');

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
(1, 'Transferencia', 33),
(2, 'Efectivo', 11),
(3, 'Exonerado', 0);

-- --------------------------------------------------------

--
-- Table structure for table `turno_instancia`
--

CREATE TABLE `turno_instancia` (
  `id_turno` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `nombre_turno` varchar(45) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Almacena los turnos en los que la institución oferta sus cursos',
  `descripcion_turno` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Breve descripción del turno especificado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `turno_instancia`
--

INSERT INTO `turno_instancia` (`id_turno`, `nombre_turno`, `descripcion_turno`) VALUES
(3, 'Mañana', 'Turno de 8:00am a 12:00m'),
(4, 'Tarde', 'Turno de 1:00pm a 5:00pm');

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
-- Indexes for table `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `fk_id_tipo_accion` (`fk_id_tipo_accion`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- Indexes for table `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id_banco`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_id_persona_1` (`fk_id_persona_1`);

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
  ADD PRIMARY KEY (`id_facilitador`),
  ADD KEY `FK_ID_PERSONA_3` (`fk_id_persona_3`);

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `inscripcion_ibfk_2` (`fk_id_estatus_1`),
  ADD KEY `inscripcion_ibfk_3` (`fk_id_usuario_1`),
  ADD KEY `fk_id_participante_1` (`fk_id_participante_1`);

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
  ADD KEY `fk_id_locacion_1` (`fk_id_locacion_1`),
  ADD KEY `turno_instancia_ibfk_1` (`fk_id_turno_instancia_1`);

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
  ADD KEY `pago_de_inscripcion_ibfk_1` (`fk_id_banco`),
  ADD KEY `pago_de_inscripcion_ibfk_2` (`fk_id_tipo_operacion`),
  ADD KEY `FK_PAGO_INSCRIPCION_1` (`fk_id_cliente`),
  ADD KEY `inscripcion_curso_fk_1` (`fk_id_inscripcion`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`),
  ADD KEY `fk_id_persona_2` (`fk_id_persona_2`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`persona_id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexes for table `tipo_de_accion`
--
ALTER TABLE `tipo_de_accion`
  ADD PRIMARY KEY (`id_tipo_accion`);

--
-- Indexes for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  ADD PRIMARY KEY (`id_tipo_de_operacion`);

--
-- Indexes for table `turno_instancia`
--
ALTER TABLE `turno_instancia`
  ADD PRIMARY KEY (`id_turno`);

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
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banco`
--
ALTER TABLE `banco`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del banco de operación', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id_facilitador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la entidad, autogenerado', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inscripcion_curso`
--
ALTER TABLE `inscripcion_curso`
  MODIFY `id_inscripcion_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `instancia`
--
ALTER TABLE `instancia`
  MODIFY `id_instancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `locacion`
--
ALTER TABLE `locacion`
  MODIFY `id_locacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `persona_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `id_tipo_de_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `turno_instancia`
--
ALTER TABLE `turno_instancia`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Referencia a la tabla Participante', AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`fk_id_tipo_accion`) REFERENCES `tipo_de_accion` (`id_tipo_accion`),
  ADD CONSTRAINT `accion_ibfk_2` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`fk_id_persona_1`) REFERENCES `persona` (`persona_id`);

--
-- Constraints for table `facilitador`
--
ALTER TABLE `facilitador`
  ADD CONSTRAINT `FK_ID_PERSONA_3` FOREIGN KEY (`fk_id_persona_3`) REFERENCES `persona` (`persona_id`);

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`fk_id_estatus_1`) REFERENCES `estatus` (`id_estatus`),
  ADD CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`fk_id_usuario_1`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `inscripcion_ibfk_4` FOREIGN KEY (`fk_id_participante_1`) REFERENCES `participante` (`id_participante`);

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
  ADD CONSTRAINT `instancia_ibfk_4` FOREIGN KEY (`fk_id_locacion_1`) REFERENCES `locacion` (`id_locacion`),
  ADD CONSTRAINT `turno_instancia_ibfk_1` FOREIGN KEY (`fk_id_turno_instancia_1`) REFERENCES `turno_instancia` (`id_turno`);

--
-- Constraints for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD CONSTRAINT `FK_PAGO_INSCRIPCION_1` FOREIGN KEY (`fk_id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `inscripcion_curso_fk_1` FOREIGN KEY (`fk_id_inscripcion`) REFERENCES `inscripcion` (`id_inscripcion`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_1` FOREIGN KEY (`fk_id_banco`) REFERENCES `banco` (`id_banco`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_2` FOREIGN KEY (`fk_id_tipo_operacion`) REFERENCES `tipo_de_operacion` (`id_tipo_de_operacion`);

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`fk_id_persona_2`) REFERENCES `persona` (`persona_id`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_rol_id_1`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
