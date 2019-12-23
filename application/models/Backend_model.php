<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Este modelo se carga de manera automática
// Para verificar donde se autocarga, visitar el directorio: application/config/autoload.php

class Backend_model extends CI_Model {
    
    public function get_id($enlace)
    {
        $this->db->like('enlace_menu', $enlace);

        $resultado = $this->db->get('menu');

        return $resultado->row();
    }

    public function get_permisos_usuario($id_menu, $rol)
    {
        $this->db->where('fk_id_menu_1', $id_menu);
        $this->db->where('fk_id_rol_2', $rol);

        $resultado = $this->db->get('permiso');

        return $resultado->row();
    }
}