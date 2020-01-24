<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inscripciones
        <small>Reporte</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
  
                <div class="row">
                    <div class="col-md-12">
                        <table id="export-inscripciones" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th># Inscripción</th>
                                    <th>Hora Inscripción</th>
                                    <th>Curso</th>
                                    <th>Cédula Participante</th>
                                    <th>Opciones</th>
                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($inscripciones)): ?>
                                <?php foreach($inscripciones as $inscripcion): ?>

                                    <tr>
                                        <td><?php echo $inscripcion->fk_id_inscripcion_1; ?></td>
                                        <td><?php echo $inscripcion->hora_inscripcion; ?></td>
                                        <td><?php echo $inscripcion->nombre_completo_instancia; ?></td>
                                        <td><?php echo $inscripcion->cedula_cliente; ?></td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info"><span class="fa fa-eye"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                   
                                 <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>

                        </table>
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


<!-- modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Ficha de Inscripción</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
