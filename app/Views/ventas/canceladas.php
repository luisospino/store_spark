<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?php echo $titulo ?> </h2>
            
            <div>
                <p>
                    <a href="<?php echo base_url() ?>/ventas" class = "btn btn-sm btn-warning">Ventas</a>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Cajero</th>
                            <th>Forma pago</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos as $dato){ ?>
                            <tr>
                                <td><?= $dato['folio'] ?></td>
                                <td><?= $dato['total'] ?></td>
                                <td><?= $dato['cliente'] ?></td>
                                <td><?= session()->get('nombre') ?></td>
                                <td><?= $dato['metodo_pago'] ?></td>
                                <td><?= $dato['fecha_alta'] ?></td>
                                
                                <td class = "text-center">
                                    <a href = "<?= base_url().'/ventas/verVentaPdf/'. $dato['id'] ?>" class = "btn btn-sm btn-danger">
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