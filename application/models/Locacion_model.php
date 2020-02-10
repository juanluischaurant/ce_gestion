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
        $resultados = $this->db->select(
        'curso.id, 
        curso.serial,
        curso.cupos, 
        curso.fecha_registro,
        curso.estado,
        concat(curso.cupos, "/") as total_cupos,
        (SELECT COUNT(*) FROM inscripcion WHERE curso.id = inscripcion.id_curso AND inscripcion.estado = 1) AS conteo_inscripciones,
        tur.nombre AS nombre_turno,
        tur.id,
        nc.descripcion,
        concat(MONTH(per.fecha_inicio), "-", MONTH(per.fecha_culminacion), " ", YEAR(per.fecha_inicio)) as periodo_academico,
        per.fecha_culminacion')
        ->from('curso')
        ->join('locacion AS loc', 'loc.id = curso.id_locacion')
        ->join('turno as tur', 'curso.id_turno = tur.id')
        ->join('nombre_curso AS nc', 'nc.id = curso.id_nombre_curso')
        ->join('periodo as per', 'per.id = curso.id_periodo')
        // ->where('curso.estado_curso', '1')
        // ->or_where('curso.estado_curso', '0')
        ->where('loc.id', $id_locacion)
        ->limit(25)
        ->get();

        return $resultados->result();
    }

    /**
     * Contar Cursos Asociados
     * 
     * Retorna un conteo de las cursos asociados a la
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