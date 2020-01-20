<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Facilitadores
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
                        <a href="<?php echo base_url(); ?>gestion/facilitador/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Facilitador</a>
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
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Cédula</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($facilitadores)): ?>
                                <?php foreach($facilitadores as $facilitador): ?>
                                    <tr>
                                        <td><?php echo $facilitador->id_facilitador; ?></td>
                                        <td><?php echo $facilitador->fecha_registro_facilitador; ?></td>
                                        <td><?php echo $facilitador->nombres_persona; ?></td>
                                        <td><?php echo $facilitador->apellidos_persona; ?></td>
                                        <td><?php echo $facilitador->telefono_persona; ?></td>
                                        <td><?php echo $facilitador->cedula; ?></td>
                                        <?php $dataFacilitador = $facilitador->id_facilitador.'*'.$facilitador->nombres_persona.'*'.$facilitador->apellidos_persona.'*'.$facilitador->telefono_persona.'*'.$facilitador->cedula.'*'.$facilitador->fk_id_persona_3; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-facilitador" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataFacilitador?>'><span class="fa fa-eye"></span></button>

                                                <a href="<?php echo base_url() ?>gestion/facilitador/edit/<?php echo $facilitador->id_facilitador; ?>" .
                                                class="btn btn-warning"><span class="fa fa-pencil"></span></a>

                                                <a href="<?php echo base_url() ?>gestion/facilitador/delete/<?php echo $facilitador->id_facilitador; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
        <h4 class="modal-title">Informacion del Facilitador</h4>
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
