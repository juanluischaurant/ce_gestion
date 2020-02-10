
$(document).ready(function() {

    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]]
    });

    $(document).on('click', '.btn-check-facilitador', function() {

        $('#detalles_facilitador').removeClass('hidden');
        let facilitador = $(this).val();
        let informacionFacilitador = facilitador.split('*');
        let msg = 'No Disponible';

        let cedula = informacionFacilitador[0] ? informacionFacilitador[0] : msg,
        nombres = informacionFacilitador[1] ? informacionFacilitador[1] : msg,
        apellidos = informacionFacilitador[2] ? informacionFacilitador[2] : msg,
        telefono = informacionFacilitador[3] ? informacionFacilitador[3] : msg,
        fechaNacimiento = informacionFacilitador[4] ? informacionFacilitador[4] : msg,
        generoPersona = informacionFacilitador[5] ? informacionFacilitador[5] : msg,
        direccion = informacionFacilitador[6] ? informacionFacilitador[6] : msg,
        correoElectronico = informacionFacilitador[7] ? informacionFacilitador[7] : msg;

       $('#primer_nombre').html(nombres);
       $('#primer_apellido').html(apellidos);
       $('#cedula_vista').html(cedula);
       $('#cedula_persona').val(cedula);
       $('#fecha_nacimiento').html(fechaNacimiento);
       $('#telefono').html(telefono);
       $('#correo_electronico').html(correoElectronico);
       $('#direccion').html(direccion);

        // Al seleccionar un facilitador de la lista, activa el botón "Guardar"
        $('#guardar-facilitador').removeAttr('disabled');

        // Oculta ventana modal
        $('#modal-default').modal('hide');
    });

    // $(document).on('click', '.btn-check-facilitador', function() {
        
    //     let facilitador = $(this).val();
    //     let informacionFacilitador = facilitador.split('*');

    //     let cedulaPersona = informacionFacilitador[0],
    //     nombresPersona = informacionFacilitador[1],
    //     apellidosPersona = informacionFacilitador[2],
    //     telefonoPersona = informacionFacilitador[3],
    //     fechaNacimientoPersona = informacionFacilitador[4],
    //     generoPersona = informacionFacilitador[5];
    //     direccionPersona = informacionFacilitador[6];

    //     $('#nacimiento_facilitador').val(fechaNacimientoPersona);
    //     $('#cedula_persona').val(cedulaPersona);
    //     $('#genero_facilitador').val(generoPersona);
    //     $('#nombre_facilitador').val(nombresPersona);
    //     $('#primer_apellido').val(apellidosPersona);
    //     $('#telefono_facilitador').val(telefonoPersona);
    //     $('#direccion_facilitador').val(direccionPersona);

    //     // Al seleccionar un facilitador de la lista, activa el botón "Guardar"
    //     $('#guardar-facilitador').removeAttr('disabled');

    //     // Oculta ventana modal
    //     $('#modal-default').modal('hide');
    // });

});
       