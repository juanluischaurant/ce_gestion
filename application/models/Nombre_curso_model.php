<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nombre_curso_model extends CI_Model {

    public function get_nombres_curso()
    {
         // Obtén una lista de nombre_curso asociadas
         $resultados = $this->db->select(
             'cu.id,
             cu.estado,
             cu.descripcion,
             (SELECT COUNT(*) FROM curso WHERE curso.id_nombre_curso = cu.id) AS conteo_cursos_asociados,
             cu.fecha_registro'
            )
         ->from('nombre_curso AS cu')
         ->where('cu.estado', '1')
         ->get();
 
         return $resultados->result();
    }

    public function get_nombre_curso($id)
    {
        $this->db->where('id', $id);
        $resultado = $this->db->get('nombre_curso');
        return $resultado->row(); 
    }


    public function save_nombre_curso($data)
    {
        // Almacena un nombre_curso listo para ser instanciado
        return $this->db->insert('nombre_curso', $data); 
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('nombre_curso', $data);
    } 

    /**
     * ELIMINAR
     * Actualiza un campo en la tabla nombre_curso que sirve como
     * contador. En base a este contador se genera un serial 
     * único para cada nombre_curso
     *
     * @param integer $id_curso
     * @return void
     */
    // public function actualizar_conteo_instancia($id_curso)
	// {
	// 	$nombre_curso = $this->get_nombre_curso($id_curso);
        
    //     $data = array(
    //         'veces_instanciado' => $nombre_curso->veces_instanciado + 1
    //     );
        
    //     $this->update($id_curso, $data);
	// }
}
