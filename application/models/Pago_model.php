<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago_model extends CI_Model {

  /**
   * Obtener pagos
   * 
   * Obtiene una lista de pagos realizados.
   *
   * @return void
   */
  public function get_pagos()
  {
    $resultados = $this->db->select(
      'pdi.id, 
      pdi.numero_referencia_bancaria, 
      pdi.monto_operacion, 
      pdi.estatus_pago,
      pdi.fecha_registro, 
      per.cedula'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('titular as ti', 'ti.cedula_persona = pdi.cedula_titular')
    ->join('persona as per', 'per.cedula = ti.cedula_persona')
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
            'pdi.id,
            pdi.numero_referencia_bancaria,
            pdi.monto_operacion,
            pdi.estatus_pago,
            pdi.fecha_registro, 
            pdi.id_tipo_de_operacion,
            concat(per.primer_nombre, " ", per.apellidos) as nombre_titular,
            per.cedula'
        )
        ->from('pago_de_inscripcion as pdi')
        ->join('titular as ti', 'ti.cedula_persona = pdi.cedula_titular')
        ->join('persona as per', 'per.cedula = ti.cedula_persona')
        ->where('pdi.estatus_pago', 1)
        ->get();

        return $resultados->result();
    }

  public function get_pago($id)
  {
    $resultados = $this->db->select(
      'pdi.id, 
      pdi.numero_referencia_bancaria, 
      pdi.monto_operacion, 
      pdi.fecha_registro, 
      pdi.fecha_operacion,
      pdi.id_inscripcion,
      pdi.cedula_titular,
      tdo.id,
      b.id AS id_banco,
      b.nombre AS nombre_banco,
      per.primer_nombre,
      per.apellidos'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('tipo_de_operacion as tdo', 'tdo.id = pdi.id_tipo_de_operacion')
    ->join('banco as b', 'b.id = pdi.id_banco')
    ->join('titular as ti', 'ti.cedula_persona = pdi.cedula_titular')
    ->join('persona as per', 'per.cedula = ti.cedula_persona')
    ->where('pdi.id', $id)
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
    $this->db->where("id", $id);
    $resultado = $this->db->get("tipo_de_operacion");
    return $resultado->row();
  }

  /**
   * Insertar un registro en la tabla indicada dentro del método
   *
   * @param array $data
   * @return void
   */
  public function save($data)
  {
    return $this->db->insert("pago_de_inscripcion",$data);
  }
  
  /**
   * Insertar pago
   * 
   * Este método llama al procedimiento almacenado que se especifíca debajo, 
   * dicho procedimiento se encarga de insertar registro en la tabla de pago
   * de inscripción, y además aumenta el contador de tipo de operación.
   *
   * @param array $data
   * @return void
   */
  public function insertar_pago_procedure($data)
  {
    $SQL = "CALL insertar_pago_nuevo(?, ?, ?, ?, ?, ?)";

    return $query = $this->db->query($SQL, $data);

  }

  public function update($id_pago, $data)
  {
      $this->db->where('id', $id_pago);
      return $this->db->update('pago_de_inscripcion', $data);
  }

  /**
   * Realiza una consulta donde solo se retornan pocos parámetros.
   * Este método se utiliza en el módulo de pago al momento de editar
   * un pago para verificar su estado actual.
   *
   * @param integer $id_pago
   * @return void
   */
  public function get_estatus_pago($id_pago)
  {
    $resultados = $this->db->select(
      'pdi.id,
      pdi.estatus_pago'
      )
    ->from('pago_de_inscripcion as pdi')
    ->where('pdi.id', $id_pago)
    ->get();

    return $resultados->row();
  }

  /**
   * Actualiza estatus de pago
   * 
   * Al realizar una inscripción el estatus de pago debe cambiar a
   * "utilizado", esta función permite lograr dicha tarea.
   *
   * @param integer $id_pago
   * @return void
   */
  public function actualiza_estatus_pago($id_pago)
  {
    $data = array(
      'estatus_pago' => 2
    );
    $this->db->where("id",$id_pago);
    $this->db->update("pago_de_inscripcion", $data);
  }
    
  public function save_inscripcion_instancia($data)
  {
    $this->db->insert("inscripcion_instancia",$data);
  }
  
  /**
   * Pago Único
   * 
   * Verifica en la base de datos que un número de operación sea único.
   * Retorna TRUE de no existir un número de pago similar, para caso
   * contrario retorna FALSE.
   *
   * @param string $numero_referencia_bancaria
   * @return void
   */
  public function pago_unico($numero_referencia_bancaria)
  {
    $resultado = $this->db->select(
      'pdi.numero_referencia_bancaria'
      )
    ->from('pago_de_inscripcion as pdi')
    ->where('pdi.numero_referencia_bancaria', $numero_referencia_bancaria)
    ->get();

    if($resultado->num_rows() < 1)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
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
      't.cedula_persona, 
      concat(p.primer_nombre, " ", p.apellidos) as nombre_titular, 
      p.cedula as label'
    )
      ->from('titular as t')
      ->join('persona as p', 'p.cedula = t.cedula_persona')

      ->like('p.cedula', $valor)

      ->get();

      return $resultados->result_array();
      
  }   

  public function get_bancos_json($valor)
  {
    $this->db->select(
      'id, 
      nombre as label'
    );
    $this->db->from('banco');
    $this->db->like('nombre', $valor);

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
            'pi.numero_referencia_bancaria,
            pi.estatus_pago,
            pi.monto_operacion,
            pi.id,
            pi.estatus_pago,
            pi.id_tipo_de_operacion,
            concat(pi.numero_referencia_bancaria, " - ID: ", pe.cedula) as label,
            concat(pe.primer_nombre, " ", pe.apellidos) as nombre_cliente,
            pe.cedula'
        )
        ->from('pago_de_inscripcion as pi')
        ->join('titular as t', 't.cedula_persona = pi.cedula_titular')
        ->join('persona as pe', 'pe.cedula = t.cedula_persona');
                
        if($valor !== '')
        {
            // Para realizar esta consulta, se utilizó como referencia este
            // hilo de StackOverflow:
            // https://stackoverflow.com/questions/41113805/codeigniter-like-or-like-doesnt-work-with-where
            $resultados->where('pi.estatus_pago', 1)
            ->like('pi.numero_referencia_bancaria', $valor)
            
            ->or_where('pi.estatus_pago', 1)
            ->like('pe.cedula', $valor, 'after')
            
            ->or_where('pi.estatus_pago', 3)
            ->like('pe.cedula', $valor, 'after');
        }

        $resultados = $this->db->get();
        return $resultados->result_array();
    }
    // Fin: Métodos utilizadas para el pluggin AUTOCOMPLETE
}