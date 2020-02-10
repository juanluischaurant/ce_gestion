<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripcion_model extends CI_Model {

    /**
     * Consulta base de dayos y retorna una lista de inscripciones realizadas
     * 
     * @return array
     */   
    public function get_inscripciones()
    {
        $this->db->query("SET lc_time_names = 'es_ES';");

        $resultados = $this->db->select(
            'ins.id,
            ins.cedula_participante,
            ins.fecha_registro, 
            ins.estado,
            ins.id_curso,
            p.fecha_culminacion as valida_hasta,
            (SELECT COUNT(*) FROM pago_de_inscripcion AS pdi WHERE pdi.id_inscripcion = ins.id) AS conteo_pagos_asociados,
            concat(nc.descripcion, " ", MONTHNAME(p.fecha_inicio), "-",  MONTHNAME(p.fecha_culminacion), " ", YEAR(p.fecha_inicio)) as nombre_completo_instancia,
            concat(per.primer_nombre, " ", per.primer_apellido) as nombre_completo_participante'
        )
        ->from('inscripcion as ins')
        ->join('curso', 'curso.id = ins.id_curso')
        ->join('periodo as p', 'p.id = curso.id_periodo')
        ->join('nombre_curso AS nc', 'nc.id = curso.id_nombre_curso')
        ->join('participante as par', 'par.cedula_persona = ins.cedula_participante')
        ->join('persona as per', 'per.cedula = par.cedula_persona')
        // ->where('in.activa', 1)

        ->get();

        return $resultados->result();
    }

    /**
     * Consulta base de dayos y retorna una lista de inscripciones realizadas
     * 
     * @return array
     */   
    public function get_inscripciones_por_fecha($fecha_inicio, $fecha_fin)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");

        $resultados = $this->db->select(
            'ins.id,
            ins.cedula_participante,
            ins.fecha_registro, 
            ins.estado,
            ins.id_curso,
            p.fecha_culminacion as valida_hasta,
            (SELECT COUNT(*) FROM pago_de_inscripcion AS pdi WHERE pdi.id_inscripcion = ins.id) AS conteo_pagos_asociados,
            concat(nc.descripcion, " ", MONTHNAME(p.fecha_inicio), "-",  MONTHNAME(p.fecha_culminacion), " ", YEAR(p.fecha_inicio)) as nombre_completo_instancia,
            concat(per.primer_nombre, " ", per.primer_apellido) as nombre_completo_participante'
        )
        ->from('inscripcion as ins')
        ->join('curso', 'curso.id = ins.id_curso')
        ->join('periodo as p', 'p.id = curso.id_periodo')
        ->join('nombre_curso AS nc', 'nc.id = curso.id_nombre_curso')
        ->join('participante as par', 'par.cedula_persona = ins.cedula_participante')
        ->join('persona as per', 'per.cedula = par.cedula_persona')
        ->where('ins.fecha_registro >=', $fecha_inicio)
        ->where('ins.fecha_registro <=', $fecha_fin)
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén un registro determinado de la tabla "inscripcion"
     * 
     * Método utilizado principalmente para generar la ficha de inscripción. Recibe
     * un parámetro que es el ID de la inscripción. Retorna datos de la inscripción
     * en cuestión y el nombre el participante inscrito.
     *
     * @param integer $id_inscripcion
     * @return array
     */
    public function get_inscripcion($id_inscripcion)
    {
        $resultado = $this->db->select(
            'inscripcion.id,
            inscripcion.fecha_registro,
            inscripcion.costo,
            par.cedula_persona,
            (SELECT COUNT(*) FROM pago_de_inscripcion AS pdi WHERE pdi.id_inscripcion = inscripcion.id) AS conteo_pagos_asociados,
            concat(per.primer_nombre, " ", per.primer_apellido) as nombre_completo_participante,
            per.direccion,
            per.telefono')
        ->from('inscripcion')
        ->join('participante as par', 'par.cedula_persona = inscripcion.cedula_participante')
        ->join('persona as per', 'per.cedula = par.cedula_persona')
        ->where('inscripcion.id', $id_inscripcion)
        ->get();

        return $resultado->row();
    }

    /**
     * Obtén los montos exactos relacionados a determinada inscripción
     * entre los que se listan:
     * - Calculo Monto Pagado
     * - Calculo Deuda
     *
     * @param integer $id_inscripcion
     * @return void
     */
    public function get_montos_inscripcion($id_inscripcion)
    {
        $SQL = "SELECT 
        inscripcion.id,
        SUM(pago_de_inscripcion.monto_operacion) as calculo_monto_pagado,
        (inscripcion.costo - SUM(pago_de_inscripcion.monto_operacion)) AS calculo_deuda
        FROM inscripcion
        INNER JOIN pago_de_inscripcion ON pago_de_inscripcion.id_inscripcion
         = inscripcion.id
        WHERE inscripcion.id = ?";

        $resultado = $this->db->query($SQL, array($id_inscripcion));

        return $resultado->row();
    }

    /**
     * Almacena los datos eviados por el usuario a través del controlador Inscripciones
     *
     * @param array $data
     * @return void
     */
    public function save($data)
    {
		return $this->db->insert("inscripcion", $data);
    }

    /**
     * Utilizada para actualizar datos en la tabla inscripción
     *
     * @param integer $id_inscripcion
     * @param array $data
     * @return void
     */
    public function update_inscripcion($id_inscripcion, $data)
    {
        $this->db->where('id', $id_inscripcion);
        return $this->db->update('inscripcion', $data);
    }

    /**
	 * Actualiza la clave foránea id_inscripcion 
	 *
     * Al momento de realizar una inscripción, es necesario asociar al pago
     * una clave foránea que lo relacione a dicha inscripción, esa es la tarea
     * de este método.
     * 
	 * @param integer $id_pago
	 * @param array $data
	 * @return void
	 */
    public function updateIdInscripcion($id_pago, $data)
    {
        $this->db->where("id", $id_pago);
        $this->db->update("pago_de_inscripcion", $data);
    }

    public function update_estado_pago($id_inscripcion, $data)
    {
        $this->db->set($data);
        $this->db->where('pago_de_inscripcion.id_inscripcion', $id_inscripcion);
        $this->db->update('pago_de_inscripcion');
    }

    /**
     * Verifica cupos disponibles 
     * 
     * Verifica los cupos disponibles en determinada curso, de ser
     * cupos_disponibles < cupos_ocupados retorna: verdadero
     * cupos_disponibles >= cupos_ocupados retorna: falso
     *
     * @param integer $id_curso
     * @return void
     */
    public function verificar_cupos_disponibles($id_curso)
    {
        $SQL = "SELECT 
            cupos AS cupos_curso,
            (SELECT COUNT(*) FROM inscripcion WHERE inscripcion.id_curso = curso.id AND inscripcion.estado = 1) AS cupos_curso_ocupados
            FROM curso
            LEFT JOIN inscripcion ON inscripcion.id_curso = curso.id
            WHERE curso.id = ?
            GROUP BY curso.id";

            $resultado = $this->db->query($SQL, array($id_curso));

            return $resultado->row();

        if($resultado->cupos_curso_ocupados < $resultado->cupos_curso)
        {
            return TRUE;
        } 
        else
        {
            return FALSE;
        }
    }

    /**
     * Obtén el ID del último registro realizado
     *
     * @return void
     */
    public function lastID()
    {
        return $this->db->insert_id();
    }
     
    /**
     * Obtén datos de el curso inscrito
     *     
     * @param integer $id_inscripcion
     * @return array
     */
    public function get_curso_inscrito($id_inscripcion)
    {
        $resultados = $this->db->select(
            'cur.id,
            cur.serial,
            cur.cupos,
            cur.precio,
            (SELECT COUNT(*) FROM inscripcion WHERE inscripcion.id_curso = cur.id AND inscripcion.estado = 1) AS cupos_curso_ocupados,
            concat(nc.descripcion, " ", MONTHNAME(per.fecha_inicio), "-", MONTHNAME(per.fecha_culminacion), " ", YEAR(per.fecha_inicio)) as nombre_completo_instancia'
        )
        ->from('inscripcion as ins')
        ->join('curso as cur', 'cur.id = ins.id_curso')
        ->join('nombre_curso as nc', 'nc.id = cur.id_nombre_curso')
        ->join('periodo as per', 'per.id = cur.id_periodo')
        ->where('ins.id', $id_inscripcion)

        ->get();

        return $resultados->row();
    }

    /**
     * Obtén los pagos realizados en una inscripción
     * 
     * Método utilizado principalmente para generar la ficha de inscripción 
     * dentro de la vista "Generar Inscripción" al presionar el botón de ver detalles 
     * y en el módulo de editar inscripciones.
     *
     * @param integer $id_inscripcion
     * @return void
     */
    public function get_pago_inscripcion($id_inscripcion)
    {
        $resultado = $this->db->select(
            'pdins.*,
            ban.nombre,
            tdo.tipo,
            per.cedula,
            concat(per.primer_nombre, " ", per.primer_apellido) as nombre_titular,
            per.cedula as cedula_titular_pago'
            )
        ->from('inscripcion as ins')
        ->join('pago_de_inscripcion as pdins', 'pdins.id_inscripcion = ins.id')
        ->join('banco as ban', 'ban.id = pdins.id_banco')
        ->join('tipo_de_operacion as tdo', 'tdo.id = pdins.id_tipo_de_operacion')
        ->join('titular as tit', 'tit.cedula_persona = pdins.cedula_titular')
        ->join('persona as per', 'per.cedula = tit.cedula_persona')
        ->where('ins.id', $id_inscripcion)
        ->get();

        return $resultado->result();
    }

    /**
     * Obtén los registros de curso de los especialidades
     * 
     * Utilizado para consultar especialidades en específico, se implementó este método
     * para ser utilizado en el módulo de Inscripciones. El método consulta información
     * en 3 varias tablas y regresa datos cómo por ejemplo: El ID de los participantes
     * registrados en un determinado curso.
     *
     * @param string $valor
     * @return array
     */
    public function get_cursos_json($valor)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        
        $SQL = "SELECT 
        curso.id, 
        curso.cupos, 
        curso.precio, 
        nc.descripcion, 
        concat(nc.descripcion, ' ', MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as label, 
        concat(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as periodo_academico, (SELECT COUNT(*) as inscripciones_asociadas FROM inscripcion WHERE inscripcion.id_curso = curso.id) AS inscripciones_asociadas 
        FROM curso 
        JOIN nombre_curso AS nc ON nc.id = curso.id_nombre_curso 
        JOIN periodo ON periodo.id = curso.id_periodo 
        WHERE curso.estado = 1 AND nc.descripcion LIKE '";
        $SQL .= $valor;
        $SQL .= "%' ESCAPE '!' AND periodo.fecha_culminacion > CURRENT_DATE";
        
        
        $resultado = $this->db->query($SQL, array($valor));

        return $resultado->result_array();
    } 

    /**
     * Método invocado al momento de agregar una curso a la ficha de inscripción
     * 
     * Permite verificar que el participante seleccionado no se encuentre registrado en
     * el curso seleccionado
     *
     * @param integer $id_curso
     * @return void
     */
    public function get_participantes_json($id_curso)
    {
        $resultados = $this->db->select(
            'nc.descripcion,
            inscripcion.cedula_participante'
         )
        ->from('curso')
        ->join('nombre_curso AS nc', 'nc.id = curso.id_nombre_curso')
        ->join('periodo', 'periodo.id = curso.id_periodo')
        // Para consultar una lista de participantes inscritos en determinado especialidad
        ->join('inscripcion', 'inscripcion.id_curso = curso.id')
        ->where('curso.id',  $id_curso)
        ->get();

        return $resultados->result_array();
    } 

    /**
     * Verifica que el período de el curso a la cuál se encuentra asociada
     * una inscripción aún no haya expirado.
     *
     * @param integer $id_inscripcion
     * @return boolean
     */
    public function verifica_validez_instancia($id_inscripcion) 
    {
        $periodo = $this->db->select(
            'per.id,
            per.fecha_inicio,
            per.fecha_culminacion'
        )
        ->from('inscripcion as ins')
        ->join('curso as cur', 'cur.id = ins.id_curso')
        ->join('periodo as per', 'per.id = cur.id_periodo')
        ->where('ins.id', $id_inscripcion)
        ->get()
        ->row();

        // Obtén fecha de hoy del sistema
        $hoy = date('Y-m-d');

        if($periodo->fecha_culminacion >= $hoy)
        {
            return TRUE;
        }
        else if($periodo->fecha_inicio < $hoy)
        {
            return FALSE;
        }
    }

    // Métodos utilizados por HighCharts

    /**
     * Obtiene lista de los años correspondientes a las inscripciones registradas
     * en la tabla "inscripcion". Utilizado por HighCharts
     *
     * @return void
     */
    public function inscripcion_years()
    {
        $resultados = $this->db->select('YEAR(inscripcion.fecha_registro) as year')
        ->from('inscripcion')
        ->group_by('year')
        ->order_by('year', 'desc')
        ->get();

        return $resultados->result();
    }
    
    /**
     * Consulta en la base de datos el monto de ingresos generados por concepto
     * de inscripciones, organizados por mes. Utilizado por HighCharts
     *
     * @param integer $year
     * @return void
     */
    public function inscripcion_montos($year)
    {
        $resultados = $this->db->select(
            'MONTH(inscripcion.fecha_registro) as mes_inscripcion, 
            SUM(inscripcion.costo) as monto_generado'
        )
        ->from('inscripcion')
        ->where('inscripcion.fecha_registro >=', $year.'-01-01')
        ->where('inscripcion.fecha_registro <=', $year.'-12-31')
        ->group_by('mes_inscripcion')
        ->order_by('inscripcion.fecha_registro')
        ->get();

        return $resultados->result(); 
    }

}