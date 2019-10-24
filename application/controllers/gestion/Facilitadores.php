<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilitadores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Personas_model');  
        $this->load->model('Facilitadores_model');  
    }

    public function index() { 
		$data = array(
			'facilitadores' => $this->Facilitadores_model->getFacilitadores(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitadores/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add($id_persona = 'new') {


		if($id_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Personas_model->getPersona($id_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitadores/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($id_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Personas_model->getPersonas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitadores/add', $data_persona);
			$this->load->view('layouts/footer');
		
		}
    }
    
    public function store() {

		$fk_id_persona_3 = $this->input->post('fk-id-persona');

		// No utilizados porque estis datos ya fueron guardados en la tabla personas
		//
		// $cedula = $this->input->post("cedula-facilitador");
		// $nombres = $this->input->post('nombre-facilitador');
		// $apellidos = $this->input->post('apellido-facilitador');
		// $fecha_nacimiento = $this->input->post('nacimiento-facilitador');
		// $genero = $this->input->post('genero-facilitador');
		// $telefono = $this->input->post('telefono-facilitador');
		// $direccion = $this->input->post('direccion-facilitador');

		$data_facilitador = array(
			'fk_id_persona_3' => $fk_id_persona_3,
		);

		if($this->Facilitadores_model->evitaFacilitadorDuplicado($fk_id_persona_3) === true) {

			if($this->Facilitadores_model->save($data_facilitador)) {

				redirect(base_url().'gestion/facilitadores');

			} else {

				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/facilitadores/add');	

			}

		} else {

			$this->session->set_flashdata('error', 'Esta persona ya está registrada como facilitador.');
			redirect(base_url().'gestion/facilitadores/add');	

		}

	}

	public function update() {
		$id_facilitador = $this->input->post('id-facilitador');
		$fk_id_persona_3 = $this->input->post('fk-id-persona');

		$cedula = $this->input->post('cedula-facilitador');
		$nombres = $this->input->post('nombre-facilitador');
		$apellidos = $this->input->post('apellido-facilitador');
		$genero = $this->input->post('genero-facilitador');
		$fecha_nacimiento = $this->input->post('nacimiento-facilitador');
		$telefono = $this->input->post('telefono-facilitador');
		$direccion = $this->input->post('direccion-facilitador');

		// $estado_facilitador; <- Aún no utilizada

		$data = array(
			'cedula_persona' => $cedula,
			'nombres_persona' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion
		);

		if($this->Personas_model->update($fk_id_persona_3, $data)) {
			redirect(base_url().'gestion/facilitadores');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/facilitadores/edit'.$id_facilitador);
		}
		
	}

	public function edit($id) {
		$data = array(
			'facilitador' => $this->Facilitadores_model->getFacilitador($id)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitadores/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function delete($id) {
		$data = array(
			'estado_facilitador' => 0,
		);
		$this->Facilitadores_model->update($id, $data);
		echo 'gestion/facilitadores';
	}
}