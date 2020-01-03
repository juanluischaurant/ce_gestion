

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Instancia
        <small>Nueva</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <div class="row">
                    <div class="col-md-12">

                        <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url(); ?>gestion/instancias/store" method="post" class='form-horizontal'>
                            
                            <div class="form-group <?php echo !empty(form_error('nombre_curso'))? 'has-error' : '';?>">
                                <div class="col-md-6">
                                    <label for="">Seleccionar Curso:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" disabled="disabled" id="nombre-curso-instanciado">
                                        <input type="hidden" name="id-curso-instanciado" id="id-curso-instanciado">
                                        <input type="hidden" name="serial-instancia" id="serial-instancia">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div> 

                                <div class="col-md-4">
                                    <label for="">Costo:</label>
                                    <input type="number" class="form-control" id="costo-instancia" name="costo-instancia">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="">Período:</label>
                                    <input type="text" class="form-control" id="periodo-instancia">
                                    <input type="hidden" id="id-periodo-instancia" name="id-periodo-instancia">  
                                </div>

                                <div class="col-md-6 <?php echo !empty(form_error('numero-de-operacion')) ? 'has-error' : ''; ?>">
                                    <label for="locacion-instancia">Locación:</label>
                                    <input type="text" class="form-control" id="locacion-instancia">
                                    <input type="hidden" id="id-locacion-instancia" name="id-locacion-instancia">  
                                    <?php echo form_error('numero-de-operacion', '<span class="help-block">', '</span>'); ?>
                                </div>

                                <div class="col-md-2">
                                    <?php

                                        $atributos = array('class' => 'form-control', 'required');
                                        // Genera la etiquera
                                        echo form_label('Turno:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                        echo form_dropdown('turno-instancia', $lista_turnos, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div>

                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="profesor-instancia">Facilitador: </label>
                                    <input type="text" id="profesor-instancia" class="form-control">
                                    <input type="hidden" id="id-profesor-instancia" name="id-profesor-instancia">  
                                </div>
                                <div class="col-md-2">
                                    <label for="cupos-curso">Cupos: </label>
                                    <input type="text" name="cupos-instancia" id="cupos-instancia" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="descripcion-instancia">Descripción: </label>
                                    <input type="text" name="descripcion-instancia" id="descripcion-instancia" class="form-control">
                                </div>    
                            </div>

                            <div class="form-group"> 
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Modal para lista de cursos -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Cursos</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Curso</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($cursos)): ?>
                        <?php foreach($cursos as $curso): ?>
                            <tr>
                                <td><?php echo $curso->id_curso; ?></td>
                                <td><?php echo $curso->nombre_curso; ?></td>
                                <td><?php echo $curso->descripcion_curso; ?></td>
                                <?php $dataCurso = $curso->id_curso.'*'.$curso->nombre_curso.'*'.$curso->estado_curso.'*'.$curso->veces_instanciado; ?>
                                <td>
                                    <button type='button' class='btn btn-success btn-check-curso-instanciado' value='<?php echo $dataCurso; ?>'><span class="fa fa-check"></span></button>
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
