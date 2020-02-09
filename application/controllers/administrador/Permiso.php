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
class Permiso extends CI_Controller {
    
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
            $this->load->model("Permiso_model");
            $this->load->model("Usuario_model");
        }
    }

    public function index()
    {
		$data = array(
			'permisos' => $this->Permiso_model->get_permisos(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permiso/list', $data);
		$this->load->view('layouts/footer');
	}

    public function add()
    {
		$data = array(
			'roles' => $this->Usuario_model->roles_dropdown(),
			'menus' => $this->Permiso_model->menus_dropdown(),
        );
        
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permiso/add', $data);
		$this->load->view('layouts/footer');
    }

    public function edit($id_permiso)
    {
        $data = array(
            'roles' => $this->Usuario_model->roles_dropdown(),
            'menus' => $this->Permiso_model->menus_dropdown(),
            'permiso' => $this->Permiso_model->get_permiso($id_permiso)
        );

        $this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/permiso/edit', $data);
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
            'id_menu' => $menu,
            'id_rol' => $rol,
            'read' => $leer,
            'insert' => $insertar,
            'update' => $editar,
            'delete' => $eliminar
        );

        if($this->permiso_unico($rol, $menu) == TRUE)
        {
            if($this->Permiso_model->save($data))
            {
                redirect(base_url().'administrador/permiso');
            }
            else
            {
                $this->session->set_flashdata('error', 'No se pudo guardar la información');
                redirect(base_url().'administrador/permiso/add');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'El rol ya fué asignado al menú que intentas seleccionar');
            redirect(base_url().'administrador/permiso/add');
        }
    }
    
    public function update()
    {
        $id_permiso = $this->input->post('id_permiso');

        $menu = $this->input->post('menu');
        $rol = $this->input->post('rol');
        $leer = $this->input->post('leer');
        $insertar = $this->input->post('insertar');
        $editar = $this->input->post('editar');
        $eliminar = $this->input->post('eliminar');

        $data = array(
            'id_menu' => $menu,
            'id_rol' => $rol,
            'read' => $leer,
            'insert' => $insertar,
            'update' => $editar,
            'delete' => $eliminar
        );

        if($this->Permiso_model->update($id_permiso, $data))
        {
            $this->session->set_flashdata('success', 'Se actualizó exitosamente el permiso');
            redirect(base_url().'administrador/permiso');
        }
        else
        {
            $this->session->set_flashdata('error', 'No se pudo guardar la información');
            redirect(base_url().'administrador/permiso/add');
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
	public function permiso_unico($id_rol, $id_menu)
	{
		$this->db->where('id_rol', $id_rol);
		$this->db->where('id_menu', $id_menu);

		if($this->db->count_all_results('permiso') > 0)
		{
			return FALSE; // No se valida el campo
		}
		else
		{
			return TRUE;
		}
	}
}