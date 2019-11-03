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

