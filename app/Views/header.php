<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Store</title>
    <link href="<?= base_url();?>/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url();?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="<?= base_url();?>/js/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark text-center">
        <a class="navbar-brand" href="<?=base_url()?>/inicio"><i class="fas fa-store-alt"></i>&nbsp&nbspTIENDA ENP</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= session()->get('nombre')?> <i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    </i><a class="dropdown-item" href="<?= base_url(); ?>/usuarios/editar_contrasenha"><i class="fas fa-key"></i>&nbsp Cambiar contraseña</a>
                    <?php if(session()->get('rol') == 'Administrador'){ ?>
                        <a class="dropdown-item" href="#"><i class="fas fa-scroll"></i>&nbsp Logs de acceso</a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url(); ?>/usuarios/logout"><i class="fas fa-sign-out-alt"></i>&nbsp Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url(); ?>/productos">Productos</a>
                                <?php if(session()->get('rol') == 'Administrador'){ ?>
                                    <a class="nav-link" href="<?= base_url(); ?>/unidades">Unidades</a>
                                    <a class="nav-link" href="<?= base_url(); ?>/categorias">Categorías</a>
                                <?php } ?>
                            </nav>
                        </div>

                        <a class="nav-link" href="<?= base_url(); ?>/clientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                        </a>

                        <?php if(session()->get('rol') != 'Cajero'){ ?>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#compras" aria-expanded="false" aria-controls="compras">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="compras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if(session()->get('rol') == 'Administrador'){ ?>
                                        <a class="nav-link" href="<?= base_url(); ?>/compras/nuevo">Nueva compra</a>
                                    <?php } ?>

                                    <a class="nav-link" href="<?= base_url(); ?>/compras">Compras</a>
                                </nav>
                            </div>
                        <?php } ?>

                        <?php if(session()->get('rol') != 'Supervisor'){ ?>
                            <a class="nav-link" href="<?= base_url(); ?>/ventas/nuevo">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                                Caja
                            </a>
                        <?php } ?>

                        <a class="nav-link" href="<?= base_url(); ?>/ventas">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-shopping-cart"></i></div>
                            Ventas
                        </a>
                        
                        <?php if(session()->get('rol') != 'Cajero'){ ?>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#administracion" aria-expanded="false" aria-controls="administracion">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="administracion" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <?php if(session()->get('rol') == 'Administrador'){ ?>
                                    <a class="nav-link" href="<?= base_url(); ?>/configuracion">Configuración</a>
                                    <a class="nav-link" href="<?= base_url(); ?>/metodos_pagos">Métodos de pago</a>
                                    <a class="nav-link" href="<?= base_url(); ?>/roles">Roles</a>
                                <?php } ?>
                                    <a class="nav-link" href="<?= base_url(); ?>/usuarios">Usuarios</a>
                                    <a class="nav-link" href="<?= base_url(); ?>/cajas">Cajas</a>
                                    <a class="nav-link" href="<?= base_url(); ?>/logs">Logs de acceso</a>
                                </nav>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </nav>
        </div>