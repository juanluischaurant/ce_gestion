<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos_model extends CI_Model {

  public function getPagos() {
    // Obtén una lista de pagos realizados
    $resultados = $this->db->select(
      'pdi.id_pago, 
      pdi.numero_operacion, 
      pdi.monto_operacion, 
      pdi.fecha_registro_operacion, 
      cli.id_cliente,
      per.cedula_persona'
    )
    ->from('pago_de_inscripcion as pdi')
    ->join('titular as cli', 'cli.id_cliente = pdi.fk_id_cliente')
    ->join('persona as per', 'per.persona_id = cli.fk_id_persona_1')
    // ->where('instancia.estado_instancia', '1')
    ->get();

    return $resultados->result();
  }

	public function getTiposDeOperacion() {
        $resultados = $this->db->get('tipo_de_operacion'); 
        return $resultados->result();
  }

    public function getTipoDeOperacion($id) {
      $this->db->where("id_tipo_de_operacion", $id);
		  $resultado = $this->db->get("tipo_de_operacion");
		  return $resultado->row();
    }

    public function save($data) {
		return $this->db->insert("pago_de_inscripcion",$data);
	}

	public function lastID() {
		return $this->db->insert_id();
    }
    
    public function updateConteoOperaciones($idOperacion,$data) {
      $this->db->where("id_tipo_de_operacion",$idOperacion);
      $this->db->update("tipo_de_operacion",$data);
    }

    public function updateIdInscripcion($id_pago) {
      $data = array(
        'estado_pago' => 2
      );
      $this->db->where("id_pago",$id_pago);
      $this->db->update("pago_de_inscripcion", $data);
    }
    
    public function saveInscripcionCurso($data){
		$this->db->insert("inscripcion_curso",$data);
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
        'cli.id_cliente, 
        concat(per.nombres_persona, " ", per.apellidos_persona) as nombre_cliente, 
        per.cedula_persona as label'
      )
        ->from('titular as cli')
        ->join('persona as per', 'per.persona_id = cli.fk_id_persona_1')

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
    // Fin: Métodos utilizadas para el pluggin AUTOCOMPLETE
}