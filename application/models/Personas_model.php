<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model {

	// public function getParticipantes() {
    //     $this->db->where('estado_cliente', '1' );
    //     $resultados = $this->db->get('cliente'); 
    //     return $resultados->result();
    // }

    // public function getParticipante($id) {
    //     $this->db->where('id_participante', $id);
    //     $resultado = $this->db->get('participante');
    //     return $resultado->row();
    // }

    // public function save($data) {
    //     return $this->db->insert('cliente', $data);
    // }

    public function update($id, $data) {
        $this->db->where('persona_id', $id);
        return $this->db->update('persona', $data);
    }
    

}