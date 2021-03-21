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
                    <?php if(session()->get('rol') == 'Administrador'){ ?>
                            <a href="<?= route_to('productos.crear') ?>" class = "btn btn-sm btn-info">Agregar</a>
                    <?php } ?>

                    <?php if(session()->get('rol') == 'Administrador' || session()->get('rol') == 'Supervisor'){ ?>
                            <a href="<?= route_to('productos.verCodigosBarras') ?>" class = "btn btn-sm btn-success">Códigos de barras</a>
                    <?php } ?>

                    <a href="<?= route_to('productos.eliminados') ?>" class = "btn btn-sm btn-warning">Eliminados</a>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencias</th>

                            <?php if(session()->get('rol') == 'Administrador'){ ?>
                                <th>Acción</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($datos as $dato){ ?>
                                <tr>
                                    <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['codigo'] ?></td>
                                    <td><?= $dato['nombre'] ?></td>
                                    <td><?= $dato['precio_venta'] ?></td>
                                    <td><?= $dato['existencias'] ?></td>

                                    <?php if(session()->get('rol') == 'Administrador'){ ?>                                            
                                        <td class = "text-center">
                                            <a href="<?= route_to('productos.editar', $dato['id']) ?>" class = "btn btn-sm btn-secondary">
                                                <i class = "fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#"  data-href = "<?= route_to('productos.eliminar', $dato['id']) ?>" data-toggle = "modal" data-target = "#modal-confirma" data-placement = "top" title = "Eliminar registro" class = "btn btn-sm btn-danger">
                                                <i class = "fas fa-trash"></i>
                                            </a>
                                        </td>
                                    <?php } ?>
                                    
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
        <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>¿Desea eliminar este producto?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
        <a class="btn btn-primary" id = "btn-ok">Si</a>
      </div>
    </div>
  </div>
</div>