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
		$this->load->view('admin/persona/list', $data);
		$this->load->view('layouts/footer');
    }
    
	public function add()
	{
		$data = array(
			'lista_generos' => $this->Persona_model->generos_dropdown()
		);
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/persona/add', $data);
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
		$cedula = $this->input->post("cedula_persona");

		$data = array(
			"persona" => $this->Persona_model->get_persona($cedula),
			'es_participante' => $this->Persona_model->get_es_participante($cedula),
			'es_titular' => $this->Persona_model->get_es_titular($cedula),
			'es_facilitador' => $this->Persona_model->get_es_facilitador($cedula),

		);

		$this->load->view("admin/persona/view", $data);
	}

	public function edit($cedula = NULL)
	{
		// ¿$id es nulo?
		if(!isset($cedula))
		{
			redirect(base_url().'gestion/persona/');
		}
		else
		{
			$data = array(
				'persona' => $this->Persona_model->get_persona($cedula),
				'lista_generos' => $this->Persona_model->generos_dropdown()
			);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/persona/edit', $data);
			$this->load->view('layouts/footer');
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
        $this->load->view('admin/persona/success', $data_persona);
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
		$cedula_persona = $this->input->post('cedula_persona');
		$participante = $this->input->post('participante');
		$nivel_academico_participante = $this->input->post('nivel_academico_participante');
		$titular = $this->input->post('titular');

		if($participante !== '')
		{
			$no_registrado = $this->Participante_model->duplicidad_participante($cedula_persona);

			// Verifica si esta persona ya está registrada como participante
			if($no_registrado === TRUE)
			{
				$data_participante = array(
					'cedula_persona' => $cedula_persona,
					'id_nivel_academico' => $nivel_academico_participante
				);

				if($this->Participante_model->save($data_participante))
				{
					$this->guardar_accion(2, $cedula_persona, 'PARTICIPANTE');
				}
			}
		}

		if($titular !== '')
		{
			// Verifica si esta persona ya está registrada como titular
			$no_registrado = $this->Titular_model->duplicidad_titular($cedula_persona);

			if($no_registrado === TRUE)
			{
				$data_titular = array( 'cedula_persona' => $cedula_persona, );

				if($this->Titular_model->save($data_titular))
				{
					$this->guardar_accion(2, $cedula_persona, 'TITULAR');
				}
			}
		}
	}

	/**
	 * Método invocado al presionar el botón de guardado en el formulario correspondiente
	 *
	 * @return void
	 */
	public function store() 
	{
		$cedula = $this->input->post("cedula_persona");
		$primer_nombre = $this->input->post('primer_nombre');
		$primer_apellido = $this->input->post('primer_apellido');
		$fecha_nacimiento = $this->input->post('nacimiento_persona');
		$genero = $this->input->post('genero_persona');
		$telefono = $this->input->post('telefono_persona');
		$correo_electronico = $this->input->post('correo-persona');
		$direccion = $this->input->post('direccion_persona');
		
		$data_persona = array(
			'cedula' => $cedula,
			'primer_nombre' => $primer_nombre,
			'primer_apellido' => $primer_apellido,
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
				$this->guardar_accion(2, $cedula, 'PERSONA');
				
				// Redirige a la vista "success" dentro de este controlador
				// $this->success($id_ultimo_registro);
				redirect(base_url().'gestion/persona/success/'.$cedula);
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
	
	public function update() 
	{
		$cedula = $this->input->post('cedula_persona');
		$primer_nombre = $this->input->post('primer_nombre');
		$primer_apellido = $this->input->post('primer_apellido');
		$genero = $this->input->post('genero_persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$telefono = $this->input->post('telefono_persona');
		$direccion = $this->input->post('direccion_persona');

		$data = array(
			'cedula' => $cedula,
			'primer_nombre' => $primer_nombre,
			'primer_apellido' => $primer_apellido,
			'fecha_nacimiento' => $fecha_nacimiento,
			'genero' => $genero,
			'telefono' => $telefono,
			'direccion' => $direccion
		);

		// Reglas declaradas para la validación de formularios integrada en CodeIgniter

		// Si la validación es correcta
		if($this->form_validation->run('editar_persona'))
		{
			if($this->Persona_model->update($cedula, $data))
			{
				$this->guardar_accion(3, $cedula, 'PERSONA');

				$this->session->set_flashdata('success', 'Datos actualizados correctamente');
				redirect(base_url().'gestion/persona');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'gestion/persona/edit'.$cedula);
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->edit($cedula);
		}		
	}

	public function delete($cedula_persona)
	{
		$data = array(
			'estado' => 0,
		);
		
		if($this->Persona_model->update($cedula_persona, $data))
		{
			$this->guardar_accion(1, $cedula, 'PERSONA');
			echo 'gestion/persona';
		};
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
		$this->db->where_not_in('cedula', $this->input->post('cedula_persona'));
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