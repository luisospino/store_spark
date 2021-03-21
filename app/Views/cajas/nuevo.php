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

            <form method = "POST" action="<?php echo base_url(); ?>/cajas/insertar" autocomplete = "off">
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

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Folio</label>

                            <input type="text" id = "folio" name = "folio" value="<?= old('folio') ?>" class="form-control" >
                        </div>

                    </div>    
                </div>

                <a href="<?= base_url();?>/cajas" class = "btn btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-success">Guardar</button>
            </form>

        </div>
    </main>