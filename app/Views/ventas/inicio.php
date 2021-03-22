<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?= $titulo ?> </h2>

            <?php if(session()->has('exito')){?>
                <div class="message alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->get('exito') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }?>

            <div>
                <p>
                    <a href="<?= route_to('ventas.canceladas') ?>" class = "btn btn-sm btn-warning">Canceladas</a>
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
                                    <a href="<?= route_to('ventas.verVenta', $dato['id']) ?>" class = "btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php if(session()->get('rol') == 'Administrador'){ ?>
                                        <a href="#" data-href = "<?= route_to('ventas.cancelar', $dato['id']) ?>" data-toggle = "modal" data-target = "#modal-confirma" data-placement = "top" title = "Eliminar registro" class = "btn btn-sm btn-danger">
                                            <i class = "fas fa-trash"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>                
        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancelar venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>¿Desea cancelar esta venta?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
        <a class="btn btn-primary" id = "btn-ok">Si</a>
      </div>
    </div>
  </div>
</div>