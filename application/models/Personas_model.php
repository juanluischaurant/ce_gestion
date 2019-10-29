<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model {

    public function getPersonas() {

        $resultados = $this->db->select(
            'p.persona_id,
            p.cedula_persona,
            p.nombres_persona,
            p.apellidos_persona,
            p.genero_persona,
            p.fecha_nacimiento_persona,
            p.telefono_persona,
            p.direccion_persona,
            p.estado_persona')
            ->from('persona as p') 
            ->get(); 
    
            return $resultados->result();
    }

    /**
     * Undocumented function
     *
     * @param int $id
     * @return void
     */
    public function getPersona($id) {

        $resultado = $this->db->where('persona_id', $id)
        ->get('persona');

        return $resultado->row();

    }
    
    public function save($data) {
        return $this->db->insert('persona', $data);
    }

    public function update($id, $data) {
        $this->db->where('persona_id', $id);
        return $this->db->update('persona', $data);
    }

    public function lastID() {
		return $this->db->insert_id();
    }    

}