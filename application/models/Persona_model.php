<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona_model extends CI_Model {

    
    /**
     * Obtén una lista de todas las personas registradas en unna curso.
     * 
     * @return array
     */
    public function get_personas()
    {
        $resultados = $this->db->select(
            'persona.cedula,
            persona.primer_nombre,
            persona.primer_apellido,
            persona.genero,
            persona.fecha_nacimiento,
            persona.telefono,
            persona.direccion,
            persona.estado,
            persona.fecha_registro')
            ->from('persona') 
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
    public function get_persona($cedula)
    {
        $resultado = $this->db->select(
            'persona.cedula,
            persona.primer_nombre,
            persona.primer_apellido,
            persona.genero,
            persona.fecha_nacimiento,
            TIMESTAMPDIFF(YEAR, persona.fecha_nacimiento, CURDATE()) as edad,
            persona.telefono,
            persona.correo_electronico,
            persona.direccion,
            persona.estado,
            persona.fecha_registro')
            ->from('persona') 
            ->where('persona.cedula', $cedula)
            ->get(); 
    
        // return $resultados->result();

        // $resultado = $this->db->where('id', $id)
        // ->get('persona');

        return $resultado->row();
    }
    
    public function save($data) 
    {
        return $this->db->insert('persona', $data);
    }

    public function update($cedula, $data)
    {
        $this->db->where('cedula', $cedula);

        if($this->db->update('persona', $data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
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
     * @param array $cedula
     * @return array
     */
    public function get_es_participante($cedula)
    {
        $SQL = "SELECT 
        persona.primer_nombre, 
        persona.primer_apellido,
        participante.cedula_persona
        
        FROM persona
        LEFT JOIN participante ON participante.cedula_persona = persona.cedula
        WHERE participante.cedula_persona = ?";

        $resultado = $this->db->query($SQL, array($cedula));

        return $resultado->row();
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $cedula
     * @return array
     */
    public function get_es_titular($cedula)
    {
        $SQL = "SELECT 
        persona.primer_nombre, 
        persona.primer_apellido,
        titular.cedula_persona
        
        FROM persona
        LEFT JOIN titular ON titular.cedula_persona = persona.cedula
        WHERE titular.cedula_persona = ?";

        $resultado = $this->db->query($SQL, array($cedula));

        return $resultado->row();
    }

    /**
     * Determina si una persona está registrada como participante
     *
     * @param integer $cedula
     * @return array
     */
    public function get_es_facilitador($cedula)
    {
        $SQL = "SELECT 
        persona.primer_nombre, 
        persona.primer_apellido,
        facilitador.cedula_persona
        
        FROM persona
        LEFT JOIN facilitador ON facilitador.cedula_persona = persona.cedula
        WHERE facilitador.cedula_persona = ?";

        $resultado = $this->db->query($SQL, array($cedula));

        return $resultado->row();
    }

}