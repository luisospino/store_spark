<div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= route_to('productos.inicio') ?>">Productos</a>
                                <?php if(session()->get('rol') == 'Administrador'){ ?>
                                <a class="nav-link" href="<?= route_to('unidades.inicio') ?>">Unidades</a>
                                <a class="nav-link" href="<?= route_to('categorias.inicio') ?>">Categorías</a>
                                <?php } ?>
                            </nav>
                        </div>

                        <a class="nav-link" href="<?= route_to('clientes.inicio') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                        </a>

                        <?php if(session()->get('rol') != 'Cajero'){ ?>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#compras"
                            aria-expanded="false" aria-controls="compras">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Compras
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="compras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php if(session()->get('rol') == 'Administrador'){ ?>
                                <a class="nav-link" href="<?= route_to('compras.crear') ?>">Nueva compra</a>
                                <?php } ?>

                                <a class="nav-link" href="<?= route_to('compras.inicio') ?>">Compras</a>
                            </nav>
                        </div>
                        <?php } ?>

                        <?php if(session()->get('rol') != 'Supervisor'){ ?>
                        <a class="nav-link" href="<?= route_to('ventas.crear') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Caja
                        </a>
                        <?php } ?>

                        <a class="nav-link" href="<?= route_to('ventas.inicio') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-shopping-cart"></i></div>
                            Ventas
                        </a>

                        <?php if(session()->get('rol') != 'Cajero'){ ?>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#administracion"
                            aria-expanded="false" aria-controls="administracion">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="administracion" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php if(session()->get('rol') == 'Administrador'){ ?>
                                <a class="nav-link" href="<?= route_to('configuracion.inicio') ?>">Configuración</a>
                                <a class="nav-link" href="<?= route_to('metodos_pagos.inicio') ?>">Métodos de pago</a>
                                <a class="nav-link" href="<?= route_to('roles.inicio') ?>">Roles</a>
                                <?php } ?>
                                <a class="nav-link" href="<?= route_to('usuarios.inicio') ?>">Usuarios</a>
                                <a class="nav-link" href="<?= route_to('cajas.inicio') ?>">Cajas</a>
                                <a class="nav-link" href="<?= route_to('logs.inicio') ?>">Logs de acceso</a>
                            </nav>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </nav>
        </div>