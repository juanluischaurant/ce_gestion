-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2019 at 02:27 AM
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
-- Table structure for table `banco`
--

CREATE TABLE `banco` (
  `id_banco` int(11) NOT NULL COMMENT 'ID del banco de operación',
  `nombre_banco` varchar(255) COLLATE latin1_general_ci NOT NULL COMMENT 'Nombre del banco',
  `detalles_banco` varchar(255) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Descripción del banco'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `fk_id_persona_1` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `serial_cliente` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `genero_cliente` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_cliente` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `estatus`
--

CREATE TABLE `estatus` (
  `id_estatus` int(11) NOT NULL,
  `nombre_estatus` varchar(25) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilitador`
--

CREATE TABLE `facilitador` (
  `id_facilitador` int(11) NOT NULL,
  `estado_facilitador` varchar(9) COLLATE latin1_general_ci NOT NULL DEFAULT 'Activo' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, 0 = Eliminado',
  `fecha_registro_facilitador` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro',
  `fk_id_persona_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion_curso`
--

CREATE TABLE `inscripcion_curso` (
  `id_inscripcion_curso` int(11) NOT NULL,
  `fk_id_inscripcion_1` int(11) DEFAULT NULL,
  `fk_id_curso_1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id_locacion` int(11) NOT NULL,
  `nombre_locacion` varchar(85) COLLATE latin1_general_ci NOT NULL,
  `direccion_locacion` varchar(355) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int(11) NOT NULL,
  `fk_id_persona_2` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `serial_participante` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_participante` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  `estado_persona` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  ADD KEY `pago_de_inscripcion_ibfk_1` (`fk_id_banco`),
  ADD KEY `pago_de_inscripcion_ibfk_2` (`fk_id_tipo_operacion`),
  ADD KEY `FK_PAGO_INSCRIPCION_1` (`fk_id_cliente`);

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
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del banco de operación';

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id_estatus` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilitador`
--
ALTER TABLE `facilitador`
  MODIFY `id_facilitador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instancia`
--
ALTER TABLE `instancia`
  MODIFY `id_instancia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locacion`
--
ALTER TABLE `locacion`
  MODIFY `id_locacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `persona_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_de_operacion`
--
ALTER TABLE `tipo_de_operacion`
  MODIFY `id_tipo_de_operacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `instancia_ibfk_4` FOREIGN KEY (`fk_id_locacion_1`) REFERENCES `locacion` (`id_locacion`);

--
-- Constraints for table `pago_de_inscripcion`
--
ALTER TABLE `pago_de_inscripcion`
  ADD CONSTRAINT `FK_PAGO_INSCRIPCION_1` FOREIGN KEY (`fk_id_cliente`) REFERENCES `cliente` (`id_cliente`),
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
