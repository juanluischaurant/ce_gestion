<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagos
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Pagos extends CI_Controller {

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
            $this->load->model("Pagos_model");
        }
    }

    public function index() {
        $data = array(
			'pagos' => $this->Pagos_model->getPagos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/pagos/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add() {
		$data = array(
			'tipos_de_operacion' => $this->Pagos_model->getTiposDeOperacion(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/pagos/add', $data);
		$this->load->view('layouts/footer');		
    }

    public function store() {
        $id_banco_operacion = $this->input->post('id-banco-de-operacion');
        $id_tipo_de_pago = $this->input->post('id-tipo-de-pago');
        $id_cliente = $this->input->post('id-cliente');
        $serial_de_pago = $this->input->post('serial-de-pago');
        $numero_de_operacion = $this->input->post('numero-de-operacion-unico');
        $monto_de_operacion = $this->input->post('monto-de-operacion');
        $fecha_de_operacion = $this->input->post('fecha-operacion');

        $this->form_validation->set_rules('numero-de-operacion-unico', 'Número de Operación', 'required|is_unique[pago_de_inscripcion.numero_operacion]'); 

        if($this->form_validation->run()) {
            $data = array(
                'fk_id_banco' => $id_banco_operacion,
                'fk_id_tipo_operacion' => $id_tipo_de_pago,
                'fk_id_cliente' => $id_cliente,
                'serial_pago' => $serial_de_pago,
                'numero_operacion' => $numero_de_operacion,
                'monto_operacion' => $monto_de_operacion,
                'fecha_operacion' => $fecha_de_operacion
            );
    
            if($this->Pagos_model->save($data))
            {
                $id_ultimo_pago = $this->Pagos_model->lastID();
                $this->updateConteoOperaciones($id_tipo_de_pago);
                $this->session->set_flashdata('success', 'Pago registrado exitosamente.');
                redirect(base_url().'movimientos/pagos/');    
            }
            else
            {
                $this->session->set_flashdata('error', 'No se pudo guardar la información.');
                redirect(base_url().'movimientos/pagos/add');
            }

        } else {
            $this->session->set_flashdata('error', 'No se pudo guardar la información.');
            $this->add();
        }
    }

    /**
     * Actualiza el conteo de operaciones al registrar un pago
     *
     * @param integer $id_tipo_operacion
     * @return void
     */
    protected function updateConteoOperaciones($id_tipo_operacion)
    {
        $conteoActual = $this->Pagos_model->getTipoDeOperacion($id_tipo_operacion);
        
        $data = array(
            'conteo_operaciones' => $conteoActual->conteo_operaciones + 1
        );
        
        $this->Pagos_model->updateConteoOperaciones($id_tipo_operacion, $data);
    }
    
    // Métodos utilizados para el pluggin AUTOCOMPLETE
    public function getClientesJSON() {
        $valor = $this->input->post('query');
		$clientes = $this->Pagos_model->getClientesJSON($valor);
		echo json_encode($clientes);
    }

    public function getBancosJSON() {
        $valor = $this->input->post('query');
		$bancos = $this->Pagos_model->getBancosJSON($valor);
		echo json_encode($bancos);
    }
    // Fin: Métodos utilizados para el pluggin AUTOCOMPLETE


}