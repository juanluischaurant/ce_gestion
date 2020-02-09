<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagos
 * 
 * @author Juan Luis Chaurant <juanluischaurant@gmail.com>
 */
class Resumen_anual extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Si el usuario no está logeado
		if(!$this->session->userdata('login'))
		{
			// redirigelo al inicio de la aplicación
            redirect(base_url());
        }
        else
        {
            // Carga el controlador
            $this->load->model("Resumen_anual_model");
        }
    }

    public function index()
    {
       // En caso de que el botón buscar haya sido presionado
        // carga la búsqueda por fecha
        if($this->input->post('buscar'))
        {
            $year = $this->input->post('parametro_de_grafico');
        }
        else
        {
            $year = date('Y');
        }  

        $data = array(
            'current_year' => $year,
            'years' => $this->Resumen_anual_model->periodo_years(),
            'resumen_periodos' => $this->Resumen_anual_model->get_resumen_periodos($year),
            'edad_promedio_anual' => $this->Resumen_anual_model->get_edad_promedio_anual($year),
            'estadistica_cursos_anual' => $this->Resumen_anual_model->get_estadistica_cursos($year)
        );

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/reporte/resumen_anual', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * Resúmen de generos
     * 
     * Obtén totalización de participantes masculinos y femeninos inscritos
     * en determinados períodos del año. Método utilizado para generar gráfico
     * en la vista de Resumen Anual.
     *
     * @return void
     */
    public function get_resumen_generos()
    {
        $year = $this->input->post('year_periodo'); // Valor generado con AJAX
		$resultados = $this->Resumen_anual_model->get_resumen_generos($year);
		echo json_encode($resultados);
    }

    public function get_resumen_periodos()
    {
        $year = $this->input->post('year_periodo'); // Valor generado con AJAX
		$resultados = $this->Resumen_anual_model->get_resumen_periodos($year);
		echo json_encode($resultados);
    }
    public function get_conteo_participantes()
    {
        $year = $this->input->post('year_periodo'); // Valor generado con AJAX
		$resultados = $this->Resumen_anual_model->get_conteo_participantes($year);
		echo json_encode($resultados);
    }
    
}