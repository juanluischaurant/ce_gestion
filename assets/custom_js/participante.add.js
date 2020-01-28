$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]]
    });

    
    $(document).on('click', '.btn-check-participante', function() {
        let participante = $(this).val();
        let informacionParticipante = participante.split('*');

        let cedulaPersona = informacionParticipante[0],
        nombresPersona = informacionParticipante[1],
        apellidosPersona = informacionParticipante[2],
        telefonoPersona = informacionParticipante[3],
        fechaNacimientoPersona = informacionParticipante[4],
        generoPersona = informacionParticipante[5];
        direccionPersona = informacionParticipante[6];

        $('#cedula_persona').val(cedulaPersona);
        $('#nombres_participante').val(nombresPersona);
        $('#apellidos_participante').val(apellidosPersona);
        $('#nacimiento_participante').val(fechaNacimientoPersona);
        $('#genero_participante').val(generoPersona);
        $('#telefono_participante').val(telefonoPersona);
        $('#direccion_participante').val(direccionPersona);

        // Al seleccionar un participante de la lista, activa el botón "Guardar"
        $('#guardar-participante').removeAttr('disabled');

        // Oculta ventana modal
        $('#modal-default').modal('hide');
    });

});
