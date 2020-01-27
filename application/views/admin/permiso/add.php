

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permisos
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

                        <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url(); ?>administrador/permiso/store" method="POST">

                            <div class="row form-group <?php // echo !empty(form_error('mes-inicio'))? 'has-error' : ''; ?>">
                                <div class="col-md-4">
                                    <?php
                                        $roles = $roles; // Valor obtenido en el controlador
                                        $atributos = array('class' => 'form-control '); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Rol:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos varios
                                        echo form_dropdown('rol', $roles, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div> 
                            </div>

                            <div class="row form-group <?php // echo !empty(form_error('mes-inicio'))? 'has-error' : ''; ?>">
                                <div class="col-md-4">
                                    <?php
                                        $menus = $menus; // Valor obtenido en el controlador
                                        $atributos = array('class' => 'form-control '); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Menú:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos varios
                                        echo form_dropdown('menu', $menus, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div> 
                            </div>

                            <div class="row form-group <?php // echo !empty(form_error('mes-inicio'))? 'has-error' : ''; ?>">
                                <div class="col-md-4">
                                    <?php
                                        $opciones = array(
                                            1 => 'Si',
                                            0 => 'No'
                                        ); 
                                        
                                        $atributos = array('class' => 'form-control'); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Leer:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos varios
                                        echo form_dropdown('leer', $opciones, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div> 
                            </div>

                            <div class="row form-group <?php // echo !empty(form_error('mes-inicio'))? 'has-error' : ''; ?>">
                                
                                <div class="col-md-2">
                                    <?php
                                        $opciones = array(
                                            0 => 'No',
                                            1 => 'Si',
                                        ); 

                                        $atributos = array('class' => 'form-control'); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Insertar:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos varios
                                        echo form_dropdown('insertar', $opciones, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div>

                                <div class="col-md-2">
                                    <?php
                                        $opciones = array(
                                            0 => 'No',
                                            1 => 'Si',
                                        ); 

                                        $atributos = array('class' => 'form-control'); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Editar:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos varios
                                        echo form_dropdown('editar', $opciones, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div> 

                            </div>

                            <div class="row form-group <?php // echo !empty(form_error('mes-inicio'))? 'has-error' : ''; ?>">
                                
                            </div>

                            <div class="row form-group <?php // echo !empty(form_error('mes-inicio'))? 'has-error' : ''; ?>">
                                <div class="col-md-4">
                                    <?php
                                        $opciones = array(
                                            0 => 'No',
                                            1 => 'Si',
                                        ); 

                                        $atributos = array('class' => 'form-control '); // atributos para el elemento select

                                        // Genera la etiquera
                                        echo form_label('Eliminar:');

                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: atributo name, valores de la lista, '', atributos varios
                                        echo form_dropdown('eliminar', $opciones, '', $atributos);
                                    ?>
                                    <!-- Fin del campo -->
                                </div> 
                            </div>

                           


                            <div class="form-group"> 
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                        </form>
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