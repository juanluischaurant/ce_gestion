$('#export-acciones').DataTable({
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

$('#export-inscripciones').DataTable( {
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

$('#export-especialidades').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            title: "Listado de especialidades",
            exportOptions: {
                columns: [ 0, 1, 2 ]
            }
        },
        {
            extend: 'pdfHtml5',
            title: "Listado de Ventas",
            exportOptions: {
                columns: [ 0, 1, 2]
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

$('#export-inscripciones').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            title: "Listado de Inscripciones",
            exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            }
        },
        {
            extend: 'pdfHtml5',
            title: "Listado de Inscripciones",
            exportOptions: {
                columns: [ 0, 1, 2, 3]
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
