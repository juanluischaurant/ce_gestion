<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participante_model extends CI_Model {

    /**
     * Obtener participantes
     * 
     * Obtiene una lista de participantes registrados.
     *
     * @return array
     */
    public function get_participantes()
    {
        $resultados = $this->db->select(
            'participante.cedula_persona,
            persona.nombres,
            persona.apellidos,
            persona.genero,
            persona.fecha_nacimiento,
            persona.telefono,
            persona.direccion,
            participante.estado,
            participante.fecha_registro,
            participante.estado')
            ->from('participante')
            ->join('persona', 'persona.cedula = participante.cedula_persona')
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
            'persona.id,
            persona.cedula,
            persona.nombres,
            persona.apellidos,
            persona.genero,
            persona.fecha_nacimiento,
            persona.telefono,
            persona.direccion,
            persona.estado,
            participante.id,
            participante.estado,
            participante.fecha_registro,
            participante.id_persona,
            participante.estado')
            ->from('participante as par')
            ->join('persona as per', 'persona.id = participante.id_persona')
            ->where('participante.id', $id_participante)
            ->where('participante.estado', 1) 
            ->get(); 
    
        return $resultado->row();
    }

    /**
     * Retorna las cursos en las que el participante se ha inscrito
     *
     * @return integer $id_participante
     */
    public function get_instancias_inscritas($id_participante)
    {
        $resultados = $this->db->select(
            'cur.nombre_curso,
            participante.id_persona,
            persona.nombres'
        )
        ->from('participante AS par')
        ->join('persona AS per', 'persona.id = participante.id_persona')
        ->join('inscripcion AS ins', 'ins.fk_id_participante_1 = participante.id')
        ->join('pago_de_inscripcion AS pdi', 'pdi.fk_id_inscripcion = ins.id_inscripcion')
        ->join('inscripcion_instancia AS ins_inst', 'ins_inst.fk_id_inscripcion_1 = ins.id_inscripcion')
        ->join('curso AS inst', 'inst.id_instancia = ins_inst.fk_id_instancia_1')
        ->join('especialidad AS cur', 'cur.id_curso = inst.fk_id_curso_1')
        ->where('participante.id', $id_participante)
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
     * @param integer $cedula_persona
     * @return boolean
     */
    public function duplicidad_participante($cedula_persona)
    {
        $query = $this->db->select('cedula_persona')
        ->from('participante')
        ->where('cedula_persona', $cedula_persona)
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

    /**
     * Consulta la BD y obtiene una lista de todos los niveles académicos
     *  disponibles para luego almacenrla en un array que es retornado, 
     * el método se utiliza para generar un elemento DROPDOWN HTML
     *
     * @return array
     */
    public function nivel_academico_dropdown()
    {
        $query = $this->db
        ->from('nivel_academico')
        ->get();

        $array[''] = 'Selecciona';

        foreach($query->result() as $row)
        {
            // Crea un arreglo llave-valor,
            // la llave se imprime en el atributo "value" y el nombre aparece visible en el dropdown
            $array[$row->id] = $row->nombre;
        }

        return $array;
    }
}