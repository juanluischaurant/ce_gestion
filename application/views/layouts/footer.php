        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>

<!-- jQuery UI -->
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template//bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- DataTables Export -->
<script src="<?php echo base_url();?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>

<script>
    $(document).ready(function () {

        let base_url = "<?php echo base_url();?>"; // Almacena el url base del proyecto
        // http://localhost/ce_gestion/
        
        // =============================================
        // JS para DataTables
        // =============================================

        $('#example1').DataTable();
        $('.sidebar-menu').tree();

        $('.btn-remove').on('click', function(e) {
            // Código para el botón de eliminar en las tablas
            e.preventDefault();
            let ruta = $(this).attr('href');
            $.ajax({
                url: ruta,
                type: 'POST',
                success: function(response) {
                    window.location.href = base_url+response;
                }
            });

        });

        $('#export-cursos').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: "Listado de cursos",
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

        $('#export-inscripciones').DataTable( {
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

        // =============================================
        // Fin de JS para DataTables
        // =============================================


        // =============================================
        // JS para Clientes
        // =============================================

        // if($('#fk-id-persona').val() !== '') {
        //     // Si hay alguna persona seleccionada para ser instanciada, 
        //     // remueve el atributo 'disabled' del botón
        //     $('#guardar-participante').removeAttr('disabled');
        // }

        $(document).on('click', '.btn-check-cliente', function() {
            let cliente = $(this).val();
            let informacionCliente = cliente.split('*');

            let personaId = informacionCliente[0],
            nombresPersona = informacionCliente[1],
            apellidosPersona = informacionCliente[2],
            telefonoPersona = informacionCliente[3],
            cedulaPersona = informacionCliente[4],
            fechaNacimientoPersona = informacionCliente[5],
            generoPersona = informacionCliente[6];
            direccionPersona = informacionCliente[7];

            $('#nacimiento-cliente').val(fechaNacimientoPersona);
            $('#fk-id-persona').val(personaId);
            $('#genero-cliente').val(generoPersona);
            $('#nombres-cliente').val(nombresPersona);
            $('#apellidos-cliente').val(apellidosPersona);
            $('#telefono-cliente').val(telefonoPersona);
            $('#direccion-cliente').val(direccionPersona);


            // Al seleccionar un facilitador de la lista, activa el botón "Guardar"
            $('#guardar-cliente').removeAttr('disabled');

            // Oculta ventana modal
            $('#modal-default').modal('hide');
        });

        // =============================================
        // Fin de JS para Clientes
        // =============================================


        // =============================================
        // JS para Facilitadores
        // =============================================
        
        if($('#fk-id-persona').val() !== '') {
            // Si hay alguna persona seleccionada para ser instanciada, 
            // remueve el atributo 'disabled' del botón
            $('#guardar-facilitador').removeAttr('disabled');
        }

        $(document).on('click', '.btn-check-facilitador', function() {
            let facilitador = $(this).val();
            let informacionFacilitador = facilitador.split('*');

            let personaId = informacionFacilitador[0],
            nombresPersona = informacionFacilitador[1],
            apellidosPersona = informacionFacilitador[2],
            telefonoPersona = informacionFacilitador[3],
            cedulaPersona = informacionFacilitador[4],
            fechaNacimientoPersona = informacionFacilitador[5],
            generoPersona = informacionFacilitador[6];
            direccionPersona = informacionFacilitador[7];

            $('#fk-id-persona').val(personaId);
            $('#nombres-facilitador').val(nombresPersona);
            $('#apellidos-facilitador').val(apellidosPersona);
            $('#nacimiento-facilitador').val(fechaNacimientoPersona);
            $('#genero-facilitador').val(generoPersona);
            $('#telefono-facilitador').val(telefonoPersona);
            $('#direccion-facilitador').val(direccionPersona);

            // Al seleccionar un facilitador de la lista, activa el botón "Guardar"
            $('#guardar-facilitador').removeAttr('disabled');

            // Oculta ventana modal
            $('#modal-default').modal('hide');
        });

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
        // JS para Pagos
        // =============================================

        $('#tipo-de-pago').on('change', function() {
            let option = $(this).val();

            if(option != '') {
                let infoTipoDePago = option.split('*');
                let tipoDePago = infoTipoDePago[2];

                $('#id-tipo-de-pago').val(infoTipoDePago[0]);

                if(tipoDePago === 'Efectivo') {
                    $('#serial-de-pago').val('efe-'+generarNumero(infoTipoDePago[1]));
                } else if(tipoDePago === 'Transferencia') {
                    $('#serial-de-pago').val('tra-'+generarNumero(infoTipoDePago[1]));
                } else if(tipoDePago === 'Exonerado') {
                    $('#serial-de-pago').val('exo-'+generarNumero(infoTipoDePago[1]));
                }

            } else {
                $('#id-tipo-de-pago').val(null);
                $('#serial-de-pago').val(null);
            }
        });

        $('#cedula-cliente').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'movimientos/Pagos/getClientesJSON',
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
                // Considera eliminar esta variable `data` no utilizada aquí
                data = ui.item.id_cliente+'*'+ui.item.label;

                $('#nombre-cliente').val(ui.item.nombre_cliente);
                $('#id-cliente').val(ui.item.id_cliente);
            }
        });

        $('#banco-de-operacion').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'movimientos/Pagos/getBancosJSON',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        query: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                });
            }, minLength: 3,
            select: function(event, ui) {
                $('#id-banco-de-operacion').val(ui.item.id_banco);
            }
        });

        // =============================================
        // Fin de JS para Pagos
        // =============================================


        // =============================================
        // JS para Inscripciones
        // =============================================
        $('#numero-de-operacion').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'movimientos/inscripciones/getPagosJSON',
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
                data = ui.item.serial_pago+'*'+ui.item.numero_operacion+'*'+ui.item.monto_operacion+'*'+ui.item.nombre_cliente+'*'+ui.item.cedula_persona+'*'+ui.item.id_pago+'*'+ui.item.id_pago+'*'+ui.item.fk_id_tipo_operacion+'*'+ui.item.estado_pago;
                $('#btn-agregar-pago').val(data);
            }
        });

        $('#btn-agregar-pago').on('click', function() {
            data = $(this).val();

            if(data != '') {

                datosPago = data.split('*');

                if(datosPago[8] == 1) {

                    html = '<tr>';
                    html += '<td><input type="hidden" name="serial-pago[]" value="'+datosPago[0]+'">'+datosPago[0]+'</td>';
                    html += '<td><input type="hidden" name="numero-operacion[]" value="'+datosPago[1]+'">'+datosPago[1]+'</td>';
                    html += '<td><input type="hidden" name="monto-operacion[]" value="'+datosPago[2]+'">'+datosPago[2]+'<input type="hidden" name="id_pago[]" value="'+datosPago[6]+'"></td>';
                    html += '<td><input type="hidden" name="nombre_cliente[]" value="'+datosPago[3]+'">'+datosPago[4]+'<input type="hidden" name="fk_id_tipo_operacion[]" value="'+datosPago[7]+'">'+'</td>';

                    html += '<td><button type="button" class="btn btn-danger btn-remove-pago"><span class="fa fa-remove"></span></button></td>'
                    html += '</tr>';

                    $('#tabla-pagos tbody').append(html);

                    sumar();

                    $('#numero-de-operacion').val('');

                } else if(datosPago[8] == 0) {

                    alert('Pago no disponible');
                    $('#numero-de-operacion').val('');

                } else if(datosPago[8] == 2) {

                    alert('Pago ya ha sido utilizado');
                    $('#numero-de-operacion').val('');

                }
                
            } else {
                alert('seleccione un pago');
            }
        });

        $(document).on('click', '.btn-check-participante-inscripcion', function() {
            let participante = $(this).val(); // Almacena el valor almacenado en el atributo value del botón clickeado
            let infoParticipante = participante.split('*'); // divide la información en un array

            // Asigna la información relevante en variables
            let idParticipante = infoParticipante[0],
            nombreCompletoParticipante = infoParticipante[1] + ' ' +  infoParticipante[2];

            // Imprime la información relevante
            $('#id_participante').val(idParticipante);
            $('#nombre_participante').val(nombreCompletoParticipante);

            $('#modal-default').modal('hide');
        });

        // =============================================
        // Fin de JS para Inscripciones
        // =============================================


        // =============================================
        // JS para Instancias
        // =============================================

        $(document).on('click', '.btn-check-curso-instanciado', function() {
            let curso = $(this).val();
            let infoCurso = curso.split('*');

            $('#id-curso-instanciado').val(infoCurso[0]);
            $('#nombre-curso-instanciado').val(infoCurso[1]);

            $('#modal-default').modal('hide');
        });

        $('#periodo-instancia').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'gestion/instancias/getPeriodosJSON',
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
                // Solo necesitamos almacenar el id del periodos
                data = ui.item.id_periodo;
                $('#id-periodo-instancia').val(data);
            }
        });

        $('#locacion-instancia').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'gestion/instancias/getLocacionesJSON',
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
                // Solo necesitamos almacenar el id de la locación
                let data = ui.item.id_locacion;
                $('#id-locacion-instancia').val(data);
            }
        });

        $('#profesor-instancia').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'gestion/instancias/getFacilitadoresJSON',
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
                // Solo necesitamos almacenar el id de la locación
                let data = ui.item.id_facilitador;
                $('#id-profesor-instancia').val(data);
            }
        });

        // =============================================
        // Fin de JS para Instancias
        // =============================================


        // =============================================
        // JS para Participantes
        // =============================================

        $(document).on('click', '.btn-check-participante', function() {
            let participante = $(this).val();
            let informacionParticipante = participante.split('*');

            let personaId = informacionParticipante[0],
            nombresPersona = informacionParticipante[1],
            apellidosPersona = informacionParticipante[2],
            telefonoPersona = informacionParticipante[3],
            cedulaPersona = informacionParticipante[4],
            fechaNacimientoPersona = informacionParticipante[5],
            generoPersona = informacionParticipante[6];
            direccionPersona = informacionParticipante[7];

            $('#fk-id-persona').val(personaId);
            $('#nombres-participante').val(nombresPersona);
            $('#apellidos-participante').val(apellidosPersona);
            $('#nacimiento-participante').val(fechaNacimientoPersona);
            $('#genero-participante').val(generoPersona);
            $('#telefono-participante').val(telefonoPersona);
            $('#direccion-participante').val(direccionPersona);

            // Al seleccionar un participante de la lista, activa el botón "Guardar"
            $('#guardar-participante').removeAttr('disabled');

            // Oculta ventana modal
            $('#modal-default').modal('hide');
        });

        // =============================================
        // Fin de JS para Participantes
        // =============================================

        $('#producto').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'movimientos/inscripciones/getInstanciasJSON',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        query: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                });
            }, minLength: 3,
            select: function(event, ui) {
                // Almacena en una variable los datos recogidos con la consulta SQL realizada previamente
                let data = ui.item.id_instancia+'*'+ui.item.label+'*'+ui.item.cupos_instancia+'*'+ui.item.precio_instancia+'*'+ui.item.cupos_instancia_ocupados;
                
                // Almacena la variable data dentro del atributo value del elemento seleccionado
                $('#btn-agregar-curso').val(data);

                // Almacena el ID del curso en atributo personalizado de HTML
                $('#btn-agregar-curso').attr('data-id-curso', ui.item.id_instancia);
            }
        });

        // Al presionar este botón, imprimir en la vista los datos consultados
        $('#btn-agregar-curso').on('click', function() {

            let data = $(this).val(); // Almacena los datos del atributo "value" del boton clickeado

            // Comprobar si la variable "data" está vacia o no
            if(data != '') {

                let datosCurso = data.split('*');

                console.table(datosCurso);

                let cupos_totales = datosCurso[2], // Almacena la cantidad de cupos totales por curso
                cupos_ocupados = datosCurso[4]; // Almacena la cantidad de cupos ocupados por curso

                if(parseInt(cupos_totales) <= parseInt(cupos_ocupados)) {
                    alert('El curso está lleno, por favor seleccione otro');
                    $('#producto').val('');
                } else {
                html = '<tr>';
                html += '<td><input class="curso-id" type="hidden" name="idcursos[]" value="'+datosCurso[0]+'">'+datosCurso[0]+'</td>';
                html += '<td><input type="hidden" name="nombrescursos[]" value="'+datosCurso[1]+'">'+datosCurso[1]+'</td>';
                html += '<td><input type="hidden" name="cuposcursos[]" value="'+datosCurso[2]+'">'+datosCurso[2]+'</td>';
                html += '<td><input type="hidden" name="cuposIntanciaOcupados[]" value="'+datosCurso[4]+'">' + datosCurso[4] + '</td>';
                html += '<td><input type="hidden" name="precioactualcursos[]" value="'+datosCurso[3]+'">' + datosCurso[3] + '</td>';

                html += '<td><button type="button" class="btn btn-danger btn-remove-curso"><span class="fa fa-remove"></span></button></td>'
                html += '</tr>';

                $('#tbventas tbody').append(html);

                // Verifica el estado del atributo "disabled" del botón clickeado 
                switchGuardarInscripcion();

                sumar();

                }

            } else {
                alert('Seleccione un curso');
            }
        })
        .on('click', function(event) {
            console.log($(this).attr('data-id-curso'))
            // Solocitud AJAX realizada para obtener de la base de datos
            // una lista de participantes inscritos en determinado curso
            $.ajax({
                type: 'post',
                url: base_url+'movimientos/inscripciones/getParticipantesJSON/',
                dataType: 'json',
                data: {
                    id: $(this).attr('data-id-curso')
                },
                success: function( data, textStatus, jQxhr )
                {
                    let idParticipante = $('#id_participante').val(), // Almacena el ID del participante a inscribir
                    existe = false; // Al encontrar al participante cambia a TRUE

                    // Itera sobre cada OBJETO obtenido durante la llamada AJAX
                    for(let i = 0; i < data.length; i++)
                    {
                        let idParticipanteInscrito = data[i]['fk_id_participante_1']; // Almacena ID del participante Inscrito en el curso dado
                        
                        if(idParticipanteInscrito == idParticipante)
                        {
                            // alert(idParticipanteInscrito);
                            existe = true; // Cambia estado de la variable "existe"
                            break; // Anula el ciclo FOR
                        }
                    }

                    if(existe)
                    {
                        alert('El participante ya está registrado en esta instancia.')
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ) {
                    console.log( errorThrown );
                }
            });

        });

        $(document).on('click', '.btn-remove-curso', function() {
        $(this).closest('tr').remove();

        if($('#tbventas tr').length <= 1) {
            $('#guardar-inscripcion').attr('disabled', true);
        }

        sumar();
        });

        $(document).on('click', '.btn-remove-curso', function() {
            $(this).closest('tr').remove();

            if($('#tbventas tr').length <= 1) {
                $('#guardar-inscripcion').attr('disabled', true);
            }
            
            sumar();
        });

        $(document).on('click', '.btn-remove-pago', function() {
            $(this).closest('tr').remove();
            sumar();

        });

        // NO OLVIDES PROGRAMAR ESTO
        // ¿Es realmente necesario?
        // $(document).on('keyup', '#tbventas input.cantidades', function() {
        //     cantidad = $(this).val();
        //     precio = $(this).closest('tr').find('td:eq(2)');
        //     importe = cantidad * precio
        // });

        $('.btn-view-participante').on('click', function() {
            let participante = $(this).val(); // Almacena datos del participante previamente almacenados en el atributo "value" del botón clickeado
            let infoParticipante = participante.split('*'); // Divide y convierte en array la cadena de texto almacenada en "participante"

            // Estructura el html a renderizar
            let html = '<p><strong>Nombres: </strong>'+infoParticipante[1]+'</p>'
            html += '<p><strong>Apellidos: </strong>'+infoParticipante[2]+'</p>'
            html += '<p><strong>Teléfono: </strong>'+infoParticipante[3]+'</p>'
            html += '<p><strong>Cédula: </strong>'+infoParticipante[4]+'</p>';

            // Renderiza el código html en el lugar indicado
            $('#modal-default .modal-body').html(html);
        });

        $(document).on('click', '.btn-view-inscripcion', function() {
            dataInscripcion = $(this).val();
            datosInscripcion = dataInscripcion.split('*');

            id_curso_inscripcion = datosInscripcion[0];
            id_inscripcion = datosInscripcion[1];

            $.ajax({
                url: base_url + 'movimientos/inscripciones/view',
                type: 'POST',
                dataType: 'html',
                data: {
                    id_curso_inscripcion: id_curso_inscripcion,
                    id_inscripcion: id_inscripcion
                    },
                success: function(data) {
                    $('#modal-default .modal-body').html(data);
                }
            });
        });

    });

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

    function sumar() {
        // Calcula el total cada vez que se llama esta función
        subtotal = 0;
        monto_pagado = 0;

        // -------------
        $('#tabla-pagos tbody tr').each(function() {
            monto_pagado = monto_pagado + Number($(this).find('td:eq(2)').text());
        });
        $('input[name=monto-pagado]').val(monto_pagado.toFixed(2));

        // --------------

        $('#tbventas tbody tr').each(function() {
            subtotal = subtotal + Number($(this).find('td:eq(4)').text());
        });
        $('input[name=subtotal]').val(subtotal.toFixed(2));

        descuento = $('input[name=descuento]').val();

        total = subtotal - descuento;

        $('input[name=total]').val(total.toFixed(2));
    }

    function switchGuardarInscripcion() {

        let theAttribute = $('#guardar-inscripcion').attr('disabled');

        if(typeof theAttribute !== typeof undefined && theAttribute !== false) {
            $('#guardar-inscripcion').removeAttr('disabled');
        }

    }

</script>

</body>
</html>
