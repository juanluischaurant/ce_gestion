-- ========================================================
-- Ususario y Permisos
-- ========================================================
--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del rol (Los principales son: superadmin, estándar)',
  `descripcion` varchar(256) DEFAULT NULL COMMENT 'Descripción de la funcionalidad de cada rol'
) ENGINE=InnoDB;

-- Dumping data for table `rol`

INSERT INTO `rol` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Con todos los permisos en el sistema'),
(2, 'Asistente', 'Puede realizar operaciones relacionadas a la gestión de la organización pero no puede devolver pagos ni cambiar permisos de usuario '),
(3, 'Gestor', 'puede realizar ciertas operaciones en el sistema');

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del menú',
  `enlace` varchar(250) NOT NULL COMMENT 'Controlador al que se relaciona este menú'
) ENGINE=InnoDB;

INSERT INTO `menu` (`id`, `nombre`, `enlace`) VALUES
(1, 'Inicio', 'dashboard'),
(2, 'Especialidades', 'gestion/especialidad'),
(3, 'Usuarios', 'administrador/usuario'),
(4, 'Permisos', 'administrador/permisos'),
(5, 'Personas', 'gestion/persona');

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `id_menu` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `read` TINYINT(1) DEFAULT NULL COMMENT 'lectura',
  `insert` TINYINT(1) DEFAULT NULL COMMENT 'insertar',
  `update` TINYINT(1) DEFAULT NULL COMMENT 'actualizar',
  `delete` TINYINT(1) DEFAULT NULL COMMENT 'borrar'
) ENGINE=InnoDB;

ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `permiso_fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
  
INSERT INTO `permiso` (`id`, `id_menu`, `id_rol`, `read`, `insert`, `update`, `delete`) VALUES
(3, 2, 3, 1, 0, 0, 0),
(4, 2, 1, 1, 1, 1, 1),
(5, 2, 2, 1, 1, 1, 0),
(6, 3, 1, 1, 1, 1, 1),
(7, 4, 1, 1, 1, 1, 1),
(8, 5, 3, 1, 0, 0, 0),
(9, 5, 1, 1, 1, 1, 1);

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL COMMENT 'ID único del registro',
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `estado` TINYINT DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB;

ALTER TABLE `usuario`
  ADD UNIQUE KEY `usuario_unique_username` (`username`),
  ADD UNIQUE KEY `usuario_unique_email` (`email`),
  ADD CONSTRAINT `usuario_fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

INSERT INTO `usuario` (`id`, `id_rol`, `nombres`, `apellidos`, `email`, `username`, `password`, `estado`) VALUES
(1, 3,  'Johan', 'Basil', 'johan@cecal.com', 'johan-1213', '98ce34038035debf9af5d5482829aeddfb543f7e', 1),
(5, 1,  'Alicia', 'Zamora', 'alicia@cecal.com', 'alicia-mar', '5e915c3f9376943c76bfdc374ec88b6e9a5c7168', 1);

--
-- Table structure for table `tipo_de_accion`
--

