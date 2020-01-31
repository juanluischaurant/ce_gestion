
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Participante registrado durante: <?php echo $participante->fecha_registro_participante; ?>
    </div>
</div> <br>
<div class="row">
	<div class="col-xs-6 text-right">		
		<b>Nombres:</b><br>
		<b>Apellidos:</b><br>
		<b>Cédula:</b><br>
		<b>F. de Nacimiento:</b><br>
		<b>Teléfono:</b><br>
		<b>Dirección:</b><br>
	</div>
	<div class="col-xs-6">	
		<?php echo $participante->primer_nombre;?><br>
		<?php echo $participante->primer_apellido;?><br>
		<?php echo $participante->cedula;?><br>
        <?php echo $participante->fecha_nacimiento_persona;?><br>
        <?php echo $participante->telefono_persona;?><br>
        <?php echo $participante->direccion_persona;?><br>

	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre Curso</th>
					<th>Período</th>
				</tr>
			</thead>

			<tbody>
               
            <?php if(!empty($instancias_inscritas)): ?>
                <?php foreach($instancias_inscritas as $instancia_inscrita): ?>
                    <tr>
                        <td><?php // echo $participante->fecha_registro_participante; ?></td>
                        <td><?php echo $instancia_inscrita['nombre_curso']; ?></td>
                        <td><?php // echo $participante->fecha_registro_participante; ?></td>
                    </tr>
                    <?php endforeach; ?>
            <?php endif; ?>

			</tbody>
		</table>
	</div>
</div>