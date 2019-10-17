<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodos_model extends CI_Model {

    // Estas dos funciones sirven para unir las tablas relacionadas a la tabla "dictado"
	public function getPeriodos() {

        $resultados = $this->db->select(
            'p.id_periodo, 
            concat(p.mes_inicio_periodo, "-", p.mes_cierre_periodo, " ", p.year_periodo) as nombre_periodo'
        )
        ->from('periodo p')   
        ->get(); 
        return $resultados->result();
    }

    public function save($data) {
		return $this->db->insert("periodo",$data);
    }

}