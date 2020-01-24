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
            (SELECT COUNT(*) FROM curso WHERE curso.id_locacion = l.id) AS instancias_asociadas,
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
            l.fecha_registro,
            (SELECT COUNT(*) FROM curso WHERE curso.id_locacion = l.id) AS instancias_asociadas,
            l.direccion'
        )
        ->from('locacion as l')   
        ->where('l.id', $id_locacion)
        ->get(); 

        return $resultado->row();
    }

    public function save($data)
    {
        // Almacena un especialidad listo para ser instanciado
        return $this->db->insert('locacion', $data); 
    }

    public function update($id_locacion, $data)
    {
        $this->db->where('id', $id_locacion);
        return $this->db->update('locacion', $data);
    }

    public function delete($id_locacion)
    {
      
        $this->db->where('id', $id_locacion);
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
        // Obtén una lista de especialidades instanciados
        $resultados = $this->db->select('ins.id, 
        ins.cupos, 
        ins.fecha_registro,
        ins.estado,
        concat(ins.cupos, "/") as total_cupos,
        tur.nombre,
        tur.id,
        especialidad.nombre,
        concat(MONTH(per.fecha_inicio), "-", MONTH(per.fecha_culminacion), " ", YEAR(per.fecha_inicio)) as periodo_academico,
        per.fecha_culminacion')
        ->from('curso AS ins')
        ->join('locacion AS loc', 'loc.id = ins.id_locacion')
        ->join('turno as tur', 'ins.id_turno = tur.id')
        ->join('especialidad', 'especialidad.id = ins.id_curso')
        ->join('periodo as per', 'per.id = ins.id_periodo')
        // ->where('ins.estado_instancia', '1')
        // ->or_where('ins.estado_instancia', '0')
        ->where('loc.id', $id_locacion)
        ->limit(25)
        ->get();

        return $resultados->result();
    }

    /**
     * Contar Cursos Asociados
     * 
     * Retora un conteo de las cursos asociadas a la
     * locación.
     *
     * @param integer $id_locacion
     * @return array
     */
    public function count_instancias_asociadas($id_locacion)
    {
        $resultado = $this->db->select(
            '(SELECT COUNT(*) FROM curso WHERE curso.id_locacion = l.id) AS instancias_asociadas'
        )
        ->from('locacion as l')   
        ->where('l.id', $id_locacion)
        ->get(); 

        return $resultado->row();
    }


}