$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]]
    });

    $(document).on('click', '.btn-check-participante', function() {

        $('#detalles_participante').removeClass('hidden');
        let participante = $(this).val();
        let informacionParticipante = participante.split('*');
        let msg = 'No Disponible';

        let cedula = informacionParticipante[0] ? informacionParticipante[0] : msg,
        nombres = informacionParticipante[1] ? informacionParticipante[1] : msg,
        apellidos = informacionParticipante[2] ? informacionParticipante[2] : msg,
        telefono = informacionParticipante[3] ? informacionParticipante[3] : msg,
        fechaNacimiento = informacionParticipante[4] ? informacionParticipante[4] : msg,
        generoPersona = informacionParticipante[5] ? informacionParticipante[5] : msg,
        direccion = informacionParticipante[6] ? informacionParticipante[6] : msg,
        correoElectronico = informacionParticipante[7] ? informacionParticipante[7] : msg;

       $('#primer_nombre').html(nombres);
       $('#primer_apellido').html(apellidos);
       $('#cedula_vista').html(cedula);
       $('#cedula_persona').val(cedula);
       $('#fecha_nacimiento').html(fechaNacimiento);
       $('#telefono').html(telefono);
       $('#correo_electronico').html(correoElectronico);
       $('#direccion').html(direccion);

        // Al seleccionar un participante de la lista, activa el botón "Guardar"
        $('#guardar-participante').removeAttr('disabled');

        // Oculta ventana modal
        $('#modal-default').modal('hide');
    });

    $('#agregar_participante').bootstrapValidator({
        fields: {
            cedula_persona: {
                validators: {
                    stringLength: {
                        min: 7,
                        max: 11,
                        message:'Ingrese entre 6 y 15 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    }
                }
            },
            nivel_academico: {
                message: 'Campo obligatorio'
            },
        }
    });
    
});
