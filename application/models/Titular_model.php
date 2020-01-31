<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Titular_model extends CI_Model {

    public function get_titulares()
    {
        $resultados = $this->db->select(
            'persona.nombres,
            persona.apellidos,
            persona.genero,
            persona.fecha_nacimiento,
            persona.telefono,
            persona.direccion,
            persona.estado,
            titular.cedula_persona,
            titular.estado,
            titular.fecha_registro as fecha_registro_titular,
            titular.estado')
            ->from('titular')
            ->join('persona', 'persona.cedula = titular.cedula_persona')
            ->where('titular.estado', '1')
            ->get(); 
    
            return $resultados->result();
    }

    public function save($data)
    {
        return $this->db->insert('titular', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_titular', $id);
        return $this->db->update('participante', $data);
    }
    
    /**
     * Duplicidad Persona
     * 
     * Evita que una persona sea registrada más de 1 vez como Titular habilitado para realizar pagos.
     *
     * @param integer $id
     * @return boolean
     */
    public function duplicidad_titular($cedula_persona)
    {
        // Al momento de asignar el rol de Facilitador a una Persona, verifica que esta acción no haya sido realizada anteriormente
        $query = $this->db->select('cedula_persona')
        ->from('titular')
        ->where('cedula_persona', $cedula_persona)
        ->get();

        if($query->num_rows() == 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}