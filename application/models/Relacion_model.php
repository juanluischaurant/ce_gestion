<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relacion_model extends CI_Model
{
    public function get_relacion_curso($id_curso)
    {
        $SQL = "SELECT 
                CONCAT(persona.primer_apellido, ' ', persona.primer_nombre) AS nombre_participante,
                persona.direccion,
                persona.telefono,
                persona.cedula,
                -- Se toma en cuenta la edad al momento en que se inscribió al participante 
                TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, inscripcion.fecha_registro) as edad_participante,
                DATE_FORMAT(persona.fecha_nacimiento, '%d-%m-%Y') as fecha_nacimiento_participante,    
                persona.genero,  
                banco.nombre AS nombre_banco,
                pago_de_inscripcion.numero_referencia_bancaria,
                -- Últimos 4 dígitos de la referencia bancaria
                RIGHT(pago_de_inscripcion.numero_referencia_bancaria, 4) AS ultimos_4_digitos,
                DATE_FORMAT(pago_de_inscripcion.fecha_operacion, '%d-%m-%Y') AS fecha_de_operacion,
                pago_de_inscripcion.monto_operacion,
                nivel_academico.nombre AS nivel_de_instruccion
            FROM inscripcion
            JOIN participante ON participante.cedula_persona = inscripcion.cedula_participante
            JOIN nivel_academico ON nivel_academico.id = participante.id_nivel_academico
            JOIN pago_de_inscripcion ON pago_de_inscripcion.id_inscripcion = inscripcion.id
            JOIN banco ON banco.id = pago_de_inscripcion.id_banco
            JOIN persona ON persona.cedula = participante.cedula_persona
            WHERE inscripcion.id_curso = ?
            AND inscripcion.estado = 1";
            
        $resultado = $this->db->query($SQL, $id_curso);

        return $resultado->result();
    }

}
