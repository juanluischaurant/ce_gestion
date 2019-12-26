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

    public function index()
    {
        $data = array(
			'pagos' => $this->Pagos_model->getPagos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/pagos/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add()
    {
		$data = array(
			'tipos_de_operacion' => $this->Pagos_model->get_tipos_de_operacion(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/pagos/add', $data);
		$this->load->view('layouts/footer');		
    }

    public function store()
    {
        $modulo = $this->input->post('modulo-actual');

        $id_banco_operacion = $this->input->post('id-banco-de-operacion');
        $id_tipo_de_pago = $this->input->post('id-tipo-de-pago');
        $id_cliente = $this->input->post('id-titular');
        $serial_de_pago = $this->input->post('serial-de-pago');
        $numero_de_operacion = $this->input->post('numero-de-operacion-unico');
        $monto_de_operacion = $this->input->post('monto-de-operacion');
        $fecha_de_operacion = $this->input->post('fecha-operacion');

        $this->form_validation->set_rules('numero-de-operacion-unico', 'Número de Operación', 'required|is_unique[pago_de_inscripcion.numero_operacion]'); 

        if($this->form_validation->run())
        {
            $data = array(
                'fk_id_banco' => $id_banco_operacion,
                'fk_id_tipo_operacion' => $id_tipo_de_pago,
                'fk_id_titular' => $id_cliente,
                'serial_pago' => $serial_de_pago,
                'numero_operacion' => $numero_de_operacion,
                'monto_operacion' => $monto_de_operacion,
                'fecha_operacion' => $fecha_de_operacion
            );
    
            if($this->Pagos_model->save($data))
            {
                $id_ultimo_pago = $this->Pagos_model->lastID();
                $this->actualizar_conteo_operaciones($id_tipo_de_pago);
                $this->session->set_flashdata('success', 'Pago registrado exitosamente.');

                redirect(base_url().'movimientos/pagos/');    
            }
            else
            {
                $this->session->set_flashdata('error', 'No se pudo guardar la información.');
                redirect(base_url().'movimientos/pagos/add');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'No se pudo guardar la información.');
            $this->add();
        }
    }

    /**
     * Método diseñado para almacenar un pago por medio de una llamada AJAX
     *
     * @return void
     */
    public function store_ajax()
    {
        $id_banco_operacion = $this->input->post('id_banco_operacion');
        $id_tipo_de_pago = $this->input->post('fk_id_tipo_operacion');
        $id_cliente = $this->input->post('id_cliente');
        $serial_de_pago = $this->input->post('serial_de_pago');
        $numero_de_operacion = $this->input->post('numero_de_operacion');
        $monto_de_operacion = $this->input->post('monto_de_operacion');
        $fecha_de_operacion = $this->input->post('fecha_de_operacion');

        $this->form_validation->set_rules('numero_de_operacion', 'Número de Operación', 'required|is_unique[pago_de_inscripcion.numero_operacion]'); 
        
        $data = array(
            'fk_id_banco' => $id_banco_operacion,
            'fk_id_tipo_operacion' => $id_tipo_de_pago,
            'fk_id_titular' => $id_cliente,
            'serial_pago' => $serial_de_pago,
            'numero_operacion' => $numero_de_operacion,
            'monto_operacion' => $monto_de_operacion,
            'fecha_operacion' => $fecha_de_operacion
        );
    
        if($this->form_validation->run())
        {
            $resultados = $this->Pagos_model->save($data);
            
            if($resultados == TRUE)
            {
                $id_ultimo_pago = $this->Pagos_model->lastID();
                
                $this->actualizar_conteo_operaciones($id_tipo_de_pago);

                echo json_encode($resultados);
            }
        }
    }

    public function view()
    {
        $id_pago = $this->input->post("id_pago");

		$data = array(
			"pago" => $this->Pagos_model->get_pago($id_pago),
		);

		$this->load->view("admin/pagos/view", $data);
    }

    public function get_tipo_de_operacion_ajax()
    {
        $id_tipo_operacion = $this->input->post('id_tipo_operacion');
        $resultados = $this->Pagos_model->get_tipo_de_operacion($id_tipo_operacion);

        echo json_encode($resultados);
    }

    /**
     * Actualiza el conteo de operaciones al momento den que un pago ha sido
     * registrado de forma exitósa
     *
     * @param integer $id_tipo_operacion
     * @return void
     */
    protected function actualizar_conteo_operaciones($id_tipo_operacion)
    {
        $conteoActual = $this->Pagos_model->get_tipo_de_operacion($id_tipo_operacion);
        
        $data = array(
            'conteo_operaciones' => $conteoActual->conteo_operaciones + 1
        );
        
        $this->Pagos_model->actualizar_conteo_operaciones($id_tipo_operacion, $data);
    }
    
    // Métodos utilizados para el pluggin AUTOCOMPLETE
    
	public function get_titulares_json() {
        $valor = $this->input->post('query');
		$clientes = $this->Pagos_model->get_titulares_json($valor);
		echo json_encode($clientes);
    }

    public function getBancosJSON() {
        $valor = $this->input->post('query');
		$bancos = $this->Pagos_model->getBancosJSON($valor);
		echo json_encode($bancos);
    }
    // Fin: Métodos utilizados para el pluggin AUTOCOMPLETE

}