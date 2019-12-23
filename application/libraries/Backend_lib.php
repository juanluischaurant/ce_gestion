<?php

// Esta librería se carga de manera automática
// Para verificar donde se autocarga, visitar el directorio: application/config/autoload.php

class Backend_lib {

    // Almacenará la instancia del objeto CodeIgniter
    private $CI;

    public function __construct()
    {
        // Instancia el objeto CodeIgniter
        $this->CI =& get_instance();
    }

    /**
     * Gestionar los permisos del usuario por módulo
     *
     * @return void
     */
    public function control()
    {
        if(!$this->CI->session->userdata('login')) // Verifica que se haya iniciado sesión
        {
            // Redirecciona al usuario al formulario de loggin
            redirect(base_url());
        }  
        
        // Almacena la dirección raíz + 1er segmento, ejemplo: http://localhost/ce_gestion/administrador/
        $url = $this->CI->uri->segment(1); 

        if($this->CI->uri->segment(2)) // Verifica si existe un 2do segmento
        {
            $url = $this->CI->uri->segment(1).'/'.$this->CI->uri->segment(2);
        }

        // Almacena en esta variable el registro correspondiente al menú consultado
        // El método get_id() realiza una consulta a la tabla "menu" de la Base de Datos
        $informacion_menu = $this->CI->Backend_model->get_id($url);

        // Los datos de sesión se consiguen en el directorio: applications/controllers/Auth.php
        $permisos = $this->CI->Backend_model->get_permisos_usuario($informacion_menu->id_menu, $this->CI->session->userdata('rol'));

        // Verifica los permisos de lectura del usuario
        if($permisos->read == 0)
        {
            redirect(base_url().'dashboard'); 
        }
        else
        {
            return $permisos;
        }
    }
    
}