
CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL PRIMARY KEY,
  `nombre` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `descripcion` varchar(256) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `rol` (`rol_id`, `nombre`, `descripcion`) VALUES
(1, 'superadmin', 'con todos los permisos en el sistema'),
(2, 'admin', 'permisos parciales en el sistema'),
(3, 'usuario', 'puede realizar ciertas operaciones en el sistema');


CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL PRIMARY KEY,
  `nombres_usuario` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `apellidos_usuario` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `email_usuario` varchar(100) UNIQUE KEY COLLATE latin1_general_ci DEFAULT NULL,
  `username_usuario` varchar(45) UNIQUE KEY COLLATE latin1_general_ci DEFAULT NULL,
  `password_usuario` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `fk_rol_id_1` int(11) DEFAULT NULL,
  `estado_usuario` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  FOREIGN KEY(`fk_rol_id_1`) REFERENCES rol(`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres_usuario`, `apellidos_usuario`, `email_usuario`, `username_usuario`, `password_usuario`, `fk_rol_id_1`, `estado_usuario`) VALUES
(0, 'Johan', 'Basil', 'johan@cecal.com', 'johan-1213', '98ce34038035debf9af5d5482829aeddfb543f7e', 1, 'activo');


--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id_participante` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cedula_participante` int(11) NOT NULL,
  `nombres_participante` varchar(95) COLLATE latin1_general_ci NOT NULL,
  `apellidos_participante` varchar(95) COLLATE latin1_general_ci NOT NULL,
  `fecha_nacimiento_participante` date NOT NULL,
  `genero_participante` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono_participante` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `direccion_participante` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `estado_participante` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- ------------------------
-- Tabla participante podría ser reemplazada con  `cliente`
-- ------------------------
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `serial_participante` VARCHAR(25),
  `cedula_cliente` int(11) NOT NULL,
  `nombres_cliente` varchar(95),
  `apellidos_cliente` varchar(95),
  `fecha_nacimiento_cliente` date,
  `genero_cliente` varchar(9),
  `telefono_cliente` varchar(45),
  `direccion_cliente` varchar(45),
  `estado_cliente` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB;


--
-- Tabla curso
-- 
CREATE TABLE `curso` (
  `id_curso` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre_curso` varchar(45) NOT NULL,
  `estado_curso` int(1) NOT NULL DEFAULT '1',
  `descripcion_curso` varchar(256) DEFAULT NULL
) ENGINE=InnoDB;


