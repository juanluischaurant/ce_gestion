<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locacion extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('Locacion_model');  
		
		// Si el usuario no está logeado
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
    }

	public function index()
	{
		$data = array(
			'locaciones' => $this->Locacion_model->get_locaciones(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/locacion/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add()
	{
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/locacion/add');
        $this->load->view('layouts/footer');
	}

	public function edit($id_locacion)
	{
		$data = array(
			'locacion' => $this->Locacion_model->get_locacion($id_locacion),
		);
		$this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/locacion/edit', $data);
        $this->load->view('layouts/footer');
	}

	
	public function view()
	{
		$id_locacion = $this->input->post('id_locacion');
		
		$data = array(
			"locacion" => $this->Locacion_model->get_locacion($id_locacion),
			"cursos" => $this->Locacion_model->get_instancias_asociadas($id_locacion)
		);

		$this->load->view("admin/locacion/view", $data);
	}

	/**
	 * Eliminar Locación
	 * 
	 * Este método se encarga de eliminar de la base de datos determinada
	 * locación.
	 *
	 * @param integer $id_locacion
	 * @return void
	 */
	public function delete_location($id_locacion) 
	{
		$instancias_asociadas = $this->Locacion_model->count_instancias_asociadas($id_locacion)->instancias_asociadas;

		if($instancias_asociadas > 0)
		{
			$this->session->set_flashdata('alert', 'No puedes eliminar una locación con cursos asociadas.');
			$this->edit($id_locacion);
		}
		else
		{
			if($this->Locacion_model->delete($id_locacion))
			{
				$this->session->set_flashdata('success', 'Se eliminó exitosamente la locación.');
				redirect(base_url().'gestion/locacion/');
			}
		}
	}

	/**
	 * Desactivar una locacion
	 * 
	 * Las locaciones pueden ser desactivadas y reactivadas, al desactivar una 
	 * curso esta no debe aparecer en los campos de búsqueda del sistema.
	 *
	 * @param integer $id_locacion
	 * @return void
	 */
	public function deactivate_location($id_locacion)
	{
		$data = array('estado' => 0);

		$this->Locacion_model->update($id_locacion, $data);
		$this->session->set_flashdata('success', 'Se desactivó exitosamente la locación.');
		redirect(base_url().'gestion/locacion/');
	}

	/**
	 * Activar una locacion
	 * 
	 * Las locaciones pueden ser desactivadas y reactivadas, al desactivar una 
	 * curso esta no debe aparecer en los campos de búsqueda del sistema.
	 *
	 * @param integer $id_locacion
	 * @return void
	 */
	public function activate_location($id_locacion)
	{
		$data = array('estado' => 1);

		if($this->Locacion_model->update($id_locacion, $data))
		{
			$this->session->set_flashdata('success', 'Se activó exitosamente la locación.');
			redirect(base_url().'gestion/locacion/');
		}
	}

	public function store()
	{
		$nombre_locacion = $this->input->post('nombre-locacion');
		$direccion_locacion = $this->input->post('direccion-locacion');

		$this->form_validation->set_rules('nombre-locacion', 'Nombre de Locación', 'required|is_unique[locacion.nombre]');
		
		if($this->form_validation->run()) {
			$data = array (
				'nombre' => $nombre_locacion,
				'direccion' => $direccion_locacion
			);
	
			if($this->Locacion_model->save($data))
			{
				redirect(base_url().'gestion/locacion');
			} else
			{
				$this->session->set_flashdata('error', 'No se pudo agregar la locación.');
				redirect(base_url().'gestion/locacion/add');
			}
		} else {
			$this->add();
		}	
	}

	public function update()
	{
		$id_locacion = $this->input->post('id-locacion');

		$nombre_locacion = $this->input->post('nombre-locacion');
		$direccion_locacion = $this->input->post('direccion-locacion');
		
		$data = array(
			'nombre' => $nombre_locacion,
			'direccion' => $direccion_locacion
		);

		$this->form_validation->set_rules('nombre-locacion', 'Nombre de Locación', 'required|is_unique[locacion.nombre]');

		if($this->form_validation->run()) {
			if($this->Locacion_model->update($id_locacion, $data))
			{
				$this->session->set_flashdata('success', 'Se actualizó la locación.');
				redirect(base_url().'gestion/locacion/');
			}
		}
	}


}
