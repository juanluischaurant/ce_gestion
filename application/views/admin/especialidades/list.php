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
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/especialidad/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Especialidad</a>
                    </div>
                </div>
                
                <hr>

                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-pencil"></i> ¡Bien Hecho!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($especialidades)): ?>
                                <?php foreach($especialidades as $especialidad): ?>
                                    <tr>
                                        <td><?php echo $especialidad->id; ?></td>
                                        <td><?php echo $especialidad->fecha_registro; ?></td>
                                        <td><?php echo $especialidad->nombre; ?></td>
                                        <td><?php echo $especialidad->descripcion; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><span class="fa fa-eye"></span></a>
                                                <a href="<?php echo base_url() ?>gestion/especialidad/edit/<?php echo $especialidad->id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
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