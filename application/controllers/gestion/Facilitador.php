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

    public function __construct() {
        parent::__construct();
        $this->load->model('Persona_model');  
        $this->load->model('Facilitador_model');  
    }

    public function index() { 
		$data = array(
			'facilitadores' => $this->Facilitador_model->getFacilitadores(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitadores/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add($id_persona = 'new') {

		if($id_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($id_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitadores/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($id_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas() 
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

		if($this->Facilitador_model->evitaFacilitadorDuplicado($fk_id_persona_3) === true) {

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
			'cedula' => $cedula,
			'nombres' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion
		);

		if($this->Persona_model->update($fk_id_persona_3, $data)) {
			redirect(base_url().'gestion/facilitador');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/facilitador/edit'.$id_facilitador);
		}
		
	}

	public function edit($id) {
		$data = array(
			'facilitador' => $this->Facilitador_model->getFacilitador($id)
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
		$this->Facilitador_model->update($id, $data);
		echo 'gestion/facilitador';
	}
}