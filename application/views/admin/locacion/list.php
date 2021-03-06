<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Locaciones
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-pencil"></i> ¡Éxito!</h4>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('alert')): ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> ¡Alerta!</h4>
            <?php echo $this->session->flashdata('alert'); ?>
        </div>
        <?php endif;?>

        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                <?php if($permisos->insert == 1): ?>
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/locacion/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Locación</a>
                    </div>
                <?php endif; ?>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-locacion" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Nombre Período</th>
                                    <th>Cursos Asociadas</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($locaciones)): ?>
                                <?php foreach($locaciones as $locacion): ?>
                                <tr>
                                    
                                    <td><?php echo $locacion->id; ?></td>
                                    <td><?php echo $locacion->fecha_registro; ?></td>
                                    <td><?php echo $locacion->nombre; ?></td>                                 
                                    <td><?php echo $locacion->instancias_asociadas; ?></td>                                 
                                    <td>
                                        <div class="btn-group">
                                            <button type='button' value="<?php echo $locacion->id; ?>" class="btn btn-info btn-view-locacion" data-toggle='modal' data-target='#modal-default'>
                                                <span class="fa fa-eye"></span>
                                            </button>

                                            <?php if($permisos->update == 1): ?>
                                            <a href="<?php echo base_url() ?>gestion/locacion/edit/<?php echo $locacion->id; ?>" class="btn btn-warning">
                                                <span class="fa fa-pencil"></span>
                                            </a>

                                            <!-- Botón para activar/desactivar Inscripción -->
                                            <?php $estado_locacion = $locacion->estado; ?>
                                            <?php if($estado_locacion == 1): ?>
                                                <a href="<?php echo base_url() ?>gestion/locacion/deactivate_location/<?php echo $locacion->id; ?>" class="btn btn-danger">
                                                    <span class="fa fa-toggle-off"></span>
                                                </a>
                                            <?php endif; ?> 
                                            <?php if($estado_locacion == 0): ?>
                                                <a href="<?php echo base_url() ?>gestion/locacion/activate_location/<?php echo $locacion->id; ?>" class="btn btn-success">
                                                    <span class="fa fa-toggle-on"></span>
                                                </a>
                                            <?php endif; ?> 
                                            <!-- Fin: Botón para activar/desactivar Inscripción -->
                                            <?php endif; ?>
                                           
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

<!-- Inicio de modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Información de Locación</h4>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/locacion.list.js"></script>