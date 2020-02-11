

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Nombres de Curso
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-warning">

            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de Nuevo Nombre de Curso</h3>

                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>
            </div>

            <form id="formulario_nombre_curso" action="<?php echo base_url(); ?>gestion/nombre_curso/store" method="post">
                <div class="box-body">
                
                    <div class="centrar_div">

                        <div class="row">
                                                    
                            <div class="form-group col-md-12 <?php echo !empty(form_error('descripcion_curso'))? 'has-error' : '';?>">
                                <label for="descripcion_curso">Descripción</label>
                                <input type="text" name="descripcion_curso" id="descripcion_curso" class="form-control" value="<?php echo set_value('descripcion_curso');?>" autocomplete="off">
                                <?php echo form_error('descripcion_curso', '<span class="help-block">', '</span>'); ?>
                            </div>
                            
                            <div class="form-group col-md-12 <?php echo !empty(form_error('cantidad_horas'))? 'has-error' : '';?>">
                                <label for="cantidad_horas">Cantidad de Horas</label>
                                <input type="text" name="cantidad_horas" id="cantidad_horas" class="form-control" value="<?php echo set_value('cantidad_horas');?>">
                                <?php echo form_error('cantidad_horas', '<span class="help-block">', '</span>'); ?>
                            </div>

                        </div>
                        
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer"> 
                    <button type="submit" class="btn btn-success btn-flat center-block">Guardar</button>
                </div>
            </form>

        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/nombre_curso.add.js"></script>