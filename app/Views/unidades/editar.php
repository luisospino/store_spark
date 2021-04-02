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

            <form method = "POST" action="<?= route_to('unidades.actualizar') ?>" autocomplete = "off">

                <input type="hidden" name = "id" value = "<?= $unidad['id'] ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" class="form-control" value = "<?=  old('nombre') == '' ? $unidad['nombre'] : old('nombre') ?>">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre corto</label>

                            <input type="text" id = "nombre_corto" name = "nombre_corto" class="form-control" value = "<?=  old('nombre_corto') == '' ? $unidad['nombre_corto'] : old('nombre_corto') ?>">
                        </div>
                    </div>    
                </div>

                <div class="text-center">
                    <a href="<?= route_to('unidades.inicio') ?>" class = "btn btn-sm btn-primary">Regresar</a>   
                    <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
                </div>
            </form>

        </div>
    </main>

<?= $this->endSection() ?>