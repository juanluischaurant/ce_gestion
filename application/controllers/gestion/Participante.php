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

	public function __construct() {
		parent::__construct();
		
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
		$id_participante = $this->input->post("id_participante");

		$data = array(
			'participante' => $this->Participante_model->get_participante($id_participante),
			'instancias_inscritas' => $this->Participante_model->get_instancias_inscritas($id_participante)
		);

		$this->load->view("admin/participante/view", $data);
	}

	public function add($id_persona = 'new')
	{
		if($id_persona !== 'new')
		{
			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($id_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/participante/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		}
		elseif($id_persona = 'new')
		{
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas() 
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
		$fk_id_persona_2 = $this->input->post('fk-id-persona');

		$data_participante = array(
			'fk_id_persona_2' => $fk_id_persona_2,
		);

		if($this->Participante_model->duplicidad_participante($fk_id_persona_2) === true)
		{
			if($this->Participante_model->save($data_participante))
			{
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

	public function edit($id)
	{
		$data = array(
			'participante' => $this->Participante_model->getParticipante($id),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/participante/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function update()
	{
		$id_participante = $this->input->post('idParticipante');
		$cedula = $this->input->post("cedula");
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$fecha_nacimiento = $this->input->post('fecha');
		$genero = $this->input->post('genero');
		$telefono = $this->input->post('telefono');
		$direccion = $this->input->post('direccion');

		$data = array(
			'cedula_participante' => $cedula,
			'nombres_participante' => $nombres,
			'apellidos_participante' => $apellidos,
			'fecha_nacimiento_participante' => $fecha_nacimiento,
			'genero_participante' => $genero,
			'telefono_participante' => $telefono,
			'direccion_participante' => $direccion
		);

		if($this->Participante_model->update($id_participante, $data)) {
			redirect(base_url().'gestion/participante');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/participante/edit'.$id_participante);
		}
		
	}

}