$(document).ready(function() {

    
    $('#lista-participante').DataTable({
        "order": [[ 1, "desc" ]]
    });


    $(document).on("click",".btn-view-participante",function() {

        let id_participante = $(this).val(); // ID de la persona
        
        $.ajax({
            url: base_url + "gestion/participante/view",
            type:"POST",
            dataType:"html",
            data:{
                id_participante: id_participante
            },
            success:function(data) {
                $("#modal-default .modal-body").html(data);
            }
        });
    });

});