
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
                            
                            <input type="hidden" name="modulo-actual" value="pagos">

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
                                    <input type="text" class="form-control" name="nombre_titular" id='nombre_titular' readonly>
                                    <input type="hidden" id="id-titular" name="id-titular">   
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">

                                <div class="col-md-4">
                                    <label for="">Monto de Operación:</label>
                                    <input type="text" class="form-control" id="monto-de-operacion" name="monto-de-operacion" value="<?php echo set_value('monto-de-operacion'); ?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Fecha de Operación:</label>
                                    <input type="date" class="form-control" name="fecha-operacion" required>
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