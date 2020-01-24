<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Curso_model');  
    }

    public function index() {
        $data = array(
            'especialidades' => $this->Curso_model->get_cursos()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reportes/especialidades', $data);
        $this->load->view('layouts/footer');
    }
}