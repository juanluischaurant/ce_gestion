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
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));

        // Consulta BD
        $resultado = $this->db->select(
            'persona.cedula,
            persona.primer_nombre,
            persona.primer_apellido,
            persona.correo_electronico,
            usuario.username,
            usuario.id_rol'
        )
        ->from('usuario') 
        ->join('persona', 'persona.cedula = usuario.cedula_persona')
        ->where('usuario.estado', 1)
        ->get(); 
    

        if($resultado->num_rows() > 0)
        {
            // Returna registro
            return $resultado->row();
        }
        else
        {
            return FALSE;
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
            p.primer_nombre,
            p.primer_apellido,
            p.correo_electronico,
            r.funcion as rol'
            )
            ->from('usuario as u')
            ->join('persona as p', 'p.cedula = u.cedula_persona') 
            ->join('rol as r', 'r.id = u.id_rol') 
            // ->where('estado', 1)
            ->get(); 
    
        return $resultados->result();
    }

    /**
     * Obtén los datos de un usuario en específico
     *
     * @return void
     */
    public function get_usuario($username)
    {
        $resultado = $this->db->select(
            'u.username,
            u.password,
            u.cedula_persona,
            u.id_rol,
            u.estado,
            u.fecha_registro,
            r.funcion AS rol,
            p.primer_nombre,
            p.primer_apellido,
            p.correo_electronico')
        ->from('usuario AS u')
        ->join('rol AS r', 'r.id = u.id_rol')
        ->join('persona AS p', 'p.cedula = u.cedula_persona')
        ->where('u.username', $username)
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
            $array[$row->id] = $row->funcion;
        }

        return $array;
    }

    public function save($data)
    {
        return $this->db->insert('usuario', $data);
    }

    public function update($username, $data)
    {
        $this->db->where('username', $username);
        return $this->db->update('usuario', $data);
    }


}
