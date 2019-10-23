-- Tabla persona
INSERT INTO `persona`(`cedula_persona`, `nombres_persona`, `apellidos_persona`, `genero_persona`, `fecha_nacimiento_persona`, `telefono_persona`, `direccion_persona`, `estado_persona`) VALUES (22574648, 'Juan Luis', 'Chaurant', 'masculino', '1993-12-13', '04248900840', 'El Tigre, edo. Anzoátegui', 1)

-- Tabla facilitador
INSERT INTO `facilitador`(`estado_facilitador`, `fecha_registro_facilitador`, `fk_id_persona_3`) VALUES (1, '2018-07-19', 1)