

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Locaciones
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php if($this->session->flashdata('alert')): ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> ¡Alerta!</h4>
            <?php echo $this->session->flashdata('alert'); ?>
        </div>
        <?php endif;?>

        <!-- Default box -->
        <div class="box box-solid">

            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $locacion->nombre_locacion; ?></h3>
            </div>
            
            <form action="<?php echo base_url(); ?>gestion/locaciones/update" method="POST">
                
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group <?php echo !empty(form_error('nombre-locacion'))? 'has-error' : '';?>">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="nombre-locacion" id="nombre-locacion" class="form-control" value="<?php echo $locacion->nombre_locacion; ?>">
                                <?php echo form_error('nombre-locacion', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Dirección: </label>
                                <input type="text" name="direccion-locacion" id="direccion-locacion" class="form-control" value="<?php echo $locacion->direccion_locacion; ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p><?php echo $locacion->instancias_asociadas; ?> instancias asociadas</p>
                            <a href="<?php echo base_url() ?>gestion/locaciones/delete_location/<?php echo $locacion->id_locacion; ?>" class="btn btn-flat btn-danger btn-xs">Eliminar esta locación</a>
                        </div>
                    
                    </div>
                      
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="id-locacion" value="<?php echo $locacion->id_locacion; ?>">
                    
                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                </div>
            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->