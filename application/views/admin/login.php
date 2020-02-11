<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CE Gestión</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- jQuery 3 -->
        <script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
        <!-- Bootstrap Validator -->
        <script type="text/javascript" src="<?= base_url();?>assets/template/bootstrap_validator/bootstrapvalidator.min.js"></script>

        <!-- CUSTOM JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/custom_js/login.js"></script>

        <!-- === STYLESHEETS === -->
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/font-awesome/css/font-awesome.min.css">
        <!-- Bootstrap Validator -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/bootstrap_validator/bootstrapValidator.min.css">

        <!-- Hoja de estilos para uso general -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom_css/general.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/dist/css/AdminLTE.min.css">

    </head>

<body class="">
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="text-center">
            <h2><b>CE Gestión</b></h2>
            </div>
            <p class="login-box-msg">Introduzca sus datos de ingreso</p>

            <div class="loader"></div>

            <?php if($this->session->flashdata('error')):?>
                <div class='alert alert-danger'>
                    <p><?php echo $this->session->flashdata('error') ?></p>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo base_url();?>auth/login" method="POST" id="frm_inicio">
                
                <div class="form-group has-feedback">
                    <input id="username" type="text" class="form-control" placeholder="Usuario" name="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar Ahora</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


</body>
</html>