DROP TABLE IF EXISTS `tipo_de_accion`; 
CREATE TABLE `tipo_de_accion` (
  `id` TINYINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `tipo_notificacion` varchar(30) NOT NULL COMMENT 'Será utilizado para generar determinado tipo de alerta en la interfáz de usuario',
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `tipo_de_accion` (`id`, `nombre`, `tipo_notificacion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'ELIMINAR', 'alert-danger', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(2, 'INSERTAR', 'alert-success', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
(3, 'MODIFICAR', 'alert-info', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05');

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
CREATE TABLE `accion` (
  `id` bigint(11) NOT NULL COMMENT 'ID de la tabla',
  `id_usuario` int(11) NOT NULL COMMENT 'Referencia al usuario del sistema que realizó la acción',
  `id_tipo_accion` TINYINT(2) NOT NULL COMMENT 'Referencia al tipo de acción realizada',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción de la acción realizada',
  `tabla_afectada` varchar(20) NOT NULL COMMENT 'Tabla afectada por la operación',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura automáticamente la hora de creación del registro'
) ENGINE=InnoDB;

ALTER TABLE `accion`
  ADD CONSTRAINT `accion_fk_tipo_accion` FOREIGN KEY (`id_tipo_accion`) REFERENCES `tipo_de_accion` (`id`),
  ADD CONSTRAINT `accion_fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
   

-- ========================================================
-- FIN DE Ususario y Permisos
-- ========================================================

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cedula` int(11) NOT NULL,
  `nombres` varchar(95) DEFAULT NULL,
  `apellidos` varchar(95) DEFAULT NULL,
  `genero` varchar(9) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo_electronico` VARCHAR(50) DEFAULT NULL,
  `direccion` varchar(155) DEFAULT NULL,
  `estado` TINYINT NOT NULL DEFAULT '1' COMMENT 'Determina si una persona está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


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

--
-- Table structure for table `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(35) NOT NULL COMMENT 'Nombre del nivel académico del participante',
  `estado` TINYINT NOT NULL DEFAULT '1' COMMENT 'Determina si un nivel está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `nivel_academico` (`id`, `nombre`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'Bachillerato', 1, '2020-01-08 10:17:34', '2020-01-08 14:09:56'),
(2, 'Diversificado', 1, '2020-01-08 10:16:49', '2020-01-08 14:09:53'),
(3, 'Otro', 1, '2020-01-08 10:18:01', '2020-01-08 10:18:01');

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL COMMENT 'Referencia a la tabla Persona',
  `id_nivel_academico` INT NOT NULL COMMENT 'Referente al nivel academico del participante',
  `estado` TINYINT NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `participante`
  ADD UNIQUE KEY `participante_unique_id_persona` (`id_persona`),
  ADD CONSTRAINT `participante_fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `participante_fk_nivel_academico` FOREIGN KEY (`id_nivel_academico`) REFERENCES `nivel_academico` (`id`);

--
-- Table structure for table `titular`
--

CREATE TABLE `titular` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL COMMENT 'Referencia a la tabla Persona',
  `estado` TINYINT NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `titular`
  ADD UNIQUE KEY `titular_unique_id_persona` (`id_persona`),
  ADD CONSTRAINT `titular_fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

-- ========================================================
-- FIN DE Persona
-- ========================================================



-- =========================================
-- Tablas asociadas a Instancia
-- =========================================
-- 
-- Table structure for table `especialidad`
--

CREATE TABLE `especialidad` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `estado` TINYINT NOT NULL DEFAULT '1',
  `descripcion` varchar(256) DEFAULT 'Sin Descripción',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `especialidad`
  ADD UNIQUE KEY `banco_unique_nombre` (`nombre`);

INSERT INTO `especialidad` (`id`, `nombre`, `estado`, `descripcion`, `fecha_registro`) VALUES
(1, 'Informática', 1, 'Dirigído a estudiantes de informática', '2019-12-22 09:00:00'),
(2, 'Reparación de Computadoras', 1, 'Enfoque en reparaciónes de Hardware', '2019-12-22 17:09:44'),
(3, 'Corte y Costura', 1, 'Para quienes fabrican ropa', '2019-12-22 17:15:44'),
(4, 'Refrigeración', 1, 'Especialidad dedicada a la reparación de equipos', '2019-12-22 17:48:44');

--
-- Table structure for table `facilitador`
--

CREATE TABLE `facilitador` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_persona` INT NOT NULL,
  `estado` TINYINT NOT NULL DEFAULT '1' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, Inactivo = Eliminado',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro'
) ENGINE=InnoDB;

ALTER TABLE `facilitador`
  ADD UNIQUE KEY `facilitador_unique_id_persona` (`id_persona`),
  ADD CONSTRAINT `facilitador_fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(85) NOT NULL COMMENT 'Nombre para mostrar en la interfáz de usuario',
  `direccion` varchar(355) NOT NULL COMMENT 'Ubicación de la locación',
  `estado` TINYINT NOT NULL DEFAULT '1' COMMENT 'Para desactivar locación, el valor: 0. Para activar locación, el valor: 1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
ALTER TABLE `locacion`
  ADD UNIQUE KEY `locacion_unique_nombre` (`nombre`);

INSERT INTO `locacion` (`id`, `nombre`, `direccion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(1, 'Casa del Periodista', 'Detrás del Liceo Alberto Carnevali', 1, '2019-11-17 16:26:58', '2020-01-06 00:55:48'),
(2, 'Sede IRFA', '8va carrera sur', 1, '2019-11-17 16:26:58', '2020-01-04 14:37:47'),
(5, 'NAF El Tigrito', 'Al lado de la cancha, San José de Guanipa', 1, '2020-01-06 14:37:57', '2020-01-06 14:37:57');

--
-- Período
--
CREATE TABLE `periodo` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` DATE NOT NULL,
  `estado` tinyint NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `periodo` (`id`, `fecha_inicio`, `fecha_culminacion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
(2, '2020-01-13', '2020-05-15', 1, '2019-11-15 17:01:36', '2020-01-01 15:14:13'),
(3,'2019-09-10', '2019-12-14', 1, '2019-11-17 17:43:41', '2020-01-01 16:23:03'),
(4, '2019-12-26', '2019-12-31', 0, '2020-01-03 00:00:00', '2020-01-03 21:30:58'),
(5, '2020-06-17', '2020-08-29', 1, '2020-01-06 14:33:04', '2020-01-06 14:33:04');

--
-- Turno
--
CREATE TABLE `turno` (
  `id` int(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT COMMENT 'Referencia a la tabla Participante',
  `nombre` varchar(6) NOT NULL COMMENT 'Almacena los turnos en los que la institución oferta sus cursos'
) ENGINE=InnoDB;

INSERT INTO `turno`(`id`, `nombre`) VALUES (1, 'Mañana'),(2, 'Tarde');

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `serial` varchar(15) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `id_facilitador` int(11) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `id_locacion` int(11) DEFAULT NULL,
  `id_turno` int(11) NOT NULL COMMENT 'Referencia a la tabla turno',
  `cupos` int(4) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL COMMENT 'Precio a pagar para la inscripción',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Determina el estado de el curso. 1 = Activa, 2 = Desactivada',
  `descripcion` varchar(256) DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente el curso',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB;

ALTER TABLE `curso`
  ADD CONSTRAINT `curso_fk_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id`),
  ADD CONSTRAINT `curso_fk_facilitador` FOREIGN KEY (`id_facilitador`) REFERENCES `facilitador` (`id`),
  ADD CONSTRAINT `curso_fk_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id`),
  ADD CONSTRAINT `curso_fk_locacion` FOREIGN KEY (`id_locacion`) REFERENCES `locacion` (`id`),
  ADD CONSTRAINT `curso_fk_turno` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id`);


-- ==================================================
-- ==================================================
-- Inscripción
-- ==================================================
-- ==================================================

--
-- Table structure for table `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la entidad, autogenerado',
  `id_participante` int(11) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero a pagar por los cursos inscritos',
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora capturada automáticamente por el sistema',
  `fecha_modificacion` datetime DEFAULT NULL COMMENT 'Hora en que se modifica la inscripción',
  `estado` tinyint(1) DEFAULT '1' COMMENT 'Estado de la inscripción, usado para "desactivar el registro". 1 = Activo, 0 = Inactivo'
) ENGINE=InnoDB;

