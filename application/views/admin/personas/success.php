
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Personas
        <small>Asignar Roles</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
   
        <div class="row">
            <div class="col-md-12">

            <div id="caja-principal" class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Un paso más antes de terminar</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form">
                <div class="box-body">
                    <blockquote>
                    <p>¿Qué rol tendrá <b><?php echo $persona->nombres;?> <?php echo $persona->apellidos;?></b>?</p>
                    <!-- <small>Someone famous in <cite title="Source Title">Source Title</cite></small> -->

                    <form id="add-rol-persona" method="POST">

                        <!-- ID de la persona -->
                        <input type="hidden" name="id-persona" value="<?php echo $persona->id; ?>">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="rol-participante">
                                            <b>Participante</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 hidden">
                                    <?php
                                        $atributos = array('class' => 'form-control');
                                        
                                        // Genera la etiquera
                                        echo form_label('Nivel Académico:');
                                        
                                        // Genera el elemento "select"
                                        // Parámetros de form_dropdown: nombre, valores de la lista, selected, atributos
                                        echo form_dropdown('nivel-academico-participante', $lista_niveles, '', $atributos);
                                    ?>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.form-group -->
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="rol-titular" value="titular">
                                            <b>Titular</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.form-group -->
                    </blockquote>

                        <div class="form-group">
                            <p class=>Agregar un facilitador puede requerir permisos especiales.</p>
                            <a class="btn btn-flat btn-warning btn-xs" href="<?php echo base_url(); ?>gestion/facilitador/add/<?php echo $persona->id;?>">Facilitador</a>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" id="add-roles-persona" class="btn btn-success btn-flat">Aceptar</button>
                </div>
                <!-- /.box-footer -->
                </form>

            </div> 
            <!-- /.box-primay   -->

            <div id="caja-secundaria" class="box box-success hidden">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $persona->nombres;?> ha sido registrado exitosamente</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <blockquote>
                    <p>Selecciona una opción</p>

                    <!-- Este elemento permanece oculto hasta que el botón remover la clase Hidden -->
                    <div id="redirecciona-inscribir" class="row hidden">
                        <div class="col-md-4">
                            <a href="<?php echo base_url(); ?>movimientos/inscripcion/add">Inscribir Participante</a>
                        </div>
                    </div>
                    <div id="redirecciona-pago" class="row hidden">
                        <div class="col-md-4">
                            <a href="<?php echo base_url(); ?>movimientos/pago/add">Registrar Pago</a>
                        </div>
                    </div>
                    <div id="redirecciona-inicio" class="row hidden">
                        <div class="col-md-4">
                            <a href="">Registrar a alguien más</a>
                        </div>
                    </div>
         
                    </blockquote>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-success btn-flat">Pantalla Principal</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div> 
            <!-- /.box-primay   -->

              
                
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
