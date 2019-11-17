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

    public function getInstancia($idInstancia)
    {
        // Obtén la instancia de un curso en específico
        $this->db->where('id_instancia', $idInstancia);
        $resultado = $this->db->get('instancia');
        return $resultado->row(); 
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

    public function getFacilitadoresJSON($valor) {
         // Obtén los registros de instancia de los profeores
         $resultados = $this->db->select(
            'f.id_facilitador,
            f.fk_id_persona_3,
            p.persona_id,
            p.nombres_persona,
            p.apellidos_persona,
            concat(p.nombres_persona, " ", p.apellidos_persona) as label'
        )
        ->from('facilitador f')
        ->join('persona as p', 'p.persona_id = f.fk_id_persona_3')
        ->where('f.estado_facilitador', '1') 
        ->like('p.nombres_persona', $valor)
        ->or_like('p.apellidos_persona', $valor)
        ->get();

        return $resultados->result_array();
    }


}
