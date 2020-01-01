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

<!-- Highcharts -->
<script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>


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
        // URL base actual (Sujeto a cambios dependiendo de
        // la dirección real):http://localhost/ce_gestion/
        
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

        $('#example1').DataTable({
            "order": [[ 1, "desc" ]]
        });

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
        
        $('#export-acciones').DataTable({
            "order": [[ 1, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: "Listado de Acciones",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: "Listado de Acciones",
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

        $('#export-inscripciones').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: "Listado de Acciones",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: "Listado de Acciones",
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

        $('#export-inscripciones').DataTable({
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
        // JS para Personas
        // =============================================
        $(document).on("click",".btn-view-persona",function() {
            let idPersona = $(this).val(); // ID de la persona
            $.ajax({
                url: base_url + "gestion/personas/view",
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
        // Fin JS para Personas
        // =============================================


        // =============================================
        // JS para Titulares
        // =============================================

        $(document).on('click', '.btn-check-titular', function() {
            let titular = $(this).val();
            let informacionTitular = titular.split('*');

            let personaId = informacionTitular[0],
            nombresPersona = informacionTitular[1],
            apellidosPersona = informacionTitular[2],
            telefonoPersona = informacionTitular[3],
            cedulaPersona = informacionTitular[4],
            fechaNacimientoPersona = informacionTitular[5],
            generoPersona = informacionTitular[6];
            direccionPersona = informacionTitular[7];

            $('#nacimiento-titular').val(fechaNacimientoPersona);
            $('#fk-id-persona').val(personaId);
            $('#genero-titular').val(generoPersona);
            $('#nombres-titular').val(nombresPersona);
            $('#apellidos-titular').val(apellidosPersona);
            $('#telefono-titular').val(telefonoPersona);
            $('#direccion-titular').val(direccionPersona);


            // Al seleccionar un titular de la lista, activa el botón "Guardar"
            $('#guardar-titular').removeAttr('disabled');

            // Oculta ventana modal
            $('#modal-default').modal('hide');
        });

        // =============================================
        // Fin de JS para Titulares
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

        /**
          * Detecta cuando el tipo de pago es seleccionado, y responde en base a la opción
          * seleccionada.
          */
        $('#tipo-de-pago').on('change', function() {

            let idTipoDeOperacion = $(this).val();

            if(idTipoDeOperacion != '') {

                $.ajax({
                    url: base_url + "movimientos/pagos/get_tipo_de_operacion_ajax",
                    type:"POST",
                    dataType:"html",
                    data:{
                        id_tipo_operacion: idTipoDeOperacion
                    },
                    success:function(data) {

                        let a = JSON.parse(data);

                        let conteoDeOperaciones = a.conteo_operaciones,
                        tipoDeOperacion = a.tipo_de_operacion;

                        // Almacena el id único del tipo de pago en un elemento HTML oculto
                        $('#id-tipo-de-pago').val(idTipoDeOperacion);

                        configurarTipoOperacion(tipoDeOperacion, conteoDeOperaciones);

                        if(tipoDeOperacion === 'Efectivo') {

                            $('#serial-de-pago').val('efe-'+generarNumero(conteoDeOperaciones));   
                        } else if(tipoDeOperacion === 'Transferencia') {

                            $('#serial-de-pago').val('tra-'+generarNumero(conteoDeOperaciones));
                        } else if(tipoDeOperacion === 'Exonerado') {

                            $('#serial-de-pago').val('exo-'+generarNumero(conteoDeOperaciones));
                        }
                    }
                });
            } else {

                // Vacía el valor de las siguentes entidades HTML:
                $('#id-tipo-de-pago').val(null);
                $('#serial-de-pago').val(null);
            }
        });

        function configurarTipoOperacion(tipoOperacion, conteoDeOperaciones) {

           switch(tipoOperacion) { 
               case 'Efectivo':
                    // HTML Elements return NULL when disabled
                    $('#banco-de-operacion')
                        .prop('readonly', true)
                        .val('No aplica');

                    $('#id-banco-de-operacion')
                        .val('4');

                    $('#numero-de-operacion-unico')
                        .prop('readonly', true)
                        .val('EFE'+generarNumero(conteoDeOperaciones));

                    $('#monto-de-operacion')
                        .prop('readonly', false)
                        .val('');
                    break;
                
                case 'Exonerado':
                    $('#banco-de-operacion')
                        .prop('readonly', true)
                        .val('No aplica');

                    $('#id-banco-de-operacion')
                        .val('4');

                    $('#numero-de-operacion-unico')
                        .prop('readonly', true)
                        .val('EXO'+generarNumero(conteoDeOperaciones));

                    $('#monto-de-operacion')
                        .prop('readonly', true)
                        .val('0.00');
                    break;

                case 'Transferencia':
                    $('#banco-de-operacion')
                        .prop('readonly', false)
                        .val('');

                    $('#numero-de-operacion-unico')
                        .prop('readonly', false)
                        .val('');

                    $('#monto-de-operacion')
                        .prop('readonly', false)
                        .val('')
                    break;

                default:
                    $('#banco-de-operacion')
                        .prop('readonly', true)
                        .val('No aplica');

                    $('#numero-de-operacion-unico')
                        .prop('readonly', true)
                        .val('');
                    
                    $('#monto-de-operacion')
                        .prop('readonly', false)
                        .val('');
                        break;
           }       
        }
  
        $(document).on("click",".btn-view-pago",function() {
            
            let id_pago = $(this).val(); // ID del elemento a consultar
            $.ajax({
                url: base_url + "movimientos/pagos/view",
                type:"POST",
                dataType:"html",
                data:{
                    id_pago: id_pago
                },
                success:function(data) {
                    $("#modal-default .modal-body").html(data);
                }
            });
        });

        $('#cedula-titular').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url+'movimientos/pagos/get_titulares_json',
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
                data = ui.item.id_titular+'*'+ui.item.label;

                $('#nombre-titular').val(ui.item.nombre_titular);
                $('#id-titular').val(ui.item.id_titular);
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
                    url: base_url+'movimientos/pagos/get_pagos_json',
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

                data = ui.item.serial_pago+'*'+ui.item.numero_operacion+'*'+ui.item.monto_operacion+'*'+ui.item.nombre_cliente+'*'+ui.item.cedula_persona+'*'+ui.item.id_pago+'*'+ui.item.fk_id_tipo_operacion+'*'+ui.item.estado_pago;
                $('#btn-agregar-pago').val(data);
            }
        });

        $('#btn-agregar-pago').on('click', function() {

            data = $(this).val();

            if(data != '')
            {
                let datosPago = data.split('*');

                let serial_pago = datosPago[0],
                numero_operacion = datosPago[1],
                monto_operacion = datosPago[2],
                nombre_cliente = datosPago[3],
                cedula_cliente = datosPago[4],
                id_pago = datosPago[5],
                fk_id_tipo_operacion = datosPago[6],
                estado_pago = datosPago[7];        

                if(estado_pago == 1 || estado_pago == 3)
                {
                    html = '<tr id="'+ id_pago + '">';
                    html += '<td><input type="hidden" name="id-pago[]" value="'+id_pago+'">'+serial_pago+'</td>';
                    html += '<td><input type="hidden" name="numero-operacion[]" value="'+numero_operacion+'">'+numero_operacion+'</td>';
                    html += '<td><input type="hidden" name="monto-operacion[]" value="'+monto_operacion+'">'+monto_operacion+'</td>';
                    html += '<td><input type="hidden" name="cedula-cliente[]" value="'+cedula_cliente+'">'+cedula_cliente+'<input type="hidden" name="fk_id_tipo_operacion[]" value="'+datosPago[7]+'">'+'</td>';

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

            // Activa campo para agregar Instancia
            $('#producto').removeAttr('disabled');
        });

        // Función encargada de almacenar los datos de pago de manera asincrona
        $(document).on('click', '#btn-guardar-inscripcion-pago', function() {

            let exito = false; // Do you need it?

            let id_banco_operacion = $('#id-banco-de-operacion').val(),
            fk_id_tipo_operacion = $('#id-tipo-de-pago').val(),
            id_cliente = $('#id-titular').val(),
            serial_de_pago = $('#serial-de-pago').val(),
            numero_de_operacion = $('#numero-de-operacion-unico').val(),
            monto_de_operacion = $('#monto-de-operacion').val(),
            fecha_de_operacion = $('#fecha-operacion').val();

            $.ajax({
                url: base_url+'movimientos/pagos/store_ajax',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_banco_operacion: id_banco_operacion,
                    fk_id_tipo_operacion: fk_id_tipo_operacion,
                    id_cliente: id_cliente,
                    serial_de_pago: serial_de_pago,
                    numero_de_operacion: numero_de_operacion,
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
        $('.btn-deactivate-inscripcion').on('click', function(e) {

            // Código para el botón de eliminar en las tablas
            e.preventDefault();
            let tr_element = $(this).closest('tr');
            let ruta = $(this).attr('href');

            $.ajax({
                url: ruta,
                type: 'POST',
                success: function(response) {
                    window.location.href = base_url+response;
                    // tr_element.remove();
                }
            });
        });

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

        $('#tab-cambiar-instancia').on('click', function() {

            location.reload();
        });
        
        $('#tab-asociar-pago').on('click', function(e) {

            location.reload();
        });

        $('#tab-desasociar-pago').on('click', function() {

            location.reload();
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

            let vecesInstanciado = infoCurso[3],
            nombreCurso = infoCurso[1];

            let prefijo = nombreCurso.substring(0, 3);
            $('#serial-instancia').val(prefijo+'-'+generarNumero(vecesInstanciado));

            $('#id-curso-instanciado').val(infoCurso[0]);
            $('#nombre-curso-instanciado').val(nombreCurso);

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

        $(document).on("click",".btn-view-participante",function() {
            let id_participante = $(this).val(); // ID de la persona
            $.ajax({
                url: base_url + "gestion/participantes/view",
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
            }, minLength: 2,
            select: function(event, ui) {

                let table_rows_count = $('#tabla-instancias tr').length - 1;

                if(table_rows_count >= 1) {

                    alert('¡No puedes seleccionar más de 1 curso!');
                    return;
                }
                // Almacena en una variable los datos recogidos con la consulta SQL realizada previamente
                let data = ui.item.id_instancia+'*'+ui.item.label+'*'+ui.item.cupos_instancia+'*'+ui.item.precio_instancia+'*'+ui.item.cupos_instancia_ocupados;
                
                // Almacena la variable data dentro del atributo value del elemento seleccionado
                $('#btn-agregar-curso').val(data);

                // Almacena el ID del curso en atributo personalizado de HTML
                $('#btn-agregar-curso').attr('data-id-curso', ui.item.id_instancia);
            }
        });

        // Al presionar este botón, imprimir en la vista los datos consultados
        $('#btn-agregar-curso').on('click', function()
        {
            let data = $(this).val(); // Almacena los datos del atributo "value" del boton clickeado

            // Comprobar si la variable "data" está vacia o no
            if(data != '') 
            {

                let datosCurso = data.split('*'),
                cupos_totales = datosCurso[2], // Almacena la cantidad de cupos totales por curso
                cupos_ocupados = datosCurso[4]; // Almacena la cantidad de cupos ocupados por curso

                // Si la cantidad de cupos totales es menor a la de cupos ocupados
                if(parseInt(cupos_totales) <= parseInt(cupos_ocupados)) {

                    // Evita que el curso sea agregado
                    alert('El curso está lleno, por favor seleccione otro');
                    // Vacía el elemento #producto
                    $('#producto').val('');
                } else {

                    // De lo contrario (cupos ocupados < cupos totales)
                    $.ajax({

                        type: 'POST',
                        url: base_url+'movimientos/inscripciones/getParticipantesJSON/',
                        dataType: 'JSON',
                        data: {

                            // "data-id-curso" es un atributo personalizado de HTML que almacena
                            // el ID de la instancia seleccionada
                            id: $(this).attr('data-id-curso')
                        },
                        success: function( data, textStatus, jQxhr ) {

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

                            if(existe) {

                                alert('El participante ya está registrado en esta instancia.');
                            }
                            else if(!existe) 
                            {    
                                html = '<tr>';
                                html += '<td><input class="curso-id" type="hidden" name="id-instancias[]" value="'+datosCurso[0]+'">'+datosCurso[0]+'</td>';
                                html += '<td><input type="hidden" name="nombrescursos[]" value="'+datosCurso[1]+'">'+datosCurso[1]+'</td>';
                                html += '<td><input type="hidden" name="cuposcursos[]" value="'+datosCurso[2]+'">'+datosCurso[2]+'</td>';
                                html += '<td><input type="hidden" name="cuposIntanciaOcupados[]" value="'+datosCurso[4]+'">' + datosCurso[4] + '</td>';
                                html += '<td><input type="hidden" name="precioactualcursos[]" value="'+datosCurso[3]+'">' + datosCurso[3] + '</td>';

                                html += '<td><button type="button" class="btn btn-danger btn-remove-curso"><span class="fa fa-remove"></span></button></td>'
                                html += '</tr>';

                                $('#tabla-instancias tbody').append(html);

                                // Verifica el estado del atributo "disabled" del botón clickeado 
                                switchGuardarInscripcion();

                                // Vacía al elemento Producto
                                $('#producto').val('');

                                sumar();

                            }
                        },
                        error: function( jqXhr, textStatus, errorThrown ) {
                            console.log( errorThrown );
                        }
                    }); 
                }
            }
            else
            {

                alert('Seleccione una instancia');
            }
        });

        $(document).on('click', '.btn-remove-curso', function() {

            $(this).closest('tr').remove();

            // Verifica que el contenido del nodo <tr> tenga contenido
            if($('#tabla-instancias tr').length <= 1) 
            {
                $('#guardar-inscripcion').attr('disabled', true);
            }

            
        });

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
                url: base_url + 'movimientos/inscripciones/view',
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
                url: base_url + 'administrador/usuarios/view',
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

        $(document).on('click', '.btn-view-instancia', function() {

            let id_instancia = $(this).val();
            $.ajax({
                url: base_url + 'gestion/instancias/view',
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

    // Función utilizada para generar un número en el rango de 1 a 999999
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
        let costo_de_inscripcion = 0,
        deuda = 0,
        monto_pagado = 0;

       
        // -------------
        $('#tabla-pagos tbody tr').each(function() {
    
            monto_pagado += Number($(this).find('td:eq(2)').text());
        });

        $('input[name=monto-en-operacion]').val(monto_pagado.toFixed(2));

        // // --------------

        // $('#tabla-instancias tbody tr').each(function() {

        //     total = total + Number($(this).find('td:eq(4)').text());
        // });

        // deuda = total - monto_pagado;

        // $('input[name=deuda]').val(deuda);

        //     if(deuda !== 0 && deuda > 0) {
                
        //         $('input[name=deuda]').val(deuda);
        //         $('input[name=subtotal]').val('');
        //     }
        //     if(deuda == 0) {
        //         $('input[name=deuda]').val('');
        //         $('input[name=subtotal]').val('');
        //     }
        //     if(deuda < 0) {
        //         $('input[name=deuda]').val('');
        //         $('input[name=subtotal]').val(deuda*1);
        //     }

        // $('input[name=costo-de-inscripcion]').val(total.toFixed(2));
    }

    function restar() {

        let costo_de_inscripcion = 0,
        deuda = 0,
        monto_pagado = 0;

        $('#pagos-desasociados tbody tr').each(function() {
    
            monto_pagado += Number($(this).find('td:eq(2)').text());
        });

        $('input[name=monto-en-operacion]').val(monto_pagado.toFixed(2));

    }

    function switchGuardarInscripcion() {

        let theAttribute = $('#guardar-inscripcion').attr('disabled');

        if(typeof theAttribute !== typeof undefined && theAttribute !== false) {

            $('#guardar-inscripcion').removeAttr('disabled');
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
