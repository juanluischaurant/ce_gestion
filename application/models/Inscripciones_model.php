<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripciones_model extends CI_Model {

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
     * Obtén instancia inscrita
     * 
     * El presente método permite obtener la información de la instancia
     * relacionada a la inscripción, esta data será mostrada al momento de
     * cargar la vista de edición de inscripción.
     *
     * @param integer $id_inscripcion
     * @return array
     */
    public function get_editar_instancia($id_inscripcion)
    {
        $resultados = $this->db->select(
            'int.id_instancia,
            int.cupos_instancia,
            int.cupos_instancia_ocupados,
            concat(cur.nombre_curso, " ", mi.nombre_mes, "-", mc.nombre_mes, " ", per.year_periodo) as nombre_completo_instancia,
            int.precio_instancia'
        )
        ->from('inscripcion as insc')
        ->join('inscripcion_instancia as ini', 'ini.fk_id_inscripcion_1 = insc.id_inscripcion')
        ->join('instancia as int', 'int.id_instancia = ini.fk_id_instancia_1')
        ->join('curso as cur', 'cur.id_curso = int.fk_id_curso_1')
        ->join('periodo as per', 'id_periodo = int.fk_id_periodo_1')
        ->join('mes as mi', 'per.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'per.mes_cierre_periodo = mc.id_mes') 
        ->where('insc.id_inscripcion', $id_inscripcion)

        ->get();

        return $resultados->result();
    }

    /**
     * Realiza consulta que retorna una lista de inscripciones realizadas
     * @return array
     */   
    public function get_inscripciones()
    {
        $resultados = $this->db->select(
            'ii.fk_id_inscripcion_1,
            ii.fk_id_instancia_1,
            ii.id_inscripcion_instancia, 
            in.hora_inscripcion, 
            concat(curso.nombre_curso, " ", mi.nombre_mes, "-", mc.nombre_mes, " ", p.year_periodo) as nombre_completo_instancia,
            concat(pe.nombres_persona, " ", pe.apellidos_persona) as nombre_completo_participante,
            pe.cedula_persona'
        )
        ->from('inscripcion_instancia as ii')
        ->join('inscripcion as in', 'in.id_inscripcion = ii.fk_id_inscripcion_1')
        ->join('participante as par', 'par.id_participante = in.fk_id_participante_1')
        ->join('persona as pe', 'pe.id_persona = par.fk_id_persona_2')
        ->join('instancia', 'instancia.id_instancia = ii.fk_id_instancia_1')
        ->join('periodo as p', 'id_periodo = instancia.fk_id_periodo_1')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 

        ->get();

        return $resultados->result();
    }

    /**
     * Obtén un registro determinado de la tabla "inscripcion"
     * 
     * Método utilizado principalmente para generar la ficha de inscripción. Recibe
     * un parámetro que es el ID de la inscripción.
     *
     * @param integer $id_inscripcion
     * @return array
     */
    public function get_inscripcion($id_inscripcion)
    {
        $resultado = $this->db->select(
            'i.hora_inscripcion,
            i.fecha_inscripcion,
            i.monto_pagado,
            i.precio_total,
            i.descuento,
            i.precio_final,
            p.cedula_persona,
            concat(p.nombres_persona, " ", p.apellidos_persona) as nombre_completo_participante,
            p.direccion_persona,
            p.telefono_persona')
        ->from('inscripcion as i')
        ->join('participante as par', 'par.id_participante = fk_id_participante_1')
        ->join('persona as p', 'p.id_persona = par.fk_id_persona_2')
        ->where('i.id_inscripcion', $id_inscripcion)
        ->get();

        return $resultado->row();
    }
    
    /**
     * Obtén los cursos comprados en una inscripción
     * 
     * Método utilizado principalmente para generar la ficha de inscripción mostrada al presionar el botón
     * de ver Inscripción
     *
     * @param integer $id
     * @return void
     */
    public function get_inscripcion_instancia($id_inscripcion)
    {
        $resultado = $this->db->select(
            'ii.fk_id_inscripcion_1,
            ii.id_inscripcion_instancia,
            concat(cu.nombre_curso, " ", mi.nombre_mes, "-", mc.nombre_mes, " ", p.year_periodo) as nombre_completo_instancia,
            instancia.precio_instancia'
        )
        ->from('inscripcion_instancia as ii')
        ->join('instancia', 'instancia.id_instancia = ii.fk_id_instancia_1')
        ->join('curso as cu', 'cu.id_curso = instancia.fk_id_curso_1')
        ->join('periodo as p', 'id_periodo = instancia.fk_id_periodo_1')
        ->join('mes as mi', 'p.mes_inicio_periodo = mi.id_mes')
        ->join('mes as mc', 'p.mes_cierre_periodo = mc.id_mes') 
        ->where('ii.fk_id_inscripcion_1 ', $id_inscripcion)
        ->get();

        return $resultado->result();
    }

    /**
     * Utilizada para actualizar datos de inscripción
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

    public function get_id_inscripcion_instancia($id_inscripcion)
    {
        $resultado = $this->db->select(
            'ii.id_inscripcion_instancia')
        ->from('inscripcion as i')
        ->join('inscripcion_instancia as ii', 'i.id_inscripcion = ii.fk_id_inscripcion_1')
        ->where('ii.fk_id_inscripcion_1', $id_inscripcion)
        ->get();

        return $resultado->row();
    }

    /**
     * Obtén los pagos realizados en una inscripción
     * 
     * Método utilizado principalmente para generar la ficha de inscripción dentro de la vista
     * "Generar Inscripción" al presionar el botón de ver detalles
     *
     * @param integer $id_inscripcion
     * @return void
     */
    public function get_pago_inscripcion($id_inscripcion)
    {
        $resultado = $this->db->select(
            'pago_de_inscripcion.*')
        ->from('pago_de_inscripcion')
        ->where('fk_id_inscripcion', $id_inscripcion)
        ->get();

        return $resultado->result();
    }

    /**
	 * Actualiza la clave foránea fk_id_inscripcion 
	 *
	 * @param integer $id_pago
	 * @param integer $id_ultima_inscripcion
	 * @return void
	 */
    public function updateIdInscripcion($id_pago,$data)
    {
        $this->db->where("id_pago",$id_pago);
        $this->db->update("pago_de_inscripcion",$data);
    }

    /**
     * Para comprobar si un participante está o no inscrito en un curso,
     * regresa una lista de todos los cursos donde el participante se encuentra registrado
     * 
     * Método llamado antes de almacenar la inscripción.
     */
    public function participante_curso($id_curso)
    {
        $resultados = $this->db->select('pa.id_participante, 
        pe.nombres_persona, 
        cu.id_curso,
        cu.nombre_curso')
        ->from('participante as pa')
        ->join('persona as pe', 'pe.id_persona = pa.fk_id_persona_2')
        ->join('inscripcion as in', 'in.fk_id_participante_1 = pa.id_participante')
        ->join('inscripcion_curso as ii', 'ii.fk_id_inscripcion_1 = in.id_inscripcion')
        ->join('instancia as it', 'it.id_instancia = ii.fk_id_instancia_1')
        ->join('curso as cu', 'cu.id_curso = it.fk_id_curso_1')
        ->where('pa.id_participante', $id_curso)
        ->get();

        return $resultados->result();
    }

    /**
     * Obtén los registros de instancia de los cursos
     * 
     * Utilizado para consultar cursos en específico, se implementó este método
     * para ser utilizado en el módulo de Inscripciones. El método consulta información
     * en 3 varias tablas y regresa datos cómo por ejemplo: El ID de los participantes
     * registrados en un determinado curso.
     *
     * @param string $valor
     * @return array
     */
    public function getInstanciasJSON($valor)
    {
        $resultados = $this->db->select(
            'instancia.id_instancia, 
            instancia.cupos_instancia, 
            instancia.cupos_instancia_ocupados,
            instancia.precio_instancia,
            curso.nombre_curso,
            concat(curso.nombre_curso, " ", periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", periodo.year_periodo) as label,
            concat(periodo.mes_inicio_periodo, "-", periodo.mes_cierre_periodo, " ", periodo.year_periodo) as periodo_academico'
        )
        ->from('instancia')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = instancia.fk_id_periodo_1')
        // ->where('instancia.estado_instancia', 1)
        ->like('curso.nombre_curso', $valor)
        ->get();

        return $resultados->result_array();
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
    public function getParticipantesJSON($id_instancia)
    {
        $resultados = $this->db->select(
            'curso.nombre_curso,
            i.fk_id_participante_1'
         )
        ->from('instancia')
        ->join('curso', 'curso.id_curso = instancia.fk_id_curso_1')
        ->join('periodo', 'periodo.id_periodo = instancia.fk_id_periodo_1')
        // Para consultar una lista de participantes inscritos en determinado curso
        ->join('inscripcion_instancia as ii', 'ii.fk_id_instancia_1 = instancia.id_instancia')
        ->join('inscripcion as i', 'i.id_inscripcion = ii.fk_id_inscripcion_1')
        ->where('instancia.id_instancia',  $id_instancia)
        ->get();

        return $resultados->result_array();
    } 

    /**
     * Obtiene lista de los años correspondientes a las inscripciones registradas
     * en la tabla "inscripcion".
     *
     * @return void
     */
    public function inscripcion_years()
    {
        $resultados = $this->db->select('YEAR(i.fecha_inscripcion) as year')
        ->from('inscripcion as i')
        ->group_by('year')
        ->order_by('year', 'desc')
        ->get();

        return $resultados->result();
    }
    
    /**
     * Consulta en la base de datos el monto de ingresos generados por concepto
     * de inscripciones, organizados por mes
     *
     * @param integer $year
     * @return void
     */
    public function inscripcion_montos($year)
    {
        $resultados = $this->db->select('MONTH(i.fecha_inscripcion) as mes_inscripcion, SUM(i.monto_pagado) as monto_generado')
        ->from('inscripcion as i')
        ->where('fecha_inscripcion >=', $year.'-01-01')
        ->where('fecha_inscripcion <=', $year.'-12-31')
        ->group_by('mes_inscripcion')
        ->order_by('mes_inscripcion')
        ->get();

        return $resultados->result(); 
    }
    
    /**
     * Obtén lista de pagos realizados 
     *
     * @param integer $valor
     * @return array
     */
    public function get_pagos_json($valor)
    {            
        $this->db->select(
            'pi.serial_pago,
            pi.numero_operacion,
            pi.estado_pago,
            pi.monto_operacion,
            pi.id_pago,
            pi.estado_pago,
            pi.fk_id_tipo_operacion,
            concat(pi.numero_operacion, " - ", pe.nombres_persona, " ", pe.apellidos_persona) as label,
            concat(pe.nombres_persona, " ", pe.apellidos_persona) as nombre_cliente,
            pe.cedula_persona'
            )
        ->from('pago_de_inscripcion as pi')
        ->join('titular as c', 'c.id_titular = pi.fk_id_titular')
        ->join('persona as pe', 'pe.id_persona = c.fk_id_persona_1');
                
        if($valor != '')
        {
            $this->db->like('pi.numero_operacion', $valor);
			$this->db->or_like('pe.nombres_persona', $valor);
			$this->db->or_like('pe.apellidos_persona', $valor);
        }

        $valor=$this->db->get();
        return $valor->result_array();
    }

}