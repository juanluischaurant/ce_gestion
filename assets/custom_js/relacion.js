
$(document).ready(function() {

    const tituloTabla = "Relación de Curso";
    const columnas = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#tabla-relacion').DataTable({
        "order": [[ 0, "asc" ]],
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