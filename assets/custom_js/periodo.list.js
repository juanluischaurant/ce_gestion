$(document).ready(function() {

    $('#lista-periodo').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });
});
