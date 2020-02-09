<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accion_model extends CI_Model
{
    /**
     * Prepara e inserta datos dentro de la tabla Acción. Utilizada
     * al realizar distintas operaciones a lo largo de la aplicación
     *
     * @param integer $username
     * @param integer $fk_id_tipo_accion
     * @param string $descripcion_accion
     * @param string $tabla_afectada
     * @return boolean
     */
    public function save_action($username, $fk_id_tipo_accion, $descripcion_accion, $tabla_afectada)
    {
        $data = array(
            'username' => $username,
            'id_tipo_accion' => $fk_id_tipo_accion,
            'descripcion' => $descripcion_accion,
            'tabla_afectada' => $tabla_afectada
        );

        return $this->db->insert('accion', $data);
    }

    /**
     * Retorna lista de acciones realizadas dentro de CE Gestión
     *
     * @return array
     */
    public function get_acciones()
    {
        $resultados = $this->db->select(
            'a.id,
            a.username,
            a.id_tipo_accion,
            a.descripcion,
            a.tabla_afectada,
            a.fecha_registro,
            ta.nombre,'
        )
        ->from('accion as a')
        ->join('tipo_de_accion as ta', 'ta.id = a.id_tipo_accion')
        ->get(); 
    
        return $resultados->result();
    }

    /**
     * Consulta acciones en rango de fecha
     * 
     * Método utilizado para filtrar resultados de búsqueda de acciones
     * en base a un determinado rango de fechas.
     *
     * @param string $fecha_inicio
     * @param string $fecha_fin
     * @return void
     */
    public function get_acciones_por_fecha($fecha_inicio, $fecha_fin)
    {
        $resultados = $this->db->select(
            'a.id,
            a.username,
            a.id_tipo_accion,
            a.descripcion,
            a.tabla_afectada,
            a.fecha_registro,
            ta.nombre,'
        )
        ->from('accion as a')
        ->join('tipo_de_accion as ta', 'ta.id = a.id_tipo_accion')
        ->where('a.fecha_registro >=', $fecha_inicio)
        ->where('a.fecha_registro <=', $fecha_fin)
        ->get(); 
    
        return $resultados->result();
    }

}
