$(document).ready(function() {

    
    $('#lista-participante').DataTable({
        "order": [[ 1, "desc" ]],
        language: lenguaje_para_datatables
    });


    $(document).on("click",".btn-view-participante",function() {

        let cedula_participante = $(this).val(); // ID de la persona
        
        $.ajax({
            url: base_url + "gestion/participante/view",
            type:"POST",
            dataType:"html",
            data:{
                cedula_participante: cedula_participante
            },
            success:function(data) {
                $("#modal-default .modal-body").html(data);
            }
        });
    });

});