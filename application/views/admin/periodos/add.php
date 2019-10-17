

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Períodos
        <small>Añadir</small>
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
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url(); ?>gestion/periodos/store" method="post">

                            <div class="form-group <?php echo !empty(form_error('mes-inicio'))? 'has-error' : '';?>">
                                <label for="nombre">Mes de Inicio: </label>
                                <input type="text" name="mes-inicio" id="mes-inicio" class="form-control" value="<?php echo set_value('mes-inicio');?>">
                                <?php echo form_error('mes-inicio', '<span class="help-block">', '</span>'); ?>
                            </div>

                            <div class="form-group <?php echo !empty(form_error('mes-cierre'))? 'has-error' : '';?>">
                                <label for="nombre">Mes de Cierre: </label>
                                <input type="text" name="mes-cierre" id="mes-cierre" class="form-control" value="<?php echo set_value('mes-cierre');?>">
                                <?php echo form_error('mes-cierre', '<span class="help-block">', '</span>'); ?>
                            </div>
  
                            <div class="form-group <?php echo !empty(form_error('year-periodo'))? 'has-error' : '';?>">
                                <label for="nombre">Año: </label>
                                <input type="text" name="year-periodo" id="year-periodo" class="form-control" value="<?php echo set_value('year-periodo');?>">
                                <?php echo form_error('year-periodo', '<span class="help-block">', '</span>'); ?>
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