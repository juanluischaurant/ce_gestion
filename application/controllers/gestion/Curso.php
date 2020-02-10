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

				
		// Si el usuario no está logeado
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
    }

	public function index() 
	{
		$data = array(
			'cursos' => $this->Curso_model->get_cursos(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/curso/list', $data);
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
		$id_curso = $this->input->post("id_curso");

		$data = array(
			"participantes_inscritos" => $this->Curso_model->get_participantes_inscritos($id_curso),
			'datos_curso' => $this->Curso_model->get_curso($id_curso)
		);

		$this->load->view("admin/curso/view", $data);
	}

	public function add()
	{
        $data = array(
			'nombres_curso' => $this->Curso_model->get_nombres_curso(),
			'lista_turnos' =>  $this->Curso_model->turnos_dropdown()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/curso/add', $data);
		$this->load->view('layouts/footer');
	}
	
	public function edit($id_curso)
	{
		// Obtén la fecha de culminación del período asociado a el curso
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_curso);
		
		// Verifica que el período asociado a el curso sea vigente (no culminado)
		if($fecha_valida == TRUE)
		{
			// Obtén información sobre el estado de el curso
			$estado_curso = $this->Curso_model->verificar_estado_curso($id_curso);
			
			// Verifica el estado actual de el curso (activo o inactivo)
			if($estado_curso === TRUE)
			{
				// Obtén la información del especialidad instanciado
				$data = array(
					'curso' => $this->Curso_model->get_curso($id_curso),
					'lista_turnos' =>  $this->Curso_model->turnos_dropdown()
				);
				$this->load->view('layouts/header');
				$this->load->view('layouts/aside');
				$this->load->view('admin/curso/edit', $data);
				$this->load->view('layouts/footer');
			}
			else
			{
				// El curso se encuentra en estado: DESACTIVADO
				$this->session->set_flashdata('error', 'El curso está desactivada, no puede ser editada.');
				redirect(base_url().'gestion/curso/');
			}
		}
		else
		{
			// El período asociado a el curso EXPIRÓ
			$this->session->set_flashdata('error', 'El curso ya cerró, no puede ser editada.');
			redirect(base_url().'gestion/curso/');
		}
	}

	public function store()
	{
		$id_nombre_curso = $this->input->post('id-nombre-curso');   // fk_id_curso_1
		$serial_curso = $this->input->post('serial-curso');
        $cedula_facilitador = $this->input->post('id-facilitador-curso'); // fk_id_facilitador
        $id_periodo_instancia = $this->input->post('id-periodo-curso');   // fk_id_periodo_1
        $id_locacion_curso = $this->input->post('id-locacion-curso'); // fk_id_locacion_1
        $turno_instancia = $this->input->post('turno-curso');             // turno_instancia1
        $cupos_instancia = $this->input->post('cupos-curso');             // cupos_instancia
		$precio_instancia = $this->input->post('costo-curso');            // precio_instancia
		$descripcion_instancia = $this->input->post('descripcion-curso'); // descripcion_instancia
		
        $data = array (
			'id_nombre_curso' => $id_nombre_curso,
			'serial' => $serial_curso,
            'cedula_facilitador' => $cedula_facilitador,
            'id_periodo' => $id_periodo_instancia,
			'id_turno' => $turno_instancia,
			'id_locacion' => $id_locacion_curso,
            'precio' => $precio_instancia,
			'cupos' => $cupos_instancia,
			'descripcion' => $descripcion_instancia
        );

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
	
	public function update()
	{
		$id_curso = $this->input->post('id-curso');
		$serial_curso = $this->input->post('serial-curso');

		if($this->form_validation->run('editar_instancia'))
		{
			$id_facilitador_instancia = $this->input->post('id-facilitador-curso');
			$id_periodo_instancia = $this->input->post('id-periodo-curso');
			$id_locacion_curso = $this->input->post('id-locacion-curso'); 
			$turno_instancia = $this->input->post('turno-curso');
			$cupos_instancia = $this->input->post('cupos-curso');
			$precio_instancia = $this->input->post('costo-curso');
			$descripcion_instancia = $this->input->post('descripcion-curso');
			
			$data = array(
				'cedula_facilitador' => $id_facilitador_instancia,
				'id_periodo' => $id_periodo_instancia,
				'id_locacion' => $id_locacion_curso,
				'id_turno' => $turno_instancia,
				'precio' => $precio_instancia,
				'cupos' => $cupos_instancia,
				'descripcion' => $descripcion_instancia
			);
			
			if($this->Curso_model->update($id_curso, $data))
			{
				$this->session->set_flashdata('success', $serial_curso . ' actualizado correctamente.');
				redirect(base_url().'gestion/curso');
			}
			else
			{
				$this->session->set_flashdata('error', 'No se pudo actualizar el curso.');
				redirect(base_url().'gestion/curso/edit/'.$id_curso);
			}
		}
		else
		{
			$this->edit($id_curso);
		}
	}

	/**
	 * Desactivar una curso
	 * 
	 * Las cursos pueden ser desactivadas luego de que el período asociado haya expirado.
	 *
	 * @param integer $id_curso
	 * @return void
	 */
	public function desactiva_curso($id_curso)
    {
		// Verifica el total de inscripciones activas
		$total_inscripciones = $this
								->Curso_model
								->conteo_inscripciones($id_curso)
								->inscripciones_activas;

		// Obtén la fecha de culminación del período asociado a el curso
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_curso);

		if($fecha_valida == TRUE)
		{
			if($total_inscripciones > 0)
			{
				$this->session->set_flashdata('error', 'No se pudo desactivar el curso, hay '. $total_inscripciones . ' <b>INSCRIPCIONES ACTIVAS</b> asociadas.');
				redirect(base_url().'gestion/curso/');
			}
			else if($total_inscripciones == 0)
			{
				$data = array(
					'estado' => 0,
				);

				// Update register if TRUE
				if($this->Curso_model->update($id_curso, $data))
				{
					$this->session->set_flashdata('success', 'Se desactivó el curso exitosamente.');
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
			$this->session->set_flashdata('error', 'El curso ya cerró, no puede ser desactivado.');
			redirect(base_url().'gestion/curso/');
		}
	}
	
	/**
	 * Activar una curso
	 * 
	 * Las cursos pueden ser desactivadas en caso de que se cancele su ejecución.
	 *
	 * @param [type] $id_curso
	 * @return void
	 */
	public function activate_instancia($id_curso)
    {
		// Obtén la fecha de culminación del período asociado a el curso
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_curso);

		if($fecha_valida == TRUE)
		{
	
			$data = array(
				'estado' => 1,
			);

			// Update register if TRUE
			if($this->Curso_model->update($id_curso, $data))
			{
				$this->session->set_flashdata('success', 'Se activó el curso exitosamente.');
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
			$this->session->set_flashdata('error', 'El curso ya cerró, no puede ser activada.');
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
	 * @param integer $id_curso
	 * @return void
	 */
	public function generate_pdf($id_curso)
	{
		$curso = $this->Curso_model->get_curso($id_curso);

		// Curso la clase PDF
		$pdf = new PDF('L', 'mm', 'A4');
		
		// Setter que permite pasar el valor de $id_curso a la función Header()
		// de fpdf antes de que la página pdf sea renderizada
		$pdf->set_id_curso($id_curso);

		$pdf->set_datos_curso($curso->descripcion, $curso->periodo_academico, $curso->locacion_curso);
		
		// Renderiza la página pdf
		$pdf->AddPage();
		
		$participantes = $this->Curso_model->get_participantes_inscritos($id_curso);
		// $participantes = json_decode($participantes, true);
		$i = 1;

		foreach($participantes as $participante)
		{
			if($participante->estado == '2')
			{
				continue;
			}
			else
			{
				$pdf->Cell(6, 6, $i++, 1, 0, 'C');
				$pdf->Cell(69,6, utf8_decode($participante->primer_nombre) . " " . utf8_decode($participante->primer_apellido), 1, 0, 'C');
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
