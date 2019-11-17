<?php

/**
 * Este archivo fué creado para almacenar reglas de validación a raíz de una investigación
 * en búsqueda de un método para crear validaciones personalizadas.
 * 
 * Enlaces de Interés:
 * 
 * https://stackoverflow.com/questions/27621250/is-unique-in-codeigniter-for-edit-function
 */

$config = array(
    'editar_persona' => array(
        array(
            'field' => 'cedula-persona',
            'label' => 'Cédula',
            'rules' => 'required|trim|min_length[2]|max_length[10]|callback_edit_unique_cedula',
            'errors' => array(
                'edit_unique_cedula' => 'Cédula en uso. Por favor intenta de nuevo'
            )
        ),
        array(
            'field' => 'nombre-persona',
            'label' => 'Nombres',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'apellido-persona',
            'label' => 'Apellidos',
            'rules' => 'required|trim|min_length[2]|max_length[45]'
        ),
        array(
            'field' => 'genero-persona',
            'label' => 'Género',
            'rules' => 'required'
        ),
        array(
            'field' => 'telefono-persona',
            'label' => 'Número de Teléfono',
            'rules' => 'trim|min_length[6]|max_length[12]'
        ),
        array(
            'field' => 'direccion-persona',
            'label' => 'Dirección',
            'rules' => 'trim|min_length[6]|max_length[95]'
        ),
    ),
);


?>