-- Tabla persona
INSERT INTO `persona`(`cedula_persona`, `nombres_persona`, `apellidos_persona`, `genero_persona`, `fecha_nacimiento_persona`, `telefono_persona`, `direccion_persona`, `estado_persona`) VALUES (22574648, 'Juan Luis', 'Chaurant', 'masculino', '1993-12-13', '04248900840', 'El Tigre, edo. Anzoátegui', 1)

-- Tabla facilitador
INSERT INTO `facilitador`(`estado_facilitador`, `fecha_registro_facilitador`, `fk_id_persona_3`) VALUES (1, '2018-07-19', 1)



SELECT participante.id_participante, persona.nombres_persona, curso.nombre_curso
FROM participante

JOIN persona ON
persona.persona_id = participante.fk_id_persona_2

JOIN inscripcion ON
inscripcion.fk_id_participante_1 = participante.id_participante

JOIN inscripcion_curso ON
inscripcion_curso.fk_id_inscripcion_1 = inscripcion.id_inscripcion

JOIN instancia ON 
instancia.id_instancia = inscripcion_curso.fk_id_curso_1

JOIN curso ON
curso.id_curso = instancia.fk_id_curso_1

where participante.id_participante = 3



-- Participantes registrados en instancia
SELECT `curso`.`nombre_curso`, `i`.`fk_id_participante_1` 
FROM `instancia` 

JOIN `curso` ON `curso`.`id_curso` = `instancia`.`fk_id_curso_1` 
JOIN `periodo` ON `periodo`.`id_periodo` = `instancia`.`fk_id_periodo_1` 
JOIN `inscripcion_curso` as `ic` ON `ic`.`fk_id_curso_1` = `instancia`.`id_instancia` 
JOIN `inscripcion` as `i` ON `i`.`id_inscripcion` = `ic`.`fk_id_inscripcion_1` 

WHERE `instancia`.`id_instancia` = 1

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