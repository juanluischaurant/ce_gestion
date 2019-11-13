<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acciones_model extends CI_Model
{
    public function save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada)
    {
        $data = array(
            'fk_id_usuario' => $fk_id_usuario,
            'fk_id_tipo_accion' => $fk_id_tipo_accion,
            'descripcion_accion' => $descripcion_accion,
            'tabla_afectada' => $tabla_afectada
        );

        return $this->db->insert('accion', $data);
        
        if ($consulta==true) {
            return true;
        } else {
            return false;
        }
    }
}
