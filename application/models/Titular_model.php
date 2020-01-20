<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Titular_model extends CI_Model {

    public function get_titulares()
    {
        $resultados = $this->db->select(
            'per.id,
            per.cedula,
            per.nombres,
            per.apellidos,
            per.genero,
            per.fecha_nacimiento,
            per.telefono,
            per.direccion,
            per.estado,
            c.id,
            c.estado,
            c.fecha_registro,
            c.id_persona,
            c.estado')
            ->from('persona as per')
            ->join('titular as c', 'c.id_persona = per.id')
            ->where('c.estado', '1') 
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
    public function duplicidad_persona($id)
    {
        // Al momento de asignar el rol de Facilitador a una Persona, verifica que esta acción no haya sido realizada anteriormente
        $query = $this->db->select('id_persona')
        ->from('titular')
        ->where('id_persona', $id)
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