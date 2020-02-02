
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Participantes
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

                        <?php if($this->session->flashdata("error")): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url();?>gestion/facilitador/update" method="POST">

                            <div class="form-group">
                                <label for="cedula-facilitador">Cédula:</label>
                                <input type="text" class="form-control" id="cedula-facilitador" name="cedula-facilitador" value='<?php echo $facilitador->cedula_persona; ?>'>
                            </div>

                            <div class="form-group">
                                <label for="primer_nombre">Nombres:</label>
                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" value="<?php echo $facilitador->primer_nombre; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="primer_apellido">Apellidos:</label>
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo $facilitador->primer_apellido; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nacimiento-facilitador">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="nacimiento-facilitador" value="<?php echo $facilitador->fecha_nacimiento; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="genero-facilitador">Genero:</label>
                                <input type="text" class="form-control" name="genero-facilitador" value="<?php echo $facilitador->genero; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono-facilitador">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono-facilitador" name="telefono-facilitador" value="<?php echo $facilitador->telefono; ?>">
                            </div>

                            <div class="form-group">
                                <label for="direccion-facilitador">Dirección:</label>
                                <input type="text" class="form-control" id="direccion-facilitador" name="direccion-facilitador" value="<?php echo $facilitador->direccion; ?>">
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
