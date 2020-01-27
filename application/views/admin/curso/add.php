

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Curso
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

                        <form action="<?php echo base_url(); ?>gestion/curso/store" method="post" class='form-horizontal'>
                            
                            <div class="form-group <?php echo !empty(form_error('nombre_curso'))? 'has-error' : '';?>">
                                <div class="col-md-6">
                                    <label for="">Seleccionar Especialidad:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" disabled="disabled" id="nombre-especialidad-instanciado">
                                        <input type="hidden" name="id-especialidad-instanciado" id="id-especialidad-instanciado">
                                        <input type="hidden" name="serial-curso" id="serial-curso">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div> 

                                <div class="col-md-4">
                                    <label for="">Costo:</label>
                                    <input type="number" class="form-control" id="costo-curso" name="costo-curso">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="">Período:</label>
                                    <input type="text" class="form-control" id="periodo-curso">
                                    <input type="hidden" id="id-periodo-curso" name="id-periodo-curso">  
                                </div>

                                <div class="col-md-6 <?php echo !empty(form_error('numero-de-operacion')) ? 'has-error' : ''; ?>">
                                    <label for="locacion-curso">Locación:</label>
                                    <input type="text" class="form-control" id="locacion-curso">
                                    <input type="hidden" id="id-locacion-curso" name="id-locacion-curso">  
                                    <?php echo form_error('numero-de-operacion', '<span class="help-block">', '</span>'); ?>
                                </div>

                                <div class="col-md-2">
                                    <?php

                                        $atributos = array('class' => 'form-control', 'required');
                                        // Genera la etiquera
                                        echo form_label('Turno:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: nombre, valores de la lista, '', atributos
                                        echo form_dropdown('turno-curso', $lista_turnos, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div>

                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="facilitador-curso">Facilitador: </label>
                                    <input type="text" id="facilitador-curso" class="form-control">
                                    <input type="hidden" id="id-facilitador-curso" name="id-facilitador-curso">  
                                </div>
                                <div class="col-md-2">
                                    <label for="cupos-especialidad">Cupos: </label>
                                    <input type="text" name="cupos-curso" id="cupos-curso" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="descripcion-curso">Descripción: </label>
                                    <input type="text" name="descripcion-curso" id="descripcion-curso" class="form-control">
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



<!-- Modal para lista de especialidades -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Especialidades</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Especialidad</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($especialidades)): ?>
                        <?php foreach($especialidades as $especialidad): ?>
                            <tr>
                                <td><?php echo $especialidad->id; ?></td>
                                <td><?php echo $especialidad->nombre; ?></td>
                                <td><?php echo $especialidad->descripcion; ?></td>
                                <?php $dataCurso = $especialidad->id.'*'.$especialidad->nombre.'*'.$especialidad->estado.'*'.$especialidad->instancias_asociadas; ?>
                                <td>
                                    <button type='button' class='btn btn-success btn-check-especialidad-instanciado' value='<?php echo $dataCurso; ?>'><span class="fa fa-check"></span></button>
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
