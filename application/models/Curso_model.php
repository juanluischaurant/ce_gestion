<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {

	public function getCursos() {
         // Obtén una lista de cursos instanciados
         $resultados = $this->db->select(
             'cu.id_curso,
             cu.nombre_curso,
             cu.estado_curso,
             cu.descripcion_curso,
             cu.veces_instanciado,
             cu.fecha_registro_curso'
            )
         ->from('curso cu')
         ->where('cu.estado_curso', '1')
         ->get();
 
         return $resultados->result();
    }

    public function get_curso($id) {
        $this->db->where('id_curso', $id);
        $resultado = $this->db->get('curso');
        return $resultado->row(); 
    }


    public function saveCurso($data) {
        // Almacena un curso listo para ser instanciado
        return $this->db->insert('curso', $data); 
    }

    public function update($id, $data) {
        $this->db->where('id_curso', $id);
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
