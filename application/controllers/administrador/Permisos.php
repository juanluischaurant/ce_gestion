<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase Permisos
 * 
 * Gestiona lo referente a Permisos de Usuario dentro de
 * CE Gestión, cada uno con nivel de accesibilidad asignado
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Permisos extends CI_Controller {
    
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
            $this->load->model("Permisos_model");
            $this->load->model("Usuarios_model");
        }
    }

    public function index()
    {
		$data = array(
			'permisos' => $this->Permisos_model->get_permisos(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permisos/list', $data);
		$this->load->view('layouts/footer');
	}

    public function add()
    {
		$data = array(
			'roles' => $this->Usuarios_model->roles_dropdown(),
			'menus' => $this->Permisos_model->menus_dropdown(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permisos/add', $data);
		$this->load->view('layouts/footer');
    }
    
    public function store()
    {
        $menu = $this->input->post('menu');
        $rol = $this->input->post('rol');
        $leer = $this->input->post('leer');
        $insertar = $this->input->post('insertar');
        $editar = $this->input->post('editar');
        $eliminar = $this->input->post('eliminar');

        $data = array(
            'fk_id_menu_1' => $menu,
            'fk_id_rol_2' => $rol,
            'read' => $leer,
            'insert' => $insertar,
            'update' => $editar,
            'delete' => $eliminar
        );

        if($this->Permisos_model->save($data))
        {
            redirect(base_url().'administrador/permisos');
        }
        else
        {
            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url().'administrador/permisos/add');
        }
    }
}