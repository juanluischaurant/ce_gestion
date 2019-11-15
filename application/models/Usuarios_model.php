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

    public function get_usuarios()
    {
        $resultados = $this->db->select(
            'u.*,
            r.nombre_rol as rol'
            )
            ->from('usuario as u')
            ->join('rol as r', 'r.rol_id = u.fk_rol_id_1') 
            ->where('estado_usuario', 1)
            ->get(); 
    
        return $resultados->result();
    }

    /**
     * Consulta la BD y obtiene una lista de todos los turnos disponibles
     * para luego almacenrla en un array que es retornado
     *
     * @return array
     */
    public function roles_dropdown()
    {
        $query = $this->db->from('rol')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row) {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->rol_id] = $row->nombre_rol;
        }

        return $array;
    }

    public function save($data)
    {
        return $this->db->insert('usuario', $data);
    }

}
