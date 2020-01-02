<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodos_model extends CI_Model {

    // Estas dos funciones sirven para unir las tablas relacionadas a la tabla "dictado"
    public function getPeriodos()
    {
        $resultados = $this->db->select(
            'p.id_periodo, 
            concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(p.fecha_inicio_periodo)) as nombre_periodo,
            p.fecha_inicio_periodo,
            p.fecha_culminacion_periodo,
            p.fecha_creacion'
        )
        ->from('periodo as p')
        ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 
        ->get(); 
        return $resultados->result();
    }
    
    public function get_periodo($id_periodo)
    {
        $resultados = $this->db->select(
            'p.id_periodo, 
            concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(p.fecha_inicio_periodo)) as nombre_periodo,
            p.fecha_inicio_periodo,
            p.fecha_culminacion_periodo,
            p.fecha_creacion'
        )
        ->from('periodo as p')
        ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 
        ->where('p.id_periodo', $id_periodo)
        ->get(); 
        return $resultados->row();
    }

    public function save($data)
    {
        

        if($this->db->insert("periodo", $data))
        {
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
		
    }

    public function update($id_periodo, $data)
    {
        $this->db->where('id_periodo', $id_periodo);

        if($this->db->update('periodo', $data))
        {
            return true;
        }
        else{
            return false;
        }
        
    } 

    /**
     * Consulta la BD y obtiene una lista de todos los meses disponibles
     * para luego almacenrla en un array que es retornado
     *
     * @return array
     */
    public function meses_dropdown()
    {
        $query = $this->db->from('mes')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id_mes] = $row->nombre_mes;
        }

        return $array;
    }
}