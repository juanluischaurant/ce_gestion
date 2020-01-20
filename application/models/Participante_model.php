<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participante_model extends CI_Model {

    public function getParticipantes()
    {
        $resultados = $this->db->select(
            'per.id,
            per.cedula,
            per.nombres,
            per.apellidos,
            per.genero,
            per.fecha_nacimiento,
            per.telefono,
            per.direccion,
            per.estado,
            par.id,
            par.estado,
            par.fecha_registro,
            par.id_persona,
            par.estado')
            ->from('persona as per')
            ->join('participante as par', 'par.id_persona = per.id')
            ->where('par.estado', '1') 
            ->get(); 
    
            return $resultados->result();
    }

    /**
     * Permite consultar en la base de datos los datos específicos de un participante
     *
     * @param integer $id_participante
     * @return void
     */
    public function get_participante($id_participante)
    {
        $resultado = $this->db->select(
            'per.id,
            per.cedula,
            per.nombres,
            per.apellidos,
            per.genero,
            per.fecha_nacimiento,
            per.telefono,
            per.direccion,
            per.estado,
            par.id,
            par.estado,
            par.fecha_registro,
            par.id_persona,
            par.estado')
            ->from('participante as par')
            ->join('persona as per', 'per.id = par.id_persona')
            ->where('par.id', $id_participante)
            ->where('par.estado', 1) 
            ->get(); 
    
        return $resultado->row();
    }

    /**
     * Retorna las instancias en las que el participante se ha inscrito
     *
     * @return integer $id_participante
     */
    public function get_instancias_inscritas($id_participante)
    {
        $resultados = $this->db->select(
            'cur.nombre_curso,
            par.id_persona,
            per.nombres'
        )
        ->from('participante AS par')
        ->join('persona AS per', 'per.id = par.id_persona')
        ->join('inscripcion AS ins', 'ins.fk_id_participante_1 = par.id')
        ->join('pago_de_inscripcion AS pdi', 'pdi.fk_id_inscripcion = ins.id_inscripcion')
        ->join('inscripcion_instancia AS ins_inst', 'ins_inst.fk_id_inscripcion_1 = ins.id_inscripcion')
        ->join('instancia AS inst', 'inst.id_instancia = ins_inst.fk_id_instancia_1')
        ->join('curso AS cur', 'cur.id_curso = inst.fk_id_curso_1')
        ->where('par.id', $id_participante)
        ->group_by('ins.id_inscripcion')
        ->get();

        return $resultados->result_array();
    }

    public function save($data)
    {
        return $this->db->insert('participante', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_participante', $id);
        return $this->db->update('participante', $data);
    }
    
    /**
     * Al momento de asignar el rol de Participante a una Persona, 
     * verifica que esta acción no haya sido realizada anteriormente
     *
     * @param integer $id
     * @return boolean
     */
    public function duplicidad_participante($id)
    {
        $query = $this->db->select('id_persona')
        ->from('participante')
        ->where('id_persona', $id)
        ->get();

        // Retorna verdadero si la persona no está registrada aún
        if($query->num_rows() == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}