<?= $this->extend('plantillas\base') ?>

<?= $this->section('content') ?>

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?= $titulo ?> </h2>
            
            <div>
                <p>
                    <a href="<?= route_to('compras.inicio') ?>" class = "btn btn-sm btn-warning">Compras</a>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Cajero</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos as $dato){ ?>
                            <tr>
                                <td><?= $dato['folio'] ?></td>
                                <td><?= $dato['total'] ?></td>
                                <td><?= $dato['fecha_alta'] ?></td>
                                <td><?= session()->get('nombre') ?></td>
                                
                                <td class = "text-center">
                                    <a href = "<?= route_to('compras.verCompra', $dato['id']) ?>" class = "btn btn-sm btn-danger">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>                
        </div>
    </main>

<?= $this->endSection() ?>