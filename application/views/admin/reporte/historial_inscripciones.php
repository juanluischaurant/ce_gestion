<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Historial de Inscripciones
        <small>Reporte General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Rango de fecha -->
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Selecciona un rango de fecha</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo current_url();?>" method="POST" class="form">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Desde</label>
                                <input type="date" class="form-control" name="fecha_inicio" value="<?php echo !empty($fecha_inicio) ? $fecha_inicio : '';?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hasta</label>
                                <input type="date" class="form-control" name="fecha_fin" value="<?php  echo !empty($fecha_fin) ? $fecha_fin:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" name="buscar" value="buscar">
                                <span class="fa fa-search"></span>
                            </button>    
        
                            <a href="<?php echo base_url(); ?>reportes/historial_inscripciones" class="btn btn-danger">
                                <span class="fa fa-repeat"></span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <?php if($this->session->flashdata('alert')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> ¡Alerta!</h4>
                        <?php echo $this->session->flashdata('alert'); ?>
                    </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-pencil"></i> ¡Éxito!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-inscripcion" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Curso</th>
                                    <th>Estado Inscripción</th>
                                    <th>Nombre Participante</th>
                                    <th>Cédula Participante</th>
                                    <th>Opciones</th>
                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($inscripciones)): ?>
                                <?php foreach($inscripciones as $inscripcion): ?>
                                    
                                    <?php $inscripcion_activa = $inscripcion->estado; ?>
                                    <tr>
                                        <td><?php echo $inscripcion->id; ?></td>
                                        <td><?php echo $inscripcion->fecha_registro; ?></td>
                                        <td><?php echo $inscripcion->nombre_completo_instancia; ?></td>

                                        <td>
                                            <?php if($inscripcion_activa == 1 && $inscripcion->valida_hasta <= date('Y-m-d')): ?>
                                                <small class="label label-warning">
                                                    <i class="fa fa-folder-o"></i> Archivada
                                                </small>
                                            <?php endif; ?>
                                            <?php if($inscripcion_activa == 1 && $inscripcion->valida_hasta > date('Y-m-d')): ?>
                                                <small class="label label-success">
                                                    <i class="fa fa-clock-o"></i> Activa
                                                </small>
                                            <?php endif; ?> 
                                            <?php if($inscripcion_activa == 0): ?>
                                                <small class="label label-danger">
                                                    <i class="fa fa-clock-o"></i> Inactiva
                                                </small>
                                            <?php endif; ?> 

                                            <?php if($inscripcion->conteo_pagos_asociados == 0): ?>
                                                <small class="label label-danger">
                                                    Sin Pagar
                                                </small>
                                            <?php endif; ?> 
                                            <?php if($inscripcion->conteo_pagos_asociados >= 1): ?>
                                                <small class="label label-warning">
                                                    Pagos <?php echo $inscripcion->conteo_pagos_asociados; ?>
                                                </small>
                                            <?php endif; ?> 
                                        </td>

                                        <td><?php echo $inscripcion->nombre_completo_participante; ?></td>
                                        <td><?php echo $inscripcion->cedula_participante; ?></td>
                                        <?php $dataInscripcion =  $inscripcion->id_curso.'*'.$inscripcion->id; ?>

                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-inscripcion" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataInscripcion; ?>'>
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url() ?>movimientos/inscripcion/edit/<?php echo $inscripcion->id; ?>/<?php echo $inscripcion_activa; ?>" class="btn btn-warning">
                                                    <span class="fa fa-pencil"></span>
                                                </a>

                                                <!-- Botón para activar/desactivar Inscripción -->
                                                <?php if($inscripcion_activa == 1): ?>
                                                    <a href="<?php echo base_url() ?>movimientos/inscripcion/deactivate_inscripcion/<?php echo $inscripcion->id; ?>/<?php echo $inscripcion->id_curso; ?>" class="btn btn-danger btn-activate-inscripcion">
                                                        <span class="fa fa-toggle-off"></span>
                                                    </a>
                                                <?php endif; ?> 
                                                <?php if($inscripcion_activa == 0): ?>
                                                    <a href="<?php echo base_url() ?>movimientos/inscripcion/activate_inscripcion/<?php echo $inscripcion->id; ?>/<?php echo $inscripcion->id_curso; ?>" class="btn btn-success btn-deactivate-inscripcion">
                                                        <span class="fa fa-toggle-on"></span>
                                                    </a>
                                                <?php endif; ?> 
                                                <!-- Fin: Botón para activar/desactivar Inscripción -->

                                            </div>
                                        </td>
                                    </tr>
                                   
                                 <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>

                        </table>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Información de Pago</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/reporte.inscripcion.js"></script>


                               