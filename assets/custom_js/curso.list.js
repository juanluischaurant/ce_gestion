$(document).ready(function() {

    $('#lista-curso').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

    /**
     * Carga la vista de detalles de curso
     */
    $(document).on('click', '.btn-view-curso', function() {

        let id_curso = $(this).val();
        $.ajax({
            url: base_url + 'gestion/curso/view',
            type: 'POST',
            dataType: 'html',
            data: {
                id_curso: id_curso
            },
            success: function(data) {
                $('#modal-default .modal-body').html(data);
            }
        });
    });

});
