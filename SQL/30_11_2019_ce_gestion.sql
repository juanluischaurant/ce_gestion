-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2020 at 03:54 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAfecha_registro_inscripcion utf8mb4 */;

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
  `id` int(11) NOT NULL COMMENT 'ID de la tabla',
  `id_usuario` SMALLINT NOT NULL COMMENT 'Referencia al usuario del sistema que realizó la acción',
  `id_tipo_accion` TINYINT(2) DEFAULT NULL COMMENT 'Referencia al tipo de acción realizada',
  `descripcion` varchar(100) CHARACTER SET NOT NULL COMMENT 'Descripción de la acción realizada',
  `tabla_afectada` varchar(20) CHARACTER SET NOT NULL COMMENT 'Tabla afectada por la operación',
  `fecha_registro` CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura automáticamente la hora de creación del registro'
) ENGINE=InnoDB;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`id_accion`, `fk_id_usuario`, `fk_id_tipo_accion`, `descripcion_accion`, `tabla_afectada`, `fecha_creacion`) VALUES
(1, 1, 2, 'PERSONA ID: 25', 'PERSONA', '2019-11-17 12:59:58');
-- --------------------------------------------------------

--
-- Table structure for table `banco`
--

CREATE TABLE `banco` (
  `id` TINYINT NOT NULL COMMENT 'ID del banco de operación',
  `nombre` varchar(255) NOT NULL COMMENT 'Nombre del banco'
) ENGINE=InnoDB;

--
-- Dumping data for table `banco`
--

INSERT INTO `banco` (`id`, `nombre`) VALUES
(1, 'Banco de Venezuela'),
(2, 'Bancaribe'),
(3, 'Mercantil'),
(4, 'Sin Banco');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id` SMALLINT NOT NULL PRIMARY KEY,
  `nombre` varchar(45) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `descripcion` varchar(256) DEFAULT 'Sin Descripción',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `estado`, `descripcion`, `fecha_registro`) VALUES
(1, 'Informática', 1, 'Dirigído a estudiantes de informática', '2019-12-22 09:00:00'),
(2, 'Reparación de Computadoras', 1, 'Enfoque en reparaciónes de Hardware', '2019-12-22 17:09:44'),
(3, 'Corte y Costura', 1, 'Para quienes fabrican ropa', '2019-12-22 17:15:44'),
(4, 'Refrigeración', 1, 'Curso dedicado a la reparación de equipos', '2019-12-22 17:48:44');

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `facilitador`
--

CREATE TABLE `facilitador` (
  `id_facilitador` int(11) NOT NULL,
  `estado_facilitador` varchar(9) NOT NULL DEFAULT '1' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, 0 = Eliminado',
  `fecha_registro_facilitador` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro',
  `fk_id_persona_3` int(11) NOT NULL
) ENGINE=InnoDB;

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
  `fecha_registro_inscripcion` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora capturada automáticamente por el sistema',
  `hora_cancelada` datetime DEFAULT NULL COMMENT 'Hora en que se cancela la inscripción (puede no ser cancelado)',
  `costo_de_inscripcion` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero a pagar por las instancias inscritas',
  `activa` tinyint(1) DEFAULT '1' COMMENT 'Estado de la inscripción, usado para "desactivar el registro". 1 = Activo, 0 = Inactivo'
) ENGINE=InnoDB;


-- --------------------------------------------------------

--
-- Table structure for table `inscripcion_instancia`
--

CREATE TABLE `inscripcion_instancia` (
  `id_inscripcion_instancia` int(11) NOT NULL,
  `fk_id_inscripcion_1` int(11) DEFAULT NULL,
  `fk_id_instancia_1` int(11) DEFAULT NULL
) ENGINE=InnoDB;

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
  `id` int(11) NOT NULL,
  `serial` varchar(15) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_facilitador` int(11) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `id_locacion` int(11) DEFAULT NULL,
  `id_turno` int(11) NOT NULL COMMENT 'Referencia a la tabla turno_instancia',
  `cupos` int(4) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL COMMENT 'Precio a pagar para la inscripción',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Determina el estado de la instancia. 1 = Activa, 2 = Desactivada',
  `descripcion` varchar(256) DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente la instancia',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id_locacion` int(11) NOT NULL,
  `nombre_locacion` varchar(85) NOT NULL COMMENT 'Nombre para mostrar en la interfáz de usuario',
  `direccion_locacion` varchar(355) NOT NULL COMMENT 'Ubicación de la locación',
  `estado_locacion` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Para desactivar locación, el valor: 0. Para activar locación, el valor: 1',
  `fecha_creacion_locacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

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
  `id` int(11) NOT NULL COMMENT 'ID de la tabla',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del menú',
  `enlace` varchar(250) NOT NULL COMMENT 'Controlador al que se relaciona este menú'
) ENGINE=InnoDB;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `enlace`) VALUES
(1, 'Inicio', 'dashboard'),
(2, 'Cursos', 'gestion/curso'),
(3, 'Usuarios', 'administrador/usuario'),
(4, 'Permisos', 'administrador/permisos'),
(5, 'Personas', 'gestion/persona');

-- --------------------------------------------------------

--
-- Table structure for table `fecha_registro_inscripcion`
--

CREATE TABLE `fecha_registro_inscripcion` (
  `id_fecha_registro_inscripcion` int(11) NOT NULL COMMENT 'ID de la tabla',
  `nombre_fecha_registro_inscripcion` varchar(13) NOT NULL COMMENT 'fecha_registro_inscripciones del año'
) ENGINE=InnoDB;

--
-- Dumping data for table `fecha_registro_inscripcion`
--

INSERT INTO `fecha_registro_inscripcion` (`id_fecha_registro_inscripcion`, `nombre_fecha_registro_inscripcion`) VALUES
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
  `nombre_nivel_academico` varchar(35) NOT NULL COMMENT 'Nombre del nivel académico del participante',
  `estado_nivel_academico` int(11) NOT NULL DEFAULT '1' COMMENT 'Determina si un nivel está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro_nivel_academico` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion_nivel_academico` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

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
  `numero_transferencia` varchar(45) DEFAULT NULL,
  `monto_operacion` decimal(10,2) DEFAULT NULL,
  `fecha_operacion` date NOT NULL,
  `fecha_registro_operacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura hora de registro de la operación',
  `estado_pago` int(11) NOT NULL DEFAULT '1' COMMENT 'Registra si un pago ha sido utilizado o desactivado: 0 =  Desactivado, 1 = Nuevo, 2 = Utilizado'
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `fk_id_persona_2` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `estado_participante` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_participante` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_nivel_academico` int(11) DEFAULT NULL
) ENGINE=InnoDB;

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
  `fecha_inicio_periodo` date NOT NULL,
  `fecha_culminacion_periodo` date NOT NULL,
  `estado_periodo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_registro_periodo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion_periodo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Dumping data for table `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `fecha_registro_inscripcion_inicio_periodo`, `fecha_registro_inscripcion_cierre_periodo`, `fecha_inicio_periodo`, `fecha_culminacion_periodo`, `estado_periodo`, `fecha_creacion`, `fecha_modificacion`) VALUES
