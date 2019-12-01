<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participantes_model extends CI_Model {

	public function getParticipantes() {

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

    public function getParticipante($id) {
        $this->db->where('id_participante', $id);
        $resultado = $this->db->get('participante');
        return $resultado->row();
    }

    public function save($data) {
        return $this->db->insert('participante', $data);
    }

    public function update($id, $data) {
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
    public function evitaParticipanteDuplicado($id) {
        $query = $this->db->select('fk_id_persona_2')
        ->from('participante')
        ->where('fk_id_persona_2', $id)
        ->get();

        if($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

}