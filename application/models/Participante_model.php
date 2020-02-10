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
            (SELECT COUNT(*) FROM inscripcion WHERE inscripcion.cedula_participante = participante.cedula_persona) AS inscripciones_participante,
            persona.primer_nombre,
            persona.primer_apellido,
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
    public function get_participante($cedula_persona)
    {
        $resultado = $this->db->select(
            'persona.primer_nombre,
            persona.primer_apellido,
            persona.genero,
            persona.fecha_nacimiento,
            persona.telefono,
            persona.direccion,
            persona.estado,
            participante.cedula_persona,
            participante.estado,
            participante.fecha_registro,
            participante.id_nivel_academico,
            participante.estado')
            ->from('participante')
            ->join('persona', 'persona.cedula = participante.cedula_persona')
            ->where('participante.cedula_persona', $cedula_persona)
            ->where('participante.estado', 1) 
            ->get(); 
    
        return $resultado->row();
    }

    /**
     * Retorna las cursos en los que el participante se ha inscrito
     *
     * @return integer $id_participante
     */
    public function get_cursos_inscritos($cedula_persona)
    {
        $this->db->query("SET lc_time_names = 'es_ES';");
        $SQL = "SELECT 
            inscripcion.id,
            participante.cedula_persona,
            nc.descripcion,
            curso.serial,
            concat(MONTHNAME(periodo.fecha_inicio), '-', MONTHNAME(periodo.fecha_culminacion), ' ', YEAR(periodo.fecha_inicio)) as periodo_academico
        FROM inscripcion
        JOIN participante ON participante.cedula_persona = inscripcion.cedula_participante
        JOIN curso ON curso.id = inscripcion.id_curso
        JOIN nombre_curso AS nc ON nc.id = curso.id_nombre_curso
        JOIN periodo ON periodo.id = curso.id_periodo
        JOIN persona ON persona.cedula = participante.cedula_persona
        WHERE participante.cedula_persona = ?";

        $query = $this->db->query($SQL, $cedula_persona);

        return $query->result();

    }

    public function save($data)
    {
        return $this->db->insert('participante', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('cedula_persona', $id);
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