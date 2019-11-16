<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model {

    public function getPersonas()
    {
        $resultados = $this->db->select(
            'p.persona_id,
            p.cedula_persona,
            p.nombres_persona,
            p.apellidos_persona,
            p.genero_persona,
            p.fecha_nacimiento_persona,
            p.telefono_persona,
            p.direccion_persona,
            p.estado_persona,
            p.fecha_registro_persona')
            ->from('persona as p') 
            ->where('estado_persona', 1)
            ->get(); 
    
        return $resultados->result();
    }

    /**
     * Permite realizar una consulta a la base de datos para obterner toda la información 
     * sobre la persona con el ID indicado
     *
     * @param int $id
     * @return array
     */
    public function getPersona($id)
    {
        $resultado = $this->db->where('persona_id', $id)
        ->get('persona');

        return $resultado->row();
    }
    
    public function save($data) {
        return $this->db->insert('persona', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('persona_id', $id);
        return $this->db->update('persona', $data);
    }

    public function lastID() {
		return $this->db->insert_id();
    }

    public function generos_dropdown()
    {
        $array = array(
            1 => 'Masculino',
            2 => 'Femenino'
        );

        return $array;
    }

}