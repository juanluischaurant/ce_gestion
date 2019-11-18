<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Locaciones
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
                        <a href="<?php echo base_url(); ?>gestion/locaciones/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Locación</a>
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
                                    <th>Nombre Período</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($locaciones)): ?>
                                <?php foreach($locaciones as $locacion): ?>
                                    <?php// print_r($curso); ?> 
                                    <tr>
                                        <td><?php echo $locacion->id_locacion; ?></td>
                                        <td><?php echo $locacion->fecha_creacion; ?></td>
                                        <td><?php echo $locacion->nombre_locacion; ?></td>                                 
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><span class="fa fa-eye"></span></a>
                                                <a href="<?php echo base_url() ?>gestion/locaciones/edit/<?php echo $locacion->id_locacion; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
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