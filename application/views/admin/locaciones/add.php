

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Locaciones
        <small>Añadir</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <div class="row">
                    <div class="col-md-12">

                        <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url(); ?>gestion/locaciones/store" method="POST">

                            <div class="form-group <?php echo !empty(form_error('nombre-locacion'))? 'has-error' : '';?>">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="nombre-locacion" id="nombre-locacion" class="form-control" value="<?php echo set_value('nombre-locacion');?>">
                                <?php echo form_error('nombre-locacion', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Dirección: </label>
                                <input type="text" name="direccion-locacion" id="direccion-locacion" class="form-control">
                            </div>

                            <div class="form-group"> 
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                        </form>
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