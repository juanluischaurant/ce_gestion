$(document).ready(function() {

    $('#lista-permiso').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
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
