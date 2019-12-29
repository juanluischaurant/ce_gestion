
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inscripción
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                        
                <form action="<?php echo base_url();?>movimientos/inscripciones/store" method="POST" class="form-horizontal">
                            
                    <p>Buscar Pago:</p>
                    <div class="input-group margin col-md-5">

                        <input type="text" class="form-control" id="numero-de-operacion">

                        <span class="input-group-btn">

                            <button type="button" class="btn btn-success btn-flat" id="btn-agregar-pago">
                                <span class="fa fa-paperclip"></span>
                            </button>

                            <button type="button" class="btn btn-info btn-flat" id="btn-registrar-pago-nuevo" data-toggle="modal" data-target="#modal-info">
                                <span class="fa fa-plus"></span>
                            </button>

                        </span>
                    </div>
                    
                    <table id="tabla-pagos" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Serial Pago</th>
                                <th>Número de Operación</th>
                                <th>Monto de Operación</th>
                                <th>Cédula</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>

                    <hr>                    

                    <div class="form-group">
                        
                        <div class="col-md-6">

                            <label for="">Seleccionar Participante:</label>
                            <div class="input-group">
                                <input type="hidden" name="id_participante" id="id_participante">
                                <input type="text" class="form-control" disabled="disabled" id="nombre_participante">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="btn-buscar-participante" type="button" data-toggle="modal" data-target="#modal-default">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                            </div><!-- /input-group -->

                        </div> 

                        <div class="col-md-3">
                            <label for="fecha-inscripcion">Fecha de Inscripción:</label>
                            <input type="date" class="form-control" id="fecha-inscripcion" name="fecha-inscripcion">
                        </div>

                    </div>

                    <p>Seleccionar Instancia:</p>
                    <div class="input-group margin col-md-5">

                        <input type="text" class="form-control" id="producto" disabled="disabled">

                        <span class="input-group-btn">

                            <button type="button" class="btn btn-success btn-flat" id="btn-agregar-curso">
                                <span class="fa fa-paperclip"></span>
                            </button>

                        </span>
                    </div>

                    <table id="tbventas" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Cupos</th>
                                <th>Ocupados</th>
                                <th>Precio</th>
                                <th>Opciones</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>

                    <div class="form-group">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Monto Pagado:</span>
                                <input type="text" class="form-control" placeholder="0.00" name="monto-pagado" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Subtotal:</span>
                                <input type="text" class="form-control" placeholder="0.00" name="subtotal" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Descuento:</span>
                                <input type="text" class="form-control" placeholder="0.00" name="descuento" value="0.00" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Total:</span>
                                <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" id='guardar-inscripcion' disabled class="btn btn-success btn-flat">Guardar</button>
                        </div>
                    </div>

                </form>
               
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal para lista de Participantes -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Clientes</h4>
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

                    <?php if(!empty($participantes)): ?>
                    <?php foreach($participantes as $participante): ?>
                        <tr>
                            <td><?php echo $participante->id_participante; ?></td>
                            <td><?php echo $participante->nombres_persona; ?></td>
                            <td><?php echo $participante->apellidos_persona; ?></td>
                            <td><?php echo $participante->cedula_persona; ?></td>
                            <?php $dataParticipante = $participante->id_participante.'*'.$participante->nombres_persona.'*'.$participante->apellidos_persona.'*'.$participante->telefono_persona.'*'.$participante->cedula_persona; ?>
                            <td>
                                <button type='button' class='btn btn-success btn-check-participante-inscripcion' value='<?php echo $dataParticipante; ?>'><span class="fa fa-check"></span></button>
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

<!-- Modal para pagos -->
<div class="modal fade" id="modal-info" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Agregar Pago</h4>
            </div>

            <div class="modal-body">
                
                <!-- Default box -->
                <div class="box box-solid ui-front">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">                           
                                
                                <form action="" method="POST" class="form-horizontal">
                                    
                                    <input type="hidden" name="modulo-actual" value="inscripciones">

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <!-- Campo select rellenado con data de la BD -->
                                            <label for="">Tipo de Pago:</label>
                                            <select name="tipo-de-pago" id="tipo-de-pago" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                <?php foreach($tipos_de_operacion as $tipo_de_operacion) : ?>
                                                    <?php $id_tipo_operacion = $tipo_de_operacion->id_tipo_de_operacion; ?>
                                                    <option value="<?php echo $id_tipo_operacion; ?>"><?php echo $tipo_de_operacion->tipo_de_operacion ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" id="id-tipo-de-pago" name="id-tipo-de-pago">
                                            <!-- Fin del campo -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Serial de Pago:</label>
                                            <input type="text" class="form-control" id="serial-de-pago" name='serial-de-pago' readonly>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label for="">Cédula del Titular:</label>
                                            <input type="text" class="form-control" id="cedula-titular" name='cedula-titular'>
                                        </div>
                    
                                        <div class="col-md-6">
                                            <label for="">Nombre del Titular:</label>
                                            <input type="text" class="form-control" name="nombre-titular" id='nombre-titular' readonly>
                                            <input type="hidden" id="id-titular" name="id-titular">   
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="">Monto de Operación:</label>
                                            <input type="text" class="form-control" name="monto-de-operacion" id="monto-de-operacion" value="<?php echo set_value('monto-de-operacion'); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Fecha de Operación:</label>
                                            <input type="date" class="form-control" name="fecha-operacion" id="fecha-operacion" value="<?php echo set_value('fecha-operacion'); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="">Banco de Operación:</label>
                                            <input type="text" class="form-control" id="banco-de-operacion" name="banco-de-operacion">
                                            <input type="hidden" id="id-banco-de-operacion" name="id-banco-de-operacion">  
                                        </div>

                                        <div class="col-md-4 <?php echo !empty(form_error('numero-de-operacion-unico')) ? 'has-error' : ''; ?>">
                                            <label for="">Número de Operación:</label>
                                            <input type="text" class="form-control" id="numero-de-operacion-unico" name="numero-de-operacion-unico" value="<?php echo set_value('numero-de-operacion-unico'); ?>">
                                            <?php echo form_error('numero-de-operacion-unico', '<span class="help-block">', '</span>'); ?>
                                        </div>

                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" id="btn-guardar-inscripcion-pago" class="btn btn-success btn-flat">Guardar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->    

             </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>