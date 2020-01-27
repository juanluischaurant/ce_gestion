<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accion_model extends CI_Model
{
    /**
     * Prepara e inserta datos dentro de la tabla Acción. Utilizada
     * al realizar distintas operaciones a lo largo de la aplicación
     *
     * @param integer $fk_id_usuario
     * @param integer $fk_id_tipo_accion
     * @param string $descripcion_accion
     * @param string $tabla_afectada
     * @return boolean
     */
    public function save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada)
    {
        $data = array(
            'id_usuario' => $fk_id_usuario,
            'id_tipo_accion' => $fk_id_tipo_accion,
            'descripcion' => $descripcion_accion,
            'tabla_afectada' => $tabla_afectada
        );

        return $this->db->insert('accion', $data);
    }

    /**
     * Retorna lista de acciones realizadas dentro de CE Gestión
     *
     * @return array
     */
    public function get_acciones()
    {
        $resultados = $this->db->select(
            'a.id,
            a.id_usuario,
            a.id_tipo_accion,
            a.descripcion,
            a.tabla_afectada,
            a.fecha_registro,
            ta.nombre,
            u.username')
            ->from('accion as a')
            ->join('tipo_de_accion as ta', 'ta.id = a.id_tipo_accion')
            ->join('usuario as u', 'u.id = a.id_usuario')
            ->get(); 
    
            return $resultados->result();
    }

}