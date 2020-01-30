
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Persona registrada durante: <?php echo $persona->fecha_registro; ?>
    </div>
</div> <br>
<div class="row">
	<div class="col-xs-6 text-right">		
		<b>Nombres:</b><br>
		<b>Apellidos:</b><br>
		<b>Cédula:</b><br>
		<b>F. de Nacimiento:</b><br>
		<b>Edad:</b><br>
		<b>Teléfono:</b><br>
		<b>Dirección:</b><br>
		<b>
			<?php 
			if(isset($es_participante->cedula_persona) ||
				isset($es_titular->cedula_persona) ||
				isset($es_facilitador->cedula_persona))
			{
				echo 'Roles: ';
			} 
			?>
			
		</b><br>
	</div>
	<div class="col-xs-6">	
		<?php echo $persona->nombres;?><br>
		<?php echo $persona->apellidos;?><br>
		<?php echo $persona->cedula;?><br>
        <?php echo $persona->fecha_nacimiento;?><br>
        <?php echo (isset($persona->edad) && $persona->fecha_nacimiento !== '0000-00-00' )? $persona->edad : 'No disponible';?><br>
        <?php echo $persona->telefono !== '' ? $persona->telefono : 'No disponible';?><br>
		<?php echo $persona->direccion !== '' ? $persona->direccion : 'No disponible';?><br>
		<?php echo isset($es_participante->cedula_persona) ? 'Participante<br>' : '';?>
		<?php echo isset($es_titular->cedula_persona) ? 'Titular<br>' : '';?>
		<?php echo isset($es_facilitador->cedula_persona) ? 'Facilitador<br>' : '';?>

	</div>	
</div>