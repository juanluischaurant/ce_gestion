$(document).ready(function() {

    $('#lista-accion').DataTable({
        "order": [[ 1, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Acciones",
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Acciones",
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            }
        ],
        language: lenguaje_para_datatables
    });
});
