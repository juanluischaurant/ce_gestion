
--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `cedula` INT(8) NOT NULL PRIMARY KEY,
  `nombres` varchar(95) DEFAULT NULL,
  `apellidos` varchar(95) DEFAULT NULL,
  `genero` varchar(9) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo_electronico` VARCHAR(50) DEFAULT NULL,
  `direccion` varchar(155) DEFAULT NULL,
  `estado` INT(1) NOT NULL DEFAULT '1' COMMENT 'Determina si una persona está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


INSERT INTO `persona` (`cedula`, `nombres`, `apellidos`, `genero`, `fecha_nacimiento`, `telefono`, `correo_electronico`, `direccion`, `estado`) VALUES
(22574648, 'Juan Luis', 'Chaurant Zamora', '1', '1993-12-13', '04248900840', 'alguien@servidor.com', 'El Tigre, edo. Anzoátegui', 1),
(8965910, 'Alicia', 'Zamora', '2', '1967-03-03', '04242929292', 'alguien@servidor.com', 'EL Tigre, Chaguaramos', 1),
(9458635, 'Edgardo', 'Saá', '1', '1969-09-04', '04249485560', 'alguien@servidor.com', 'Av. La Paz, urb. Chimire.', 1),
(7294645, 'Marco', 'Aurelio', '1', '1965-09-25', '04149675848', 'alguien@servidor.com', 'El Tigrito, Campo Norte', 1),
(4965328, 'Johan', 'Bach', '1', '1960-10-13', '04165843323', 'alguien@servidor.com', 'El Tigrito, Campo Norte, casa #230', 1),
(25468978, 'Asena', 'Vural', '2', '1999-11-20', '04245694548', 'alguien@servidor.com', 'Av. Franca, El Tigre', 1),
(27865343, 'José', 'Lopez', '1', '2000-10-20', '04167843304', 'alguien@servidor.com', 'El Tigre, antes del estadio', 1),
(23254648, 'Felipe', 'Rondón', '1', '1999-09-23', '04245643943', 'alguien@servidor.com', 'El Tigre, estado Anzoátegui', 1),
(12438628, 'Yulimar Celidett', 'Fajardo Rojas', '2', '1975-10-20', 'alguien@servidor.com', '04247684312', 'El Tigre, detrás de Campo Oficina', 1),
(25678432, 'Joselyn', 'Marín', '2', '1996-10-13', '04267242295', 'alguien@servidor.com', 'Av. Carabobo, cruce con calle 10', 1),
(12275704, 'José', 'Astudillo', '1', '1975-11-03', '04248965754', 'alguien@servidor.com', 'El Tigrito, Chimire', 1),
(8477818, 'Felix', 'Blackman', '1', '1965-05-27', '04248113920', 'alguien@servidor.com', 'El Tigre, detrás de La Cascada', 1),
(25568648, 'Mario', 'Bustamante', '1', '1997-12-04', '04245645456', 'alguien@servidor.com', 'El Tigre, estado Anzoátegui', 1),
(2582893, 'Esteban de Jesus', 'Chaurant Zamora', '1', '1995-12-26', '04141929294', 'alguien@servidor.com', 'Aveneda 2 Casa N° 118 Sector Cincuentenario ', 1),
(27546895, 'Yorman', 'Pérez', '1', '2019-11-06', '', 'alguien@servidor.com', '', 0),
(23857463, 'Katty', 'Otero', '2', '1995-12-14', '04142354465', 'alguien@servidor.com', 'Urb. Los Naranjos, calle 5', 1),
(25657342, 'Fernando', 'La Rosa', '1', '1994-12-09', '04167922205', 'alguien@servidor.com', 'La California, el Tigrito', 1),
(8477827, 'Gregorio', 'Velásquez', '1', '1964-06-27', '02834002095', 'alguien@servidor.com', 'El Tigre, Chaguaramos', 1),
(8466825, 'Manuel Alejandro', 'Contreras', '1', '1964-10-06', '04243254403', 'alguien@servidor.com', 'El Tigre, carretera negra', 1),
(10939925, 'Freddy', 'Miranda', '1', '0000-00-00', '', 'alguien@servidor.com', '', 1),
(27380945, 'Samuel Andrés', 'Requena Abache', '1', '1999-11-21', '04248812413', 'alguien@servidor.com', 'Urb. Virgen del Valle c/ Santa Rosa P130', 1),
(23454648, 'Daniel Fernando', 'Fernández', '1', '1994-12-14', '04243211514', 'alguien@servidor.com', 'Calle 10, sector Morichal. Casa #14', 1),
(8456789, 'Carmen', 'Martínez', '2', '1965-11-25', '04162839768', 'alguien@servidor.com', '17 de diciembre, calle 25', 1),
(29176244, 'Felipe', 'Gómez', '1', '2000-12-25', '04243445699', 'alguien@servidor.com', 'El Tigre, pueblo nuevo', 1),
(24688325, 'Edgar', 'Pacheco', '1', '1999-11-24', '04243251215', 'alguien@servidor.com', 'Urb. Los Naranjos, calle 5', 1),
(30254533, 'Ariana', 'Díaz', '2', '1999-01-13', '04243253324', 'alguien@servidor.com', 'Casco Viejo, cassa #125', 1),
(24322878, 'Jesús', 'Alcantara', '1', '1999-12-24', '04243254499', 'alguien@servidor.com', 'Av. Libertador, cruce con calle 12 ', 1),
(10935423, 'Luis', 'Amaya', '1', '1969-09-09', '04262286355', 'amayale69@gmail.com', 'Calle 26 Norte, Quinta EILIS, El Tigre', 1),
(12504138, 'Alfredo', 'Bizcochea', '1', '1976-06-28', '04248070018', 'alguien@servidor.com', 'Calle Independencia, #16, 17 de Diciembre', 1);


-- ========================================================
-- Ususario y Permisos
-- ========================================================
--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` int(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `funcion` varchar(45) NOT NULL COMMENT 'Nombre del rol (Administrador, Gestor y Asesor)',
  `descripcion` varchar(256) DEFAULT NULL COMMENT 'Descripción de la funcionalidad de cada rol'
) ENGINE=InnoDB;

