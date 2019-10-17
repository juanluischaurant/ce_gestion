<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function login($username, $password) {
        $this->db->where('username_usuario', $username);
        $this->db->where('password_usuario', $password);

        $resultados = $this->db->get('usuario');
        if($resultados->num_rows() > 0) {
            return $resultados->row();
        }
        else {
            return false;
        }
    }
}
