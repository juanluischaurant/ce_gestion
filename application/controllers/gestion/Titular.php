<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión 
 * donde sea necesario consultar información relacionada a titulares.
 * 
 * @package CE_gestion
 * @subpackage Persona
 * @category Controladores
 */
class Titular extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Persona_model');  
        $this->load->model('Titular_model');  
    }

	public function index()
	{
		$data = array(
			'titulares' => $this->Titular_model->get_titulares(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/titular/list', $data);
		$this->load->view('layouts/footer');
    }
    
	public function add($cedula_persona = 'new')
	{
		if($cedula_persona !== 'new')
		{
			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($cedula_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titular/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		}
		elseif($cedula_persona = 'new')
		{	
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titular/add', $data_persona);
			$this->load->view('layouts/footer');
		}
    }
    
	public function store()
	{
		$cedula_persona = $this->input->post('cedula_persona');

		$data_cliente = array(
			'cedula_persona' => $cedula_persona,
		);

		if($this->Titular_model->duplicidad_persona($cedula_persona) === TRUE)
		{
			if($this->Titular_model->save($data_cliente))
			{
				redirect(base_url().'gestion/titular');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/titular/add');	
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Esta persona ya está registrada como Titular.');
			redirect(base_url().'gestion/titular/add');	
		}
	}

}