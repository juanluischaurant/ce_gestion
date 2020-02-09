$(document).ready(function() {

    $('#lista-facilitador').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

    $('.btn-view-facilitador').on('click', function() {
        // Al clickear el botón de vista de facilitador, expande modal
        let facilitador = $(this).val();
        let infoFacilitador = facilitador.split('*');

        html = '<p><strong>Nombres: </strong>'+infoFacilitador[1]+'</p>'
        html += '<p><strong>Apellidos: </strong>'+infoFacilitador[2]+'</p>'
        html += '<p><strong>Teléfono: </strong>'+infoFacilitador[3]+'</p>'
        html += '<p><strong>Cédula: </strong>'+infoFacilitador[4]+'</p>';

        $('#modal-default .modal-body').html(html);
    });

});
