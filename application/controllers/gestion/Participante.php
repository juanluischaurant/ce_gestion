<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión 
 * donde sea necesario consultar información relacionada a participantes
 * 
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Participante extends CI_Controller {

	private $permisos;

	public function __construct()
	{
		parent::__construct();
				
      	// El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();
		
		// Si el usuario no ha iniciado sesión
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el controlador
			$this->load->model('Persona_model');  
			$this->load->model('Participante_model');  
		}
		
    }

	public function index()
	{
		$data = array(
			'permisos' => $this->permisos,
			'participantes' => $this->Participante_model->get_participantes(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/participante/list', $data);
		$this->load->view('layouts/footer');
	}

	/**
	 * Estructura la vista que será mostrada cuando se llame
	 * al método
	 * 
	 * El método está diseñado para ser llamado por medio del método
	 * AJAX.
	 *
	 * @return void
	 */
	public function view()
	{
		$cedula_persona = $this->input->post("cedula_participante");

		$data = array(
			'participante' => $this->Participante_model->get_participante($cedula_persona),
			'cursos_inscritos' => $this->Participante_model->get_cursos_inscritos($cedula_persona)
		);

		$this->load->view("admin/participante/view", $data);
	}

	public function add($cedula_persona = 'new')
	{
		if($cedula_persona !== 'new')
		{
			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($cedula_persona),
				'nivel_academico' => $this->Participante_model->nivel_academico_dropdown()
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/participante/add', $data_persona); 
			$this->load->view('layouts/footer');
		}
		elseif($cedula_persona = 'new')
		{
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas(),
				'nivel_academico' => $this->Participante_model->nivel_academico_dropdown()
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/participante/add', $data_persona);
			$this->load->view('layouts/footer');
		}	
	}
	
	/**
	 * Almacenar participante
	 * 
	 * Este método solo trabaja con el id de la persona que será
	 * registrada como participante. Los datos ya estan registrados en la 
	 * tabla "persona" de la base de datos.
	 *
	 * @return void
	 */
	public function store()
	{
		// Valor obtenido por medio del método POST
		$cedula_persona = $this->input->post('cedula_persona');
		$nivel_academico = $this->input->post('nivel_academico');

		$data_participante = array(
			'cedula_persona' => $cedula_persona,
			'id_nivel_academico' => $nivel_academico
		);

		if($this->Participante_model->duplicidad_participante($cedula_persona) === TRUE)
		{
			if($this->Participante_model->save($data_participante))
			{
				$this->session->set_flashdata('success', 'Participante registrado exitosamente');
				redirect(base_url().'gestion/participante');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/participante/add');	
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Esta persona ya está registrada como participante.');
			redirect(base_url().'gestion/participante/add');	
		}
	}

	public function edit($cedula_persona)
	{
		$data = array(
			'participante' => $this->Participante_model->get_participante($cedula_persona),
			'nivel_academico' => $this->Participante_model->nivel_academico_dropdown()
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/participante/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function update()
	{
		$cedula_persona = $this->input->post("cedula_participante");
		$nivel_academico = $this->input->post('nivel_academico');

		$data = array(
			'id_nivel_academico' => $nivel_academico,
		);

		if($this->Participante_model->update($cedula_persona, $data)) {
			redirect(base_url().'gestion/participante');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/participante/edit'.$cedula_persona);
		}
		
	}

}