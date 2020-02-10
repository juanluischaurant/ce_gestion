
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
        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de <?php echo $persona->primer_nombre . " " . $persona->primer_apellido ?></h3>

                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>

            </div>

            <form id="editar_persona" action="<?php echo base_url();?>gestion/persona/update" method="POST">
            
                <div class="box-body">

                    <div class="centrar_div">

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="cedula_persona">Cédula:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('cedula_persona'))? 'has-error' : '';?>" id="cedula_persona" name="cedula_persona" value="<?php echo $persona->cedula; ?>" readonly>
                                <?php echo form_error('cedula_persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nacimiento-persona">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control <?php echo !empty(form_error('nacimiento-persona'))? 'has-error' : '';?>" name="nacimiento-persona" value="<?php echo $persona->fecha_nacimiento; ?>">
                                <?php echo form_error('nacimiento-persona', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="primer_nombre">Nombres:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('primer_nombre'))? 'has-error' : '';?>" id="primer_nombre" name="primer_nombre" value="<?php echo $persona->primer_nombre; ?>">
                                <?php echo form_error('primer_nombre', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="primer_apellido">Apellidos:</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('primer_apellido'))? 'has-error' : '';?>" id="primer_apellido" name="primer_apellido" value="<?php echo $persona->primer_apellido; ?>">
                                <?php echo form_error('primer_apellido', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>                         

                        <div class="row">
                            <div class="form-group col-md-4">
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
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="correo-persona">Correo Electrónico</label>
                                <input type="email" class="form-control <?php// echo !empty(form_error('telefono_persona'))? 'has-error' : '';?>" id="correo-persona" name="correo-persona" value="<?php echo $persona->correo_electronico; ?>">
                                <?php // echo form_error('telefono_persona', '<span class="help-block">', '</span>'); ?>
                            </div>                                                     
            
                            <div class="form-group col-md-5">
                                <label for="telefono_persona">Número de Teléfono</label>
                                <input type="text" data-inputmask='"mask": "(999) 999-9999"' class="form-control <?php echo !empty(form_error('telefono_persona'))? 'has-error' : '';?>" id="telefono_persona" name="telefono_persona" value="<?php echo $persona->telefono; ?>">
                                <?php echo form_error('telefono_persona', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Dirección</label>
                                <textarea class="form-control <?php echo !empty(form_error('direccion_persona'))? 'has-error' : '';?>" id="direccion_persona" name="direccion_persona" rows="1" placeholder="Ej: Sector Central, calle 10 cruce con avenida 4"><?php echo $persona->direccion; ?></textarea>
                                <?php echo form_error('direccion_persona', '<span class="help-block">', '</span>'); ?>
                            </div>                                      
                        </div>

                    </div>
                    <!-- /.centrar_div -->

                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                    </div>

            </form>
            <!-- fin del formulario -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/persona.edit.js"></script>
