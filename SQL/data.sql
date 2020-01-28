-- Consulta los cursos en que está inscrito un participante 
SELECT participante.id_participante, persona.nombres_persona, curso.nombre_curso
FROM participante

JOIN persona ON
persona.id_persona = participante.fk_id_persona_2

JOIN inscripcion ON
inscripcion.fk_id_participante_1 = participante.id_participante

JOIN inscripcion_instancia ON
inscripcion_instancia.fk_id_inscripcion_1 = inscripcion.id_inscripcion

JOIN instancia ON 
instancia.id_instancia = inscripcion_instancia.fk_id_instancia_1

JOIN curso ON
curso.id_curso = instancia.fk_id_curso_1

where participante.id_participante = 3



-- Titulares que pagaron en determinado curso
SELECT `curso`.`nombre_curso`, `i`.`fk_id_participante_1`, tt.fk_id_persona_1,  p.nombres_persona 
FROM `instancia` 

JOIN `curso` 
ON `curso`.`id_curso` = `instancia`.`fk_id_curso_1` 

JOIN `periodo` 
ON `periodo`.`id_periodo` = `instancia`.`fk_id_periodo_1` 

JOIN `inscripcion_instancia` as `ii` 
ON `ii`.`fk_id_instancia_1` = `instancia`.`id_instancia` 

JOIN `inscripcion` as `i` 
ON `i`.`id_inscripcion` = `ii`.`fk_id_inscripcion_1` 

JOIN pago_de_inscripcion AS pdi
ON pdi.fk_id_inscripcion = i.id_inscripcion

JOIN titular AS tt
ON tt.id_titular = pdi.fk_id_titular

JOIN persona AS p
ON p.id_persona = tt.fk_id_persona_1

WHERE `instancia`.`id_instancia` = 2

-- Participantes registrados en instancia
SELECT `curso`.`nombre_curso`, `i`.`fk_id_participante_1`, par.fk_id_persona_2,  p.nombres_persona 
FROM `instancia` 

JOIN `curso` 
ON `curso`.`id_curso` = `instancia`.`fk_id_curso_1` 

JOIN `periodo` 
ON `periodo`.`id_periodo` = `instancia`.`fk_id_periodo_1` 

JOIN `inscripcion_instancia` as `ii` 
ON `ii`.`fk_id_instancia_1` = `instancia`.`id_instancia` 

JOIN `inscripcion` as `i` 
ON `i`.`id_inscripcion` = `ii`.`fk_id_inscripcion_1` 

JOIN participante as par
ON par.id_participante = i.fk_id_participante_1

JOIN persona AS p
ON p.id_persona = par.fk_id_persona_2

WHERE `instancia`.`id_instancia` = 2

-- ==============================================================
-- Instancias en las que se ha registrado un participante
SELECT 
cur.nombre_curso, 
par.fk_id_persona_2,
per.nombres_persona
FROM participante AS par

JOIN persona AS per
ON per.id_persona = par.fk_id_persona_2

JOIN inscripcion AS ins
ON ins.fk_id_participante_1 = par.id_participante

-- Esta podría ser útil mas adelante
JOIN pago_de_inscripcion AS pdi
ON pdi.fk_id_inscripcion = ins.id_inscripcion 

JOIN inscripcion_instancia AS ins_inst
ON ins_inst.fk_id_inscripcion_1 = ins.id_inscripcion

JOIN instancia AS inst
ON inst.id_instancia = ins_inst.fk_id_instancia_1

JOIN curso AS cur
ON cur.id_curso = inst.fk_id_curso_1

WHERE par.id_participante = 2
-- Fin de la consulta
-- ==============================================================

