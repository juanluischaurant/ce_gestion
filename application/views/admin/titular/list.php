<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Titulares
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <?php if($permisos->insert == 1): ?>
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/titular/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Titular</a>
                    </div>
                    <?php endif; ?>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-titular" class="table table-bordered btn-hover">
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
                                <?php if(!empty($titulares)): ?>
                                <?php foreach($titulares as $titular): ?>
                                    <tr>
                                        <td><?php echo $titular->cedula_persona; ?></td>
                                        <td><?php echo $titular->fecha_registro_titular; ?></td>
                                        <td><?php echo $titular->primer_nombre; ?></td>
                                        <td><?php echo $titular->primer_apellido; ?></td>
                                        <td><?php echo $titular->telefono; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-titular" data-toggle='modal' data-target='#modal-default' value='<?php echo $titular->cedula_persona?>'>
                                                    <span class="fa fa-eye"></span>
                                                </button>

                                                <?php if($permisos->update == 1): ?>
                                                    <a href="<?php echo base_url() ?>gestion/titular/edit/<?php echo $titular->cedula_persona; ?>" .
                                                    class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <a href="#" class="btn btn-danger"><span class="fa fa-remove"></span></a>
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
        <h4 class="modal-title text-center">Informacion del Titular</h4>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/titular.list.js"></script>