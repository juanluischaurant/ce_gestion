$(document).ready(function() {

    $('#lista-inscripcion').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

    $(document).on('click', '.btn-view-inscripcion', function() {
        dataInscripcion = $(this).val();
        datosInscripcion = dataInscripcion.split('*');

        id_curso_inscripcion = datosInscripcion[0];
        id_inscripcion = datosInscripcion[1];

        $.ajax({
            url: base_url + 'movimientos/inscripcion/view',
            type: 'POST',
            dataType: 'html',
            data: {
                id_inscripcion: id_inscripcion
            },
            success: function(data) {

                $('#modal-default .modal-body').html(data);
            }
        });
    });

});
