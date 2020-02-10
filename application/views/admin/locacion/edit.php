

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
        <div class="box box-primary">

            <div class="box-header with-border text-center">
                <h3 class="box-title"><?php echo $locacion->nombre; ?></h3>
            </div>
            
            <form action="<?php echo base_url(); ?>gestion/locacion/update" method="POST">
                
                <div class="box-body">
                    <div class="centrar_div">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group <?php echo !empty(form_error('nombre_locacion'))? 'has-error' : '';?>">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre_locacion_nuevo" id="nombre_locacion_nuevo" class="form-control" value="<?php echo $locacion->nombre; ?>">
                                    <?php echo form_error('nombre_locacion', '<span class="help-block">', '</span>'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>Dirección</label>
                                <textarea class="form-control"  id="direccion_locacion" name="direccion_locacion" rows="4" placeholder="Ej: Sector Central, calle 10 cruce con avenida 4"><?php echo $locacion->direccion; ?></textarea>
                            </div>  

                            <div class="col-md-12">
                                <p><?php echo $locacion->instancias_asociadas; ?> cursos asociados</p>
                                <a href="<?php echo base_url() ?>gestion/locacion/delete_location/<?php echo $locacion->id; ?>" class="btn btn-flat btn-danger btn-xs">Eliminar esta locación</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.centrar_div -->

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="id-locacion" value="<?php echo $locacion->id; ?>">
                    <input type="hidden" name="nombre_locacion" id="nombre_locacion" class="form-control" value="<?php echo $locacion->nombre; ?>">
                    
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                </div>
            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->