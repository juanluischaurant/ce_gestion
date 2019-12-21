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