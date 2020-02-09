$(document).ready(function() {

    $('#lista-permiso').DataTable({
        "order": [[ 1, "desc" ]]
    });

    $("#formulario_permiso").bootstrapValidator({
        fields: {
            rol: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una opción'
                    }
                }
            },
            menu: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una opción'
                    }
                }
            },
         
        }
    });

});
