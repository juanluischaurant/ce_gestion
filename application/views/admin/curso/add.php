

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Curso
        <small>Nuevo</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-warning">

            <div class="box-header with-border text-center">
              <h3 class="box-title">Datos de Nuevo Curso</h3>

              <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->
                  
            <form id="agregar_curso" action="<?php echo base_url(); ?>gestion/curso/store" method="POST">

                <div class="box-body">
                    
                    <div class="centrar_div">
                                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Nombre del Curso</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly id="nombre_curso" name="nombre_curso">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="costo_curso">Costo</label>
                                <input type="number" class="form-control" id="costo_curso" name="costo_curso">
                            </div>

                            <div class="form-group col-md-8">
                                <?php
                                    $atributos = array(
                                        'class' => 'form-control', 'required',
                                        'id' => 'periodo_curso'
                                    );
                                    // Genera la etiquera
                                    echo form_label('Período');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('periodo_curso', $lista_periodos, '', $atributos);
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
                                    // Genera la etiquera
                                    echo form_label('Locación');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('locacion_curso', $lista_locaciones, '', $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>

                            <div class="form-group col-md-4">
                                <?php
                                    $atributos = array('class' => 'form-control', 'required');
                                    // Genera la etiquera
                                    echo form_label('Turno');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('turno_curso', $lista_turnos, '', $atributos);
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
                                    // Genera la etiquera
                                    echo form_label('Facilitador');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('facilitador_curso', $lista_facilitadores, '', $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>

                            <div class="form-group col-md-4">
                                <label for="cupos_curso">Cupos</label>
                                <input type="text" name="cupos_curso" id="cupos_curso" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="descripcion_curso">Descripción</label>
                                <textarea class="form-control"  id="descripcion_curso" name="descripcion_curso" rows="4" placeholder="Ej: Enfoque en mantenimiento correctivo y preventivo"></textarea>
                            </div>    
                        </div>

                    </div>
                    <!-- /.centrar_div -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <input type="hidden" name="id_nombre_curso" id="id_nombre_curso">
                    <input type="hidden" name="serial-curso" id="serial-curso">
                    
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

<!-- Modal para lista de nombres de curso -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Especialidades</h4>
            </div>
            <div class="modal-body">
                <table id="lista-nombre_curso" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha de Registro</th>
                            <th>Nombre</th>
                            <th>Usado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($nombres_curso)): ?>
                        <?php foreach($nombres_curso as $nombre_curso): ?>
                            <tr>
                                <td><?php echo $nombre_curso->id; ?></td>
                                <td><?php echo $nombre_curso->fecha_registro; ?></td>
                                <td><?php echo $nombre_curso->descripcion; ?></td>
                                <?php $dataCurso = $nombre_curso->id.'*'.$nombre_curso->descripcion.'*'.$nombre_curso->estado.'*'.$nombre_curso->conteo_uso; ?>
                                <td><?php  echo $nombre_curso->conteo_uso; ?></td>
                               <td>
                                    <button type='button' class='btn btn-success btn-check-nombre-curso' value='<?php echo $dataCurso; ?>'><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/curso.add.js"></script>

