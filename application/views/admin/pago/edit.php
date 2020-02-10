
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
        <div class="box box-primary">

            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de Pago: <?php echo $pago->tipo; ?></h3>

                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>

            </div>

            <form action="<?php echo base_url();?>movimientos/pago/update" method="POST">
                
                <div class="box-body">
                    <div class="centrar_div">

                            <input type="hidden" value="<?php echo $pago->id; ?>" id="id-pago" name="id-pago">
                            
                            <div class="row">

                                <div class="form-group col-md-8">
                                    <?php
                                        // Verifica si hay un valor seleccionado en la lista, si no, imprime el valor 'has-error'
                                        // $error = !empty(form_error('genero_persona'))? 'has-error' : '';
                                        
                                        // Estructura el atributo class y concatena el valor anterior
                                        $atributos = array('class' => 'form-control', 'readonly' => 'readonly');
                                        $selected = isset($pago->id_tipo_operacion) ? $pago->id_tipo_operacion : '';

                                        // Genera la etiquera
                                        echo form_label('Tipo de Pago');

                                        // Genera el elemento "select" (LA VARIABLE $lista_generos viene desde el controlador)
                                        // Parámetros de form_dropdown: nombre, valores de la lista, valor para seleccionar 'selected', atributos
                                        echo form_dropdown('tipo_de_pago', $tipos_de_operacion, $selected, $atributos);
                                        ?>
                                    <?php echo form_error('genero_persona', '<span class="help-block">', '</span>'); ?>

                                <!-- Fin del campo -->    
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="">Monto de Operación</label>
                                    <input type="text" value="<?php echo $pago->monto_operacion; ?>" class="form-control" name="monto_de_operacion">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Cédula del Titular</label>
                                    <input type="text" class="form-control" id="cedula_titular" name='cedula_titular' value="<?php echo $pago->cedula_titular; ?>">
                                </div>
            
                                <div class="form-group col-md-8">
                                    <label for="">Nombre del Titular</label>
                                    <?php $nombre =  $pago->primer_nombre . " " . $pago->primer_apellido; ?>
                                    <input type="text" class="form-control" name="nombre_titular" id='nombre_titular' value="<?php echo $nombre; ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Fecha de Operación</label>
                                    <input type="date" value="<?php echo $pago->fecha_operacion; ?>" class="form-control" name="fecha-operacion" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="">Banco de Operación</label>
                                    <input type="text" value="<?php echo $pago->nombre_banco; ?>" class="form-control" id="banco_de_operacion" name="banco_de_operacion">
                                    <input type="hidden" value="<?php echo $pago->id_banco; ?>" id="id_banco_de_operacion" name="id_banco_de_operacion">  
                                </div>

                                <div class="form-group col-md-4 <?php echo !empty(form_error('numero_referencia')) ? 'has-error' : ''; ?>">
                                    <label for="">Número de Operación</label>
                                    <input type="text" value="<?php echo $pago->numero_referencia_bancaria; ?>" class="form-control" id="numero_referencia" name="numero_referencia" value="<?php echo set_value('numero_referencia'); ?>" readonly>
                                    <?php echo form_error('numero_referencia', '<span class="help-block">', '</span>'); ?>
                                </div>

                            </div>

                    </div>
                    <!-- /.centrar_div -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
    
</div>
<!-- /.content-wrapper -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/pago.edit.js"></script>
