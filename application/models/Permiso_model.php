<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase Permisos
 * 
 * Gestiona lo referente a Permisos de Usuario dentro de
 * CE Gestión, cada uno con nivel de accesibilidad asignado
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Permiso_model extends CI_Model {

    public function get_permisos()
    {
        $resultados = $this->db->select(
            'permiso.*,
            menu.nombre,
            rol.funcion'
        )
        ->from('permiso')
        ->join('rol', 'permiso.id_rol = rol.id')
        ->join('menu', 'permiso.id_menu = menu.id')
        ->get();

        return $resultados->result();    
    }

    public function save($data)
    {
        return $this->db->insert('permiso', $data);
    }

    /**
     * Consulta la BD y obtiene una lista de todos los menus disponibles
     * para luego almacenrla en un array que es retornado, el método se 
     * utiliza para generar un elemento DROPDOWN HTML
     *
     * @return array
     */
    public function menus_dropdown()
    {
        $query = $this->db->from('menu')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id] = $row->nombre;
        }

        return $array;
    }

}