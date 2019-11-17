<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locaciones_model extends CI_Model {

    // Estas dos funciones sirven para unir las tablas relacionadas a la tabla "dictado"
    public function getLocaciones()
    {
        $resultados = $this->db->select(
            'l.id_locacion, 
            l.nombre_locacion,
            l.fecha_creacion,
            l.direccion_locacion'
        )
        ->from('locacion as l')   
        ->get(); 

        return $resultados->result();
    }

    public function save($data)
    {
        // Almacena un curso listo para ser instanciado
        return $this->db->insert('locacion', $data); 
    }


}