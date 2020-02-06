
$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]]
    });

    $(document).on('click', '.btn-check-titular', function() {

        $('#detalles_titular').removeClass('hidden');
        let titular = $(this).val();
        let informacionTitular = titular.split('*');
        let msg = 'No Disponible';

        let cedula = informacionTitular[0] ? informacionTitular[0] : msg,
        nombres = informacionTitular[1] ? informacionTitular[1] : msg,
        apellidos = informacionTitular[2] ? informacionTitular[2] : msg,
        telefono = informacionTitular[3] ? informacionTitular[3] : msg,
        fechaNacimiento = informacionTitular[4] ? informacionTitular[4] : msg,
        generoPersona = informacionTitular[5] ? informacionTitular[5] : msg,
        direccion = informacionTitular[6] ? informacionTitular[6] : msg,
        correoElectronico = informacionTitular[7] ? informacionTitular[7] : msg;

       $('#primer_nombre').html(nombres);
       $('#primer_apellido').html(apellidos);
       $('#cedula_vista').html(cedula);
       $('#cedula_persona').val(cedula);
       $('#fecha_nacimiento').html(fechaNacimiento);
       $('#telefono').html(telefono);
       $('#correo_electronico').html(correoElectronico);
       $('#direccion').html(direccion);

        // Al seleccionar un titular de la lista, activa el botón "Guardar"
        $('#guardar-titular').removeAttr('disabled');

        // Oculta ventana modal
        $('#modal-default').modal('hide');
    });

});
       