CREATE TABLE `facilitador` (
  `id_facilitador` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cedula_facilitador` varchar(45)  NOT NULL,
  `nombre_facilitador` varchar(45)  NOT NULL,
  `apellido_facilitador` varchar(45)  NOT NULL,
  `genero_facilitador` varchar(45)  DEFAULT NULL,
  `telefono_1_facilitador` varchar(45)  DEFAULT NULL,
  `telefono_2_facilitador` varchar(45)  DEFAULT NULL,
  `direccion_facilitador` varchar(355)  DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mes_inicio_periodo` int(11) NOT NULL,
  `mes_cierre_periodo` int(11) NULL,
  `year_periodo` int(11) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `locacion` (
  `id_locacion` int(11) NOT NULL NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre_locacion` varchar(85) NOT NULL,
  `direccion_locacion` varchar(355) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `curso`(`id_curso`, `nombre_curso`, `estado_curso`, `descripcion_curso`) VALUES (1, 'Informática', 1, 'Para los amantes de la informática');
INSERT INTO `curso`(`id_curso`, `nombre_curso`, `estado_curso`, `descripcion_curso`) VALUES (2, 'Cocina', 1, 'Para los amantes de la cocina');

INSERT INTO `periodo` (`id_periodo`, `mes_inicio_periodo`, `mes_cierre_periodo`, `year_periodo`) VALUES
(1, 9, 12, 2019);

INSERT INTO `facilitador` (`id_facilitador`, `cedula_facilitador`, `nombre_facilitador`, `apellido_facilitador`, `genero_facilitador`, `telefono_1_facilitador`, `telefono_2_facilitador`, `direccion_facilitador`) VALUES
(1, '22574648', 'Ricardo Luis', 'Chaurant', 'masculino', '04248900840', '02834002094', 'Calle Anzoátegui, casa 64');

INSERT INTO `locacion` (`id_locacion`, `nombre_locacion`, `direccion_locacion`) VALUES
(1, 'CNP', '8va carrera sur detrás del colegio Carnevali.');

CREATE TABLE `instancia` (
  `id_instancia` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fk_id_curso_1` INT NOT NULL,
  `fk_id_facilitador_1` INT NULL,
  `fk_id_periodo_1` INT NULL,
  `fk_id_locacion_1` INT NULL,
  `turno_instancia` VARCHAR(6),
  `cupos_instancia` int(4),
  `precio_instancia` int(15),
  `estado_instancia` int(1) NOT NULL DEFAULT '1',
  `descripcion_instancia` VARCHAR(256)  DEFAULT 'Sin Descripción',
  FOREIGN KEY(`fk_id_curso_1`) REFERENCES curso(`id_curso`),
  FOREIGN KEY(`fk_id_facilitador_1`) REFERENCES facilitador(`id_facilitador`),
  FOREIGN KEY(`fk_id_periodo_1`) REFERENCES periodo(`id_periodo`),
  FOREIGN KEY(`fk_id_locacion_1`) REFERENCES locacion(`id_locacion`)
) ENGINE=InnoDB;

INSERT INTO `instancia`(`id_instancia`, `fk_id_curso_1`, `fk_id_facilitador_1`, `fk_id_periodo_1`, `fk_id_locacion_1`, `turno_instancia`, `cupos_instancia`, `precio_instancia`, `estado_instancia`, `descripcion_instancia`) VALUES (1, 1, 1, 1, 1, 'tarde', 20, 50000, 1, 'abierto ahoraa');



CREATE TABLE `banco_pago` (
    `id_banco_pago` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nombre_banco_pago` varchar(80) NOT NULL,
    `detalles_banco_pago` varchar(260)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `tipo_pago` (
    `id_tipo_pago` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `cantidad_pago` int,
    `nombre_tipo_pago` varchar(25) NOT NULL,
    `detalles_tipo_pago` varchar(260)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- tabla inscripcion
--
CREATE TABLE `estatus` (
  `id_estatus` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre_estatus` VARCHAR(25)
) ENGINE=InnoDB;
INSERT INTO `estatus`(`id_estatus`, `nombre_estatus`) VALUES (1, 'Pago');
INSERT INTO `estatus`(`id_estatus`, `nombre_estatus`) VALUES (2, 'No pago');


CREATE TABLE `inscripcion` (
  `id_inscripcion` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fk_id_participante_1` int NOT NULL,
  `fk_id_estatus_1` int NOT NULL,
  `fk_id_usuario_1` int NULL,
  `fecha_inscripcion` DATE,
  `hora_inscripcion` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `hora_cancelada` DATETIME NULL,
  `monto_pagado` DECIMAL(10,2),
  `precio_total` DECIMAL(10,2),
  `descuento` DECIMAL(10,2),
  `precio_final` DECIMAL(10,2),
  `activa` BOOLEAN DEFAULT 1,
  FOREIGN KEY(`fk_id_participante_1`) REFERENCES cliente(`id_cliente`),
  FOREIGN KEY(`fk_id_estatus_1`) REFERENCES estatus(`id_estatus`),
  FOREIGN KEY(`fk_id_usuario_1`) REFERENCES usuario(`id_usuario`)
) ENGINE=InnoDB;


-- CREATE TABLE `inscripcion` (
--   `id_inscripcion` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   `numero_inscripcion` int(11) NOT NULL,
--   `fk_id_participante_1` int NOT NULL,
--   `referencia_pago` varchar(45) COLLATE latin1_general_ci NOT NULL,
--   `cedula_pago` varchar(45) COLLATE latin1_general_ci NOT NULL,
--   `fecha_registro` date NOT NULL,
--   `monto_pago` int,
--   `fecha_pago` date,
--   `fk_id_banco_pago` int NOT NULL,
--   `fk_id_tipo_pago` int NOT NULL,
--   `fk_id_usuario` int NOT NULL,
--   FOREIGN KEY(`fk_id_usuario`) REFERENCES usuario(`id_usuario`),
--   FOREIGN KEY(`fk_id_participante_1`) REFERENCES participante(`id_participante`),
--   FOREIGN KEY(`fk_id_banco_pago`) REFERENCES banco_pago(`id_banco_pago`),
--   FOREIGN KEY(`fk_id_tipo_pago`) REFERENCES tipo_pago(`id_tipo_pago`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `inscripcion_curso` (
    `id_inscripcion_curso` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `fk_id_inscripcion_1` int(11) NOT NULL,
    `fk_id_curso_1` int(11) NOT NULL,
    FOREIGN KEY(`fk_id_inscripcion_1`) REFERENCES inscripcion(`id_inscripcion`),
    FOREIGN KEY(`fk_id_curso_1`) REFERENCES curso(`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ---------------------------------------
-- --------------- Pago ------------------
-- ---------------------------------------

CREATE TABLE `tipo_de_operacion` ( 
  `id_tipo_de_operacion` INT NOT NULL AUTO_INCREMENT , 
  `tipo_de_operacion` VARCHAR(35) NOT NULL, 
  PRIMARY KEY (`id_tipo_de_operacion`)
  ) ENGINE = InnoDB;

  CREATE TABLE `banco` ( 
  `id_banco` INT NOT NULL AUTO_INCREMENT , 
  `nombre_banco` VARCHAR(255) NOT NULL, 
  PRIMARY KEY (`id_banco`)
  ) ENGINE = InnoDB;

CREATE TABLE `pago_de_inscripcion` ( 
  `id_pago` INT NOT NULL AUTO_INCREMENT  PRIMARY KEY, 
  `fk_id_banco` INT, 
  `fk_id_tipo_operacion` INT NOT NULL, 
  `fk_id_pagador` INT NOT NULL,
  `serial_pago` VARCHAR(255) NOT NULL, 
  `numero_operacion` VARCHAR(255), 
  `monto_operacion` DECIMAL(10,2), 
  `fecha_operacion` DATE NOT NULL,
  FOREIGN KEY(`fk_id_banco`) REFERENCES banco(`id_banco`),
  FOREIGN KEY(`fk_id_tipo_operacion`) REFERENCES tipo_de_operacion(`id_tipo_de_operacion`),
  FOREIGN KEY(`fk_id_pagador`) REFERENCES cliente(`id_cliente`)
  ) ENGINE = InnoDB;


--
-- DATA
-- 

INSERT INTO `tipo_pago`(`id_tipo_pago`, `cantidad_pago`, `nombre_tipo_pago`, `detalles_tipo_pago`) VALUES (1, 1, 'transferencia', 'transferencias bancarias');

INSERT INTO `tipo_pago`(`id_tipo_pago`, `cantidad_pago`, `nombre_tipo_pago`, `detalles_tipo_pago`) VALUES (2, 1, 'efectivo', 'transferencias bancarias');


-- Tipo de operación

INSERT INTO `tipo_de_operacion`(`id_tipo_de_operacion`, `tipo_de_operacion`, `conteo_operaciones`) VALUES (1, 'Transferencia', 0);
INSERT INTO `tipo_de_operacion`(`id_tipo_de_operacion`, `tipo_de_operacion`, `conteo_operaciones`) VALUES (2, 'Efectivo', 0);
INSERT INTO `tipo_de_operacion`(`id_tipo_de_operacion`, `tipo_de_operacion`, `conteo_operaciones`) VALUES (3, 'Exonerado', 0);

-- Cliente
INSERT INTO `cliente`(`serial_participante`, `cedula_cliente`, `nombres_cliente`, `apellidos_cliente`, `fecha_nacimiento_cliente`, `genero_cliente`, `telefono_cliente`, `direccion_cliente`, `estado_cliente`) VALUES ('000001', 22574648, 'Juan Luis', 'Chaurant', '1993-12-13', 'masculino', '04248900840', 'El Tigre, estado Anzoátegui', 1)

-- Banco
INSERT INTO `banco`(`id_banco`, `nombre_banco`, `detalles_banco`) VALUES (1, 'Banco de Venezuela', 'El banco de Venezuela');
INSERT INTO `banco`(`id_banco`, `nombre_banco`, `detalles_banco`) VALUES (2, 'Bancaribe', 'El banco de Venezuela y el Caribe');


-- Interesting queries

select * 
from cliente
where cliente.id_cliente in (
  select inscripcion.fk_id_participante_1 
  from inscripcion 
  where inscripcion.fk_id_participante_1 = 1
)

SELECT i.fk_id_participante_1
FROM inscripcion i
WHERE i.id_inscripcion IN (
  SELECT ic.fk_id_inscripcion_1
  FROM inscripcion_curso ic
  WHERE ic.fk_id_inscripcion_1 = 1
)

-- Selecciona participantes inscritos en una instancia
-- Esta consulta puede ser utilizada para generar la lista de asistencias
SELECT i.fk_id_participante_1, cli.nombres_cliente
FROM inscripcion i
JOIN cliente cli
ON cli.id_cliente = i.fk_id_participante_1
WHERE i.id_inscripcion IN (
  SELECT ic.fk_id_inscripcion_1
  FROM inscripcion_curso ic
  WHERE ic.fk_id_curso_1 IN (
    SELECT c.id_instancia
    FROM instancia c
    WHERE c.id_instancia = 3
  )
)

-- Obtén lista de instancias donde un participante está inscrito
SELECT c.id_instancia
FROM instancia c
WHERE c.id_instancia IN (
  SELECT ic.fk_id_curso_1
  FROM inscripcion_curso ic
  WHERE ic.fk_id_inscripcion_1 IN (
    SELECT i.id_inscripcion
    FROM inscripcion i 
    WHERE i.fk_id_participante_1 IN (
      SELECT cli.id_cliente
      FROM cliente cli
      WHERE cli.id_cliente = 1
    )
  )
)
