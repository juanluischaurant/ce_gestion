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
		$id_usuario = $this->input->post('id_inscripcion');

		$data = array(
			'usuario' => $this->Usuarios_model->get_usuario($id_usuario),
		);

		$this->load->view('admin/usuarios/view', $data);
    }

}