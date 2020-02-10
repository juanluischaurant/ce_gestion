
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Inscripción registrada: <?php echo $inscripcion->fecha_registro; ?>
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
				<td><?php echo $inscripcion->telefono; ?></td>	
			</tr>
			<tr>
				<td colspan="2"><b>Dirección:</b> <?php echo $inscripcion->direccion; ?></td>
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
					<th>Curso Inscrita</th>
					<th>Costo</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo $data_curso_inscrito->serial; ?></td>
					<td><?php echo $data_curso_inscrito->nombre_completo_instancia; ?></td>
					<td><?php echo $inscripcion->costo; ?> Bs.</td>
				</tr>
				<tr>
				<td></td>
					<td colspan="" class="text-right"><strong>Monto Pagado:</strong></td>
					<td><?php echo $montos_de_inscripcion->calculo_monto_pagado; ?> Bs.</td>
				</tr>
					<td></td>
					<td colspan="" class="text-right"><strong>Deuda:</strong></td>
					<td><?php echo $montos_de_inscripcion->calculo_deuda; ?> Bs.</td>
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
					<i class="fa fa-clock-o"></i> <?php echo $pdi->fecha_registro; ?>
				</span>

				<h4 class="timeline-header">
					<a href="#"><?php echo $pdi->tipo; ?>:</a> <?php echo $pdi->numero_referencia_bancaria; ?>
				</h4>

				<div class="timeline-body">
					<div class="row">
					<div class="col-xs-12 col-md-8">
					Titular: <?php echo $pdi->nombre_titular; ?><br>
					Banco: <?php echo $pdi->nombre; ?><br>
					
					</div>
					<div class="col-xs-12 col-md-4">
					Cédula: <?php echo $pdi->cedula; ?><br>
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
