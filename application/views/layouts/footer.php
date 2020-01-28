        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php // echo base_url();?>assets/template/dist/js/demo.js"></script> -->

<script>
    $(document).ready(function () {

        // Activa el pluggin jQuery InputMask
        // $('[data-mask]').inputmask();

        $('.sidebar-menu').tree(); // Menú lateral

        // Invoca a la función encargada de generar el gráfico
        let year_actual = (new Date).getFullYear();
        grafico_inscripciones_mes(base_url, year_actual);
  

        $('#year').on('change', function() {

            let year_seleccionado = $this.val();

            // Invoca a la función encargada de generar el gráfico
            grafico_inscripciones_mes(base_url, year_seleccionado);
        });

        // =============================================
        // JS para DataTables
        // =============================================
        
        // Cambia el estado de un registro dado
        // Este botón funciona de manera similar en distintos formularios
        $('.btn-remove').on('click', function(e) {

            // Código para el botón de eliminar en las tablas
            e.preventDefault();

            let ruta = $(this).attr('href');
            alert(ruta);
            $.ajax({
                url: ruta,
                type: 'POST',
                success: function(response) {

                    window.location.href = base_url+response;
                }
            });
        });
        
       
        // =============================================
        // Fin de JS para DataTables
        // =============================================


        // =============================================
        // JS para Personas
        // =============================================
        $(document).on("click",".btn-view-persona",function() {
            let idPersona = $(this).val(); // ID de la persona
            $.ajax({
                url: base_url + "gestion/persona/view",
                type:"POST",
                dataType:"html",
                data:{
                    id_persona: idPersona
                },
                success:function(data) {
                    $("#modal-default .modal-body").html(data);
                }
            });
        });

        // =============================================
        // JS para Facilitadores
        // =============================================
        

        $('.btn-view-facilitador').on('click', function() {
            // Al clickear el botón de vista de facilitador, expande modal
            let facilitador = $(this).val();
            let infoFacilitador = facilitador.split('*');

            html = '<p><strong>Nombres: </strong>'+infoFacilitador[1]+'</p>'
            html += '<p><strong>Apellidos: </strong>'+infoFacilitador[2]+'</p>'
            html += '<p><strong>Teléfono: </strong>'+infoFacilitador[3]+'</p>'
            html += '<p><strong>Cédula: </strong>'+infoFacilitador[4]+'</p>';

            $('#modal-default .modal-body').html(html);
        });

        // =============================================
        // Fin de JS para Facilitadores
        // =============================================

        // =============================================
        // JS para Inscripciones
        // =============================================
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

                data = ui.item.serial_pago+'*'+ui.item.numero_referencia_bancaria+'*'+ui.item.monto_operacion+'*'+ui.item.nombre_cliente+'*'+ui.item.cedula+'*'+ui.item.id_pago+'*'+ui.item.id_tipo_de_operacion+'*'+ui.item.estado_pago;
                $('#btn-agregar-pago').val(data);
            }
        });

        $('#btn-agregar-pago').on('click', function() {

            data = $(this).val();

            if(data != '')
            {
                let datosPago = data.split('*');

                let serial_pago = datosPago[0],
                numero_referencia_bancaria = datosPago[1],
                monto_operacion = datosPago[2],
                nombre_cliente = datosPago[3],
                cedula_cliente = datosPago[4],
                id_pago = datosPago[5],
                id_tipo_de_operacion = datosPago[6],
                estado_pago = datosPago[7];        

                if(estado_pago == 1 || estado_pago == 3)
                {
                    html = '<tr id="'+ id_pago + '">';
                    html += '<td><input type="hidden" name="id-pago[]" value="'+id_pago+'">'+serial_pago+'</td>';
                    html += '<td><input type="hidden" name="numero-operacion[]" value="'+numero_referencia_bancaria+'">'+numero_referencia_bancaria+'</td>';
                    html += '<td><input type="hidden" name="monto-operacion[]" value="'+monto_operacion+'">'+monto_operacion+'</td>';
                    html += '<td><input type="hidden" name="cedula-cliente[]" value="'+cedula_cliente+'">'+cedula_cliente+'<input type="hidden" name="id_tipo_de_operacion[]" value="'+datosPago[7]+'">'+'</td>';

                    html += '<td><button type="button" class="btn btn-danger btn-remove-pago"><span class="fa fa-remove"></span></button></td>'
                    html += '</tr>';

                    $('#tabla-pagos tbody').append(html);

                    sumar();

                    $('#numero-de-operacion').val('');

                }
                else if(estado_pago == 0)
                {

                    alert('Pago no disponible');
                    $('#numero-de-operacion').val('');
                } else if(estado_pago == 2)
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
            let idParticipante = infoParticipante[0],
            nombreCompletoParticipante = infoParticipante[1] + ' ' +  infoParticipante[2];

            // Imprime la información relevante
            $('#id_participante').val(idParticipante);
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

        // Cambia el estado de un registro dado
        // Este botón funciona de manera similar en distintos formularios
        // $('.btn-deactivate-inscripcion').on('click', function(e) {

        //     // Código para el botón de eliminar en las tablas
        //     e.preventDefault();
        //     let tr_element = $(this).closest('tr');
        //     let ruta = $(this).attr('href');

        //     $.ajax({
        //         url: ruta,
        //         type: 'POST',
        //         success: function(response) {
        //             // window.location.href = base_url+response;
        //             tr_element.remove();
        //         }
        //     });
        // });

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
        
        /**
         * Botón que se encuentra ubicado en la vista de Éxito, mostrada luego
         * de registrar a una persona exitosamente en la base de datos.
         */
        $('#add-roles-persona').on('click', function(event) {

            let id_persona = $('input[name="id-persona"]').val();
            let participante = $('input[name="rol-participante"]');
            let nivelAcademicoParticipante = $('select[name="nivel-academico-participante"]');
            let titular = $('input[name="rol-titular"]');

            if(participante.is(":checked")) {
                participante = 'participante';
                nivelAcademicoParticipante = nivelAcademicoParticipante.val();
            } else if(participante.is(":not(:checked)"))
            {
                participante = '';
            }

            if(titular.is(":checked")) {
                titular = 'titular'
            } else if(titular.is(":not(:checked)"))
            {
                titular = '';
            }
       
            $.ajax({
                url: base_url + "gestion/persona/add_rol",
                type: 'POST',
                data: {
                    id_persona: id_persona,
                    participante: participante,
                    nivel_academico_participante: nivelAcademicoParticipante,
                    titular: titular
                },
                success: function(response) {

                }
            });
            $('#caja-principal').hide();
            $('#caja-secundaria').toggleClass('hidden');

            if(participante !== '') {
                $('#redirecciona-inscribir').toggleClass('hidden');
            }
            if(titular !== '') {
                $('#redirecciona-pago').toggleClass('hidden');
            }
            if(titular == '' && participante == '') { 
                $('#redirecciona-inicio').toggleClass('hidden');
            }

            return false;
        });

        /**
         * Al presionar el checkbox indicado, se debe ocultar o mostrar
         * el selector de nivel académico que por defecto se encuentra 
         * inactivo. 
         */
        $('input[name="rol-participante"]').on('click', function() {
            $('select[name="nivel-academico-participante"]').parent().toggleClass('hidden')
        });

        // =============================================
        // Fin de JS para Inscripciones
        // =============================================


        // =============================================
        // JS para Locaciones
        // =============================================
        $(document).on("click",".btn-view-locacion",function() {

            let idLocacion = $(this).val(); // ID de la locación

            $.ajax({
                url: base_url + "gestion/locacion/view",
                type:"POST",
                dataType:"html",
                data:{

                    id_locacion: idLocacion
                },
                success:function(data) {
                    $("#modal-default .modal-body").html(data);
                }
            });
        });



        // =============================================
        // JS para Participantes
        // =============================================

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

        // =============================================
        // Fin de JS para Participantes
        // =============================================

        $('#producto').autocomplete({

            source: function(request, response) {
                $.ajax({
                    url: base_url+'movimientos/inscripcion/getInstanciasJSON',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        query: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                });
            }, minLength: 2,
            select: function(event, ui) {

                /**
                 * Para calcular el total de elementos <tr> en la tabla
                 * es necesario agregar -1 a la longitud total debido
                 * a que el encabezado ya tiene un elemento <tr> que también se cuenta
                 */
                let table_rows_count = $('#tabla-cursos tr').length - 1;

                if(table_rows_count >= 1) {

                    alert('¡No puedes seleccionar más de 1 especialidad!');
                    return;
                }
                // Almacena en una variable los datos recogidos con la consulta SQL realizada previamente
                let data = ui.item.id_instancia+'*'+ui.item.label+'*'+ui.item.cupos_instancia+'*'+ui.item.precio_instancia+'*'+ui.item.cupos_instancia_ocupados;
                
                // Almacena la variable data dentro del atributo value del elemento selector
                $('#btn-agregar-especialidad').val(data);

                // Almacena el ID del especialidad en atributo personalizado de HTML
                $('#btn-agregar-especialidad').attr('data-id-especialidad', ui.item.id_instancia);

            }
        });

        /**
         * Verifica que el número de operación sea único antes de enviar la solicitud
         * a la base de datos.
         */
        $('#numero-referencia').on('keyup click cut copy paste drop', function() {

            // Al alterar el contenido de la caja de texto desactiva el botón de guardado
            $('#btn-guardar-inscripcion-pago').attr('disabled', true);
        });

        $('#verificar-numero-pago').on('click', function() {

            numeroEvaluado = $(this).val();

            $.ajax({
                url: base_url + "movimientos/pago/pago_unico",
                type: "POST",
                dataType: "json",
                data: {
                    query: numeroEvaluado
                },
                success: function(data) {

                    
                    if(data == false) {
                        
                        alert(data)
                    }
                    
                    if(data == true) {
                        $('#numero-referencia').parent().addClass('has-success');
                        $('label[for="numero-referencia"] i').removeClass('hidden');
                        $('#btn-guardar-inscripcion-pago').removeAttr('disabled');
                    }

                    // $('#caja-principal').hide();
                    // $('#caja-secundaria').toggleClass('hidden');
                    // $('#btn-guardar-inscripcion-pago').toggleClass('disabled')

                    // $('#id-periodo-curso').val(data);

                }
            });
            return false;
        });

        // Al presionar este botón, imprimir en la vista los datos consultados
        $('#btn-agregar-especialidad').on('click', function() {
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
                        url: base_url+'movimientos/inscripcion/get_participantesJSON/',
                        dataType: 'JSON',
                        data: {

                            // "data-id-especialidad" es un atributo personalizado de HTML que almacena
                            // el ID de el curso seleccionada
                            id: $(this).attr('data-id-especialidad')
                        },
                        success: function( data, textStatus, jQxhr ) {

                            let idParticipante = $('#id_participante').val(), // Almacena el ID del participante a inscribir
                            existe = false; // Al encontrar al participante cambia a TRUE

                            // Itera sobre cada OBJETO obtenido durante la llamada AJAX
                            for(let i = 0; i < data.length; i++)
                            {

                                let idParticipanteInscrito = data[i]['fk_id_participante_1']; // Almacena ID del participante Inscrito en el especialidad dado
                                
                                if(idParticipanteInscrito == idParticipante)
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
                                html += '<td><input class="especialidad-id" type="hidden" name="id-cursos[]" value="'+datosCurso[0]+'">'+datosCurso[0]+'</td>';
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

        $(document).on('click', '.btn-view-inscripcion', function()
        {
            dataInscripcion = $(this).val();
            datosInscripcion = dataInscripcion.split('*');

            id_curso_inscripcion = datosInscripcion[0];
            id_inscripcion = datosInscripcion[1];

            $.ajax({
                url: base_url + 'movimientos/inscripcion/view',
                type: 'POST',
                dataType: 'html',
                data: {
                    id_inscripcion: id_inscripcion
                },
                success: function(data) {

                    $('#modal-default .modal-body').html(data);
                }
            });
        });

        $(document).on('click', '.btn-view-usuario', function() {

            let id_usuario = $(this).val();
            $.ajax({
                url: base_url + 'administrador/usuario/view',
                type: 'POST',
                dataType: 'html',
                data: {
                    id_usuario: id_usuario
                },
                success: function(data) {
                    $('#modal-default .modal-body').html(data);
                }
            });
        });

        $(document).on('click', '.btn-view-curso', function() {

            let id_instancia = $(this).val();
            $.ajax({
                url: base_url + 'gestion/curso/view',
                type: 'POST',
                dataType: 'html',
                data: {
                    id_instancia: id_instancia
                },
                success: function(data) {
                    $('#modal-default .modal-body').html(data);
                }
            });
        });

    });

    /**
     * Función utilizada para generar un número entero dentrol del rango:
     * 1 a 999999, con la finalidad de generar un número para distintos seriales.
     * El parámetro recibido por esta función es necesario para poder llevar un control
     * del número a generar.
     * 
     */
    function generarNumero(numero) {

        if(numero >= 99999 && numero < 999999) {
            return Number(numero)+1;
        }

        if(numero >= 9999 && numero < 99999) {
            return '0' + (Number(numero)+1);
        }

        if(numero >= 999 && numero < 9999) {
            return '00' + (Number(numero)+1);
        }

        if(numero >= 99 && numero < 999) {
            return '000' + (Number(numero)+1);
        }

        if(numero >= 9 && numero < 99) {
            return '0000' + (Number(numero)+1);
        }

        if(numero < 9) {
            return '00000' + (Number(numero)+1);
        }
    }

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

    function sumar() {

        // Calcula el total cada vez que se llama esta función
        let monto_en_operacion = 0;       
        
        $('#tabla-pagos tbody tr').each(function() {
    
            monto_en_operacion += Number($(this).find('td:eq(2)').text());
        });

        $('input[name=monto-en-operacion]').val(monto_en_operacion.toFixed(2));

        if($('input[name=costo-de-inscripcion]').val() !== '') {

            $('input[name=deuda]').val($('input[name=costo-de-inscripcion]').val() - $('input[name=monto-en-operacion]').val())
        }
    }

    function restar() {

        let monto_en_operacion = 0;

        $('#pagos-desasociados tbody tr').each(function() {
    
            monto_en_operacion += Number($(this).find('td:eq(2)').text());
        });

        $('input[name=monto-en-operacion]').val(monto_en_operacion.toFixed(2));
    }

    function switchGuardarInscripcion() {

        let theAttribute = $('#btn-guardar-inscripcion').attr('disabled');

        if(typeof theAttribute !== typeof undefined && theAttribute !== false) {

            $('#btn-guardar-inscripcion').removeAttr('disabled');
        }
    }

    // Highcharts
    
    function grafico_inscripciones_mes(base_url, year)
    {
        let nombres_mes = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'];

        $.ajax({
            url: base_url + "dashboard/getData",
            type: 'POST',
            data: {year_inscripcion: year},
            dataType: 'json',
            success: function(data)
            {
                let meses_inscripciones = new Array(),
                montos_generados = new Array();

                $.each(data, function(key, value) {
                    meses_inscripciones.push(nombres_mes[value.mes_inscripcion - 1]);
                    let valor = Number(value.monto_generado);
                    montos_generados.push(valor);
                });
                graficar(meses_inscripciones, montos_generados, year);
            }
        })
    }

    function graficar(meses_inscripciones, montos_generados, year)
    {
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Inscripciones por mes'
            },
            subtitle: {
                text: 'Inscripciones ' + year
            },
            xAxis: {
                categories: meses_inscripciones,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Dinero (Bs.)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} Bs.</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                },
                series: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return Highcharts.numberFormat(this.y, 2)
                        }
                    }
                }
            },
            series: [{
                name: 'Ingresos Por Mes',
                data: montos_generados

            }]
        });
    }

</script>

</body>
</html>
