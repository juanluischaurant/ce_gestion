
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Personas
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

                        <form action="<?php echo base_url();?>gestion/personas/update" method="POST">

                            <input type="hidden" name="id-persona" value="<?php echo $persona->persona_id;?>">

                            <div class="form-group">
                                <label for="cedula-persona">Cédula:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('cedula-persona'))? 'has-error' : '';?>" disabled id="cedula-persona" name="cedula-persona" value='<?php echo $persona->cedula_persona; ?>'>
                                <?php echo form_error('cedula-persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="nombre-persona">Nombres:</label>
                                <input type="text" class="form-control" id="nombre-persona" name="nombre-persona" value="<?php echo $persona->nombres_persona; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="apellido-persona">Apellidos:</label>
                                <input type="text" class="form-control" id="apellido-persona" name="apellido-persona" value="<?php echo $persona->apellidos_persona; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nacimiento-persona">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="nacimiento-persona" value="<?php echo $persona->fecha_nacimiento_persona; ?>" required>
                            </div>

                            <div class="form-group">
                            <?php
                                $atributos = array('class' => 'form-control', 'required' =>'required');
                                // Genera la etiquera
                                echo form_label('Genero:');

                                // Genera el elemento "select"
                                // Parámetros de form_dropdown: nombre, valores de la lista, valor para seleccionar 'selected', atributos
                                echo form_dropdown('genero-persona', $lista_generos, $persona->genero_persona, $atributos);
                            ?>
                            <!-- Fin del campo -->    
                            </div>

                            <div class="form-group">
                                <label for="telefono-persona">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono-persona" name="telefono-persona" value="<?php echo $persona->telefono_persona; ?>">
                            </div>

                            <div class="form-group">
                                <label for="direccion-persona">Dirección:</label>
                                <input type="text" class="form-control" id="direccion-persona" name="direccion-persona" value="<?php echo $persona->direccion_persona; ?>">
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
