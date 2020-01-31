
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

        <div class="box box-warning">
        
            <div class="box-header with-border  text-center">
              <h3 class="box-title">Datos de la persona</h3>

              <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->

            <form action="<?php echo base_url();?>gestion/persona/store" method="POST" id="agregar_persona">
            
                <div class="box-body">

                    <div class="centrar_div">
 
                        <div class="row">
                            <div class="form-group col-md-8">                                
                                <label for="cedula_persona">Cédula</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('cedula_persona'))? 'has-error' : '';?>" id="cedula_persona" name="cedula_persona" value="<?php echo set_value('cedula_persona');?>" autocomplete="off">
                                <?php echo form_error('cedula_persona', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group col-md-4">                                
                                <label for="nacimiento_persona">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="nacimiento_persona" name="nacimiento_persona" value="<?php echo set_value('nacimiento_persona');?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="primer_nombre">Nombres</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('primer_nombre'))? 'has-error' : '';?>" id="primer_nombre" name="primer_nombre" value="<?php echo set_value('primer_nombre');?>">
                                <?php echo form_error('primer_nombre', '<span class="help-block">', '</span>'); ?>
                            </div>
            
                            <div class="form-group col-md-6">                                
                                <label for="primer_apellido">Apellidos</label>
                                <input type="text" class="form-control <?php echo !empty(form_error('primer_apellido'))? 'has-error' : '';?>" id="primer_apellido" name="primer_apellido" value="<?php echo set_value('primer_apellido');?>">
                                <?php echo form_error('primer_apellido', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="genero_persona">Genero</label>
                                <select name="genero_persona" id="genero_persona" class="form-control <?php echo !empty(form_error('genero_persona'))? 'has-error' : '';?>">
                                    <option value="">Seleccione</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>                              
                                </select>
                                <?php echo form_error('genero_persona', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="correo-persona">Correo Electrónico</label>
                                <input type="email" class="form-control <?php// echo !empty(form_error('telefono_persona'))? 'has-error' : '';?>" id="correo-persona" name="correo-persona" value="<?php //echo set_value('telefono_persona');?>">
                                <?php // echo form_error('telefono_persona', '<span class="help-block">', '</span>'); ?>
                            </div>                                                     
            
                            <div class="form-group col-md-5">
                                <label for="telefono_persona">Número de Teléfono</label>
                                <input type="text" data-inputmask='"mask": "(999) 999-9999"' class="form-control <?php echo !empty(form_error('telefono_persona'))? 'has-error' : '';?>" id="telefono_persona" name="telefono_persona" value="<?php echo set_value('telefono_persona');?>">
                                <?php echo form_error('telefono_persona', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Dirección</label>
                                <textarea class="form-control <?php echo !empty(form_error('direccion-persona'))? 'has-error' : '';?>"  id="direccion-persona" name="direccion-persona" rows="1" placeholder="Ej: Sector Central, calle 10 cruce con avenida 4"></textarea>
                                <?php echo form_error('direccion-persona', '<span class="help-block">', '</span>'); ?>
                            </div>                                      
                        </div>

                    </div>
                
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                </div>
                <!-- .box-footer -->

            </form>
            <!-- fin del formulario -->

        </div>
        <!-- .box -->

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/persona.add.js"></script>

