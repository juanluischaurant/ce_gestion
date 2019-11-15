<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Usuarios
        <small>Lista General</small>
        </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">

        <?php if($this->session->flashdata("success")):?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i><?php echo $this->session->flashdata("success"); ?></p>
            </div>
        <?php endif;?>

        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>gestion/usuarios/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Usuario</a>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered btn-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Rol</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($usuarios)): ?>
                                <?php foreach($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?php echo $usuario->id_usuario; ?></td>
                                        <td><?php echo $usuario->nombres_usuario; ?></td>
                                        <td><?php echo $usuario->apellidos_usuario; ?></td>
                                        <td><?php echo $usuario->email_usuario; ?></td>
                                        <td><?php echo $usuario->username_usuario; ?></td>
                                        <td><small class="label label-success"><?php echo $usuario->rol; ?></small></td>
                                        <?php $dataUsuario = $usuario->id_usuario.'*'.$usuario->nombres_usuario.'*'.$usuario->apellidos_usuario.'*'.$usuario->email_usuario.'*'.$usuario->username_usuario; ?>
                                        <td>
                                            <div class="btn-group">
                                                <button type='button' class="btn btn-info btn-view-usuario" data-toggle='modal' data-target='#modal-default' value='<?php echo $dataUsuario?>'><span class="fa fa-eye"></span></button>
                                                <a href="<?php echo base_url() ?>gestion/usuarios/edit/<?php echo $usuario->id_usuario; ?>" .
                                                class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                <a href="#" class="btn btn-danger"><span class="fa fa-remove"></span></a>
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


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion del Usuario</h4>
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
