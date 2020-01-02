<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodos extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Periodos_model');  
    }

	public function index()
	{
		$data = array(
			'periodos' => $this->Periodos_model->getPeriodos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/periodos/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add()
	{
		$data = array(
			'lista_meses' => $this->Periodos_model->meses_dropdown(),
		);
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/periodos/add', $data);
        $this->load->view('layouts/footer');
	}
	
	public function edit($id_periodo)
	{
		$data = array(
			'lista_meses' => $this->Periodos_model->meses_dropdown(),
			'data_periodo' => $this->Periodos_model->get_periodo($id_periodo)
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/periodos/edit', $data);
		$this->load->view('layouts/footer');
	}

	
	public function store()
	{
		// Reglas declaradas para la validación de formularios integrada en CodeIgniter
		$this->form_validation->set_rules('fecha-inicio', 'Fecha de Inicio', 'required');
		$this->form_validation->set_rules('fecha-culminacion', 'Fecha de Culminación', 'required');
		
		// Si la validación es correcta
		if($this->form_validation->run())
		{
			$data = array (
				'mes_inicio_periodo' => date('n', strtotime($_POST['fecha-inicio'])),
				'mes_cierre_periodo' => date('n', strtotime($_POST['fecha-culminacion'])),
				'fecha_inicio_periodo' => $this->input->post('fecha-inicio'),
				'fecha_culminacion_periodo' => $this->input->post('fecha-culminacion'),
			);
	
			$resultado = $this->Periodos_model->save($data);

			if($resultado === FALSE)
			{
				$this->session->set_flashdata('error', 'No se pudo agregar el Período.');
				$this->add();
			}
			else
			{
				$this->session->set_flashdata('success', 'Se agregó el nuevo Período.');
				redirect(base_url().'gestion/periodos/');
			}
		} 
		else
		{
			$this->add();
		}
		
	}

	public function update()
	{
		$id_periodo = $this->input->post('id-periodo');
		
		$data = array (
			'mes_inicio_periodo' => date('n', strtotime($_POST['fecha-inicio'])),
			'mes_cierre_periodo' => date('n', strtotime($_POST['fecha-culminacion'])),
			'fecha_inicio_periodo' => $this->input->post('fecha-inicio'),
			'fecha_culminacion_periodo' => $this->input->post('fecha-culminacion'),
		);

		if($this->Periodos_model->update($id_periodo, $data))
		{
			$this->session->set_flashdata('success', 'Período actualizado correctamente.');
			redirect(base_url().'gestion/periodos');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/periodos/edit/'.$id_periodo);
		}

	}
}
