$(document).ready(function() {

    $('#frm_inicio').bootstrapValidator({
        fields: {
            username: {
                validators: {
                        stringLength: {
                        min: 5,
                        max: 20,
                        message:'Ingrese entre 6 y 15 caractéres'
                    },
                        notEmpty: {
                        message: 'Debe ingresar un usuario'
                    }
                }
            },
             password: {
                validators: {
                     stringLength: {
                       min: 5,
                       max: 20,
                       message:'Ingrese entre 5 y 20 caracteres'
                    },
                    notEmpty: {
                        message: 'Debe ingresar una contraseña'
                    }
                }
            }
        }
    });

});