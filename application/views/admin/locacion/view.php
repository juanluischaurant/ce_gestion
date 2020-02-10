<div class="row">
	<div class="col-xs-12 text-center">
		<b><?php echo ORGANIZACION; // Constante declarada en /application/confing/constants.php ?></b><br>
        Curso registrada durante: <?php echo $locacion->fecha_registro; ?>
    </div>
</div> <br>

<div class="row">
	<div class="col-md-12">
        
<div class="box">
            <div class="box-header text-center">
              <h3 class="box-title">Últimos Cursos Asociados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Serial</th>
                  <th>Nombre</th>
                  <th>Turno</th>
                  <th>Cupos</th>
                </tr>
               
                <?php foreach($cursos as $curso) : ?>
                    <tr>
                        <td><?php echo $curso->serial; ?></td>
                        <td><?php echo $curso->descripcion ?></td>
                        <td> <?php echo $curso->nombre_turno; ?></td>
                        <td><?php echo $curso->total_cupos."".$curso->conteo_inscripciones; ?></td>
                    </tr>
                <?php endforeach; ?>


              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>	
</div>