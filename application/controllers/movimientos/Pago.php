<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagos
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Pago extends CI_Controller {

    private $permisos;

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
            $this->load->model("Accion_model");
        }
    }

    public function index()
    {
        $data = array(
            'permisos' => $this->permisos,
			'pagos' => $this->Pago_model->get_pagos_recientes(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/pago/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add()
    {
		$data = array(
			'tipos_de_operacion' => $this->Pago_model->tipos_de_operacion_dropdown()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/pago/add', $data);
		$this->load->view('layouts/footer');		
    }

    public function store()
    {
        // ¿Se utiliza esta variable?
        // $modulo = $this->input->post('modulo-actual');

        $id_banco_operacion = $this->input->post('id_banco_de_operacion');
        $id_tipo_de_operacion = $this->input->post('tipo_de_pago');
        $cedula_titular = $this->input->post('cedula_titular');
        $numero_referencia_bancaria = $this->input->post('numero_referencia');
        $monto_de_operacion = $this->input->post('monto_de_operacion');
        $fecha_de_operacion = $this->input->post('fecha-operacion');

        $data = array(
            'cedula_titular' => $cedula_titular,
            'id_tipo_de_operacion' => $id_tipo_de_operacion,
            'monto_operacion' => $monto_de_operacion,
            'fecha_operacion' => $fecha_de_operacion
        );

        if($numero_referencia_bancaria !== NULL && $id_tipo_de_operacion == 1)
        {
            $data['id_banco'] = $id_banco_operacion;
            $data['numero_referencia_bancaria' ] = $numero_referencia_bancaria;

            $this->form_validation->set_rules('numero_referencia', 'Número de Referencia', 'required|is_unique[pago_de_inscripcion.numero_referencia_bancaria]'); 
        }
  
        $this->form_validation->set_rules('fecha-operacion', 'Fecha de Operación', 'required'); 

        if($this->form_validation->run())
        {    
            if($this->Pago_model->save($data))
            {
                $this->guardar_accion(2, $this->Pago_model->lastID(), 'PAGO');
                $this->session->set_flashdata('success', 'Pago registrado exitosamente.');

                redirect(base_url().'movimientos/pago/');    
            }
            else
            {
                $this->session->set_flashdata('error', 'No se pudo guardar la información.');
                redirect(base_url().'movimientos/pago/add');
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
     * con la finalidad de almacenar pagos desde el módulo de Inscripción Nueva.
     *
     * @return void
     */
    public function store_ajax()
    {
        $id_banco_operacion = $this->input->post('id_banco_operacion');
        $id_tipo_de_operacion = $this->input->post('id_tipo_de_operacion');
        $cedula_titular = $this->input->post('cedula_titular');
        $numero_referencia_bancaria = $this->input->post('numero_referencia_bancaria');
        $monto_de_operacion = $this->input->post('monto_de_operacion');
        $fecha_de_operacion = $this->input->post('fecha_de_operacion');
        
        $data = array(
            'id_banco' => $id_banco_operacion,
            'id_tipo_de_operacion' => $id_tipo_de_operacion,
            'cedula_titular' => $cedula_titular,
            'numero_referencia_bancaria' => $numero_referencia_bancaria,
            'monto_operacion' => $monto_de_operacion,
            'fecha_operacion' => $fecha_de_operacion
        );

        if($id_tipo_de_operacion == 1 || $id_tipo_de_operacion == 2 || $id_tipo_de_operacion == 3)
        {
            // $this->form_validation->set_rules('numero_referencia_bancaria', 'Número de Operación', 'required|is_unique[pago_de_inscripcion.numero_referencia_bancaria]'); 
            
            // if($this->form_validation->run('agregar_pago'))
            // {
                $resultados = $this->Pago_model->insertar_pago_procedure($data);

                $this->guardar_accion(2, $this->Pago_model->lastID(), 'PAGO');
                // $resultados = $this->Pago_model->save($data);

                // if($resultados == TRUE)
                // {
                
                    echo json_encode($resultados);  
                // }   
        }
    }

    /**
     * Número de pago único
     * 
     * Verifica que el número de pago a registrar en la base de datos sea único.
     *
     * @return json
     */
    public function pago_unico()
    {
        $numero_a_evaluar = $this->input->post('query');

        $resultado = $this->Pago_model->pago_unico($numero_a_evaluar);

        echo json_encode($resultado);
    }

    /**
     * Método diseñado para funcionar con una llamada AJAX que cargará 
     * la vista correspondiente en una ventana modal
     *
     * @return void
     */
    public function view()
    {
        $id_pago = $this->input->post("id_pago");

		$data = array(
			"pago" => $this->Pago_model->get_pago($id_pago),
		);

		$this->load->view("admin/pago/view", $data);
    }

    public function edit($id_pago = NULL)
    {
        // ¿$id es nulo?
		if(!isset($id_pago))
		{
			redirect(base_url().'movimientos/pago/');
		}
		else
		{            
            $estado_pago = $this->Pago_model->get_estatus_pago($id_pago);
            
            // Verifica el estado actual del pago. Un pago ya utilizado
            // NO se debe editar.
            if($estado_pago == TRUE)
            {
                $data = array(
                    'pago' => $this->Pago_model->get_pago($id_pago),
                    'tipos_de_operacion' => $this->Pago_model->tipos_de_operacion_dropdown()
                );

                $this->load->view('layouts/header');
                $this->load->view('layouts/aside');
                $this->load->view('admin/pago/edit', $data);
                $this->load->view('layouts/footer');
            }
            else
            {
                echo $estado_pago;
                $this->session->set_flashdata('error', 'Pago ya en uso, no puedes editarlo.');
                redirect(base_url().'movimientos/pago/');
            }
		}
    }
    
	public function update() 
	{
		$id_pago = $this->input->post('id-pago');

		$cedula_titular = $this->input->post('cedula_titular');
        $monto_operacion = $this->input->post('monto_de_operacion');
        $fecha_operacion = $this->input->post('fecha-operacion');
        $id_banco = $this->input->post('id_banco_de_operacion');
        $numero_referencia_bancaria = $this->input->post('numero_referencia');

		$data = array(
            'cedula_titular' => $cedula_titular,
            'monto_operacion' => $monto_operacion,
            'fecha_operacion' => $fecha_operacion,
            'id_banco' => $id_banco,
            'numero_referencia_bancaria' => $numero_referencia_bancaria,			
		);

		// Reglas declaradas para la validación de formularios integrada en CodeIgniter

		// Si la validación es correcta
		if($this->form_validation->run('editar_pago'))
		{
			if($this->Pago_model->update($id_pago, $data))
			{
				$this->guardar_accion(3, $this->Pago_model->lastID(), 'PAGO');
				redirect(base_url().'movimientos/pago');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la información');
				redirect(base_url().'movimientos/pago/edit/'.$id_pago);
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->edit($id_pago);
		}		
	}

    public function get_tipo_de_operacion_ajax()
    {
        $id_tipo_de_operacion = $this->input->post('id_tipo_de_operacion');
        $resultados = $this->Pago_model->get_tipo_de_operacion($id_tipo_de_operacion);

        echo json_encode($resultados);
    }
    
	public function devolver_pago($id_pago)
	{
                
        $estado_pago = $this->Pago_model->get_estatus_pago($id_pago);
            
        // Verifica el estado actual del pago. Un pago ya utilizado
        // NO se debe editar.
        if($estado_pago == TRUE)
        {
            $data = array(
                'estatus_pago' => 4,
                'fecha_devolucion' => date('Y-m-d H:i:s'),
            );

            $this->Pago_model->update($id_pago, $data);

            $this->session->set_flashdata('error', 'Pago devuelto satisfactoriamente');
            redirect(base_url().'movimientos/pago/');
        }
        else
        {
            echo $estado_pago;
            $this->session->set_flashdata('error', 'No puedes devolver un pago en uso');
            redirect(base_url().'movimientos/pago/');
        }
	}
    
    // Métodos utilizados para el pluggin AUTOCOMPLETE
    
	/**
	 * Consulta el pago indicado
	 * 
	 * Este método se invoca a través de una llamada AJAX realizada con jQuery
	 *
	 * @return void
	 */
	public function get_pagos_json()
	{
		$valor = $this->input->post('query');
		$pagos = $this->Pago_model->get_pagos_json($valor);
		echo json_encode($pagos);
	}
	

    public function get_titulares_json()
    {
        $valor = $this->input->post('query');
		$clientes = $this->Pago_model->get_titulares_json($valor);
		echo json_encode($clientes);
    }

    public function get_bancos_json()
    {
        $valor = $this->input->post('query');
		$bancos = $this->Pago_model->get_bancos_json($valor);
		echo json_encode($bancos);
    }
    // Fin: Métodos utilizados para el pluggin AUTOCOMPLETE

    /**
	 * Guardar Acción
	 * 
	 * Método designado para el registro de las acciones realizadas
	 * por el usuario.
	 *
	 * @param integer $id_tipo_accion
	 * @param string $id_registro_afectado
	 * @param string $tabla_afectada
	 * @return void
	 */
	private function guardar_accion($id_tipo_accion, $id_registro_afectado, $tabla_afectada)
	{
		$username = $this->session->userdata('username'); // ID del usuario con sesión iniciada
		$id_tipo_accion = $id_tipo_accion; // Tipo de acción ejecudada (clave foránea)
		$descripcion = "ID: " . $id_registro_afectado; // Texto de descripción de acción
		$tabla_afectada = $tabla_afectada; // Tabla afectada

		$agregar_accion = $this->Accion_model->save_action($username, $id_tipo_accion, $descripcion, $tabla_afectada);

		if($agregar_accion)
		{
			return TRUE;
		}
	}
}