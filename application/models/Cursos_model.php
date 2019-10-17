<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos_model extends CI_Model {

	public function getCursos() {
         // Obtén una lista de cursos instanciados
         $resultados = $this->db->select(
             'cu.id_curso,
             cu.nombre_curso,
             cu.estado_curso,
             cu.descripcion_curso'
            )
         ->from('curso cu')
         ->where('cu.estado_curso', '1')
         ->get();
 
         return $resultados->result();
    }

    public function getCurso($id) {
        $this->db->where('id_curso', $id);
        $resultado = $this->db->get('curso');
        return $resultado->row(); 
    }


    public function saveCurso($data) {
        // Almacena un curso listo para ser instanciado
        return $this->db->insert('curso', $data); 
    }

    public function update($id, $data) {
        $this->db->where('id_instancia', $id);
        $this->db->update('instancia', $data);
    } 
}
