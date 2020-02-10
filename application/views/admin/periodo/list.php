<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Períodos
        <small>Lista General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-pencil"></i> ¡Éxito!</h4>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('alert')): ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> ¡Alerta!</h4>
            <?php echo $this->session->flashdata('alert'); ?>
        </div>
        <?php endif; ?>
        
        <!-- Default box -->
        <div class="box box-solid">

            <div class="box-body">
                <div class="row">
                <?php if($permisos->insert == 1): ?>
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/periodo/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Perído</a>
                    </div>
                <?php endif; ?>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="lista-periodo" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Registro</th>
                                    <th>Período</th>
                                    <th>Cursos Asociadas</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($periodos)): ?>
                                <?php foreach($periodos as $periodo): ?>
                                    <tr>
                                        <td><?php echo $periodo->id; ?></td>
                                        <td><?php echo $periodo->fecha_registro; ?></td>
                                        <td><?php echo $periodo->nombre_periodo; ?></td>                                 
                                        <td><?php echo $periodo->instancias_asociadas; ?></td>                                 
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><span class="fa fa-eye"></span></a>

                                                <?php if($permisos->update == 1): ?>
                                                <a href="<?php echo base_url() ?>gestion/periodo/edit/<?php echo $periodo->id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                <a href="<?php echo base_url() ?>gestion/periodo/delete/<?php echo $periodo->id; ?>" class="btn btn-danger"><span class="fa fa-remove"></span></a>
                                                <?php endif; ?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/periodo.list.js"></script>