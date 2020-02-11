<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodo_model extends CI_Model {

    /**
     * Obtener períodos
     * 
     * Obtén una lista de períodos registrados en el sistema
     *
     * @return void
     */
    public function get_periodos()
    {
        // Cambia el idioma del set de resultados a generar
        $this->db->query("SET lc_time_names = 'es_ES';");
        
        $SQL = "SELECT
        p.id, 
        concat(MONTHNAME(p.fecha_inicio), '-', MONTHNAME(p.fecha_culminacion), ' ', YEAR(p.fecha_inicio)) as nombre_periodo,
        p.fecha_inicio,
        p.fecha_culminacion,
        p.fecha_registro,
        (SELECT COUNT(*) as instancias_asociadas FROM curso WHERE curso.id_periodo = p.id) AS instancias_asociadas
      FROM periodo AS p
      WHERE p.estado = 1";

      $resultados = $this->db->query($SQL);

      return $resultados->result();
    }
    
    public function get_periodo($id_periodo)
    {
        $this->db->query("SET lc_time_names = 'es_ES'; -- Cambia el idioma a Españolp.id_periodo, ");

        $resultado = $this->db->select(
            'p.id, 
            concat(MONTHNAME(p.fecha_inicio), "-", MONTHNAME(p.fecha_culminacion), " ", YEAR(p.fecha_inicio)) as nombre_periodo,
            p.fecha_inicio,
            p.fecha_culminacion,
            p.fecha_registro'
        )
        ->from('periodo as p')
        ->where('p.id', $id_periodo)
        ->get(); 
        return $resultado->row();
    }

    /**
     * Obtén un conteo de las cursos asociados a determinado período
     * 
     * Método principalmente utilizado al momento de intentar eliminar un período,
     * verifica cuántas cursos estan asociadas a determinado período. 
     *
     * @return boolean
     */
    public function count_instancias_asociadas($id_periodo)
    {
        $SQL = "SELECT
        concat(MONTHNAME(p.fecha_inicio), '-', MONTHNAME(p.fecha_culminacion), ' ', YEAR(p.fecha_inicio)) as nombre_periodo,
        (SELECT COUNT(*) as instancias_asociadas FROM curso WHERE curso.id_periodo = p.id) AS instancias_asociadas
        FROM periodo AS p
        WHERE p.id = " . $id_periodo;

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
        $this->db->where('id', $id_periodo);

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
     * Obtén el ID del último registro realizado
     *
     * @return void
     */
    public function lastID()
    {
        return $this->db->insert_id();
    }

    public function verificar_validez_periodo($id_periodo)
    {
        $resultado = $this->db->select(
            'p.id,
            p.fecha_inicio,
            p.fecha_culminacion'
        )
        ->from('periodo AS p')
        ->where('p.id', $id_periodo)
        ->get()
        ->row();
     
        // Obtén fecha de hoy del sistema
        $today = date('Y-m-d');

        if($resultado->fecha_culminacion >= $today)
        {
            return TRUE;
        }
        else if($resultado->fecha_inicio < $today)
        {
            return FALSE;
        }
    }
}