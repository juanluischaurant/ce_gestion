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
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/personas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Persona</a>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hora de Registro</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Cédula</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($personas)): ?>
                                <?php foreach($personas as $persona): ?>
                                    <tr>
                                        <td><?php echo $persona->persona_id; ?></td>
                                        <td><?php echo $persona->fecha_registro_persona; ?></td>
                                        <td><?php echo $persona->nombres_persona; ?></td>
                                        <td><?php echo $persona->apellidos_persona; ?></td>
                                        <td><?php echo $persona->telefono_persona; ?></td>
                                        <td><?php echo $persona->cedula_persona; ?></td>
                                        <?php $dataPersona = $persona->persona_id; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-persona" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataPersona?>'><span class="fa fa-eye"></span></button>

                                                <a href="<?php echo base_url() ?>gestion/personas/edit/<?php echo $persona->persona_id; ?>" .
                                                class="btn btn-warning"><span class="fa fa-pencil"></span></a>

                                                <a href="<?php echo base_url() ?>gestion/personas/delete/<?php echo $persona->persona_id; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
