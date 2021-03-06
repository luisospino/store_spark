<?= $this->extend('plantillas\base') ?>

<?= $this->section('content') ?>
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
                    <a href="<?= route_to('productos.inicio')?>" class = "btn btn-sm btn-warning">Productos</a>
                    <?php if(session()->get('rol') == 'Administrador' || session()->get('rol') == 'Supervisor'){ ?>
                        <a href="<?= route_to('productos.verCodigosBarrasEliminados') ?>" class = "btn btn-sm btn-success">Códigos de barras eliminados</a>
                    <?php } ?>
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
                                        <a href="#" data-href = "<?= route_to('productos.reingresar', $dato['id']) ?>" data-toggle = "modal" data-target = "#modal-confirma" data-placement = "top" title = "Reingresar registro" class = "btn btn-sm btn-danger">
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
                <h5 class="modal-title" id="exampleModalLabel">Reingresar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p>¿Desea reingresar este producto?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                <a class="btn btn-primary" id = "btn-ok">Si</a>
            </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('aditional-js') ?>

    <script>
        $("#modal-confirma").on("show.bs.modal", function(e) {
            $("#btn-ok").attr('href', $(e.relatedTarget).data('href'));
        });

        $(document).ready(function() {
            $(".message").fadeOut(3000);
            $('#dataTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                order: [0, 'asc']
            });
        });
    </script>
    
<?= $this->endSection() ?>