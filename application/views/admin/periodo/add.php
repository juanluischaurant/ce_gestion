

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Períodos
        <small>Añadir</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
       
        <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <!-- Default box -->
        <div class="box box-warning">

            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de Nuevo Período</h3>
            </div>
            
            <form action="<?php echo base_url(); ?>gestion/periodo/store" method="POST">
                
                <div class="box-body">
             
                    <div class="centrar_div">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group <?php echo !empty(form_error('fecha-inicio'))? 'has-error' : '';?>">                                
                                    <label for="fecha-inicio">Fecha de Inicio:</label>
                                    <input type="date" class="form-control" name="fecha-inicio" value="<?php // echo $data_periodo->fecha_inicio_periodo;?>">
                                    <?php echo form_error('fecha-inicio', '<span class="help-block">', '</span>'); ?>                        
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php echo !empty(form_error('fecha-inicio'))? 'has-error' : '';?>">                                
                                    <label for="fecha-culminacion">Fecha de Culminación:</label>
                                    <input type="date" class="form-control" name="fecha-culminacion" value="<?php // echo $data_periodo->fecha_culminacion_periodo;?>">
                                    <?php echo form_error('fecha-culminacion', '<span class="help-block">', '</span>'); ?>    
                                </div>
                            </div>
                        </div>
                    </div>
                          
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                </div>
            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->