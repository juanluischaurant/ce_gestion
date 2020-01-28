$(document).ready(function() {
    
    /**
     * Detecta cuando el tipo de pago es seleccionado, y responde en base a la opción
     * seleccionada.
     */
    $('#tipo-de-pago').on('change', function() {

        let idTipoOperacion = $(this).val();

        // Almacena el id único del tipo de pago en un elemento HTML oculto
        $('#id-tipo-de-pago').val(idTipoOperacion);

        limpiarCampos();
        configurarTipoOperacion(idTipoOperacion);    
    });

    /**
     * Activa o desactiva los campos del formulario de pago en base
     * al valor seleccionado por el usuario.
     * 
     * @param {integer} tipoOperacion 
     */
    function configurarTipoOperacion(tipoOperacion) {

        if(tipoOperacion == 1) {
            // Transferencia
            $('#banco-de-operacion')
                .prop('disabled', false);

            $('#monto-de-operacion')
                .prop('disabled', false);

            $('#numero-referencia')
                .prop('disabled', false);
        }

        if(tipoOperacion == 2) {
            // Efectivo
            $('#banco-de-operacion')
                .prop('disabled', true);

            $('#monto-de-operacion')
                .prop('disabled', false);

            $('#numero-referencia')
                .prop('disabled', true);
        }
        
        if(tipoOperacion == 3) {
            // Exonerado
            $('#banco-de-operacion')
                .prop('disabled', true);

            $('#monto-de-operacion')
                .prop('disabled', true);

            $('#numero-referencia')
                .prop('disabled', true);
        }   
    }

    /**
     * Vacía el atributo value de los campos seleccionados.
     */
    function limpiarCampos() {

        $('#banco-de-operacion')
            .val('');

        $('#id-banco-de-operacion')
            .val('');

        $('#monto-de-operacion')
            .val('');

        $('#numero-referencia')
            .val('');
    }
  
    $(document).on("click",".btn-view-pago",function() {
        
        let id_pago = $(this).val(); // ID del elemento a consultar
        $.ajax({
            url: base_url + "movimientos/pago/view",
            type:"POST",
            dataType:"html",
            data:{
                id_pago: id_pago
            },
            success:function(data) {
                $("#modal-default .modal-body").html(data);
            }
        });
    });

    $('#cedula-titular').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url+'movimientos/pago/get_titulares_json',
                type: 'POST',
                dataType: 'json',
                data: {
                    query: request.term
                },
                success: function(data) {
                    response(data)
                }
            });
        }, minLength: 1,
        select: function(event, ui) {

            // Imprime el nombre del titular seleccionado
            $('#nombre_titular').val(ui.item.nombre_titular);

            // Imprime la cédula del titular seleccionado
            $('#cedula-titular').val(ui.item.cedula_persona);
        }
    });

    $('#banco-de-operacion').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url+'movimientos/pago/get_bancos_json',
                type: 'POST',
                dataType: 'json',
                data: {
                    query: request.term
                },
                success: function(data) {
                    response(data)
                }
            });
        }, minLength: 3,
        select: function(event, ui) {
            $('#id-banco-de-operacion').val(ui.item.id);
        }
    });

});
