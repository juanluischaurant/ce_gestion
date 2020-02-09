<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Períodos <small>Editar</small></h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
       
            <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php endif; ?>

            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de <?php echo $data_periodo->nombre_periodo; ?></h3>
            </div>
            
            <form action="<?php echo base_url(); ?>gestion/periodo/update" method="POST">
                                
                <div class="box-body">
                        
                    <div class="centrar_div">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group <?php echo !empty(form_error('fecha-inicio'))? 'has-error' : '';?>">                                
                                    <label for="fecha-inicio">Fecha de Inicio:</label>
                                    <input type="date" class="form-control" name="fecha-inicio" value="<?php echo $data_periodo->fecha_inicio;?>">
                                    <?php echo form_error('fecha-inicio', '<span class="help-block">', '</span>'); ?>                        
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php echo !empty(form_error('fecha-inicio'))? 'has-error' : '';?>">                                
                                    <label for="fecha-culminacion">Fecha de Culminación:</label>
                                    <input type="date" class="form-control" name="fecha-culminacion" value="<?php echo $data_periodo->fecha_culminacion;?>">
                                    <?php echo form_error('fecha-culminacion', '<span class="help-block">', '</span>'); ?>    
                                </div>
                            </div>
                        </div>
                    </div>
                                          
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="id-periodo" value="<?php echo $data_periodo->id ?>">
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                </div>

            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->