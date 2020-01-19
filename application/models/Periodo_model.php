<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Titular_model extends CI_Model {

    // Estas dos funciones sirven para unir las tablas relacionadas a la tabla "dictado"
    public function get_periodos()
    {
        $SQL = "SELECT
        p.id_periodo, 
        concat(mi.nombre_mes, '-', mc.nombre_mes, ' ', YEAR(p.fecha_inicio_periodo)) as nombre_periodo,
        p.fecha_inicio_periodo,
        p.fecha_culminacion_periodo,
        p.fecha_creacion,
        (SELECT COUNT(*) as instancias_asociadas FROM instancia WHERE instancia.fk_id_periodo_1 = p.id_periodo) AS instancias_asociadas
      FROM periodo AS p
      JOIN mes AS mi ON p.mes_inicio_periodo = mi.id_mes
      JOIN mes AS mc ON p.mes_cierre_periodo = mc.id_mes
      WHERE p.estado_periodo = 1";

      $resultados = $this->db->query($SQL);

      return $resultados->result();

        // $resultados = $this->db->select(
        //     'p.id_periodo, 
        //     concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(p.fecha_inicio_periodo)) as nombre_periodo,
        //     p.fecha_inicio_periodo,
        //     p.fecha_culminacion_periodo,
        //     p.fecha_creacion'
        // )
        // ->from('periodo as p')
        // ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes') 
        // ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 
        // ->get(); 
        // return $resultados->result();
    }
    
    public function get_periodo($id_periodo)
    {
        $resultado = $this->db->select(
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
        return $resultado->row();
    }

    /**
     * Obtén un conteo de las instancias asociadas a determinado período
     * 
     * Método principalmente utilizado al momento de intentar eliminar un período,
     * verifica cuántas instancias estan asociadas a determinado período. 
     *
     * @return boolean
     */
    public function count_instancias_asociadas($id_periodo)
    {
        $SQL = "SELECT
        concat(mi.nombre_mes, '-', mc.nombre_mes, ' ', YEAR(p.fecha_inicio_periodo)) as nombre_periodo,
        (SELECT COUNT(*) as instancias_asociadas FROM instancia WHERE instancia.fk_id_periodo_1 = p.id_periodo) AS instancias_asociadas
        FROM periodo AS p
        JOIN mes AS mi ON p.mes_inicio_periodo = mi.id_mes
        JOIN mes AS mc ON p.mes_cierre_periodo = mc.id_mes
        WHERE p.id_periodo = " . $id_periodo;

      $resultado = $this->db->query($SQL);

      return $resultado->row();
    }

    public function save($data)
    {
        if($this->db->insert("periodo", $data))
        {
            return TRUE;
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

    public function delete($id_periodo)
    {
        $data = array('estado_periodo' => 0);
      
        $this->db->set($data);
        $this->db->where('id_periodo', $id_periodo);
        $this->db->limit(1);

        // if($this->db->delete('periodo'))
        if($this->db->update('periodo'))
        {
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
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

    public function verificar_validez_periodo($id_periodo)
    {
        $resultado = $this->db->select(
            'per.id_periodo,
            per.fecha_inicio_periodo,
            per.fecha_culminacion_periodo'
        )
        ->from('periodo AS per')
        ->where('per.id_periodo', $id_periodo)
        ->get()
        ->row();
     
        // Obtén fecha de hoy del sistema
        $today = date('Y-m-d');

        if($resultado->fecha_culminacion_periodo >= $today)
        {
            return TRUE;
        }
        else if($resultado->fecha_inicio_periodo < $today)
        {
            return FALSE;
        }
    }
}