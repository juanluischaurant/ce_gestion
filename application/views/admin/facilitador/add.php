
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Facilitadores
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

                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>

                        <form action="<?php echo base_url();?>gestion/facilitador/store" method="POST">

                            <div class="form-group">
                                <label for="">Seleccionar Facilitador:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly id="cedula_persona" name="cedula_persona">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>

                            
                            <div class="form-group">
                                <label for="nombre_facilitador">Nombres:</label>
                                <input type="text" class="form-control" id="nombre_facilitador" name="nombre_facilitador" value="<?php echo isset($persona) ? $persona->primer_nombre : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellido_facilitador">Apellidos:</label>
                                <input type="text" class="form-control" id="apellido_facilitador" name="apellido_facilitador" value="<?php echo isset($persona) ? $persona->primer_apellido : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nacimiento_facilitador">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="nacimiento_facilitador" name="nacimiento_facilitador" value="<?php echo isset($persona) ? $persona->fecha_nacimiento_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <?php
                                    $lista_generos = array(
                                        '' => 'Seleccione',
                                        1 => 'Masculino',
                                        2 => 'Femenino'
                                    );
                                    $atributos = array('class' => 'form-control', 'id' => 'genero_facilitador', 'required' => 'required');
                                    
                                    // Almacena el valor correspondiente a cada género (1=Masculino, 2=Femenino)
                                    // Verifica si se encuentra asignada (isset) la variable $persona
                                    $value = isset($persona) ? $persona->genero_persona : '';
                                
                                    echo form_label('Genero:'); // Genera la etiqueta

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, seleccionado, atributos
                                    echo form_dropdown('genero_facilitador', $lista_generos, $value, $atributos);
                                ?>
                            </div>

                            <div class="form-group">
                                <label for="telefono_facilitador">Número de Teléfono:</label>
                                <input type="text" class="form-control" id="telefono_facilitador" name="telefono_facilitador" value="<?php echo isset($persona) ? $persona->telefono_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label for="direccion_facilitador">Dirección:</label>
                                <input type="text" class="form-control" id="direccion_facilitador" name="direccion_facilitador" value="<?php echo isset($persona) ? $persona->direccion_persona : ''; ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" disabled id="guardar-facilitador" class="btn btn-success btn-flat">Guardar</button>
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

<!-- Modal para lista de facilitadores -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Clientes</h4>
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
                                <td><?php echo $persona->apellidos; ?></td>
                                <?php $dataPersona = $persona->cedula.'*'.$persona->primer_nombre.'*'.$persona->apellidos.'*'.$persona->telefono.'*'.$persona->fecha_nacimiento.'*'.$persona->genero.'*'.$persona->direccion; ?>
                                <td>
                                    <button type='button' class='btn btn-success btn-check-facilitador' value='<?php echo $dataPersona; ?>'><span class="fa fa-check"></span></button>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/facilitador.add.js"></script>



