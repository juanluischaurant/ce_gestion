$(document).ready(function() {

    /**
     * Botón que se encuentra ubicado en la vista de Éxito, mostrada luego
     * de registrar a una persona exitosamente en la base de datos.
     */
    $('#add-roles-persona').on('click', function(event) {

        let cedula_persona = $('input[name="cedula-persona"]').val();
        let participante = $('input[name="rol-participante"]');
        let nivelAcademicoParticipante = $('select[name="nivel-academico-participante"]');
        let titular = $('input[name="rol-titular"]');

        if(titular.is(":checked")) {
            titular = 'titular';
        } else if(titular.is(":not(:checked)")) {
            titular = '';
        }

        if(participante.is(":checked")) {
            participante = 'participante';
            nivelAcademicoParticipante = nivelAcademicoParticipante.val();
        } else if(participante.is(":not(:checked)"))
        {
            participante = '';
            nivelAcademicoParticipante = '';
        }
    
        $.ajax({
            url: base_url + "gestion/persona/add_rol",
            type: 'POST',
            data: {
                cedula_persona: cedula_persona,
                participante: participante,
                nivel_academico_participante: nivelAcademicoParticipante,
                titular: titular
            },
            beforeSend: function() {
                $('.lds-ellipsis').show();
            },
            complete: function() {
                $('.lds-ellipsis').hide();
            },
            success: function(response) {

                // Al realizar el guardado:
                $('#caja-principal').hide();
                $('#caja-secundaria').toggleClass('hidden');

                if(participante !== '') {
                    $('#redirecciona-inscribir').toggleClass('hidden');
                }
                if(titular !== '') {
                    $('#redirecciona-pago').toggleClass('hidden');
                }
                if(titular == '' && participante == '') {
                    $('#redirecciona-inicio').toggleClass('hidden');
                }
            }
        });

    });

    /**
     * Al presionar el checkbox indicado, se debe ocultar o mostrar
     * el selector de nivel académico que por defecto se encuentra 
     * inactivo. 
     */
    $('input[name="rol-participante"]').on('click', function() {
        $('select[name="nivel-academico-participante"]').parent().toggleClass('hidden')
    });

    $('#redirige-hasta-dashboard').on('click', function() {

        window.location.href = base_url;
    });
});