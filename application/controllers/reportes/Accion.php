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
        $this->load->model('Accion_model');  
    }

    
    public function index()
    {
        $data = array(
            'acciones' => $this->Accion_model->get_acciones()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reporte/acciones', $data);
        $this->load->view('layouts/footer');
    }
}