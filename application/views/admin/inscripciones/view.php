
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Persona registrada el día: <?php echo $inscripcion->fecha_inscripcion; ?>
    </div>
</div> <br>
<div class="row">
	<div class="col-xs-6">	
		<b>PARTICIPANTE</b><br>
		<b>Participante:</b> <?php echo $inscripcion->nombre_completo_participante; ?> <br>
		<b>Cédula:</b> <?php echo $inscripcion->cedula_persona; ?><br>
		<b>Teléfono:</b> <?php echo $inscripcion->telefono_persona; ?> <br>
		<b>Dirección:</b> <?php echo $inscripcion->direccion_persona; ?><br>
	</div>	
	<?php foreach($pagos_de_inscripcion as $pago_de_inscripcion): ?>
	<div class="col-xs-6">	
		<b>PAGO</b> <br>
		<b>Tipo de Pago:</b> Boleta<br>
		<b>Serial Operación:</b> <?php echo $pago_de_inscripcion->serial_pago; ?><br>
		<b># de Operación:</b> 001<br>
		<b>Fecha de Operación:</b> 000001<br>
		<b>Fecha de Pago:</b> 17/12/1990<br>
		<b>Cliente:</b> 17/12/1990<br>
		<b>Cédula:</b> 17/12/1990<br>
	</div>	
	<?php endforeach; ?>
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Precio</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($inscripciones_cursos as $inscripcion_curso): ?>
				<tr> 
					<td><?php echo $inscripcion_curso->nombre_completo_instancia; ?></td>
					<td><?php echo $inscripcion_curso->nombre_completo_instancia; ?></td>
					<td><?php echo $inscripcion_curso->precio_instancia; ?></td>
				</tr>
				<?php endforeach; ?>
				
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Monto Pagado:</strong></td>
					<td><?php echo $inscripcion->monto_pagado; ?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
					<td><?php echo $inscripcion->precio_total; ?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Deuda:</strong></td>
					<td><?php echo $inscripcion->deuda; ?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo $inscripcion->precio_final; ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>