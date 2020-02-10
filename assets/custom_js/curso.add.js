$(document).ready(function() {

    $('#lista-nombre_curso').DataTable({
        "order": [[ 1, "desc" ]]
    });

    /**
    * Genera un serial para el curso al momento de presionar el botón indicado
    */
    $(document).on('click', '.btn-check-nombre-curso', function() {

        let nombre_curso = $(this).val();
        let infoNombreCurso = nombre_curso.split('*');

        let conteoUso = infoNombreCurso[3],
        nombreCurso = infoNombreCurso[1];

        let id_curso = infoNombreCurso[0],
        prefijo = nombreCurso.substring(0, 3);

        $('#serial-curso').val(prefijo.toUpperCase()+'-'+id_curso+'-'+generarNumero(conteoUso));

        $('#id_nombre_curso').val(id_curso);
        $('#nombre_curso').val(nombreCurso);

        $('#modal-default').modal('hide');
    });

    /**
     * La variable base_url utiizada por dentro del método autocomplete
     * se declara en el header del documento para que sea acccesible 
     * a lo largo de todos los archivos JS.
     */
    
    $('#periodo-curso').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url+'gestion/curso/getPeriodosJSON',
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
            let data = ui.item.id_periodo;
            $('#id-periodo-curso').val(data);
            $('#periodo-curso').parent().addClass('has-success');
            $('label[for="periodo-curso"] i').removeClass('hidden');

        }
    });
    
    $('#locacion-curso').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url+'gestion/curso/getLocacionesJSON',
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
            $('#id-locacion-curso').val(data);
            $('#locacion-curso').parent().addClass('has-success');
            $('label[for="locacion-curso"] i').removeClass('hidden');
        }
    });
    
    $('#facilitador-curso').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url+'gestion/curso/getFacilitadoresJSON',
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
            $('#id-facilitador-curso').val(data);
            $('#facilitador-curso').parent().addClass('has-success');
            $('label[for="facilitador-curso"] i').removeClass('hidden');
        }
    });

    $('#agregar_curso').bootstrapValidator({
        fields: {
            nombre_curso: {
                validators: {
                    stringLength: {
                        min: 5,
                        max: 45,
                        message:'Ingrese entre 5 y 85 caractéres'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            costo_curso: {
                validators: {
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            periodo_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            locacion_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            turno_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            facilitador_curso: {
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            cupos_curso: {
                validators: {
                    numeric: {
                        message: 'Ingrese solo valores numéricos'
                    },
                    notEmpty: {
                        message: 'Campo obligatorio'
                    },
                }
            },
            descripcion_curso: {
                validators: {
                    stringLength: {
                        max: 256,
                        message:'Ingrese máximo 256 caractéres'
                    },
                }
            },

         
        }
    });


});
