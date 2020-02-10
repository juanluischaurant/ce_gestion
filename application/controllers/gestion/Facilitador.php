<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión 
 * donde sea necesario consultar información relacionada a facilitadores
 * 
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Facilitador extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Persona_model');  
		$this->load->model('Facilitador_model'); 
		
				
		// Si el usuario no está logeado
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
    }

    public function index() { 
		$data = array(
			'facilitadores' => $this->Facilitador_model->get_facilitadores(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitador/list', $data);
		$this->load->view('layouts/footer');
    }
    
	public function add($cedula_persona = 'new') 
	{
		if($cedula_persona !== 'new') {

			$data_persona = array(
				'persona' => $this->Persona_model->get_persona($cedula_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitador/add', $data_persona); 
			$this->load->view('layouts/footer');
		
		} elseif($cedula_persona = 'new') {
					
			$data_persona = array(
				"personas" => $this->Persona_model->get_personas() 
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/facilitador/add', $data_persona);
			$this->load->view('layouts/footer');
		
		}
		
    }
    
	public function store()
	{
		$cedula_persona = $this->input->post('cedula_persona');

		$data_facilitador = array(
			'cedula_persona' => $cedula_persona,
		);

		if($this->Facilitador_model->evitaFacilitadorDuplicado($cedula_persona) === true) {

			if($this->Facilitador_model->save($data_facilitador)) {

				redirect(base_url().'gestion/facilitador');

			} else {

				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/facilitador/add');	

			}

		} else {

			$this->session->set_flashdata('error', 'Esta persona ya está registrada como facilitador.');
			redirect(base_url().'gestion/facilitador/add');	

		}

	}

	public function update()
	{
		$cedula_persona = $this->input->post('cedula-facilitador');
		$fecha_contratacion = $this->input->post('fecha_contratacion');

		$data = array(
			'fecha_contratacion' => $fecha_contratacion,
		);

		if($this->Persona_model->update($cedula_persona, $data)) {
			redirect(base_url().'gestion/facilitador');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/facilitador/edit'.$cedula_persona);
		}
		
	}

	public function edit($cedula_persona)
	{
		$data = array(
			'facilitador' => $this->Facilitador_model->get_facilitador($cedula_persona)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/facilitador/edit', $data);
		$this->load->view('layouts/footer');
	}

   /*
	* Desactivar un FACILITADOR
	* 
	* FACILITADORES pueden ser desactivados y reactivados, al desactivar un 
	* facilitador estaeno debe aparecer en los campos de búsqueda del sistema.
	*
	* @param integer $id_locacion
	* @return void
	*/
   public function desactivar_facilitador($cedula_persona)
   {
	   $data = array('estado' => 0);

	   $this->Facilitador_model->update($cedula_persona, $data);
	   $this->session->set_flashdata('success', 'Se desactivó exitosamente al facilitador');
	   redirect(base_url().'gestion/facilitador/');
   }

   /*
	* Activar un FACILITADOR
	* 
	* FACILITADORES pueden ser desactivados y reactivados, al desactivar un 
	* facilitador estaeno debe aparecer en los campos de búsqueda del sistema.
	*
	* @param integer $id_locacion
	* @return void
	*/
   public function activar_facilitador($cedula_persona)
   {
	   $data = array('estado' => 1);

	   $this->Facilitador_model->update($cedula_persona, $data);
	   $this->session->set_flashdata('success', 'Se desactivó exitosamente al facilitador');
	   redirect(base_url().'gestion/facilitador/');
   }

}