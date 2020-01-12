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
    // Usada en el controlador:
    // gestion/personas/store
    'agregar_persona' => array(
        array(
            'field' => 'cedula-persona',
            'label' => 'Cédula',
            'rules' => 'required|trim|min_length[2]|max_length[10]|is_unique[persona.cedula_persona]',
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
        )
    ),
    // Usada en el controlador:
    // administrador/usuarios/update
    'editar_usuario' => array(
        array(
            'field' => 'username-usuario',
            'label' => 'Nombre de Usuario',
            'rules' => 'required|trim|min_length[2]|max_length[95]|callback_edit_unique_usuario',
            'errors' => array(
                'edit_unique_usuario' => 'Usuario existente. Por favor intenta de nuevo'
            )
        ),
        array(
            'field' => 'password-usuario',
            'label' => 'Contraseña',
            'rules' => 'trim|min_length[2]|max_length[15]'
        ),
        array(
            'field' => 'confirmar-password-usuario',
            'label' => 'Comfirm Contraseña',
            'rules' => 'matches[password-usuario]|min_length[2]|max_length[15]'
        ),

    ),
    // Usada en el controlador:
    // movimientos/pagos/update
    'editar_pago' => array(
        array(
            'field' => 'monto-de-operacion',
            'label' => 'Monto de Operacion',
            'rules' => 'required|trim|min_length[2]|max_length[95]'
        ),
    ),
    // Usada en el controlador:
    // movimientos/inscripciones/add
    'agregar_pago' => array(
        array(
            'field' => 'numero-de-operacion-unico',
            'label' => 'Número de Operación',
            'rules' => 'required|is_unique[pago_de_inscripcion.numero_operacion]'
        ),
    ),
    // Usada en el controlador
    // movimientos/instancias/update
    'editar_instancia' => array(
        array(
            'field' => 'costo-instancia',
            'label' => 'Costo',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'id-periodo-instancia',
            'label' => 'Período',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'turno-instancia',
            'label' => 'Turno',
            'rules' => 'required'
        ),
        array(
            'field' => 'cupos-instancia',
            'label' => 'Cupos',
            'rules' => 'required'
        ),


    ),
);


?>