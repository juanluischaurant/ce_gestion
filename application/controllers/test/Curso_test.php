<?php

class Curso_test extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();
        $this->load->model('Nombre_curso_model');  
		$this->load->model('Curso_model');
		$this->load->library('unit_test');
		// Carga la librería de generación de PDF 
		include APPPATH . 'third_party/fpdf/lista_asistencia.class.php';
    }

    public function testGetPeriodosJSON()
	{
		$test = $this->getPeriodosJSON('2020');

		$resultado_esperado = 'is_resource';

		$nombre_prueba = 'Consulta los períodos registrados en la base de datos';

		echo $this->unit->run($test, $resultado_esperado, $nombre_prueba);
	}

	public function getPeriodosJSON($valor)
	{
		$periodos = $this->Curso_model->getPeriodosJSON($valor);
		echo json_encode($periodos);
	}
	
	public function testVerificarPeriodoCurso()
	{
		$id_curso = 2;
		$fecha_valida = $this->Curso_model->verificar_periodo_curso($id_curso);

		$test = $fecha_valida;

		$resultado_esperado = 'is_true';

		$nombre_prueba = 'Consulta la validez del período asociado al curso';

		$nota = 'Verifica que el período asociado a un curso esté aún vigente.
		De no serlo, regresa FALSE y de lo contrario TRUE';

		echo $this->unit->run($test, $resultado_esperado, $nombre_prueba, $nota);
	}

	public function test_get_curso()
	{
		$id_curso = 2;

		$test = $this->Curso_model->get_curso($id_curso);

		$resultado_esperado = 'is_object';

		$nombre_prueba = 'Consulta la validez del período asociado al curso';

		$nota = 'Verifica que el período asociado a un curso esté aún vigente.
		De no serlo, regresa FALSE y de lo contrario TRUE';

		echo $this->unit->run($test, $resultado_esperado, $nombre_prueba, $nota);

	}
}