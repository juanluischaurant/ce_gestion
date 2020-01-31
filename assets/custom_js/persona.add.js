$(document).ready(function() {
    
    // Activa el pluggin jQuery InputMask
    $('[data-mask]').inputmask();

    $('#registrar_pago').bootstrapValidator({
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
            nacimiento_persona: {
                validators: {
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'Fecha no válida',
                    },
                  
                }
            },
            nombre_persona: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 25,
                        message:'Ingrese entre 2 y 25 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            apellido_persona: {
                validators: {
                    stringLength: {
                        min: 2,
                        max: 25,
                        message:'Ingrese entre 2 y 25 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            genero_persona: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una opción'
                    }
                }
            },
         
        }
    });

});