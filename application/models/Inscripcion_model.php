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
        $resultados = $this->db->select(
            'ocu.id,
            ocu.id_instancia,
            ocu.id, 
            insc.fecha_registro, 
            insc.estado,
            p.fecha_cierre as valida_hasta,
            concat(especialidad.nombre, "-", MONTH(p.fecha_inicio), " ",  MONTH(p.fecha_culminacion), " ", YEAR(p.fecha_inicio)) as nombre_completo_instancia,
            concat(per.nombres, " ", per.apellidos) as nombre_completo_participante,
            per.cedula'
        )
        ->from('ocupa as ocu')
        ->join('inscripcion as insc', 'insc.id = ocu.id_inscripcion')
        ->join('participante as par', 'par.id = insc.id_participante')
        ->join('persona as per', 'per.id = par.id_persona')
        ->join('curso', 'curso.id = ocu.id_instancia')
        ->join('periodo as p', 'id_periodo = curso.id_periodo')
        ->join('especialidad', 'especialidad.id_curso = curso.id')
        // ->where('in.activa', 1)

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
            'i.hora_inscripcion,
            i.hora_inscripcion,
            i.costo_de_inscripcion,
            p.cedula,
            concat(p.nombres, " ", p.apellidoscur.) as nombre_completo_participante,
            p.direccioncur.,
            p.telefonocur.')
        ->from('inscripcion as i')
        ->join('participante as par', 'par.id = fk_id_participante_1')
        ->join('persona as p', 'p.id = par.id_persona')
        ->where('i.id_inscripcion', $id_inscripcion)
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
        inscripcion.id_inscripcion,
        SUM(pago_de_inscripcion.monto_operacion) as calculo_monto_pagado,
        (inscripcion.costo_de_inscripcion - SUM(pago_de_inscripcion.monto_operacion)) AS calculo_deuda
        FROM inscripcion
        INNER JOIN pago_de_inscripcion ON pago_de_inscripcion.fk_id_inscripcion = inscripcion.id_inscripcion
        WHERE inscripcion.id_inscripcion = ?";

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
        $this->db->where('id_inscripcion', $id_inscripcion);
        return $this->db->update('inscripcion', $data);
    }

    /**
     * Utilizada para actualizar datos de inscripción_instancia
     *
     * @param integer $id_inscripcion_instancia
     * @param array $data
     * @return void
     */
    public function update_inscripcion_instancia($id_inscripcion_instancia, $data)
    {
        $this->db->where('id_inscripcion_instancia', $id_inscripcion_instancia);
        return $this->db->update('inscripcion_instancia', $data);
    }

    public function restar_cupo_instancia($id_instancia)
    {
        $this->db->set('curso.cupos_instancia_ocupados', 'curso.cupos_instancia_ocupados-1', FALSE);
        $this->db->where('curso.id_instancia', $id_instancia);
        

        if($this->db->update('curso'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Utilizada para actualizar datos de inscripción_instancia
     *
     * @param integer $id_inscripcion_instancia
     * @param array $data
     * @return boolean
     */
    public function sumar_cupo_instancia($id_instancia)
    {
        $this->db->set('curso.cupos_instancia_ocupados', 'curso.cupos_instancia_ocupados+1', FALSE);
        $this->db->where('curso.id_instancia', $id_instancia);

        if($this->db->update('curso'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
	 * Actualiza la clave foránea fk_id_inscripcion 
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
        $this->db->where('pago_de_inscripcion.fk_id_inscripcion', $id_inscripcion);
        $this->db->update('pago_de_inscripcion');
    }

    /**
     * Método utilizado para obtener IDs que son necesarios para la ejecución de otros métodos
     *
     * @param [type] $id_inscripcion
     * @return void
     */
    public function get_id_inscripcion_instancia($id_inscripcion)
    { 
        // Eliminar deuda de aquí
        $resultado = $this->db->select(
            'i.id_inscripcion,
            par.id,
            ii.id_inscripcion_instancia,
            inst.id_instancia'
            )
        ->from('inscripcion as i')
        ->join('participante as par', 'par.id = i.fk_id_participante_1')
        ->join('inscripcion_instancia as ii', 'i.id_inscripcion = ii.fk_id_inscripcion_1')
        ->join('curso as inst', 'ii.fk_id_instancia_1 = inst.id_instancia')
        ->where('ii.fk_id_inscripcion_1', $id_inscripcion)
        ->get();

        return $resultado->row();
    }

    /**
     * Verifica cupos disponibles 
     * 
     * Verifica los cupos disponibles en determinada curso, de ser
     * cupos_disponibles < cupos_ocupados retorna: verdadero
     * cupos_disponibles >= cupos_ocupados retorna: falso
     *
     * @param [type] $id_instancia
     * @return void
     */
    public function verificar_cupos_disponibles($id_instancia)
    {
        $resultado = $this->db->select(
            'inst.cupos_instancia,
            inst.cupos_instancia_ocupados')
        ->from('curso as inst')
        ->where('inst.id_instancia', $id_instancia)
        ->get()
        ->row();

        if($resultado->cupos_instancia_ocupados < $resultado->cupos_instancia)
        {
            return true;
        } 
        else
        {
            return false;
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
     * Obtén datos de curso inscrita
     * 
     * El presente método permite obtener la información de el curso
     * relacionada a determinada inscripción, función usada principalmente 
     * al momento de cargar la vista de edición de inscripción.
     *
     * @param integer $id_inscripcion
     * @return array
     */
    public function get_inscripcion_instancias($id_inscripcion)
    {
        $resultados = $this->db->select(
            'int.id_instancia,
            int.cupos_instancia,
            int.cupos_instancia_ocupados,
            concat(cur.nombre_curso, " ", MONTH(per.fecha_inicio) "-", MONTH(per.fecha_cierre), " ", YEAR(per.fecha_inicio_periodo)) as nombre_completo_instancia,
            int.precio_instancia'
        )
        ->from('inscripcion as insc')
        ->join('inscripcion_instancia as ini', 'ini.fk_id_inscripcion_1 = insc.id_inscripcion')
        ->join('curso as int', 'int.id_instancia = ini.fk_id_instancia_1')
        ->join('especialidad as cur', 'cur.id_curso = int.fk_id_curso_1')
        ->join('periodo as per', 'id_periodo = int.fk_id_periodo_1') 
        ->where('insc.id_inscripcion', $id_inscripcion)

        ->get();

        return $resultados->result();
    }

     
    /**
     * Obtén datos de el curso inscrita
     *     
     * @param integer $id_inscripcion
     * @return array
     */
    public function get_instancia_inscrita($id_inscripcion)
    {
        $resultados = $this->db->select(
            'inst.id_instancia,
            inst.cupos_instancia,
            inst.cupos_instancia_ocupados,
            inst.precio_instancia,
            insci.fk_id_inscripcion_1,
            insci.id_inscripcion_instancia,
            concat(cur.nombre_curso, " ", MONTH(per.fecha_inicio), "-", MONTH(p.fecha_cierre), " ", YEAR(per.fecha_inicio_periodo)) as nombre_completo_instancia,
            int.precio_instancia,
            int.serial_instancia'
        )
        ->from('inscripcion as insc')
        ->join('inscripcion_instancia as insci', 'insci.fk_id_inscripcion_1 = insc.id_inscripcion')
        ->join('curso as inst', 'int.id_instancia = insci.fk_id_instancia_1')
        ->join('especialidad as cur', 'cur.id_curso = int.fk_id_curso_1')
        ->join('periodo as per', 'id_periodo = int.fk_id_periodo_1')
        ->where('insc.id', $id_inscripcion)

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
            ban.nombre_banco,
            tdo.tipo_de_operacion,
            per.cedula,
            concat(per.nombres, " ", per.apellidos) as nombre_titular,
            per.cedula as cedula_titular_pago'
            )
        ->from('inscripcion as insc')
        ->join('pago_de_inscripcion as pdins', 'pdins.fk_id_inscripcion = insc.id_inscripcion')
        ->join('banco as ban', 'ban.id_banco = pdins.fk_id_banco')
        ->join('tipo_de_operacion as tdo', 'tdo.id_tipo_de_operacion = pdins.id_tipo_de_operacion')
        ->join('titular as tit', 'tit.id_titular = pdins.fk_id_titular')
        ->join('persona as per', 'per.id = id_persona')
        ->where('insc.id_inscripcion', $id_inscripcion)
        ->get();

        return $resultado->result();
    }

    /**
     * Para comprobar si un participante está o no inscrito en un especialidad,
     * regresa una lista de todos los especialidades donde el participante se encuentra registrado
     * actualmente
     * 
     * Método llamado antes de almacenar la inscripción.
     */
    public function participante_curso($id_curso)
    {
        $resultados = $this->db->select('par.id_participante, 
        per.nombres, 
        cur.id,
        cur.nombre')
        ->from('participante as par')
        ->join('persona as per', 'per.idcur. = par.id_persona')
        ->join('inscripcion as in', 'in.id_participante = par.id')
        ->join('inscripcion_curso as ii', 'ii.fk_id_inscripcion_1 = in.id_inscripcion')
        ->join('curso as it', 'it.id_instancia = ii.fk_id_instancia_1')
        ->join('especialidad as cur', 'cur.id = it.id_curso')
        ->where('par.id', $id_curso)
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén los registros de curso de los especialidades
     * 
     * Utilizado para consultar especialidades en específico, se implementó este método
     * para ser utilizado en el módulo de Inscripciones. El método consulta información
     * en 3 varias tablas y regresa datos cómo por ejemplo: El ID de los participantes
     * registrados en un determinado especialidad.
     *
     * @param string $valor
     * @return array
     */
    public function getInstanciasJSON($valor)
    {
        $resultados = $this->db->select(
            'curso.id_instancia, 
            curso.cupos_instancia, 
            curso.cupos_instancia_ocupados,
            curso.precio_instancia,
            especialidad.nombre_curso,
            concat(especialidad.nombre_curso, " ", periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", YEAR(periodo.fecha_inicio_periodo)) as label,
            concat(periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", YEAR(periodo.fecha_inicio_periodo)) as periodo_academico'
        )
        ->from('curso')
        ->join('especialidad', 'especialidad.id_curso = curso.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = curso.fk_id_periodo_1')
        // ->where('curso.estado_curso', 1)
        ->like('especialidad.nombre_curso', $valor)
        ->get();

        return $resultados->result_array();
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
    public function get_participantesJSON($id_instancia)
    {
        $resultados = $this->db->select(
            'especialidad.nombre_curso,
            i.fk_id_participante_1'
         )
        ->from('curso')
        ->join('especialidad', 'especialidad.id_curso = curso.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = curso.fk_id_periodo_1')
        // Para consultar una lista de participantes inscritos en determinado especialidad
        ->join('inscripcion_instancia as ii', 'ii.fk_id_instancia_1 = curso.id_instancia')
        ->join('inscripcion as i', 'i.id_inscripcion = ii.fk_id_inscripcion_1')
        ->where('curso.id_instancia',  $id_instancia)
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
        $resultado = $this->db->select(
            'per.id_periodo,
            per.fecha_inicio_periodo,
            per.fecha_culminacion_periodo'
        )
        ->from('inscripcion as insc')
        ->join('ocupa as ocu', 'ocu.id_inscripcion = insc.id')
        ->join('curso as inst', 'inst.id = insci.id_instancia')
        ->join('especialidad as cur', 'cur.id_curso = int.fk_id_curso_1')
        ->join('periodo as per', 'id_periodo = int.fk_id_periodo_1')
        ->join('mes as mi', 'per.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'per.mes_cierre_periodo = mc.id_mes') 
        ->where('insc.id_inscripcion', $id_inscripcion)
        ->get()
        ->row();

        // Obtén fecha de hoy del sistema
        $today = date('Y-m-d');

        if($resultado->fecha_culminacion_periodo >= $today)
        {
            return true;
        }
        else if($resultado->fecha_inicio_periodo < $today)
        {
            return false;
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
        $resultados = $this->db->select('YEAR(i.fecha_registro) as year')
        ->from('inscripcion as i')
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
        $resultados = $this->db->select('MONTH(i.hora_inscripcion) as mes_inscripcion, SUM(i.monto_pagado) as monto_generado')
        ->from('inscripcion as i')
        ->where('fecha_inscripcion >=', $year.'-01-01')
        ->where('fecha_inscripcion <=', $year.'-12-31')
        ->group_by('mes_inscripcion')
        ->order_by('mes_inscripcion')
        ->get();

        return $resultados->result(); 
    }

}