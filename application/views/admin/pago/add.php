
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pago
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
                            
                        
                        <form action="<?php echo base_url();?>movimientos/pago/store" method="POST" class="form-horizontal">
                            
                            <!-- <input type="hidden" name="modulo-actual" value="pagos"> -->

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

                                    <input type="hidden" id="id_tipo_de_pago" name="id_tipo_de_pago">
                                    <!-- Fin del campo -->

                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="cedula_titular">Cédula del Titular</label>
                                    <input type="text" class="form-control" id="cedula_titular" name='cedula_titular'>
                                </div>
         
                                <div class="col-md-6">
                                    <label for="">Nombre del Titular</label>
                                    <input type="text" class="form-control" name="nombre_titular" id='nombre_titular' readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">

                                <div class="col-md-4">
                                    <label for="">Monto de Operación</label>
                                    <input type="text" class="form-control" id="monto_de_operacion" name="monto_de_operacion" value="<?php echo set_value('monto_de_operacion'); ?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Fecha de Operación</label>
                                    <input type="date" class="form-control" name="fecha-operacion">
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Banco de Operación</label>
                                    <input type="text" class="form-control" id="banco_de_operacion" name="banco_de_operacion">
                                    <input type="hidden" id="id_banco_de_operacion" name="id_banco_de_operacion">  
                                </div>

                                <div class="col-md-4 <?php echo !empty(form_error('numero_referencia')) ? 'has-error' : ''; ?>">
                                    <label for="">Número de Referencia</label>
                                    <input type="text" class="form-control" id="numero_referencia" name="numero_referencia" value="<?php echo set_value('numero_referencia'); ?>">
                                    <?php echo form_error('numero_referencia', '<span class="help-block">', '</span>'); ?>
                                </div>

                            </div>
                           
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/pago.add.js"></script>

