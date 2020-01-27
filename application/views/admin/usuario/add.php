
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Usuarios
        <small>Nuevo</small>
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

                        <form action="<?php echo base_url();?>administrador/usuario/store" method="POST" autocomplete="off">

                            <div class="row form-group">
                                <div class="col-md-4 <?php echo !empty(form_error('username-usuario')) ? 'has-error' : ''; ?>">
                                    <label for="username-usuario">Username:</label>
                                    <input type="text" class="form-control" id="username-usuario" name="username-usuario" value="<?php echo set_value('username-usuario'); ?>">
                                    <?php echo form_error('username-usuario', '<span class="help-block">', '</span>'); ?>
                                </div>

                                <div class="col-md-6">                                
                                    <label for="password-usuario">Contraseña:</label>
                                    <input type="password" class="form-control" id="password-usuario" name="password-usuario" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="nombre-usuario">Nombres:</label>
                                    <input type="text" class="form-control" id="nombre-usuario" name="nombre-usuario">
                                </div>

                                <div class="col-md-6">                                
                                    <label for="apellido-usuario">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellido-usuario" name="apellido-usuario">
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
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos
                                        echo form_dropdown('rol-usuario', $roles_usuario, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div>

                                <div class="col-md-6">
                                    <label for="email-usuario">Email:</label>
                                    <input type="email" class="form-control" id="email-usuario" name="email-usuario">
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