-- Tabla mes
CREATE TABLE `mes` (
  `id_mes` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `nombre_mes`VARCHAR(13) NOT NULL COMMENT 'Meses del año' 
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO `mes`(`id_mes`, `nombre_mes`) VALUES (1, 'Enero'),
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
(12, 'Diciembre')


--

-- Usuarios de la base de datos
the_data_architect
car-dark-knight

the_admin_here
car-red-ranger


CREATE TABLE menu(
  `id_menu` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla'
  `nombre_menu` varchar(45) COLLATE latin1_general_ci NOT NULL COMMENT 'Nombre del menú'
  `enlace_menu` varchar(250) COLLATE latin1_general_ci NOT NULL COMMENT 'Controlador al que se relaciona este menú'
)

INSERT INTO `menu`(`nombre_menu`, `enlace_menu`) VALUES ('Usuarios', 'administrador/usuario');
INSERT INTO `menu`(`nombre_menu`, `enlace_menu`) VALUES ('Permisos', 'administrador/permisos')
INSERT INTO `menu`(`nombre_menu`, `enlace_menu`) VALUES ('Personas', 'gestion/persona')


CREATE TABLE permiso(
  `id_permiso` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID de la tabla',
  `fk_id_menu_1` int,
  `fk_id_rol_2` int,
  `read` int(11) NULL COMMENT 'lectura',
  `insert` int(11) NULL COMMENT 'insertar',
  `update` int(11) NULL COMMENT 'actualizar',
  `delete` int(11) NULL COMMENT 'borrar',
  CONSTRAINT `accion_fk_id_menu_1` 
   FOREIGN KEY (`fk_id_menu_1`) 
   REFERENCES `menu` (`id_menu`),
  CONSTRAINT `accion_fk_id_rol_2` 
   FOREIGN KEY (`fk_id_rol_2`) 
   REFERENCES `rol` (`rol_id`),
)

-- ===================================================================
-- Obtener conteo de inscripciones asociadas a determinada instanica
-- ===================================================================
SELECT 
curso.nombre_curso, 
instancia.id_instancia,
(SELECT COUNT(*) FROM inscripcion_instancia WHERE inscripcion_instancia.fk_id_instancia_1 = instancia.id_instancia) as CuposOcupados
FROM instancia
JOIN inscripcion_instancia ON inscripcion_instancia.fk_id_instancia_1 = instancia.id_instancia
JOIN curso ON curso.id_curso = instancia.fk_id_curso_1
WHERE instancia.id_instancia = 2 LIMIT 1

-- Otra opción para realizar esta operación
SELECT 
curso.nombre_curso, 
instancia.id_instancia,
(SELECT COUNT(*) FROM inscripcion_instancia WHERE inscripcion_instancia.fk_id_instancia_1 = instancia.id_instancia) as CuposOcupados
FROM instancia
JOIN inscripcion_instancia ON inscripcion_instancia.fk_id_instancia_1 = instancia.id_instancia
JOIN curso ON curso.id_curso = instancia.fk_id_curso_1
WHERE instancia.id_instancia = 2
GROUP BY curso.nombre_curso

-- Conteo de inscripciones activas en determinada instancia
SELECT 
	COUNT(inscripcion.activa)
FROM inscripcion_instancia
JOIN inscripcion ON inscripcion.id_inscripcion = inscripcion_instancia.fk_id_inscripcion_1
WHERE inscripcion_instancia.fk_id_instancia_1 = 1
AND inscripcion.activa = 1


-- ===================================================================
-- Contar períodos que no han culminado
-- ===================================================================
SELECT COUNT(*)
FROM periodo
WHERE fecha_culminacion_periodo >= CURRENT_DATE

-- ===================================================================
-- Contarinstancias activas por período
-- ===================================================================
SELECT 
	periodo.id_periodo,
    CONCAT(periodo.mes_inicio_periodo, ' ', periodo.mes_cierre_periodo) as meses,
    COUNT(*)
FROM instancia 
JOIN periodo on periodo.id_periodo = instancia.fk_id_periodo_1

WHERE periodo.fecha_culminacion_periodo >= CURRENT_DATE AND periodo.id_periodo = 2
group by periodo.id_periodo

-- Ganador
SELECT 
    COUNT(*)
FROM instancia 
JOIN periodo on periodo.id_periodo = instancia.fk_id_periodo_1
WHERE periodo.id_periodo = 2

-- Listo para ser usado en la aplicación CE Gestión
SELECT
  p.id_periodo, 
  concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(p.fecha_inicio_periodo)) as nombre_periodo,
  p.fecha_inicio_periodo,
  p.fecha_culminacion_periodo,
  p.fecha_creacion,
  (SELECT COUNT(*) as instancias_asociadas FROM instancia WHERE instancia.fk_id_periodo_1 = p.id_periodo) AS instancias_asociadas
FROM periodo AS p
JOIN mes AS mi ON p.mes_inicio_periodo = mi.id_mes
JOIN mes AS mc ON p.mes_cierre_periodo = mc.id_mes

-- ===================================================================
-- COntar roles de personas
-- ===================================================================
SELECT po.nombres_persona
FROM persona AS po
WHERE EXISTS(
	SELECT 1 FROM participante AS par WHERE par.fk_id_persona_2 = po.id_persona
)

-- Cuenta los registros
SELECT count(*) AS total_participantes
FROM persona AS po
WHERE EXISTS(
	SELECT 1 FROM participante AS par WHERE par.fk_id_persona_2 = po.id_persona
)


-- ===================================================================
-- Calcular total pagado y deuda
-- ===================================================================
SELECT 
inscripcion.id_inscripcion,
SUM(pago_de_inscripcion.monto_operacion) as calculo_total_pagado,
(inscripcion.costo_de_inscripcion - SUM(pago_de_inscripcion.monto_operacion)) AS calculo_deuda
FROM inscripcion
INNER JOIN pago_de_inscripcion ON pago_de_inscripcion.fk_id_inscripcion = inscripcion.id_inscripcion
WHERE inscripcion.id_inscripcion = 4


