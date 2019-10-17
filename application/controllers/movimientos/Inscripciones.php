<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Inscripciones_model");
		$this->load->model("Pagos_model");
		$this->load->model("Participantes_model");
		$this->load->model('Cursos_model'); // Este podría ser eliminado de aquí
		$this->load->model('Instancias_model');
    }

    public function index() {
		// Load the view for Inscripciones, loading to it the $data array
		$data = array(
			"inscripciones" => $this->Inscripciones_model->getInscripciones() 
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/inscripciones/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add() {
		$data = array(
			"tiposPago" => $this->Pagos_model->getTiposDeOperacion(),
			"participantes" => $this->Participantes_model->getParticipantes() 
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/inscripciones/add', $data);
		$this->load->view('layouts/footer');		
	}
	
	public function store() {

		$fk_id_participante_1 = $this->input->post('id_participante');
		// $fk_id_estatus_1 = ; <- Configurado automáticamente en 1
		// $fk_id_pago_inscripcion_1 = ; <. No utilizado para almacenar en la tabla `inscripcion`
		// $fk_id_usuario_1 = ; <= aur por configurar
		$fecha_inscripcion = $this->input->post('fecha-inscrpicion');

		// $hora_inscripcion = ; <- Es calculada automátimamente a nivel de BD
		// $hora_cancelada = ; <- No utilizada para esta operación
		
		$monto_pagado = $this->input->post('monto-pagado');
		$precio_total = $this->input->post('subtotal');
		$descuento = $this->input->post('descuento');
		$precio_final = $this->input->post('total');
		
		// $activa = ; <- valor por defecto 1

		// Llaves utilizadas para almacenar en la tabla inscripcion_curso
		$fk_id_tipo_operacion = $this->input->post('fk_id_tipo_operacion');
		$fk_id_curso = $this->input->post('idcursos');
		$cupos_curso = $this->input->post('cuposcursos');
		$ids_pago = $this->input->post('id_pago');
		// =====================================

		$data = Array(
			'fk_id_participante_1' => $fk_id_participante_1,
			'fecha_inscripcion' => $fecha_inscripcion,
			'monto_pagado' => $monto_pagado,
			'precio_total' => $precio_total,
			'descuento' => $descuento,
			'precio_final' => $precio_final
		);
	
		if ($this->Inscripciones_model->save($data)) {
			$id_ultima_inscripcion = $this->Inscripciones_model->lastID();
		
			$this->saveInscripcionCurso($fk_id_curso, $id_ultima_inscripcion, $cupos_curso, $ids_pago);

			redirect(base_url()."movimientos/inscripciones");
		} else{ 
			redirect(base_url()."movimientos/inscripciones/add");
		}
		
	}

	protected function revisarInscripcionParticipante($id_participante) {
		$this->Inscripciones_model->revisarInscripcionParticipante($id_participante);
	}

	protected function saveInscripcionCurso($idcursos,$id_ultima_inscripcion, $cupos_curso, $ids_pago) {
		// Guarda los datos de la tabla de relación inscripcion_curso
		for ($i=0; $i < count($idcursos); $i++) { 
			$data  = array(
				'fk_id_inscripcion_1' => $id_ultima_inscripcion,
				'fk_id_curso_1' => $idcursos[$i]
			);

			$this->Pagos_model->saveInscripcionCurso($data);
			$this->updateCuposCurso($idcursos[$i],$cupos_curso[$i]);
			
		}

		for($j = 0; $j < count($ids_pago); $j++) {
			$data  = array(
				'fk_id_inscripcion' => $id_ultima_inscripcion
			);
			$this->updateIdInscripcion($ids_pago[$j], $data);
		} 

	}
		
	protected function updateConteoOperaciones($idTipoPago) {
		$conteoActual = $this->Pagos_model->getTipoDeOperacion($idTipoPago);
		$data  = array(
			'conteo_operaciones' => $conteoActual->conteo_operaciones + 1, 
		);
		$this->Pagos_model->updateConteoOperaciones($idTipoPago,$data);
	}
	

	protected function updateCuposCurso($idcurso, $cupos_curso) {
		$cursoActual = $this->Instancias_model->getInstancia($idcurso);
		$data = array(
			'cupos_instancia' => $cursoActual->cupos_instancia - 1, 
		);
		$this->Instancias_model->update($idcurso,$data);
	}

	protected function updateIdInscripcion($id_pago, $id_ultima_inscripcion) {
		$this->Inscripciones_model->updateIdInscripcion($id_pago, $id_ultima_inscripcion);
	}

	public function view() {
		// Carga la información específica de una inscripción

		$id_inscripcion_curso = $this->input->post('id_curso_inscripcion');
		$id_inscripcion = $this->input->post('id_inscripcion');

		$data = array(
			'inscripcion' => $this->Inscripciones_model->getInscripcion($id_inscripcion),
			'inscripciones_cursos' => $this->Inscripciones_model->getInscripcionCurso($id_inscripcion),
			'pagos_de_inscripcion' => $this->Inscripciones_model->getPagoInscripcion($id_inscripcion)
		);

		$this->load->view('admin/inscripciones/view', $data);
	}

	// =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================
	public function getPagosJSON() {
		$valor = $this->input->post('query');
		$pagos = $this->Inscripciones_model->getPagosJSON($valor);
		echo json_encode($pagos);
	}
	
	public function getCursosJSON() {
		$valor = $this->input->post('query');
		$participantes = $this->Inscripciones_model->getInstanciasJSON($valor);
		echo json_encode($participantes);
	}
	
	// =======================================================
	//Fin de Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

}