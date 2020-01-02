<?php 

// echo '<br>';
// echo $today = 'Today: ' . date('Y-m-d');

// echo '<br>';
// echo $date = 'Test Date: ' . "2019-02-22";

// echo '<br>';
// $compare = ($date > $today) ? "YES, it's major" : "NO,  I'm afraid it's not";


// echo $compare;
// echo '<br>';


// $another_test_date = "2019-06-22";
// echo $another_test_date;
// echo '<br>';

// echo $date = '6 Months ago: ' . date('Y-m-d', strtotime('-6 months'));
// echo '<br>';

// echo "another's test date month: " . date('n', strtotime($another_test_date));
// echo '<br>';

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Períodos <small>Editar</small></h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-solid">

            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $data_periodo->nombre_periodo; ?></h3>
            </div>
            
            <form action="<?php echo base_url(); ?>gestion/periodos/update" method="POST">
                <input type="hidden" name="id-periodo" value="<?php echo $data_periodo->id_periodo ?>">
                
                <div class="box-body">
             
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> ¡Alerta!</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <label for="fecha-inicio">Fecha de Inicio:</label>
                                <input type="date" class="form-control" name="fecha-inicio" value="<?php echo $data_periodo->fecha_inicio_periodo;?>">
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                                
                                <label for="fecha-culminacion">Fecha de Culminación:</label>
                                <input type="date" class="form-control" name="fecha-culminacion" value="<?php echo $data_periodo->fecha_culminacion_periodo;?>">
                            </div>
                        </div>
                    
                    </div>
                      
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                </div>
            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->