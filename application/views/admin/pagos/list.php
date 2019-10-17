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
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>movimientos/pagos/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Pago</a>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Número de Operación</th>
                                    <th>Monto</th>
                                    <th>Cédula Cliente</th>
                                    <th>Operación Registrada</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($pagos)): ?>
                                <?php foreach($pagos as $pago): ?>
                                    <?php// print_r($curso); ?> 
                                    <tr>
                                        <td><?php echo $pago->id_pago; ?></td>
                                        <td><?php echo $pago->numero_operacion; ?></td>
                                        <td><?php echo $pago->monto_operacion; ?></td>
                                        <td><?php echo $pago->cedula_cliente; ?></td>
                                        <td><?php echo $pago->fecha_registro_operacion; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><span class="fa fa-eye"></span></a>
                                                <a href="<?php echo base_url() ?>gestion/cursos/edit/<?php echo $pago->id_pago; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
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

<thead>
                               