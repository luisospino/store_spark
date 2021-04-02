<?= $this->extend('plantillas\base') ?>

<?= $this->section('content') ?>

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?= $titulo ?> </h2>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Evento</th>
                            <th>Detalles</th>
                            <th>IP</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datos as $dato){ ?>
                            <tr>
                                <td><?= $dato['nombre_usuario'] ?></td>
                                <td><?= $dato['rol'] ?></td>
                                <td><?= $dato['detalles'] ?></td>
                                <td><?= $dato['evento'] ?></td>
                                <td><?= $dato['ip'] ?></td>
                                <td><?= $dato['fecha'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>                
        </div>
    </main>

<?= $this->endSection() ?>