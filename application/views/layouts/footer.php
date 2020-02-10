        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>CE Gestión <?php echo date('Y'); ?>.</strong> Programa lanzado bajo licencia MIT.
        </footer>
    </div>
    <!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function () {

        $('.sidebar-menu').tree(); // Menú lateral

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

    });

    /**
     * Este objeto se utiliza para traducir al español los controles
     * de DataTables a lo largo de distintos archivos JS.
     */
    const lenguaje_para_datatables = {
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
    };

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
