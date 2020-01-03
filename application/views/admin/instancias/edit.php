

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Instancias
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

                
                <div class="row">

                    <!-- comienza -->
                    <div class="col-md-12">

                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title"><?php echo $instancia->nombre_curso; ?> | <?php echo $instancia->serial_instancia; ?></h3>
                            </div>

                            <form action="<?php echo base_url(); ?>gestion/instancias/update" method="POST">
                                <div class="box-body">

                                    <div class="row">
                                            
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo !empty(form_error('costo-instancia')) ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="costo-instancia">Costo (Bs.):</label>
                                                <input type="number" class="form-control" name="costo-instancia" value="<?php echo $instancia->precio_instancia?>">
                                                <?php echo form_error('costo-instancia', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group <?php echo !empty(form_error('id-periodo-instancia')) ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="periodo-instancia"><i class="fa fa-check hidden"></i> Período</label>
                                                <input type="text" class="form-control" id="periodo-instancia" value="<?php echo $instancia->periodo; ?>" placeholder="Ej: Enero-Mayo 2020">
                                                <?php echo form_error('id-periodo-instancia', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group <?php echo !empty(form_error('turno-instancia')) ? 'has-error' : ''; ?>">
                                                <?php
                                                    $atributos = array('class' => 'form-control', 'required');
                                                    $value = $instancia->fk_id_turno_instancia_1;

                                                    // Genera la etiquera
                                                    echo form_label('Turno:');

                                                    // Genera el elemento "select"
                                                    // Parámetros de form_dropdown: nombre, valores de la lista, selected, atributos
                                                    echo form_dropdown('turno-instancia', $lista_turnos, $value, $atributos);
                                                ?>
                                                <!-- Fin del campo -->
                                                <?php echo form_error('turno-instancia', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                                                    
                                        <div class="col-md-2">
                                            <div class="form-group <?php echo !empty(form_error('cupos-instancia')) ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="cupos-instancia">Cupos</label>
                                                <input type="text" class="form-control" id="cupos-instancia" name="cupos-instancia" value="<?php echo $instancia->cupos_instancia ?>" placeholder="Enter ...">
                                                <?php echo form_error('cupos-instancia', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="control-label" for="locacion-instancia"><i class="fa fa-check hidden"></i> Locación</label>
                                                <input type="text" class="form-control" id="locacion-instancia" value="<?php echo $instancia->locacion_instancia ?>" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="profesor-instancia"><i class="fa fa-check hidden"></i> Facilitador</label>
                                                <input type="text" class="form-control" id="profesor-instancia" value="<?php echo $instancia->nombre_facilitador; ?>" placeholder="Enter ...">
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label" for="descripcion-instancia">Descripción:</label>
                                                <input type="text" class="form-control" name="descripcion-instancia" value="<?php echo $instancia->descripcion_instancia; ?>" placeholder="Ej: Informática Básica especial">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input type="hidden" name="id-instancia" value="<?php echo $instancia->id_instancia ?>">
                                    <input type="hidden" name="serial-instancia" value="<?php echo $instancia->serial_instancia ?>">
                                    <input type="hidden" id="id-periodo-instancia" name="id-periodo-instancia" value="<?php echo $instancia->id_periodo ?>">
                                    <input type="hidden" name="id-locacion-instancia" value="<?php echo $instancia->id_locacion ?>">
                                    <input type="hidden" name="id-profesor-instancia" value="<?php echo $instancia->id_facilitador ?>">
                                    
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                </div>  

                            </form>
                            <!-- /form -->

                        </div>
                        <!-- /.box -->



                    </div>
                    <!-- termina -->

        
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->