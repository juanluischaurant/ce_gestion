<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pagos
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">

                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                    </div>
                <?php endif;?>

                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>movimientos/pago/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Pago</a>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Regisro</th>
                                    <th>Número de Operación</th>
                                    <th>Monto (Bs.)</th>
                                    <th>Estado</th>
                                    <th>Cédula Cliente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($pagos)): ?>
                                <?php foreach($pagos as $pago): ?>
                                    <?php  $id_pago = $pago->id_pago; ?>
                                    <tr>
                                        <td><?php echo $id_pago ?></td>
                                        <td><?php echo $pago->fecha_registro_operacion; ?></td>
                                        <td><?php echo ($pago->numero_operacion == NULL) ? 'No Aplica' : $pago->numero_operacion; ?></td>
                                        <td><?php echo ($pago->monto_operacion == '') ? '0.00' : $pago->monto_operacion; ?></td>
                                        
                                        <td>
                                        <?php if($pago->estado_pago == 1): ?>
                                            <small class="label label-success">
                                                <i class="fa fa-clock-o"></i> Disponible
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($pago->estado_pago == 2): ?>
                                            <small class="label label-danger">
                                                <i class="fa fa-clock-o"></i> Usado
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($pago->estado_pago == 3): ?>
                                            <small class="label label-warning">
                                                <i class="fa fa-clock-o"></i> Liberado
                                            </small>
                                        <?php endif; ?> 
                                        </td>

                                        <td>
                                            <?php echo $pago->cedula; ?>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-pago" data-toggle='modal' data-target='#modal-default' value='<?php echo $id_pago ?>'>
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <a href="<?php echo base_url() ?>movimientos/pago/edit/<?php echo $id_pago; ?>" class="btn btn-warning">
                                                    <span class="fa fa-pencil"></span>
                                                </a>
                                                <a href="#" class="btn btn-danger">
                                                    <span class="fa fa-remove"></span>
                                                </a>
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
        <h4 class="modal-title text-center">Información de Pago</h4>
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

                               