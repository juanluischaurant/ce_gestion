<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilitadores_model extends CI_Model {

    // Estas dos funciones sirven para unir las tablas relacionadas a la tabla "dictado"
	public function getFacilitadores() {

        $resultados = $this->db->select(
        //     'f.id_facilitador,
        //     f.cedula_facilitador,
        //     f.nombre_facilitador,
        //     f.apellido_facilitador,
        //     f.genero_facilitador,
        //     f.telefono_1_facilitador,
        //     f.telefono_2_facilitador,
        //     f.direccion_facilitador'
        // )
        // ->from('facilitador f')  
        // ->where('f.estado_facilitador', 1) 
        'p.persona_id,
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
        f.fk_id_persona_3')
        ->from('persona as p')
        ->join('facilitador as f', 'f.id_facilitador = p.persona_id')
        ->where('f.estado_facilitador', 1) 
        ->get(); 

        return $resultados->result();
    }

    public function getFacilitador($id) {
        $this->db->where('id_facilitador', $id);
        $resultado = $this->db->get('facilitador');
        return $resultado->row(); 
    }

    public function save($data) {
        // Almacena un curso listo para ser instanciado
        return $this->db->insert('facilitador', $data); 
    }

    public function update($id, $data) {
        $this->db->where('id_facilitador', $id);
        return $this->db->update('facilitador', $data);
    }


}