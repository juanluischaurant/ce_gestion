<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Inscripcion_model');  
    }

    public function index() {
        $data = array(
            'inscripciones' => $this->Inscripcion_model->getInscripciones()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reportes/inscripciones', $data);
        $this->load->view('layouts/footer');
    }
}