(2, '2020-01-13', '2020-05-15', 1, '2019-11-15 17:01:36', '2020-01-01 15:14:13'),
(3,'2019-09-10', '2019-12-14', 1, '2019-11-17 17:43:41', '2020-01-01 16:23:03'),
(4, '2019-12-26', '2019-12-31', 0, '2020-01-03 00:00:00', '2020-01-03 21:30:58'),
(5, '2020-06-17', '2020-08-29', 1, '2020-01-06 14:33:04', '2020-01-06 14:33:04');

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
) ENGINE=InnoDB;

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
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombres` varchar(95) DEFAULT NULL,
  `apellidos` varchar(95) DEFAULT NULL,
  `genero` varchar(9) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  email VARCHAR(50) DEFAULT NULL,
  `direccion` varchar(95) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT 'Determina si una persona está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `cedula`, `nombres`, `apellidos`, `genero`, `fecha_nacimiento`, `telefono`, `direccion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
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
  `id` int(11) NOT NULL COMMENT 'ID único del registro',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre del rol (Los principales son: superadmin, estándar)',
  `descripcion` varchar(256) DEFAULT NULL COMMENT 'Descripción de la funcionalidad de cada rol'
) ENGINE=InnoDB;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Superadmin', 'con todos los permisos en el sistema'),
(2, 'Admin', 'permisos parciales en el sistema'),
(3, 'Usuario', 'puede realizar ciertas operaciones en el sistema');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_de_accion`
--

CREATE TABLE `tipo_de_accion` (
  `id` TINYINT NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `tipo_notificacion` varchar(30) NOT NULL COMMENT 'Será utilizado para generar determinado tipo de alerta en la interfáz de usuario',
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fecha_creacion` tifecha_registro_inscripciontamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` tifecha_registro_inscripciontamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Dumping data for table `tipo_de_accion`
--

INSERT INTO `tipo_de_accion` (`id_tipo_accion`, `nombre_tipo_accion`, `alerta`, `estado_tipoaccion`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'ELIMINAR', 'alert-danger', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(2, 'INSERTAR', 'alert-success', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(3, 'MODIFICAR', 'alert-info', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `id` int(11) NOT NULL COMMENT 'ID de la operación',
  `tipo` varchar(35) NOT NULL
) ENGINE=InnoDB;

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
  `id_titular` int(11) NOT NULL,
  `fk_id_persona_1` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `estado_titular` int(11) NOT NULL DEFAULT '1',
  `fecha_registro_titular` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fk_rol_id_1` int(11) DEFAULT NULL,
  `estado` TINYINT DEFAULT '1',
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB;

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
-- Indexes for table `fecha_registro_inscripcion`
--
ALTER TABLE `fecha_registro_inscripcion`
  ADD PRIMARY KEY (`id_fecha_registro_inscripcion`);

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
  ADD KEY `fecha_registro_inscripcion_inicio` (`fecha_registro_inscripcion_inicio_periodo`),
  ADD KEY `fecha_registro_inscripcion_cierre` (`fecha_registro_inscripcion_cierre_periodo`);

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
-- AUTO_INCREMENT for table `fecha_registro_inscripcion`
--
ALTER TABLE `fecha_registro_inscripcion`
  MODIFY `id_fecha_registro_inscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la tabla', AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `fecha_registro_inscripcion_cierre` FOREIGN KEY (`fecha_registro_inscripcion_cierre_periodo`) REFERENCES `fecha_registro_inscripcion` (`id_fecha_registro_inscripcion`),
  ADD CONSTRAINT `fecha_registro_inscripcion_inicio` FOREIGN KEY (`fecha_registro_inscripcion_inicio_periodo`) REFERENCES `fecha_registro_inscripcion` (`id_fecha_registro_inscripcion`);

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
