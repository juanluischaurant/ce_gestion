
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Participante
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-warning">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de Nuevo Participante</h3>

                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>  
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->

            <div class="box-body">
                
                <div class="centrar_div">
                    <form id="agregar_participante" action="<?php echo base_url();?>gestion/participante/store" method="POST">

                        <div class="form-group">
                            <label for="">Seleccionar Participante:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="cedula_persona"  name="cedula_persona" value="<?php echo isset($persona) ? $persona->cedula_persona : ''; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="busca-participante" type="button" data-toggle="modal" data-target="#modal-default" >
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                            </div><!-- /input-group -->
                        </div>

                        <input  type="hidden" class="form-control" id="cedula_persona">

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <?php
                                    $atributos = array('class' => 'form-control', 'id' => 'nivel_academico', 'required' => 'required');
                                    $selected = isset($participante->id_nivel_academico) ? $participante->id_nivel_academico : '';
                                    // Almacena el valor correspondiente a cada género (1=Masculino, 2=Femenino)
                                    // Verifica si se encuentra asignada (isset) la variable $persona
                                                            
                                    echo form_label('Nivel Académico'); // Genera la etiqueta

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, seleccionado, atributos
                                    echo form_dropdown('nivel_academico', $nivel_academico, $selected, $atributos);
                                ?>
                            </div>
                        </div>

                        <div class="row hidden" id="detalles_participante">
                        
                            <div class="col-xs-6 text-right">		
                                <b>Nombres:</b><br>
                                <b>Apellidos:</b><br>
                                <b>Cédula:</b><br>
                                <b>F. de Nacimiento:</b><br>
                                <b>Teléfono:</b><br>
                                <b>Correo Electrónico:</b><br>
                                <b>Dirección:</b><br>
                                <br>
                            </div>
                            <div class="col-xs-6">	
                                <span id="primer_nombre"></span><br>
                                <span id="primer_apellido"></span><br>
                                <span id="cedula_vista"></span><br>
                                <span id="fecha_nacimiento"></span><br>
                                <span id="telefono"></span><br>
                                <span id="correo_electronico"></span><br>
                                <span id="direccion"></span><br>
                            </div>
                            
                        </div>    
                        
                        <div class="box-footer">
                            <button type="submit" disabled id="guardar-participante" class="btn btn-success btn-flat center-block">Guardar</button>
                        </div>
                      
                    </form>
                    <!-- fin del formulario -->
                </div>
                <!-- /.cetrar_div -->

            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal para lista de participantees -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Personas</h4>
            </div>

            <div class="modal-body">
                <table id="lista-persona" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($personas)): ?>
                        <?php foreach($personas as $persona): ?>
                            <tr>
                                <td><?php echo $persona->cedula; ?></td>
                                <td><?php echo $persona->primer_nombre; ?></td>
                                <td><?php echo $persona->primer_apellido; ?></td>
                                <?php $dataPersona = $persona->cedula.'*'.$persona->primer_nombre.'*'.$persona->primer_apellido.'*'.$persona->telefono.'*'.$persona->fecha_nacimiento.'*'.$persona->genero.'*'.$persona->direccion.'*'.$persona->correo_electronico; ?>
                                <td>
                                    <button type='button' class='btn btn-success btn-check-participante' value='<?php echo $dataPersona; ?>'><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-danger center-block" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/participante.add.js"></script>


