<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase Usuario
 * 
 * Gestiona lo referente a Usuario que pueden utilizar
 * CE Gestión, cada uno con nivel de accesibilidad asignado
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Usuario extends CI_Controller {

	private $permisos;

    public function __construct()
    {

		parent::__construct();
	
		// El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();
	
		if(!$this->session->userdata('login')) // Si el usuario no ha iniciado sesión
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el modélo
            $this->load->model("Usuario_model");
            $this->load->model("Accion_model");
        }
    }
    
    public function index()
    {
		$data = array(
			'usuarios' => $this->Usuario_model->get_usuarios(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/usuario/list', $data);
		$this->load->view('layouts/footer');
	}

    public function add()
    {
		$data = array(
			'roles' => $this->Usuario_model->roles_dropdown(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/usuario/add', $data);
		$this->load->view('layouts/footer');
    }
    
	public function edit($id = NULL)
	{
		//  ¿$id es nulo?, de ser verdad, redirecciona a la vista de lista
		if(!isset($id))
		{
			redirect(base_url().'administrador/usuario/');
		}
		else
		{
			$data = array(
				'usuario' => $this->Usuario_model->get_usuario($id),
				'roles' => $this->Usuario_model->roles_dropdown()
			);
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/usuario/edit', $data);
			$this->load->view('layouts/footer');
		}
	}

	 /**
	  * Actualiza un usuario
	  *
	  * Método llamado al momento de presionar el botón de guardar en el módulo de edición
	  *
	  * @return void
	  */ 
	public function update() 
	{
		$username_actual = $this->input->post('username-actual'); // Username en uso actualmente
		$username_usuario = $this->input->post('username-usuario'); // Username propuesto
		$password_usuario = $this->input->post('password-usuario');
		$rol_usuario = $this->input->post('rol-usuario');
		$estado = $this->input->post('estado-usuario');

		$data = array(
			'id_rol' => $rol_usuario
		);

		if($username_usuario !== $username_actual)
		{			
			if($this->form_validation->run('username_check'))
			{
				$data['username'] = $username_usuario;
			}
		}

		// Verifica si el campo de contraseña está vacío o no
		if($password_usuario !== '')
		{
			// Si el usuario ingresó datos desde el formulario, añadelos al array especificado 
			$data['password'] = sha1($password_usuario);
		}

		// Reglas declaradas para la validación de formularios en el directorio 
		// application/config/form_validation.php
		if($this->form_validation->run('editar_usuario'))
		{
			// Si la validación es correcta
			if($this->Usuario_model->update($username_actual, $data))
			{
				// $fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión activa
				// $fk_id_tipo_accion = 3; // Tipo de acción ejecudada (clave foránea: 3 = modificar) 
				// $descripcion_accion = "Usuario ID: " . $id_usuario; // Texto de descripción de acción
				// $tabla_afectada = "Usuario"; // Tabla afectada

				// $agregar_accion = $this->Accion_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				redirect(base_url().'administrador/usuario');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'administrador/usuario/edit/'.$username);
			}
		}
		else 
		{
			// la validación no es correcta

			// $this hace referencia al módulo donde es invocado
			$this->edit($username_actual);
		}		
	}

	/**
	 * Almacenar un usuario
	 * 
	 * Método llamado al momento de presionar el botón de guardado en el formulario correspondiente
	 *
	 * @return void
	 */
    public function store()
    {
        $username_usuario = $this->input->post('username-usuario');
        $password_usuario = $this->input->post('password-usuario');
        $rol_usuario = $this->input->post('rol-usuario');

        $data = array(
            'username' => $username_usuario,
            'password' => sha1($password_usuario),
            'id_rol' => $rol_usuario,
        );

        $this->form_validation->set_rules('username-usuario', 'Username', 'required|is_unique[usuario.username_usuario]|min_length[6]|max_length[10]'); 

        if($this->form_validation->run())
        {
            if($this->Usuario_model->save($data))
            {
                $this->session->set_flashdata('success', 'Usuario '.$username_usuario.' agregado correctamente.');
                redirect(base_url().'administrador/usuario');
            }
            else
            {
                redirect(base_url().'administrador/usuario/add');
            }
        }
        else
        {
            $this->add();
        }
    }

    public function view()
    {
		$id_usuario = $this->input->post('id_usuario');

		$data = array(
			'usuario' => $this->Usuario_model->get_usuario($id_usuario),
		);

		$this->load->view('admin/usuario/view', $data);
    }

    public function delete($id_usuario)
	{
		$data = array(
			'estado' => 0,
		);
		
		if($this->Usuario_model->update($id_usuario, $data))
		{
			$id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
			$id_tipo_accion = 1; // Tipo de acción ejecudada (clave foránea: 1 = Desactivar) 
			$descripcion = "Usuario ID: " . $id_usuario; // Texto de descripción de acción
			$tabla_afectada = "Usuario"; // Tabla afectada

			$agregar_accion = $this->Accion_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);

			echo 'administrador/usuario';
		};
	}

	/**
	 * Permite que al momento de actualizar el nombre único de determinado usuario, se verifique
	 * que esta sea único o no, al momento de realizar la edición.
	 * 
	 * Este método se declara para ser utilizado como regla de validación de formulario
	 * personalizada. El método actualmente se llama desde el directorio personalizado 
	 * application/config/form_validation.php
	 *
	 * @param string $username
	 * @return boolean
	 */
	public function edit_unique_usuario($username)
	{
		$this->db->where('username', $username);

		if($this->db->count_all_results('usuario') > 0)
		{
			return FALSE; // No se valida el campo
		}
		else
		{
			return TRUE;
		}
	}

}