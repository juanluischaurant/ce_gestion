<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Inscripciones_model");
		$this->load->model("Pagos_model");
		$this->load->model("Participantes_model");
		$this->load->model('Instancias_model');
    }

	/**
	 * Realiza consulta para obtener una lista de inscripciones realizadas,
	 * esambla la vista llamando y carga la información consultada con el 
	 * método $this->getInscripciones()
	 *
	 * @return void
	 */
	public function index()
	{
		// Almacena en el array $data una lista de inscripciones obtenida de la base de datos
		$data = array(
			"inscripciones" => $this->Inscripciones_model->get_inscripciones() 
		);

		// Ensambla la vista y carga la información
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
	
	public function store()
	{
		$fk_id_participante_1 = $this->input->post('id_participante');
		// $fk_id_estatus_1 = ; <- Configurado automáticamente en 1
		// $fk_id_pago_inscripcion_1 = ; <. No utilizado para almacenar en la tabla `inscripcion`
		// $fk_id_usuario_1 = ; <= aur por configurar
		$fecha_inscripcion = $this->input->post('fecha-inscripcion');
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
		$ids_pago = $this->input->post('id-pago');

		$data = Array(
			'fk_id_participante_1' => $fk_id_participante_1,
			'fecha_inscripcion' => $fecha_inscripcion,
			'monto_pagado' => $monto_pagado,
			'precio_total' => $precio_total,
			'descuento' => $descuento,
			'precio_final' => $precio_final
		);
	
		// Almacenar datos en la tabla "inscripcion"
		if ($this->Inscripciones_model->save($data))
		{
			$id_ultima_inscripcion = $this->Inscripciones_model->lastID();
		
			// Guarda los detalles de la inscripción
			$this->saveInscripcionCurso($fk_id_curso, $id_ultima_inscripcion, $cupos_curso, $ids_pago);

			redirect(base_url()."movimientos/inscripciones");
		}
		else
		{ 
			redirect(base_url()."movimientos/inscripciones/add");
		}

	}

	/**
	 * Crea un nuevo registro en la tabla de relación inscripcion_curso
	 *
	 * @param array $idcursos
	 * @param integer $id_ultima_inscripcion
	 * @param integer $cupos_curso
	 * @param array $ids_pago
	 * @return void
	 */
	protected function saveInscripcionCurso($idcursos,$id_ultima_inscripcion, $cupos_curso, $ids_pago)
	{
		// Itera sobre un array con IDs de 1 o más cursos seleccionados
		for($i=0; $i < count($idcursos); $i++)
		{ 
			$data  = array(
				'fk_id_inscripcion_1' => $id_ultima_inscripcion,
				'fk_id_curso_1' => $idcursos[$i]
			);

			// Almacena en inscripcion_curso
			$this->Pagos_model->saveInscripcionCurso($data);

			// Actualiza el conteo de cupos disponibles en el curso
			$this->actualiza_cupos_ocupados($idcursos[$i],$cupos_curso[$i]);
		}

		// Itera sobre un array con IDs de 1 o más pagos seleccionados
		for($j = 0; $j < count($ids_pago); $j++)
		{
			$data  = array(
				'fk_id_inscripcion' => $id_ultima_inscripcion
			);

			// Asigna ID de inscripción al pago 
			$this->updateIdInscripcion($ids_pago[$j], $data);

			// Actualiza el estado del pago a Usado
			$this->actualiza_estado_pago($ids_pago[$j]);
		} 

	}

	/**
	 * Actualiza Cupos Ocupados
	 * 
	 * Actualiza el conteo de cupos en determinado curso luego de almacenar los datos de inscripción.
	 *
	 * @param integer $idcurso
	 * @param integer $cupos_curso
	 * @return void
	 */
	protected function actualiza_cupos_ocupados($idcurso, $cupos_curso)
	{
		$cursoActual = $this->Instancias_model->getInstancia($idcurso);
		$data = array(
			'cupos_instancia_ocupados' => $cursoActual->cupos_instancia_ocupados + 1, 
		);
		$this->Instancias_model->update($idcurso,$data);
	}

	/**
	 * Actualiza la clave foránea fk_id_inscripcion 
	 *
	 * @param integer $id_pago
	 * @param integer $id_ultima_inscripcion
	 * @return void
	 */
	protected function updateIdInscripcion($id_pago, $id_ultima_inscripcion)
	{
		$this->Inscripciones_model->updateIdInscripcion($id_pago, $id_ultima_inscripcion);
	}

	/**
	 * Actualiza estado_pago
	 * 
	 * Actualiza el campo estado_pago en la tabla pago_de_inscripcion, el estado_pago
	 * permite controlar que un pago se utilize una sola vez dentro del sistema. Esta
	 * función es llamada al momento de almacenar la inscripción.
	 *
	 * @param integer $id_pago
	 * @return void
	 */
	protected function actualiza_estado_pago($id_pago)
	{		
		// Considera cambiar el nombre de este método que fué renombrado incorrectamente
		$this->Pagos_model->actualiza_estado_pago($id_pago);
	}

	/**
	 * Carga la información específica de una inscripción
	 *
	 * @return void
	 */
	public function view()
	{
		// $id_inscripcion_curso = $this->input->post('id_curso_inscripcion');
		$id_inscripcion = $this->input->post('id_inscripcion');

		$data = array(
			'inscripcion' => $this->Inscripciones_model->get_inscripcion($id_inscripcion),
			'inscripciones_cursos' => $this->Inscripciones_model->get_inscripcion_curso($id_inscripcion),
			'pagos_de_inscripcion' => $this->Inscripciones_model->get_pago_inscripcion($id_inscripcion)
		);

		$this->load->view('admin/inscripciones/view', $data);
	}

	// =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

	/**
	 * Consulta el pago indicado
	 * 
	 * Este método se invoca a través de una llamada AJAX realizada con jQuery
	 *
	 * @return void
	 */
	public function get_pagos_json() {
		$valor = $this->input->post('query');
		$pagos = $this->Inscripciones_model->get_pagos_json($valor);
		echo json_encode($pagos);
	}
	
	/**
	 * Consulta el curso indicado
	 * 
	 * Este método se invoca a través de una llamada AJAX realizada con jQuery
	 *
	 * @return void
	 */
	public function getInstanciasJSON() {
		$valor = $this->input->post('query');
		$participantes = $this->Inscripciones_model->getInstanciasJSON($valor);
		echo json_encode($participantes);
	}

	/**
     * Método invocado al momento de agregar una instancia a la ficha de inscripción
     * 
     * Permite verificar que el participante seleccionado no se encuentre registrado en
     * el curso seleccionado
     *
     * @param integer $id_instancia
     * @return void
     */
	public function getParticipantesJSON() {
		$valor = $this->input->post('id');
		$participantes = $this->Inscripciones_model->getParticipantesJSON($valor);
		echo json_encode($participantes);
	}
	
	// =======================================================
	//Fin de Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

}