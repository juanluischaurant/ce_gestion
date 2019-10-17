<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilitadores extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
    
    public function add() {
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/facilitadores/add');
        $this->load->view('layouts/footer');
    }
    
    public function store() {

		$cedula = $this->input->post("cedula-facilitador");
		$nombres = $this->input->post('nombre-facilitador');
		$apellidos = $this->input->post('apellido-facilitador');
		$fecha_nacimiento = $this->input->post('nacimiento-facilitador');
		$genero = $this->input->post('genero-facilitador');
		$telefono = $this->input->post('telefono-facilitador');
		$direccion = $this->input->post('direccion-facilitador');

		$data = array(
			'cedula_facilitador' => $cedula,
			'nombre_facilitador' => $nombres,
			'apellido_facilitador' => $apellidos,
			'fecha_nacimiento_facilitador' => $fecha_nacimiento,
			'genero_facilitador' => $genero,
			'telefono_1_facilitador' => $telefono,
			'direccion_facilitador' => $direccion,
			'estado_facilitador' => '1'

		);

		if($this->Facilitadores_model->save($data)) { 
			redirect(base_url().'gestion/facilitadores');
		} else {
			$this->session->set_flashdata('error', 'No se pudo guardar la información');
			redirect(base_url().'gestion/facilitadores/add');	
		}

	}

	public function update() {
		$id_facilitador = $this->input->post('id-facilitador');
		$cedula = $this->input->post('cedula-facilitador');
		$nombres = $this->input->post('nombre-facilitador');
		$apellidos = $this->input->post('apellido-facilitador');
		$fecha_nacimiento = $this->input->post('nacimiento-facilitador');
		$genero = $this->input->post('genero-facilitador');
		$telefono = $this->input->post('telefono-facilitador');
		$direccion = $this->input->post('direccion-facilitador');

		$data = array(
			'cedula_facilitador' => $cedula,
			'nombre_facilitador' => $nombres,
			'apellido_facilitador' => $apellidos,
			'fecha_nacimiento_facilitador' => $fecha_nacimiento,
			'genero_facilitador' => $genero,
			'telefono_1_facilitador' => $telefono,
			'direccion_facilitador' => $direccion
		);

		if($this->Facilitadores_model->update($id_facilitador, $data)) {
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