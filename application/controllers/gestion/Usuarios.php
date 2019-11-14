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
		// $data = array(
		// 	'locaciones' => $this->Locaciones_model->getLocaciones(),
        // );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/usuarios/list');
		$this->load->view('layouts/footer');
	}


}