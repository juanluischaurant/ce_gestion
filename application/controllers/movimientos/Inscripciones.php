<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones extends CI_Controller {

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
			$this->load->model("Inscripciones_model");
			$this->load->model("Pagos_model");
			$this->load->model("Participantes_model");
			$this->load->model('Instancias_model');
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
			"inscripciones" => $this->Inscripciones_model->get_inscripciones() 
		);

		// Ensambla la vista y carga la información
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/inscripciones/list', $data);
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
			'pagos' => $this->Pagos_model->get_pagos_activos(),
			'tipos_de_operacion' => $this->Pagos_model->get_tipos_de_operacion(),
			"participantes" => $this->Participantes_model->getParticipantes(),
		);
		$general['page_title'] = 'Nueva Inscripción';

		$this->load->view('layouts/header', $general);
		$this->load->view('layouts/aside');
		$this->load->view('admin/inscripciones/add', $data);
		$this->load->view('layouts/footer');		
	}

	public function edit($id_inscripcion, $estado_inscripcion)
	{
		// Verifica que el período al que está asociado la inscripción
		// este vigente o no.
		$fecha_valida = $this->Inscripciones_model->verifica_validez_instancia($id_inscripcion);

		if($estado_inscripcion == 1 && $fecha_valida === TRUE)
		{
			$data = array(
				'data_inscripcion' => $this->Inscripciones_model->get_inscripcion($id_inscripcion),
				'data_instancia_inscrita' => $this->Inscripciones_model->get_instancia_inscrita($id_inscripcion),
				'data_inscripcion_instancia' => $this->Inscripciones_model->get_id_inscripcion_instancia($id_inscripcion),
				'pagos_de_inscripcion' => $this->Inscripciones_model->get_pago_inscripcion($id_inscripcion)
			);
			$general['page_title'] = 'Editar Inscripción';

			$this->load->view('layouts/header', $general);
			$this->load->view('layouts/aside');
			$this->load->view('admin/inscripciones/edit', $data);
			$this->load->view('layouts/footer');
		}
		else if($fecha_valida === FALSE) {
			$this->session->set_flashdata('alert', 'Esta inscripción ya exipró, no puede ser editada.');
					redirect(base_url().'movimientos/inscripciones/');
		}
		else if($estado_inscripcion == 0)
		{
			$this->session->set_flashdata('alert', 'La inscripción debe estar activa para editarla.');
					redirect(base_url().'movimientos/inscripciones/');
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
			'inscripcion' => $this->Inscripciones_model->get_inscripcion($id_inscripcion),
			'data_instancia_inscrita' => $this->Inscripciones_model->get_instancia_inscrita($id_inscripcion),
			'pagos_de_inscripcion' => $this->Inscripciones_model->get_pago_inscripcion($id_inscripcion)
		);

		$this->load->view('admin/inscripciones/view', $data);
	}

	public function store()
	{
		$fk_id_participante_1 = $this->input->post('id_participante');
		$fecha_inscripcion = $this->input->post('fecha-inscripcion');
		$monto_pagado = $this->input->post('monto-pagado');
		$precio_total = $this->input->post('subtotal');
		$deuda = $this->input->post('deuda');
		$costo_de_inscripcion = $this->input->post('total');

		// Llaves utilizadas para almacenar en la tabla inscripcion_instancia
		$fk_id_tipo_operacion = $this->input->post('fk_id_tipo_operacion');
		$fk_id_instancia = $this->input->post('id-instancia');
		$cupos_curso = $this->input->post('cuposcursos');
		$ids_pago = $this->input->post('id-pago');

		// Datos a ser almacenados en la tabla Inscripcion
		$data_inscripcion = Array(
			'fk_id_participante_1' => $fk_id_participante_1,
			'fecha_inscripcion' => $fecha_inscripcion,
			'monto_pagado' => $monto_pagado,
			'precio_total' => $precio_total,
			'deuda' => $deuda,
			'costo_de_inscripcion' => $costo_de_inscripcion
		);
	
		// Almacena datos en la tabla "inscripcion"
		if ($this->Inscripciones_model->save($data_inscripcion))
		{
			// Obtén el ID de la última inscripción realizada
			$id_ultima_inscripcion = $this->Inscripciones_model->lastID();
		
			// Guarda los detalles de la inscripción
			$this->save_inscripcion_instancia($fk_id_instancia, $id_ultima_inscripcion, $cupos_curso, $ids_pago);

			redirect(base_url()."movimientos/inscripciones");
		}
		else
		{ 
			redirect(base_url()."movimientos/inscripciones/add");
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
		$fecha_valida = $this->Inscripciones_model->verifica_validez_instancia($id_inscripcion);

		$data = array(
			'activa' => 0,
		);

		if($fecha_valida === TRUE)
		{
			// Esta primera consulta cambia el estado de la inscripción
			if($this->Inscripciones_model->update_inscripcion($id_inscripcion, $data))
			{
				// Cambia el estado del pago 'estado_pago', en la tabla pago_de_inscripción
				$data = array( 'estado_pago' => 3,);
				$this->Inscripciones_model->update_estado_pago($id_inscripcion, $data);

				$this->restar_cupo_instancia($id_instancia);

				// Esta cadena de texto se concatena al resto de un enlace obetnido
				// durante la llamada AJAX con jQuery para redireccionar la página
				// echo 'movimientos/inscripciones';
				$this->session->set_flashdata('success', 'Inscripción #' . $id_inscripcion . ' desactivada.');
				redirect(base_url().'movimientos/inscripciones/');
			}
		}
		else if($fecha_valida === FALSE)
		{
			$this->session->set_flashdata('alert', 'Esta inscripción ya exipró, no puede ser desactivada.');
			redirect(base_url().'movimientos/inscripciones/');
		}
		else if($estado_inscripcion == 0)
		{
			$this->session->set_flashdata('alert', 'La inscripción debe estar activa para editarla.');
			redirect(base_url().'movimientos/inscripciones/');
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
		if($fecha_valida === TRUE)
		{
			// Verificar que la instancia tenga cupos disponibles
			if($this->Inscripciones_model->verificar_cupos_disponibles($id_instancia))
			{
				// Esta primera consulta cambia el estado de la inscripción
				$data = array( 'activa' => 1, );
				if($this->Inscripciones_model->update_inscripcion($id_inscripcion, $data))
				{
					// Cambia el estado del pago 'estado_pago', en la tabla pago_de_inscripción
					$data = array( 'estado_pago' => 2,);
					$this->Inscripciones_model->update_estado_pago($id_inscripcion, $data);
		
						$this->sumar_cupo_instancia($id_instancia);
		
						// Esta cadena de texto se concatena al resto de un enlace obetnido
						// durante la llamada AJAX con jQuery para redireccionar la página
						// echo 'movimientos/inscripciones';
						$this->session->set_flashdata('success', 'Inscripción #' . $id_inscripcion . ' activada.');
						redirect(base_url().'movimientos/inscripciones/');
				}
			} 
			else
			{
				echo 'movimientos/inscripciones';
			}

		}
		else if($fecha_valida === FALSE)
		{
			$this->session->set_flashdata('alert', 'Esta inscripción ya exipró, no puede ser desactivada.');
			redirect(base_url().'movimientos/inscripciones/');
		}
		else if($estado_inscripcion == 0)
		{
			$this->session->set_flashdata('alert', 'La inscripción debe estar activa para editarla.');
			redirect(base_url().'movimientos/inscripciones/');
		}
	}

	/**
	 * Crea un nuevo registro en la tabla de relación inscripcion_instancia
	 * 
	 * @param array $id_instancia
	 * @param integer $id_ultima_inscripcion
	 * @param integer $cupos_curso
	 * @param array $ids_pago
	 * @return void
	 */
	protected function save_inscripcion_instancia($id_instancia,$id_ultima_inscripcion, $cupos_curso, $ids_pago)
	{
		// Itera sobre un array con IDs de 1 o más cursos seleccionados
		for($i=0; $i < count($id_instancia); $i++)
		{ 
			$data  = array(
				'fk_id_inscripcion_1' => $id_ultima_inscripcion,
				'fk_id_instancia_1' => $id_instancia[$i]
			);

			// Almacena en inscripcion_curso
			$this->Pagos_model->save_inscripcion_instancia($data);

			// Actualiza el conteo de cupos disponibles en el curso
			$this->actualiza_cupos_ocupados($id_instancia[$i],$cupos_curso[$i]);
		}

		// Itera sobre un array con IDs de 1 o más pagos seleccionados
		for($j = 0; $j < count($ids_pago); $j++)
		{
			$data  = array(
				'fk_id_inscripcion' => $id_ultima_inscripcion
			);

			// Asigna ID de inscripción al pago 
			$this->updateIdInscripcion($ids_pago[$j], $data);

			// Actualiza el estado del pago a Usado
			$this->actualiza_estado_pago($ids_pago[$j]);
		} 
	}

	/**
	 * Actualiza Inscripción
	 * 
	 * Método diseñado para ser llamado por el módulo de edición de inscripción,
	 * permite actualizar la tabla "inscripcion_instancia" y el conteo de cursos
	 * involucrados en la transacción.
	 *
	 * @return void
	 */
	public function update()
	{
		$instancia_actual = $this->input->post('id-instancia-actual'); 
		$id_instancias_nuevas = $this->input->post('id-instancias'); // Array de cursos seleccionados
		$id_inscripcion_instancia = $this->input->post('id-inscripcion-instancia'); 

		foreach($id_instancias_nuevas as $idin)
		{
			// Verificar que hay cupos disponibles en la nueva instancia que se desea seleccionar
			if($this->Inscripciones_model->verificar_cupos_disponibles($idin))
			{
				$data = array(
					'fk_id_instancia_1' => $idin,
				);
				
				// Actualizar la tabla relacional "inscripcion_instanica" con el ID de la nueva instancia
				if($this->Inscripciones_model->update_inscripcion_instancia($id_inscripcion_instancia, $data))
				{
					// Sumar +1 a los cupos de la instancia nueva
					if($this->Inscripciones_model->sumar_cupo_instancia($idin))
					{
						if($this->Inscripciones_model->restar_cupo_instancia($instancia_actual))
						{
							// Emitir alerta y redireccionar
							$this->session->set_flashdata('success', 'Cambio de instancia exitoso.');
							redirect(base_url().'movimientos/inscripciones/');
						}
					}					
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Instancia no tiene cupos disponibles.');
				redirect(base_url().'movimientos/inscripciones/');
			}
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
				'fk_id_inscripcion' => $id_inscripcion,
				'estado_pago' =>  2
			);

			// Actualiza los datos de pago
			$this->Pagos_model->update($id_pago, $data);
		}

		// Actualiza datos de inscripción
		$monto_pagado = $this->input->post('monto-en-operacion') + $this->input->post('pagado'); 
		$deuda = $this->input->post('deuda') - $this->input->post('monto-en-operacion');
		$costo_de_inscripcion = $this->input->post('costo-de-inscripcion');

		$data_inscripcion = array(
			'monto_pagado' => $monto_pagado,
			'costo_de_inscripcion' => $costo_de_inscripcion,
			'deuda' => $deuda,
		);

		// Actualiza los datos de inscripción
		if($this->Inscripciones_model->update_inscripcion($id_inscripcion, $data_inscripcion))
		{
			$this->session->set_flashdata('success', 'Inscripción actualizados exitosamente.');
			redirect(base_url().'movimientos/inscripciones/');
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
				'fk_id_inscripcion' => NULL,
				'estado_pago' =>  1
			);
			
			// Actualiza los datos de pago
			$this->Pagos_model->update($id_pago, $data);
		}
		
		
		// Actualiza datos de inscripción
		$monto_pagado = $this->input->post('pagado') - $this->input->post('monto-en-operacion'); 
		$deuda = $this->input->post('deuda') + $this->input->post('monto-en-operacion');
		$costo_de_inscripcion = $this->input->post('costo-de-inscripcion');
		
		$data_inscripcion = array(
			'monto_pagado' => $monto_pagado,
			'costo_de_inscripcion' => $costo_de_inscripcion,
			'deuda' => $deuda,
		);
		
		$id_inscripcion = $this->input->post('id-inscripcion-actual');

		if($this->Inscripciones_model->update_inscripcion($id_inscripcion, $data_inscripcion))
		{
			$this->session->set_flashdata('success', 'Inscripción actualizados exitosamente.');
			redirect(base_url().'movimientos/inscripciones/');
		}	
    }

	/**
	 * Actualiza Cupos Ocupados (¿Es aún necesario este método?)
	 * 
	 * Actualiza el conteo de cupos en determinado curso luego de almacenar los datos de inscripción.
	 *
	 * @param integer $id_instancia
	 * @param integer $cupos_curso
	 * @return void
	 */
	protected function actualiza_cupos_ocupados($id_instancia, $cupos_curso)
	{
		$cursoActual = $this->Instancias_model->getInstancia($id_instancia);

		$data = array(
			'cupos_instancia_ocupados' => $cursoActual->cupos_instancia_ocupados + 1, 
		);
		$this->Instancias_model->update($id_instancia, $data);
	}

	/**
	 * Resta 1 cupo a la instancia seleccionada
	 * 
	 * Este método es invocado al momento de desactivar una inscripción.
	 *
	 * @param integer $id_inscripcion
	 * @return void
	 */
	public function restar_cupo_instancia($id_instancia)
	{
		$this->Inscripciones_model->restar_cupo_instancia($id_instancia);
	}

	/**
	 * Suma 1 cupo a la instancia seleccionada
	 * 
	 * Este método es invocado al momento de activar una inscripción.
	 *
	 * @param integer $id_inscripcion
	 * @return void
	 */
	public function sumar_cupo_instancia($id_instancia)
	{
		$this->Inscripciones_model->sumar_cupo_instancia($id_instancia);
	}

	/**
	 * Actualiza la clave foránea fk_id_inscripcion en la tabla 'pago_de_inscripcion'
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
		$this->Inscripciones_model->updateIdInscripcion($id_pago, $id_ultima_inscripcion);
	}

	/**
	 * Actualiza estado_pago
	 * 
	 * Actualiza el campo estado_pago en la tabla pago_de_inscripcion, el estado_pago
	 * permite controlar que un pago se utilize una sola vez dentro del sistema. Esta
	 * función es llamada al momento de almacenar la inscripción.
	 *
	 * @param integer $id_pago
	 * @return void
	 */
	protected function actualiza_estado_pago($id_pago)
	{		
		$this->Pagos_model->actualiza_estado_pago($id_pago);
	}




	// =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

	/**
	 * Consulta el curso indicado
	 * 
	 * Este método se invoca a través de una llamada AJAX realizada con jQuery
	 *
	 * @return void
	 */
	public function getInstanciasJSON() {
		$valor = $this->input->post('query');
		$participantes = $this->Inscripciones_model->getInstanciasJSON($valor);
		echo json_encode($participantes);
	}

	/**
     * Método invocado al momento de agregar una instancia a la ficha de inscripción
     * 
     * Permite verificar que el participante seleccionado no se encuentre registrado en
     * el curso seleccionado
     *
     * @param integer $id_instancia
     * @return void
     */
	public function getParticipantesJSON()
	{
		$valor = $this->input->post('id');
		$participantes = $this->Inscripciones_model->getParticipantesJSON($valor);

		echo json_encode($participantes);
	}
	
	// =======================================================
	//Fin de Métodos utilizados para el pluggin AUTOCOMPLETE
	// =======================================================

}