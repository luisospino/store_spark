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

            <form method = "POST" action="<?= route_to('cajas.insertar') ?>" autocomplete = "off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Número</label>

                            <input type="text" id = "numero" name = "numero" value="<?= old('numero') ?>" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" value="<?= old('nombre') ?>" class="form-control" >
                        </div>

                    </div>    
                </div>

                <a href="<?= route_to('cajas.inicio') ?>" class = "btn btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-success">Guardar</button>
            </form>

        </div>
    </main>