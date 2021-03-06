<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodo extends CI_Controller {

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
			$this->load->model('Periodo_model');  
			$this->load->model('Accion_model');  
		}
    }

	public function index()
	{
		$data = array(
			'permisos' => $this->permisos,
			'periodos' => $this->Periodo_model->get_periodos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/periodo/list', $data);
		$this->load->view('layouts/footer');
	}

	public function add()
	{

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside');
        $this->load->view('admin/periodo/add');
        $this->load->view('layouts/footer');
	}
	
	/**
	 * Editar período
	 * 
	 * El período puede ser editado solo si no ha caducado aún, se dice
	 * que el período caducó luedo de su fecha de culminación.
	 *
	 * @param integer $id_periodo
	 * @return void
	 */
	public function edit($id_periodo)
	{
		$fecha_valida = $this->Periodo_model->verificar_validez_periodo($id_periodo);

		if($fecha_valida === TRUE)
		{
			$data = array(
				'data_periodo' => $this->Periodo_model->get_periodo($id_periodo)
			);
			
			$this->load->view('layouts/header');
			$this->load->view('layouts/aside');
			$this->load->view('admin/periodo/edit', $data);
			$this->load->view('layouts/footer');
		} 
		else if($fecha_valida === FALSE)
		{
			$this->session->set_flashdata('alert', 'El período ya expiro, no puede ser editado.');
				redirect(base_url().'gestion/periodo/');
		}
	}

	public function store()
	{
		// Reglas declaradas para la validación de formularios integrada en CodeIgniter
		$this->form_validation->set_rules('fecha-inicio', 'Fecha de Inicio', 'required');
		$this->form_validation->set_rules('fecha-culminacion', 'Fecha de Culminación', 'required');
		
		// Si la validación es correcta
		if($this->form_validation->run())
		{
			$data = array (
				'fecha_inicio' => $this->input->post('fecha-inicio'),
				'fecha_culminacion' => $this->input->post('fecha-culminacion'),
			);
	
			$resultado = $this->Periodo_model->save($data);

			if($resultado === FALSE)
			{
				$this->session->set_flashdata('error', 'No se pudo agregar el Período.');
				$this->add();
			}
			else
			{
				$this->guardar_accion(2, $this->Periodo_model->lastID(), 'PERIODO');
				$this->session->set_flashdata('success', 'Se agregó el nuevo Período.');
				redirect(base_url().'gestion/periodo/');
			}
		} 
		else
		{
			$this->add();
		}
		
	}

	public function update()
	{
		$id_periodo = $this->input->post('id-periodo');
		
		$data = array (
			'fecha_inicio' => $this->input->post('fecha-inicio'),
			'fecha_culminacion' => $this->input->post('fecha-culminacion'),
		);

		if($this->Periodo_model->update($id_periodo, $data))
		{
			$this->guardar_accion(3, $id_periodo, 'PERIODO');
			$this->session->set_flashdata('success', 'Período actualizado correctamente.');
			redirect(base_url().'gestion/periodo');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo actualizar la información');
			redirect(base_url().'gestion/periodo/edit/'.$id_periodo);
		}
	}

	/**
	 * Elimina de la base de datos un registro específico
	 *
	 * @param integer $id_periodo
	 * @return void
	 */
	public function delete($id_periodo)
	{
		$instancias_asociadas = $this->Periodo_model->count_instancias_asociadas($id_periodo)->instancias_asociadas;
		$nombre_periodo = $this->Periodo_model->count_instancias_asociadas($id_periodo)->nombre_periodo;

		if($instancias_asociadas > 0)
		{
			$this->session->set_flashdata('alert', 'No se puede eliminar el periodo ' . $nombre_periodo . '. Tiene cursos asociados.');
			redirect(base_url().'gestion/periodo/');
		}
		else
		{
			if($this->Periodo_model->delete($id_periodo))
			{
				$this->session->set_flashdata('success', 'Se eliminó el periodo ' . $nombre_periodo);
				redirect(base_url().'gestion/periodo/');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se eliminó el periodo <b>' . $nombre_periodo. '</b> Algo pasó al consultar la base de datos');
				redirect(base_url().'gestion/periodo/');
			}			
		}
	}

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
		$descripcion = "ID PERIODO: " . $id_registro_afectado; // Texto de descripción de acción
		$tabla_afectada = $tabla_afectada; // Tabla afectada

		$agregar_accion = $this->Accion_model->save_action($username, $id_tipo_accion, $descripcion, $tabla_afectada);

		if($agregar_accion)
		{
			return TRUE;
		}
	}
}
