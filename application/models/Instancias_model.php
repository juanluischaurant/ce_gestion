<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancias_model extends CI_Model {

    /**
     * Returna una lista de instancias
     *
     * @return array
     */
    public function getInstancias()
    {
        // Obtén una lista de cursos instanciados
        $resultados = $this->db->select('instancia.id_instancia, 
        instancia.cupos_instancia, 
        instancia.cupos_instancia_ocupados,
        instancia.fecha_creacion,
        concat(instancia.cupos_instancia, "/", instancia.cupos_instancia_ocupados) as total_cupos,
        ti.nombre_turno,
        ti.id_turno,
        ti.descripcion_turno,
        curso.nombre_curso,
        concat(mi.nombre_mes, " ", mc.nombre_mes, "-", periodo.year_periodo) as periodo_academico')
        ->from('instancia')
        ->join('turno_instancia as ti', 'instancia.fk_id_turno_instancia_1 = ti.id_turno')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = instancia.fk_id_periodo_1')
        ->join('mes as mi', 'periodo.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'periodo.mes_cierre_periodo = mc.id_mes') 
        ->where('instancia.estado_instancia', '1')
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén datos relacionados a la instancia especificada
     *
     * @param integer $idInstancia
     * @return array
     */
    public function getInstancia($idInstancia)
    {
        // Obtén la instancia de un curso en específico
        $resultados = $this->db->select(
            'ins.cupos_instancia_ocupados,
            cur.nombre_curso,
            concat(per.mes_inicio_periodo, " - ", per.mes_cierre_periodo, " ", per.year_periodo) as periodo,
            loc.nombre_locacion as locacion_instancia'
        )
        ->from('instancia as ins')
        ->join('curso as cur', 'cur.id_curso = ins.fk_id_curso_1')
        ->join('periodo as per', 'per.id_periodo = ins.fk_id_periodo_1')
        ->join('locacion as loc', 'loc.id_locacion = ins.fk_id_locacion_1')
        ->where('ins.id_instancia', $idInstancia)
        ->get('instancia');

        return $resultados->row();
    }

    public function save($data) {
		return $this->db->insert("instancia",$data);
    }

    public function update($id, $data) {
        $this->db->where('id_instancia', $id);
        $this->db->update('instancia', $data);
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
            insc.fecha_inscripcion,
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
            concat(mi.nombre_mes, "-", mc.nombre_mes, " ", p.year_periodo) as label'
        )
        ->from('periodo as p')
        ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 
        ->like('mi.nombre_mes', $valor)
        ->or_like('mc.nombre_mes', $valor)
        ->or_like('p.year_periodo', $valor)
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
