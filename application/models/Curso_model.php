<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

    public function get_cursos()
    {
         // Obtén una lista de cursos instanciados
         $resultados = $this->db->select(
             'cu.id,
             cu.nombre,
             cu.estado,
             cu.descripcion,
             (SELECT COUNT(*) FROM instancia WHERE instancia.id_curso = cu.id) AS instancias_asociadas,
             cu.fecha_registro'
            )
         ->from('curso cu')
         ->where('cu.estado', '1')
         ->get();
 
         return $resultados->result();
    }

    public function get_curso($id) {
        $this->db->where('id', $id);
        $resultado = $this->db->get('curso');
        return $resultado->row(); 
    }


    public function saveCurso($data) {
        // Almacena un curso listo para ser instanciado
        return $this->db->insert('curso', $data); 
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('curso', $data);
    } 

    /**
     * Actualiza un campo en la tabla curso que sirve como
     * contador. En base a este contador se genera un serial 
     * único para cada curso
     *
     * @param integer $id_curso
     * @return void
     */
    public function actualizar_conteo_instancia($id_curso)
	{
		$curso = $this->get_curso($id_curso);
        
        $data = array(
            'veces_instanciado' => $curso->veces_instanciado + 1
        );
        
        $this->update($id_curso, $data);
	}
}
