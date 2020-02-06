<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadistica_model extends CI_Model {

    public function get_estadistica_cursos()
    {
        $SQL = "SELECT
            ROUND(AVG(curso.cupos), 2) promedio_cupos,
            ROUND(AVG((SELECT COUNT(*) FROM inscripcion WHERE inscripcion.id_curso = curso.id AND inscripcion.estado = 1)), 2) AS promedio_cupos_ocupados,
            COUNT(CASE WHEN inscripcion.estado = 1 THEN 1 END) AS inscripciones_activas
        FROM curso
        LEFT JOIN inscripcion ON inscripcion.id_curso = curso.id
        INNER JOIN periodo ON periodo.id = curso.id_periodo
        WHERE curso.estado = 1 AND periodo.fecha_culminacion >= CURRENT_DATE";

        $query = $this->db->query($SQL);

        return $query->row();
    }

    public function get_edad_promedio()
    {
        $SQL = "SELECT
            CAST(AVG(TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, persona.fecha_registro)) AS INT) AS edad_promedio
        FROM persona";

       $query = $this->db->query($SQL);

       return $query->row();        
    }

    public function get_porcentage_menor_18()
    {
        $SQL = "SELECT
        ROUND(menores_de_18*100/activos, 2) AS porcentaje_menor_de_18
        FROM 
        (SELECT
            COUNT(CASE WHEN participante.estado = 1 THEN 1 END) AS activos,
            (SELECT 
                COUNT(*) FROM participante
            LEFT JOIN persona ON persona.cedula = participante.cedula_persona
            WHERE YEAR(participante.fecha_registro) >= YEAR(CURRENT_DATE)
            AND TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, persona.fecha_registro) < 18) AS menores_de_18
        FROM participante) AS seleccion";

        $query = $this->db->query($SQL);

        return $query->row();
    }
}
