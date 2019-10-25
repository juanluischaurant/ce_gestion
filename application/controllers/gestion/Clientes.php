<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Personas_model');  
        $this->load->model('Clientes_model');  
    }

    public function index() {
		$data = array(
			'clientes' => $this->Clientes_model->getClientes(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add($id_persona = 'new') {
		
		if($id_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Personas_model->getPersona($id_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/clientes/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($id_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Personas_model->getPersonas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/clientes/add', $data_persona);
			$this->load->view('layouts/footer');
		
		}
		
    }
    
    public function store() {

		$fk_id_persona_1 = $this->input->post('fk-id-persona');

		// $cedula = $this->input->post("cedula");
		// $nombres = $this->input->post('nombres');
		// $apellidos = $this->input->post('apellidos');
		// $fecha_nacimiento = $this->input->post('fecha');
		// $genero = $this->input->post('genero');
		// $telefono = $this->input->post('telefono');
		// $direccion = $this->input->post('direccion');

		$data_cliente = array(
			'fk_id_persona_1' => $fk_id_persona_1,
		);

		if($this->Clientes_model->evitaClienteDuplicado($fk_id_persona_1) === true) {

			if($this->Clientes_model->save($data_cliente)) {

				redirect(base_url().'gestion/clientes');
	
			} else {
	
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/clientes/add');	
	
			}

		} else {

			$this->session->set_flashdata('error', 'Esta persona ya está registrada como cliente.');
			redirect(base_url().'gestion/clientes/add');	

		}


	}
}