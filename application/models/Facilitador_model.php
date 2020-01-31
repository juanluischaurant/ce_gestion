<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilitador_model extends CI_Model {

    public function get_facilitadores()
    {
    $resultados = $this->db->select(
        'persona.primer_nombre,
        persona.primer_apellido,
        persona.genero,
        persona.fecha_nacimiento,
        persona.telefono,
        persona.direccion,
        persona.estado,
        facilitador.cedula_persona,
        facilitador.estado,
        facilitador.fecha_registro,
        facilitador.estado'
        )
        ->from('facilitador')
        ->join('persona', 'persona.cedula = facilitador.cedula_persona')
        ->where('facilitador.estado', '1') 
        ->get(); 

        return $resultados->result();
    }

    public function get_facilitador($cedula_persona)
    {
        $resultado = $this->db->select(
            'facilitador.cedula_persona,
            persona.primer_nombre,
            persona.primer_apellido,
            persona.genero,
            persona.fecha_nacimiento,
            persona.telefono,
            persona.direccion,
            persona.correo_electronico,
            facilitador.fecha_contratacion,
            facilitador.fecha_registro,
            facilitador.estado')
            ->from('facilitador')
            ->join('persona', 'persona.cedula = facilitador.cedula_persona')
            ->where('facilitador.cedula_persona', $cedula_persona)
            ->get();

        return $resultado->row(); 
    }

    public function save($data)
    {
        // Almacena un facilitador listo para ser asignado
        return $this->db->insert('facilitador', $data); 
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('facilitador', $data);
    }

    public function evitaFacilitadorDuplicado($id)
    {
        // Al momento de asignar el rol de Facilitador a una Persona, verifica que esta acción no haya sido realizada anteriormente
        $query = $this->db->select('facilitador.cedula_persona')
        ->from('facilitador')
        ->where('facilitador.cedula_persona', $id)
        ->get();

        if($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

}