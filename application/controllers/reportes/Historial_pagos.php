<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagos
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Historial_pagos extends CI_Controller {

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
            $this->load->model("Pago_model");
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
            $pagos = $this->Pago_model->get_pagos_por_fecha($fecha_inicio, $fecha_fin);
        }
        else
        {
            $pagos = $this->Pago_model->get_pagos();
        }

        $data = array(
            'pagos' => $pagos,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        );

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/reporte/historial_pagos', $data);
        $this->load->view('layouts/footer');
    }
    
}