<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancia_model extends CI_Model {

    /**
     * Returna una lista de instancias
     *
     * @return array
     */
    public function get_instancias()
    {
        // Obtén una lista de cursos instanciados
        $resultados = $this->db->select('instancia.id, 
        instancia.cupos, 
        instancia.cupos,
        instancia.fecha_registro,
        instancia.estado,
        instancia.cupos as total_cupos,
        tur.nombre,
        tur.id,
        tur.descripcion,
        curso.nombre,
        concat(MONTH(per.fecha_inicio), "-", MONTH(per.fecha_culminacion), " ", YEAR(per.fecha_inicio)) as periodo_academico,
        per.fecha_culminacion')
        ->from('instancia')
        ->join('turno as tur', 'instancia.id_turno = tur.id')
        ->join('curso', 'curso.id = instancia.id_curso')
        ->join('periodo as per', 'per.id = instancia.id_periodo')
        ->where('instancia.estado', '1')
        ->or_where('instancia.estado', '0')
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
            ins.id_turno,
            ins.descripcion_instancia,
            cur.nombre_curso,
            per.id_periodo,
            concat(mi.nombre_mes, " - ", mc.nombre_mes, " ", YEAR(per.fecha_inicio_periodo)) as periodo,
            per.fecha_culminacion_periodo,
            loc.id_locacion,
            loc.nombre_locacion as locacion_instancia,
            fac.id_facilitador,
            concat(perso.nombres_persona, " ", perso.apellidos_persona) AS nombre_facilitador'
        )
        ->from('instancia as ins')
        ->join('curso as cur', 'cur.id = ins.id_curso')
        ->join('periodo as per', 'per.id = ins.id_periodo')
        ->join('locacion as loc', 'loc.id = ins.id_locacion')
        ->join('facilitador as fac', 'fac.id = ins.id_facilitador')
        ->join('persona as perso', 'perso.id = fac.id_persona')
        ->where('ins.id', $id_instancia)
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
        ->from('instancia as in')
        ->join('curso as cu', 'cu.id = in.fk_id_curso_1')
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
        // Obtén los registros de instancia de los cursos
        $resultados = $this->db->select(
            'p.id, 
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
            'l.id,
            l.nombre as label,
            l.direccion'
        )
        ->from('locacion l')
        ->like('nombre', $valor)
        ->get();

        return $resultados->result_array();
    }

    public function getFacilitadoresJSON($valor)
    {
         // Obtén los registros de instancia de los profesores
         $resultados = $this->db->select(
            'f.id,
            f.id_persona,
            p.id,
            p.nombres,
            p.apellidos,
            concat(p.nombres, " ", p.apellidos) as label'
        )
        ->from('facilitador f')
        ->join('persona as p', 'p.id = f.id_persona')
        ->where('f.estado', '1') 
        ->like('p.nombres', $valor)
        ->or_like('p.apellidos', $valor)
        ->get();

        return $resultados->result_array();
    }


}
