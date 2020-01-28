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
            curso.fecha_registro,
            curso.estado,
            curso.cupos AS total_cupos,
            turno.nombre AS nombre_turno,
            nombre_curso.descripcion AS nombre_curso,
            concat(MONTH(periodo.fecha_inicio), "-", MONTH(periodo.fecha_culminacion), " ", YEAR(periodo.fecha_inicio)) as periodo_academico,
            periodo.fecha_culminacion'
        )
        ->from('curso')
        ->join('turno', 'curso.id_turno = turno.id')
        ->join('nombre_curso', 'nombre_curso.id = curso.id_nombre_curso')
        ->join('periodo', 'periodo.id = curso.id_periodo')
        ->where('curso.estado', '1')
        ->or_where('curso.estado', '0')
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén datos relacionados al curso especificada
     *
     * @param integer $id_curso
     * @return array
     */
    public function get_curso($id_curso)
    {
        // Cambia el idioma del set de resultados a generar
        $this->db->query("SET lc_time_names = 'es_ES';");

        // Obtén el curso de una especialidad en específico
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
        ->where('curso.id', $id_curso)
        ->get('curso');

        return $resultado->row();
    }

    /**
     * Obtén nombres de curso
     * 
     * Obtén una lista de los nombres de curso disponibles
     * para ser utilizados
     *
     * @return void
     */
    public function get_nombres_curso()
    {
        $resultados = $this->db->select(
            'nc.id,
            nc.descripcion,
            nc.estado,
            nc.fecha_registro,
            COUNT(curso.id) as conteo_uso'
        )
        ->from('nombre_curso AS nc')
        ->join('curso', 'curso.id_nombre_curso = nc.id', 'left')
        ->group_by('nc.descripcion')
        ->get();

        return $resultados->result();
    }
    
     /**
     * Verifica que el período asignado al curso aún esté en vigencia
     *
     * @param integer $id_curso
     * @return array
     */
    public function verificar_periodo_curso($id_curso)
    {
        // Obtén el período de un curso en específico
        $resultado = $this->db->select(
            'periodo.fecha_culminacion'
        )
        ->from('curso')
        ->join('periodo', 'periodo.id = curso.id_periodo')
        ->where('curso.id', $id_curso)
        ->get()
        ->row();

        // Obtén fecha de hoy del sistema
        $today = date('Y-m-d');

        if($resultado->fecha_culminacion >= $today)
        {
            return TRUE;
        }
        else if($resultado->fecha_culminacion < $today)
        {
            return FALSE;
        }
    }

    /**
     * Verifica estado de instancia
     * 
     * Regresa verdadero en caso de ser activo (1)
     * y regresa falso en caso de ser inactivo (0).
     *
     * @param [type] $id_curso
     * @return void
     */
    public function verificar_estado_curso($id_curso)
    {
        // Obtén el curso de un especialidad en específico
        $resultado = $this->db->select(
            'ins.estado'
        )
        ->from('curso as ins')
        ->where('ins.id_instancia', $id_curso)
        ->get()
        ->row();

        if($resultado->estado == 1)
        {
            return TRUE;
        }
        else if($resultado->estado == 0)
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
     * @param [type] $id_curso
     * @return void
     */
    public function conteo_inscripciones($id_curso)
    {
        $SQL = "SELECT 
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
        WHERE curso.id = ?
        GROUP BY curso.serial";

        $query = $this->db->query($SQL, $id_curso);

        return $query->row();
    }


    public function save($data)
    {
		return $this->db->insert("curso", $data);
    }

    public function update($id_instancia, $data)
    {
        $resultado = $this->db->where('id', $id_instancia)
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
     * @param int $id_curso
     * @return array
     */
    public function get_participantes_inscritos($id_curso)
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
        ->where('in.id_instancia', $id_curso) 
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
            'facilitador.cedula_persona AS id_facilitador,
            persona.nombres,
            persona.apellidos,
            concat(persona.nombres, " ", persona.apellidos) as label'
        )
        ->from('facilitador')
        ->join('persona', 'persona.cedula = facilitador.cedula_persona')
        ->where('facilitador.estado', '1') 
        ->like('persona.nombres', $valor)
        ->or_like('persona.apellidos', $valor)
        ->get();

        return $resultados->result_array();
    }


}
