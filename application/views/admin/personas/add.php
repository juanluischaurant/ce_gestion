
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Personas
        <small>Nueva</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>

                        <form action="<?php echo base_url();?>gestion/personas/store" method="POST">

                            <div class="row form-group">
                                <div class="col-md-5">                                
                                    <label for="cedula-persona">Cédula:</label>
                                    <input type="text" class="form-control <?php echo !empty(form_error('cedula-persona'))? 'has-error' : '';?>" id="cedula-persona" name="cedula-persona">
                                    <?php echo form_error('cedula-persona', '<span class="help-block">', '</span>'); ?>
                                </div>

                                <div class="col-md-5">                                
                                    <label for="nacimiento-persona">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" name="nacimiento-persona">
                                </div>
                            </div>

                            <div class="row form-group">

                                <div class="col-md-4">
                                    <label for="nombre-persona">Nombres:</label>
                                    <input type="text" class="form-control" id="nombre-persona" name="nombre-persona">
                                </div>

                                <div class="col-md-6">                                
                                    <label for="apellido-persona">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellido-persona" name="apellido-persona">
                                </div>
                            </div>

                            <div class="form-group">

                            </div>

                            <div class="form-group">
                                
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="genero-persona">Genero:</label>
                                    <select name="genero-persona" id="genero-persona" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>                              
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="telefono-persona">Número de Teléfono:</label>
                                    <input type="text" class="form-control" id="telefono-persona" name="telefono-persona">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-10">
                                    <label for="direccion-persona">Dirección:</label>
                                    <input type="text" class="form-control" id="direccion-persona" name="direccion-persona">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                </div>
                            </div>

                        </form>
                        <!-- fin del cursor -->

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
