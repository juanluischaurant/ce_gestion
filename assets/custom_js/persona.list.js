$(document).ready(function() {

    $('#lista-persona').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });

    $(document).on("click",".btn-view-persona",function() {
        let cedulaPersona = $(this).val(); // ID de la persona
        $.ajax({
            url: base_url + "gestion/persona/view",
            type:"POST",
            dataType:"html",
            data:{
                cedula_persona: cedulaPersona
            },
            success:function(data) {
                $("#modal-default .modal-body").html(data);
            }
        });
    });

});
