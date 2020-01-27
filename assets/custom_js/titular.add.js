
$(document).ready(function() {

    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]]
    });

    $(document).on('click', '.btn-check-titular', function() {
        let titular = $(this).val();
        let informacionTitular = titular.split('*');

        
        let cedulaPersona = informacionTitular[0],
        nombresPersona = informacionTitular[1],
        apellidosPersona = informacionTitular[2],
        telefonoPersona = informacionTitular[3],
        fechaNacimientoPersona = informacionTitular[4],
        generoPersona = informacionTitular[5];
        direccionPersona = informacionTitular[6];

        $('#nacimiento_titular').val(fechaNacimientoPersona);
        $('#cedula_persona').val(cedulaPersona);
        $('#genero-titular').val(generoPersona);
        $('#nombre_titular').val(nombresPersona);
        $('#apellido_titular').val(apellidosPersona);
        $('#telefono-titular').val(telefonoPersona);
        $('#direccion-titular').val(direccionPersona);


        // Al seleccionar un titular de la lista, activa el botón "Guardar"
        $('#guardar-titular').removeAttr('disabled');

        // Oculta ventana modal
        $('#modal-default').modal('hide');
    });

});
       