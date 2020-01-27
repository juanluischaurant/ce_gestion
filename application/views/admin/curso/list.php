<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Cursos
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
                        <a href="<?php echo base_url(); ?>gestion/curso/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Curso</a>
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
                                <?php if(!empty($cursos)): ?>
                                <?php foreach($cursos as $curso): ?>
                                    <tr>
                                        <td><?php echo $curso->serial; ?></td>
                                        <td><?php echo $curso->fecha_registro; ?></td>
                                        <td>
                                            <?php echo $curso->nombre_curso . " " . $curso->periodo_academico; ?>
                                        </td>

                                        <td>
                                        <?php $today = date('Y-m-d'); ?>
                                        <?php if($curso->estado_instancia == 1 && date($curso->fecha_culminacion_periodo) >= $today): ?>
                                            <small class="label label-success">
                                                <i class="fa fa-clock-o"></i> Activa
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($curso->estado_instancia == 0): ?>
                                            <small class="label label-danger">
                                                <i class="fa fa-clock-o"></i> Cancelada
                                            </small>
                                        <?php endif; ?> 
                                        <?php if(date($curso->fecha_culminacion_periodo) <= $today): ?>
                                            <small class="label label-warning">
                                                <i class="fa fa-clock-o"></i> Archivada
                                            </small>
                                        <?php endif; ?> 
                                        </td>

                                        <td>
                                            <?php echo $curso->nombre_turno; ?>
                                        </td>
                                        <td><?php echo $curso->total_cupos; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-curso" data-toggle='modal' data-target='#modal-default' value='<?php echo $curso->id_instancia; ?>'>
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url() ?>gestion/curso/edit/<?php echo $curso->id_instancia; ?>" class="btn btn-warning">
                                                    <span class="fa fa-pencil"></span>
                                                </a>
                                                <a href="<?php echo base_url() ?>gestion/curso/generate_pdf/<?php echo $curso->id_instancia; ?>" class="btn btn-primary btn-print" target="_blank">
                                                    <span class="fa fa-print"> </span>
                                                </a>  

                                                <!-- Botón para activar/desactivar Inscripción -->
                                                <?php if($curso->estado_instancia == 1): ?>
                                                    <a href="<?php echo base_url() ?>gestion/curso/deactivate_instancia/<?php echo $curso->id_instancia; ?>" class="btn btn-danger btn-activate-inscripcion">
                                                        <span class="fa fa-toggle-off"></span>
                                                    </a>
                                                <?php endif; ?> 
                                                <?php if($curso->estado_instancia == 0): ?>
                                                    <a href="<?php echo base_url() ?>gestion/curso/activate_instancia/<?php echo $curso->id_instancia; ?>" class="btn btn-success btn-deactivate-inscripcion">
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
        <h4 class="modal-title text-center">Información de Curso</h4>
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