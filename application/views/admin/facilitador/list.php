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
                        <table id="lista-facilitador" class="table table-bordered btn-hover">
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
                                <?php if(!empty($facilitadores)): ?>
                                <?php foreach($facilitadores as $facilitador): ?>
                                    <tr>
                                        <td><?php echo $facilitador->cedula_persona; ?></td>
                                        <td><?php echo $facilitador->fecha_registro; ?></td>
                                        <td><?php echo $facilitador->nombres; ?></td>
                                        <td><?php echo $facilitador->apellidos; ?></td>
                                        <td><?php echo $facilitador->telefono; ?></td>
                                        <?php $dataFacilitador = $facilitador->cedula_persona.'*'.$facilitador->fecha_registro.'*'.$facilitador->nombres.'*'.$facilitador->apellidos.'*'.$facilitador->telefono.'*'; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-facilitador" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataFacilitador?>'><span class="fa fa-eye"></span></button>

                                                <a href="<?php echo base_url() ?>gestion/facilitador/edit/<?php echo $facilitador->cedula_persona; ?>" .
                                                class="btn btn-warning"><span class="fa fa-pencil"></span></a>

                                                <a href="<?php echo base_url() ?>gestion/facilitador/delete/<?php echo $facilitador->cedula_persona; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/facilitador.list.js"></script>