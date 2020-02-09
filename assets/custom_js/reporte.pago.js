$(document).ready(function() {

    const tituloTabla = "Relación de Curso";
    const columnas = [ 0, 1, 2, 3, 4, 5];

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-pago').DataTable({
        "order": [[ 1, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: tituloTabla,
                exportOptions: {
                    columns: columnas
                }
            },
            {
                extend: 'pdfHtml5',
                title: tituloTabla,
                exportOptions: {
                    columns: columnas
                }

            }
        ],
        language: lenguaje_para_datatables
    });

});
