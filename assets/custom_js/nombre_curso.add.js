$(document).ready(function() {
   
    $('#formulario_nombre_curso').bootstrapValidator({
        descripcion_curso: {
            validators: {
                stringLength: {
                    min: 4,
                    max: 45,
                    message:'Ingrese entre 4 y 45 caractéres'
                },
                notEmpty: {
                    message: 'Campo obligatorio'
                },
            }
        },
        cantidad_horas: {
            validators: {
                stringLength: {
                    max: 4,
                    message:'Ingrese entre 4 y 45 caractéres'
                },
                notEmpty: {
                    message: 'Campo obligatorio'
                },
                numeric: {
                    message: 'Ingrese solo valores numéricos'
                }
            }
        },
        
    });

});
