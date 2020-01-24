<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidad_model extends CI_Model {

    public function get_especialidades()
    {
         // Obtén una lista de especialidades asociadas
         $resultados = $this->db->select(
             'cu.id,
             cu.nombre,
             cu.estado,
             cu.descripcion,
             (SELECT COUNT(*) FROM curso WHERE curso.id_especialidad = cu.id) AS instancias_asociadas,
             cu.fecha_registro'
            )
         ->from('especialidad AS cu')
         ->where('cu.estado', '1')
         ->get();
 
         return $resultados->result();
    }

    public function get_especialidad($id)
    {
        $this->db->where('id', $id);
        $resultado = $this->db->get('especialidad');
        return $resultado->row(); 
    }


    public function save_especialidad($data)
    {
        // Almacena un especialidad listo para ser instanciado
        return $this->db->insert('especialidad', $data); 
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('especialidad', $data);
    } 

    /**
     * ELIMINAR
     * Actualiza un campo en la tabla especialidad que sirve como
     * contador. En base a este contador se genera un serial 
     * único para cada especialidad
     *
     * @param integer $id_curso
     * @return void
     */
    // public function actualizar_conteo_instancia($id_curso)
	// {
	// 	$especialidad = $this->get_especialidad($id_curso);
        
    //     $data = array(
    //         'veces_instanciado' => $especialidad->veces_instanciado + 1
    //     );
        
    //     $this->update($id_curso, $data);
	// }
}
