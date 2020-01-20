<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancia extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Instancia_model');  
		$this->load->model('Curso_model');  
		// Carga la librería de generación de PDF 
		include APPPATH . 'third_party/fpdf/lista_asistencia.class.php';
    }

	public function index() 
	{
		$data = array(
			'instancias' => $this->Instancia_model->get_instancias(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/instancias/list', $data);
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
		$id_instancia = $this->input->post("id_instancia");

		$data = array(
			"participantes_inscritos" => $this->Instancia_model->get_participantes_inscritos($id_instancia),
			'datos_instancia' => $this->Instancia_model->get_instancia($id_instancia)
		);

		$this->load->view("admin/instancias/view", $data);
	}

	public function add()
	{
        $data = array(
			'cursos' => $this->Curso_model->get_cursos(),
			'lista_turnos' =>  $this->Instancia_model->turnos_dropdown()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/instancias/add', $data);
		$this->load->view('layouts/footer');
	}

	public function store()
	{
        $id_curso_instanciado = $this->input->post('id-curso-instanciado');   // fk_id_curso_1
        $id_profesor_instancia = $this->input->post('id-profesor-instancia'); // fk_id_facilitador
        $id_periodo_instancia = $this->input->post('id-periodo-instancia');   // fk_id_periodo_1
        $id_locacion_instancia = $this->input->post('id-locacion-instancia'); // fk_id_locacion_1
        $turno_instancia = $this->input->post('turno-instancia');             // turno_instancia1
        $cupos_instancia = $this->input->post('cupos-instancia');             // cupos_instancia
		$precio_instancia = $this->input->post('costo-instancia');            // precio_instancia
		$descripcion_instancia = $this->input->post('descripcion-instancia'); // descripcion_instancia
		
        $data = array (
			'id_curso' => $id_curso_instanciado,
            'id_facilitador' => $id_profesor_instancia,
            'id_periodo' => $id_periodo_instancia,
			'id_turno' => $turno_instancia,
			'id_locacion' => $id_locacion_instancia,
            'precio_instancia' => $precio_instancia,
			'cupos' => $cupos_instancia,
			'descripcion' => $descripcion_instancia
        );

		if($this->Instancia_model->save($data))
		{
			$this->Curso_model->actualizar_conteo_instancia($id_curso_instanciado);
			redirect(base_url().'gestion/instancia');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo registrar la instancia.');
			redirect(base_url().'gestion/instancia/add');
		}
	}
		
	public function edit($id_instancia)
	{
		// Obtén la fecha de culminación del período asociado a la instancia
		$fecha_valida = $this->Instancia_model->verificar_periodo_instancia($id_instancia);
		
		// Verifica que el período asociado a la instancia sea vigente (no culminado)
		if($fecha_valida == TRUE)
		{
			// Obtén información sobre el estado de la instancia
			$estado_instancia = $this->Instancia_model->verificar_estado_instancia($id_instancia);
			
			// Verifica el estado actual de la instancia (activo o inactivo)
			if($estado_instancia === TRUE)
			{
				// Obtén la información del curso instanciado
				$data = array(
					'instancia' => $this->Instancia_model->get_instancia($id_instancia),
					'lista_turnos' =>  $this->Instancia_model->turnos_dropdown()
				);
				$this->load->view('layouts/header');
				$this->load->view('layouts/aside');
				$this->load->view('admin/instancias/edit', $data);
				$this->load->view('layouts/footer');
			}
			else
			{
				// La instancia se encuentra en estado: DESACTIVADO
				$this->session->set_flashdata('error', 'La instancia está desactivada, no puede ser editada.');
				redirect(base_url().'gestion/instancia/');
			}
		}
		else
		{
			// El período asociado a la instancia EXPIRÓ
			$this->session->set_flashdata('error', 'La instancia ya cerró, no puede ser editada.');
			redirect(base_url().'gestion/instancia/');
		}
	}

	public function update()
	{
		$id_instancia = $this->input->post('id-instancia');

		if($this->form_validation->run('editar_instancia'))
		{		
			// $id_curso_instanciado = $this->input->post('id-curso-instanciado');   // fk_id_curso_1
			$id_profesor_instancia = $this->input->post('id-profesor-instancia'); // fk_id_facilitador
			$id_periodo_instancia = $this->input->post('id-periodo-instancia');   // fk_id_periodo_1
			$id_locacion_instancia = $this->input->post('id-locacion-instancia'); // fk_id_locacion_1
			$turno_instancia = $this->input->post('turno-instancia');             // turno_instancia1
			$cupos_instancia = $this->input->post('cupos-instancia');             // cupos_instancia
			$precio_instancia = $this->input->post('costo-instancia');            // precio_instancia
			$descripcion_instancia = $this->input->post('descripcion-instancia'); // descripcion_instancia
			
			$data = array(
				// 'fk_id_curso_1' => $id_curso_instanciado,
				'precio_instancia' => $precio_instancia,
				'fk_id_facilitador_1' => $id_profesor_instancia,
				'fk_id_periodo_1' => $id_periodo_instancia,
				'fk_id_locacion_1' => $id_locacion_instancia,
				'id_turno' => $turno_instancia,
				'cupos_instancia' => $cupos_instancia,
			);
			
			if(trim($this->input->post('descripcion-instancia')) !== '')
			{
				$data['descripcion_instancia'] = trim($this->input->post('descripcion-instancia'));
			}
			
			if($this->Instancia_model->update($id_instancia, $data))
			{
				$serial_instancia = $this->input->post('serial-instancia');
				
				$this->session->set_flashdata('success', $serial_instancia . ' actualizada correctamente.');
				redirect(base_url().'gestion/instancia');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la instancia.');
				redirect(base_url().'gestion/instancia/edit/'.$id_instancia);
			}
		}
		else
		{
			$this->edit($id_instancia);
		}
	}

	/**
	 * Desactivar una instancia
	 * 
	 * Las instancias pueden ser desactivadas luego de que el período asociado haya expirado.
	 *
	 * @param integer $id_instancia
	 * @return void
	 */
	public function deactivate_instancia($id_instancia)
    {
		$total_inscripciones = $this
								->Instancia_model
								->conteo_inscripciones($id_instancia)
								->inscripciones_activas;

		// Obtén la fecha de culminación del período asociado a la instancia
		$fecha_valida = $this->Instancia_model->verificar_periodo_instancia($id_instancia);

		if($fecha_valida == TRUE)
		{
			if($total_inscripciones > 0)
			{
				$this->session->set_flashdata('error', 'No se pudo desactivar la instancia, hay '. $total_inscripciones . ' <b>INSCRIPCIONES ACTIVAS</b> asociadas.');
				redirect(base_url().'gestion/instancia/');
			}
			else if($total_inscripciones == 0)
			{
				$data = array(
					'estado_instancia' => 0,
				);

				// Update register if TRUE
				if($this->Instancia_model->update($id_instancia, $data))
				{
					$this->session->set_flashdata('success', 'Se desactivó la instancia.');
					redirect(base_url().'gestion/instancia/');
				}
				else
				{
					$this->session->set_flashdata('alert', 'No se realizó ningún cambio en la base de datos.');
					redirect(base_url().'gestion/instancia/');
				}	

			}
		}
		else
		{
			$this->session->set_flashdata('error', 'La instancia ya cerró, no puede ser desactivado.');
			redirect(base_url().'gestion/instancia/');
		}
	}
	
	/**
	 * Activar una instancia
	 * 
	 * Las instancias pueden ser desactivadas en caso de que se cancele su ejecución.
	 *
	 * @param [type] $id_instancia
	 * @return void
	 */
	public function activate_instancia($id_instancia)
    {
		// Obtén la fecha de culminación del período asociado a la instancia
		$fecha_valida = $this->Instancia_model->verificar_periodo_instancia($id_instancia);

		if($fecha_valida == TRUE)
		{
	
			$data = array(
				'estado_instancia' => 1,
			);

			// Update register if TRUE
			if($this->Instancia_model->update($id_instancia, $data))
			{
				$this->session->set_flashdata('success', 'Se activó la instancia exitosamente.');
				redirect(base_url().'gestion/instancia/');
			}
			else
			{
				$this->session->set_flashdata('alert', 'No se realizó ningún cambio en la base de datos.');
				redirect(base_url().'gestion/instancia/');
			}	
		}
		else
		{
			$this->session->set_flashdata('error', 'La instancia ya cerró, no puede ser activada.');
			redirect(base_url().'gestion/instancia/');
		}
    }
	
    // =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
    // =======================================================
    
	public function getPeriodosJSON()
	{
		$valor = $this->input->post('query');
		$periodos = $this->Instancia_model->getPeriodosJSON($valor);
		echo json_encode($periodos);
    }
    
	public function getLocacionesJSON()
	{
		$valor = $this->input->post('query');
		$locaciones = $this->Instancia_model->getLocacionesJSON($valor);
		echo json_encode($locaciones);
    }
    
	public function getFacilitadoresJSON()
	{
		$valor = $this->input->post('query');
		$facilitadores = $this->Instancia_model->getFacilitadoresJSON($valor);
		echo json_encode($facilitadores);
    }
    
    // =======================================================
	// Métodos utilizados para el pluggin FPDF
	// =======================================================
	
	/**
	 * Genera lista de asistencia en formato pdf lista para ser impresa
	 * 
	 * Este método utliza la librería FPDF, que se almacena en el directorio:
	 * application/third_party/fpdf
	 *
	 * @param integer $id_instancia
	 * @return void
	 */
	public function generate_pdf($id_instancia)
	{
		$instancia = $this->Instancia_model->get_instancia($id_instancia);

		// Instancia la clase PDF
		$pdf = new PDF('L', 'mm', 'A4');
		
		// Setter que permite pasar el valor de $id_curso a la función Header()
		// de fpdf antes de que la página pdf sea renderizada
		$pdf->set_id_instancia($id_instancia);

		$pdf->set_datos_instancia($instancia->nombre_curso, $instancia->periodo, $instancia->locacion_instancia);
		
		// Renderiza la página pdf
		$pdf->AddPage();
		
		$participantes = $this->Instancia_model->get_participantes_inscritos($id_instancia);
		// $participantes = json_decode($participantes, true);
		$i = 1;

		foreach($participantes as $participante)
		{
			if($participante->estado_participante == '2')
			{
				continue;
			}
			else
			{
				$pdf->Cell(6, 6, $i++, 1, 0, 'C');
				$pdf->Cell(69,6, utf8_decode($participante->nombres_persona) . " " . utf8_decode($participante->apellidos_persona), 1, 0, 'C');
				$pdf->Cell(28,6, $participante->cedula,1,0,'C');
				$pdf->Cell(34,6,'',1,0,'C');
				$pdf->Cell(34,6,'',1,0,'C');
				$pdf->Cell(34,6,'',1,0,'C');
				$pdf->Cell(34,6,'',1,0,'C');
				$pdf->Cell(34,6,'',1,1,'C');
			}
		}

		$pdf->Output();
	}

}
