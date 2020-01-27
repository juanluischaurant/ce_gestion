<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión 
 * donde sea necesario consultar información relacionada a facilitadores
 * 
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Facilitador extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Persona_model');  
        $this->load->model('Facilitador_model');  
    }

    public function index() { 
		$data = array(
			'facilitadores' => $this->Facilitador_model->get_facilitadores(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitador/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add($cedula_persona = 'new') {

		if($cedula_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($cedula_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitador/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($cedula_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitador/add', $data_persona);
			$this->load->view('layouts/footer');
		
		}
		
    }
    
	public function store()
	{
		$cedula_persona = $this->input->post('cedula_persona');

		$data_facilitador = array(
			'cedula_persona' => $cedula_persona,
		);

		if($this->Facilitador_model->evitaFacilitadorDuplicado($cedula_persona) === true) {

			if($this->Facilitador_model->save($data_facilitador)) {

				redirect(base_url().'gestion/facilitador');

			} else {

				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/facilitador/add');	

			}

		} else {

			$this->session->set_flashdata('error', 'Esta persona ya está registrada como facilitador.');
			redirect(base_url().'gestion/facilitador/add');	

		}

	}

	public function update() {
		$cedula_persona = $this->input->post('cedula-facilitador');
		$nombres = $this->input->post('nombre-facilitador');
		$apellidos = $this->input->post('apellido-facilitador');
		$genero = $this->input->post('genero-facilitador');
		$fecha_nacimiento = $this->input->post('nacimiento-facilitador');
		$telefono = $this->input->post('telefono-facilitador');
		$direccion = $this->input->post('direccion-facilitador');

		// $estado_facilitador; <- Aún no utilizada

		$data = array(
			'cedula' => $cedula_persona,
			'nombres' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion
		);

		if($this->Persona_model->update($cedula_persona, $data)) {
			redirect(base_url().'gestion/facilitador');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/facilitador/edit'.$cedula_persona);
		}
		
	}

	public function edit($cedula_persona) {
		$data = array(
			'facilitador' => $this->Facilitador_model->get_facilitador($cedula_persona)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitador/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function delete($cedula_persona) {
		$data = array(
			'estado' => 0,
		);
		$this->Facilitador_model->update($cedula_persona, $data);
		echo 'gestion/facilitador';
	}
}