<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas_model extends CI_Model {

    
    public function getPersonas()
    {
        $resultados = $this->db->select(
            'p.id_persona,
            p.cedula_persona,
            p.nombres_persona,
            p.apellidos_persona,
            p.genero_persona,
            p.fecha_nacimiento_persona,
            p.telefono_persona,
            p.direccion_persona,
            p.estado_persona,
            p.fecha_registro_persona')
            ->from('persona as p') 
            ->where('estado_persona', 1)
            ->get(); 
    
        return $resultados->result();
    }

    /**
     * Permite realizar una consulta a la base de datos para obterner toda la información 
     * sobre la persona con el ID indicado
     *
     * @param int $id
     * @return array
     */
    public function get_persona($id_persona)
    {
        $resultado = $this->db->select(
            'p.id_persona,
            p.cedula_persona,
            p.nombres_persona,
            p.apellidos_persona,
            p.genero_persona,
            p.fecha_nacimiento_persona,
            TIMESTAMPDIFF(year, P.fecha_nacimiento_persona, CURDATE()) as edad_persona,
            p.telefono_persona,
            p.direccion_persona,
            p.estado_persona,
            p.fecha_registro_persona')
            ->from('persona as p') 
            ->where('id_persona', $id_persona)
            ->get(); 
    
        // return $resultados->result();

        // $resultado = $this->db->where('id_persona', $id)
        // ->get('persona');

        return $resultado->row();
    }
    
    public function save($data) {
        return $this->db->insert('persona', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_persona', $id);
        return $this->db->update('persona', $data);
    }

    public function lastID()
    {
		return $this->db->insert_id();
    }

    public function generos_dropdown()
    {
        $array = array(
            '' => 'Seleccione',
            1 => 'Masculino',
            2 => 'Femenino'
        );

        return $array;
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $id_persona
     * @return void
     */
    public function get_es_participante($id_persona)
    {
        $SQL = "SELECT 
        persona.nombres_persona, 
        persona.apellidos_persona,
        participante.id_participante
        
        FROM persona
        LEFT JOIN participante ON participante.fk_id_persona_2 = persona.id_persona
        WHERE participante.fk_id_persona_2 = ?";

        $resultado = $this->db->query($SQL, array($id_persona));

        return $resultado->row();
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $id_persona
     * @return void
     */
    public function get_es_titular($id_persona)
    {
        $SQL = "SELECT 
        persona.nombres_persona, 
        persona.apellidos_persona,
        titular.id_titular
        
        FROM persona
        LEFT JOIN titular ON titular.fk_id_persona_1 = persona.id_persona
        WHERE titular.fk_id_persona_1 = ?";

        $resultado = $this->db->query($SQL, array($id_persona));

        return $resultado->row();
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $id_persona
     * @return void
     */
    public function get_es_facilitador($id_persona)
    {
        $SQL = "SELECT 
        persona.nombres_persona, 
        persona.apellidos_persona,
        facilitador.id_facilitador
        
        FROM persona
        LEFT JOIN facilitador ON facilitador.fk_id_persona_3 = persona.id_persona
        WHERE facilitador.fk_id_persona_3 = ?";

        $resultado = $this->db->query($SQL, array($id_persona));

        return $resultado->row();
    }

}