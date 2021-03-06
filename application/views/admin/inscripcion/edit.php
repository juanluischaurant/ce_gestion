<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inscripciones
        <small>Editar</small>
        </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs" id="edit-inscripcion-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true" id="tab-cambiar-curso">Curso</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true" id="tab-asociar-pago">Asociar Pago</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true" id="tab-desasociar-pago">Desasociar Pago</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- #tab_1 -->
                        <div class="tab-pane active" id="tab_1">

                             <!-- Default box -->
                            <div class="box box-solid">
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div>
                                                <h4>
                                                    <b>Curso Actual:</b> <?php echo $data_curso_inscrito->nombre_completo_instancia; ?>
                                                </h4>
                                            </div>
                                            
                                            <form action="<?php echo base_url();?>movimientos/inscripcion/update_curso" method="POST" class="form-horizontal" id='editar-curso'>
                                            
                                                <!-- IDs necesarios para la operación -->

                                                <input type="hidden" name="id-curso-actual" value="<?php echo  $data_curso_inscrito->id; ?>">
                                                
                                                <input type="hidden" name="id_inscripcion" value="<?php echo  $data_inscripcion->id; ?>">
                                                <input type="hidden" name="id_participante" id="id_participante" value="<?php echo  $data_inscripcion->cedula_persona; ?>">
                                                
                                                <div class="box">

                                                    <div class="box-header">
                                                        <h4 class="box-title">Cambiar Curso</h4>

                                                        <div class="input-group margin col-md-5">

                                                            <input type="text" class="form-control" id="producto">

                                                            <span class="input-group-btn">

                                                                <button type="button" class="btn btn-success btn-flat" id="btn-agregar-curso">
                                                                    <span class="fa fa-paperclip"></span>
                                                                </button>

                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-header -->

                                                    <div class="box-body table-responsive">
                                                        <table id="tabla-cursos" class="table table-hover">

                                                        <thead>
                                                            <tr>
                                                                <th>Código</th>
                                                                <th>Nombre</th>
                                                                <th>Cupos</th>
                                                                <th>Ocupados</th>
                                                                <th>Precio</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $data_curso_inscrito->serial; ?></td>
                                                                <td><?php echo $data_curso_inscrito->nombre_completo_instancia; ?></td>
                                                                <td><?php echo $data_curso_inscrito->cupos; ?></td>
                                                                <td><?php echo $data_curso_inscrito->cupos_curso_ocupados; ?></td>
                                                                <td>
                                                                    <input type="hidden" name="precioactualcursos[]" value="<?php echo $data_curso_inscrito->precio; ?>">
                                                                    <?php echo $data_curso_inscrito->precio; ?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger btn-remove-especialidad">
                                                                        <span class="fa fa-remove"></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                        </table>
                                                        <!-- /.table -->

                                                    </div>
                                                    <!-- /.box-body -->

                                                </div>
                                                <!-- /.box -->


                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" form='editar-curso' id='editar-curso' class="btn btn-success btn-flat">
                                                            Guardar
                                                        </button>
                                                        <button type="button" class="btn btn-cancel-edicion-inscripcion">
                                                            Cancelar
                                                        </button>
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
                        <!-- /.tab-pane #tab_1 -->
                        
                        <!-- #tab_2 -->
                        <div class="tab-pane" id="tab_2">

                            <!-- Agregar Pago box -->
                            <div class="box box-solid">
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div>
                                                <h4><b>Gestión de Pagos: Agregar Pagos</b></h4>
                                            </div>
                                                                    
                                            <form action="<?php echo base_url();?>movimientos/inscripcion/update_asociar_pago" method="POST" class="form-horizontal" id='agregar-pago'>
                                                <!-- ID De la inscripción de curso bajo edición -->
                                                <input type="hidden" name="id-inscripcion-actual" value="<?php echo $data_inscripcion->id; ?>">
                                                                                        
                                                <div class="box">
                                                    <div class="box-header">
                                                        <h4 class=box-title>Agregar Pago</h4>
                                                        <div class="input-group margin col-md-5">

                                                            <input type="text" class="form-control" id="numero-de-operacion">

                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-success btn-flat" id="btn-agregar-pago">
                                                                    <span class="fa fa-paperclip"></span>
                                                                </button>
                                                            </span>
                                                        </div>

                                                    </div>
                                                    <!-- /.box-header -->

                                                    <div class="box-body table-responsive">
                                                        <table id="tabla-pagos" class="table table-hover">

                                                            <thead>
                                                                <tr>
                                                                    <th>Número de Operación</th>
                                                                    <th>Monto de Operación</th>
                                                                    <th>Cédula</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            
                                                            </tbody>

                                                        </table>
                                                        <!-- /.table -->
                                                    </div>
                                                    <!-- /.box-body -->

                                                </div>
                                                <!-- /.box -->

                                                <?php 

                                                    //$monto_pagado = $data_inscripcion->monto_pagado;
                                                    //$deuda_pendiente = $data_inscripcion->deuda;
                                                    $costo = $data_inscripcion->costo;
                                                ?>

                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">En Operación:</span>
                                                            <input type="text" class="form-control" value="" placeholder="0.00" name="monto-en-operacion" id="monto-en-operacion" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Costo Inscripción:</span>
                                                            <input type="text" value="<?php echo number_format((float)$costo, 2, '.', ''); ?>" class="form-control" placeholder="0.00" name="costo-de-inscripcion" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Deuda:</span>
                                                            <input type="text" class="form-control" placeholder="0.00" name="deuda" value="<?php echo number_format((float)$montos_de_inscripcion->calculo_deuda, 2, '.', ''); ?>" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" form='agregar-pago' id='btn-agregar-nuevo-pago' class="btn btn-success btn-flat">Guardar</button>
                                                    </div>  
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->   
                
                        </div>
                        <!-- /.tab-pane #tab_2 -->

                        <!-- #tab_3 -->
                        <div class="tab-pane" id="tab_3">
                        
                            <!-- Eliminar Pago Asociado box -->
                            <div class="box box-solid">
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div>
                                                <h4><b>Gestión de Pagos: Pagos Asociados</b></h4>
                                            </div>

                                            <div class="box">

                                                <div class="box-header">
                                                    <h4 class="box-title">Pagos asociados</h4>
                                                </div>
                                                <!-- /.box-header -->

                                                <div class="box-body table-responsive">
                                                    <table id="pagos-asociados" class="table table-hover">

                                                    <thead>
                                                        <tr>
                                                            <th>Número de Operación</th>
                                                            <th>Monto de Operación</th>
                                                            <th>Cédula</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php if(!empty($pagos_de_inscripcion)): ?>
                                                    <!-- A cada registro <tr> generado por la siguietnte función
                                                        se le asigna un id único que es tomado del id del pago
                                                        y una clase .pago-registrado que le permitirá diferenciarse
                                                        de los pagos agregados posteriormente -->
                                                        <?php foreach($pagos_de_inscripcion as $pdi): ?>
                                                            <tr id='<?php echo $pdi->id; ?>' class='pago-registrado'>                                                    
                                                                <td>
                                                                    <input type="hidden" name="id-pago[]" value="<?php echo $pdi->id; ?>">
                                                                    <?php echo $pdi->numero_referencia_bancaria; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $pdi->monto_operacion; ?>
                                                                </td>
                                                                <td><?php echo $pdi->cedula_titular_pago; ?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-warning btn-remove-inscripcion-pago">
                                                                        <span class="fa fa-lock"></span>
                                                                    </button>
                                                                </td>
                                                                
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </tbody>

                                                    </table>
                                                    <!-- /.table -->

                                                </div>
                                                <!-- /.box-body -->

                                            </div>
                                            <!-- /.box -->
                                                                    
                                            <form action="<?php echo base_url();?>movimientos/inscripcion/update_desasociar_pago" method="POST" class="form-horizontal" id='desasociar-pago'>
                                                <!-- ID De la inscripción de curso bajo edición -->
                                                <input type="hidden" name="id-inscripcion" value="<?php echo $data_inscripcion->id; ?>">

                                                <div class="box">

                                                    <div class="box-header">
                                                        <h4 class="box-title">Pagos a desasociar</h4>
                                                    </div>
                                                    <!-- /.box-header -->

                                                    <div class="box-body table-responsive">
                                                        <table id="pagos-desasociados" class="table table-hover">

                                                        <thead>
                                                            <tr>
                                                                <th>Número de Operación</th>
                                                                <th>Monto de Operación</th>
                                                                <th>Cédula</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <!-- Aquí se ingresarán datos de manera dinámica -->
                                                                            
                                                        </tbody>

                                                        </table>
                                                        <!-- /.table -->

                                                    </div>
                                                    <!-- /.box-body -->

                                                </div>
                                                <!-- /.box -->

                                                <div class="col-xs-12 table-responsive">
                                                    
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">En Operación:</span>
                                                            <input type="text" class="form-control" value="" placeholder="0.00" name="monto-en-operacion" id="monto-en-operacion" readonly="readonly">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Costo Inscripción:</span>
                                                            <input type="text" value="<?php echo number_format((float)$costo, 2, '.', ''); ?>" class="form-control" placeholder="0.00" name="costo-de-inscripcion" readonly="readonly">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Deuda:</span>
                                                            <input type="text" class="form-control" placeholder="0.00" name="deuda" value="<?php echo number_format((float)$montos_de_inscripcion->calculo_deuda, 2, '.', ''); ?>" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->

                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" form='desasociar-pago' id='btn-desaociar-pago' class="btn btn-success btn-flat">
                                                            Guardar
                                                        </button>
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
                        <!-- /.tab-pane #tab_3 -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->

            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
        
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/inscripcion.edit.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/inscripcion.add.js"></script>