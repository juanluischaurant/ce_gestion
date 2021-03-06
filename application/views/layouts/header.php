<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        CE Gestión <?php if(!empty($page_title)) echo '| '.$page_title; ?>
    </title>

    <script>
        
        /**
         * URL base actual (Sujeto a cambios dependiendo de
         * la dirección real):http://localhost/ce_gestion/
         */
        const base_url = "<?php echo base_url();?>"; // Almacena el url base del proyecto
         
    </script>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
     
    <!-- Bootstrap Validator -->
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/bootstrap_validator/bootstrapValidator.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/font-awesome/css/font-awesome.min.css">
        
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/Ionicons/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
    <!-- DataTables Export-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/datatables-export/css/buttons.dataTables.min.css">   
 
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/dist/css/skins/_all-skins.min.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/jquery-ui/jquery-ui.css">

    <!-- Hoja de estilos para uso general -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom_css/general.css">

    <!-- ===========================
    JAVASCRIPT LIBRARIES 
    ============================ -->
    <script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>

    <!-- Highcharts -->
    <script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>


    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Bootstrap Validator -->
    <script type="text/javascript" src="<?= base_url();?>assets/template/bootstrap_validator/moment.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/template/bootstrap_validator/bootstrapvalidator.min.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template//bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <!-- DataTables Export -->
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script>

    <!-- InputMask -->
    <script src="<?php echo base_url();?>assets/template/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url();?>assets/template/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url();?>assets/template/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>  
    
</head>
<body class="hold-transition skin-red sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>C</b>E</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>CE Gestión</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url()?>assets/template/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('primer_nombre');?> </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <a href="<?php echo base_url(); ?>auth/logout"> Cerrar Sesión</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>