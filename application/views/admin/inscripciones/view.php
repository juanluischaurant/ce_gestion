
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Persona registrada el día: <?php echo $inscripcion->fecha_inscripcion; ?>
    </div>
</div>

<br>

<div class="row">

<div class="col-xs-12">

<div class="box">
	<div class="box-body table-responsive no-padding">
	<table class="table table-striped">
		<thead>
			<tr>
				<td><b>Participante</b></td>
				<td><b>Cédula</b></td>
				<td><b>Teléfono</b></td>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><?php echo $inscripcion->nombre_completo_participante; ?></td>
				<td><?php echo $inscripcion->cedula_persona; ?></td>
				<td><?php echo $inscripcion->telefono_persona; ?></td>	
			</tr>
			<tr>
				<td colspan="2"><b>Dirección:</b> <?php echo $inscripcion->direccion_persona; ?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

</div>

	<div class="col-xs-12 table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Serial #</th>
					<th>Instancia Inscrita</th>
					<th>Costo</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo $data_instancia_inscrita->serial_instancia; ?></td>
					<td><?php echo $data_instancia_inscrita->nombre_completo_instancia; ?></td>
					<td><?php echo $data_instancia_inscrita->precio_instancia; ?> Bs.</td>
				</tr>
				<tr>
				<td></td>
					<td colspan="" class="text-right"><strong>Monto Pagado:</strong></td>
					<td><?php echo $inscripcion->monto_pagado; ?> Bs.</td>
				</tr>
					<td></td>
					<td colspan="" class="text-right"><strong>Deuda:</strong></td>
					<td><?php echo $inscripcion->deuda; ?> Bs.</td>
				<tr>

				</tr>
			</tbody>
			
		</table>
		<!-- /table -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->

<div class="row">

	<div class="col-md-12">
		<!-- The time line -->
		<ul class="timeline">
		<?php foreach($pagos_de_inscripcion as $pdi): ?>
		
			<!-- timeline item -->
			<li>
				<i class="fa fa-money bg-blue"></i>

				<div class="timeline-item">
				<span class="time">
					<i class="fa fa-clock-o"></i> <?php echo $pdi->fecha_registro_operacion; ?>
				</span>

				<h4 class="timeline-header">
					<a href="#"><?php echo $pdi->tipo_de_operacion; ?>:</a> <?php echo $pdi->numero_operacion; ?>
				</h4>

				<div class="timeline-body">
					<div class="row">
					<div class="col-xs-12 col-md-8">
					Titular: <?php echo $pdi->nombre_titular; ?><br>
					Banco: <?php echo $pdi->nombre_banco; ?><br>
					
					</div>
					<div class="col-xs-12 col-md-4">
					Cédula: <?php echo $pdi->cedula_persona; ?><br>
					Fecha: <?php echo $pdi->fecha_operacion; ?><br>
					Monto: <?php echo $pdi->monto_operacion; ?> Bs.<br>
					
					</div>
					</div>
				</div>
	
				</div>
			</li>
			<!-- END timeline item -->

		<?php endforeach; ?>
		</ul>
	</div>

</div>
