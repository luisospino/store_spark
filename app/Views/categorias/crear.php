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

            <form method = "POST" action="<?= route_to('categorias.insertar') ?>" autocomplete = "off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" class="form-control" value="<?= old('nombre') ?>">
                        </div>
                    </div>    
                </div>

                <a href="<?= route_to('categorias.inicio') ?>" class = "btn btn-sm btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
            </form>

        </div>
    </main>