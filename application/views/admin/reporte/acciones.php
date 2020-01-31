<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Acciones
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                           
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-accion" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Acción</th>
                                    <th>Usuario</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($acciones)): ?>
                                <?php foreach($acciones as $accion): ?>
                                    <tr>
                                        <td><?php echo $accion->id; ?></td>
                                        <td><?php echo $accion->fecha_registro; ?></td>
                                        <td><?php echo $accion->username; ?></td>
                                        <td><?php echo $accion->nombre . ' ' . $accion->tabla_afectada . '. ' .$accion->descripcion; ?></td>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/accion.js"></script>