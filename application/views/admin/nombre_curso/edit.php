

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Listado de Especialidades
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            
            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de <?php echo $nombre_curso->descripcion; ?></h3>

                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                        
                    </div>
                <?php endif;?>
            </div>

            <form action="<?php echo base_url(); ?>gestion/nombre_curso/update" method="post">
                <div class="box-body">
                
                    <div class="centrar_div">
                        <div class="row">
                                                     
                            <div class="form-group col-md-12 <?php echo !empty(form_error('descripcion_curso_nueva'))? 'has-error' : '';?>">
                                <label for="descripcion_curso">Descripción: </label>
                                <input type="text" value="<?php echo $nombre_curso->descripcion; ?>" name="descripcion_curso_nueva" id="descripcion_curso_nueva" class="form-control">
                                <input type="hidden" value="<?php echo $nombre_curso->descripcion; ?>" name="descripcion_curso" id="descripcion_curso" class="form-control">
                            
                                <?php echo form_error('descripcion_curso_nueva', '<span class="help-block">', '</span>'); ?>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="nombre">Cantidad de Horas</label>
                                <input type="text" name="cantidad_horas" id="cantidad_horas" class="form-control" value="<?php echo $nombre_curso->cantidad_horas; ?>">
                            </div>

                        </div>
                        
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer"> 
                    <input type="hidden" name="id_nombre_curso" value="<?php echo $nombre_curso->id; ?>">
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