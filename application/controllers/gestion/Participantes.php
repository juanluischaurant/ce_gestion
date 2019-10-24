<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participantes extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Personas_model');  
        $this->load->model('Participantes_model');  
    }

    public function index() {
		$data = array(
			'participantes' => $this->Participantes_model->getParticipantes(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/participantes/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add() {
		
		$data_persona = array(
			"personas" => $this->Personas_model->getPersonas() 
		);

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/participantes/add', $data_persona);
		$this->load->view('layouts/footer');
		
	}
	
	public function store() {

		$fk_id_persona_2 = $this->input->post('fk-id-persona');

		// $cedula = $this->input->post("cedula");
		// $nombres = $this->input->post('nombres');
		// $apellidos = $this->input->post('apellidos');
		// $fecha_nacimiento = $this->input->post('fecha');
		// $genero = $this->input->post('genero');
		// $telefono = $this->input->post('telefono');
		// $direccion = $this->input->post('direccion');

		$data_participante = array(
			'fk_id_persona_2' => $fk_id_persona_2,
		);

	
		if($this->Participantes_model->save($data_participante)) {

			redirect(base_url().'gestion/participantes');

		} else {

			$this->session->set_flashdata('error', 'No se pudo guardar la información');
			redirect(base_url().'gestion/participantes/add');	

		}

	}

	public function edit($id) {
		$data = array(
			'participante' => $this->Participantes_model->getParticipante($id),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/participantes/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function update() {
		$id_participante = $this->input->post('idParticipante');
		$cedula = $this->input->post("cedula");
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$fecha_nacimiento = $this->input->post('fecha');
		$genero = $this->input->post('genero');
		$telefono = $this->input->post('telefono');
		$direccion = $this->input->post('direccion');

		$data = array(
			'cedula_participante' => $cedula,
			'nombres_participante' => $nombres,
			'apellidos_participante' => $apellidos,
			'fecha_nacimiento_participante' => $fecha_nacimiento,
			'genero_participante' => $genero,
			'telefono_participante' => $telefono,
			'direccion_participante' => $direccion
		);

		if($this->Participantes_model->update($id_participante, $data)) {
			redirect(base_url().'gestion/participantes');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/participantes/edit'.$id_participante);
		}
		
	}

}