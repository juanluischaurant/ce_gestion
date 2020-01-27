<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permisos
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
                        <a href="<?php echo base_url(); ?>administrador/permiso/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Permiso</a>
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
                                    <th>Menú</th>
                                    <th>Rol</th>
                                    <th>Leer</th>
                                    <th>Insertar</th>
                                    <th>Actualizar</th>
                                    <th>Eliminar</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($permisos)): ?>
                                <?php foreach($permisos as $permiso): ?>
                                     <tr>
                                        <td><?php echo $permiso->id; ?></td>
                                        <td><?php echo $permiso->nombre; ?></td>
                                        <td><?php echo $permiso->nombre; ?></td>
                                        <td>
                                            <?php if($permiso->read == 0): ?>
                                                <span class="fa fa-times"></span>
                                            <?php else: ?>
                                                <span class="fa fa-check"></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($permiso->insert == 0): ?>
                                                <span class="fa fa-times"></span>
                                            <?php else: ?>
                                                <span class="fa fa-check"></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($permiso->update == 0): ?>
                                                <span class="fa fa-times"></span>
                                            <?php else: ?>
                                                <span class="fa fa-check"></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($permiso->delete == 0): ?>
                                                <span class="fa fa-times"></span>
                                            <?php else: ?>
                                                <span class="fa fa-check"></span>
                                            <?php endif; ?>
                                        </td>
                   
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo base_url() ?>administrador/permiso/edit/<?php echo $permiso->id; ?>" class="btn btn-warning">
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