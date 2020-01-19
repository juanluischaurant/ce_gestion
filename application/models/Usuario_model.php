<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo Usuario
 */
class Usuario_model extends CI_Model {

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
        $this->db->where('password_usuario', sha1($password));

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

    /**
     * Obtén lista de usuarios registrados en el sistema
     *
     * @return array
     */
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
     * Obtén los datos de un usuario en específico
     *
     * @return void
     */
    public function get_usuario($id_usuario)
    {
        $resultado = $this->db->select(
            'u.*,
            r.nombre_rol')
        ->from('usuario as u')
        ->join('rol as r', 'r.rol_id = u.fk_rol_id_1')
        ->where('u.id_usuario', $id_usuario)
        ->get();

        return $resultado->row();
    }

    /**
     * Consulta la BD y obtiene una lista de todos los roles disponibles
     * para luego almacenrla en un array que es retornado, el método se 
     * utiliza para generar un elemento DROPDOWN HTML
     *
     * @return array
     */
    public function roles_dropdown()
    {
        $query = $this->db->from('rol')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row)
        {
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

    public function update($id, $data)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('usuario', $data);
    }


}
