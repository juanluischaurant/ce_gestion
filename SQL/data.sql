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

INSERT INTO `menu`(`nombre_menu`, `enlace_menu`) VALUES ('Usuarios', 'administrador/usuarios');
INSERT INTO `menu`(`nombre_menu`, `enlace_menu`) VALUES ('Permisos', 'administrador/permisos')
INSERT INTO `menu`(`nombre_menu`, `enlace_menu`) VALUES ('Personas', 'gestion/personas')


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

