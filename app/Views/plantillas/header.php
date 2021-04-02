<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark text-center">
    <a class="navbar-brand" href="<?= session()->get('rol') == 'Administrador' ? route_to('inicio'): route_to('productos.inicio') ?>"><i class="fas fa-store-alt"></i>&nbsp&nbspTIENDA ENP</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= session()->get('nombre')?> <i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                </i><a class="dropdown-item" href="<?= route_to('usuarios.editar_contrasenha') ?>"><i class="fas fa-key"></i>&nbsp Cambiar contraseña</a>
                <?php if(session()->get('rol') == 'Administrador'){ ?>
                    <a class="dropdown-item" href="#"><i class="fas fa-scroll"></i>&nbsp Logs de acceso</a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= route_to('usuarios.logout') ?>"><i class="fas fa-sign-out-alt"></i>&nbsp Cerrar sesión</a>
            </div>
        </li>
    </ul>
</nav>