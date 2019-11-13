<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase contiene funciones en común utilizadas por las sub-clases de
 * persona, entre las que cuentan: Facilitador, Cliente(Titular), Participnte
 * 
 * @package CE_gestion
 * @subpackage Personas
 * @category Controladores
 */
class Personas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Personas_model');  
        $this->load->model('Acciones_model');  
    }

    public function index() {
		$data = array(
			'personas' => $this->Personas_model->getPersonas(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/personas/list', $data);
		$this->load->view('layouts/footer');
    }
    
    public function add() {
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/add');
        $this->load->view('layouts/footer');
    }
	
	/**
	 * Estructura la vista que será mostrada cuando se llame
	 * al método
	 * 
	 * El método está diseñado para ser llamado por medio del método
	 * AJAX.
	 *
	 * @return void
	 */
	public function view()
	{
		$idParticipante = $this->input->post("id_persona");

		$data = array(
			"persona" => $this->Personas_model->getPersona($idParticipante),
		);

		$this->load->view("admin/personas/view", $data);
	}
	
	public function store() 
	{
		$cedula = $this->input->post("cedula-persona");
		$nombres = $this->input->post('nombre-persona');
		$apellidos = $this->input->post('apellido-persona');
		$fecha_nacimiento = $this->input->post('nacimiento-persona');
		$genero = $this->input->post('genero-persona');
		$telefono = $this->input->post('telefono-persona');
		$direccion = $this->input->post('direccion-persona');
		
		$data_persona = array(
			'cedula_persona' => $cedula,
			'nombres_persona' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion,
			'estado_persona' => '1'
		);

		// Reglas declaradas para la validación de formularios integrada en CodeIgniter
		$this->form_validation->set_rules('cedula-persona', 'Cédula', 'required|is_unique[persona.cedula_persona]');
		$this->form_validation->set_rules('genero-persona', 'Genero', 'required');
		
		// Si la validación es correcta
		if($this->form_validation->run())
		{
			// Procede a guardar los datos
			if($this->Personas_model->save($data_persona))
			{ 
				// Carga en una variable el id del último registro creado
				$id_ultimo_registro = $this->Personas_model->lastID();

				$fk_id_usuario = $this->session->userdata('id_usuario');
				$fk_id_tipo_accion = 2;
				$descripcion_accion = "PERSONA ID: " . $id_ultimo_registro;
				$tabla_afectada = "PERSONA";

				$agregar_accion = $this->Acciones_model->save_action($fk_id_usuario, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada);
	
				// Redirige a la vista "success" dentro de este controlador
				redirect(base_url().'gestion/personas/success/'.$id_ultimo_registro);
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo guardar la información');
				redirect(base_url().'gestion/personas/add');	
			}
		}
		else
		{
			// $this hace referencia al módulo donde es invocado
			$this->add();
		}
		
    }
    
    public function success($ultimo_id = 'no_id') {

        $data_persona = array(
			'persona' => $this->Personas_model->getPersona($ultimo_id),
		);
		
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/personas/success', $data_persona);
		$this->load->view('layouts/footer');
		
    }

	public function update() {
		$id_facilitador = $this->input->post('id-facilitador');
		$fk_id_persona_3 = $this->input->post('fk-id-persona');

		$cedula = $this->input->post('cedula-facilitador');
		$nombres = $this->input->post('nombre-facilitador');
		$apellidos = $this->input->post('apellido-facilitador');
		$genero = $this->input->post('genero-facilitador');
		$fecha_nacimiento = $this->input->post('nacimiento-facilitador');
		$telefono = $this->input->post('telefono-facilitador');
		$direccion = $this->input->post('direccion-facilitador');

		// $estado_facilitador; <- Aún no utilizada

		$data = array(
			'cedula_persona' => $cedula,
			'nombres_persona' => $nombres,
			'apellidos_persona' => $apellidos,
			'fecha_nacimiento_persona' => $fecha_nacimiento,
			'genero_persona' => $genero,
			'telefono_persona' => $telefono,
			'direccion_persona' => $direccion
		);

		if($this->Personas_model->update($fk_id_persona_3, $data)) {
			redirect(base_url().'gestion/personas');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/personas/edit'.$id_facilitador);
		}
		
	}

	public function edit($id) {
		$data = array(
			'facilitador' => $this->Facilitadores_model->getFacilitador($id)
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/personas/edit', $data);
		$this->load->view('layouts/footer');
	}

	public function delete($id) {
		$data = array(
			'estado_persona' => 0,
		);
		$this->Personas_model->update($id, $data);
		echo 'gestion/personas';
	}
}