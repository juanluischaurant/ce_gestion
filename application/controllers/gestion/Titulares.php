<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión 
 * donde sea necesario consultar información relacionada a titulares.
 * 
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Titulares extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Personas_model');  
        $this->load->model('Titulares_model');  
    }

    public function index() {
		$data = array(
			'titulares' => $this->Titulares_model->get_titulares(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/titulares/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add($id_persona = 'new') {
		
		if($id_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Personas_model->getPersona($id_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titulares/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($id_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Personas_model->getPersonas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titulares/add', $data_persona);
			$this->load->view('layouts/footer');
		
		}
		
    }
    
	public function store()
	{
		$fk_id_persona_1 = $this->input->post('fk-id-persona');

		// $cedula = $this->input->post("cedula");
		// $nombres = $this->input->post('nombres');
		// $apellidos = $this->input->post('apellidos');
		// $fecha_nacimiento = $this->input->post('fecha');
		// $genero = $this->input->post('genero');
		// $telefono = $this->input->post('telefono');
		// $direccion = $this->input->post('direccion');

		$data_cliente = array(
			'fk_id_persona_1' => $fk_id_persona_1,
		);

		if($this->Titulares_model->duplicidad_persona($fk_id_persona_1) === TRUE)
		{
			if($this->Titulares_model->save($data_cliente))
			{
				redirect(base_url().'gestion/titulares');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/titulares/add');	
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Esta persona ya está registrada como Titular.');
			redirect(base_url().'gestion/titulares/add');	
		}
	}

}