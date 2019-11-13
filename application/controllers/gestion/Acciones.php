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
class Clientes extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Acciones_model');  
    }