<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones_model extends CI_Model {

    public function lastID() {
        return $this->db->insert_id();
   
    }
    
    public function save($data) {
		return $this->db->insert("inscripcion",$data);
    }
    
    public function getInscripciones() {
        // Obtén todas las inscripciones realizadas
        $resultados = $this->db->select(
            'inscripcion_curso.fk_id_inscripcion_1, 
            inscripcion.hora_inscripcion, 
            concat(curso.nombre_curso, " ", p.mes_inicio_periodo, "-", p.mes_cierre_periodo, " ", p.year_periodo) as nombre_completo_instancia, cliente.cedula_cliente,
            inscripcion_curso.id_inscripcion_curso')
        ->from('inscripcion_curso')
        ->join('inscripcion', 'inscripcion.id_inscripcion = inscripcion_curso.fk_id_inscripcion_1')
        ->join('cliente', 'cliente.id_cliente = inscripcion.fk_id_participante_1')
        ->join('instancia', 'instancia.id_instancia = inscripcion_curso.fk_id_curso_1')
        ->join('periodo as p', 'id_periodo = instancia.fk_id_periodo_1')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->get();

        return $resultados->result();
    }

    public function getInscripcion($id_inscripcion) {
        // Obtén todas las inscripciones realizadas
        // Método utilizado principalmente para generar la ficha de inscripción
        $resultado = $this->db->select(
            'inscripcion.hora_inscripcion, 
            inscripcion.monto_pagado,
            inscripcion.precio_total,
            inscripcion.descuento,
            inscripcion.precio_final,
            cliente.cedula_cliente,
            concat(cliente.nombres_cliente, " ", cliente.apellidos_cliente) as nombre_completo_cliente,
            cliente.direccion_cliente,
            cliente.telefono_cliente')
        ->from('inscripcion')
        ->join('cliente', 'cliente.id_cliente = inscripcion.fk_id_participante_1')
        ->where('inscripcion.id_inscripcion', $id_inscripcion)
        ->get();

        return $resultado->row();
    }
    
    public function getInscripcionCurso($id) {
        // Obtén los cursos comprados en una inscripción
        // Método utilizado principalmente para generar la ficha de inscripción
        $resultado = $this->db->select(
            'inscripcion_curso.fk_id_inscripcion_1, 
            concat(curso.nombre_curso, " ", mes_inicio_periodo, "-", mes_cierre_periodo, " ", periodo.year_periodo) as nombre_completo_instancia,
            instancia.precio_instancia,
            inscripcion_curso.id_inscripcion_curso')
        ->from('inscripcion_curso')
        ->join('instancia', 'instancia.id_instancia = inscripcion_curso.fk_id_curso_1')
        ->join('periodo', 'id_periodo = instancia.fk_id_periodo_1')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->where('inscripcion_curso.fk_id_inscripcion_1 ', $id)
        ->get();

        return $resultado->result();
    }

    public function getPagoInscripcion($id_inscripcion) {
        // Obtén los pagos realizados en una inscripción
        // Método utilizado principalmente para generar la ficha de inscripción
        $resultado = $this->db->select(
            'pago_de_inscripcion.*')
        ->from('pago_de_inscripcion')
        ->where('fk_id_inscripcion', $id_inscripcion)
        ->get();

        return $resultado->result();
    }

    public function updateIdInscripcion($id_pago,$data) {
        // Actualiza la clave foránea fk_id_inscripcion 
        $this->db->where("id_pago",$id_pago);
        $this->db->update("pago_de_inscripcion",$data);
      }

    public function getCursosJSON($valor) {
        $this->db->select('id_curso, nombre_curso as label, cupos_curso, precio_actual_curso, descripcion_curso');
        $this->db->from('curso');
        $this->db->like('nombre_curso', $valor);

        $resultados = $this->db->get();

        return $resultados->result_array();
    } 

    public function getInstanciasJSON($valor) {
        // Obtén los registros de instancia de los cursos

        $resultados = $this->db->select('instancia.id_instancia, 
        instancia.cupos_instancia, 
        curso.nombre_curso,
        instancia.precio_instancia,
        concat(curso.nombre_curso, " ", periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", periodo.year_periodo) as label,
        concat(periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", periodo.year_periodo) as periodo_academico')
        ->from('instancia')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = instancia.fk_id_periodo_1')
        // ->where('instancia.estado_instancia', 1)
        ->like('nombre_curso', $valor)
        ->get();

        return $resultados->result_array();
    } 

    
    public function getPagosJSON($valor) {
        $this->db->select('id_pago, serial_pago, 
        concat(numero_operacion, " - ", nombres_cliente, " ", apellidos_cliente) as label, monto_operacion, 
        numero_operacion, 
        concat(nombres_cliente, " ", apellidos_cliente) as nombre_cliente, 
        cedula_cliente, 
        fk_id_tipo_operacion');
        $this->db->from('cliente');
        $this->db->join('pago_de_inscripcion', 'cliente.id_cliente = pago_de_inscripcion.fk_id_pagador');
        
        
        if($valor != '')
        {
            $this->db->like('numero_operacion', $valor);
			$this->db->or_like('nombres_cliente', $valor);
        }
        

        $valor=$this->db->get();
        return $valor->result_array();
    }

}