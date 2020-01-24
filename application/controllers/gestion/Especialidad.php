<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidad extends CI_Controller {

	private $permisos;

	public function __construct()
	{
		parent::__construct();

		// El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();

        $this->load->model('Especialidad_model');  
    }

	public function index()
	{
		$data = array(
			'especialidades' => $this->Especialidad_model->get_especialidades(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/especialidades/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/especialidades/add');
		$this->load->view('layouts/footer');
	}

	public function store()
	{
		$nombre = $this->input->post('nombre_curso');
		$descripcion = $this->input->post('descripcion_curso');

		$this->form_validation->set_rules('nombre_curso', 'Nombre de Especialidad', 'required|is_unique[especialidad.nombre_curso]');
		
		if($this->form_validation->run())
		{
			$data = array (
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'estado' => '1'
			);
	
			if($this->Especialidad_model->save_especialidad($data))
			{
				redirect(base_url().'gestion/especialidad');
			} else {
				$this->session->set_flashdata('error', 'No se pudo agregar el especialidad.');
				redirect(base_url().'gestion/especialidad/add');
			}
		} else {
			$this->add();
		}
	}

	public function edit($id) {
		$data = array(
			'especialidad' => $this->Especialidad_model->get_curso($id)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/especialidades/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function update() {
		$id_curso = $this->input->post('id_curso');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');

		$data = array(
			'nombre_curso' => $nombre,
			'descripcion_curso' => $descripcion
		);

		
		if(!$this->Especialidad_model->update($id_curso, $data)) {
			$this->session->set_flashdata('success', 'Especialidad actualizada exitosamente.');
			redirect(base_url().'gestion/especialidad');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar el especialidad.');
			redirect(base_url().'gestion/especialidad/edit/'.$id_curso);


		}
	}

}
