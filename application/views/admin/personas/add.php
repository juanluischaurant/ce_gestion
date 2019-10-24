
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

                            <div class="form-group">
                                <label for="cedula-persona">Cédula:</label>
                                <input type="text" class="form-control" id="cedula-persona" name="cedula-persona">
                            </div>

                            <div class="form-group">
                                <label for="nombre-persona">Nombres:</label>
                                <input type="text" class="form-control" id="nombre-persona" name="nombre-persona">
                            </div>

                            <div class="form-group">
                                <label for="apellido-persona">Apellidos:</label>
                                <input type="text" class="form-control" id="apellido-persona" name="apellido-persona">
                            </div>

                            <div class="form-group">
                                <label for="nacimiento-persona">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="nacimiento-persona" required>
                            </div>

                            <div class="form-group">
                                <label for="genero-persona">Genero:</label>
                                <input type="text" class="form-control" name="genero-persona" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono-persona">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono-persona" name="telefono-persona">
                            </div>

                            <div class="form-group">
                                <label for="direccion-persona">Dirección:</label>
                                <input type="text" class="form-control" id="direccion-persona" name="direccion-persona">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
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
