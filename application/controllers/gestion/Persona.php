<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones en común utilizadas por las sub-clases de
 * persona, entre las que cuentan: Facilitador, Cliente(Titular), Participnte
 * 
 * @package CE_gestion
 * @subpackage Persona
 * @category Controladores
 */
class Persona extends CI_Controller {

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
			$this->load->model('Titular_model');  
			$this->load->model('Accion_model');  
			$this->load->model('Nivel_academico_model');
        }
    }

	public function index()
	{
		$data = array(
			'permisos' => $this->permisos,
			'personas' => $this->Persona_model->get_personas(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/personas/list', $data);
		$this->load->view('layouts/footer');
    }
    
	public function add()
	{
		$data = array(
			'lista_generos' => $this->Persona_model->generos_dropdown()
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
			"persona" => $this->Persona_model->get_persona($idParticipante),
			'es_participante' => $this->Persona_model->get_es_participante($idParticipante),
			'es_titular' => $this->Persona_model->get_es_titular($idParticipante),
			'es_facilitador' => $this->Persona_model->get_es_facilitador($idParticipante),

		);

		$this->load->view("admin/personas/view", $data);
	}

	public function edit($id_persona = NULL)
	{
		// ¿$id es nulo?
		if(!isset($id_persona))
		{
			redirect(base_url().'gestion/persona/');
		}
		else
		{
			$data = array(
				'persona' => $this->Persona_model->get_persona($id_persona),
				'lista_generos' => $this->Persona_model->generos_dropdown()
			);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/personas/edit', $data);
			$this->load->view('layouts/footer');
		}
	}
	
	/**
	 * Método invocado al presionar el botón de guardado en el formulario correspondiente
	 *
	 * @return void
	 */
	public function store() 
	{
		$cedula = $this->input->post("cedula-persona");
		$nombres = $this->input->post('nombre-persona');
		$apellidos = $this->input->post('apellido-persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$genero = $this->input->post('genero-persona');
		$telefono = $this->input->post('telefono-persona');
		$correo_electronico = $this->input->post('correo-persona');
		$direccion = $this->input->post('direccion-persona');
		
		$data_persona = array(
			'cedula' => $cedula,
			'nombres' => $nombres,
			'apellidos' => $apellidos,
			'fecha_nacimiento' => $fecha_nacimiento,
			'genero' => $genero,
			'telefono' => $telefono,
			'correo_electronico' => $correo_electronico,
			'direccion' => $direccion,
			'estado' => '1'
		);
		
		// Reglas declaradas para la validación de formularios en el directorio application/config/form_validation.php
		// Si la validación es correcta
		if($this->form_validation->run('agregar_persona'))
		{
			// Procede a guardar los datos
			if($this->Persona_model->save($data_persona))
			{ 
				$id_ultimo_registro = $this->Persona_model->lastID(); // id del último registro creado

				$id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
				$id_tipo_accion = 2; // Tipo de acción ejecudada (clave foránea)
				$descripcion = "PERSONA ID: " . $id_ultimo_registro; // Texto de descripción de acción
				$tabla_afectada = "PERSONA"; // Tabla afectada

				$agregar_accion = $this->Accion_model->save_action($id_usuario, $id_tipo_accion, $descripcion, $tabla_afectada);
	
				// Redirige a la vista "success" dentro de este controlador
				// $this->success($id_ultimo_registro);
				redirect(base_url().'gestion/persona/success/'.$id_ultimo_registro);
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/persona/add');	
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->add();
		}	
	}
	
	/**
	 * Carga en la vista una pantalla que permite al usuario escoger un rol
	 * para el registro Persona recien almacenado.
	 *
	 * @param string $ultimo_id
	 * @return void
	 */
	// cambiar a protected
	public function success($ultimo_id = 'no_id')
	{
        $data_persona = array(
			'persona' => $this->Persona_model->get_persona($ultimo_id),
			'lista_niveles' => $this->Nivel_academico_model->niveles_academicos_dropdown()
		);
		
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/success', $data_persona);
		$this->load->view('layouts/footer');	
	}
	
	/**
	 * Añadir Rol
	 * 
	 * Dentro del Sistema, cada persona puede tener 3 roles:
	 * Titular
	 * Participante
	 * Facilitador
	 * 
	 * Luego que una persona se ha registrado, se le muestra al usuario una
	 * ventana que le permite asignarle distintos roles a una persona.
	 *
	 * @return void
	 */
	public function add_rol()
	{
		$id_persona = $this->input->post('id_persona');
		$participante = $this->input->post('participante');
		$nivel_academico_participante = $this->input->post('nivel_academico_participante');
		$titular = $this->input->post('titular');

		$mensaje = '';

		if($participante !== '')
		{
			$no_registrado = $this->Participante_model->duplicidad_participante($id_persona);

			// Verifica si esta persona ya está registrada como participante
			if($no_registrado === TRUE)
			{
				$data_participante = array(
					'id_persona' => $id_persona,
					'id_nivel_academico' => $nivel_academico_participante
				);

				$this->Participante_model->save($data_participante);
				echo 'hi';
				$mensaje .= 'participante';
			}
		}

		if($titular !== '')
		{
			$no_registrado = $this->Titular_model->duplicidad_persona($id_persona);
			// Verifica si esta persona ya está registrada como titular
			if($no_registrado === TRUE)
			{
				$data_titular = array( 'id_persona' => $id_persona, );

				$this->Titular_model->save($data_titular);
				echo 'ho';
				$mensaje .= ' titular';
			}
		}

		echo $mensaje;
	}
	
	public function update() 
	{
		$id_persona = $this->input->post('id-persona');

		$cedula = $this->input->post('cedula-persona');
		$nombres = $this->input->post('nombre-persona');
		$apellidos = $this->input->post('apellido-persona');
		$genero = $this->input->post('genero-persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$telefono = $this->input->post('telefono-persona');
		$direccion = $this->input->post('direccion-persona');

		$data = array(
			'cedula' => $cedula,
			'nombres' => $nombres,
			'apellidos' => $apellidos,
			'fecha_nacimiento' => $fecha_nacimiento,
			'genero' => $genero,
			'telefono' => $telefono,
			'direccion' => $direccion
		);

		// Reglas declaradas para la validación de formularios integrada en CodeIgniter

		// Si la validación es correcta
		if($this->form_validation->run('editar_persona'))
		{
			if($this->Persona_model->update($id_persona, $data))
			{
				$fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
				$fk_id_tipo_accion = 3; // Tipo de acción ejecudada (clave foránea: 3=modificar) 
				$descripcion_accion = "PERSONA ID: " . $id_persona; // Texto de descripción de acción
				$tabla_afectada = "PERSONA"; // Tabla afectada

				$agregar_accion = $this->Accion_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				redirect(base_url().'gestion/persona');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'gestion/persona/edit'.$id_persona);
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->edit($id_persona);
		}		
	}

	public function delete($id_persona)
	{
		$data = array(
			'estado' => 0,
		);
		
		if($this->Persona_model->update($id_persona, $data))
		{
			$fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
			$fk_id_tipo_accion = 1; // Tipo de acción ejecudada (clave foránea: 3=modificar) 
			$descripcion_accion = "PERSONA ID: " . $id_persona; // Texto de descripción de acción
			$tabla_afectada = "PERSONA"; // Tabla afectada

			$agregar_accion = $this->Accion_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);

			echo 'gestion/persona';
		};
	}

	/**
	 * Permite que al momento de actualizar la cédula de determinada persona, se verifique
	 * que esta sea única o no, al momento de realizar la edición.
	 * 
	 * Este método se declara para ser utilizado como regla de validación de formulario
	 * personalizada. El método actualmente se llama desde el directorio personalizado 
	 * application/config/form_validation.php
	 *
	 * @param integer $cedula
	 * @return boolean
	 */
	public function edit_unique_cedula($cedula)
	{
		$this->db->where_not_in('id', $this->input->post('id-persona'));
		$this->db->where('cedula', $cedula);

		if($this->db->count_all_results('persona') > 0)
		{
			return false; // No se valida el campo
		}
		else
		{
			return true;
		}
	}
}