ALTER TABLE `inscripcion`
  ADD CONSTRAINT `curso_fk_participante` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`);


-- ============================================
-- Table structure for table `banco`
-- ============================================

CREATE TABLE `banco` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID del banco de operación',
  `nombre` varchar(55) NOT NULL COMMENT 'Nombre del banco',
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `banco`
  ADD UNIQUE KEY `banco_unique_nombre` (`nombre`);

INSERT INTO `banco` (`id`, `nombre`) VALUES
(1, 'Banco de Venezuela'),
(2, 'Bancaribe'),
(3, 'Mercantil'),
(4, 'Sin Banco');

--
-- Table structure for table `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `id` int(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la operación',
  `tipo` varchar(35) NOT NULL COMMENT 'Describe el tipo de operación'
) ENGINE=InnoDB;

INSERT INTO `tipo_de_operacion` (`id`, `tipo`) VALUES
(1, 'Transferencia'),
(2, 'Efectivo'),
(3, 'Exonerado');

--
-- Table structure for table `pago_de_inscripcion`
--

CREATE TABLE `pago_de_inscripcion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_titular` int(11) NOT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
  `id_banco` int(11) DEFAULT NULL,
  `id_tipo_de_operacion` int(11) NOT NULL,
  `numero_transferencia` varchar(45) DEFAULT NULL,
  `monto_operacion` decimal(10,2) DEFAULT NULL,
  `fecha_operacion` date NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura hora de registro de la operación',
  `fecha_modificacion` datetime DEFAULT NULL COMMENT 'Hora en que se modifica el registro',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT 'Registra si un pago ha sido utilizado o desactivado: 0 =  Desactivado, 1 = Nuevo, 2 = Utilizado'
) ENGINE=InnoDB;

ALTER TABLE `pago_de_inscripcion`
  ADD CONSTRAINT `pago_de_inscripcion_fk_titular` FOREIGN KEY (`id_titular`) REFERENCES `titular` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_tipo_de_operacion` FOREIGN KEY (`id_tipo_de_operacion`) REFERENCES `tipo_de_operacion` (`id`);

--
-- Table structure for table `ocupa`
--

CREATE TABLE `ocupa` (
  `id` int(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  `id_inscripcion` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB;

ALTER TABLE `ocupa`
  ADD CONSTRAINT `ocupa_fk_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion` (`id`),
  ADD CONSTRAINT `ocupa_fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`);
  

