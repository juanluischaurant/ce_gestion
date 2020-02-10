
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Participante
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de <?php echo $participante->primer_nombre . ' ' . $participante->primer_apellido; ?></h3>
                
                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>    
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form action="<?php echo base_url();?>gestion/participante/update" method="POST">
                <div class="box-body">

                    <div class="centrar_div">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <?php
                                    $atributos = array('class' => 'form-control', 'id' => 'nivel_academico', 'required' => 'required');
                                    $selected = $participante->id_nivel_academico;
                                    // Almacena el valor correspondiente a cada género (1=Masculino, 2=Femenino)
                                    // Verifica si se encuentra asignada (isset) la variable $persona
                                                            
                                    echo form_label('Nivel Académico'); // Genera la etiqueta

                                    // Genera el elemento "select"
                                    // Parámetros de form_dropdown: nombre, valores de la lista, seleccionado, atributos
                                    echo form_dropdown('nivel_academico', $nivel_academico, $selected, $atributos);
                                ?>
                            </div>
                        </div>
                        
                        <dl class="text-center">
                            <dt>Información</dt>
                            <dd>Para editar la información asociada a este participante, <a href="<?php echo base_url() ?>gestion/persona/edit/<?php echo $participante->cedula_persona; ?>">sigue este enlace.</a></dd>
                        </dl>
                    </div>
                    <!-- /.centrar_div -->
                
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="cedula_participante" value="<?php echo $participante->cedula_persona;?>">
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                </div>
                <!-- .box-footer -->
            </form>
            <!-- /.form end -->
        </div>
        
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
