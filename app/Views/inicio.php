<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Inicio</h2>
            <div class="row mt-4">
                <div class="col-12 col-sm-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            Total de productos <?= $n_productos?>
                        </div>

                        <a href="<?=base_url()?>/productos" class="card-footer text-white">Ver detalles</a>
                    </div>
                </div>

                <div class="col-12 col-sm-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            Ventas del día <?= $ventas['cantidad']." : ". $ventas['total']?>
                        </div>

                        <a href="<?=base_url()?>/ventas" class="card-footer text-white">Ver detalles</a>
                    </div>
                </div>

                <div class="col-12 col-sm-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            Compras
                        </div>

                        <a href="<?=base_url()?>/compras" class="card-footer text-white">Ver detalles</a>
                    </div>
                </div>

                <div class="col-12 col-sm-3">
                    <div class="card text-white bg-dark">
                        <div class="card-body">
                            Clientes
                        </div>

                        <a href="<?=base_url()?>/clientes" class="card-footer text-white">Ver detalles</a>
                    </div>
                </div>

            </div>            
        </div>
    </main>