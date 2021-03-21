<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?php echo $titulo ?> </h2>

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
                    <a href="<?php echo base_url() ?>/cajas" class = "btn btn-sm btn-warning">Cajas</a>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th># Caja</th>
                            <th>Nombre</th>
                            <?php if(session()->get('rol') == 'Administrador'){ ?>
                                <th>Acción</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos as $dato){ ?>
                            <tr>
                                <td><?php echo $dato['id'] ?></td>
                                <td><?php echo $dato['numero'] ?></td>
                                <td><?php echo $dato['nombre'] ?></td>

                                <?php if(session()->get('rol') == 'Administrador'){ ?>                                   
                                    <td class = "text-center">
                                        <a href="#" data-href = "<?php echo base_url().'/cajas/reingresar/'. $dato['id'] ?>" data-toggle = "modal" data-target = "#modal-confirma" data-placement = "top" title = "Reingresar registro" class = "btn btn-sm btn-danger">
                                            <i class = "fas fa-arrow-alt-circle-up"></i>
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
        <h5 class="modal-title" id="exampleModalLabel">Reingresar caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>¿Desea reingresar esta caja?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
        <a class="btn btn-primary" id = "btn-ok">Si</a>
      </div>
    </div>
  </div>
</div>