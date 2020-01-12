-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 03:36 PM
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
-- Database: `30_11_2019_ce_gestion`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_conteo_operacion` (IN `id_operacion` INT(11))  BEGIN 

UPDATE tipo_de_operacion SET tipo_de_operacion.conteo_operaciones = tipo_de_operacion.conteo_operaciones + 1
WHERE tipo_de_operacion.id_tipo_de_operacion = id_operacion;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `desactivaLocacion` (`idDeLocacion` INT)  BEGIN

	UPDATE locacion
    SET estado_locacion = 0
    WHERE id_locacion = idDeLocacion;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_pago_nuevo` (IN `id_banco` INT(11), IN `id_tipo_operacion` INT(11), IN `id_titular` INT(11), IN `serial_pago` VARCHAR(255), IN `numero_operacion` VARCHAR(255), IN `monto_operacion` DECIMAL(10,2), IN `fecha_operacion` DATE)  BEGIN 

 INSERT INTO `pago_de_inscripcion`(`fk_id_banco`, `fk_id_tipo_operacion`, `fk_id_titular`, `serial_pago`, `numero_operacion`, `monto_operacion`, `fecha_operacion`) 
 VALUES (id_banco, id_tipo_operacion, id_titular, serial_pago, numero_operacion, monto_operacion, fecha_operacion);
 
