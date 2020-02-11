$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-usuario').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

    $(document).on('click', '.btn-view-usuario', function() {

        let id_usuario = $(this).val();
        $.ajax({
            url: base_url + 'administrador/usuario/view',
            type: 'POST',
            dataType: 'html',
            data: {
                id_usuario: id_usuario
            },
            success: function(data) {
                $('#modal-default .modal-body').html(data);
            }
        });
    });

});
