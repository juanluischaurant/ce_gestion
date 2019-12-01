<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilitadores_model extends CI_Model {

    public function getFacilitadores()
    {
    $resultados = $this->db->select(
        'p.id_persona,
        p.cedula_persona,
        p.nombres_persona,
        p.apellidos_persona,
        p.genero_persona,
        p.fecha_nacimiento_persona,
        p.telefono_persona,
        p.direccion_persona,
        p.estado_persona,
        f.id_facilitador,
        f.estado_facilitador,
        f.fecha_registro_facilitador,
        f.fk_id_persona_3,
        f.estado_facilitador')
        ->from('persona as p')
        ->join('facilitador as f', 'f.fk_id_persona_3 = p.id_persona')
        ->where('f.estado_facilitador', '1') 
        ->get(); 

        return $resultados->result();
    }

    public function getFacilitador($id)
    {
        $resultado = $this->db->select(
            'p.id_persona,
            p.cedula_persona,
            p.nombres_persona,
            p.apellidos_persona,
            p.genero_persona,
            p.fecha_nacimiento_persona,
            p.telefono_persona,
            p.direccion_persona,
            p.estado_persona,
            f.id_facilitador,
            f.estado_facilitador,
            f.fecha_registro_facilitador,
            f.fk_id_persona_3,
            f.estado_facilitador')
            ->from('persona as p')
            ->join('facilitador as f', 'f.fk_id_persona_3 = p.id_persona')
            ->where('f.id_facilitador', $id)
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
        $this->db->where('id_facilitador', $id);
        return $this->db->update('facilitador', $data);
    }

    public function evitaFacilitadorDuplicado($id)
    {
        // Al momento de asignar el rol de Facilitador a una Persona, verifica que esta acción no haya sido realizada anteriormente
        $query = $this->db->select('fk_id_persona_3')
        ->from('facilitador')
        ->where('fk_id_persona_3', $id)
        ->get();

        if($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

}