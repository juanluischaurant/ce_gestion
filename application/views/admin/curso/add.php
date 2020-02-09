

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
                  
            <form action="<?php echo base_url(); ?>gestion/curso/store" method="POST">

                <div class="box-body">
                    
                    <div class="centrar_div">
                                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Nombre del Curso</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled="disabled" id="nombre-curso">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="costo-curso">Costo</label>
                                <input type="number" class="form-control" id="costo-curso" name="costo-curso">
                            </div>

                            <div class="col-md-8">
                                <label for="">Período</label>
                                <input type="text" class="form-control" id="periodo-curso">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="locacion-curso">Locación</label>
                                <input type="text" class="form-control" id="locacion-curso">
                            </div>

                            <div class="col-md-4">
                                <?php
                                    $atributos = array('class' => 'form-control', 'required');
                                    // Genera la etiquera
                                    echo form_label('Turno');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                    echo form_dropdown('turno-curso', $lista_turnos, '', $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="facilitador-curso">Facilitador</label>
                                <input type="text" id="facilitador-curso" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="cupos-especialidad">Cupos</label>
                                <input type="text" name="cupos-curso" id="cupos-curso" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="descripcion-curso">Descripción</label>
                                <input type="text" name="descripcion-curso" id="descripcion-curso" class="form-control">
                            </div>    
                        </div>

                    </div>
                    <!-- /.centrar_div -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <input type="hidden" id="id-periodo-curso" name="id-periodo-curso">  
                    <input type="hidden" id="id-locacion-curso" name="id-locacion-curso">  
                    <input type="hidden" id="id-facilitador-curso" name="id-facilitador-curso">
                    <input type="hidden" name="id-nombre-curso" id="id-nombre-curso">
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
                <table id="lista-nombre-curso" class="table table-bordered table-striped table-hover">
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

