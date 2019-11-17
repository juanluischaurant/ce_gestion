<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones en común utilizadas por las sub-clases de
 * persona, entre las que cuentan: Facilitador, Cliente(Titular), Participnte
 * 
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Personas extends CI_Controller {

	public function __construct()
	{
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
			$this->load->model('Personas_model');  
			$this->load->model('Acciones_model');  
        }
    }

	public function index()
	{
		$data = array(
			'personas' => $this->Personas_model->getPersonas(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/personas/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add() {
		$data = array(
			'lista_generos' => $this->Personas_model->generos_dropdown()
		);
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/add', $data);
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
		$idParticipante = $this->input->post("id_persona");

		$data = array(
			"persona" => $this->Personas_model->getPersona($idParticipante),
		);

		$this->load->view("admin/personas/view", $data);
	}
	
	public function store() 
	{
		$cedula = $this->input->post("cedula-persona");
		$nombres = $this->input->post('nombre-persona');
		$apellidos = $this->input->post('apellido-persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$genero = $this->input->post('genero-persona');
		$telefono = $this->input->post('telefono-persona');
		$direccion = $this->input->post('direccion-persona');
		
		$data_persona = array(
			'cedula_persona' => $cedula,
			'nombres_persona' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion,
			'estado_persona' => '1'
		);
		
		// Reglas declaradas para la validación de formularios en el directorio config/form_validation.php
		// Si la validación es correcta
		if($this->form_validation->run('agregar_persona'))
		{
			// Procede a guardar los datos
			if($this->Personas_model->save($data_persona))
			{ 
				$id_ultimo_registro = $this->Personas_model->lastID(); // id del último registro creado

				$fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
				$fk_id_tipo_accion = 2; // Tipo de acción ejecudada (clave foránea)
				$descripcion_accion = "PERSONA ID: " . $id_ultimo_registro; // Texto de descripción de acción
				$tabla_afectada = "PERSONA"; // Tabla afectada

				$agregar_accion = $this->Acciones_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				// Redirige a la vista "success" dentro de este controlador
				redirect(base_url().'gestion/personas/success/'.$id_ultimo_registro);
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/personas/add');	
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->add();
		}
		
    }
    
    public function success($ultimo_id = 'no_id') {

        $data_persona = array(
			'persona' => $this->Personas_model->getPersona($ultimo_id),
		);
		
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/success', $data_persona);
		$this->load->view('layouts/footer');
		
    }

	public function update() 
	{
		$persona_id = $this->input->post('id-persona');

		$cedula = $this->input->post('cedula-persona');
		$nombres = $this->input->post('nombre-persona');
		$apellidos = $this->input->post('apellido-persona');
		$genero = $this->input->post('genero-persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$telefono = $this->input->post('telefono-persona');
		$direccion = $this->input->post('direccion-persona');

		$data = array(
			'cedula_persona' => $cedula,
			'nombres_persona' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion
		);

		// Reglas declaradas para la validación de formularios integrada en CodeIgniter
		// $this->form_validation->set_rules();


		// Si la validación es correcta
		if($this->form_validation->run('editar_persona'))
		{
			if($this->Personas_model->update($persona_id, $data))
			{
				$fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
				$fk_id_tipo_accion = 3; // Tipo de acción ejecudada (clave foránea: 3=modificar) 
				$descripcion_accion = "PERSONA ID: " . $persona_id; // Texto de descripción de acción
				$tabla_afectada = "PERSONA"; // Tabla afectada

				$agregar_accion = $this->Acciones_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				redirect(base_url().'gestion/personas');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'gestion/personas/edit'.$persona_id);
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->edit($persona_id);
		}		
	}

	public function edit($id = NULL)
	{
		//  ¿$id es nulo?
		if(!isset($id))
		{
			redirect(base_url().'gestion/personas/');
		}
		else
		{
			$data = array(
				'persona' => $this->Personas_model->getPersona($id),
				'lista_generos' => $this->Personas_model->generos_dropdown()
			);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/personas/edit', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function delete($id) {
		$data = array(
			'estado_persona' => 0,
		);
		$this->Personas_model->update($id, $data);
		echo 'gestion/personas';
	}

	/**
	 * Editar Cédula
	 * 
	 * Este método se declara para ser utilizado como regla de validación de formulario
	 * personalizada. El método actualmente se llama desde el directorio personalizado 
	 * config/form_validation.php
	 *
	 * @param integer $cedula
	 * @return boolean
	 */
	public function edit_unique_cedula($cedula)
	{
		$this->db->where_not_in('persona_id', $this->input->post('id-persona'));
		$this->db->where('cedula_persona', $cedula);

		if($this->db->count_all_results('persona') > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}