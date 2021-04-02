<?= $this->extend('plantillas\base') ?>

<?= $this->section('content') ?>

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?= $titulo ?> </h2>

            <?php if(count($errors)){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>            
            <?php 
            }
            ?>

            <form method = "POST" action="<?= route_to('clientes.actualizar') ?>" autocomplete = "off">

                <input type="hidden" name = "id" value = "<?= $cliente['id'] ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" class="form-control" value = "<?=  old('nombre') == '' ? $cliente['nombre'] : old('nombre') ?>">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Dirección</label>

                            <input type="text" id = "direccion" name = "direccion" class="form-control" value = "<?=  old('direccion') == '' ? $cliente['direccion'] : old('direccion') ?>">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Teléfono</label>

                            <input type="text" id = "telefono" name = "telefono" class="form-control" value = "<?=  old('telefono') == '' ? $cliente['telefono'] : old('telefono') ?>">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Correo</label>

                            <input type="text" id = "correo" name = "correo" class="form-control" value = "<?=  old('correo') == '' ? $cliente['correo'] : old('correo') ?>">
                        </div>

                    </div>    
                </div>

                <div class="text-center">
                    <a href="<?= route_to('clientes.inicio') ?>" class = "btn btn-sm btn-primary">Regresar</a>   
                    <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
                </div>
            </form>

        </div>
    </main>

<?= $this->endSection() ?>