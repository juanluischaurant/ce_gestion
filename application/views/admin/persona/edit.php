
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

                        <form id="editar_persona" action="<?php echo base_url();?>gestion/persona/update" method="POST">

                            <div class="form-group">
                                <label for="cedula_persona">Cédula:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('cedula_persona'))? 'has-error' : '';?>" id="cedula_persona" name="cedula_persona" value="<?php echo $persona->cedula; ?>" readonly>
                                <?php echo form_error('cedula_persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="nombre_persona">Nombres:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('nombre_persona'))? 'has-error' : '';?>" id="nombre_persona" name="nombre_persona" value="<?php echo $persona->nombres; ?>">
                                <?php echo form_error('nombre_persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="apellido_persona">Apellidos:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('apellido_persona'))? 'has-error' : '';?>" id="apellido_persona" name="apellido_persona" value="<?php echo $persona->apellidos; ?>">
                                <?php echo form_error('apellido_persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="nacimiento-persona">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control <?php echo !empty(form_error('nacimiento-persona'))? 'has-error' : '';?>" name="nacimiento-persona" value="<?php echo $persona->fecha_nacimiento; ?>">
                                <?php echo form_error('nacimiento-persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <?php
                                    // Verifica si hay un valor seleccionado en la lista, si no, imprime el valor 'has-error'
                                    $error = !empty(form_error('genero_persona'))? 'has-error' : '';

                                    // Estructura el atributo class y concatena el valor anterior
                                    $atributos = array('class' => 'form-control '.$error);

                                    // Genera la etiquera
                                    echo form_label('Genero:');

                                    // Genera el elemento "select" (LA VARIABLE $lista_generos viene desde el controlador)
                                    // Parámetros de form_dropdown: nombre, valores de la lista, valor para seleccionar 'selected', atributos
                                    echo form_dropdown('genero_persona', $lista_generos, $persona->genero, $atributos);
                                ?>
                                <?php echo form_error('genero_persona', '<span class="help-block">', '</span>'); ?>

                            <!-- Fin del campo -->    
                            </div>

                            <div class="form-group">
                                <label for="telefono_persona">Número de Teléfono:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('telefono_persona'))? 'has-error' : '';?>" id="telefono_persona" name="telefono_persona" value="<?php echo $persona->telefono; ?>">
                                <?php echo form_error('telefono_persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="direccion-persona">Dirección:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('direccion-persona'))? 'has-error' : '';?>" id="direccion-persona" name="direccion-persona" value="<?php echo $persona->direccion; ?>">
                                <?php echo form_error('direccion-persona', '<span class="help-block">', '</span>'); ?>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/persona.edit.js"></script>
