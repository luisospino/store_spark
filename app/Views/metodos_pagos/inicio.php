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
                    <a href="<?= route_to('metodos_pagos.crear') ?>" class = "btn btn-sm btn-info">Agregar</a>
                    <a href="<?= route_to('metodos_pagos.eliminados') ?>" class = "btn btn-sm btn-warning">Eliminados</a>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($datos as $dato){ ?>
                                <tr>
                                    <td><?= $dato['id'] ?></td>
                                    <td><?= $dato['nombre'] ?></td>

                                    <td class = "text-center">
                                        <a href="<?= route_to('metodos_pagos.editar', $dato['id']) ?>" class = "btn btn-sm btn-secondary">
                                            <i class = "fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="#" data-href = "<?= route_to('metodos_pagos.eliminar', $dato['id']) ?>" data-toggle = "modal" data-target = "#modal-confirma" data-placement = "top" title = "Eliminar registro" class = "btn btn-sm btn-danger">
                                            <i class = "fas fa-trash"></i>
                                        </a>
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
                <h5 class="modal-title" id="exampleModalLabel">Eliminar método de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p>¿Desea eliminar este método de pago?</p>
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