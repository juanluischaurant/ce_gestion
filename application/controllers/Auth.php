<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');  
    }
    
	public function index()
	{
        if($this->session->userdata('login'))
        {
            redirect(base_url().'dashboard');
        }
        else
        { 
            $this->load->view('admin/login');
        }
    }

    /**
     * Inicio de sesión
     * 
     * Esta función se llama al momento de iniciar sesión, se encarga de configurar los datos
     * de sesión y verificar en la base de datos que los datos proveidos sean correctos.
     */
    public function login()
    {
        // Datos obtenidos a través del formulario de inicio de sesión
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Consulta al modelo Usuarios
        $datos_usuario = $this->Usuario_model->login($username, $password);
        
        // SI $datos_usuario retorna como resultado FALSE
        if(!$datos_usuario)
        {
            $this->session->set_flashdata('error', 'El usuario y/o contraseña son incorrectos.');
            redirect(base_url());
        } 
        else
        {
            $data = array(
                'username' => $datos_usuario->username,
                'nombre' => $datos_usuario->nombres,
                'apellidos' => $datos_usuario->apellidos,
                'rol' => $datos_usuario->id_rol,
                'login' => TRUE
            );

            // Almacena los datos de usuario en los datos de sesión
            $this->session->set_userdata($data);
            
            redirect(base_url().'dashboard');
        }
    }

    /**
     * Cierre de sesión
     * 
     * Esta función es llamada al momento en que el usuario desea cerrar sesión,
     * eliminando los datos de sesión almacenados temporalmente durante el inicio de sesión.
     *
     * @return void
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
