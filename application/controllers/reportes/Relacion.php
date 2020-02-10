<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión
 * donde sea necesario consultar información relacionada al historial de acciones
 *
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Relacion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

		// El archivo backend_lip fue creado por el programador
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();

        // Si el usuario no está logeado
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el controlador
            $this->load->model('Relacion_model');
            $this->load->model('Curso_model');
        }

    }

    public function index()
    {
        $data = array(
            'cursos' => $this->Curso_model->get_cursos()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reporte/relaciones', $data);
        $this->load->view('layouts/footer');
    }

    public function relacion_curso($id_curso)
    {
        $data = array(
            'curso' => $this->Curso_model->get_curso($id_curso),
            'inscripciones' => $this->Relacion_model->get_relacion_curso($id_curso)
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reporte/relacion', $data);
        $this->load->view('layouts/footer');
    }
}