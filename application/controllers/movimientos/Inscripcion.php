<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripcion extends CI_Controller {

	private $permisos;

	public function __construct()
	{
		parent::__construct();
	
		// El archivo backend_lip fue creado por el programador 
		// y se encuentra almacenado en el directorio: application/libraries/Backend_lib.php
		$this->permisos = $this->backend_lib->control();

		// Si el usuario no ha iniciado sesión
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el controlador
			$this->load->model("Inscripcion_model");
			$this->load->model("Pago_model");
			$this->load->model("Participante_model");
			$this->load->model('Curso_model');

			$this->load->model('Accion_model');
        }
    }

	/**
	 * Realiza consulta para obtener una lista de inscripciones realizadas,
	 * esambla la vista llamando y carga la información consultada con el 
	 * método $this->getInscripciones()
	 *
	 * @return void
	 */
	public function index()
	{
		// Almacena en el array $data una lista de inscripciones obtenida de la base de datos
		$data = array(
			'permisos' => $this->permisos,
			"inscripciones" => $this->Inscripcion_model->get_inscripciones() 
		);

		// Ensambla la vista y carga la información
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/inscripcion/list', $data);
		$this->load->view('layouts/footer');
	}

	/**
	 * Añadir
	 * 
	 * Carga la vista que permite añadir una nueva inscripción
	 *
	 * @return void
	 */
	public function add()
	{
		$data = array(
			'pagos' => $this->Pago_model->get_pagos_activos(),
			'tipos_de_operacion' => $this->Pago_model->get_tipos_de_operacion(),
			"participantes" => $this->Participante_model->get_participantes(),
		);
		$general['page_title'] = 'Nueva Inscripción';

		$this->load->view('layouts/header', $general);
		$this->load->view('layouts/aside');
		$this->load->view('admin/inscripcion/add', $data);
		$this->load->view('layouts/footer');		
	}

	public function edit($id_inscripcion, $estado_inscripcion)
	{
		// Verifica que el período al que está asociado la inscripción
		// este vigente o no.
		$fecha_valida = $this->Inscripcion_model->verifica_validez_instancia($id_inscripcion);

		if($estado_inscripcion == 1 && $fecha_valida === TRUE)
		{
			$data = array(
				'data_inscripcion' => $this->Inscripcion_model->get_inscripcion($id_inscripcion),
				'data_curso_inscrito' => $this->Inscripcion_model->get_curso_inscrito($id_inscripcion),
				'pagos_de_inscripcion' => $this->Inscripcion_model->get_pago_inscripcion($id_inscripcion),
				'montos_de_inscripcion' => $this->Inscripcion_model->get_montos_inscripcion($id_inscripcion)
			);
			$general['page_title'] = 'Editar Inscripción';

			$this->load->view('layouts/header', $general);
			$this->load->view('layouts/aside');
			$this->load->view('admin/inscripcion/edit', $data);
			$this->load->view('layouts/footer');
		}
		else if($fecha_valida === FALSE)
		{
			$this->session->set_flashdata('alert', 'Esta inscripción ya exipró, no puede ser editada.');
			redirect(base_url().'movimientos/inscripcion/');
		}
		else if($estado_inscripcion == 0)
		{
			$this->session->set_flashdata('alert', 'La inscripción debe estar activa para editarla.');
			redirect(base_url().'movimientos/inscripcion/');
		}
	}

	/**
	 * Carga la información específica de una inscripción
	 *
	 * @return void
	 */
	public function view()
	{
		$id_inscripcion = $this->input->post('id_inscripcion');

		$data = array(
			'inscripcion' => $this->Inscripcion_model->get_inscripcion($id_inscripcion),
			'data_curso_inscrito' => $this->Inscripcion_model->get_curso_inscrito($id_inscripcion),
			'pagos_de_inscripcion' => $this->Inscripcion_model->get_pago_inscripcion($id_inscripcion),
			'montos_de_inscripcion' => $this->Inscripcion_model->get_montos_inscripcion($id_inscripcion)
		);

		$this->load->view('admin/inscripcion/view', $data);
	}

	public function store()
	{
		$cedula_participante = $this->input->post('cedula_persona');
		$costo = $this->input->post('costo-de-inscripcion');

		// Llaves utilizadas para almacenar en la tabla ocupa
		// $id_tipo_de_operacion = $this->input->post('id_tipo_de_operacion');
		$id_curso = $this->input->post('id-curso');
		$cupos_instancia = $this->input->post('cupos-curso');
		$ids_pago = $this->input->post('id-pago');

		// Datos a ser almacenados en la tabla Inscripcion
		$data_inscripcion = Array(
			'cedula_participante' => $cedula_participante,
			'id_curso' => $id_curso,
			'costo' => $costo
		);
	
		// Almacena datos en la tabla "inscripcion"
		if ($this->Inscripcion_model->save($data_inscripcion))
		{
			// Obtén el ID de la última inscripción realizada
			$id_ultima_inscripcion = $this->Inscripcion_model->lastID();
			
			// Asociar los pagos a la inscripción realizada
			$this->asociar_pago($id_ultima_inscripcion, $ids_pago);

			$this->guardar_accion(2, $id_ultima_inscripcion, 'INSCRIPCIÓN');
			$this->session->set_flashdata('success', 'Inscripción almacenada exitosamente.');
			redirect(base_url()."movimientos/inscripcion");
		}
		else
		{ 
			$this->session->set_flashdata('error', 'No se pudo guardar la inscripción.');
			redirect(base_url()."movimientos/inscripcion/add");
		}
	}

	/**
	 * Crea un nuevo registro en la tabla de relación ocupa
	 * 
	 * @param integer $id_ultima_inscripcion
	 * @param array $ids_pago
	 * @return void
	 */
	protected function asociar_pago($id_ultima_inscripcion, $ids_pago)
	{
		// Itera sobre un array con IDs de 1 o más pagos seleccionados
		for($j = 0; $j < count($ids_pago); $j++)
		{
			$data  = array(
				'id_inscripcion' => $id_ultima_inscripcion
			);

			// Asigna ID de inscripción al pago 
			$this->updateIdInscripcion($ids_pago[$j], $data);

			// Actualiza el estado del pago a Usado
			$this->actualiza_estatus_pago($ids_pago[$j]);
		} 
	}

	/**
	 * Desactivar inscripción
	 * 
	 * Método utilizado al momento de presionar el botón de desactivar inscripción, para
	 * su correcto funcionamiento este método requiere dos parámetros: $id_inscripcion e
	 * $id_instancia, que son pasados a través de la variable global POST.
	 *
	 * @param integer $id_inscripcion
	 * @param integer $id_instancia
	 * @return void
	 */
	public function deactivate_inscripcion($id_inscripcion, $id_instancia)
	{
		// Verifica que el período al que está asociado la inscripción
		// este vigente o no.
		$fecha_valida = $this->Inscripcion_model->verifica_validez_instancia($id_inscripcion);

		$data = array(
			'estado' => 0,
		);

		if($fecha_valida === TRUE)
		{
			// Esta primera consulta cambia el estado de la inscripción
			if($this->Inscripcion_model->update_inscripcion($id_inscripcion, $data))
			{
				// Cambia el estado del pago 'estado_pago', en la tabla pago_de_inscripción
				$data = array( 'estatus_pago' => 3,);
				$this->Inscripcion_model->update_estado_pago($id_inscripcion, $data);

				$this->guardar_accion(1, $id_inscripcion, 'INSCRIPCIÓN');

				// Esta cadena de texto se concatena al resto de un enlace obetnido
				// durante la llamada AJAX con jQuery para redireccionar la página
				// echo 'movimientos/inscripcion';
				$this->session->set_flashdata('success', 'Inscripción #' . $id_inscripcion . ' desactivada.');
				redirect(base_url().'movimientos/inscripcion/');
			}
		}
		else if($fecha_valida === FALSE)
		{
			$this->session->set_flashdata('alert', 'Esta inscripción ya exipró, no puede ser desactivada.');
			redirect(base_url().'movimientos/inscripcion/');
		}
		else if($estado_inscripcion == 0)
		{
			$this->session->set_flashdata('alert', 'La inscripción debe estar activa para editarla.');
			redirect(base_url().'movimientos/inscripcion/');
		}
	}

	/**
	 * Activar inscripción
	 * 
	 * Método utilizado al momento de presionar el botón de activar inscripción, para
	 * su correcto funcionamiento este método requiere dos parámetros: $id_inscripcion e
	 * $id_instancia, que son pasados a través de la variable global POST.
	 *
	 * @param integer $id_inscripcion
	 * @param integer $id_instancia
	 * @return void
	 */
	public function activate_inscripcion($id_inscripcion, $id_instancia)
	{
		$fecha_valida = $this->Inscripcion_model->verifica_validez_instancia($id_inscripcion);

		if($fecha_valida === TRUE)
		{
			// Verificar que el curso tenga cupos disponibles
			if($this->Inscripcion_model->verificar_cupos_disponibles($id_instancia))
			{
				// Esta primera consulta cambia el estado de la inscripción
				$data = array( 'estado' => 1, );
				if($this->Inscripcion_model->update_inscripcion($id_inscripcion, $data))
				{
					// Cambia el estado del pago 'estado_pago', en la tabla pago_de_inscripción
					$data = array( 'estatus_pago' => 2,);
					$this->Inscripcion_model->update_estado_pago($id_inscripcion, $data);
					$this->guardar_accion(4, $id_inscripcion, 'INSCRIPCIÓN');
				
						// Esta cadena de texto se concatena al resto de un enlace obetnido
						// durante la llamada AJAX con jQuery para redireccionar la página
						// echo 'movimientos/inscripcion';
						$this->session->set_flashdata('success', 'Inscripción #' . $id_inscripcion . ' activada.');
						redirect(base_url().'movimientos/inscripcion/');
				}
			} 
			else
			{
				echo 'movimientos/inscripcion';
			}

		}
		else if($fecha_valida === FALSE)
		{
			$this->session->set_flashdata('alert', 'Esta inscripción ya exipró, no puede ser desactivada.');
			redirect(base_url().'movimientos/inscripcion/');
		}
		else if($estado_inscripcion == 0)
		{
			$this->session->set_flashdata('alert', 'La inscripción debe estar activa para editarla.');
			redirect(base_url().'movimientos/inscripcion/');
		}
	}

	/**
	 * Actualiza Inscripción
	 * 
	 * Método diseñado para ser llamado por el módulo de edición de inscripción,
	 * permite actualizar la tabla inscripción involucrada en la transacción.
	 *
	 * @return void
	 */
	public function update_curso()
	{
		$id_curso_actual = $this->input->post('id-curso-actual'); 
		$id_curso_nuevo = $this->input->post('id-curso');
		$id_inscripcion = $this->input->post('id_inscripcion'); 

			// Verificar que hay cupos disponibles en la nueva curso que se desea seleccionar
			if($this->Inscripcion_model->verificar_cupos_disponibles($id_curso_nuevo) == TRUE)
			{
				$data = array(
					'id_curso' => $id_curso_nuevo,
				);
				
				// Actualizar la tabla inscripcion, con el ID del nuevo curso
				if($this->Inscripcion_model->update_inscripcion($id_inscripcion, $data))
				{
					$this->guardar_accion(3, $id_inscripcion, 'INSCRIPCIÓN');
					// Emitir alerta y redireccionar
					$this->session->set_flashdata('success', 'Cambio de curso exitoso.');
					redirect(base_url().'movimientos/inscripcion/');				
				}
			}
			else
			{
				$this->session->set_flashdata('success', 'Curso no tiene cupos disponibles.');
				redirect(base_url().'movimientos/inscripcion/');
			}
	}

	/**
	 * Actualizar datos de pago de inscripción
	 *	 
	 * @return void
	 */
	public function update_asociar_pago()
	{
		// Actualiza datos de pago en la tabla pago_de_inscripcion
		$id_pagos = $this->input->post('id-pago');
		$id_inscripcion = $this->input->post('id-inscripcion-actual');

		for($i=0; $i < count($id_pagos); $i++)
		{
			$id_pago = $id_pagos[$i];

			$data = array(
				'id_inscripcion' => $id_inscripcion,
				'estatus_pago' =>  2
			);

			// Actualiza los datos de pago
			$this->Pago_model->update($id_pago, $data);
		}

		// Actualiza datos de inscripción
		// $monto_pagado = $this->input->post('monto-en-operacion') + $this->input->post('pagado'); 
		// $deuda = $this->input->post('deuda') - $this->input->post('monto-en-operacion');
		$costo = $this->input->post('costo-de-inscripcion');

		$data_inscripcion = array(
			// 'monto_pagado' => $monto_pagado,
			'costo' => $costo,
			// 'deuda' => $deuda,
		);

		// Actualiza los datos de inscripción
		if($this->Inscripcion_model->update_inscripcion($id_inscripcion, $data_inscripcion))
		{
			$this->session->set_flashdata('success', 'Inscripción actualizados exitosamente.');
			redirect(base_url().'movimientos/inscripcion/');
		}		
	}

	/**
	 * Remover pago asociado a determinada inscripción
	 * 
	 * Método diseñado específicamente para funcionar en la sección
	 * de edición de inscripciones, permite eliminar la asociación de
	 * un pago con determinada inscripción. Recibe dos parámetros:
	 * 
	 * @param integer $id_pago
	 * @param integer $id_inscripcion
	 */
    public function update_desasociar_pago()
    {
        // Actualiza datos de pago en la tabla pago_de_inscripcion
		$id_pagos = $this->input->post('id-pago');
		
		for($i=0; $i < count($id_pagos); $i++)
		{
			$id_pago = $id_pagos[$i];
			
			$data = array(
				'id_inscripcion' => NULL,
				'estatus_pago' =>  1
			);
			
			// Actualiza los datos de pago
			$this->Pago_model->update($id_pago, $data);
		}
		
		
		// Actualiza datos de inscripción
		//$monto_pagado = $this->input->post('pagado') - $this->input->post('monto-en-operacion'); 
		//$deuda = $this->input->post('deuda') + $this->input->post('monto-en-operacion');
		$costo = $this->input->post('costo-de-inscripcion');
		
		$data_inscripcion = array(
			//'monto_pagado' => $monto_pagado,
			'costo' => $costo,
			//'deuda' => $deuda,
		);
		
		$id_inscripcion = $this->input->post('id-inscripcion-actual');

		if($this->Inscripcion_model->update_inscripcion($id_inscripcion, $data_inscripcion))
		{
			$this->session->set_flashdata('success', 'Inscripción actualizados exitosamente.');
			redirect(base_url().'movimientos/inscripcion/');
		}	
    }

	/**
	 * Actualiza la clave foránea "id_inscripcion" en la tabla 'pago_de_inscripcion'
	 * 
	 * Recibe como parámetros dos valores, el id del pago asociado y el id de la inscripción
	 * relacionada al pago.
	 *
	 * @param integer $id_pago
	 * @param integer $id_ultima_inscripcion
	 * @return void
	 */
	protected function updateIdInscripcion($id_pago, $id_ultima_inscripcion)
	{
		$this->Inscripcion_model->updateIdInscripcion($id_pago, $id_ultima_inscripcion);
	}

	/**
	 * Actualiza estatus_pago
	 * 
	 * Actualiza el campo estatus_pago en la tabla pago_de_inscripcion, el estado_pago
	 * permite controlar que un pago se utilize una sola vez dentro del sistema. Esta
	 * función es llamada al momento de almacenar la inscripción.
	 *
	 * @param integer $id_pago
	 * @return void
	 */
	protected function actualiza_estatus_pago($id_pago)
	{		
		$this->Pago_model->actualiza_estatus_pago($id_pago);
	}

	// =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

	/**
	 * Consulta el especialidad indicado
	 * 
	 * Este método se invoca a través de una llamada AJAX realizada con jQuery
	 *
	 * @return void
	 */
	public function get_cursos_json()
	{
		$valor = $this->input->post('query');
		$participantes = $this->Inscripcion_model->get_cursos_json($valor);
		echo json_encode($participantes);
	}

	/**
     * Método invocado al momento de agregar una curso a la ficha de inscripción
     * 
     * Permite verificar que el participante seleccionado no se encuentre registrado en
     * el especialidad seleccionado
     *
     * @param integer $id_instancia
     * @return void
     */
	public function get_participantes_json()
	{
		$valor = $this->input->post('id');
		$participantes = $this->Inscripcion_model->get_participantes_json($valor);

		echo json_encode($participantes);
	}
	
	// =======================================================
	//Fin de Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

	
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