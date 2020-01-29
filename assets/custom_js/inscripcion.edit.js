$(document).ready(function () {  

    /**
     * Método utilizado al momento de remover un pago asignado a determinada
     * inscripción en el módulo de edición de inscripción.
     * 
     * To capture the click event on dinamically generated HTML elements, 
     * we are using the "DELEGATED EVENTS" approach which can be seen in
     * this method ".on('click', 'children', function(){ })
     */
    $('#pagos-asociados tbody').on('click', 'button.btn-remove-inscripcion-pago', function() {
        
        let tr_element = $(this).closest('tr').remove().clone(), // Selected row
        copy_table = $('#pagos-desasociados tbody'); // Table where to paste the selected row
        
        tr_element
            .find('span.fa-lock')
            .addClass('fa-unlock')
            .removeClass('fa-lock');
        
        copy_table.append(tr_element);

        restar();

        // Cuenta el numero de elementos <tr> dentro de la tabla
    //     let table_rows_count = $('#tabla-pagos tr').length - 1,
    //     // Cuenta el numero de elementos <tr> dentro de la tabla con la clase dada
    //    count_pagos_registrados = $('#tabla-pagos tbody tr.pago-registrado').length;

        // if(count_pagos_registrados > 1 && table_rows_count > 1) {

        //     let tr_element = $(this).closest('tr'),
        //     ruta = $(this).attr('href');

        //     $.ajax({
        //         url: ruta,
        //         type: 'POST',
        //         success: function(response) {

        //             tr_element.remove();
        //             sumar();
        //         }
        //     });
        // } else {

        //     alert('¡Debes tener al menos un pago registrado para eliminar este!');
        // }
    });

    /**
     * Método utilizado al momento de remover un pago asignado a determinada
     * inscripción en el módulo de edición de inscripción.
     * 
     * To capture the click event on dinamically generated HTML elements, 
     * we are using the "DELEGATED EVENTS" approach which can be seen in
     * this method ".on('click', 'children', function(){ })
     */
    $('#pagos-desasociados tbody').on('click', 'button.btn-remove-inscripcion-pago', function() {
        
        let tr_element = $(this).closest('tr').remove().clone(), // Selected row
        copy_table = $('#pagos-asociados tbody'); // Table where to paste the selected row
        
        tr_element
            .find('span.fa-unlock')
            .addClass('fa-lock')
            .removeClass('fa-unlock');
        
        copy_table.append(tr_element);

        restar();
    });

});

/**
 * Función utilizada utilizada para actualizar montos en la interfaz de usuario
 */
function restar() {

    let monto_en_operacion = 0;

    $('#pagos-desasociados tbody tr').each(function() {

        monto_en_operacion += Number($(this).find('td:eq(1)').text());
    });

    $('input[name=monto-en-operacion]').val(monto_en_operacion.toFixed(2));
}

      // Recordar la pestaña seleccionada en la vista de Edición de Inscripción
      $("a[data-toggle='tab']").on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });

    let activeTab = localStorage.getItem('activeTab');

    if(activeTab) {
        $("#edit-inscripcion-tabs a[href='"+activeTab+"']").tab("show");
    }

    $('#tab-cambiar-curso').on('click', function() {

        location.reload();
    });
    
    $('#tab-asociar-pago').on('click', function(e) {

        location.reload();
    });

    $('#tab-desasociar-pago').on('click', function() {

        location.reload();
    });