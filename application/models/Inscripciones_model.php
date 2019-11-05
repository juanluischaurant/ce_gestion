<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones_model extends CI_Model {

    /**
     * Obtén el ID del último registro realizado
     *
     * @return void
     */
    public function lastID() {
        return $this->db->insert_id();
    }
    
    /**
     * Almacena los datos eviados por el usuario a través del controlador Inscripciones
     *
     * @param array $data
     * @return void
     */
    public function save($data) {
		return $this->db->insert("inscripcion",$data);
    }

    /**
     * Realiza consulta que retorna una lista de inscripciones realizadas
     * @return array
     */   
    public function getInscripciones() {
        $resultados = $this->db->select(
            'inscripcion_curso.fk_id_inscripcion_1, 
            inscripcion.hora_inscripcion, 
            concat(curso.nombre_curso, " ", p.mes_inicio_periodo, "-", p.mes_cierre_periodo, " ", p.year_periodo) as nombre_completo_instancia,
            pe.cedula_persona,
            inscripcion_curso.id_inscripcion_curso')
        ->from('inscripcion_curso')

        ->join('inscripcion', 'inscripcion.id_inscripcion = inscripcion_curso.fk_id_inscripcion_1')

        ->join('participante as par', 'par.id_participante = inscripcion.fk_id_participante_1')

        ->join('persona as pe', 'pe.persona_id = par.fk_id_persona_2')

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

    /**
     * Para comprobar si un participante está o no inscrito en un curso,
     * regresa una lista de todos los cursos donde el participante se encuentra registrado
     */
    public function participante_curso() {
        $resultados = $this->db->select('pa.id_participante, 
        pe.nombres_persona, 
        cu.id_curso,
        cu.nombre_curso')
        ->from('participante as pa')
        ->join('persona as pe', 'pe.persona_id = pa.fk_id_persona_2')
        ->join('inscripcion as in', 'in.fk_id_participante_1 = pa.id_participante')
        ->join('inscripcion_curso as ic', 'ic.fk_id_inscripcion_1 = in.id_inscripcion')
        ->join('instancia as it', 'it.id_instancia = ic.fk_id_curso_1')
        ->join('curso as cu', 'cu.id_curso = it.fk_id_curso_1')
        ->where('pa.id_participante', 3)
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén los registros de instancia de los cursos
     * 
     * Utilizado para consultar cursos en específico, se implementó este método
     * para ser utilizado en el módulo de Inscripciones. El método consulta información
     * en 3 varias tablas y regresa datos cómo por ejemplo: El ID de los participantes
     * registrados en un determinado curso.
     *
     * @param string $valor
     * @return array
     */
    public function getInstanciasJSON($valor) {
        $resultados = $this->db->select(
            'instancia.id_instancia, 
            instancia.cupos_instancia, 
            instancia.cupos_instancia_ocupados,
            instancia.precio_instancia,
            curso.nombre_curso,
            concat(curso.nombre_curso, " ", periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", periodo.year_periodo) as label,
            concat(periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", periodo.year_periodo) as periodo_academico'
        )
        ->from('instancia')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = instancia.fk_id_periodo_1')
        // ->where('instancia.estado_instancia', 1)
        ->like('curso.nombre_curso', $valor)
        ->get();

        return $resultados->result_array();
    } 

    public function getParticipantesJSON($valor) {
        $resultados = $this->db->select(
            'curso.nombre_curso,
            i.fk_id_participante_1'
         )
        ->from('instancia')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = instancia.fk_id_periodo_1')
        // Para consultar una lista de participantes inscritos en determinado curso,
        // puedes modificar este método agregando lo siguiente:
        ->join('inscripcion_curso as ic', 'ic.fk_id_curso_1 = instancia.id_instancia')
        ->join('inscripcion as i', 'i.id_inscripcion = ic.fk_id_inscripcion_1')
        ->where('instancia.id_instancia',  $valor)
        ->get();

        return $resultados->result_array();
    } 
    
    public function getPagosJSON($valor) {
        // Nuevo código
        $this->db->select('pi.id_pago, 
            pi.serial_pago, 
            pi.numero_operacion, 
            pi.estado_pago,
            pi.monto_operacion, 
            pi.estado_pago,
            pi.fk_id_tipo_operacion,
            concat(pi.numero_operacion, " - ", pe.nombres_persona, " ", pe.apellidos_persona) as label, 
            concat(pe.nombres_persona, " ", pe.apellidos_persona) as nombre_cliente, 
            pe.cedula_persona')
        ->from('pago_de_inscripcion as pi')
        ->join('cliente as c', 'c.id_cliente = pi.fk_id_cliente')
        ->join('persona as pe', 'pe.persona_id = c.fk_id_persona_1')
        ->where('pi.estado_pago', 1);
        
        if($valor != '')
        {
            $this->db->like('pi.numero_operacion', $valor);
			$this->db->or_like('pe.nombres_persona', $valor);
			$this->db->or_like('pe.apellidos_persona', $valor);
        }

        $valor=$this->db->get();
        return $valor->result_array();
    }

}