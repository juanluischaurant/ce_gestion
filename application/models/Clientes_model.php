<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

	public function getClientes() {

        $resultados = $this->db->select(
            'per.persona_id,
            per.cedula_persona,
            per.nombres_persona,
            per.apellidos_persona,
            per.genero_persona,
            per.fecha_nacimiento_persona,
            per.telefono_persona,
            per.direccion_persona,
            per.estado_persona,
            c.id_cliente,
            c.estado_cliente,
            c.fecha_registro_cliente,
            c.fk_id_persona_1,
            c.estado_cliente')
            ->from('persona as per')
            ->join('cliente as c', 'c.fk_id_persona_1 = per.persona_id')
            ->where('c.estado_cliente', '1') 
            ->get(); 
    
            return $resultados->result();

    }

    public function getParticipante($id) {
        $this->db->where('id_cliente', $id);
        $resultado = $this->db->get('participante');
        return $resultado->row();
    }

    public function save($data) {
        return $this->db->insert('cliente', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_cliente', $id);
        return $this->db->update('participante', $data);
    }
    
    public function evitaClienteDuplicado($id) {
        // Al momento de asignar el rol de Facilitador a una Persona, verifica que esta acción no haya sido realizada anteriormente
        $query = $this->db->select('fk_id_persona_1')
        ->from('cliente')
        ->where('fk_id_persona_1', $id)
        ->get();

        if($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

}