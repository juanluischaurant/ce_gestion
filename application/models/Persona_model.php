<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model {

    
    /**
     * Obtén una lista de todas las personas registradas en unna instancia.
     * 
     * @return array
     */
    public function get_personas()
    {
        $resultados = $this->db->select(
            'p.id,
            p.cedula,
            p.nombres,
            p.apellidos,
            p.genero,
            p.fecha_nacimiento,
            p.telefono,
            p.direccion,
            p.estado,
            p.fecha_registro')
            ->from('persona as p') 
            ->where('estado', 1)
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
            'p.id,
            p.cedula,
            p.nombres,
            p.apellidos,
            p.genero,
            p.fecha_nacimiento,
            TIMESTAMPDIFF(year, p.fecha_nacimiento, CURDATE()) as edad,
            p.telefono,
            p.direccion,
            p.estado,
            p.fecha_registro')
            ->from('persona as p') 
            ->where('id', $id_persona)
            ->get(); 
    
        // return $resultados->result();

        // $resultado = $this->db->where('id', $id)
        // ->get('persona');

        return $resultado->row();
    }
    
    public function save($data) {
        return $this->db->insert('persona', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
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
     * @return array
     */
    public function get_es_participante($id_persona)
    {
        $SQL = "SELECT 
        persona.nombres, 
        persona.apellidos,
        participante.id_participante
        
        FROM persona
        LEFT JOIN participante ON participante.id_persona = persona.id_persona
        WHERE participante.id_persona = ?";

        $resultado = $this->db->query($SQL, array($id_persona));

        return $resultado->row();
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $id_persona
     * @return array
     */
    public function get_es_titular($id_persona)
    {
        $SQL = "SELECT 
        persona.nombres_persona, 
        persona.apellidos_persona,
        titular.id_titular
        
        FROM persona
        LEFT JOIN titular ON titular.id_persona = persona.id_persona
        WHERE titular.id_persona = ?";

        $resultado = $this->db->query($SQL, array($id_persona));

        return $resultado->row();
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $id_persona
     * @return array
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