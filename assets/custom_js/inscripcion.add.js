$(document).ready(function() {

    $('#numero-de-operacion').autocomplete({

        source: function(request, response) {
            $.ajax({
                url: base_url+'movimientos/pago/get_pagos_json',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    query: request.term
                },
                success: function(data) {
                    response(data)
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {

            // Verifica si el ítem que se intenta seleccionar ya ha sido seleccionado
            if($('#'+ui.item.id_pago).length !== 0) {

                $('#numero-de-operacion').val('');
                alert('¡Ya seleccionaste este ítem!');
                return;
            }

            data = ui.item.id+'*'+ui.item.numero_referencia_bancaria+'*'+ui.item.monto_operacion+'*'+ui.item.nombre_cliente+'*'+ui.item.cedula+'*'+ui.item.id_pago+'*'+ui.item.id_tipo_de_operacion+'*'+ui.item.estatus_pago;
            $('#btn-agregar-pago').val(data);
        }
    });

    $('#btn-agregar-pago').on('click', function() {

        data = $(this).val();

        if(data != '')
        {
            let datosPago = data.split('*');

            let id_pago = datosPago[0],
            numero_referencia_bancaria = datosPago[1],
            monto_operacion = datosPago[2],
            nombre_cliente = datosPago[3],
            cedula_cliente = datosPago[4],
            id_tipo_de_operacion = datosPago[5],
            estatus_pago = datosPago[6]; 

            if(estatus_pago == 1 || estatus_pago == 3)
            {
                html = '<tr id="'+ id_pago + '">';
                html += '<td><input type="hidden" name="id-pago[]" value="'+id_pago+'">'+numero_referencia_bancaria+'</td>';
                html += '<td><input type="hidden" name="monto-operacion[]" value="'+monto_operacion+'">'+monto_operacion+'</td>';
                html += '<td><input type="hidden" name="cedula-cliente[]" value="'+cedula_cliente+'">'+cedula_cliente+'<input type="hidden" name="id_tipo_de_operacion[]" value="'+datosPago[7]+'">'+'</td>';

                html += '<td><button type="button" class="btn btn-danger btn-remove-pago"><span class="fa fa-remove"></span></button></td>'
                html += '</tr>';

                $('#tabla-pagos tbody').append(html);

                sumar();

                $('#numero-de-operacion').val('');

            }
            else if(estatus_pago == 0)
            {

                alert('Pago no disponible');
                $('#numero-de-operacion').val('');
            } else if(estatus_pago == 2)
            {
                alert('Pago ya ha sido utilizado');
                $('#numero-de-operacion').val('');
            }
            
        }
        else
        {
            alert('seleccione un pago');
        }
    });


    $(document).on('click', '.btn-check-participante-inscripcion', function() 
    {
        let participante = $(this).val(); // Almacena el valor almacenado en el atributo value del botón clickeado
        let infoParticipante = participante.split('*'); // divide la información en un array

        // Asigna la información relevante en variables
        let cedulaParticipante = infoParticipante[0],
        nombreCompletoParticipante = infoParticipante[1] + ' ' +  infoParticipante[2];

        // Imprime la información relevante
        $('#cedula_persona').val(cedulaParticipante);
        $('#nombre_participante').val(nombreCompletoParticipante);

        // Oculta ventana modal
        $('#modal-default').modal('hide');

        // Activa campo para agregar Curso
        $('#producto').removeAttr('disabled');
    });

    // Función encargada de almacenar los datos de pago de manera asincrona
    $(document).on('click', '#btn-guardar-inscripcion-pago', function() {

        let exito = false; // Do you need it?

        let id_banco_operacion = $('#id-banco-de-operacion').val(),
        id_tipo_de_operacion = $('#id-tipo-de-pago').val(),
        id_cliente = $('#cedula-titular').val(),
        numero_referencia_bancaria = $('#numero-referencia').val(),
        monto_de_operacion = $('#monto-de-operacion').val(),
        fecha_de_operacion = $('#fecha-operacion').val();

        $.ajax({
            url: base_url+'movimientos/pago/store_ajax',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id_banco_operacion: id_banco_operacion,
                id_tipo_de_operacion: id_tipo_de_operacion,
                id_cliente: id_cliente,
                numero_referencia_bancaria: numero_referencia_bancaria,
                monto_de_operacion: monto_de_operacion,
                fecha_de_operacion: fecha_de_operacion
            },
            success: function(data) {
                // Oculta ventana modal
                $('#modal-info').modal('hide');

                $('option:selected').prop('selected', false);
                $('#serial-de-pago').val(null);

                exito = true; 
            }
        }); 

        return exito;           
    });

    
    $('#producto').autocomplete({

        source: function(request, response) {
            $.ajax({
                url: base_url+'movimientos/inscripcion/get_cursos_json',
                type: 'POST',
                dataType: 'json',
                data: {
                    query: request.term
                },
                success: function(data) {
                    response(data)
                }
            });
        }, minLength: 1,
        select: function(event, ui) {

            /**
             * Para calcular el total de elementos <tr> en la tabla
             * es necesario agregar -1 a la longitud total debido
             * a que el encabezado ya tiene un elemento <tr> que también se cuenta
             */
            let table_rows_count = $('#tabla-cursos tr').length - 1;

            if(table_rows_count >= 1) {

                alert('¡No puedes seleccionar más de 1 curso!');
                return;
            }
            // Almacena en una variable los datos recogidos con la consulta SQL realizada previamente
            let data = ui.item.id+'*'+ui.item.label+'*'+ui.item.cupos+'*'+ui.item.precio+'*'+ui.item.inscripciones_asociadas;
            
            // Almacena la variable data dentro del atributo value del elemento selector
            $('#btn-agregar-curso').val(data);

            // Almacena el ID del especialidad en atributo personalizado de HTML
            $('#btn-agregar-curso').attr('data-id-curso', ui.item.id);

        }
    });

    /**
     * Al presionar este botón, imprimir en la vista los datos consultados
     */
    $('#btn-agregar-curso').on('click', function() {

        let data = $(this).val(); // Almacena los datos del atributo "value" del boton clickeado

        // Comprobar si la variable "data" está vacia o no
        if(data != '') {
            let datosCurso = data.split('*'),
            cupos_totales = datosCurso[2], // Almacena la cantidad de cupos totales por especialidad
            cupos_ocupados = datosCurso[4]; // Almacena la cantidad de cupos ocupados por especialidad

            // Si la cantidad de cupos totales es menor a la de cupos ocupados
            if(parseInt(cupos_totales) <= parseInt(cupos_ocupados)) {

                // Evita que el especialidad sea agregado
                alert('El especialidad está lleno, por favor seleccione otro');

                // Vacía el elemento #producto
                $('#producto').val('');
            } else {

                // De lo contrario (cupos ocupados < cupos totales)
                $.ajax({

                    type: 'POST',
                    url: base_url+'movimientos/inscripcion/get_participantes_json/',
                    dataType: 'JSON',
                    data: {

                        // "data-id-curso" es un atributo personalizado de HTML que almacena
                        // el ID de el curso seleccionada
                        id: $(this).attr('data-id-curso')
                    },
                    success: function( data, textStatus, jQxhr ) {

                        let idParticipante = $('#cedula_participante').val(), // Almacena el ID del participante a inscribir
                        existe = false; // Al encontrar al participante cambia a TRUE

                        // Itera sobre cada OBJETO obtenido durante la llamada AJAX
                        for(let i = 0; i < data.length; i++)
                        {

                            let cedulaParticipanteInscrito = data[i]['cedula_participante']; // Almacena ID del participante Inscrito en el especialidad dado
                            
                            if(cedulaParticipanteInscrito == cedulaParticipante)
                            {

                                existe = true; // Cambia estado de la variable "existe"
                                break; // Anula el ciclo FOR
                            }
                        }

                        if(existe) {

                            alert('El participante ya está registrado en esta curso.');
                        }
                        else if(!existe) 
                        {    
                            html = '<tr>';
                            html += '<td><input type="hidden" name="id-curso" value="'+datosCurso[0]+'">'+datosCurso[0]+'</td>';
                            html += '<td><input type="hidden" name="nombrescursos[]" value="'+datosCurso[1]+'">'+datosCurso[1]+'</td>';
                            html += '<td><input type="hidden" name="cupos-curso[]" value="'+datosCurso[2]+'">'+datosCurso[2]+'</td>';
                            html += '<td><input type="hidden" name="cuposIntanciaOcupados[]" value="'+datosCurso[4]+'">' + datosCurso[4] + '</td>';
                            html += '<td><input type="hidden" name="precioactualcursos[]" value="'+datosCurso[3]+'">' + datosCurso[3] + '</td>';

                            html += '<td><button type="button" class="btn btn-danger btn-remove-especialidad"><span class="fa fa-remove"></span></button></td>'
                            html += '</tr>';

                            $('#tabla-cursos tbody').append(html);

                            // Verifica el estado del atributo "disabled" del botón clickeado 
                            switchGuardarInscripcion();

                            // Vacía al elemento Producto
                            $('#producto').val('');

                            sumar_costo_inscripcion();

                        }
                    },
                    error: function( jqXhr, textStatus, errorThrown ) {
                        console.log( errorThrown );
                    }
                }); 
            }
        } else {
            alert('Seleccione una curso');
        }
    });

    /**
     * Permite remover una curso agregada en la vista de Nueva Inscripción
     * antes de que este sea almacenado en la base de datos.
     */
    $(document).on('click', '.btn-remove-especialidad', function() {

        $(this).closest('tr').remove();

        // Actualiza el campo COsto Inscripción
        sumar_costo_inscripcion();

        // Verifica que el contenido del nodo <tr> tenga contenido
        if($('#tabla-cursos tr').length <= 1) 
        {
            $('#btn-guardar-inscripcion').attr('disabled', true);
        }

    });

    /**
     * Permite remover un pago agregado en la vista de Nueva Inscripción
     * antes de que este sea almacenado en la base de datos.
     */
    $(document).on('click', '.btn-remove-pago', function() {

        $(this).closest('tr').remove();

        sumar();
    });

});

 /**
     * Permite actualizar la sumatoria del campo Costo de Inscripción
     * en la vista de agregar inscripción.
     *
     * @return void
     */
    function sumar_costo_inscripcion() {

        // Calcula el total cada vez que se llama esta función
        let costo_inscripcion = 0;       
        
        // Por cada elemento <tr> dentro del tbody en #tabla-cursos
        $('#tabla-cursos tbody tr').each(function() {
            
            // Cacula
            costo_inscripcion += Number($(this).find('td:eq(4)').text());
        });

        $('input[name=costo-de-inscripcion]').val(costo_inscripcion.toFixed(2));

        if($('input[name=monto-en-operacion]').val() !== '') {

            $('input[name=deuda]').val($('input[name=costo-de-inscripcion]').val() - $('input[name=monto-en-operacion]').val())
        }
    }