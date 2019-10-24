<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Personas_model');  
    }

    public function index() {
		$data = array(
			'personas' => $this->Personas_model->GetPersonas(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/personas/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add() {
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/add');
        $this->load->view('layouts/footer');
    }
    
    public function store() {

		$cedula = $this->input->post("cedula-persona");
		$nombres = $this->input->post('nombre-persona');
		$apellidos = $this->input->post('apellido-persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$genero = $this->input->post('genero-persona');
		$telefono = $this->input->post('telefono-persona');
		$direccion = $this->input->post('direccion-persona');

		$data_persona = array(
			'cedula_persona' => $cedula,
			'nombres_persona' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion,
			'estado_persona' => '1'

		);

		if($this->Personas_model->save($data_persona)) { 

			$id_ultima_persona_registrada = $this->Personas_model->lastID();

			// $data_persona = array(
			// 	'fk_id_persona_3' => $id_ultima_persona_registrada
			// );
	
            redirect(base_url().'gestion/success/'.$id_ultima_persona_registrada);

		} else {

			$this->session->set_flashdata('error', 'No se pudo guardar la información');
			redirect(base_url().'gestion/personas/add');	

		}

    }
    
    public function success() {
        $data_persona = array(
            'persona' => '1'
        );
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/success', $data_persona);
        $this->load->view('layouts/footer');
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
			redirect(base_url().'gestion/personas');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/personas/edit'.$id_facilitador);
		}
		
	}

	public function edit($id) {
		$data = array(
			'facilitador' => $this->Facilitadores_model->getFacilitador($id)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/personas/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function delete($id) {
		$data = array(
			'estado_facilitador' => 0,
		);
		$this->Facilitadores_model->update($id, $data);
		echo 'gestion/personas';
	}
}