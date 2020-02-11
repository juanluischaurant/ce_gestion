<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nombre_curso extends CI_Controller {

	private $permisos;

	public function __construct()
	{
		parent::__construct();

		// El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		// $this->permisos = $this->backend_lib->control();

        $this->load->model('Nombre_curso_model');  
    }

	public function index()
	{
		$data = array(
			'nombres_curso' => $this->Nombre_curso_model->get_nombres_curso(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/nombre_curso/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add()
	{
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/nombre_curso/add');
		$this->load->view('layouts/footer');
	}

	public function store()
	{
		$descripcion = $this->input->post('descripcion_curso');
		$cantidad_horas = $this->input->post('cantidad_horas');

		$this->form_validation->set_rules('descripcion_curso', 'Descripción', 'required|is_unique[nombre_curso.descripcion]');
		$this->form_validation->set_rules('cantidad_horas', 'Cantidad de Horas', 'required|numeric');
		
		if($this->form_validation->run())
		{
			$data = array (
				'descripcion' => $descripcion,
				'cantidad_horas' => $cantidad_horas,
				'estado' => '1'
			);
	
			if($this->Nombre_curso_model->save_nombre_curso($data))
			{
				redirect(base_url().'gestion/nombre_curso');
			} else {
				$this->session->set_flashdata('error', 'No se pudo agregar el especialidad.');
				redirect(base_url().'gestion/especialidad/add');
			}
		} else {
			$this->add();
		}
	}

	public function edit($id)
	{
		$data = array(
			'nombre_curso' => $this->Nombre_curso_model->get_nombre_curso($id)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/nombre_curso/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function update()
	{
		$id_nombre_curso = $this->input->post('id_nombre_curso');
		
		$descripcion = $this->input->post('descripcion_curso');
		$descripcion_nueva = $this->input->post('descripcion_curso_nueva');

		$nombre = $this->input->post('cantidad_horas');

		$data = array(
			'cantidad_horas' => $nombre,
			
		);

		if($descripcion !== $descripcion_nueva || $descripcion_nueva == '')
		{
			$this->form_validation->set_rules('descripcion_curso_nueva', 'Descripción', 'required|is_unique[nombre_curso.descripcion]');
			$data['descripcion'] = $descripcion_nueva;
		}

		$this->form_validation->set_rules('cantidad_horas', 'Cantidad de Horas', 'required|numeric');
		
		if($this->form_validation->run())
		{
			if(!$this->Nombre_curso_model->update($id_nombre_curso, $data))
			{
				$this->session->set_flashdata('success', 'Especialidad actualizada exitosamente.');
				redirect(base_url().'gestion/nombre_curso');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar el especialidad.');
				redirect(base_url().'gestion/nombre_curso/edit/'.$id_nombre_curso);
			}
		}
		else
		{
			redirect(base_url().'gestion/nombre_curso/edit/'.$id_nombre_curso);			
		}
	}

}
