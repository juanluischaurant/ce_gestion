<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {

	private $permisos;

	public function __construct()
	{
		parent::__construct();

		// El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();

        $this->load->model('Curso_model');  
    }

	public function index()
	{
		$data = array(
			'cursos' => $this->Curso_model->get_cursos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/cursos/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/cursos/add');
		$this->load->view('layouts/footer');
	}

	public function store() {
		$nombre = $this->input->post('nombre_curso');
		$descripcion = $this->input->post('descripcion_curso');

		$this->form_validation->set_rules('nombre_curso', 'Nombre del Curso', 'required|is_unique[curso.nombre_curso]');
		
		if($this->form_validation->run()) {
			$data = array (
				'nombre_curso' => $nombre,
				'descripcion_curso' => $descripcion,
				'estado_curso' => '1'
			);
	
			if($this->Curso_model->saveCurso($data)) {
				redirect(base_url().'gestion/curso');
			} else {
				$this->session->set_flashdata('error', 'No se pudo agregar el curso.');
				redirect(base_url().'gestion/curso/add');
			}
		} else {
			$this->add();
		}
	}

	public function edit($id) {
		$data = array(
			'curso' => $this->Curso_model->get_curso($id)
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
			'nombre_curso' => $nombre,
			'descripcion_curso' => $descripcion
		);

		
		if(!$this->Curso_model->update($id_curso, $data)) {
			$this->session->set_flashdata('success', 'Curso actualizado exitosamente.');
			redirect(base_url().'gestion/curso');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar el curso.');
			redirect(base_url().'gestion/curso/edit/'.$id_curso);


		}
	}

}
