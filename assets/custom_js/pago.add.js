$(document).ready(function() {
    
    /**
     * Detecta cuando el tipo de pago es seleccionado, y responde en base a la opción
     * seleccionada.
     */
    $('#tipo_de_pago').on('change', function() {

        let idTipoOperacion = $(this).val();

        // Almacena el id único del tipo de pago en un elemento HTML oculto
        $('#id_tipo_de_pago').val(idTipoOperacion);

        limpiarCampos();
        configurarTipoOperacion(idTipoOperacion);    
    });

    /**
     * Activa o desactiva los campos del formulario de pago en base
     * al valor (tipo de operación) seleccionado por el usuario.
     * 
     * @param {integer} tipoOperacion 
     */
    function configurarTipoOperacion(tipoOperacion) {

        if(tipoOperacion == 1) {
            // Transferencia
            $('#banco_de_operacion')
                .prop('disabled', false);

            $('#monto_de_operacion')
                .prop('disabled', false);

            $('#numero_referencia')
                .prop('disabled', false);

            $('#btn-guardar-inscripcion-pago')
                .prop('disabled', true);
        }

        if(tipoOperacion == 2) {
            // Efectivo
            $('#banco_de_operacion')
                .prop('disabled', true);
                
            $('#id_banco_de_operacion')
                .val(4);

            $('#monto_de_operacion')
                .prop('disabled', false);

            $('#numero_referencia')
                .prop('disabled', true);

            $('#btn-guardar-inscripcion-pago')
                .prop('disabled', false);
        }
        
        if(tipoOperacion == 3) {
            // Exonerado
            $('#banco_de_operacion')
                .prop('disabled', true);
            
            $('#id_banco_de_operacion')
                .val(4);

            $('#monto_de_operacion')
                .prop('disabled', true);

            $('#numero_referencia')
                .prop('disabled', true);
            
            $('#btn-guardar-inscripcion-pago')
                .prop('disabled', false);
        }   
    }

    /**
     * Vacía el atributo value de los campos seleccionados.
     */
    function limpiarCampos() {

        $('#banco_de_operacion')
            .val('');

        $('#id_banco_de_operacion')
            .val('');

        $('#monto_de_operacion')
            .val('');

        $('#numero_referencia')
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

    $('#cedula_titular').autocomplete({
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
            $('#cedula_titular').val(ui.item.cedula_persona);
        }
    });

    $('#banco_de_operacion').autocomplete({
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
            $('#id_banco_de_operacion').val(ui.item.id);
        }
    });

    $('#registrar_pago').bootstrapValidator({
        messasge: 'Campo no válido',
        excluded: [':disabled'],
        fields: {
            tipo_de_pago: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una opción'
                    },
                }
            },
            cedula_titular: {
                validators: {
                    stringLength: {
                        max: 8,
                        message:'Ingrese máximo 8 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    }
                }
            },
            monto_de_operacion: {
                validators: {
                    stringLength: {
                        max: 11,
                        message:'Ingrese máximo 11 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    }
                }
            },
            banco_de_operacion: {
                validators: {
                    stringLength: {
                        max: 55,
                        message:'Ingrese máximo 55 caractéres'
                    },
                }
            },
            numero_referencia: {
                validators: {
                    stringLength: {
                        min: 4,
                        max: 45,
                        message:'Ingrese entre 4 y 45 caractéres'
                    },
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    }
                }
            },
         
        }
    });

});
