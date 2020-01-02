<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instancias extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('Instancias_model');  
		$this->load->model('Cursos_model');  
		// Carga la librería de generación de PDF 
		include APPPATH . 'third_party/fpdf/lista_asistencia.class.php';
    }

	public function index() 
	{
		$data = array(
			'instancias' => $this->Instancias_model->get_instancias(),
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
			"participantes_inscritos" => $this->Instancias_model->get_participantes_inscritos($id_instancia),
			'datos_instancia' => $this->Instancias_model->get_instancia($id_instancia)
		);

		$this->load->view("admin/instancias/view", $data);
	}

	public function add()
	{
        $data = array(
			'cursos' => $this->Cursos_model->getCursos(),
			'lista_turnos' =>  $this->Instancias_model->turnos_dropdown()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/instancias/add', $data);
		$this->load->view('layouts/footer');
	}

	public function store()
	{
        $id_curso_instanciado = $this->input->post('id-curso-instanciado');   // fk_id_curso_1
        $serial_instancia = $this->input->post('serial-instancia');   // serial_instancia
        $id_profesor_instancia = $this->input->post('id-profesor-instancia'); // fk_id_facilitador
        $id_periodo_instancia = $this->input->post('id-periodo-instancia');   // fk_id_periodo_1
        $id_locacion_instancia = $this->input->post('id-locacion-instancia'); // fk_id_locacion_1
        $turno_instancia = $this->input->post('turno-instancia');             // turno_instancia1
        $cupos_instancia = $this->input->post('cupos-instancia');             // cupos_instancia
		$precio_instancia = $this->input->post('costo-instancia');            // precio_instancia
		$descripcion_instancia = $this->input->post('descripcion-instancia'); // descripcion_instancia
		
        $data = array (
			'fk_id_curso_1' => $id_curso_instanciado,
			'serial_instancia' => $serial_instancia,
            'precio_instancia' => $precio_instancia,
            'fk_id_facilitador_1' => $id_profesor_instancia,
            'fk_id_periodo_1' => $id_periodo_instancia,
			'fk_id_locacion_1' => $id_locacion_instancia,
			'fk_id_turno_instancia_1' => $turno_instancia,
			'cupos_instancia' => $cupos_instancia,
			'descripcion_instancia' => $descripcion_instancia
        );

		if($this->Instancias_model->save($data))
		{
			$this->Cursos_model->actualizar_conteo_instancia($id_curso_instanciado);
			redirect(base_url().'gestion/instancias');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo registrar la instancia.');
			redirect(base_url().'gestion/instancias/add');
		}
	}
		
	public function edit($id_instancia)
	{
		// Obtén la fecha de culminación del período asociado a la instancia
		$fecha_valida = $this->Instancias_model->verificar_periodo_instancia($id_instancia);
		
		// Verifica que el período asociado a la instancia sea vigente (no culminado)
		if($fecha_valida == TRUE)
		{
			// Obtén información sobre el estado de la instancia
			$estado_instancia = $this->Instancias_model->verificar_estado_instancia($id_instancia);
			
			// Verifica el estado actual de la instancia (activo o inactivo)
			if($estado_instancia === TRUE)
			{
				// Obtén la información del curso instanciado
				$data = array(
					'curso' => $this->Cursos_model->get_curso($id_instancia)
				);
				$this->load->view('layouts/header');
				$this->load->view('layouts/aside');
				$this->load->view('admin/cursos/edit', $data);
				$this->load->view('layouts/footer');
			}
			else
			{
				// La instancia se encuentra en estado: DESACTIVADO
				$this->session->set_flashdata('error', 'La instancia está desactivada, no puede ser editada.');
				redirect(base_url().'gestion/instancias/');
			}
		}
		else
		{
			// El período asociado a la instancia EXPIRÓ
			$this->session->set_flashdata('error', 'La instancia ya cerró, no puede ser editada.');
			redirect(base_url().'gestion/instancias/');
		}
	}

	public function update()
	{
		$id_curso = $this->input->post('id_curso');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');

		$data = array(
			'nombre' => $nombre,
			'descripcion' => $descripcion
		);

		
		if($this->Cursos_model->update($id_curso, $data))
		{
			redirect(base_url().'gestion/cursos');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se pudo actualizar la instancia.');
			redirect(base_url().'gestion/cursos/edit/'.$id_curso);
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
								->Instancias_model
								->conteo_inscripciones($id_instancia)
								->inscripciones_activas;

		// Obtén la fecha de culminación del período asociado a la instancia
		$fecha_valida = $this->Instancias_model->verificar_periodo_instancia($id_instancia);

		if($fecha_valida == TRUE)
		{
			if($total_inscripciones > 0)
			{
				$this->session->set_flashdata('error', 'No se pudo desactivar la instancia, hay '. $total_inscripciones . ' <b>INSCRIPCIONES ACTIVAS</b> asociadas.');
				redirect(base_url().'gestion/instancias/');
			}
			else if($total_inscripciones == 0)
			{
				$data = array(
					'estado_instancia' => 0,
				);

				// Update register if TRUE
				if($this->Instancias_model->update($id_instancia, $data))
				{
					$this->session->set_flashdata('success', 'Se desactivó la instancia.');
					redirect(base_url().'gestion/instancias/');
				}
				else
				{
					$this->session->set_flashdata('alert', 'No se realizó ningún cambio en la base de datos.');
					redirect(base_url().'gestion/instancias/');
				}	

			}
		}
		else
		{
			$this->session->set_flashdata('error', 'La instancia ya cerró, no puede ser desactivado.');
			redirect(base_url().'gestion/instancias/');
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
		$fecha_valida = $this->Instancias_model->verificar_periodo_instancia($id_instancia);

		if($fecha_valida == TRUE)
		{
	
			$data = array(
				'estado_instancia' => 1,
			);

			// Update register if TRUE
			if($this->Instancias_model->update($id_instancia, $data))
			{
				$this->session->set_flashdata('success', 'Se activó la instancia exitosamente.');
				redirect(base_url().'gestion/instancias/');
			}
			else
			{
				$this->session->set_flashdata('alert', 'No se realizó ningún cambio en la base de datos.');
				redirect(base_url().'gestion/instancias/');
			}	
		}
		else
		{
			$this->session->set_flashdata('error', 'La instancia ya cerró, no puede ser activada.');
			redirect(base_url().'gestion/instancias/');
		}
    }
	
    // =======================================================
	// Métodos utilizados para el pluggin AUTOCOMPLETE
    // =======================================================
    
	public function getPeriodosJSON()
	{
		$valor = $this->input->post('query');
		$periodos = $this->Instancias_model->getPeriodosJSON($valor);
		echo json_encode($periodos);
    }
    
	public function getLocacionesJSON()
	{
		$valor = $this->input->post('query');
		$locaciones = $this->Instancias_model->getLocacionesJSON($valor);
		echo json_encode($locaciones);
    }
    
	public function getFacilitadoresJSON()
	{
		$valor = $this->input->post('query');
		$facilitadores = $this->Instancias_model->getFacilitadoresJSON($valor);
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
		$instancia = $this->Instancias_model->get_instancia($id_instancia);

		// Instancia la clase PDF
		$pdf = new PDF('L', 'mm', 'A4');
		
		// Setter que permite pasar el valor de $id_curso a la función Header()
		// de fpdf antes de que la página pdf sea renderizada
		$pdf->set_id_instancia($id_instancia);

		$pdf->set_datos_instancia($instancia->nombre_curso, $instancia->periodo, $instancia->locacion_instancia);
		
		// Renderiza la página pdf
		$pdf->AddPage();
		
		$participantes = $this->Instancias_model->get_participantes_inscritos($id_instancia);
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
				$pdf->Cell(28,6, $participante->cedula_persona,1,0,'C');
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
