<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Curso_model');  
    }

    public function index() {
        $data = array(
            'cursos' => $this->Curso_model->get_cursos()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/reportes/cursos', $data);
        $this->load->view('layouts/footer');
    }
}