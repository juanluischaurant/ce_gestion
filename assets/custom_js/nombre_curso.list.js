$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-nombre-curso').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

});
