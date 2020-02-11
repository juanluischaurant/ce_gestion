<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Nombres de Curso
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
                        <a href="<?php echo base_url(); ?>gestion/nombre_curso/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Nombre de Curso</a>
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
                        <table id="lista-nombre-curso" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Nombre</th>
                                    <th>Conteo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($nombres_curso)): ?>
                                <?php foreach($nombres_curso as $nombre_curso): ?>
                                    <tr>
                                        <td><?php echo $nombre_curso->id; ?></td>
                                        <td><?php echo $nombre_curso->fecha_registro; ?></td>
                                        <td><?php echo $nombre_curso->descripcion; ?></td>
                                        <td><?php echo $nombre_curso->conteo_cursos_asociados; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo base_url() ?>gestion/nombre_curso/edit/<?php echo $nombre_curso->id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/nombre_curso.list.js"></script>