-- ===================================================================
-- Calcular Edad
-- ===================================================================
SELECT YEAR(CURRENT_TIMESTAMP) - YEAR(persona.fecha_nacimiento_persona) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(persona.fecha_nacimiento_persona, 5)) as age 
  FROM persona
  
-- ===================================================================
  -- STORED PROCEDURES
-- ===================================================================
SELECT * from information_schema.routines -- Mostrar procedimientos almacenados

-- Actualiza conteo de operación después de un pago
DELIMITER $$ 
CREATE OR REPLACE PROCEDURE actualizar_conteo_operacion(IN id_operacion INT(11))

BEGIN 

UPDATE tipo_de_operacion SET tipo_de_operacion.conteo_operaciones = tipo_de_operacion.conteo_operaciones + 1
WHERE tipo_de_operacion.id_tipo_de_operacion = id_operacion;

END $$

DELIMITER ;
-- Fin: Actualiza conteo de operación después de un pago

-- Insertar Pago 
DELIMITER $$

CREATE OR REPLACE CREATE PROCEDURE insertar_pago_nuevo(
    IN id_banco INT(11), 
    IN id_tipo_operacion INT(11), 
    IN id_titular INT(11), 
    IN serial_pago VARCHAR(255), 
    IN numero_operacion VARCHAR(255), 
    IN monto_operacion DECIMAL(10,2), 
    IN fecha_operacion DATE)

BEGIN 

 INSERT INTO `pago_de_inscripcion`(`fk_id_banco`, `fk_id_tipo_operacion`, `fk_id_titular`, `serial_pago`, `numero_operacion`, `monto_operacion`, `fecha_operacion`, `fecha_registro_operacion`) 
 VALUES (id_banco, id_tipo_operacion, id_titular, serial_pago, numero_operacion, monto_operacion, fecha_operacion);
 
END $$

DELIMITER ;
-- Fin: Insertar Pago 

-- Utilizados actualmente en la base de datos
-- Insertar Pago y actualizar conteo de operaciones
DELIMITER $$

CREATE OR REPLACE PROCEDURE insertar_pago_nuevo(
    IN id_banco INT(11), 
    IN id_tipo_operacion INT(11), 
    IN id_titular INT(11), 
    IN serial_pago VARCHAR(255), 
    IN numero_operacion VARCHAR(255), 
    IN monto_operacion DECIMAL(10,2), 
    IN fecha_operacion DATE)

BEGIN 

 INSERT INTO `pago_de_inscripcion`(`fk_id_banco`, `fk_id_tipo_operacion`, `fk_id_titular`, `serial_pago`, `numero_operacion`, `monto_operacion`, `fecha_operacion`) 
 VALUES (id_banco, id_tipo_operacion, id_titular, serial_pago, numero_operacion, monto_operacion, fecha_operacion);
 
UPDATE tipo_de_operacion SET tipo_de_operacion.conteo_operaciones = tipo_de_operacion.conteo_operaciones + 1
WHERE tipo_de_operacion.id_tipo_de_operacion = id_tipo_operacion;
 
END $$

DELIMITER ;

CALL insertar_pago_nuevo(
    1,
    3,
    9,
    'exo-000008',
    'EXO000008',
    10000.00,
    '2020-01-07'
    )

-- =============================================================
-- =============================================================
-- Obtén nombre de un MES a partir de fecha
SET lc_time_names = 'es_ES'; -- Cambia el idioma a Español

-- Acá se presentan dos opciones
SELECT 
    MONTHNAME(fecha_inicio),
    DATE_FORMAT(periodo.fecha_inicio, '%M') as Mes
FROM `periodo`
-- =============================================================
-- =============================================================

-- =============================================================
-- =============================================================
-- Contar veces que se ha usado un nombre
-- =============================================================
-- =============================================================
SELECT
	nombre_curso.descripcion,
    nombre_curso.id,
    COUNT(curso.id) as conteo_uso
FROM
	nombre_curso
JOIN curso ON curso.id_nombre_curso = nombre_curso.id
GROUP BY nombre_curso.descripcion
-- =============================================================
-- =============================================================

-- =============================================================
-- =============================================================
-- Conteo de inscripciones en el curso
-- =============================================================
-- =============================================================
SELECT 
curso.serial,
nombre_curso.descripcion,
(
    SELECT 
    	COUNT(inscripcion.id)
    FROM inscripcion
    WHERE inscripcion.estado = 1
) AS inscripciones_activas,
(
    SELECT 
    	COUNT(inscripcion.id)
    FROM inscripcion
    WHERE inscripcion.estado = 0
) AS inscripciones_inactivas,
(
    SELECT 
    	COUNT(inscripcion.id)
    FROM inscripcion
) AS inscripciones_totales
FROM curso
LEFT JOIN nombre_curso ON nombre_curso.id = curso.id_nombre_curso
GROUP BY curso.serial
-- =============================================================
-- =============================================================