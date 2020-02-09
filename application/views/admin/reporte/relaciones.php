<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Relación de Cursos
        <small>Reporte General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla-relacion" class="table table-bordered btn-hover tabla-ce">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($cursos)): ?>
                                <?php foreach($cursos as $curso): ?>
                                    <tr>
                                        <td><?php echo $curso->serial; ?></td>
                                        <td><?php echo $curso->nombre_curso . " " . $curso->periodo_academico; ?></td>
                                        
                                        <td>
                                        <?php $today = date('Y-m-d'); ?>
                                        <?php if($curso->estado == 1 && date($curso->fecha_culminacion) >= $today): ?>
                                            <small class="label label-success">
                                                <i class="fa fa-clock-o"></i> Activa
                                            </small>
                                        <?php endif; ?> 
                                        <?php if($curso->estado == 0): ?>
                                            <small class="label label-danger">
                                                <i class="fa fa-clock-o"></i> Cancelada
                                            </small>
                                        <?php endif; ?> 
                                        <?php if(date($curso->fecha_culminacion) <= $today): ?>
                                            <small class="label label-warning">
                                                <i class="fa fa-clock-o"></i> Archivada
                                            </small>
                                        <?php endif; ?> 
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo base_url() .'/reportes/relacion/relacion_curso/'.$curso->id; ?>" class="btn btn-info"><span class="fa fa-eye"></span></a>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/relacion.js"></script>