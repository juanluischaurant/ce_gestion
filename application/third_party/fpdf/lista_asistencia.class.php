<?php 

require('fpdf/fpdf.php');


class PDF extends FPDF {

    private $id_instancia = '';
    private $nombre_instancia = '';
    private $periodo = '';
    private $locacion = '';
    
    /**
     * Setter que permite obeter el id del curso que se desea consultar
     *
     * @param integer $id
     * @return void
     */
    public function set_id_instancia($id)
    {
        $this->id_instancia = $id;
    }

    public function set_datos_instancia($nombre, $periodo, $locacion)
    {
        $this->nombre_instancia = $nombre;
        $this->periodo = $periodo;
        $this->locacion = $locacion;
    }
    
    function Header()
    {
        $this->Image(APPPATH . 'third_party/fpdf/imagenes/logo.png', 15, 10,20);

        $this->Cell(29);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(80, 5, 'Planilla de asistencia de participantes', 0, 0, 'L');

        $this->SetFont('Times', '', 11);
        $this->MultiCell(90, 5, utf8_decode('Centro Educativo de Capacitación Laboral (CECAL)'), 0, 'C');
        
        $this->Ln(0);

        $this->Cell(29);
        $this->SetFont('Times', '', 12);
        $this->Cell(80, 5, 'Periodo: '.$this->periodo, 0, 0, 'L');

        $this->SetFont('Times', '', 11);
        $this->MultiCell(90, 5, utf8_decode('"Simón Rodriguez" Fe y Alegría'), 0, 'C');

        $this->Ln(0);

        $this->Cell(29);
        $this->SetFont('Times', '', 12);
        $this->Cell(80, 5, 'Lugar: ' . utf8_decode($this->locacion) , 0, 0, 'L');

        $this->SetFont('Times', '', 11);
        $this->MultiCell(90, 5, utf8_decode('El Tigre Estado Anzoátegui'), 0, 'C');

        $this->Ln(2);

        $this->Cell(29);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(150, 5, 'Curso: '.utf8_decode($this->nombre_instancia), 0, 0, 'L');

        // Inicio de la tabla
        $this->Ln(8);

        // Fuente
        $this->SetFont('Times', '', 10);

        // Columna 1
        $this->Cell(103, 6, utf8_decode('Datos del participante'), 1, 0, 'C');
        $this->Cell(34,6,'Lunes',1,0,'C');
        $this->Cell(34,6,'Martes',1,0,'C');
        $this->Cell(34,6,utf8_decode('Miércoles'),1,0,'C');
        $this->Cell(34,6,'Jueves',1,0,'C');
        $this->Cell(34,6,'Viernes',1,0,'C');

        $this->Ln(5.9);

        // Columna 2
        $this->Cell(6, 6, utf8_decode('N°'), 1, 0, 'C');
        $this->Cell(69,6,'Apellidos y Nombres', 1, 0, 'C');
        $this->Cell(28,6,utf8_decode('Cédula'),1,0,'C');
        $this->Cell(34,6,'    /          /    ',1,0,'C');
        $this->Cell(34,6,'    /          /    ',1,0,'C');
        $this->Cell(34,6,'    /          /    ',1,0,'C');
        $this->Cell(34,6,'    /          /    ',1,0,'C');
        $this->Cell(34,6,'    /          /    ',1,1,'C');
        
    }

}

?>