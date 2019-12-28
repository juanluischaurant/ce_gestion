
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
		<b><?php echo $pago->serial_pago; ?>:</b> <?php echo $pago->fecha_registro_operacion; ?>
    </div>
</div> <br>
<div class="row">
	<div class="col-xs-6 text-right">		
		<b>Titular:</b><br>
		<b>Cédula:</b><br>
		<b>Monto de Operación:</b><br>
		<b>Estado Pago:</b><br><br>
		<b>Banco de Operación:</b><br>
		<b>Número de Operación:</b><br>
		<b>Tipo de Operación:</b><br>
		<b>Fecha de Operación:</b><br>
	</div>

	<div class="col-xs-6">	
		<?php echo $pago->nombres_persona . " " . $pago->apellidos_persona;?><br>
		<?php echo $pago->cedula_persona; ?><br>
		<?php $monto_pagado = ($pago->monto_operacion == '') ? '0.00' : $pago->monto_operacion; ?>
		<?php echo $monto_pagado . ' Bs.';?><br>

        <?php if($pago->estado_pago == 1): ?>
            <small class="label label-success">
                <i class="fa fa-clock-o"></i> Disponible
            </small>
            <br>
        <?php endif; ?> 
        <?php if($pago->estado_pago == 2): ?>
            <small class="label label-danger">
                <i class="fa fa-clock-o"></i> Usado
            </small>
            <br>
        <?php endif; ?> 
        <br>

		<?php echo $pago->nombre_banco; ?><br>
		<?php echo ($pago->numero_operacion == NULL) ? 'No Aplica' : $pago->numero_operacion; ?><br>
		<?php echo $pago->tipo_de_operacion; ?><br>
		<?php echo $pago->fecha_operacion; ?><br>
		
	</div>

</div>