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
			$this->load->model('Persona_model');  
			$this->load->model('Titular_model');  
			$this->load->model('Accion_model');  
			
			$this->load->library('unit_test');
        }
    }

	public function index()
	{
		$data = array(
			'permisos' => $this->permisos,
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
	
	public function edit($cedula_persona = NULL)
	{	
		if($cedula_persona !== NULL)
		{
			$test = $this->Titular_model->get_titular($cedula_persona);

			$resultado_esperado = 'is_array';
	
			$nombre_prueba = 'Consulta los períodos registrados en la base de datos';
	
			echo $this->unit->run($test, $resultado_esperado, $nombre_prueba);
			echo '<br>';
			print_r($test);

			$data_titular = array(
				'titular' => $this->Titular_model->get_titular($cedula_persona),
			);

			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/titular/edit', $data_titular); 
			$this->load->view('layouts/footer');
		}
	}

	public function view()
	{
		$cedula_persona = $this->input->post("cedula_persona");

		$data = array(
			'titular' => $this->Titular_model->get_titular($cedula_persona),
		);

		$this->load->view("admin/titular/view", $data);
	}
    
	public function store()
	{
		$cedula_persona = $this->input->post('cedula_persona');

		$data_titular = array(
			'cedula_persona' => $cedula_persona,
		);

		if($this->Titular_model->duplicidad_titular($cedula_persona) === TRUE)
		{
			if($this->Titular_model->save($data_titular))
			{
				$this->guardar_accion(2, $cedula_persona, 'TITULAR');

				$this->session->set_flashdata('error', 'Titular guardado exitosamente');
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