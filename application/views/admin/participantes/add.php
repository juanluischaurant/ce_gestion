
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Participantes
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

                        <!-- Notificación mostrada en caso de error -->
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>

                        <form action="<?php echo base_url();?>gestion/participante/store" method="POST">

                            <div class="form-group">
                                <label for="">Seleccionar Participante:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled="disabled" id="cedula-persona">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>

                            <input  type="hidden" class="form-control" id="fk-id-persona" name="fk-id-persona" value="<?php echo isset($persona) ? $persona->id_persona : ''; ?>">
                            
                            <div class="form-group">
                                <label for="nombre-participante">Nombres:</label>
                                <input type="text" class="form-control" id="nombres-participante" name="nombre-participante" value="<?php echo isset($persona) ? $persona->nombres_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellido-participante">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos-participante" name="apellido-participante" value="<?php echo isset($persona) ? $persona->apellidos_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nacimiento-participante">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="nacimiento-participante" name="nacimiento-participante" value="<?php echo isset($persona) ? $persona->fecha_nacimiento_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <?php
                                    $lista_generos = array(
                                        '' => 'Seleccione',
                                        1 => 'Masculino',
                                        2 => 'Femenino'
                                    );
                                    $atributos = array('class' => 'form-control', 'id' => 'genero-participante', 'required' => 'required');
                                    
                                    // Almacena el valor correspondiente a cada género (1=Masculino, 2=Femenino)
                                    // Verifica si se encuentra asignada (isset) la variable $persona
                                    $value = isset($persona) ? $persona->genero_persona : '';
                                
                                    echo form_label('Genero:'); // Genera la etiqueta

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, seleccionado, atributos
                                    echo form_dropdown('genero-participante', $lista_generos, $value, $atributos);
                                ?>
                            </div>

                            <div class="form-group">
                                <label for="telefono-participante">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono-participante" name="telefono-participante" value="<?php echo isset($persona) ? $persona->telefono_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="direccion-participante">Dirección:</label>
                                <input type="text" class="form-control" id="direccion-participante" name="direccion-participante" value="<?php echo isset($persona) ? $persona->direccion_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" disabled id="guardar-participante" class="btn btn-success btn-flat">Guardar</button>
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

<!-- Modal para lista de participantes -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Personas</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($personas)): ?>
                        <?php foreach($personas as $persona): ?>
                            <tr>
                                <td><?php echo $persona->id_persona; ?></td>
                                <td><?php echo $persona->nombres_persona; ?></td>
                                <td><?php echo $persona->apellidos_persona; ?></td>
                                <td><?php echo $persona->cedula; ?></td>
                                <?php $dataPersona = $persona->id_persona.'*'.$persona->nombres_persona.'*'.$persona->apellidos_persona.'*'.$persona->telefono_persona.'*'.$persona->cedula.'*'.$persona->fecha_nacimiento_persona.'*'.$persona->genero_persona.'*'.$persona->direccion_persona; ?>
                                <td>
                                    <button type='button' class='btn btn-success btn-check-participante' value='<?php echo $dataPersona; ?>'><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

