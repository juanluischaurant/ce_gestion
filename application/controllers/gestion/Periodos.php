<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodos extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Periodos_model');  
    }

    public function index() {
		$data = array(
			'periodos' => $this->Periodos_model->getPeriodos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/periodos/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add() {
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/periodos/add');
        $this->load->view('layouts/footer');
	}
	
	public function store()
	{
		$mes_inicio = $this->input->post('mes-inicio');
		$mes_cierre = $this->input->post('mes-cierre');
		$year = $this->input->post('year-periodo');

		// Reglas declaradas para la validación de formularios
		// integrada en CodeIgniter
		$this->form_validation->set_rules('mes-inicio', 'Mes de Inicio', 'required|is_unique[periodo.mes_inicio_periodo]');
		$this->form_validation->set_rules('mes-cierre', 'Mes de Cierre', 'required|is_unique[periodo.mes_cierre_periodo]');
		$this->form_validation->set_rules('year-periodo', 'Año', 'required|is_unique[periodo.year_periodo]');
		
		if($this->form_validation->run())
		{
			$data = array (
				'mes_inicio_periodo' => $mes_inicio,
				'mes_cierre_periodo' => $mes_cierre,
				'year_periodo' => $year
			);
	
			if($this->Periodos_model->save($data))
			{
				redirect(base_url().'gestion/periodos');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo agregar el Período.');
				redirect(base_url().'gestion/periodos/add');
			}
		} 
		else
		{
			$this->add();
		}
		
	}

}
