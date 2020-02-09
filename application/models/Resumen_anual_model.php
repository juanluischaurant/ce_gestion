<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resumen_anual_model extends CI_Model
{
    public function get_resumen_periodos($year)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        $SQL = "SELECT
            periodo.id,
            concat(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as periodo_academico,
            (SELECT COUNT(curso.id_periodo) FROM curso WHERE curso.id_periodo = periodo.id AND curso.estado = 1) AS conteo_cursos_dictados,
            (SUM(IF(curso.id = inscripcion.id_curso AND inscripcion.estado = 1,1,0)) ) AS conteo_inscripciones
        FROM periodo
        LEFT JOIN curso ON curso.id_periodo = periodo.id
        JOIN nombre_curso ON nombre_curso.id = curso.id_nombre_curso
        LEFT JOIN inscripcion ON inscripcion.id_curso = curso.id
        WHERE YEAR(periodo.fecha_inicio) = ?
        AND periodo.estado = 1
        GROUP BY periodo.id";
            
        $resultado = $this->db->query($SQL, array($year,));

        return $resultado->result();
    }

    public function get_resumen_generos($year)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        $SQL = "SELECT 
            periodo.id,
            CONCAT(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as periodo_academico,
            (SUM(IF(participante.cedula_persona = inscripcion.cedula_participante AND persona.genero = 1 AND inscripcion.estado = 1,1,0)) ) AS conteo_masculino,
            (SUM(IF(participante.cedula_persona = inscripcion.cedula_participante AND persona.genero = 2 AND inscripcion.estado = 1,1,0)) ) AS conteo_femenino,
            CAST(AVG(TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, persona.fecha_registro)) AS INT) AS edad_promedio,
            SUM(IF(TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, inscripcion.fecha_registro) < 18, 1, 0)) AS menores_al_inscribirse,
            SUM(IF(TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, inscripcion.fecha_registro) >= 18, 1, 0)) AS mayores_al_inscribirse
        FROM periodo
        LEFT JOIN curso ON curso.id_periodo = periodo.id
        LEFT JOIN inscripcion ON inscripcion.id_curso = curso.id
        LEFT JOIN participante ON participante.cedula_persona = inscripcion.cedula_participante
        LEFT JOIN persona ON persona.cedula = participante.cedula_persona
        WHERE YEAR(periodo.fecha_inicio) = ? AND periodo.estado = 1
        GROUP BY periodo.id";

        $resultado = $this->db->query($SQL, array($year,));

        return $resultado->result();
    }

    
    public function get_estadistica_cursos($year)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        $SQL = "SELECT
        ROUND(AVG(curso.cupos), 2) promedio_cupos, 
        ROUND(AVG((SELECT COUNT(*) 
                   FROM inscripcion 
                   WHERE inscripcion.id_curso = curso.id 
                   AND inscripcion.estado = 1)), 2) AS promedio_cupos_ocupados, 
        COUNT(CASE WHEN inscripcion.estado = 1 THEN 1 END) AS inscripciones_activas 
        FROM periodo 
        LEFT JOIN curso ON curso.id_periodo = periodo.id 
        LEFT JOIN inscripcion ON inscripcion.id_curso = curso.id 
        LEFT JOIN participante ON participante.cedula_persona = inscripcion.cedula_participante 
        LEFT JOIN persona ON persona.cedula = participante.cedula_persona
        WHERE YEAR(periodo.fecha_inicio) = ?";

        $query = $this->db->query($SQL, array($year));

        return $query->row();
    }

    public function get_edad_promedio_anual($year)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        $SQL = "SELECT
            CAST(AVG(TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, persona.fecha_registro)) AS INT) AS edad_promedio
        FROM persona
        LEFT JOIN participante ON participante.cedula_persona = persona.cedula
        LEFT JOIN inscripcion ON inscripcion.cedula_participante = participante.cedula_persona
        LEFT JOIN curso ON curso.id = inscripcion.id_curso
        LEFT JOIN periodo ON periodo.id = curso.id_periodo
        WHERE YEAR(periodo.fecha_inicio) >= ? 
        AND YEAR(periodo.fecha_inicio) <= ?";

       $query = $this->db->query($SQL, array($year, $year));

       return $query->row();        
    }

    public function get_conteo_participantes($year)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        $SQL = "SELECT
            MONTHNAME(participante.fecha_registro)  AS mes_registro,
            SUM(CASE WHEN participante.estado = 1 THEN 1 ELSE 0 END) as conteo_participantes_mes
        FROM participante
        WHERE YEAR(participante.fecha_registro) = ?
        GROUP BY MONTH(participante.fecha_registro)";

       $query = $this->db->query($SQL, array($year));

       return $query->result();        
    }

    /**
     * Obtiene lista de los años correspondientes a los períodos registradas
     * en la tabla "periodos". Utilizado por HighCharts.
     *
     * @return void
     */
    public function periodo_years()
    {
        $resultados = $this->db->select('YEAR(periodo.fecha_inicio) as year')
        ->from('periodo')
        ->group_by('year')
        ->order_by('year', 'desc')
        ->get();

        return $resultados->result();
    }
}
