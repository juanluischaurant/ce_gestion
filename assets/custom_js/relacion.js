
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
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
});