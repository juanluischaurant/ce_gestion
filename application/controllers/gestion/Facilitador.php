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

	private $permisos;

	public function __construct()
	{
		parent::__construct();
		
        // El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();
		
        // Si el usuario no está logeado
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el controlador
			$this->load->model('Persona_model');  
			$this->load->model('Facilitador_model');
			$this->load->model('Accion_model');
		}

    }

    public function index() { 
		$data = array(
			'permisos' => $this->permisos,
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

			if($this->Facilitador_model->save($data_facilitador))
			{
				$this->guardar_accion(2, $cedula_persona, 'FACILITADOR');
				redirect(base_url().'gestion/facilitador');

			} else {

				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/facilitador/add');	

			}

		}
		else
		{

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

		if($this->Persona_model->update($cedula_persona, $data))
		{
			$this->guardar_accion(3, $cedula_persona, 'FACILITADOR');
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

	   $this->guardar_accion(1, $cedula_persona, 'FACILITADOR');
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

	   $this->guardar_accion(4, $cedula_persona, 'FACILITADOR');
	   $this->Facilitador_model->update($cedula_persona, $data);
	   $this->session->set_flashdata('success', 'Se desactivó exitosamente al facilitador');
	   redirect(base_url().'gestion/facilitador/');
   }

   /**
	 * Guardar Acción
	 * 
	 * Método designado para el registro de las acciones realizadas
	 * por el usuario.
	 *
	 * @param integer $id_tipo_accion
	 * @param string $id_registro_afectado
	 * @param string $tabla_afectada
	 * @return void
	 */
	private function guardar_accion($id_tipo_accion, $id_registro_afectado, $tabla_afectada)
	{
		$username = $this->session->userdata('username'); // ID del usuario con sesión iniciada
		$id_tipo_accion = $id_tipo_accion; // Tipo de acción ejecudada (clave foránea)
		$descripcion = "CÉDULA: " . $id_registro_afectado; // Texto de descripción de acción
		$tabla_afectada = $tabla_afectada; // Tabla afectada

		$agregar_accion = $this->Accion_model->save_action($username, $id_tipo_accion, $descripcion, $tabla_afectada);

		if($agregar_accion)
		{
			return TRUE;
		}
	}

}