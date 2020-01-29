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

<script>
    $(document).ready(function () {

        // Activa el pluggin jQuery InputMask
        // $('[data-mask]').inputmask();

        $('.sidebar-menu').tree(); // Menú lateral

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

        // Calcula el monto en operación cada vez que se llama esta función
        let monto_en_operacion = 0;       
        
        $('#tabla-pagos tbody tr').each(function() {
    
            monto_en_operacion += Number($(this).find('td:eq(1)').text());
        });

        $('input[name=monto-en-operacion]').val(monto_en_operacion.toFixed(2));

        if($('input[name=costo-de-inscripcion]').val() !== '') {

            $('input[name=deuda]').val($('input[name=costo-de-inscripcion]').val() - $('input[name=monto-en-operacion]').val())
        }
    }

    function switchGuardarInscripcion() {

        let theAttribute = $('#btn-guardar-inscripcion').attr('disabled');

        if(typeof theAttribute !== typeof undefined && theAttribute !== false) {

            $('#btn-guardar-inscripcion').removeAttr('disabled');
        }
    }

</script>

</body>
</html>
