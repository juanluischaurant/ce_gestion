$(document).ready(function() {
 
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
