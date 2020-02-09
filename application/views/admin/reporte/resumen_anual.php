<div class="content-wrapper" style="min-height: 902.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reporte Anual
        <small>General</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box-tools pull-right">
            <form action="<?php echo current_url();?>" method="POST" class="form">
              <div class="row">
                <div class="col-xs-8">
                  <select name="parametro_de_grafico" class="form-control" id="parametro_de_grafico">
                      <?php foreach($years as $year): ?>
                          <option value="<?php echo $year->year; ?>" <?php echo !empty($current_year) && $current_year == $year->year ? 'selected':''; ?>><?php echo $year->year; ?> </option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary" name="buscar" value="buscar">
                      <span class="fa fa-search"></span>
                  </button>  
                </div>
              </div>
            </form>
          </div>

          <!-- /.box-header -->
          <h2 class="page-header">
            Estadísticas Año <?php echo !empty($current_year) ? $current_year :'NO DISPONIBLE'; ?>
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <!-- info row -->
      <div class="row">
        <div class="col-xs-8">
          <!-- Columna para gráfico -->
          <div class="row">
              <div class="col-md-12">
                  <div id="grafico_personas">
                      <div id="container_personas"></div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.col -->

        <div class="col-xs-4">
          <b>Datos generales</b><br>
          <br>
          <b>Fecha de Impresión:</b> <?php echo date('d/m/Y') ?><br>
          <b>Impreso por:</b> <?php echo $this->session->userdata('primer_nombre') . ' ' . $this->session->userdata('primer_apellido');; ?><br>
          <b>Usuario CE:</b> <?php echo $this->session->userdata('username') ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <hr>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-6 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Período</th>
              <th>Cursos Dictados</th>
              <th>Inscripciones</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($resumen_periodos)): ?>
              <?php foreach($resumen_periodos as $resumen_periodo): ?>
                <tr>
                  <td><?php echo $resumen_periodo->periodo_academico; ?></td>
                  <td><?php echo $resumen_periodo->conteo_cursos_dictados; ?></td>
                  <td><?php echo $resumen_periodo->conteo_inscripciones; ?></td>
                </tr>
              <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->

        <!-- Columna para gráfico -->
        <div class="col-xs-6">
          <div class="row">
              <div class="col-md-12">
                  <div id="grafico_lineas">
                      <div id="container_lineas"></div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <hr>

      <div class="row">
        <!-- Columna para gráfico -->
        <div class="col-xs-6">
          <div class="row">
              <div class="col-md-12">
                  <div id="grafico">
                      <div id="container"></div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Datos Anuales</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Edad Promedio:</th>
                <td><?php echo $edad_promedio_anual->edad_promedio; ?></td>
              </tr>
              <tr>
                <th>Promedio de CUPOS por CURSO</th>
                <td><?php echo $estadistica_cursos_anual->promedio_cupos; ?></td>
              </tr>
              <tr>
                <th>Prom. de CUPOS OCUPADOS por CURSO</th>
                <td><?php echo $estadistica_cursos_anual->promedio_cupos_ocupados; ?></td>
              </tr>
              <tr>
                <th>Total Inscripciones Activas</th>
                <td><?php echo $estadistica_cursos_anual->inscripciones_activas; ?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <hr>

      <div class="row">
          <div class="col-md-12">
              <div id="grafico_inscripciones_mes">
                  <div id="container_inscripciones_mes"></div>
              </div>
          </div>
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary pull-right btn-print" style="margin-right: 5px;">
          <i class="fa fa-print"></i></a>
          </button>
        </div>
      </div>
    </section>

    <!-- /.content -->
    <div class="clearfix"></div>
</div>

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/resumen_anual.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/dashboard.js"></script>
