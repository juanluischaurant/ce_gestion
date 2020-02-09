<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Acciones
        <small>Reporte General</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

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

        <!-- Default box -->
        <div class="box box-solid">
            
            <div class="box-body">

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