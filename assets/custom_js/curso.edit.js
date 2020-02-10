$(document).ready(function() {

    $('#editar_curso').bootstrapValidator({
        fields: {
            nombre_curso: {
                validators: {
                    stringLength: {
                        min: 5,
                        max: 45,
                        message:'Ingrese entre 5 y 85 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            costo_curso: {
                validators: {
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            periodo_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            locacion_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            turno_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            facilitador_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            cupos_curso: {
                validators: {
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            descripcion_curso: {
                validators: {
                    stringLength: {
                        max: 256,
                        message:'Ingrese máximo 256 caractéres'
                    },
                }
            },

         
        }
    });


});
