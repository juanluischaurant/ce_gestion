

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Curso
        <small>Editar</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-warning">

            <div class="box-header with-border text-center">
              <h3 class="box-title">Datos de <?php echo $curso->serial; ?></h3>

              <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->
                  
            <form action="<?php echo base_url(); ?>gestion/curso/update" method="POST">

                <div class="box-body">
                    
                    <div class="centrar_div">
                                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Nombre del Curso</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled="disabled" id="nombre-curso" value="<?php echo $curso->descripcion; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" disabled><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="costo-curso">Costo</label>
                                <input type="number" class="form-control" id="costo-curso" name="costo-curso" value="<?php echo $curso->precio; ?>">
                            </div>

                            <div class="col-md-8">
                                <label for="">Período</label>
                                <input type="text" class="form-control" id="periodo-curso" value="<?php echo $curso->periodo_academico; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="locacion-curso">Locación</label>
                                <input type="text" class="form-control" id="locacion-curso" value="<?php echo $curso->locacion_curso; ?>">
                            </div>

                            <div class="col-md-4">
                                <?php
                                    $atributos = array('class' => 'form-control', 'required');
                                    $selected = $curso->id_turno;

                                    // Genera la etiquera
                                    echo form_label('Turno');

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, selected, atributos
                                    echo form_dropdown('turno-curso', $lista_turnos, $selected, $atributos);
                                ?>
                                <!-- Fin del campo -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="facilitador-curso">Facilitador</label>
                                <input type="text" id="facilitador-curso" class="form-control" value="<?php echo $curso->nombre_facilitador; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="cupos-especialidad">Cupos</label>
                                <input type="text" name="cupos-curso" id="cupos-curso" class="form-control" value="<?php echo $curso->cupos; ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="descripcion-curso">Descripción</label>
                                <input type="text" name="descripcion-curso" id="descripcion-curso" class="form-control" value="<?php echo $curso->detalles_curso; ?>">
                            </div>    
                        </div>

                    </div>
                    <!-- /.centrar_div -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <input type="hidden" id="id-periodo-curso" name="id-periodo-curso" value="<?php echo $curso->id_periodo; ?>">  
                    <input type="hidden" id="id-locacion-curso" name="id-locacion-curso" value="<?php echo $curso->id_locacion; ?>">  
                    <input type="hidden" id="id-facilitador-curso" name="id-facilitador-curso" value="<?php echo $curso->cedula_persona; ?>">
                    <!-- <input type="hidden" name="id-nombre-curso" id="id-nombre-curso"> -->
                    <input type="hidden" name="serial-curso" id="serial-curso" value="<?php echo $curso->serial; ?>">
                    <input type="hidden" name="id-curso" id="id-curso" value="<?php echo $curso->id; ?>">
                    
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>

                </div>
                <!-- .box-footer -->

            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/curso.add.js"></script>

