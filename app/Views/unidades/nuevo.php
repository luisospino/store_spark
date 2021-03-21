<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?php echo $titulo ?> </h2>
            
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

            <form method = "POST" action="<?php echo base_url(); ?>/unidades/insertar" autocomplete = "off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" value="<?= old('nombre') ?>" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre corto</label>

                            <input type="text" id = "nombre_corto" name = "nombre_corto" value="<?= old('nombre_corto') ?>" class="form-control" >
                        </div>
                    </div>    
                </div>

                <div class="text-center">
                    <a href="<?= base_url();?>/unidades" class = "btn btn-sm btn-primary">Regresar</a>   
                    <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
                </div>
            </form>

        </div>
    </main>