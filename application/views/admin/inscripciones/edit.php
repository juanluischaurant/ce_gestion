

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Inscripciones
        <small>Editar</small>
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

                        <form action="<?php echo base_url();?>movimientos/inscripciones/update" method="POST" class="form-horizontal">
                            <input type="hidden" name="id-inscripcion-instancia" value="<?php echo $data_inscripcion_instancia->id_inscripcion_instancia; ?>">
                            
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Buscar Producto:</label>
                                    <input type="text" class="form-control" id="producto">
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-curso" data-id-curso="" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tbventas" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Cupos</th>
                                        <th>Ocupados</th>
                                        <th>Precio</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($data_instancias)): ?>
                                    <?php foreach($data_instancias as $data_instancia): ?>
                                        <tr>
                                            <td><?php echo $data_instancia->id_instancia; ?></td>
                                            <td><?php echo $data_instancia->nombre_completo_instancia; ?></td>
                                            <td><?php echo $data_instancia->cupos_instancia; ?></td>
                                            <td><?php echo $data_instancia->cupos_instancia_ocupados; ?></td>
                                            <td><?php echo $data_instancia->precio_instancia; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-remove-pago"><span class="fa fa-remove"></span></button>
                                            </td>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" id='actualizar-inscripcion' class="btn btn-success btn-flat">Guardar</button>
                                </div>
                                
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