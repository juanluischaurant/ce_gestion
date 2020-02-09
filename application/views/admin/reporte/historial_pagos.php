<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Historial de Pagos
        <small>Reporte General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Rango de fecha -->
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Selecciona un rango de fecha</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo current_url();?>" method="POST" class="form">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Desde</label>
                                <input type="date" class="form-control" name="fecha_inicio" value="<?php echo !empty($fecha_inicio) ? $fecha_inicio : '';?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hasta</label>
                                <input type="date" class="form-control" name="fecha_fin" value="<?php  echo !empty($fecha_fin) ? $fecha_fin:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" name="buscar" value="buscar">
                                <span class="fa fa-search"></span>
                            </button>    
        
                            <a href="<?php echo base_url(); ?>reportes/historial_pagos" class="btn btn-danger">
                                <span class="fa fa-repeat"></span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
 

        <div class="box box-solid">    
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-pago" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Regisro</th>
                                    <th>Número de Operación</th>
                                    <th>Monto (Bs.)</th>
                                    <th>Estatus</th>
                                    <th>Cédula Cliente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($pagos)): ?>
                                <?php foreach($pagos as $pago): ?>
                                    <?php  $id_pago = $pago->id; ?>
                                    <tr>
                                        <td><?php echo $id_pago; ?></td>
                                        <td><?php echo $pago->fecha_registro; ?></td>
                                        <td><?php echo ($pago->numero_referencia_bancaria == NULL) ? 'No Aplica' : $pago->numero_referencia_bancaria; ?></td>
                                        <td><?php echo ($pago->monto_operacion == '') ? '0.00' : $pago->monto_operacion; ?></td>
                                        
                                        <td>
                                        <?php if($pago->estatus_pago == 1): ?>
                                            <small class="label label-success">
                                                <i class="fa fa-clock-o"></i> Disponible
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($pago->estatus_pago == 2): ?>
                                            <small class="label label-danger">
                                                <i class="fa fa-clock-o"></i> Usado
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($pago->estatus_pago == 3): ?>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/reporte.pago.js"></script>


                               