
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
                <div class="row">
                    <div class="col-md-12">
                        
                        <form action="<?php echo base_url();?>movimientos/inscripciones/store" method="POST" class="form-horizontal">
                            
                            <div class="form-group">

                                <div class="col-md-5">
                                    <label for="">Buscar Pago:</label>
                                    <input type="text" class="form-control" id="numero-de-operacion">
                                </div>

                                <div class="col-md-1">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-pago" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span></button>
                                </div>

                            </div>
                            <table id="tabla-pagos" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Serial Pago</th>
                                        <th>Número de Operación</th>
                                        <th>Monto de Operación</th>
                                        <th>Cédula</th>
                                        <th>Monto</th>
                                        <th></th>
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
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div> 
                                <div class="col-md-3">
                                    <label for="">Fecha de Inscripción:</label>
                                    <input type="date" class="form-control" name="fecha-inscripcion" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Buscar Producto:</label>
                                    <input type="text" class="form-control" id="producto">
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
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
                </div>
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
                                    <button type='button' class='btn btn-success btn-check' value='<?php echo $dataParticipante; ?>'><span class="fa fa-check"></span></button>
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
