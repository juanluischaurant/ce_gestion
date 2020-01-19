

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Listado de Cursos
        <small>Editar</small>
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

                        <form action="<?php echo base_url(); ?>gestion/curso/store" method="post">
                            <div class="form-group <?php echo !empty(form_error('nombre_curso'))? 'has-error' : '';?>">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="nombre_curso" id="nombre_curso" class="form-control" value="<?php echo set_value('nombre_curso');?>">
                                <?php echo form_error('nombre_curso', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción: </label>
                                <input type="text" name="descripcion_curso" id="descripcion_curso" class="form-control">
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