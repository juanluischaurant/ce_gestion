
$(document).ready(function() {

    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]]
    });

    $(document).on('click', '.btn-check-facilitador', function() {
        
        let facilitador = $(this).val();
        let informacionFacilitador = facilitador.split('*');

        let cedulaPersona = informacionFacilitador[0],
        nombresPersona = informacionFacilitador[1],
        apellidosPersona = informacionFacilitador[2],
        telefonoPersona = informacionFacilitador[3],
        fechaNacimientoPersona = informacionFacilitador[4],
        generoPersona = informacionFacilitador[5];
        direccionPersona = informacionFacilitador[6];

        $('#nacimiento_facilitador').val(fechaNacimientoPersona);
        $('#cedula_persona').val(cedulaPersona);
        $('#genero_facilitador').val(generoPersona);
        $('#nombre_facilitador').val(nombresPersona);
        $('#primer_apellido').val(apellidosPersona);
        $('#telefono_facilitador').val(telefonoPersona);
        $('#direccion_facilitador').val(direccionPersona);

        // Al seleccionar un facilitador de la lista, activa el botón "Guardar"
        $('#guardar-facilitador').removeAttr('disabled');

        // Oculta ventana modal
        $('#modal-default').modal('hide');
    });

});
       