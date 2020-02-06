

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Cursos
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
                                <h3 class="box-title"><?php echo $curso->nombre_curso; ?> | <?php echo $curso->serial_instancia; ?></h3>
                            </div>

                            <form action="<?php echo base_url(); ?>gestion/curso/update" method="POST">
                                <div class="box-body">

                                    <div class="row">
                                            
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo !empty(form_error('costo-curso')) ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="costo-curso">Costo (Bs.):</label>
                                                <input type="number" class="form-control" name="costo-curso" value="<?php echo $curso->precio_instancia?>">
                                                <?php echo form_error('costo-curso', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group <?php echo !empty(form_error('id-periodo-curso')) ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="periodo-curso"><i class="fa fa-check hidden"></i> Período</label>
                                                <input type="text" class="form-control" id="periodo-curso" value="<?php echo $curso->periodo; ?>" placeholder="Ej: Enero-Mayo 2020">
                                                <?php echo form_error('id-periodo-curso', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group <?php echo !empty(form_error('turno-curso')) ? 'has-error' : ''; ?>">
                                                <?php
                                                    $atributos = array('class' => 'form-control', 'required');
                                                    $value = $curso->id_turno;

                                                    // Genera la etiquera
                                                    echo form_label('Turno:');

                                                    // Genera el elemento "select"
                                                    // Parámetros de form_dropdown: nombre, valores de la lista, selected, atributos
                                                    echo form_dropdown('turno-curso', $lista_turnos, $value, $atributos);
                                                ?>
                                                <!-- Fin del campo -->
                                                <?php echo form_error('turno-curso', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                                                    
                                        <div class="col-md-2">
                                            <div class="form-group <?php echo !empty(form_error('cupos-curso')) ? 'has-error' : ''; ?>">
                                                <label class="control-label" for="cupos-curso">Cupos</label>
                                                <input type="text" class="form-control" id="cupos-curso" name="cupos-curso" value="<?php echo $curso->cupos_instancia ?>" placeholder="Enter ...">
                                                <?php echo form_error('cupos-curso', '<span class="help-block">', '</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="control-label" for="locacion-curso"><i class="fa fa-check hidden"></i> Locación</label>
                                                <input type="text" class="form-control" id="locacion-curso" value="<?php echo $curso->locacion_curso ?>" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="facilitador-curso"><i class="fa fa-check hidden"></i> Facilitador</label>
                                                <input type="text" class="form-control" id="facilitador-curso" value="<?php echo $curso->nombre_facilitador; ?>" placeholder="Enter ...">
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label" for="descripcion-curso">Descripción:</label>
                                                <input type="text" class="form-control" name="descripcion-curso" value="<?php echo $curso->descripcion_instancia; ?>" placeholder="Ej: Informática Básica especial">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input type="hidden" name="id-curso" value="<?php echo $curso->id ?>">
                                    <input type="hidden" name="serial-curso" value="<?php echo $curso->serial_instancia ?>">
                                    <input type="hidden" id="id-periodo-curso" name="id-periodo-curso" value="<?php echo $curso->id_periodo ?>">
                                    <input type="hidden" name="id-locacion-curso" value="<?php echo $curso->id_locacion ?>">
                                    <input type="hidden" name="id-facilitador-curso" value="<?php echo $curso->id_facilitador ?>">
                                    
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