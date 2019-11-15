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
        
        // Si el usuario no está logeado
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

        if($this->Usuarios_model->save($data))
        {
            redirect(base_url().'gestion/usuarios');
        }
        else
        {
            redirect(base_url().'gestion/usuarios/add');
        }
    }

}