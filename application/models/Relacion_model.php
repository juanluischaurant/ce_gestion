<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relacion_model extends CI_Model
{
    public function get_relaciones_curso($id_curso)
    {
        $resultados = $this->db->select(
            'pdi.id, 
            pdi.numero_referencia_bancaria, 
            pdi.monto_operacion, 
            pdi.estatus_pago,
            pdi.fecha_registro, 
            per.cedula'
          )
          ->from('pago_de_inscripcion as pdi')
          ->join('titular as ti', 'ti.cedula_persona = pdi.cedula_titular')
          ->join('persona as per', 'per.cedula = ti.cedula_persona')
          ->get();
      
          return $resultados->result();
    }

}
