
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Facilitador
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        
        <div class="box box-primary">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Datos de <?php echo $facilitador->primer_nombre . ' ' . $facilitador->primer_apellido; ?></h3>
                
                <?php if($this->session->flashdata("error")):?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>    
                    </div>
                <?php endif;?>

            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="centrar_div">
                        <dl class="text-center">
                            <dt>Información</dt>
                            <dd>Para editar la información asociada a este facilitador, <a href="<?php echo base_url() ?>gestion/persona/edit/<?php echo $facilitador->cedula_persona; ?>">sigue este enlace.</a></dd>
                        </dl>
                    </div>
                
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="cedula_facilitador" value="<?php echo $facilitador->cedula_persona;?>">
                    <button type="submit" class="btn btn-success btn-flat center-block" disabled>Guardar</button>
                </div>
                <!-- .box-footer -->
            </form>
            <!-- /.form end -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
