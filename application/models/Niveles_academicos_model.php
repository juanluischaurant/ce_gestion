<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Niveles_academicos_model extends CI_Model {

    /**
     * Consulta la BD y obtiene una lista de todos los niveles académicos disponibles
     * para luego almacenarlos en un array que es retornado, el método se 
     * utiliza para generar un elemento DROPDOWN HTML
     *
     * @return array
     */
    public function niveles_academicos_dropdown()
    {
        $query = $this->db->from('nivel_academico')
        ->get();

        foreach($query->result() as $nivel)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$nivel->id_nivel_academico] = $nivel->nombre_nivel_academico;
        }

        return $array;
    }

}