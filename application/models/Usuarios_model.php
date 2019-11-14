<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo Usuarios
 */
class Usuarios_model extends CI_Model {

    /**
     * Permite el acceso al sistema. Recibe dos parámetros, dichos parametros
     * se utilizan para consultar la base de datos y verificar que las credenciales
     * ingresadas corresponden a algún usuario válido
     *
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login($username, $password)
    {
        $this->db->where('username_usuario', $username);
        $this->db->where('password_usuario', $password);

        // Consulta BD
        $resultados = $this->db->get('usuario');

        if($resultados->num_rows() > 0)
        {
            // Returna registro
            return $resultados->row();
        }
        else
        {
            return false;
        }
    }

    
}
