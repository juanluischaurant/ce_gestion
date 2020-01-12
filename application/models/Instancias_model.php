<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancias_model extends CI_Model {

    /**
     * Returna una lista de instancias
     *
     * @return array
     */
    public function get_instancias()
    {
        // Obtén una lista de cursos instanciados
        $resultados = $this->db->select('instancia.id_instancia, 
        instancia.cupos_instancia, 
        instancia.cupos_instancia_ocupados,
        instancia.fecha_creacion,
        instancia.estado_instancia,
        instancia.serial_instancia,
        concat(instancia.cupos_instancia, "/", instancia.cupos_instancia_ocupados) as total_cupos,
        ti.nombre_turno,
        ti.id_turno,
        ti.descripcion_turno,
        curso.nombre_curso,
        concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(per.fecha_inicio_periodo)) as periodo_academico,
        per.fecha_culminacion_periodo')
        ->from('instancia')
        ->join('turno_instancia as ti', 'instancia.fk_id_turno_instancia_1 = ti.id_turno')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo as per', 'per.id_periodo = instancia.fk_id_periodo_1')
        ->join('mes as mi', 'per.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'per.mes_cierre_periodo = mc.id_mes') 
        ->where('instancia.estado_instancia', '1')
        ->or_where('instancia.estado_instancia', '0')
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén datos relacionados a la instancia especificada
     *
     * @param integer $id_instancia
     * @return array
     */
    public function get_instancia($id_instancia)
    {
        // Obtén la instancia de un curso en específico
        $resultado = $this->db->select(
            'ins.id_instancia,
            ins.cupos_instancia_ocupados,
            ins.serial_instancia,
            ins.cupos_instancia,
            ins.precio_instancia,
            ins.fk_id_turno_instancia_1,
            ins.descripcion_instancia,
            cur.nombre_curso,
            per.id_periodo,
            mi.nombre_mes,
            mc.nombre_mes,
            concat(mi.nombre_mes, " - ", mc.nombre_mes, " ", YEAR(per.fecha_inicio_periodo)) as periodo,
            per.fecha_culminacion_periodo,
            loc.id_locacion,
            loc.nombre_locacion as locacion_instancia,
            fac.id_facilitador,
            concat(perso.nombres_persona, " ", perso.apellidos_persona) AS nombre_facilitador'
        )
        ->from('instancia as ins')
        ->join('curso as cur', 'cur.id_curso = ins.fk_id_curso_1')
        ->join('periodo as per', 'per.id_periodo = ins.fk_id_periodo_1')
        ->join('mes as mi', 'per.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'per.mes_cierre_periodo = mc.id_mes') 
        ->join('locacion as loc', 'loc.id_locacion = ins.fk_id_locacion_1')
        ->join('facilitador as fac', 'fac.id_facilitador = ins.fk_id_facilitador_1')
        ->join('persona as perso', 'perso.id_persona = fac.fk_id_persona_3')
        ->where('ins.id_instancia', $id_instancia)
        ->get('instancia');

        return $resultado->row();
    }

     /**
     * Verifica que el período asignado a la instancia aún esté en vigencia
     *
     * @param integer $id_instancia
     * @return array
     */
    public function verificar_periodo_instancia($id_instancia)
    {
        // Obtén la instancia de un curso en específico
        $resultado = $this->db->select(
            'per.fecha_culminacion_periodo'
        )
        ->from('instancia as ins')
        ->join('curso as cur', 'cur.id_curso = ins.fk_id_curso_1')
        ->join('periodo as per', 'per.id_periodo = ins.fk_id_periodo_1')
        ->where('ins.id_instancia', $id_instancia)
        ->get('instancia')->row();

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
        // Obtén la instancia de un curso en específico
        $resultado = $this->db->select(
            'ins.estado_instancia'
        )
        ->from('instancia as ins')
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
     * El conteo de inscripciones se realiza en determinada instancia
     * y retorna:
     * inscripciones activas
     * inscripciones inactivas
     * inscripciones totales
     * nombre curso
     *
     * @param [type] $id_instancia
     * @return void
     */
    public function conteo_inscripciones($id_instancia)
    {
        $SQL = "SELECT 
        curso.nombre_curso, 
        instancia.id_instancia,
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
        
        FROM instancia
        JOIN inscripcion_instancia ON inscripcion_instancia.fk_id_instancia_1 = instancia.id_instancia
        JOIN inscripcion ON inscripcion.id_inscripcion = inscripcion_instancia.fk_id_inscripcion_1
        JOIN curso ON curso.id_curso = instancia.fk_id_curso_1
        WHERE instancia.id_instancia = ".$id_instancia."
        GROUP BY curso.nombre_curso";

        $query = $this->db->query($SQL);

        return $query->row();
    }


    public function save($data) {
		return $this->db->insert("instancia",$data);
    }

    public function update($id, $data)
    {
        $resultado = $this->db->where('id_instancia', $id)
        ->update('instancia', $data);

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
        $query = $this->db->from('turno_instancia')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id_turno] = $row->nombre_turno;
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
            'in.id_instancia,
            cu.nombre_curso,
            insc.hora_inscripcion,
            par.estado_participante,
            per.nombres_persona,
            per.apellidos_persona,
            per.cedula_persona'
        )
        ->from('instancia as in')
        ->join('curso as cu', 'cu.id_curso = in.fk_id_curso_1')
        ->join('periodo as pe', 'pe.id_periodo = in.fk_id_periodo_1')
        ->join('inscripcion_instancia as ii', 'ii.fk_id_instancia_1 = in.id_instancia')
        ->join('inscripcion as insc', 'insc.id_inscripcion = ii.fk_id_inscripcion_1')
        ->join('participante as par', 'par.id_participante = insc.fk_id_participante_1')
        ->join('persona as per', 'per.id_persona = par.fk_id_persona_2')
        ->where('in.id_instancia', $id_instancia) 
        ->where('insc.activa', 1)
        ->get();

        return $resultado->result();
    }
    
    public function getPeriodosJSON($valor) 
    {
        // Obtén los registros de instancia de los cursos
        $resultados = $this->db->select(
            'p.id_periodo, 
            concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(p.fecha_inicio_periodo)) as label'
        )
        ->from('periodo as p')
        ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 
        ->like('mi.nombre_mes', $valor)
        ->or_like('mc.nombre_mes', $valor)
        ->or_like('YEAR(p.fecha_inicio_periodo)', $valor)
        ->get();

        return $resultados->result_array();
    } 

    public function getLocacionesJSON($valor) {
         // Obtén los registros de instancia de los cursos
         $resultados = $this->db->select(
            'l.id_locacion,
            l.nombre_locacion as label,
            l.direccion_locacion'
        )
        ->from('locacion l')
        ->like('nombre_locacion', $valor)
        ->get();

        return $resultados->result_array();
    }

    public function getFacilitadoresJSON($valor)
    {
         // Obtén los registros de instancia de los profesores
         $resultados = $this->db->select(
            'f.id_facilitador,
            f.fk_id_persona_3,
            p.id_persona,
            p.nombres_persona,
            p.apellidos_persona,
            concat(p.nombres_persona, " ", p.apellidos_persona) as label'
        )
        ->from('facilitador f')
        ->join('persona as p', 'p.id_persona = f.fk_id_persona_3')
        ->where('f.estado_facilitador', '1') 
        ->like('p.nombres_persona', $valor)
        ->or_like('p.apellidos_persona', $valor)
        ->get();

        return $resultados->result_array();
    }


}
