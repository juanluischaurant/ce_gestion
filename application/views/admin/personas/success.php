
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Personas
        <small>Escoja una opción</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">


                        <div class="row">
                        <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>

                            <h3 class="box-title">Éxito</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <blockquote>
                                <p>El registro se ha guardado de manera correcta. ¿Qué rol tendrá <?php echo $persona->nombres_persona;?>?</p>
                                <!-- <small>Someone famous in <cite title="Source Title">Source Title</cite></small> -->
                                <div class="row">
                                    <div class="col-md-4"><a href="<?php echo base_url(); ?>gestion/participantes/add/<?php echo $persona->persona_id;?>">Participante</a></div>                                    
                                    <div class="col-md-4"><a href="<?php echo base_url(); ?>gestion/clientes/add/<?php echo $persona->persona_id;?>">Titular</a></div>                                    
                                    <div class="col-md-4"><a href="<?php echo base_url(); ?>gestion/facilitadores/add/<?php echo $persona->persona_id;?>">Facilitador</a></div>                                    
                                </div>
                            </blockquote>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        </div>
                        <!-- ./col -->
        


                        
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
