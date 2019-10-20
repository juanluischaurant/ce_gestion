<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Cursos_model');  
    }

	public function index() {
		$data = array(
			'cursos' => $this->Cursos_model->getCursos(),
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
	
			if($this->Cursos_model->saveCurso($data)) {
				redirect(base_url().'gestion/cursos');
			} else {
				$this->session->set_flashdata('error', 'No se pudo agregar el curso.');
				redirect(base_url().'gestion/cursos/add');
			}
		} else {
			$this->add();
		}
	}

	public function edit($id) {
		$data = array(
			'curso' => $this->Cursos_model->getCurso($id)
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

		
		if($this->Cursos_model->update($id_curso, $data)) {
			redirect(base_url().'gestion/cursos');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar el curso.');
			redirect(base_url().'gestion/cursos/edit/'.$id_curso);
		}
	}

}
