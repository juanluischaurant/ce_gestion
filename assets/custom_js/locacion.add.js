$(document).ready(function() {

    $('#agregar_locacion').bootstrapValidator({
        fields: {
            nombre_locacion: {
                validators: {
                    stringLength: {
                        min: 5,
                        max: 85,
                        message:'Ingrese entre 5 y 85 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            direccion_locacion: {
                validators: {
                    stringLength: {
                        max: 250,
                        message:'Ingrese máximo 250 caractéres'
                    },
                }
            },
         
        }
    });

});