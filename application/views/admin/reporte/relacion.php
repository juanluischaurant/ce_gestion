<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Relación de Curso
        <small>Reporte Epecífico</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body table-responsive">
                           
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="tabla-relacion" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>Dirección y Teléfono</th>
                                    <th>Cédula</th>
                                    <th>Edad</th>
                                    <th>Género</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Banco</th>
                                    <th>N° de referencia (4 últ. dígitos)</th>
                                    <th>Fecha del Depósito</th>
                                    <th>Monto del Depósito</th>
                                    <th>Instrucción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($inscripciones)): ?>
                                <?php $i = 1; ?>
                                <?php foreach($inscripciones as $inscripcion): ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $inscripcion->nombre_participante; ?></td>
                                        <td><?php echo $inscripcion->direccion; ?></td>
                                        <td><?php echo $inscripcion->cedula; ?></td>
                                        <td><?php echo $inscripcion->edad_participante; ?></td>
                                        <td><?php echo $inscripcion->genero; ?></td>
                                        <td><?php echo $inscripcion->fecha_nacimiento_participante; ?></td>
                                        <td><?php echo $inscripcion->nombre_banco; ?></td>
                                        <td><?php echo $inscripcion->ultimos_4_digitos; ?></td>
                                        <td><?php echo $inscripcion->fecha_de_operacion; ?></td>
                                        <td><?php echo $inscripcion->monto_operacion; ?></td>
                                        <td><?php echo $inscripcion->nivel_de_instruccion; ?></td>
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

<!-- CUSTOM JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/relacion.js"></script>