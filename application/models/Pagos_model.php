<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos_model extends CI_Model {

  public function getPagos() {
    // Obtén una lista de pagos realizados
    $resultados = $this->db->select(
      'pago_de_inscripcion.id_pago, 
      pago_de_inscripcion.numero_operacion, 
      pago_de_inscripcion.monto_operacion, 
      pago_de_inscripcion.fecha_registro_operacion, 
      cliente.cedula_cliente'
    )
    ->from('pago_de_inscripcion')
    ->join('cliente', 'cliente.id_cliente = pago_de_inscripcion.fk_id_pagador')
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
    
    public function saveInscripcionCurso($data){
		$this->db->insert("inscripcion_curso",$data);
	}

    // Métodos utilizadas para el pluggin AUTOCOMPLETE
    public function getClientesJSON($valor) {
        $this->db->select('id_cliente, concat(nombres_cliente, " ", apellidos_cliente) as nombre_cliente, cedula_cliente as label');
        $this->db->from('cliente');
        $this->db->like('cedula_cliente', $valor);

        $resultados = $this->db->get();

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