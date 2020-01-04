<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locaciones extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Locaciones_model');  
    }

	public function index()
	{
		$data = array(
			'locaciones' => $this->Locaciones_model->get_locaciones(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/locaciones/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add()
	{
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/locaciones/add');
        $this->load->view('layouts/footer');
	}

	public function edit($id_locacion)
	{
		$data = array(
			'locacion' => $this->Locaciones_model->get_locacion($id_locacion),
		);
		$this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/locaciones/edit', $data);
        $this->load->view('layouts/footer');
	}

	
	public function view()
	{
		$id_locacion = $this->input->post('id_locacion');
		
		$data = array(
			"locacion" => $this->Locaciones_model->get_locacion($id_locacion),
			"instancias" => $this->Locaciones_model->get_instancias_asociadas($id_locacion)
		);

		$this->load->view("admin/locaciones/view", $data);
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
		$instancias_asociadas = $this->Locaciones_model->count_instancias_asociadas($id_locacion)->instancias_asociadas;

		if($instancias_asociadas > 0)
		{
			$this->session->set_flashdata('alert', 'No puedes eliminar una locación con instancias asociadas.');
			$this->edit($id_locacion);
		}
		else
		{
			if($this->Locaciones_model->delete($id_locacion))
			{
				$this->session->set_flashdata('success', 'Se eliminó exitosamente la locación.');
				redirect(base_url().'gestion/locaciones/');
			}
		}
	}

	/**
	 * Desactivar una locacion
	 * 
	 * Las locaciones pueden ser desactivadas y reactivadas, al desactivar una 
	 * instancia esta no debe aparecer en los campos de búsqueda del sistema.
	 *
	 * @param integer $id_locacion
	 * @return void
	 */
	public function deactivate_location($id_locacion)
	{
		$data = array('estado_locacion' => 0);

		$this->Locaciones_model->update($id_locacion, $data);
		$this->session->set_flashdata('success', 'Se activó exitosamente la locación.');
		redirect(base_url().'gestion/locaciones/');
	}

	/**
	 * Activar una locacion
	 * 
	 * Las locaciones pueden ser desactivadas y reactivadas, al desactivar una 
	 * instancia esta no debe aparecer en los campos de búsqueda del sistema.
	 *
	 * @param integer $id_locacion
	 * @return void
	 */
	public function activate_location($id_locacion)
	{
		$data = array('estado_locacion' => 1);

		if($this->Locaciones_model->update($id_locacion, $data))
		{
			$this->session->set_flashdata('success', 'Se desactivó exitosamente la locación.');
			redirect(base_url().'gestion/locaciones/');
		}
	}

	public function store()
	{
		$nombre_locacion = $this->input->post('nombre-locacion');
		$direccion_locacion = $this->input->post('direccion-locacion');

		$this->form_validation->set_rules('nombre-locacion', 'Nombre de Locación', 'required|is_unique[locacion.nombre_locacion]');
		
		if($this->form_validation->run()) {
			$data = array (
				'nombre_locacion' => $nombre_locacion,
				'direccion_locacion' => $direccion_locacion
			);
	
			if($this->Locaciones_model->save($data))
			{
				redirect(base_url().'gestion/locaciones');
			} else
			{
				$this->session->set_flashdata('error', 'No se pudo agregar la locación.');
				redirect(base_url().'gestion/locaciones/add');
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
			'nombre_locacion' => $nombre_locacion,
			'direccion_locacion' => $direccion_locacion
		);

		if($this->Locaciones_model->update($id_locacion, $data))
		{
			$this->session->set_flashdata('success', 'Se actualizó la locación.');
			redirect(base_url().'gestion/locaciones/');
		}
	}


}
