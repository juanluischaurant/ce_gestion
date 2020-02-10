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
class Accion extends CI_Controller
{
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
            $this->load->model('Accion_model'); 
        }
         
    }

    
    public function index()
    {
        // Captura la data enviada por la solicitud POST
        $fecha_fin = $this->input->post('fecha_fin');
        $fecha_inicio = $this->input->post('fecha_inicio');

        // En caso de que el botón buscar haya sido presionado
        // carga la búsqueda por fecha
        if($this->input->post('buscar'))
        {
            $acciones = $this->Accion_model->get_acciones_por_fecha($fecha_inicio, $fecha_fin);
        }
        else
        {
            $acciones = $this->Accion_model->get_acciones();
        }

        $data = array(
            'acciones' => $acciones
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reporte/acciones', $data);
        $this->load->view('layouts/footer');
    }
}