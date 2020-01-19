<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones utilizadas a lo largo de CE_Gestión 
 * donde sea necesario consultar información relacionada a participantes
 * 
 * @package CE_gestion
 * @subpackage Participante
 * @category Controladores
 */
class Nivel_academico extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		
		// Si el usuario no ha iniciado sesión
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el controlador
			$this->load->model('Nivel_academico_model');  
		}	
    }
}