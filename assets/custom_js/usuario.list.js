$(document).ready(function() {

    /**
     * Parámetros para configurar el objeto DataTable.
     */
    $('#lista-usuario').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

});
