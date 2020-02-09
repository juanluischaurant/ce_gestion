$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-titular').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

    /**
     * Carga la vista de detalles de titular
     */
    $(document).on('click', '.btn-view-titular', function() {

        let cedula_persona = $(this).val();
        $.ajax({
            url: base_url + 'gestion/titular/view',
            type: 'POST',
            dataType: 'html',
            data: {
                cedula_persona: cedula_persona
            },
            success: function(data) {
                $('#modal-default .modal-body').html(data);
            }
        });
    });

});
