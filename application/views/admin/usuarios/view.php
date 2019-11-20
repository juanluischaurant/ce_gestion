
<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Usuario registrado durante: <?php echo $usuario->fecha_creacion; ?>
    </div>
</div> <br>
<div class="row">
	<div class="col-xs-6 text-right">		
		<b>Nombres:</b><br>
		<b>Apellidos:</b><br>
		<b>Correo Electrónico:</b><br>
		<b>Usuario:</b><br>
		<b>Rol:</b><br>
	</div>
	<div class="col-xs-6">	
		<?php echo $usuario->nombres_usuario;?><br>
		<?php echo $usuario->apellidos_usuario;?><br>
		<?php echo $usuario->email_usuario;?><br>
        <?php echo $usuario->username_usuario;?><br>
        <?php echo $usuario->nombre_rol;?><br>
	</div>	
</div>