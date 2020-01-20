<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilitador_model extends CI_Model {

    public function getFacilitadores()
    {
    $resultados = $this->db->select(
        'p.id,
        p.cedula,
        p.nombres,
        p.apellidos,
        p.genero,
        p.fecha_nacimiento,
        p.telefono,
        p.direccion,
        p.estado,
        f.id,
        f.estado,
        f.fecha_registro,
        f.id_persona,
        f.estado')
        ->from('persona as p')
        ->join('facilitador as f', 'f.id_persona = p.id')
        ->where('f.estado', '1') 
        ->get(); 

        return $resultados->result();
    }

    public function getFacilitador($id)
    {
        $resultado = $this->db->select(
            'p.id,
            p.cedula,
            p.nombres,
            p.apellidos,
            p.genero,
            p.fecha_nacimiento,
            p.telefono,
            p.direccion,
            p.estado,
            f.id,
            f.estado,
            f.fecha_registro,
            f.id_persona,
            f.estado')
            ->from('persona as p')
            ->join('facilitador as f', 'f.id_persona = p.id')
            ->where('f.id', $id)
            ->get('facilitador');

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
        $query = $this->db->select('fac.id_persona')
        ->from('facilitador as fac')
        ->where('fac.id_persona', $id)
        ->get();

        if($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

}