<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Personas
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <?php if($permisos->insert == 1): ?>
                    <div class="row">
                    <?php if($permisos->insert == 1): ?>
                        <div class="col-md-12">
                            <a href="<?php echo base_url(); ?>gestion/persona/add" class="btn btn-primary btn-flat">
                                <span class="fa fa-plus"></span> Agregar Persona
                            </a>
                        </div>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <hr>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-pencil"></i> ¡Error!</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-pencil"></i> ¡Bien Hecho!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-persona" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>Cédula</th>
                                    <th>Fecha de Registro</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($personas)): ?>
                                <?php foreach($personas as $persona): ?>
                                    <tr>
                                        <td><?php echo $persona->cedula; ?></td>
                                        <td><?php echo $persona->fecha_registro; ?></td>
                                        <td><?php echo $persona->primer_nombre; ?></td>
                                        <td><?php echo $persona->primer_apellido; ?></td>
                                        <td><?php echo $persona->telefono; ?></td>
                                        <?php $cedula = $persona->cedula; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-persona" data-toggle='modal' data-target='#modal-default' value='<?php echo $cedula?>'><span class="fa fa-eye"></span></button>

                                                <?php if($permisos->update == 1): ?>
                                                    <a href="<?php echo base_url().'gestion/persona/edit/'.$cedula; ?>" class="btn btn-warning">
                                                        <span class="fa fa-pencil"></span>
                                                    </a>
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


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Información de Persona</h4>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/persona.list.js"></script>
