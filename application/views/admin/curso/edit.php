

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Curso
        <small>Editar</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-warning">

            <div class="box-header with-border text-center">
              <h3 class="box-title">Datos de <?php echo $curso->serial; ?></h3>

              <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->
                  
            <form id="editar_curso" action="<?php echo base_url(); ?>gestion/curso/update" method="POST">

                <div class="box-body">
                    
                    <div class="centrar_div">
                                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Nombre del Curso</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled="disabled" id="nombre_curso" value="<?php echo $curso->descripcion; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" disabled><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="costo_curso">Costo</label>
                                <input type="number" value="<?php echo intval($curso->precio); ?>" class="form-control" id="costo_curso" name="costo_curso">
                            </div>

                            <div class="form-group col-md-8">
                                <?php
                                    $atributos = array(
                                        'class' => 'form-control', 'required',
                                        'id' => 'periodo_curso'
                                    );
                                    $selected = $curso->id_periodo;

                                    // Genera la etiquera
                                    echo form_label('Período');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('periodo_curso', $lista_periodos, $selected, $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-md-8">
                                <?php
                                    $atributos = array(
                                        'class' => 'form-control', 'required',
                                        'id' => 'locacion_curso'
                                    );

                                    $selected = $curso->id_locacion;
                                    // Genera la etiquera
                                    echo form_label('Locación');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('locacion_curso', $lista_locaciones, $selected, $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>

                            <div class="form-group col-md-4">
                                <?php
                                    $atributos = array('class' => 'form-control', 'required');
                                    // Genera la etiquera
                                    echo form_label('Turno');

                                    $selected = $curso->id_turno;

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('turno_curso', $lista_turnos, $selected, $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-8">
                                <?php
                                    $atributos = array(
                                        'class' => 'form-control', 'required',
                                        'id' => 'facilitador_curso'
                                    );
                                    $selected = $curso->cedula_facilitador;
                                    // Genera la etiquera
                                    echo form_label('Facilitador');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('facilitador_curso', $lista_facilitadores, $selected, $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>

                            <div class="form-group col-md-4">
                                <label for="cupos_curso">Cupos</label>
                                <input type="text" name="cupos_curso" id="cupos_curso" class="form-control" value="<?php echo $curso->cupos; ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="descripcion_curso">Descripción</label>
                                <textarea class="form-control"  id="descripcion_curso" name="descripcion_curso" rows="4" placeholder="Ej: Enfoque en mantenimiento correctivo y preventivo"><?php echo $curso->detalles_curso; ?></textarea>
                            </div>    
                        </div>

                    </div>
                    <!-- /.centrar_div -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <input type="hidden" id="id-periodo-curso" name="id-periodo-curso" value="<?php echo $curso->id_periodo; ?>">  
                    <input type="hidden" id="id-locacion-curso" name="id-locacion-curso" value="<?php echo $curso->id_locacion; ?>">  
                    <input type="hidden" id="id-facilitador-curso" name="id-facilitador-curso" value="<?php echo $curso->cedula_persona; ?>">
                    <!-- <input type="hidden" name="id_nombre_curso" id="id_nombre_curso"> -->
                    <input type="hidden" name="serial-curso" id="serial-curso" value="<?php echo $curso->serial; ?>">
                    <input type="hidden" name="id-curso" id="id-curso" value="<?php echo $curso->id; ?>">
                    
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>

                </div>
                <!-- .box-footer -->

            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/curso.edit.js"></script>

