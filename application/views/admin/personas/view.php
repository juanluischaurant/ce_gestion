
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Persona registrada durante: <?php echo $persona->fecha_registro_persona; ?>
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
		<?php echo $persona->nombres_persona;?><br>
		<?php echo $persona->apellidos_persona;?><br>
		<?php echo $persona->cedula_persona;?><br>
        <?php echo $persona->fecha_nacimiento_persona;?><br>
        <?php echo $persona->telefono_persona;?><br>
        <?php echo $persona->direccion_persona;?><br>

	</div>	
</div>