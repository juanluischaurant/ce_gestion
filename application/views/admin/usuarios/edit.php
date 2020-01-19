
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Usuarios
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>     
                            </div>
                        <?php endif;?>

                        <form action="<?php echo base_url();?>administrador/usuario/update" method="POST" autocomplete="off">

                            <input type="hidden" class="form-control" id="id-usuario" name="id-usuario" value="<?php echo $usuario->id_usuario; ?>">
                            
                            <div class="row form-group">

                                <div class="col-md-4 <?php echo !empty(form_error('username-usuario')) ? 'has-error' : ''; ?>">
                                    <label for="username-usuario">Username:</label>
                                    <input type="text" class="form-control" id="username-usuario" name="username-usuario" value="<?php echo $usuario->username_usuario; ?>">
                                    <?php echo form_error('username-usuario', '<span class="help-block">', '</span>'); ?>
                                </div>

                                <div class="col-md-3 <?php echo !empty(form_error('password-usuario')) ? 'has-error' : ''; ?>">                                
                                    <label for="password-usuario">Contraseña:</label>
                                    <input type="password" class="form-control" id="password-usuario" name="password-usuario" autocomplete="new-password" value="<?php // echo $usuario->password_usuario ?>">
                                    <?php echo form_error('password-usuario', '<span class="help-block">', '</span>'); ?>
                                </div>

                                <div class="col-md-3 <?php echo !empty(form_error('confirmar-password-usuario')) ? 'has-error' : ''; ?>">                                
                                    <label for="confirmar-password-usuario">Confirmar Contraseña:</label>
                                    <input type="password" class="form-control" id="confirmar-password-usuario" name="confirmar-password-usuario" autocomplete="new-password" value="<?php // echo $usuario->password_usuario ?>">
                                    <?php echo form_error('confirmar-password-usuario', '<span class="help-block">', '</span>'); ?>
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="nombre-usuario">Nombres:</label>
                                    <input type="text" class="form-control" id="nombre-usuario" name="nombre-usuario" value="<?php echo $usuario->nombres_usuario; ?>">
                                </div>

                                <div class="col-md-6">                                
                                    <label for="apellido-usuario">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellido-usuario" name="apellido-usuario" value="<?php echo $usuario->apellidos_usuario; ?>">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4">
                                    <?php
                                        $roles_usuario = $roles; // Valor obtenido en el controlador
                                        $atributos = array('class' => 'form-control', 'required'); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Rol:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, atributo a seleccionar para selected, atributos
                                        echo form_dropdown('rol-usuario', $roles_usuario, $usuario->fk_rol_id_1, $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div>

                                <div class="col-md-6">
                                    <label for="email-usuario">Email:</label>
                                    <input type="email" class="form-control" id="email-usuario" name="email-usuario" value="<?php echo $usuario->email_usuario; ?>">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                </div>
                            </div>

                        </form>
                        <!-- fin del cursor -->

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