-- Dumping data for table `rol`

INSERT INTO `rol` (`funcion`, `descripcion`) VALUES
('Administrador', 'Con todos los permisos en el sistema'),
('Asistente', 'Puede realizar operaciones relacionadas a la gestión de la organización pero no puede devolver pagos ni cambiar permisos de usuario '),
('Gestor', 'puede realizar ciertas operaciones en el sistema');

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del menú',
  `enlace` varchar(250) NOT NULL COMMENT 'Controlador al que se relaciona este menú'
) ENGINE=InnoDB;

INSERT INTO `menu` (`nombre`, `enlace`) VALUES
('Inicio', 'dashboard'),
('Especialidades', 'gestion/especialidad'),
('Usuarios', 'administrador/usuario'),
('Permisos', 'administrador/permisos'),
('Personas', 'gestion/persona');

--
-- Table structure for table `permiso`
--

CREATE TABLE `permiso` (
  `id` int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `id_menu` int(2) DEFAULT NULL,
  `id_rol` int(2) DEFAULT NULL,
  `read` INT(1) DEFAULT NULL COMMENT 'lectura',
  `insert` INT(1) DEFAULT NULL COMMENT 'insertar',
  `update` INT(1) DEFAULT NULL COMMENT 'actualizar',
  `delete` INT(1) DEFAULT NULL COMMENT 'borrar'
) ENGINE=InnoDB;

ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `permiso_fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
  
INSERT INTO `permiso` (`id_menu`, `id_rol`, `read`, `insert`, `update`, `delete`) VALUES
(2, 3, 1, 0, 0, 0),
(2, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 0),
(3, 1, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(5, 3, 1, 0, 0, 0),
(5, 1, 1, 1, 1, 1);

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(10) NOT NULL PRIMARY KEY,
  `password` varchar(150) NOT NULL,
  `cedula_persona` int(8) NOT NULL,
  `id_rol` int(2) NOT NULL COMMENT 'Rol del ususario',
  `estado` INT(1) DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB;

ALTER TABLE `usuario`
  ADD UNIQUE KEY `usuario_unique_username` (`username`),
  ADD CONSTRAINT `usuario_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`),
  ADD CONSTRAINT `usuario_fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

