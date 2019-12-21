<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancias extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Instancias_model');  
        $this->load->model('Cursos_model');  
    }

	public function index() 
	{
		$data = array(
			'instancias' => $this->Instancias_model->getInstancias(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/instancias/list', $data);
		$this->load->view('layouts/footer');
	}

	/**
	 * Estructura la vista que será mostrada cuando se llame
	 * al método
	 * 
	 * El método está diseñado para ser llamado por medio del método
	 * AJAX.
	 *
	 * @return void
	 */
	public function view()
	{
		$id_instancia = $this->input->post("id_instancia");

		$data = array(
			"participantes_inscritos" => $this->Instancias_model->get_participantes_inscritos($id_instancia),
			'datos_instancia' => $this->Instancias_model->getInstancia($id_instancia)
		);

		$this->load->view("admin/instancias/view", $data);
	}

	public function add()
	{
        $data = array(
			'cursos' => $this->Cursos_model->getCursos(),
			'lista_turnos' =>  $this->Instancias_model->turnos_dropdown()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/instancias/add', $data);
		$this->load->view('layouts/footer');
	}

	public function store()
	{
        $id_curso_instanciado = $this->input->post('id-curso-instanciado');   // fk_id_curso_1
        $serial_instancia = $this->input->post('serial-instancia');   // serial_instancia
        $id_profesor_instancia = $this->input->post('id-profesor-instancia'); // fk_id_facilitador
        $id_periodo_instancia = $this->input->post('id-periodo-instancia');   // fk_id_periodo_1
        $id_locacion_instancia = $this->input->post('id-locacion-instancia'); // fk_id_locacion_1
        $turno_instancia = $this->input->post('turno-instancia');             // turno_instancia1
        $cupos_instancia = $this->input->post('cupos-instancia');             // cupos_instancia
		$precio_instancia = $this->input->post('costo-instancia');            // precio_instancia
		$descripcion_instancia = $this->input->post('descripcion-instancia'); // descripcion_instancia
		
        $data = array (
			'fk_id_curso_1' => $id_curso_instanciado,
			'serial_instancia' => $serial_instancia,
            'precio_instancia' => $precio_instancia,
            'fk_id_facilitador_1' => $id_profesor_instancia,
            'fk_id_periodo_1' => $id_periodo_instancia,
			'fk_id_locacion_1' => $id_locacion_instancia,
			'fk_id_turno_instancia_1' => $turno_instancia,
			'cupos_instancia' => $cupos_instancia,
			'descripcion_instancia' => $descripcion_instancia
        );

		if($this->Instancias_model->save($data))
		{
			$this->Cursos_model->actualizar_conteo_instancia($id_curso_instanciado);
			redirect(base_url().'gestion/instancias');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo registrar la instancia.');
			redirect(base_url().'gestion/instancias/add');
		}
	}
		
	public function edit($id) {
		$data = array(
			'curso' => $this->Cursos_model->getCurso($id)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/cursos/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function update() {
		$id_curso = $this->input->post('id_curso');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');

		$data = array(
			'nombre' => $nombre,
			'descripcion' => $descripcion
		);

		
		if($this->Cursos_model->update($id_curso, $data)) {
			redirect(base_url().'gestion/cursos');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar el curso.');
			redirect(base_url().'gestion/cursos/edit/'.$id_curso);
		}
	}
	
    // =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
    // =======================================================
    
	public function getPeriodosJSON()
	{
		$valor = $this->input->post('query');
		$periodos = $this->Instancias_model->getPeriodosJSON($valor);
		echo json_encode($periodos);
    }
    
    public function getLocacionesJSON() {
		$valor = $this->input->post('query');
		$locaciones = $this->Instancias_model->getLocacionesJSON($valor);
		echo json_encode($locaciones);
    }
    
	public function getFacilitadoresJSON()
	{
		$valor = $this->input->post('query');
		$facilitadores = $this->Instancias_model->getFacilitadoresJSON($valor);
		echo json_encode($facilitadores);
    }
    
    // =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================
	

}
