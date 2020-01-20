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

	public function __construct() {
        parent::__construct();
        $this->load->model('Persona_model');  
        $this->load->model('Titular_model');  
    }

    public function index() {
		$data = array(
			'titulares' => $this->Titular_model->get_titulares(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/titulares/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add($id_persona = 'new') {
		
		if($id_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($id_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titulares/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($id_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titulares/add', $data_persona);
			$this->load->view('layouts/footer');
		
		}
		
    }
    
	public function store()
	{
		$id_persona = $this->input->post('fk-id-persona');

		// $cedula = $this->input->post("cedula");
		// $nombres = $this->input->post('nombres');
		// $apellidos = $this->input->post('apellidos');
		// $fecha_nacimiento = $this->input->post('fecha');
		// $genero = $this->input->post('genero');
		// $telefono = $this->input->post('telefono');
		// $direccion = $this->input->post('direccion');

		$data_cliente = array(
			'id_persona' => $id_persona,
		);

		if($this->Titular_model->duplicidad_persona($id_persona) === TRUE)
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