INSERT INTO `usuario` (`username`, `password`, `cedula_persona`, `id_rol`, `estado`) VALUES
('admin', '98ce34038035debf9af5d5482829aeddfb543f7e', 22574648, 1, 1),
('gestor', '98ce34038035debf9af5d5482829aeddfb543f7e', 8965910, 3, 1),
('asistente', '98ce34038035debf9af5d5482829aeddfb543f7e', 9458635, 2, 1),
('johan-1213', '98ce34038035debf9af5d5482829aeddfb543f7e', 4965328, 1, 1), 
('amayale', '5d1705794b848e420a6c9755df70e3d82a189108', 10935423,  1, 1);


--
-- Table structure for table `tipo_de_accion`
--

DROP TABLE IF EXISTS `tipo_de_accion`; 
CREATE TABLE `tipo_de_accion` (
  `id` INT(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `tipo_notificacion` varchar(30) NOT NULL COMMENT 'Será utilizado para generar determinado tipo de alerta en la interfáz de usuario',
  `estado` INT(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `tipo_de_accion` (`nombre`, `tipo_notificacion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
('ELIMINAR', 'alert-danger', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
('INSERTAR', 'alert-success', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05'),
('MODIFICAR', 'alert-info', 1, '2018-11-11 06:29:06', '2019-11-12 23:15:05');

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
CREATE TABLE `accion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `username` varchar(10) NOT NULL COMMENT 'Referencia al usuario del sistema que realizó la acción',
  `id_tipo_accion` INT(2) NOT NULL COMMENT 'Referencia al tipo de acción realizada',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción de la acción realizada',
  `tabla_afectada` varchar(20) NOT NULL COMMENT 'Tabla afectada por la operación',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura automáticamente la hora de creación del registro'
) ENGINE=InnoDB;

ALTER TABLE `accion`
  ADD CONSTRAINT `accion_fk_tipo_accion` FOREIGN KEY (`id_tipo_accion`) REFERENCES `tipo_de_accion` (`id`),
  ADD CONSTRAINT `accion_fk_usuario` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`);
   

-- ========================================================
-- FIN DE Ususario y Permisos
-- ========================================================

--
-- Table structure for table `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `id` int(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(35) NOT NULL COMMENT 'Nombre del nivel académico del participante',
  `estado` INT(1) NOT NULL DEFAULT '1' COMMENT 'Determina si un nivel está activa dentro del sistema o no (1=activo, 0=inactivo)',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `nivel_academico` (`nombre`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
('Bachillerato', 1, '2020-01-08 10:17:34', '2020-01-08 14:09:56'),
('Diversificado', 1, '2020-01-08 10:16:49', '2020-01-08 14:09:53'),
('Otro', 1, '2020-01-08 10:18:01', '2020-01-08 10:18:01');

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `cedula_persona` int(8) NOT NULL COMMENT 'Referencia a la tabla Persona',
  `id_nivel_academico` INT (1) NOT NULL COMMENT 'Referente al nivel academico del participante',
  `estado` INT(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `participante`
  ADD UNIQUE KEY `participante_unique_cedula` (`cedula_persona`),
  ADD CONSTRAINT `participante_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`),
  ADD CONSTRAINT `participante_fk_nivel_academico` FOREIGN KEY (`id_nivel_academico`) REFERENCES `nivel_academico` (`id`);

--
-- Table structure for table `titular`
--

CREATE TABLE `titular` (
  `cedula_persona` int(8) NOT NULL COMMENT 'Referencia a la tabla Persona',
  `estado` INT(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `titular`
  ADD UNIQUE KEY `titular_unique_cedula` (`cedula_persona`),
  ADD CONSTRAINT `titular_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`);

-- ========================================================
-- FIN DE Persona
-- ========================================================



-- =========================================
-- Tablas asociadas a Cursos
-- =========================================
-- 
-- Table structure for table `nombre_curso`
--

CREATE TABLE `nombre_curso` (
  `id` INT (4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `cantidad_horas` int(4) DEFAULT 0,
  `estado` INT(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `nombre_curso`
  ADD UNIQUE KEY `nombre_curso_unique` (`descripcion`);

INSERT INTO `nombre_curso` (`descripcion`, `cantidad_horas`, `estado`) VALUES
('Informática', 100, 1),
('Reparación de Computadoras', 120, 1),
('Corte y Costura', 120, 1),
('Refrigeración', 150, 1);

--
-- Table structure for table `facilitador`
--

CREATE TABLE `facilitador` (
  `cedula_persona` INT(8) NOT NULL,
  `fecha_contratacion` DATE, 
  `estado` INT(1) NOT NULL DEFAULT '1' COMMENT 'Define si un registro ha sido eliminado o no. 1 = Activo, Inactivo = Eliminado',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registra la fecha exacta en que se creó el registro'
) ENGINE=InnoDB;

ALTER TABLE `facilitador`
  ADD UNIQUE KEY `facilitador_unique_cedula` (`cedula_persona`),
  ADD CONSTRAINT `facilitador_fk_persona` FOREIGN KEY (`cedula_persona`) REFERENCES `persona` (`cedula`);

--
-- Table structure for table `locacion`
--

CREATE TABLE `locacion` (
  `id` int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(85) NOT NULL COMMENT 'Nombre para mostrar en la interfáz de usuario',
  `direccion` varchar(250) NOT NULL COMMENT 'Ubicación de la locación',
  `estado` INT(1) NOT NULL DEFAULT '1' COMMENT 'Para desactivar locación, el valor: 0. Para activar locación, el valor: 1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
ALTER TABLE `locacion`
  ADD UNIQUE KEY `locacion_unique_nombre` (`nombre`);

INSERT INTO `locacion` (`nombre`, `direccion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
('Casa del Periodista', 'Detrás del Liceo Alberto Carnevali', 1, '2019-11-17 16:26:58', '2020-01-06 00:55:48'),
('Sede IRFA', '8va carrera sur', 1, '2019-11-17 16:26:58', '2020-01-04 14:37:47'),
('NAF El Tigrito', 'Al lado de la cancha, San José de Guanipa', 1, '2020-01-06 14:37:57', '2020-01-06 14:37:57');

--
-- Período
--
CREATE TABLE `periodo` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fecha_inicio` date NOT NULL,
  `fecha_culminacion` DATE NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO `periodo` (`fecha_inicio`, `fecha_culminacion`, `estado`, `fecha_registro`, `fecha_modificacion`) VALUES
('2020-01-13', '2020-05-15', 1, '2019-11-15 17:01:36', '2020-01-01 15:14:13'),
('2019-09-10', '2019-12-14', 1, '2019-11-17 17:43:41', '2020-01-01 16:23:03'),
('2019-12-26', '2019-12-31', 0, '2020-01-03 00:00:00', '2020-01-03 21:30:58'),
('2020-06-17', '2020-08-29', 1, '2020-01-06 14:33:04', '2020-01-06 14:33:04');

--
-- Turno
--
CREATE TABLE `turno` (
  `id` int(1) NOT NULL  PRIMARY KEY AUTO_INCREMENT COMMENT 'Referencia a la tabla Participante',
  `nombre` varchar(6) NOT NULL COMMENT 'Almacena los turnos en los que la institución oferta sus cursos'
) ENGINE=InnoDB;

INSERT INTO `turno`(`nombre`) VALUES ('Mañana'), ('Tarde');

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `serial` varchar(15) NOT NULL,
  `id_nombre_curso` int(4) NOT NULL,
  `cedula_facilitador` int(8) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `id_locacion` int(11) DEFAULT NULL,
  `id_turno` int(1) NOT NULL COMMENT 'Referencia a la tabla turno',
  `cupos` int(4) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL COMMENT 'Precio a pagar para la inscripción',
  `estado` int(1) NOT NULL DEFAULT '1' COMMENT 'Determina el estado de el curso. 1 = Activa, 2 = Desactivada',
  `descripcion` varchar(256) DEFAULT 'Sin Descripción' COMMENT 'Describe brevemente el curso',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro',
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del registro'
) ENGINE=InnoDB;

ALTER TABLE `curso`
  ADD CONSTRAINT `curso_fk_nombre_curso` FOREIGN KEY (`id_nombre_curso`) REFERENCES `nombre_curso` (`id`),
  ADD CONSTRAINT `curso_fk_facilitador` FOREIGN KEY (`cedula_facilitador`) REFERENCES `facilitador` (`cedula_persona`),
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
  `cedula_participante` int(8) NOT NULL COMMENT 'Referencia a la tabla Participante',
  `id_curso` int(11) NOT NULL COMMENT 'Referencia a la tabEl cursos',
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'Monto de dinero a pagar por los cursos inscritos',
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha y hora capturada automáticamente por el sistema',
  `fecha_modificacion` datetime DEFAULT NULL COMMENT 'Hora en que se modifica la inscripción',
  `estado` int(1) DEFAULT '1' COMMENT 'Estado de la inscripción, usado para "desactivar el registro". 1 = Activo, 0 = Inactivo'
) ENGINE=InnoDB;

ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_fk_participante` FOREIGN KEY (`cedula_participante`) REFERENCES `participante` (`cedula_persona`),
  ADD CONSTRAINT `inscripcion_fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`);

-- count(participante.id) as cupos_curso_ocupados
-- group by inscripcion.cedula_participante

-- ============================================
-- Table structure for table `banco`
-- ============================================

CREATE TABLE `banco` (
  `id` INT(2) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID del banco de operación',
  `nombre` varchar(55) NOT NULL COMMENT 'Nombre del banco',
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE `banco`
  ADD UNIQUE KEY `banco_unique_nombre` (`nombre`);

INSERT INTO `banco` (`nombre`) VALUES
('Banco de Venezuela'),
('Bancaribe'),
('Mercantil'),
('Otro Banco');

--
-- Table structure for table `tipo_de_operacion`
--

CREATE TABLE `tipo_de_operacion` (
  `id` int(1) NOT NULL  PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la operación',
  `tipo` varchar(35) NOT NULL COMMENT 'Describe el tipo de operación'
) ENGINE=InnoDB;

INSERT INTO `tipo_de_operacion` (`tipo`) VALUES
('Transferencia'),
('Efectivo'),
('Exonerado');

--
-- Table structure for table `pago_de_inscripcion`
--

CREATE TABLE `pago_de_inscripcion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cedula_titular` int(8) NOT NULL,
  `id_banco` int(2) DEFAULT NULL,
  `id_tipo_de_operacion` int(1) NOT NULL,
  `numero_referencia_bancaria` varchar(45) DEFAULT NULL,
  `monto_operacion` decimal(10,2) DEFAULT NULL,
  `fecha_operacion` date NOT NULL,
  `fecha_devolucion` DATE DEFAULT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Captura hora de registro de la operación',
  `fecha_modificacion` datetime DEFAULT NULL COMMENT 'Hora en que se modifica el registro',
  `estatus_pago` int(1) NOT NULL DEFAULT '1' COMMENT 'Registra si un pago ha sido utilizado o desactivado: 0 =  Desactivado, 1 = Nuevo, 2 = Utilizado'
) ENGINE=InnoDB;

ALTER TABLE `pago_de_inscripcion`
  ADD CONSTRAINT `pago_de_inscripcion_fk_titular` FOREIGN KEY (`cedula_titular`) REFERENCES `titular` (`cedula_persona`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`),
  ADD CONSTRAINT `pago_de_inscripcion_fk_tipo_de_operacion` FOREIGN KEY (`id_tipo_de_operacion`) REFERENCES `tipo_de_operacion` (`id`);


-- ********************************* --
-- Creacion de Vistas para Reportes  --
-- ********************************* --


CREATE VIEW vista_cursos_activos AS 
SELECT year(fecha_inicio) AS ano_inicio_periodo, month(fecha_inicio) AS mes_inicio_periodo, 
       nombre_curso.descripcion as nombre_curso, persona.cedula as cedula_facilitador, 
       concat(persona.primer_nombre, ' ',  persona.primer_apellido) as facilitador, 
       locacion.nombre as nombre_locacion, curso.cupos, 
       count(inscripcion.cedula_participante) as cupos_curso_ocupados, curso.estado
FROM periodo 
INNER JOIN curso on curso.id_periodo = periodo.id
INNER JOIN nombre_curso on nombre_curso.id = curso.id_nombre_curso
INNER JOIN inscripcion on inscripcion.id_curso = curso.id
INNER JOIN facilitador on curso.cedula_facilitador = facilitador.cedula_persona
INNER JOIN persona on facilitador.cedula_persona = persona.cedula
INNER JOIN locacion on locacion.id = curso.id_locacion
WHERE curso.estado=1 AND inscripcion.estado=1
GROUP BY inscripcion.cedula_participante



CREATE VIEW vista_est_cursos_anuales AS
SELECT `nombre_curso`, `ano_inicio_periodo`, 
SUM(IF(`mes_inicio_periodo`=1,1,0)) AS ENE,
SUM(IF(`mes_inicio_periodo`=2,1,0)) AS FEB,
SUM(IF(`mes_inicio_periodo`=3,1,0)) AS MAR,
SUM(IF(`mes_inicio_periodo`=4,1,0)) AS ABR,
SUM(IF(`mes_inicio_periodo`=5,1,0)) AS MAY,
SUM(IF(`mes_inicio_periodo`=6,1,0)) AS JUN,
SUM(IF(`mes_inicio_periodo`=7,1,0)) AS JUL,
SUM(IF(`mes_inicio_periodo`=8,1,0)) AS AGO,
SUM(IF(`mes_inicio_periodo`=9,1,0)) AS SEP,
SUM(IF(`mes_inicio_periodo`=10,1,0)) AS OCT,
SUM(IF(`mes_inicio_periodo`=11,1,0)) AS NOV,
SUM(IF(`mes_inicio_periodo`=12,1,0)) AS DIC,
SUM(IF(`mes_inicio_periodo`=1, cupos_curso_ocupados,0)) AS CI_ENE,
SUM(IF(`mes_inicio_periodo`=2, cupos_curso_ocupados,0)) AS CI_FEB,
SUM(IF(`mes_inicio_periodo`=3, cupos_curso_ocupados,0)) AS CI_MAR,
SUM(IF(`mes_inicio_periodo`=4, cupos_curso_ocupados,0)) AS CI_ABR,
SUM(IF(`mes_inicio_periodo`=5, cupos_curso_ocupados,0)) AS CI_MAY,
SUM(IF(`mes_inicio_periodo`=6, cupos_curso_ocupados,0)) AS CI_JUN,
SUM(IF(`mes_inicio_periodo`=7, cupos_curso_ocupados,0)) AS CI_JUL,
SUM(IF(`mes_inicio_periodo`=8, cupos_curso_ocupados,0)) AS CI_AGO,
SUM(IF(`mes_inicio_periodo`=9, cupos_curso_ocupados,0)) AS CI_SEP,
SUM(IF(`mes_inicio_periodo`=10, cupos_curso_ocupados,0)) AS CI_OCT,
SUM(IF(`mes_inicio_periodo`=11, cupos_curso_ocupados,0)) AS CI_NOV,
SUM(IF(`mes_inicio_periodo`=12, cupos_curso_ocupados,0)) AS CI_DIC
FROM `vista_cursos_activos`
GROUP BY `ano_inicio_periodo`, `nombre_curso`;

CREATE VIEW vista_relacion_pagos1 AS 
SELECT year(fecha_inicio) AS ano_inicio_periodo, month(fecha_inicio) AS mes_inicio_periodo, curso.estado, 
       nombre_curso.descripcion as nombre_curso, persona.cedula as ced_alumno, concat(persona.nombres, ' ',  
       persona.apellidos) as participante, locacion.nombre as nombre_locacion, 
       pago_de_inscripcion.cedula_titular,
       pago_de_inscripcion.fecha_operacion, pago_de_inscripcion.monto_operacion
FROM periodo 
INNER JOIN curso on curso.id_periodo = periodo.id
INNER JOIN nombre_curso on nombre_curso.id = curso.id_nombre_curso
INNER JOIN locacion on locacion.id = curso.id_locacion
INNER JOIN inscripcion ON inscripcion.id_curso = curso.id
INNER JOIN pago_de_inscripcion on pago_de_inscripcion.id_inscripcion = inscripcion.id
INNER JOIN participante on participante.cedula_persona = inscripcion.cedula_participante
INNER JOIN persona on participante.cedula_persona = persona.cedula
WHERE curso.estado= 1 AND pago_de_inscripcion.estatus_pago=2;

CREATE VIEW vista_relacion_pagos AS 
SELECT ano_inicio_periodo, mes_inicio_periodo, nombre_curso, ced_alumno, participante, 
       nombre_locacion, persona.cedula as ced_cliente, 
       concat(persona.nombres, ' ', persona.apellidos) as nombre_cliente,
       fecha_operacion,
       monto_operacion
FROM vista_relacion_pagos1 
INNER JOIN titular on titular.cedula_persona = vista_relacion_pagos1.cedula_titular
INNER JOIN persona on persona.cedula = titular.cedula_persona;


CREATE VIEW vista_est_ingresos_cursos_anuales AS
SELECT `nombre_curso`, `ano_inicio_periodo`, 
SUM(IF(`mes_inicio_periodo`=1, monto_operacion,0)) AS ENE,
SUM(IF(`mes_inicio_periodo`=2, monto_operacion,0)) AS FEB,
SUM(IF(`mes_inicio_periodo`=3, monto_operacion,0)) AS MAR,
SUM(IF(`mes_inicio_periodo`=4, monto_operacion,0)) AS ABR,
SUM(IF(`mes_inicio_periodo`=5, monto_operacion,0)) AS MAY,
SUM(IF(`mes_inicio_periodo`=6, monto_operacion,0)) AS JUN,
SUM(IF(`mes_inicio_periodo`=7, monto_operacion,0)) AS JUL,
SUM(IF(`mes_inicio_periodo`=8, monto_operacion,0)) AS AGO,
SUM(IF(`mes_inicio_periodo`=9, monto_operacion,0)) AS SEP,
SUM(IF(`mes_inicio_periodo`=10, monto_operacion,0)) AS OCT,
SUM(IF(`mes_inicio_periodo`=11, monto_operacion,0)) AS NOV,
SUM(IF(`mes_inicio_periodo`=12, monto_operacion,0)) AS DIC
FROM `vista_relacion_pagos`
GROUP BY `ano_inicio_periodo`, `nombre_curso`;

