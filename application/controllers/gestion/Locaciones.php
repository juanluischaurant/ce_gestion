<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locaciones extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Locaciones_model');  
    }

    public function index() {
		$data = array(
			'locaciones' => $this->Locaciones_model->getLocaciones(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/locaciones/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add() {
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/locaciones/add');
        $this->load->view('layouts/footer');
	}

	public function store() {
		$nombre_locacion = $this->input->post('nombre-locacion');
		$direccion_locacion = $this->input->post('direccion-locacion');

		$this->form_validation->set_rules('nombre-locacion', 'Nombre de Locación', 'required|is_unique[locacion.nombre_locacion]');
		
		if($this->form_validation->run()) {
			$data = array (
				'nombre_locacion' => $nombre_locacion,
				'direccion_locacion' => $direccion_locacion
			);
	
			if($this->Locaciones_model->save($data)) {
				redirect(base_url().'gestion/locaciones');
			} else {
				$this->session->set_flashdata('error', 'No se pudo agregar la locación.');
				redirect(base_url().'gestion/locaciones/add');
			}
		} else {
			$this->add();
		}
		
	}

}
