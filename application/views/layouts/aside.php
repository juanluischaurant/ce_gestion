        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">      
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <li>
                        <a href="<?php echo base_url(); ?>dashboard">
                            <i class="fa fa-home"></i> <span>Inicio</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> <span>Gestión</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>gestion/persona"><i class="fa fa-circle-o"></i> Personas</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/titular"><i class="fa fa-circle-o"></i> Titular</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/facilitador"><i class="fa fa-circle-o"></i> Facilitadores</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/participante"><i class="fa fa-circle-o"></i> Participantes</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/locacion"><i class="fa fa-circle-o"></i> Locaciones</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/periodo"><i class="fa fa-circle-o"></i> Períodos</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/especialidad"><i class="fa fa-circle-o"></i> Especialidades</a></li>
                            <li><a href="<?php echo base_url(); ?>gestion/curso"><i class="fa fa-circle-o"></i> Cursos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share-alt"></i> <span>Movimientos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>movimientos/inscripcion"><i class="fa fa-circle-o"></i> Generar Inscripción</a></li>
                            <li><a href="<?php echo base_url(); ?>movimientos/pago"><i class="fa fa-circle-o"></i> Registrar Pago</a></li>
                        </ul>                
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-print"></i> <span>Reportes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>reportes/historial_pagos"><i class="fa fa-circle-o"></i> Hist. de Pagos </a></li>
                            <li><a href="<?php echo base_url(); ?>reportes/historial_inscripciones"><i class="fa fa-circle-o"></i> Hist. de Inscripciones </a></li>
                            <li><a href="<?php echo base_url(); ?>reportes/relacion"><i class="fa fa-circle-o"></i> Rel. de Cursos</a></li>
                            <li><a href="<?php echo base_url(); ?>reportes/resumen_anual"><i class="fa fa-circle-o"></i> Res. Anual</a></li>
                            <li><a href="<?php echo base_url(); ?>reportes/accion"><i class="fa fa-circle-o"></i> Acciones</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user-circle-o"></i> <span>Administrador</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>administrador/permiso">
                                    <i class="fa fa-circle-o"></i> Permisos
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>administrador/usuario">
                                    <i class="fa fa-circle-o"></i> Usuarios
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->