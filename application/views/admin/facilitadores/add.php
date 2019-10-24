
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Facilitadores
        <small>Nuevo</small>
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

                        <form action="<?php echo base_url();?>gestion/facilitadores/store" method="POST">

                            <input  type="hidden" class="form-control" id="fk-id-persona" name="fk-id-persona" value="<?php echo isset($persona) ? $persona->persona_id : ''; ?>">
                            
                            <div class="form-group">
                                <label for="cedula-facilitador">Cédula:</label>
                                <input type="text" class="form-control" id="cedula-facilitador" name="cedula-facilitador" value="<?php echo isset($persona) ? $persona->cedula_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nombre-facilitador">Nombres:</label>
                                <input type="text" class="form-control" id="nombre-facilitador" name="nombre-facilitador" value="<?php echo isset($persona) ? $persona->nombres_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellido-facilitador">Apellidos:</label>
                                <input type="text" class="form-control" id="apellido-facilitador" name="apellido-facilitador" value="<?php echo isset($persona) ? $persona->apellidos_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nacimiento-facilitador">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="nacimiento-facilitador" value="<?php echo isset($persona) ? $persona->fecha_nacimiento_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="genero-facilitador">Genero:</label>
                                <input type="text" class="form-control" name="genero-facilitador" value="<?php echo isset($persona) ? $persona->genero_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="telefono-facilitador">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono-facilitador" name="telefono-facilitador" value="<?php echo isset($persona) ? $persona->telefono_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="direccion-facilitador">Dirección:</label>
                                <input type="text" class="form-control" id="direccion-facilitador" name="direccion-facilitador" value="<?php echo isset($persona) ? $persona->direccion_persona : ''; ?>">
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
