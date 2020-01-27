
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

                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>

                        <form action="<?php echo base_url();?>gestion/participante/update" method="POST">
                            <input type="hidden" name="idParticipante" value="<?php echo $participante->id_participante;?>">

                            <div class="form-group">
                                <label for="cedula">Cédula:</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" value='<?php echo $participante->cedula_participante; ?>'>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombre" name="nombres" value="<?php echo $participante->nombres_participante; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $participante->apellidos_participante; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="fecha" value="<?php echo $participante->fecha_nacimiento_participante; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="">Genero:</label>
                                <input type="text" class="form-control" name="genero" value="<?php echo $participante->genero_participante; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $participante->telefono_participante; ?>">
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $participante->direccion_participante; ?>">
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
