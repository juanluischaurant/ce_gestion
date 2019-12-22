<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase Usuarios
 * 
 * Gestiona lo referente a Usuarios que pueden utilizar
 * CE Gestión, cada uno con nivel de accesibilidad asignado
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Usuarios extends CI_Controller {

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
            $this->load->model("Usuarios_model");
        }
    }
    
    public function index()
    {
		$data = array(
			'usuarios' => $this->Usuarios_model->get_usuarios(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/usuarios/list', $data);
		$this->load->view('layouts/footer');
	}

    public function add()
    {
		$data = array(
			'roles' => $this->Usuarios_model->roles_dropdown(),
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
			redirect(base_url().'gestion/usuarios/');
		}
		else
		{
			$data = array(
				'usuario' => $this->Usuarios_model->get_usuario($id),
				'roles' => $this->Usuarios_model->roles_dropdown()
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
		$password_usuario = $this->input->post('nacimiento-usuario');
		$rol_usuario = $this->input->post('rol-usuario');
		$estado_usuario = $this->input->post('nacimiento-usuario');

		$data = array(
			'nombres_usuario' => $nombres_usuario,
            'apellidos_usuario' => $apellidos_usuario,
            'username_usuario' => $username_usuario,
            // 'password_usuario' => sha1($password_usuario),
            'fk_rol_id_1' => $rol_usuario,
            'email_usuario' => $email_usuario
		);

		// Reglas declaradas para la validación de formularios en el directorio 
		// application/config/form_validation.php
		if($this->form_validation->run('editar_usuario')) // Si la validación es correcta
		{
			if($this->Usuarios_model->update($id_usuario, $data))
			{
				// $fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
				// $fk_id_tipo_accion = 3; // Tipo de acción ejecudada (clave foránea: 3=modificar) 
				// $descripcion_accion = "PERSONA ID: " . $usuario_id; // Texto de descripción de acción
				// $tabla_afectada = "PERSONA"; // Tabla afectada

				// $agregar_accion = $this->Acciones_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				redirect(base_url().'gestion/usuarios');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'gestion/usuarios/edit'.$id_usuario);
			}
		}
		else
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
            'nombres_usuario' => $nombres_usuario,
            'apellidos_usuario' => $apellidos_usuario,
            'username_usuario' => $username_usuario,
            'password_usuario' => sha1($password_usuario),
            'fk_rol_id_1' => $rol_usuario,
            'email_usuario' => $email_usuario
        );

        $this->form_validation->set_rules('username-usuario', 'Username', 'required|is_unique[usuario.username_usuario]|min_length[6]|max_length[25]'); 

        if($this->form_validation->run())
        {
            if($this->Usuarios_model->save($data))
            {
                $this->session->set_flashdata('success', 'Usuario '.$username_usuario.' agregado correctamente.');
                redirect(base_url().'gestion/usuarios');
            }
            else
            {
                redirect(base_url().'gestion/usuarios/add');
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
			'usuario' => $this->Usuarios_model->get_usuario($id_usuario),
		);

		$this->load->view('admin/usuarios/view', $data);
    }

    public function delete($id_usuario)
	{
		$data = array(
			'estado_usuario' => 0,
		);
		
		if($this->Usuarios_model->update($id_usuario, $data))
		{
			// $fk_id_usuario = $this->session->userdata('id_usuario'); // ID del usuario con sesión iniciada
			// $fk_id_tipo_accion = 1; // Tipo de acción ejecudada (clave foránea: 3=modificar) 
			// $descripcion_accion = "PERSONA ID: " . $persona_id; // Texto de descripción de acción
			// $tabla_afectada = "PERSONA"; // Tabla afectada

			// $agregar_accion = $this->Acciones_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);

			echo 'gestion/usuarios';
		};
	}

}