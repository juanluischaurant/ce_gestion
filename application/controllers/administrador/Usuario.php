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
		$this->load->view('admin/usuarios/list', $data);
		$this->load->view('layouts/footer');
	}

    public function add()
    {
		$data = array(
			'roles' => $this->Usuario_model->roles_dropdown(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/usuarios/add', $data);
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
			$this->load->view('admin/usuarios/edit', $data);
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
		$id_usuario = $this->input->post('id-usuario');

		// $cedula = $this->input->post('cedula-usuario');
		$nombres_usuario = $this->input->post('nombre-usuario');
		$apellidos_usuario = $this->input->post('apellido-usuario');
		$email_usuario = $this->input->post('email-usuario');
		$username_usuario = $this->input->post('username-usuario');
		$password_usuario = $this->input->post('password-usuario');
		$rol_usuario = $this->input->post('rol-usuario');
		$estado = $this->input->post('estado-usuario');

		$data = array(
			'nombres' => $nombres_usuario,
			'apellidos_usuario' => $apellidos_usuario,
			'email' => $email_usuario,
			'username' => $username_usuario,
			'id_rol' => $rol_usuario
		);

		// Verifica si el campo de contraseña está vacío o no
		if($password_usuario !== '')
		{
			// Si el usuario ingresó datos, añadelos al array especificado 
			$data['password_usuario'] = sha1($password_usuario);
		}

		// Reglas declaradas para la validación de formularios en el directorio 
		// application/config/form_validation.php
		if($this->form_validation->run('editar_usuario')) // Si la validación es correcta
		{
			if($this->Usuario_model->update($id_usuario, $data))
			{
				$fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión activa
				$fk_id_tipo_accion = 3; // Tipo de acción ejecudada (clave foránea: 3 = modificar) 
				$descripcion_accion = "Usuario ID: " . $id_usuario; // Texto de descripción de acción
				$tabla_afectada = "Usuario"; // Tabla afectada

				$agregar_accion = $this->Accion_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				redirect(base_url().'administrador/usuario');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'administrador/usuario/edit'.$id_usuario);
			}
		}
		else // la validación no es correcta
		{
			// $this hace referencia al módulo donde es invocado
			$this->edit($id_usuario);
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
        $nombres_usuario = $this->input->post('nombre-usuario');
        $apellidos_usuario = $this->input->post('apellido-usuario');
        $username_usuario = $this->input->post('username-usuario');
        $password_usuario = $this->input->post('password-usuario');
        $rol_usuario = $this->input->post('rol-usuario');
        $email_usuario = $this->input->post('email-usuario');

        $data = array(
            'nombres' => $nombres_usuario,
            'apellidos' => $apellidos_usuario,
            'username' => $username_usuario,
            'password' => sha1($password_usuario),
            'id_rol' => $rol_usuario,
            'email' => $email_usuario
        );

        $this->form_validation->set_rules('username-usuario', 'Username', 'required|is_unique[usuario.username_usuario]|min_length[6]|max_length[25]'); 

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

		$this->load->view('admin/usuarios/view', $data);
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
	 * @param integer $username
	 * @return boolean
	 */
	public function edit_unique_usuario($username)
	{
		$this->db->where_not_in('id_usuario', $this->input->post('id-usuario'));
		$this->db->where('username_usuario', $username);

		if($this->db->count_all_results('usuario') > 0)
		{
			return false; // No se valida el campo
		}
		else
		{
			return true;
		}
	}

}