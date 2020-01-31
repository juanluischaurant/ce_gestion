
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
                        
                <form action="<?php echo base_url();?>movimientos/inscripcion/store" method="POST" class="form-horizontal">
                            
                    <p>Buscar Pago</p>
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
                                <th>Número de Referencia</th>
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

                            <label for="">Seleccionar Participante</label>
                            <div class="input-group">
                                <input type="hidden" name="cedula_persona" id="cedula_persona">
                                <input type="text" class="form-control" disabled="disabled" id="nombre_participante">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="btn-buscar-participante" type="button" data-toggle="modal" data-target="#modal-default">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                            </div><!-- /input-group -->

                        </div> 

                    </div>

                    <p>Seleccionar Curso</p>
                    <div class="input-group margin col-md-5">

                        <input type="text" class="form-control" id="producto" disabled="disabled">

                        <span class="input-group-btn">

                            <button type="button" class="btn btn-success btn-flat" id="btn-agregar-curso">
                                <span class="fa fa-paperclip"></span>
                            </button>

                        </span>
                    </div>

                    <table id="tabla-cursos" class="table table-bordered table-striped table-hover">
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
                                <span class="input-group-addon">En Operación</span>
                                <input type="text" class="form-control" value="" placeholder="0.00" name="monto-en-operacion" id="monto-en-operacion" readonly="readonly">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Costo Inscripción</span>
                                <input type="text" value="0.00" class="form-control" placeholder="0.00" name="costo-de-inscripcion" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Deuda</span>
                                <input type="text" value="0.00" class="form-control" placeholder="0.00" name="deuda" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" id="btn-guardar-inscripcion" class="btn btn-success btn-flat"  disabled="disabled">Guardar</button>
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
                <h4 class="modal-title">Lita de Titulares</h4>
            </div>
            <div class="modal-body">
                <table id="lista-participante" class="table table-bordered table-striped table-hover">

                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Opcion</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if(!empty($participantes)): ?>
                    <?php foreach($participantes as $participante): ?>
                        <tr>
                            <td><?php echo $participante->cedula_persona; ?></td>
                            <td><?php echo $participante->primer_nombre; ?></td>
                            <td><?php echo $participante->apellidos; ?></td>
                            <?php $dataParticipante = $participante->cedula_persona.'*'.$participante->primer_nombre.'*'.$participante->apellidos.'*'.$participante->telefono; ?>
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

            <div class="modal-body ui-front">
 
            <form action="" id="registrar_pago" method="POST" class="form-horizontal">         

                <div class="form-group">

                    <div class="col-md-3">
                        <!-- Campo select rellenado con data de la BD -->
                        <label for="">Tipo de Pago</label>
                        <select name="tipo_de_pago" id="tipo_de_pago" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <?php foreach($tipos_de_operacion as $tipo_de_operacion) : ?>
                                <?php $id_tipo_de_operacion = $tipo_de_operacion->id; ?>
                                <option value="<?php echo $id_tipo_de_operacion; ?>"><?php echo $tipo_de_operacion->tipo ?></option>
                            <?php endforeach; ?>
                        </select> 
                        <!-- Fin del campo -->
                    </div>
                    
                </div>
                <!-- /.form-group -->

                <hr>

                <div class="form-group">

                    <div class="col-md-3">
                        <label for="">Cédula del Titular:</label>
                        <input type="text" class="form-control" id="cedula_titular" name="cedula_titular" value="<?php echo set_value('cedula_titular'); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="">Nombre del Titular:</label>
                        <input type="text" class="form-control" name="nombre_titular" id='nombre_titular' readonly>
                         
                    </div>

                </div>
                <!-- /.form-group -->

                <hr>

                <div class="form-group">

                    <div class="col-md-4">
                        <label for="">Monto de Operación:</label>
                        <input type="number" class="form-control" name="monto_de_operacion" id="monto_de_operacion" value="<?php echo set_value('monto_de_operacion'); ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="">Fecha de Operación:</label>
                        <input type="date" class="form-control" name="fecha-operacion" id="fecha-operacion" value="<?php echo set_value('fecha-operacion'); ?>" required>
                    </div>

                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <div class="col-md-10">
                        <label for="">Banco de Operación</label>
                        <input type="text" class="form-control" id="banco_de_operacion" name="banco_de_operacion">
                    </div>  
                </div>
                <!-- /.form-group -->
             
                <div class="form-group">

                    <div class="col-md-10">
                        <label class="control-label" for="numero_referencia"><i class="fa fa-check hidden"></i> Número de Referencia</label>
                        <input type="text" class="form-control" id="numero_referencia" name="numero_referencia" placeholder="Número de Referencia Bancaria">
                    </div>
          
                    <div class="col-md-4">
                        <button type="button" id="verificar-numero-pago" class="btn bg-olive btn-flat margin">Verificar</button>
                    </div>
                </div>

             </div>
             <!-- /.modal-body -->

             <div class="modal-footer">
                <!-- <input type="hidden" name="modulo-actual" value="inscripciones"> -->
                <!-- <input type="hidden" id="id_tipo_de_pago" name="id_tipo_de_pago"> -->
                <input type="hidden" id="id_banco_de_operacion" name="id_banco_de_operacion"> 

                <button type="submit" id="btn-guardar-inscripcion-pago" class="btn btn-success btn-flat" disabled="disabled">Guardar</button>                        
             </div>
             <!-- /.modal-footer -->

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/inscripcion.add.js"></script>
<!-- Ciertos métodos de pago.add.js son utilizados en la sección de agregar pago. -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/pago.add.js"></script>