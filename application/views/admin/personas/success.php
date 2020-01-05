
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
   
        <div class="row">
            <div class="col-md-12">

            <div id="caja-principal" class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Un paso más antes de terminar</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form">
                <div class="box-body">
                    <blockquote>
                    <p>¿Qué rol tendrá <b><?php echo $persona->nombres_persona;?> <?php echo $persona->apellidos_persona;?></b>?</p>
                    <!-- <small>Someone famous in <cite title="Source Title">Source Title</cite></small> -->

                    <form id="add-rol-persona" method="POST">

                        <input type="hidden" name="id-persona" value="<?php echo $persona->id_persona; ?>">

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" name="rol-participante">
                                Participante
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                <input type="checkbox" name="rol-titular" value="titular">
                                Titular
                                </label>
                            </div>
                        </div>
                    </blockquote>

                        <div class="form-group">
                            <p class=>Agregar un facilitador puede requerir permisos especiales.</p>
                            <a class="btn btn-flat btn-warning btn-xs" href="<?php echo base_url(); ?>gestion/facilitadores/add/<?php echo $persona->id_persona;?>">Facilitador</a>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" id="add-roles-persona" class="btn btn-success btn-flat">Aceptar</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div> 
            <!-- /.box-primay   -->

            <div id="caja-secundaria" class="box box-success hidden">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $persona->nombres_persona;?> ha sido registrado exitosamente</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <blockquote>
                    <p>¿A donde deseas ir ahora?</p>
                    <!-- <small>Someone famous in <cite title="Source Title">Source Title</cite></small> -->
                    <ul style="list-style-type: none;">
                        <li>
                            <a href="">Inscribir</a>
                        </li>
                        <li>
                            <a href="">Registrar</a>
                        </li>
                    </ul>
                    </blockquote>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-success btn-flat">Pantalla Principal</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div> 
            <!-- /.box-primay   -->

              
                
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
