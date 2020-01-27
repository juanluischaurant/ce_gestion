<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Especialidad_model');  
		$this->load->model('Curso_model');  
		// Carga la librería de generación de PDF 
		include APPPATH . 'third_party/fpdf/lista_asistencia.class.php';
    }

	public function index() 
	{
		$data = array(
			'cursos' => $this->Curso_model->get_cursos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/cursos/list', $data);
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
			"participantes_inscritos" => $this->Curso_model->get_participantes_inscritos($id_instancia),
			'datos_instancia' => $this->Curso_model->get_curso($id_instancia)
		);

		$this->load->view("admin/cursos/view", $data);
	}

	public function add()
	{
        $data = array(
			'especialidades' => $this->Especialidad_model->get_especialidades(),
			'lista_turnos' =>  $this->Curso_model->turnos_dropdown()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/cursos/add', $data);
		$this->load->view('layouts/footer');
	}

	public function store()
	{
        $id_especialidad = $this->input->post('id-especialidad-instanciado');   // fk_id_curso_1
        $id_facilitador_instancia = $this->input->post('id-facilitador-curso'); // fk_id_facilitador
        $id_periodo_instancia = $this->input->post('id-periodo-curso');   // fk_id_periodo_1
        $id_locacion_instancia = $this->input->post('id-locacion-curso'); // fk_id_locacion_1
        $turno_instancia = $this->input->post('turno-curso');             // turno_instancia1
        $cupos_instancia = $this->input->post('cupos-curso');             // cupos_instancia
		$precio_instancia = $this->input->post('costo-curso');            // precio_instancia
		$descripcion_instancia = $this->input->post('descripcion-curso'); // descripcion_instancia
		
        $data = array (
			'id_especialidad' => $id_especialidad,
            'id_facilitador' => $id_facilitador_instancia,
            'id_periodo' => $id_periodo_instancia,
			'id_turno' => $turno_instancia,
			'id_locacion' => $id_locacion_instancia,
            'precio' => $precio_instancia,
			'cupos' => $cupos_instancia,
			'descripcion' => $descripcion_instancia
        );

		print_r($data);
		if($this->Curso_model->save($data))
		{
			redirect(base_url().'gestion/curso');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo registrar el curso.');
			redirect(base_url().'gestion/curso/add');
		}
	}
		
	public function edit($id_instancia)
	{
		// Obtén la fecha de culminación del período asociado a la curso
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_instancia);
		
		// Verifica que el período asociado a la curso sea vigente (no culminado)
		if($fecha_valida == TRUE)
		{
			// Obtén información sobre el estado de la curso
			$estado_instancia = $this->Curso_model->verificar_estado_instancia($id_instancia);
			
			// Verifica el estado actual de la curso (activo o inactivo)
			if($estado_instancia === TRUE)
			{
				// Obtén la información del especialidad instanciado
				$data = array(
					'curso' => $this->Curso_model->get_curso($id_instancia),
					'lista_turnos' =>  $this->Curso_model->turnos_dropdown()
				);
				$this->load->view('layouts/header');
				$this->load->view('layouts/aside');
				$this->load->view('admin/cursos/edit', $data);
				$this->load->view('layouts/footer');
			}
			else
			{
				// La curso se encuentra en estado: DESACTIVADO
				$this->session->set_flashdata('error', 'La curso está desactivada, no puede ser editada.');
				redirect(base_url().'gestion/curso/');
			}
		}
		else
		{
			// El período asociado a la curso EXPIRÓ
			$this->session->set_flashdata('error', 'La curso ya cerró, no puede ser editada.');
			redirect(base_url().'gestion/curso/');
		}
	}

	public function update()
	{
		$id_instancia = $this->input->post('id-curso');

		if($this->form_validation->run('editar_instancia'))
		{		
			// $id_curso_instanciado = $this->input->post('id-especialidad-instanciado');   // fk_id_curso_1
			$id_facilitador_instancia = $this->input->post('id-facilitador-curso'); // fk_id_facilitador
			$id_periodo_instancia = $this->input->post('id-periodo-curso');   // fk_id_periodo_1
			$id_locacion_instancia = $this->input->post('id-locacion-curso'); // fk_id_locacion_1
			$turno_instancia = $this->input->post('turno-curso');             // turno_instancia1
			$cupos_instancia = $this->input->post('cupos-curso');             // cupos_instancia
			$precio_instancia = $this->input->post('costo-curso');            // precio_instancia
			$descripcion_instancia = $this->input->post('descripcion-curso'); // descripcion_instancia
			
			$data = array(
				'id_facilitador' => $id_facilitador_instancia,
				'id_periodo' => $id_periodo_instancia,
				'id_locacion' => $id_locacion_instancia,
				'id_turno' => $turno_instancia,
				'precio' => $precio_instancia,
				'cupos' => $cupos_instancia,
			);
			
			if(trim($this->input->post('descripcion-curso')) !== '')
			{
				$data['descripcion_instancia'] = trim($this->input->post('descripcion-curso'));
			}
			
			if($this->Curso_model->update($id_instancia, $data))
			{
				$serial_instancia = $this->input->post('serial-curso');
				
				$this->session->set_flashdata('success', $serial_instancia . ' actualizada correctamente.');
				redirect(base_url().'gestion/curso');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar la curso.');
				redirect(base_url().'gestion/curso/edit/'.$id_instancia);
			}
		}
		else
		{
			$this->edit($id_instancia);
		}
	}

	/**
	 * Desactivar una curso
	 * 
	 * Las cursos pueden ser desactivadas luego de que el período asociado haya expirado.
	 *
	 * @param integer $id_instancia
	 * @return void
	 */
	public function deactivate_instancia($id_instancia)
    {
		$total_inscripciones = $this
								->Curso_model
								->conteo_inscripciones($id_instancia)
								->inscripciones_activas;

		// Obtén la fecha de culminación del período asociado a la curso
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_instancia);

		if($fecha_valida == TRUE)
		{
			if($total_inscripciones > 0)
			{
				$this->session->set_flashdata('error', 'No se pudo desactivar la curso, hay '. $total_inscripciones . ' <b>INSCRIPCIONES ACTIVAS</b> asociadas.');
				redirect(base_url().'gestion/curso/');
			}
			else if($total_inscripciones == 0)
			{
				$data = array(
					'estado_instancia' => 0,
				);

				// Update register if TRUE
				if($this->Curso_model->update($id_instancia, $data))
				{
					$this->session->set_flashdata('success', 'Se desactivó la curso.');
					redirect(base_url().'gestion/curso/');
				}
				else
				{
					$this->session->set_flashdata('alert', 'No se realizó ningún cambio en la base de datos.');
					redirect(base_url().'gestion/curso/');
				}	

			}
		}
		else
		{
			$this->session->set_flashdata('error', 'La curso ya cerró, no puede ser desactivado.');
			redirect(base_url().'gestion/curso/');
		}
	}
	
	/**
	 * Activar una curso
	 * 
	 * Las cursos pueden ser desactivadas en caso de que se cancele su ejecución.
	 *
	 * @param [type] $id_instancia
	 * @return void
	 */
	public function activate_instancia($id_instancia)
    {
		// Obtén la fecha de culminación del período asociado a la curso
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_instancia);

		if($fecha_valida == TRUE)
		{
	
			$data = array(
				'estado_instancia' => 1,
			);

			// Update register if TRUE
			if($this->Curso_model->update($id_instancia, $data))
			{
				$this->session->set_flashdata('success', 'Se activó la curso exitosamente.');
				redirect(base_url().'gestion/curso/');
			}
			else
			{
				$this->session->set_flashdata('alert', 'No se realizó ningún cambio en la base de datos.');
				redirect(base_url().'gestion/curso/');
			}	
		}
		else
		{
			$this->session->set_flashdata('error', 'La curso ya cerró, no puede ser activada.');
			redirect(base_url().'gestion/curso/');
		}
    }
	
    // =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
    // =======================================================
    
	public function getPeriodosJSON()
	{
		$valor = $this->input->post('query');
		$periodos = $this->Curso_model->getPeriodosJSON($valor);
		echo json_encode($periodos);
    }
    
	public function getLocacionesJSON()
	{
		$valor = $this->input->post('query');
		$locaciones = $this->Curso_model->getLocacionesJSON($valor);
		echo json_encode($locaciones);
    }
    
	public function getFacilitadoresJSON()
	{
		$valor = $this->input->post('query');
		$facilitadores = $this->Curso_model->getFacilitadoresJSON($valor);
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
		$curso = $this->Curso_model->get_curso($id_instancia);

		// Curso la clase PDF
		$pdf = new PDF('L', 'mm', 'A4');
		
		// Setter que permite pasar el valor de $id_curso a la función Header()
		// de fpdf antes de que la página pdf sea renderizada
		$pdf->set_id_curso($id_instancia);

		$pdf->set_datos_curso($curso->nombre, $curso->periodo, $curso->locacion);
		
		// Renderiza la página pdf
		$pdf->AddPage();
		
		$participantes = $this->Curso_model->get_participantes_inscritos($id_instancia);
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