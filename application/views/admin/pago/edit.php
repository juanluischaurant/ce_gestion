
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pago
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
                                                    
                        <form action="<?php echo base_url();?>movimientos/pago/update" method="POST" class="form-horizontal">
                            
                            <input type="hidden" value="<?php echo $pago->id; ?>" id="id-pago" name="id-pago">

                            <div class="form-group">
                                <div class="col-md-3">
                                    <!-- Campo select rellenado con data de la BD -->
                                    <label for="">Tipo de Pago</label>
                                    <select name="tipo_de_pago" id="tipo_de_pago" class="form-control" disabled>
                                        <option value="">Seleccione...</option>
                                        <?php foreach($tipos_de_operacion as $tipo_de_operacion) : ?>
                                            <?php $dataTipoOperacion = $tipo_de_operacion->id_tipo_de_operacion.'*'.$tipo_de_operacion->conteo_operaciones.'*'.$tipo_de_operacion->tipo_de_operacion ?>
                                            <option value="<?php echo $dataTipoOperacion; ?>"><?php echo $tipo_de_operacion->tipo_de_operacion ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="id_tipo_de_pago" name="id_tipo_de_pago">
                                    <!-- Fin del campo -->
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="">Cédula del Titular</label>
                                    <input type="text" class="form-control" id="cedula_titular" name='cedula_titular'>
                                </div>
         
                                <div class="col-md-6">
                                    <label for="">Nombre del Titular</label>
                                    <?php $nombre =  $pago->nombres . " " . $pago->apellidos; ?>
                                    <input type="text" class="form-control" name="nombre_titular" id='nombre_titular' value="<?php echo $nombre; ?>" readonly>
                                    <input type="hidden" id="cedula_titular" name="cedula_titular" value="<?php echo $pago->cedula_titular; ?>">   
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="">Monto de Operación</label>
                                    <input type="text" value="<?php echo $pago->monto_operacion; ?>" class="form-control" name="monto_de_operacion">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Fecha de Operación</label>
                                    <input type="date" value="<?php echo $pago->fecha_operacion; ?>" class="form-control" name="fecha-operacion" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Banco de Operación</label>
                                    <input type="text" value="<?php echo $pago->nombre_banco; ?>" class="form-control" id="banco_de_operacion" name="banco_de_operacion">
                                    <input type="hidden" value="<?php echo $pago->id_banco; ?>" id="id_banco_de_operacion" name="id_banco_de_operacion">  
                                </div>

                                <div class="col-md-4 <?php echo !empty(form_error('numero_referencia')) ? 'has-error' : ''; ?>">
                                    <label for="">Número de Operación</label>
                                    <input type="text" value="<?php echo $pago->numero_referencia_bancaria; ?>" class="form-control" id="numero_referencia" name="numero_referencia" value="<?php echo set_value('numero_referencia'); ?>" readonly>
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
