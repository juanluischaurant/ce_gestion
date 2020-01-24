<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

    /**
     * Retorna una lista de cursos registrados
     *
     * @return array
     */
    public function get_cursos()
    {
        // Cambia el idioma del set de resultados a generar
        $this->db->query("SET lc_time_names = 'es_ES';");

        $resultados = $this->db->select(
            'curso.id, 
            curso.serial,
            curso.cupos, 
            curso.cupos,
            curso.fecha_registro,
            curso.estado,
            curso.cupos as total_cupos,
            turno.nombre,
            turno.id,
            especialidad.nombre,
            concat(MONTH(periodo.fecha_inicio), "-", MONTH(periodo.fecha_culminacion), " ", YEAR(periodo.fecha_inicio)) as periodo_academico,
            periodo.fecha_culminacion'
        )
        ->from('curso')
        ->join('turno', 'curso.id_turno = turno.id')
        ->join('especialidad', 'especialidad.id = curso.id_especialidad')
        ->join('periodo', 'periodo.id = curso.id_periodo')
        ->where('curso.estado', '1')
        ->or_where('curso.estado', '0')
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén datos relacionados al curso especificada
     *
     * @param integer $id_instancia
     * @return array
     */
    public function get_curso($id_curso)
    {
        // Cambia el idioma del set de resultados a generar
        $this->db->query("SET lc_time_names = 'es_ES';");

        // Obtén la curso de una especialidad en específico
        $resultado = $this->db->select(
            'curso.id,
            curso.cupos,
            curso.precio_instancia,
            curso.id_turno,
            curso.descripcion,
            especialidad.nombre,
            periodo.id,
            concat(MONTH(periodo.fecha_inicio), "-", MONTH(periodo.fecha_culminacion), " ", YEAR(periodo.fecha_inicio)) as periodo_academico,
            periodo.fecha_culminacion,
            locacion.id,
            locacion.nombre as locacion_instancia,
            facilitador.id_facilitador,
            concat(persona.nombres, " ", persona.apellidos) AS nombre_facilitador'
        )
        ->from('curso')
        ->join('especialidad', 'especialidad.id = curso.id_curso')
        ->join('periodo', 'periodo.id = curso.id_periodo')
        ->join('locacion', 'locacion.id = curso.id_locacion')
        ->join('facilitador', 'facilitador.id = curso.id_facilitador')
        ->join('persona', 'persona.id = facilitador.id_persona')
        ->where('curso.id', $id_instancia)
        ->get('curso');

        return $resultado->row();
    }

     /**
     * Verifica que el período asignado a la curso aún esté en vigencia
     *
     * @param integer $id_instancia
     * @return array
     */
    public function verificar_periodo_curso($id_instancia)
    {
        // Obtén la curso de un especialidad en específico
        $resultado = $this->db->select(
            'per.fecha_culminacion_periodo'
        )
        ->from('curso as ins')
        ->join('especialidad as cur', 'cur.id_curso = ins.fk_id_curso_1')
        ->join('periodo as per', 'per.id_periodo = ins.fk_id_periodo_1')
        ->where('ins.id_instancia', $id_instancia)
        ->get('curso')->row();

        // Obtén fecha de hoy del sistema
        $today = date('Y-m-d');

        if($resultado->fecha_culminacion_periodo >= $today)
        {
            return TRUE;
        }
        else if($resultado->fecha_culminacion_periodo < $today)
        {
            return FALSE;
        }
    }

    public function verificar_estado_instancia($id_instancia)
    {
        // Obtén la curso de un especialidad en específico
        $resultado = $this->db->select(
            'ins.estado_instancia'
        )
        ->from('curso as ins')
        ->where('ins.id_instancia', $id_instancia)
        ->get()
        ->row();

        if($resultado->estado_instancia == 1)
        {
            return TRUE;
        }
        else if($resultado->estado_instancia == 0)
        {
            return FALSE;
        }
    }
   

    /**
     * Realiza conteo de inscripciones
     * 
     * El conteo de inscripciones se realiza en determinada curso
     * y retorna:
     * inscripciones activas
     * inscripciones inactivas
     * inscripciones totales
     * nombre especialidad
     *
     * @param [type] $id_instancia
     * @return void
     */
    public function conteo_inscripciones($id_instancia)
    {
        $SQL = "SELECT 
        especialidad.nombre_curso, 
        curso.id_instancia,
        (
            SELECT 
                COUNT(i.activa)
            FROM inscripcion_instancia as iinst
            JOIN inscripcion as i ON i.id_inscripcion = iinst.fk_id_inscripcion_1
            WHERE iinst.fk_id_instancia_1 = ".$id_instancia."
            AND i.activa = 1
        ) AS inscripciones_activas,
        (
            SELECT 
                COUNT(i.activa)
            FROM inscripcion_instancia as iinst
            JOIN inscripcion as i ON i.id_inscripcion = iinst.fk_id_inscripcion_1
            WHERE iinst.fk_id_instancia_1 = ".$id_instancia."
            AND i.activa = 0
        ) AS inscripciones_inactivas,
        (
            SELECT 
                COUNT(i.activa)
            FROM inscripcion_instancia as iinst
            JOIN inscripcion as i ON i.id_inscripcion = iinst.fk_id_inscripcion_1
            WHERE iinst.fk_id_instancia_1 = ".$id_instancia."
        ) AS inscripciones_totales
        
        FROM curso
        JOIN inscripcion_instancia ON inscripcion_instancia.fk_id_instancia_1 = curso.id_instancia
        JOIN inscripcion ON inscripcion.id_inscripcion = inscripcion_instancia.fk_id_inscripcion_1
        JOIN especialidad ON especialidad.id_curso = curso.fk_id_curso_1
        WHERE curso.id_instancia = ".$id_instancia."
        GROUP BY especialidad.nombre_curso";

        $query = $this->db->query($SQL);

        return $query->row();
    }


    public function save($data)
    {
		return $this->db->insert("curso", $data);
    }

    public function update($id, $data)
    {
        $resultado = $this->db->where('id_instancia', $id)
        ->update('curso', $data);

        if($resultado === TRUE)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    } 

    /**
     * Consulta la BD y obtiene una lista de todos los turnos disponibles
     * para luego almacenrla en un array que es retornado
     *
     * @return array
     */
    public function turnos_dropdown()
    {
        $query = $this->db->from('turno')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id] = $row->nombre;
        }

        return $array;
    }

    
    /**
     * Permite realizar una consulta a la base de datos para obterner toda la información 
     * sobre la persona con el ID indicado
     *
     * @param int $id_instancia
     * @return array
     */
    public function get_participantes_inscritos($id_instancia)
    {
        $resultado = $this->db->select(
            'in.id,
            cu.nombre,
            insc.fecha_registro,
            par.estado,
            per.nombres,
            per.apellidos,
            per.cedula'
        )
        ->from('curso as in')
        ->join('especialidad as cu', 'cu.id = in.fk_id_curso_1')
        ->join('periodo as pe', 'pe.id_periodo = in.fk_id_periodo_1')
        ->join('inscripcion_instancia as ii', 'ii.fk_id_instancia_1 = in.id_instancia')
        ->join('inscripcion as insc', 'insc.id_inscripcion = ii.fk_id_inscripcion_1')
        ->join('participante as par', 'par.id = insc.fk_id_participante_1')
        ->join('persona as per', 'per.id = par.id_persona')
        ->where('in.id_instancia', $id_instancia) 
        ->where('insc.activa', 1)
        ->get();

        return $resultado->result();
    }
    
    public function getPeriodosJSON($valor) 
    {
        // Cambia el idioma del set de resultados a generar
        $this->db->query("SET lc_time_names = 'es_ES';");

        // Obtén los registros de curso de los especialidades
        $resultados = $this->db->select(
            "periodo.id AS id_periodo, 
            concat(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as label"
        )
        ->from('periodo')
        // ->like('nombre_periodo', $valor)
        ->where('fecha_culminacion >= CURDATE()')
        ->like('YEAR(periodo.fecha_inicio)', $valor)
        ->get();

        return $resultados->result_array();
    } 

    public function getLocacionesJSON($valor)
    {
         // Obtén los registros de curso de los especialidades
         $resultados = $this->db->select(
            'locacion.id AS id_locacion,
            locacion.nombre as label,
            locacion.direccion'
        )
        ->from('locacion')
        ->like('nombre', $valor)
        ->get();

        return $resultados->result_array();
    }

    public function getFacilitadoresJSON($valor)
    {
         // Obtén los registros de curso de los profesores
         $resultados = $this->db->select(
            'facilitador.id AS id_facilitador,
            facilitador.id_persona,
            persona.id,
            persona.nombres,
            persona.apellidos,
            concat(persona.nombres, " ", persona.apellidos) as label'
        )
        ->from('facilitador')
        ->join('persona', 'persona.id = facilitador.id_persona')
        ->where('facilitador.estado', '1') 
        ->like('persona.nombres', $valor)
        ->or_like('persona.apellidos', $valor)
        ->get();

        return $resultados->result_array();
    }


}
