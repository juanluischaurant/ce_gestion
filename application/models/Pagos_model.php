<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos_model extends CI_Model {

  public function get_pagos() {
    // Obtén una lista de pagos realizados
    $resultados = $this->db->select(
      'pdi.id_pago, 
      pdi.numero_operacion, 
      pdi.monto_operacion, 
      pdi.estado_pago,
      pdi.fecha_registro_operacion, 
      ti.id_titular,
      per.cedula_persona'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('titular as ti', 'ti.id_titular = pdi.fk_id_titular')
    ->join('persona as per', 'per.id_persona = ti.fk_id_persona_1')
    ->get();

    return $resultados->result();
  }

      /**
     * Obtén lista de pagos realizados pero no utilizados
     *
     * @return array
     */
    public function get_pagos_activos()
    {            
        $resultados = $this->db->select(
            'pdi.id_pago,
            pdi.numero_operacion,
            pdi.monto_operacion,
            pdi.estado_pago,
            pdi.serial_pago,
            pdi.fecha_registro_operacion, 
            pdi.fk_id_tipo_operacion,
            ti.id_titular,
            concat(per.nombres_persona, " ", per.apellidos_persona) as nombre_titular,
            per.cedula_persona'
        )
        ->from('pago_de_inscripcion as pdi')
        ->join('titular as ti', 'ti.id_titular = pdi.fk_id_titular')
        ->join('persona as per', 'per.id_persona = ti.fk_id_persona_1')
        ->where('pdi.estado_pago', 1)         
        ->get();

        return $resultados->result();
    }

  public function get_pago($id_pago)
  {
    $resultados = $this->db->select(
      'pdi.id_pago, 
      pdi.numero_operacion, 
      pdi.serial_pago, 
      pdi.monto_operacion, 
      pdi.fecha_registro_operacion, 
      pdi.estado_pago,
      pdi.fecha_operacion,
      pdi.fk_id_inscripcion,
      tdo.tipo_de_operacion,
      b.id_banco,
      b.nombre_banco,
      ti.id_titular,
      per.cedula_persona,
      per.nombres_persona,
      per.apellidos_persona'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('tipo_de_operacion as tdo', 'tdo.id_tipo_de_operacion = pdi.fk_id_tipo_operacion')
    ->join('banco as b', 'b.id_banco = pdi.fk_id_banco')
    ->join('titular as ti', 'ti.id_titular = pdi.fk_id_titular')
    ->join('persona as per', 'per.id_persona = ti.fk_id_persona_1')
    ->where('pdi.id_pago', $id_pago)
    ->get();

    return $resultados->row();
  }

  /**
   * Obtén los distintos tipos de pago registrados en la base de datos.
   * Esta función es utilizada principalmente para poblar la lista desplegable
   * en formularios que requieran una lista de tipos de pago
   *
   * @return void
   */
  public function get_tipos_de_operacion()
  {
    $resultados = $this->db->get('tipo_de_operacion'); 
    return $resultados->result();
  }

  public function get_tipo_de_operacion($id)
  {
    $this->db->where("id_tipo_de_operacion", $id);
    $resultado = $this->db->get("tipo_de_operacion");
    return $resultado->row();
  }

  public function save($data)
  {
    return $this->db->insert("pago_de_inscripcion",$data);
	}

  public function update($id_pago, $data)
  {
      $this->db->where('id_pago', $id_pago);
      return $this->db->update('pago_de_inscripcion', $data);
  }

  /**
   * Realiza una consulta donde solo se retornan pocos parámetros.
   * Este método se utiliza en el módulo de pago al momento de editar
   * un pago para verificar su estado actual.
   *
   * @param [type] $id_pago
   * @return void
   */
  public function get_estado_pago($id_pago)
  {
    $resultados = $this->db->select(
      'pdi.id_pago,
      pdi.estado_pago'
      )
    ->from('pago_de_inscripcion as pdi')
    ->where('pdi.id_pago', $id_pago)
    ->get();

    return $resultados->row();
  }

  public function lastID()
  {
		return $this->db->insert_id();
  }
    
  public function actualizar_conteo_operaciones($idOperacion,$data)
  {
    $this->db->where("id_tipo_de_operacion",$idOperacion);
    $this->db->update("tipo_de_operacion",$data);
  }

  public function actualiza_estado_pago($id_pago)
  {
    $data = array(
      'estado_pago' => 2
    );
    $this->db->where("id_pago",$id_pago);
    $this->db->update("pago_de_inscripcion", $data);
  }
    
  public function save_inscripcion_instancia($data)
  {
    $this->db->insert("inscripcion_instancia",$data);
	}


  // Métodos utilizadas para el pluggin AUTOCOMPLETE
  
  /**
   * Obtén titulares
   * 
   * Se encarga de consultar la tabla titular para obtener una lista de personas registradas
   * actualmente como titulares de pago.
   *
   * @param integer $valor
   * @return array
   */
  public function get_titulares_json($valor)
  {
    $resultados = $this->db->select(
      'ti.id_titular, 
      concat(per.nombres_persona, " ", per.apellidos_persona) as nombre_titular, 
      per.cedula_persona as label'
    )
      ->from('titular as ti')
      ->join('persona as per', 'per.id_persona = ti.fk_id_persona_1')

      ->like('per.cedula_persona', $valor)

      ->get();

      return $resultados->result_array();
      
  }   

    public function getBancosJSON($valor) {
        $this->db->select('id_banco, nombre_banco as label');
        $this->db->from('banco');
        $this->db->like('nombre_banco', $valor);

        $resultados = $this->db->get();

        return $resultados->result_array();
    }

       /**
     * Obtén lista de pagos realizados 
     *
     * @param integer $valor
     * @return array
     */
    public function get_pagos_json($valor)
    {
        $resultados = $this->db->select(
            'pi.serial_pago,
            pi.numero_operacion,
            pi.estado_pago,
            pi.monto_operacion,
            pi.id_pago,
            pi.estado_pago,
            pi.fk_id_tipo_operacion,
            concat(pi.numero_operacion, " - ID: ", pe.cedula_persona) as label,
            concat(pe.nombres_persona, " ", pe.apellidos_persona) as nombre_cliente,
            pe.cedula_persona'
        )
        ->from('pago_de_inscripcion as pi')
        ->join('titular as c', 'c.id_titular = pi.fk_id_titular')
        ->join('persona as pe', 'pe.id_persona = c.fk_id_persona_1');
                
        if($valor !== '')
        {
            // Para realizar esta consulta, se utilizó como referencia este
            // hilo de StackOverflow:
            // https://stackoverflow.com/questions/41113805/codeigniter-like-or-like-doesnt-work-with-where
            $resultados->where('pi.estado_pago', 1)
            ->like('pi.numero_operacion', $valor)
            
            ->or_where('pi.estado_pago', 1)
            ->like('pe.cedula_persona', $valor, 'after')
            
            ->or_where('pi.estado_pago', 1)
            ->like('pi.serial_pago', $valor, 'after')
            
            ->or_where('pi.estado_pago', 3)
            ->like('pe.cedula_persona', $valor, 'after')
            
            ->or_where('pi.estado_pago', 3)
            ->like('pi.serial_pago', $valor, 'after');
        }

        $resultados = $this->db->get();
        return $resultados->result_array();
    }
    // Fin: Métodos utilizadas para el pluggin AUTOCOMPLETE
}