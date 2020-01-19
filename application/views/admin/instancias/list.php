<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Instancias
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-pencil"></i> ¡Éxito!</h4>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/instancia/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Instancia</a>
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
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Turno</th>
                                    <th>Cupos</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($instancias)): ?>
                                <?php foreach($instancias as $instancia): ?>
                                    <tr>
                                        <td><?php echo $instancia->serial_instancia; ?></td>
                                        <td><?php echo $instancia->fecha_creacion; ?></td>
                                        <td>
                                            <?php echo $instancia->nombre_curso . " " . $instancia->periodo_academico; ?>
                                        </td>

                                        <td>
                                        <?php $today = date('Y-m-d'); ?>
                                        <?php if($instancia->estado_instancia == 1 && date($instancia->fecha_culminacion_periodo) >= $today): ?>
                                            <small class="label label-success">
                                                <i class="fa fa-clock-o"></i> Activa
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($instancia->estado_instancia == 0): ?>
                                            <small class="label label-danger">
                                                <i class="fa fa-clock-o"></i> Cancelada
                                            </small>
                                        <?php endif; ?> 
                                        <?php if(date($instancia->fecha_culminacion_periodo) <= $today): ?>
                                            <small class="label label-warning">
                                                <i class="fa fa-clock-o"></i> Archivada
                                            </small>
                                        <?php endif; ?> 
                                        </td>

                                        <td>
                                            <?php echo $instancia->nombre_turno; ?>
                                        </td>
                                        <td><?php echo $instancia->total_cupos; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-instancia" data-toggle='modal' data-target='#modal-default' value='<?php echo $instancia->id_instancia; ?>'>
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url() ?>gestion/instancia/edit/<?php echo $instancia->id_instancia; ?>" class="btn btn-warning">
                                                    <span class="fa fa-pencil"></span>
                                                </a>
                                                <a href="<?php echo base_url() ?>gestion/instancia/generate_pdf/<?php echo $instancia->id_instancia; ?>" class="btn btn-primary btn-print" target="_blank">
                                                    <span class="fa fa-print"> </span>
                                                </a>  

                                                <!-- Botón para activar/desactivar Inscripción -->
                                                <?php if($instancia->estado_instancia == 1): ?>
                                                    <a href="<?php echo base_url() ?>gestion/instancia/deactivate_instancia/<?php echo $instancia->id_instancia; ?>" class="btn btn-danger btn-activate-inscripcion">
                                                        <span class="fa fa-toggle-off"></span>
                                                    </a>
                                                <?php endif; ?> 
                                                <?php if($instancia->estado_instancia == 0): ?>
                                                    <a href="<?php echo base_url() ?>gestion/instancia/activate_instancia/<?php echo $instancia->id_instancia; ?>" class="btn btn-success btn-deactivate-inscripcion">
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
        <h4 class="modal-title text-center">Información de Instancia</h4>
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