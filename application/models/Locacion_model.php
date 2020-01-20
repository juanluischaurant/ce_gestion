<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locacion_model extends CI_Model {

    // Estas dos funciones sirven para unir las tablas relacionadas a la tabla "dictado"
    public function get_locaciones()
    {
        $resultados = $this->db->select(
            'l.id, 
            l.estado,
            l.nombre,
            l.fecha_registro,
            (SELECT COUNT(*) FROM instancia WHERE instancia.id_locacion = l.id) AS instancias_asociadas,
            l.direccion'
        )
        ->from('locacion as l')   
        ->get(); 

        return $resultados->result();
    }

    public function get_locacion($id_locacion)
    {
        $resultado = $this->db->select(
            'l.id, 
            l.estado,
            l.nombre,
            l.direccion,
            l.fecha_creacion,
            (SELECT COUNT(*) FROM instancia WHERE instancia.id_locacion = l.id) AS instancias_asociadas,
            l.direccion'
        )
        ->from('locacion as l')   
        ->where('l.id', $id_locacion)
        ->get(); 

        return $resultado->row();
    }

    public function save($data)
    {
        // Almacena un curso listo para ser instanciado
        return $this->db->insert('locacion', $data); 
    }

    public function update($id_locacion, $data)
    {
        $this->db->where('id_locacion', $id_locacion);
        return $this->db->update('locacion', $data);
    }

    public function delete($id_locacion)
    {
      
        $this->db->where('id_locacion', $id_locacion);
        $this->db->limit(1);

        if($this->db->delete('locacion'))
        {
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }

    }

    public function get_instancias_asociadas($id_locacion)
    {
        // Obtén una lista de cursos instanciados
        $resultados = $this->db->select('ins.id_instancia, 
        ins.cupos_instancia, 
        ins.cupos_instancia_ocupados,
        ins.fecha_creacion,
        ins.estado_instancia,
        ins.serial_instancia,
        concat(ins.cupos_instancia, "/", ins.cupos_instancia_ocupados) as total_cupos,
        tur.nombre,
        tur.id,
        tur.descripcion,
        curso.nombre_curso,
        concat(mi.nombre_mes, "-", mc.nombre_mes, " ", YEAR(per.fecha_inicio_periodo)) as periodo_academico,
        per.fecha_culminacion_periodo')
        ->from('instancia AS ins')
        ->join('locacion AS loc', 'loc.id = ins.id_locacion')
        ->join('turno as tur', 'ins.id_turno = tur.id')
        ->join('curso', 'curso.id_curso = ins.fk_id_curso_1')
        ->join('periodo as per', 'per.id_periodo = ins.fk_id_periodo_1')
        ->join('mes as mi', 'per.mes_inicio_periodo = mi.id_mes') 
        ->join('mes as mc', 'per.mes_cierre_periodo = mc.id_mes') 
        // ->where('ins.estado_instancia', '1')
        // ->or_where('ins.estado_instancia', '0')
        ->where('loc.id', $id_locacion)
        ->limit(25)
        ->get();

        return $resultados->result();
    }

    /**
     * Contar Instancias Asociadas
     * 
     * Retora un conteo de las instancias asociadas a la
     * locación.
     *
     * @param integer $id_locacion
     * @return array
     */
    public function count_instancias_asociadas($id_locacion)
    {
        $resultado = $this->db->select(
            '(SELECT COUNT(*) FROM instancia WHERE instancia.fk_id_locacion_1 = l.id) AS instancias_asociadas'
        )
        ->from('locacion as l')   
        ->where('l.id', $id_locacion)
        ->get(); 

        return $resultado->row();
    }


}