UPDATE tipo_de_operacion SET tipo_de_operacion.conteo_operaciones = tipo_de_operacion.conteo_operaciones + 1
WHERE tipo_de_operacion.id_tipo_de_operacion = id_tipo_operacion;
 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE `accion` (
  `id_accion` int(11) NOT NULL COMMENT 'ID de la tabla',
  `fk_id_usuario` int(11) NOT NULL COMMENT 'Referencia al usuario del sistema que realizó la acción',
  `fk_id_tipo_accion` int(2) DEFAULT NULL COMMENT 'Referencia al tipo de acción realizada',
  `descripcion_accion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la acción realizada',
  `tabla_afectada` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tabla afectada por la operación',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura automáticamente la hora de creación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`id_accion`, `fk_id_usuario`, `fk_id_tipo_accion`, `descripcion_accion`, `tabla_afectada`, `fecha_creacion`) VALUES
(1, 1, 2, 'PERSONA ID: 25', 'PERSONA', '2019-11-17 12:59:58'),
(2, 1, 3, 'PERSONA ID: 25', 'PERSONA', '2019-11-17 13:41:09'),
(3, 1, 1, 'PERSONA ID: 18', 'PERSONA', '2019-11-17 19:52:06'),
(4, 1, 2, 'PERSONA ID: 26', 'PERSONA', '2019-12-21 02:01:47'),
(5, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 16:13:22'),
(6, 1, 3, 'PERSONA ID: 23', 'PERSONA', '2019-12-22 18:02:23'),
(7, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:15:22'),
(8, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:15:29'),
(9, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:15:54'),
(10, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:17:35'),
(11, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:19:57'),
(12, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:21:13'),
(13, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:23:58'),
(14, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:29:16'),
(15, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:29:56'),
(16, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:30:02'),
(17, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 19:31:40'),
(18, 1, 3, 'Usuario ID: 2', 'Usuario', '2019-12-22 19:42:46'),
(19, 1, 3, 'Usuario ID: 2', 'Usuario', '2019-12-22 19:42:54'),
(20, 1, 3, 'Usuario ID: 2', 'Usuario', '2019-12-22 19:44:54'),
(21, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 20:09:59'),
(22, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 20:10:08'),
(28, 1, 1, 'Usuario ID: 5', 'Usuario', '2019-12-22 20:24:54'),
(29, 1, 3, 'Usuario ID: 3', 'Usuario', '2019-12-22 22:52:59'),
(30, 1, 3, 'Usuario ID: 2', 'Usuario', '2019-12-22 22:53:10'),
(31, 1, 3, 'Usuario ID: 2', 'Usuario', '2019-12-22 22:53:31'),
(32, 1, 3, 'Usuario ID: 1', 'Usuario', '2019-12-23 03:54:07'),
(33, 5, 3, 'Usuario ID: 4', 'Usuario', '2019-12-23 04:45:24'),
(34, 4, 3, 'Usuario ID: 5', 'Usuario', '2019-12-23 04:47:43'),
(35, 5, 3, 'Usuario ID: 1', 'Usuario', '2019-12-23 04:55:46'),
(36, 1, 3, 'Usuario ID: 4', 'Usuario', '2019-12-23 05:01:12'),
(37, 1, 3, 'Usuario ID: 5', 'Usuario', '2019-12-23 13:49:56'),
(38, 1, 3, 'Usuario ID: 5', 'Usuario', '2019-12-23 14:10:15'),
(39, 1, 3, 'Usuario ID: 5', 'Usuario', '2019-12-23 14:12:35'),
(40, 1, 3, 'Usuario ID: 5', 'Usuario', '2019-12-23 14:13:01'),
(41, 1, 3, 'Usuario ID: 5', 'Usuario', '2019-12-23 14:14:20'),
(42, 1, 3, 'Usuario ID: 4', 'Usuario', '2019-12-23 14:15:06'),
(43, 1, 3, 'Usuario ID: 1', 'Usuario', '2019-12-23 14:38:54'),
(44, 5, 2, 'PERSONA ID: 27', 'PERSONA', '2020-01-02 04:06:21'),
(45, 5, 3, 'PERSONA ID: 23', 'PERSONA', '2020-01-04 21:22:17'),
(46, 5, 3, 'PERSONA ID: 27', 'PERSONA', '2020-01-04 21:24:24'),
(47, 5, 3, 'PERSONA ID: 27', 'PERSONA', '2020-01-04 21:24:30'),
(48, 5, 2, 'PERSONA ID: 28', 'PERSONA', '2020-01-04 21:29:33'),
(49, 5, 2, 'PERSONA ID: 29', 'PERSONA', '2020-01-04 21:56:22'),
(50, 5, 2, 'PERSONA ID: 30', 'PERSONA', '2020-01-06 05:09:23'),
(51, 5, 2, 'PERSONA ID: 31', 'PERSONA', '2020-01-07 15:29:43'),
(52, 5, 3, 'PERSONA ID: 16', 'PERSONA', '2020-01-08 18:21:22');

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
(2, 'Bancaribe', 'El banco de Venezuela y el Caribe'),
(3, 'Mercantil', 'Banco mercantil'),
(4, 'Sin Banco', 'Valor seleccionado cuando no hay banco intermediario');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `estado_curso` int(1) NOT NULL DEFAULT '1',
  `descripcion_curso` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `veces_instanciado` int(11) NOT NULL DEFAULT '0',
  `fecha_registro_curso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre_curso`, `estado_curso`, `descripcion_curso`, `veces_instanciado`, `fecha_registro_curso`) VALUES
(1, 'Informática', 1, 'Dirigído a estudiantes de informática', 2, '2019-12-22 09:00:00'),
(2, 'Reparación de Computadoras', 1, 'Enfoque en reparaciónes de Hardware', 1, '2019-12-22 17:09:44'),
(3, 'Corte y Costura', 1, 'Para quienes fabrican ropa', 2, '2019-12-22 17:15:44'),
(4, 'Refrigeración', 1, 'Curso dedicado a la reparación de equipos', 4, '2019-12-22 17:48:44');

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
(1, '1', '2019-11-15 18:09:12', 23),
(2, '1', '2019-11-15 18:45:43', 1),
(3, '1', '2020-01-06 14:05:17', 28);

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL COMMENT 'ID de la entidad, autogenerado',
  `fk_id_participante_1` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `fk_id_estatus_1` int(11) NOT NULL DEFAULT '1' COMMENT 'Referencia la tabla Estatus, el estatus de una isncripción puede ser: 1. Pago, 2. Por pagar',
  `fk_id_usuario_1` int(11) DEFAULT NULL COMMENT 'Referencia a la tabla usuarios, permite registrar que usuario realiza la operación',
  `hora_inscripcion` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora capturada automáticamente por el sistema',
  `hora_cancelada` datetime DEFAULT NULL COMMENT 'Hora en que se cancela el pago (puede no ser cancelado)',
  `costo_de_inscripcion` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero a pagar por las instancias inscritas',
  `activa` tinyint(1) DEFAULT '1' COMMENT 'Estado de la inscripción, usado para "desactivar el registro". 1 = Activo, 0 = Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `fk_id_participante_1`, `fk_id_estatus_1`, `fk_id_usuario_1`, `hora_inscripcion`, `hora_cancelada`, `costo_de_inscripcion`, `activa`) VALUES
(1, 1, 1, NULL, '2019-11-15 18:22:02', NULL, '60000.00', 1),
(2, 2, 1, NULL, '2019-11-15 18:50:14', NULL, '60000.00', 1),
(3, 3, 1, NULL, '2019-11-18 14:38:26', NULL, '60000.00', 1),
(4, 4, 1, NULL, '2019-12-20 22:05:35', NULL, '60000.00', 1),
(5, 5, 1, NULL, '2019-12-21 12:45:39', NULL, '60000.00', 1),
(6, 1, 1, NULL, '2019-12-24 12:21:03', NULL, '60000.00', 1),
(7, 3, 1, NULL, '2019-12-25 13:42:24', NULL, '60000.00', 1),
(8, 4, 1, NULL, '2019-12-26 19:09:25', NULL, '60000.00', 1),
(9, 3, 1, NULL, '2019-12-29 22:20:27', NULL, '60000.00', 1),
(10, 2, 1, NULL, '2019-12-30 00:49:40', NULL, '60000.00', 1),
(11, 7, 1, NULL, '2020-01-06 00:11:41', NULL, '100000.00', 1),
(13, 6, 1, NULL, '2020-01-06 00:46:37', NULL, '100000.00', 1),
(14, 9, 1, NULL, '2020-01-07 11:32:42', NULL, '100000.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion_instancia`
--

CREATE TABLE `inscripcion_instancia` (
  `id_inscripcion_instancia` int(11) NOT NULL,
  `fk_id_inscripcion_1` int(11) DEFAULT NULL,
  `fk_id_instancia_1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `inscripcion_instancia`
--

INSERT INTO `inscripcion_instancia` (`id_inscripcion_instancia`, `fk_id_inscripcion_1`, `fk_id_instancia_1`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 7, 1),
(8, 8, 3),
(9, 9, 3),
(10, 10, 1),
(11, 11, 6),
(12, 13, 6),
(13, 14, 3);

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
  `estado_instancia` int(1) NOT NULL DEFAULT '1' COMMENT 'Determina el estado de la instancia. 1 = Activa, 2 = Desactivada',
  `descripcion_instancia` varchar(256) COLLATE latin1_general_ci DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente la instancia',
  `cupos_instancia_ocupados` int(11) NOT NULL DEFAULT '0' COMMENT 'Cuenta el total de participantes inscritos en un curso',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `instancia`
--

INSERT INTO `instancia` (`id_instancia`, `serial_instancia`, `fk_id_curso_1`, `fk_id_facilitador_1`, `fk_id_periodo_1`, `fk_id_locacion_1`, `fk_id_turno_instancia_1`, `cupos_instancia`, `precio_instancia`, `estado_instancia`, `descripcion_instancia`, `cupos_instancia_ocupados`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'REF-4-000002', 4, 1, 2, 1, 4, 15, '60000.00', 1, 'Refrigeración dictado en IRFA', 3, '2019-11-15 14:00:00', '2020-01-06 00:53:39'),
(2, 'INF-1-000002', 1, 2, 3, 1, 3, 12, '60000.00', 1, 'Ofimática y lógica', 5, '2019-11-15 10:38:19', '2020-01-03 14:02:04'),
(3, 'REP-2-000001', 2, 2, 2, 1, 4, 20, '100000.00', 1, 'Enfoque en hardware y sistemas operativos', 2, '2019-12-21 12:18:07', '2020-01-09 15:49:06'),
(4, 'COR-3-000002', 3, 2, 2, 1, 4, 10, '100000.00', 0, 'Corte y costura básico', 0, '2019-12-29 14:07:45', '2020-01-06 14:16:24'),
(6, 'REF-4-000003', 4, 1, 2, 2, 4, 10, '100000.00', 1, 'Enfoque en mantenimiento preventivo', 2, '2020-01-03 14:00:40', '2020-01-06 00:46:38'),
(7, 'REF-4-000004', 4, 3, 13, 5, 3, 10, '100000.00', 1, 'enfoque en mantenimiento correctivo', 0, '2020-01-06 14:53:32', '2020-01-06 14:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id_locacion` int(11) NOT NULL,
  `nombre_locacion` varchar(85) COLLATE latin1_general_ci NOT NULL COMMENT 'Nombre para mostrar en la interfáz de usuario',
  `direccion_locacion` varchar(355) COLLATE latin1_general_ci NOT NULL COMMENT 'Ubicación de la locación',
  `estado_locacion` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Para desactivar locación, el valor: 0. Para activar locación, el valor: 1',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `locacion`
--

INSERT INTO `locacion` (`id_locacion`, `nombre_locacion`, `direccion_locacion`, `estado_locacion`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'Casa del Periodista', 'Detrás del Liceo Alberto Carnevali', 1, '2019-11-17 16:26:58', '2020-01-06 00:55:48'),
(2, 'Sede IRFA', '8va carrera sur', 1, '2019-11-17 16:26:58', '2020-01-04 14:37:47'),
(5, 'NAF El Tigrito', 'Al lado de la cancha, San José de Guanipa', 1, '2020-01-06 14:37:57', '2020-01-06 14:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL COMMENT 'ID de la tabla',
  `nombre_menu` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'Nombre del menú',
  `enlace_menu` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'Controlador al que se relaciona este menú'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nombre_menu`, `enlace_menu`) VALUES
(1, 'Inicio', 'dashboard'),
(2, 'Cursos', 'gestion/cursos'),
(3, 'Usuarios', 'administrador/usuarios'),
(4, 'Permisos', 'administrador/permisos'),
(5, 'Personas', 'gestion/personas');

-- --------------------------------------------------------

--
-- Table structure for table `mes`
--

CREATE TABLE `mes` (
  `id_mes` int(11) NOT NULL COMMENT 'ID de la tabla',
  `nombre_mes` varchar(13) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Meses del año'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `mes`
--

INSERT INTO `mes` (`id_mes`, `nombre_mes`) VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'Julio'),
(8, 'Agosto'),
(9, 'Septiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre');

-- --------------------------------------------------------

--
-- Table structure for table `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `id_nivel_academico` int(11) NOT NULL,
  `nombre_nivel_academico` varchar(35) COLLATE latin1_general_ci NOT NULL COMMENT 'Nombre del nivel académico del participante',
  `estado_nivel_academico` int(11) NOT NULL DEFAULT '1' COMMENT 'Determina si un nivel está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro_nivel_academico` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion_nivel_academico` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nivel_academico`
--

INSERT INTO `nivel_academico` (`id_nivel_academico`, `nombre_nivel_academico`, `estado_nivel_academico`, `fecha_registro_nivel_academico`, `fecha_modificacion_nivel_academico`) VALUES
(1, 'Bachillerato', 1, '2020-01-08 10:17:34', '2020-01-08 14:09:56'),
(2, 'Diversificado', 1, '2020-01-08 10:16:49', '2020-01-08 14:09:53'),
(3, 'Otro', 1, '2020-01-08 10:18:01', '2020-01-08 10:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `pago_de_inscripcion`
--

CREATE TABLE `pago_de_inscripcion` (
  `id_pago` int(11) NOT NULL,
  `fk_id_inscripcion` int(11) DEFAULT NULL,
  `fk_id_banco` int(11) DEFAULT NULL,
  `fk_id_tipo_operacion` int(11) NOT NULL,
  `fk_id_titular` int(11) NOT NULL,
  `serial_pago` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `numero_operacion` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `monto_operacion` decimal(10,2) DEFAULT NULL,
  `fecha_operacion` date NOT NULL,
  `fecha_registro_operacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura hora de registro de la operación',
  `estado_pago` int(11) NOT NULL DEFAULT '1' COMMENT 'Registra si un pago ha sido utilizado o desactivado: 0 =  Desactivado, 1 = Nuevo, 2 = Utilizado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pago_de_inscripcion`
--

INSERT INTO `pago_de_inscripcion` (`id_pago`, `fk_id_inscripcion`, `fk_id_banco`, `fk_id_tipo_operacion`, `fk_id_titular`, `serial_pago`, `numero_operacion`, `monto_operacion`, `fecha_operacion`, `fecha_registro_operacion`, `estado_pago`) VALUES
(1, 1, 3, 1, 1, 'tra-000039', '010534212345', '60000.00', '2019-11-15', '2019-11-15 18:16:19', 2),
(2, 2, 3, 1, 2, 'tra-000040', '010523423243', '60000.00', '2019-11-15', '2019-11-15 18:49:40', 2),
(3, 3, 3, 1, 2, 'tra-000041', '010542434637', '60000.00', '2019-11-17', '2019-11-18 14:28:55', 2),
(4, 5, 1, 1, 4, 'tra-000042', '0102345343456543', '75000.00', '2019-12-02', '2019-12-01 22:42:16', 2),
(5, 4, 1, 1, 5, 'tra-000043', '010224322324', '100000.00', '2019-12-20', '2019-12-20 22:04:37', 2),
(6, 6, 2, 1, 1, 'tra-000044', '0103243243243135', '75000.00', '2019-12-24', '2019-12-24 12:19:52', 2),
(7, 7, 1, 1, 4, 'tra-000045', '010224322932', '75000.00', '2019-12-24', '2019-12-24 17:09:14', 2),
(11, 11, 1, 1, 1, 'tra-000049', '0102034342225443', '100000.00', '2019-12-25', '2019-12-25 13:08:15', 2),
(47, 8, 4, 3, 5, 'exo-000001', 'EXO000001', '50000.00', '2019-12-26', '2019-12-26 18:33:25', 2),
(53, 13, 4, 2, 5, 'efe-000016', 'EFE000016', '100000.00', '2019-12-27', '2019-12-27 00:52:25', 2),
(54, 10, 4, 3, 5, 'exo-000006', 'EXO000006', '25000.00', '2019-12-27', '2019-12-27 01:02:00', 2),
(55, 8, 4, 3, 4, 'exo-000007', 'EXO000007', '25000.00', '2019-12-27', '2019-12-27 01:16:21', 2),
(56, 9, 4, 2, 2, 'efe-000017', 'EFE000017', '25000.00', '2019-12-29', '2019-12-29 22:18:07', 2),
(57, 10, 3, 1, 3, 'tra-000066', '0104230988565453', '25000.00', '2019-12-23', '2019-12-30 00:45:39', 2),
(58, 9, 4, 2, 5, 'efe-000018', 'EFE000018', '50000.00', '2019-12-27', '2019-12-30 00:47:45', 2),
(59, 10, 4, 2, 2, 'efe-000019', 'EFE000019', '10000.00', '2019-12-31', '2019-12-31 12:23:29', 2),
(60, 14, 4, 2, 6, 'efe-000020', 'EFE000020', '110000.00', '2020-01-02', '2020-01-02 00:08:16', 3),
(61, NULL, 1, 1, 9, 'tra-000067', '0102034342222123', '100000.00', '2020-01-07', '2020-01-07 14:39:36', 1),
(62, NULL, 1, 3, 9, 'exo-000008', 'EXO000008', '10000.00', '2020-01-07', '2020-01-07 16:19:39', 1),
(63, NULL, 1, 1, 9, 'tra-000068', '0102034342228787', '25000.00', '2020-01-07', '2020-01-07 17:11:45', 1),
(64, NULL, 4, 3, 5, 'exo-000009', 'EXO000009', '0.00', '2020-01-07', '2020-01-07 17:28:35', 1),
(65, NULL, 4, 2, 7, 'efe-000021', 'EFE000021', '100000.00', '2020-01-07', '2020-01-07 19:29:41', 1),
(66, NULL, 4, 2, 6, 'efe-000022', 'EFE000022', '100000.00', '2020-01-08', '2020-01-08 01:45:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `fk_id_persona_2` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `serial_participante` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_participante` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_participante` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_nivel_academico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id_participante`, `fk_id_persona_2`, `serial_participante`, `estado_participante`, `fecha_registro_participante`, `fk_nivel_academico`) VALUES
(1, 19, NULL, 1, '2019-11-15 18:13:38', 1),
(2, 9, NULL, 1, '2019-11-15 18:48:25', 2),
(3, 12, NULL, 1, '2019-11-18 14:37:11', 1),
(4, 26, NULL, 1, '2019-12-20 22:02:56', 1),
(5, 6, NULL, 1, '2019-12-21 12:44:37', 1),
(6, 27, NULL, 1, '2020-01-02 00:07:13', 2),
(7, 28, NULL, 1, '2020-01-04 23:26:25', 1),
(8, 30, NULL, 1, '2020-01-06 01:09:48', 2),
(9, 31, NULL, 1, '2020-01-07 11:30:19', 1),
(10, 16, NULL, 1, '2020-01-08 14:14:21', 1),
(11, 11, NULL, 1, '2020-01-08 14:28:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `mes_inicio_periodo` int(11) NOT NULL,
  `mes_cierre_periodo` int(11) DEFAULT NULL,
  `fecha_inicio_periodo` date NOT NULL,
  `fecha_culminacion_periodo` date NOT NULL,
  `estado_periodo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `mes_inicio_periodo`, `mes_cierre_periodo`, `fecha_inicio_periodo`, `fecha_culminacion_periodo`, `estado_periodo`, `fecha_creacion`, `fecha_modificacion`) VALUES
(2, 1, 5, '2020-01-13', '2020-05-15', 1, '2019-11-15 17:01:36', '2020-01-01 15:14:13'),
(3, 9, 12, '2019-09-10', '2019-12-14', 1, '2019-11-17 17:43:41', '2020-01-01 16:23:03'),
(12, 12, 12, '2019-12-26', '2019-12-31', 0, '2020-01-03 00:00:00', '2020-01-03 21:30:58'),
(13, 6, 8, '2020-06-17', '2020-08-29', 1, '2020-01-06 14:33:04', '2020-01-06 14:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL COMMENT 'ID de la tabla',
  `fk_id_menu_1` int(11) DEFAULT NULL,
  `fk_id_rol_2` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL COMMENT 'lectura',
  `insert` int(11) DEFAULT NULL COMMENT 'insertar',
  `update` int(11) DEFAULT NULL COMMENT 'actualizar',
  `delete` int(11) DEFAULT NULL COMMENT 'borrar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `fk_id_menu_1`, `fk_id_rol_2`, `read`, `insert`, `update`, `delete`) VALUES
(3, 2, 3, 1, 0, 0, 0),
(4, 2, 1, 1, 1, 1, 1),
(5, 2, 2, 1, 1, 1, 0),
(6, 3, 1, 1, 1, 1, 1),
(7, 4, 1, 1, 1, 1, 1),
(8, 5, 3, 1, 0, 0, 0),
(9, 5, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `cedula_persona` int(11) NOT NULL,
  `nombres_persona` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `apellidos_persona` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `genero_persona` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_nacimiento_persona` date NOT NULL,
  `telefono_persona` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `direccion_persona` varchar(95) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_persona` int(11) NOT NULL DEFAULT '1' COMMENT 'Determina si una persona está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro_persona` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id_persona`, `cedula_persona`, `nombres_persona`, `apellidos_persona`, `genero_persona`, `fecha_nacimiento_persona`, `telefono_persona`, `direccion_persona`, `estado_persona`, `fecha_registro_persona`, `fecha_modificacion`) VALUES
(1, 22574648, 'Juan Luis', 'Chaurant Zamora', '1', '1993-12-13', '04248900840', 'El Tigre, edo. Anzoátegui', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(3, 8965910, 'Alicia', 'Zamora', '2', '1967-03-03', '04242929292', 'EL Tigre, Chaguaramos', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(5, 9458635, 'Edgardo', 'Saá', '1', '1969-09-04', '04249485560', 'Av. La Paz, urb. Chimire.', 1, '2019-11-06 17:11:32', '2019-11-15 22:12:10'),
(6, 7294645, 'Marco', 'Aurelio', '1', '1965-09-25', '04149675848', 'El Tigrito, Campo Norte', 1, '2019-11-06 17:11:32', '2019-11-15 22:12:07'),
(7, 4965328, 'Johan', 'Bach', '1', '1960-10-13', '04165843323', 'El Tigrito, Campo Norte, casa #230', 1, '2019-11-06 17:11:32', '2019-11-15 22:12:02'),
(8, 25468978, 'Asena', 'Vural', '2', '1999-11-20', '04245694548', 'Av. Franca, El Tigre', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(9, 27865343, 'José', 'Lopez', '1', '2000-10-20', '04167843304', 'El Tigre, antes del estadio', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(10, 23254648, 'Felipe', 'Rondón', '1', '1999-09-23', '04245643943', 'El Tigre, estado Anzoátegui', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(11, 12438628, 'Yulimar Celidett', 'Fajardo Rojas', '2', '1975-10-20', '04247684312', 'El Tigre, detrás de Campo Oficina', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(12, 25678432, 'Joselyn', 'Marín', '2', '1996-10-13', '04267242295', 'Av. Carabobo, cruce con calle 10', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(13, 12275704, 'José', 'Astudillo', '1', '1975-11-03', '04248965754', 'El Tigrito, Chimire', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(14, 8477818, 'Felix', 'Blackman', '1', '1965-05-27', '04248113920', 'El Tigre, detrás de La Cascada', 1, '2019-11-06 17:11:32', '2019-11-15 22:11:56'),
(15, 25568648, 'Mario', 'Bustamante', '1', '1997-12-04', '04245645456', 'El Tigre, estado Anzoátegui', 1, '2019-11-06 17:11:32', '2019-11-15 19:53:01'),
(16, 2582893, 'Esteban de Jesus', 'Chaurant Zamora', '1', '1995-12-26', '04141929294', 'Aveneda 2 Casa N° 118 Sector Cincuentenario ', 1, '2019-11-06 17:11:32', '2020-01-08 14:21:22'),
(18, 27546895, 'Yorman', 'Pérez', '1', '2019-11-06', '', '', 0, '2019-11-06 17:47:45', '2019-11-17 15:52:06'),
(19, 23857463, 'Katty', 'Otero', '2', '1995-12-14', '04142354465', 'Urb. Los Naranjos, calle 5', 1, '2019-11-12 21:45:02', '2019-11-15 19:53:01'),
(20, 25657342, 'Fernando', 'La Rosa', '1', '1994-12-09', '04167922205', 'La California, el Tigrito', 1, '2019-11-12 21:50:30', '2019-11-15 19:53:01'),
(21, 8477827, 'Gregorio', 'Velásquez', '1', '1964-06-27', '02834002095', 'El Tigre, Chaguaramos', 1, '2019-11-14 23:15:58', '2019-11-15 19:53:01'),
(22, 8466825, 'Manuel Alejandro', 'Contreras', '1', '1964-10-06', '04243254403', 'El Tigre, carretera negra', 1, '2019-11-14 23:31:00', '2019-11-17 08:09:20'),
(23, 10939925, 'Freddy', 'Miranda', '1', '0000-00-00', '', '', 1, '2019-11-15 15:20:39', '2019-11-15 19:53:01'),
(24, 27380945, 'Samuel Andrés', 'Requena Abache', '1', '1999-11-21', '04248812413', 'Urb. Virgen del Valle c/ Santa Rosa P130', 1, '2019-11-15 15:26:16', '2019-11-16 13:10:00'),
(25, 23454648, 'Daniel Fernando', 'Fernández', '1', '1994-12-14', '04243211514', 'Calle 10, sector Morichal. Casa #14', 1, '2019-11-17 08:59:57', '2019-11-17 09:41:09'),
(26, 8456789, 'Carmen', 'Martínez', '2', '1965-11-25', '04162839768', '17 de diciembre, calle 25', 1, '2019-12-20 22:01:46', '2019-12-20 22:01:46'),
(27, 29176244, 'Felipe', 'Gómez', '1', '2000-12-25', '04243445699', 'El Tigre, pueblo nuevo', 1, '2020-01-02 00:06:21', '2020-01-02 00:06:21'),
(28, 24688325, 'Edgar', 'Pacheco', '1', '1999-11-24', '04243251215', 'Urb. Los Naranjos, calle 5', 1, '2020-01-04 17:29:33', '2020-01-04 17:29:33'),
(29, 30254533, 'Ariana', 'Díaz', '2', '1999-01-13', '04243253324', 'Casco Viejo, cassa #125', 1, '2020-01-04 17:56:22', '2020-01-04 17:56:22'),
(30, 24322878, 'Jesús', 'Alcantara', '1', '1999-12-24', '04243254499', 'Av. Libertador, cruce con calle 12 ', 1, '2020-01-06 01:09:23', '2020-01-06 01:09:23'),
(31, 12504138, 'Alfredo', 'Bizcochea', '1', '1976-06-28', '04248070018', 'Calle Independencia, #16, 17 de Diciembre', 1, '2020-01-07 11:29:43', '2020-01-07 11:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL COMMENT 'ID único del registro',
  `nombre_rol` varchar(45) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Nombre del rol (Los principales son: superadmin, estándar)',
  `descripcion_rol` varchar(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Descripción de la funcionalidad de cada rol'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`, `descripcion_rol`) VALUES
(1, 'Superadmin', 'con todos los permisos en el sistema'),
(2, 'Admin', 'permisos parciales en el sistema'),
(3, 'Usuario', 'puede realizar ciertas operaciones en el sistema');

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
(1, 'Transferencia', 68),
(2, 'Efectivo', 22),
(3, 'Exonerado', 9);

-- --------------------------------------------------------

--
-- Table structure for table `titular`
--

CREATE TABLE `titular` (
  `id_titular` int(11) NOT NULL,
  `fk_id_persona_1` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `estado_cliente` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_cliente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `titular`
--

INSERT INTO `titular` (`id_titular`, `fk_id_persona_1`, `estado_cliente`, `fecha_registro_cliente`) VALUES
(1, 19, 1, '2019-11-15 18:13:51'),
(2, 9, 1, '2019-11-15 18:49:05'),
(3, 25, 1, '2019-11-17 09:01:43'),
(4, 6, 1, '2019-12-01 10:15:57'),
(5, 26, 1, '2019-12-20 22:02:02'),
(6, 27, 1, '2020-01-02 00:06:49'),
(7, 28, 1, '2020-01-04 23:26:25'),
(8, 30, 1, '2020-01-06 01:09:48'),
(9, 31, 1, '2020-01-07 11:30:19'),
(10, 16, 1, '2020-01-08 14:14:21');

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
  `username_usuario` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `password_usuario` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `fk_rol_id_1` int(11) DEFAULT NULL,
  `estado_usuario` int(45) DEFAULT '1',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres_usuario`, `apellidos_usuario`, `email_usuario`, `username_usuario`, `password_usuario`, `fk_rol_id_1`, `estado_usuario`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'Johan', 'Basil', 'johan@cecal.com', 'johan-1213', '98ce34038035debf9af5d5482829aeddfb543f7e', 3, 1, '2019-11-14 15:57:18', '2019-12-23 00:55:46'),
(2, 'Jesús', 'Blanco', 'jesusb@cecal.com', 'jesus_dx2', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, 1, '2019-11-14 20:45:32', '2019-12-22 18:53:10'),
(3, 'José Luis', 'José', 'josejose1@cecal.com', 'jose-jose15', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, 1, '2019-11-14 22:09:53', '2019-12-22 16:10:08'),
(4, 'Carmen', 'San Diego', 'carmen@cecal.com', 'Carmen-sandiego', '5e915c3f9376943c76bfdc374ec88b6e9a5c7168', 2, 1, '2019-11-14 22:31:18', '2019-12-23 10:14:42'),
(5, 'Alicia', 'Zamora', 'alicia@cecal.com', 'alicia-mar', '5e915c3f9376943c76bfdc374ec88b6e9a5c7168', 1, 1, '2019-12-22 15:55:05', '2019-12-23 10:13:00');

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
-- Indexes for table `inscripcion_instancia`
--
ALTER TABLE `inscripcion_instancia`
  ADD PRIMARY KEY (`id_inscripcion_instancia`),
  ADD KEY `fk_id_inscripcion_1` (`fk_id_inscripcion_1`),
  ADD KEY `inscripcion_instancia_ibfk_1` (`fk_id_instancia_1`);

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
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `mes`
--
ALTER TABLE `mes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD PRIMARY KEY (`id_nivel_academico`);

--
-- Indexes for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `pago_de_inscripcion_ibfk_1` (`fk_id_banco`),
  ADD KEY `pago_de_inscripcion_ibfk_2` (`fk_id_tipo_operacion`),
  ADD KEY `FK_PAGO_INSCRIPCION_1` (`fk_id_titular`),
  ADD KEY `inscripcion_instancia_fk_1` (`fk_id_inscripcion`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`),
  ADD KEY `fk_id_persona_2` (`fk_id_persona_2`),
  ADD KEY `participante_nivel_ibfk_2` (`fk_nivel_academico`);

--
-- Indexes for table `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `mes_inicio` (`mes_inicio_periodo`),
  ADD KEY `mes_cierre` (`mes_cierre_periodo`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `accion_fk_id_menu_1` (`fk_id_menu_1`),
  ADD KEY `accion_fk_id_rol_2` (`fk_id_rol_2`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

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
-- Indexes for table `titular`
--
ALTER TABLE `titular`
  ADD PRIMARY KEY (`id_titular`),
  ADD KEY `fk_id_persona_1` (`fk_id_persona_1`);

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
  ADD UNIQUE KEY `username_usuario` (`username_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`),
  ADD KEY `fk_rol_id_1` (`fk_rol_id_1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `banco`
--
ALTER TABLE `banco`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del banco de operación', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id_estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilitador`
--
ALTER TABLE `facilitador`
  MODIFY `id_facilitador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la entidad, autogenerado', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inscripcion_instancia`
--
ALTER TABLE `inscripcion_instancia`
  MODIFY `id_inscripcion_instancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `instancia`
--
ALTER TABLE `instancia`
  MODIFY `id_instancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `locacion`
--
ALTER TABLE `locacion`
  MODIFY `id_locacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mes`
--
ALTER TABLE `mes`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  MODIFY `id_nivel_academico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `id_tipo_de_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `titular`
--
ALTER TABLE `titular`
  MODIFY `id_titular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `turno_instancia`
--
ALTER TABLE `turno_instancia`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Referencia a la tabla Participante', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `facilitador`
--
ALTER TABLE `facilitador`
  ADD CONSTRAINT `FK_ID_PERSONA_3` FOREIGN KEY (`fk_id_persona_3`) REFERENCES `persona` (`id_persona`);

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`fk_id_estatus_1`) REFERENCES `estatus` (`id_estatus`),
  ADD CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`fk_id_usuario_1`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `inscripcion_ibfk_4` FOREIGN KEY (`fk_id_participante_1`) REFERENCES `participante` (`id_participante`);

--
-- Constraints for table `inscripcion_instancia`
--
ALTER TABLE `inscripcion_instancia`
  ADD CONSTRAINT `inscripcion_instancia_ibfk_1` FOREIGN KEY (`fk_id_inscripcion_1`) REFERENCES `inscripcion` (`id_inscripcion`),
  ADD CONSTRAINT `inscripcion_instancia_ibfk_2` FOREIGN KEY (`fk_id_instancia_1`) REFERENCES `instancia` (`id_instancia`);

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
  ADD CONSTRAINT `FK_PAGO_INSCRIPCION_1` FOREIGN KEY (`fk_id_titular`) REFERENCES `titular` (`id_titular`),
  ADD CONSTRAINT `inscripcion_instancia_fk_1` FOREIGN KEY (`fk_id_inscripcion`) REFERENCES `inscripcion` (`id_inscripcion`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_1` FOREIGN KEY (`fk_id_banco`) REFERENCES `banco` (`id_banco`),
  ADD CONSTRAINT `pago_de_inscripcion_ibfk_2` FOREIGN KEY (`fk_id_tipo_operacion`) REFERENCES `tipo_de_operacion` (`id_tipo_de_operacion`);

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`fk_id_persona_2`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `participante_nivel_ibfk_2` FOREIGN KEY (`fk_nivel_academico`) REFERENCES `nivel_academico` (`id_nivel_academico`);

--
-- Constraints for table `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `mes_cierre` FOREIGN KEY (`mes_cierre_periodo`) REFERENCES `mes` (`id_mes`),
  ADD CONSTRAINT `mes_inicio` FOREIGN KEY (`mes_inicio_periodo`) REFERENCES `mes` (`id_mes`);

--
-- Constraints for table `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `accion_fk_id_menu_1` FOREIGN KEY (`fk_id_menu_1`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `accion_fk_id_rol_2` FOREIGN KEY (`fk_id_rol_2`) REFERENCES `rol` (`rol_id`);

--
-- Constraints for table `titular`
--
ALTER TABLE `titular`
  ADD CONSTRAINT `titular_ibfk_1` FOREIGN KEY (`fk_id_persona_1`) REFERENCES `persona` (`id_persona`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_rol_id_1`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
