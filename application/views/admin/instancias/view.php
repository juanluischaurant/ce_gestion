
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        <?php echo 'Instancia: ' . $datos_instancia->nombre_curso; ?>
    </div>
</div> <br>
<div class="row">
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Conteo</th>
					<th>Fecha de Registro</th>
					<th>Nombres y Apellidos</th>
					<th>Cédula</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($participantes_inscritos)): ?>
					<?php $contador = 1; ?>
					<?php foreach($participantes_inscritos as $participante_inscrito): ?>
					<tr>
						<td><?php echo $contador++; ?></td>
						<td><?php echo $participante_inscrito->hora_inscripcion; ?></td>
						<td><?php echo $participante_inscrito->nombres_persona; ?></td>
						<td><?php echo $participante_inscrito->cedula_persona; ?></td>
					</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>