<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participantes_model extends CI_Model {

    public function getParticipantes()
    {
        $resultados = $this->db->select(
            'per.id_persona,
            per.cedula_persona,
            per.nombres_persona,
            per.apellidos_persona,
            per.genero_persona,
            per.fecha_nacimiento_persona,
            per.telefono_persona,
            per.direccion_persona,
            per.estado_persona,
            par.id_participante,
            par.estado_participante,
            par.fecha_registro_participante,
            par.fk_id_persona_2,
            par.estado_participante')
            ->from('persona as per')
            ->join('participante as par', 'par.fk_id_persona_2 = per.id_persona')
            ->where('par.estado_participante', '1') 
            ->get(); 
    
            return $resultados->result();
    }

    /**
     * Permite consultar en la base de datos los datos específicos de un participante
     *
     * @param integer $id_participante
     * @return void
     */
    public function get_participante($id_participante)
    {
        $resultado = $this->db->select(
            'per.id_persona,
            per.cedula_persona,
            per.nombres_persona,
            per.apellidos_persona,
            per.genero_persona,
            per.fecha_nacimiento_persona,
            per.telefono_persona,
            per.direccion_persona,
            per.estado_persona,
            par.id_participante,
            par.estado_participante,
            par.fecha_registro_participante,
            par.fk_id_persona_2,
            par.estado_participante')
            ->from('participante as par')
            ->join('persona as per', 'per.id_persona = par.fk_id_persona_2')
            ->where('par.id_participante', $id_participante)
            ->where('par.estado_participante', 1) 
            ->get(); 
    
        return $resultado->row();
    }

    /**
     * Retorna las instancias en las que el participante se ha inscrito
     *
     * @return integer $id_participante
     */
    public function get_instancias_inscritas($id_participante)
    {
        $resultados = $this->db->select(
            'cur.nombre_curso,
            par.fk_id_persona_2,
            per.nombres_persona'
        )
        ->from('participante AS par')
        ->join('persona AS per', 'per.id_persona = par.fk_id_persona_2')
        ->join('inscripcion AS ins', 'ins.fk_id_participante_1 = par.id_participante')
        ->join('pago_de_inscripcion AS pdi', 'pdi.fk_id_inscripcion = ins.id_inscripcion')
        ->join('inscripcion_instancia AS ins_inst', 'ins_inst.fk_id_inscripcion_1 = ins.id_inscripcion')
        ->join('instancia AS inst', 'inst.id_instancia = ins_inst.fk_id_instancia_1')
        ->join('curso AS cur', 'cur.id_curso = inst.fk_id_curso_1')
        ->where('par.id_participante', $id_participante)
        ->group_by('ins.id_inscripcion')
        ->get();

        return $resultados->result_array();
    }

    public function save($data)
    {
        return $this->db->insert('participante', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_participante', $id);
        return $this->db->update('participante', $data);
    }
    
    /**
     * Al momento de asignar el rol de Participante a una Persona, 
     * verifica que esta acción no haya sido realizada anteriormente
     *
     * @param integer $id
     * @return boolean
     */
    public function evitaParticipanteDuplicado($id)
    {
        $query = $this->db->select('fk_id_persona_2')
        ->from('participante')
        ->where('fk_id_persona_2', $id)
        ->get();

        // Retorna verdadero si la persona no está registrada aún
        if($query->num_rows() == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}