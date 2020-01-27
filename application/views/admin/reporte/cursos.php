<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Especialidades
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
                        <table id="export-especialidades" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($especialidades)): ?>
                                <?php foreach($especialidades as $especialidad): ?>
                                    <tr>
                                        <td><?php echo $especialidad->id_curso; ?></td>
                                        <td><?php echo $especialidad->nombre_curso; ?></td>
                                        <td><?php echo $especialidad->descripcion_curso; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><span class="fa fa-eye"></span></a>
                                                <a href="<?php echo base_url() ?>gestion/especialidad/edit/<?php echo $especialidad->id_curso; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
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