<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Este modelo se carga de manera automática
// Para verificar donde se autocarga, visitar el directorio: application/config/autoload.php

class Backend_model extends CI_Model {
    
    /**
     * Obtén ID correspondiente al enlace
     * 
     * Permite obetner el ID correcto del controlador en el que se encuentra
     * el navegador.
     *
     * @param string $enlace
     * @return array
     */
    public function get_id($enlace)
    {
        $this->db->like('enlace', $enlace);

        $resultado = $this->db->get('menu');

        return $resultado->row();
    }

    /**
     * Obtén permisos correspondientes al usuario
     * 
     * Consulta en la base de datos la lista de menús correspondientes al
     * usuario con la sesión iniciada.
     *
     * @param integer $id_menu
     * @param integer $id_rol
     * @return array
     */
    public function get_permisos_usuario($id_menu, $id_rol)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->where('id_rol', $id_rol);

        $resultado = $this->db->get('permiso');

        return $resultado->row();
    }
}