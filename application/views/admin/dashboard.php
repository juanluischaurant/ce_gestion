
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Principal
        <small>Información</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-navy">
                    <div class="inner">
                        <h3><?php echo $estadistica_cursos->promedio_cupos; ?> Cupos</h3>

                        <p>Promedio de Cupos por Curso</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa"></i></a>
                </div>
            </div>
            <!-- ./col -->
            
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $menor_18->porcentaje_menor_de_18; ?><sup style="font-size: 20px">% (Participantes)</sup></h3>

                        <p>... Son Menores de Edad al inscribirse</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?php echo $estadistica_cursos->promedio_cupos_ocupados; ?> Cupos</h3>

                        <p>Promedio de Cupos Ocupados por Curso</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $edad_promedio->edad_promedio; ?> Años</h3>

                        <p>Edad Promedio al inscribirse</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fa"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">

                <div class="box" id="grafico-central">

                    <div class="box-header with-border"> 
                        <h3 class="box-title">Recapitulación Mensual</h3>
                        <div class="box-tools pull-right">
                            <select name="parametro_de_grafico" class="form-control" id="parametro_de_grafico">
                                <?php foreach($years as $year): ?>
                                    <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="grafico_inscripciones_mes">
                                    <div id="container_inscripciones_mes"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
            
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/dashboard.js"></script>
