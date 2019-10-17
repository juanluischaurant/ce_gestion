<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Participantes
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
                        <a href="<?php echo base_url(); ?>gestion/participantes/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Participante</a>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Cédula</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($participantes)): ?>
                                <?php foreach($participantes as $participante): ?>
                                    <tr>
                                        <td><?php echo $participante->id_cliente; ?></td>
                                        <td><?php echo $participante->nombres_cliente; ?></td>
                                        <td><?php echo $participante->apellidos_cliente; ?></td>
                                        <td><?php echo $participante->telefono_cliente; ?></td>
                                        <td><?php echo $participante->cedula_cliente; ?></td>
                                        <?php $dataParticipante = $participante->id_cliente.'*'.$participante->nombres_cliente.'*'.$participante->apellidos_cliente.'*'.$participante->telefono_cliente.'*'.$participante->cedula_cliente; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-participante" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataParticipante?>'><span class="fa fa-eye"></span></button>
                                                <a href="<?php echo base_url() ?>gestion/participantes/edit/<?php echo $participante->id_cliente; ?>" .
                                                class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                <a href="#" class="btn btn-danger"><span class="fa fa-remove"></span></a>
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
        <h4 class="modal-title">Informacion del Participante</h4>
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
