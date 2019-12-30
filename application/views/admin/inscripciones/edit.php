

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
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <div class="row">
                    <div class="col-md-12">

                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <div>
                            <?php if(!empty($data_instancias)): ?>
                                <?php foreach($data_instancias as $data_instancia): ?>
                                    <h4><b>Instancia Actual:</b> <?php echo $data_instancia->nombre_completo_instancia; ?></h4>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        
                        <form action="<?php echo base_url();?>movimientos/inscripciones/update" method="POST" class="form-horizontal" id='editar-instancia'>
                            <!-- ID De la inscripción de instancia bajo edición -->
                            <input type="hidden" name="id-inscripcion-instancia" value="<?php echo $data_inscripcion_instancia->id_inscripcion_instancia; ?>">
                            <input type="hidden" name="id-instancia-actual" value="<?php echo  $data_inscripcion_instancia->id_instancia; ?>">
                            <input type="hidden" name="id_participante" id="id_participante" value="<?php echo  $data_inscripcion_instancia->id_participante; ?>">
                            
                            <h5>Agregar Instancia:</h5>
                            <div class="input-group margin col-md-5">

                                <input type="text" class="form-control" id="producto">

                                <span class="input-group-btn">

                                    <button type="button" class="btn btn-success btn-flat" id="btn-agregar-curso">
                                        <span class="fa fa-paperclip"></span>
                                    </button>

                                </span>
                            </div>

                            <table id="tabla-instancias" class="table table-bordered table-striped table-hover">
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

                                <?php if(!empty($data_instancias)): ?>
                                    <?php foreach($data_instancias as $di): ?>
                                        <tr>
                                            <td><?php echo $di->id_instancia; ?></td>
                                            <td><?php echo $di->nombre_completo_instancia; ?></td>
                                            <td><?php echo $di->cupos_instancia; ?></td>
                                            <td><?php echo $di->cupos_instancia_ocupados; ?></td>
                                            <td>
                                            <input type="hidden" name="precioactualcursos[]" value="<?php echo $di->precio_instancia; ?>">
                                                <?php echo $di->precio_instancia; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-remove-curso">
                                                    <span class="fa fa-remove"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                </tbody>
                            </table>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" form='editar-instancia' id='actualizar-inscripcion' class="btn btn-success btn-flat">
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

        <!-- Payments box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <div class="row">
                    <div class="col-md-12">

                        <div>
                            <?php if(!empty($data_instancias)): ?>
                                <?php foreach($data_instancias as $data_instancia): ?>
                                    <h4><b>Gestión de Pagos</b></h4>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                                                
                        <form action="<?php echo base_url();?>movimientos/inscripciones/update_inscripcion_pago" method="POST" class="form-horizontal" id='editar_pago'>
                            <!-- ID De la inscripción de instancia bajo edición -->
                            <input type="hidden" name="id-inscripcion-actual" value="<?php echo $data_inscripcion_instancia->id_inscripcion; ?>">

                            <h5>Agregar Pago</h5>
                            <div class="input-group margin col-md-5">

                                <input type="text" class="form-control" id="numero-de-operacion">

                                <span class="input-group-btn">

                                    <button type="button" class="btn btn-success btn-flat" id="btn-agregar-pago">
                                        <span class="fa fa-paperclip"></span>
                                    </button>

                                </span>
                            </div>

                            <div class="col-xs-12 table-responsive">
                                                                    
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
                                    <?php if(!empty($pagos_de_inscripcion)): ?>
                                    <!-- A cada registro <tr> generado por la siguietnte función
                                        se le asigna un id único que es tomado del id del pago
                                        y una clase .pago-registrado que le permitirá diferenciarse
                                        de los pagos agregados posteriormente -->
                                        <?php $total_pagado = 0; ?>
                                        <?php foreach($pagos_de_inscripcion as $pdi): ?>
                                            <?php $total_pagado +=  $pdi->monto_operacion;?>
                                            <tr id='<?php echo $pdi->id_pago; ?>' class='pago-registrado'>
                                                <td>
                                                    <input type="hidden" name="id-pago[]" value="<?php echo $pdi->id_pago; ?>">
                                                    <?php echo $pdi->serial_pago; ?>
                                                </td>
                                                <td><?php echo $pdi->numero_operacion; ?></td>
                                                <td>
                                                    <?php echo $pdi->monto_operacion; ?>
                                                </td>
                                                <td><?php echo $pdi->cedula_titular_pago; ?></td>
                                                <td>
                                                    <?php $ruta =  base_url().'movimientos/inscripciones/remove_inscripcion_pago/'.$pdi->id_pago; ?>
                                                    <a href="<?php echo $ruta; ?>" class="btn btn-warning btn-remove-inscripcion-pago">
                                                        <span class="fa fa-unlock"></span>
                                                    </a>
                                                </td>
                                               
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">Monto Pagado:</span>
                                            <input type="text" class="form-control" value="<?php echo number_format((float)$total_pagado, 2, '.', ''); ?>" placeholder="0.00" name="monto-pagado" id="monto-pagado" readonly="readonly">
                                        </div>
                                    </div>

                                    <?php
                                        $total = 0;
                                        $deuda = 0;

                                        foreach($data_instancias as $di)
                                        {
                                            $total += $di->precio_instancia;
                                        }

                                        $deuda = $total - $total_pagado;
                                    ?>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">Subtotal:</span>
                                            <input type="text" class="form-control"  placeholder="0.00" name="subtotal" readonly="readonly">
                                        </div>
                                    </div>

                                    <?php

                                    ?>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">Deuda:</span>
                                            <input type="text" class="form-control" placeholder="0.00" name="deuda" value="<?php echo number_format((float)$deuda, 2, '.', ''); ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">A Pagar:</span>
                                            <input type="text" value="<?php echo number_format((float)$total, 2, '.', ''); ?>" class="form-control" placeholder="0.00" name="total" readonly="readonly">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" form='editar_pago' id='actualizar-inscripcion-pago' class="btn btn-success btn-flat">
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
        
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->