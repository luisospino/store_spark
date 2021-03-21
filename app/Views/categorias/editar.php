<div id="layoutSidenav_content">
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

            <form method = "POST" action="<?= base_url(); ?>/categorias/actualizar" autocomplete = "off">

                <input type="hidden" name = "id" value = "<?= $categoria['id'] ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" class="form-control" value = "<?=  old('nombre') == '' ? $categoria['nombre'] : old('nombre') ?>">
                        </div>
                    </div>    
                </div>
                <a href="<?= base_url();?>/categorias" class = "btn btn-sm btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
            </form>

        </div>
    </main>