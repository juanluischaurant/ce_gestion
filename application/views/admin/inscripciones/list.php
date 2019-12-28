<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inscripciones
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>movimientos/inscripciones/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Inscripción</a>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Instancia</th>
                                    <th>Estado Inscripción</th>
                                    <th>Nombre Participante</th>
                                    <th>Cédula Participante</th>
                                    <th>Opciones</th>
                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($inscripciones)): ?>
                                <?php foreach($inscripciones as $inscripcion): ?>
                                    
                                    <?php $inscripcion_activa = $inscripcion->activa; ?>
                                    <tr>
                                        <td><?php echo $inscripcion->fk_id_inscripcion_1; ?></td>
                                        <td><?php echo $inscripcion->hora_inscripcion; ?></td>
                                        <td><?php echo $inscripcion->nombre_completo_instancia; ?></td>

                                        <td>
                                            <?php if($inscripcion_activa== 1): ?>
                                                <small class="label label-success">
                                                    <i class="fa fa-clock-o"></i> Activa
                                                </small>
                                            <?php endif; ?> 
                                            <?php if($inscripcion_activa == 0): ?>
                                                <small class="label label-danger">
                                                    <i class="fa fa-clock-o"></i> Inactiva
                                                </small>
                                            <?php endif; ?> 
                                        </td>

                                        <td><?php echo $inscripcion->nombre_completo_participante; ?></td>
                                        <td><?php echo $inscripcion->cedula_persona; ?></td>
                                        <?php $dataInscripcion =  $inscripcion->fk_id_instancia_1; ?>

                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-inscripcion" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataInscripcion; ?>'>
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url() ?>movimientos/inscripciones/edit/<?php echo $inscripcion->fk_id_inscripcion_1; ?>" class="btn btn-warning">
                                                    <span class="fa fa-pencil"></span>
                                                </a>

                                                <!-- Botón para activar/desactivar Inscripción -->
                                                <?php if($inscripcion_activa == 1): ?>
                                                    <a href="<?php echo base_url() ?>movimientos/inscripciones/deactivate_inscripcion/<?php echo $inscripcion->fk_id_inscripcion_1; ?>/<?php echo $dataInscripcion; ?>" class="btn btn-danger btn-activate-inscripcion">
                                                        <span class="fa fa-toggle-off"></span>
                                                    </a>
                                                <?php endif; ?> 
                                                <?php if($inscripcion_activa == 0): ?>
                                                    <a href="<?php echo base_url() ?>movimientos/inscripciones/activate_inscripcion/<?php echo $inscripcion->fk_id_inscripcion_1; ?>/<?php echo $dataInscripcion; ?>" class="btn btn-success btn-deactivate-inscripcion">
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


<!-- modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Ficha de Inscripción</h4>
      </div>
      <div class="modal-body">
        
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
