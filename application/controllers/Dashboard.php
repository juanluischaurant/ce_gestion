<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inscripcion_model'); 
		
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
			'years' => $this->Inscripcion_model->inscripcion_years(),
		);
		$general['page_title'] = 'Principal';
		
		$this->load->view('layouts/header', $general);
		$this->load->view('layouts/aside');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('layouts/footer');
	}
	
	/**
	 * Permite obtener monto de dinero (bs) generado mensualmente durante el proceso 
	 * de inscripción
	 *
	 * @return void
	 */
	public function getData()
	{
		$year = $this->input->post('year_inscripcion'); // Valor generado con AJAX
		$resultados = $this->Inscripcion_model->inscripcion_montos($year);
		echo json_encode($resultados);
	}
}
