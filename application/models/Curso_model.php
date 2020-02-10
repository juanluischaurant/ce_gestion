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
            COUNT(CASE WHEN inscripcion.estado = 1 THEN 1 END) AS cupos_ocupados,
            turno.nombre AS nombre_turno,
            nombre_curso.descripcion AS nombre_curso,
            concat(MONTHNAME(periodo.fecha_inicio), "-", MONTHNAME(periodo.fecha_culminacion), " ", YEAR(periodo.fecha_inicio)) as periodo_academico,
            periodo.fecha_culminacion'
        )
        ->from('curso')
        ->join('periodo', 'periodo.id = id_periodo')
        ->join('inscripcion', 'inscripcion.id_curso = curso.id', 'left')
        ->join('turno', 'curso.id_turno = turno.id')
        ->join('nombre_curso', 'nombre_curso.id = curso.id_nombre_curso')
        ->where('curso.estado', '1')
        ->or_where('curso.estado', '0')
        ->group_by('curso.serial')
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
            "curso.id,
            curso.serial,
            curso.cupos,
            curso.precio,
            curso.id_turno,
            curso.descripcion AS detalles_curso,
            curso.cedula_facilitador,
            nc.descripcion,
            periodo.id AS id_periodo,
            concat(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as periodo_academico,
            periodo.fecha_culminacion,
            locacion.id AS id_locacion,
            locacion.nombre as locacion_curso,
            facilitador.cedula_persona,
            concat(persona.primer_nombre, ' ', persona.primer_apellido) AS nombre_facilitador"
        )
        ->from('curso')
        ->join('nombre_curso as nc', 'nc.id = curso.id_nombre_curso')
        ->join('periodo', 'periodo.id = curso.id_periodo')
        ->join('locacion', 'locacion.id = curso.id_locacion')
        ->join('facilitador', 'facilitador.cedula_persona = curso.cedula_facilitador')
        ->join('persona', 'persona.cedula = facilitador.cedula_persona')
        ->where('curso.id', $id_curso)
        ->get();

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
     * Un período en vigencia es aquel cuya fecha de culminación es mayor
     * a la fecha actual.
     *
     * @param integer $id_curso
     * @return boolean
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
     * @param integer $id_curso
     * @return void
     */
    public function verificar_estado_curso($id_curso)
    {
        // Obtén el curso de un especialidad en específico
        $resultado = $this->db->select(
            'estado'
        )
        ->from('curso')
        ->where('id', $id_curso)
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
     * @param integer $id_curso
     * @return void
     */
    public function conteo_inscripciones($id_curso)
    {
        $SQL = "SELECT 
        curso.serial,
        COUNT(CASE WHEN inscripcion.estado = 1 THEN 1 END) AS inscripciones_activas,
        COUNT(CASE WHEN inscripcion.estado = 0 THEN 1 END) AS inscripciones_inactivas,
        (
            SELECT 
                COUNT(inscripcion.id)
            FROM inscripcion
        ) AS inscripciones_totales
        FROM curso
        LEFT JOIN inscripcion ON inscripcion.id_curso = curso.id
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

    public function update($id_curso, $data)
    {
        $resultado = $this->db->where('id', $id_curso)
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

    public function locaciones_dropdown()
    {
        // Obtén los registros de curso de los especialidades
        $resultados = $this->db->select(
            'locacion.id AS id_locacion,
            locacion.nombre as nombre_locacion'
        )
        ->from('locacion')
        ->where('locacion.estado', 1)
        ->get();

        $array[''] = 'Selecciona';

        foreach($resultados->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id_locacion] = $row->nombre_locacion;
        }
       
        return $array;
    }

    public function periodos_dropdown()
    {
        // Cambia el idioma del set de resultados a generar
        $this->db->query("SET lc_time_names = 'es_ES';");

        // Obtén los registros de curso de los especialidades
        $resultados = $this->db->select(
            "periodo.id AS id_periodo, 
            concat(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as periodo_academico"
        )
        ->from('periodo')
        ->where('fecha_culminacion >= CURDATE()')
        ->get();

        $array[''] = 'Selecciona';

        foreach($resultados->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id_periodo] = $row->periodo_academico;
        }
       
        return $array;
    }

    public function facilitadores_dropdown()
    {
        // Obtén los registros de curso de los profesores
        $resultados = $this->db->select(
            'facilitador.cedula_persona AS id_facilitador,
            concat(persona.primer_nombre, " ", persona.primer_apellido) as nombre_facilitador'
        )
        ->from('facilitador')
        ->join('persona', 'persona.cedula = facilitador.cedula_persona')
        ->where('facilitador.estado', '1') 
        ->get();

        $array[''] = 'Selecciona';

        foreach($resultados->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id_facilitador] = $row->nombre_facilitador;
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
            'curso.id,
            nc.descripcion,
            insc.fecha_registro,
            par.estado,
            per.primer_nombre,
            per.primer_apellido,
            per.cedula'
        )
        ->from('curso')
        ->join('nombre_curso as nc', 'nc.id = curso.id_nombre_curso')
        ->join('periodo as pe', 'pe.id = curso.id_periodo')
        ->join('inscripcion as insc', 'insc.id_curso = curso.id')
        ->join('participante as par', 'par.cedula_persona = insc.cedula_participante')
        ->join('persona as per', 'per.cedula = par.cedula_persona')
        ->where('curso.id', $id_curso) 
        ->where('insc.estado', 1)
        ->get();

        return $resultado->result();
    }
    
    /**
     * NO UTILIZADA
     *
     * @param [type] $valor
     * @return void
     */
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
            persona.primer_nombre,
            persona.primer_apellido,
            concat(persona.primer_nombre, " ", persona.primer_apellido) as label'
        )
        ->from('facilitador')
        ->join('persona', 'persona.cedula = facilitador.cedula_persona')
        ->where('facilitador.estado', '1') 
        ->like('persona.primer_nombre', $valor)
        ->or_like('persona.primer_apellido', $valor)
        ->get();

        return $resultados->result_array();
    }


}
