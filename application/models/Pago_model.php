<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago_model extends CI_Model {

  public function get_pagos() {
    // Obtén una lista de pagos realizados
    $resultados = $this->db->select(
      'pdi.id, 
      pdi.numero_transferencia, 
      pdi.monto_operacion, 
      pdi.estado,
      pdi.fecha_registro, 
      ti.id,
      per.cedula'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('titular as ti', 'ti.id = pdi.id_titular')
    ->join('persona as per', 'per.id = ti.id_persona')
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
            pdi.numero_transferencia,
            pdi.monto_operacion,
            pdi.estado,
            pdi.fecha_registro, 
            pdi.id_tipo_de_operacion,
            ti.id,
            concat(per.nombres, " ", per.apellidos) as nombre_titular,
            per.cedula'
        )
        ->from('pago_de_inscripcion as pdi')
        ->join('titular as ti', 'ti.id = pdi.id_titular')
        ->join('persona as per', 'per.id = ti.id_persona')
        ->where('pdi.estado', 1)         
        ->get();

        return $resultados->result();
    }

  public function get_pago($id)
  {
    $resultados = $this->db->select(
      'pdi.id, 
      pdi.numero_transferencia, 
      pdi.serial, 
      pdi.monto_operacion, 
      pdi.fecha_registro, 
      pdi.estado,
      pdi.fecha_operacion,
      pdi.fk_id_inscripcion,
      tdo.tipo_de_operacion,
      b.id_banco,
      b.nombre_banco,
      ti.id,
      per.cedula,
      per.nombres,
      per.apellidos'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('tipo_de_operacion as tdo', 'tdo.id_tipo_de_operacion = pdi.id_tipo_de_operacion')
    ->join('banco as b', 'b.id_banco = pdi.fk_id_banco')
    ->join('titular as ti', 'ti.id = pdi.id_titular')
    ->join('persona as per', 'per.id = ti.id_persona')
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
    $this->db->where("id_tipo_de_operacion", $id);
    $resultado = $this->db->get("tipo_de_operacion");
    return $resultado->row();
  }

  /**
   * Insertar un registro en la tabla indicada dentro del método
   *
   * @param [type] $data
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
   * @param [type] $data
   * @return void
   */
  public function insertar_pago_procedure($data)
  {
    $SQL = "CALL insertar_pago_nuevo(?, ?, ?, ?, ?, ?, ?)";

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
   * @param [type] $id_pago
   * @return void
   */
  public function get_estado_pago($id_pago)
  {
    $resultados = $this->db->select(
      'pdi.id,
      pdi.estado'
      )
    ->from('pago_de_inscripcion as pdi')
    ->where('pdi.id', $id_pago)
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
      'estado' => 2
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
   * @param string $numero_operacion
   * @return void
   */
  public function pago_unico($numero_operacion)
  {
    $resultado = $this->db->select(
      'pdi.numero_transferencia'
      )
    ->from('pago_de_inscripcion as pdi')
    ->where('pdi.numero_transferencia', $numero_operacion)
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
      'ti.id, 
      concat(per.nombres, " ", per.apellidos) as nombre_titular, 
      per.cedula as label'
    )
      ->from('titular as ti')
      ->join('persona as per', 'per.id = ti.id_persona')

      ->like('per.cedula', $valor)

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
            'pi.numero_operacion,
            pi.estado,
            pi.monto_operacion,
            pi.id,
            pi.estado,
            pi.fk_id_tipo_operacion,
            concat(pi.numero_operacion, " - ID: ", pe.cedula) as label,
            concat(pe.nombres_persona, " ", pe.apellidos_persona) as nombre_cliente,
            pe.cedula'
        )
        ->from('pago_de_inscripcion as pi')
        ->join('titular as c', 'c.id = pi.fk_id_titular')
        ->join('persona as pe', 'pe.id_persona = c.id_persona');
                
        if($valor !== '')
        {
            // Para realizar esta consulta, se utilizó como referencia este
            // hilo de StackOverflow:
            // https://stackoverflow.com/questions/41113805/codeigniter-like-or-like-doesnt-work-with-where
            $resultados->where('pi.estado', 1)
            ->like('pi.numero_operacion', $valor)
            
            ->or_where('pi.estado', 1)
            ->like('pe.cedula', $valor, 'after')
            
            ->or_where('pi.estado', 3)
            ->like('pe.cedula', $valor, 'after');
        }

        $resultados = $this->db->get();
        return $resultados->result_array();
    }
    // Fin: Métodos utilizadas para el pluggin AUTOCOMPLETE
}