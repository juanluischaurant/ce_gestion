
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Titular registrado durante: <?php echo $titular->fecha_registro_titular; ?>
    </div>
</div> 

<br>

<div class="row">
	<div class="col-xs-6 text-right">		
		<b>Nombres:</b><br>
		<b>Apellidos:</b><br>
		<b>Cédula:</b><br>
		<b>F. de Nacimiento:</b><br>
		<b>Edad:</b><br>
        <b>Teléfono:</b><br>
        <b>Correo Electrónico:</b><br>
		<b>Dirección:</b><br>
	    <br>
	</div>
	<div class="col-xs-6">	
		<?php echo $titular->primer_nombre;?><br>
		<?php echo $titular->primer_apellido;?><br>
		<?php echo $titular->cedula_persona;?><br>
        <?php echo $titular->fecha_nacimiento;?><br>
        <?php echo (isset($titular->edad) && $titular->fecha_nacimiento !== '0000-00-00' )? $titular->edad : 'No disponible';?><br>
        <?php echo $titular->telefono !== '' ? $titular->telefono : 'No disponible';?><br>
        <?php echo $titular->correo_electronico !== '' ? $titular->correo_electronico : 'No disponible';?><br>
		<?php echo $titular->direccion !== '' ? $titular->direccion : 'No disponible';?><br>

	</div>	
</div>

