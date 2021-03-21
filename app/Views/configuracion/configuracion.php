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

            <?php if(session()->has('exito')){?>
                <div class="message alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->get('exito') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }?>


            <form method = "POST" enctype = "multipart/form-data" action="<?php echo base_url(); ?>/configuracion/actualizar" autocomplete = "off">
                <input type="hidden" value= <?= $configuracion['id'] ?>>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" value = "<?=  old('nombre') == '' ? $configuracion['nombre'] : old('nombre') ?>" class = "form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>RFC</label>

                            <input type="text" id = "rfc" name = "rfc" value = "<?=  old('rfc') == '' ? $configuracion['rfc'] : old('rfc') ?>" class="form-control" >
                        </div>
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Telefono</label>

                            <input type="text" id = "telefono" name = "telefono" value = "<?=  old('telefono') == '' ? $configuracion['telefono'] : old('telefono') ?>" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Correo</label>

                            <input type="text" id = "correo" name = "correo" value = "<?=  old('correo') == '' ? $configuracion['correo'] : old('correo') ?>" class="form-control" >
                        </div>
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Dirección</label>

                            <input type="text" id = "direccion" name = "direccion" value = "<?=  old('direccion') == '' ? $configuracion['direccion'] : old('direccion') ?>" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Leyenda del ticket</label>

                            <input type="text" id = "leyenda" name = "leyenda" value = "<?=  old('leyenda') == '' ? $configuracion['leyenda'] : old('leyenda') ?>" class="form-control" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Logotipo:</label>
                            <img src = "<?=base_url()?>/img/logo.png" class = "img-responsive" width = "80">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <input type="file" id = "logo" name = "logo" accept = "image/png" class="btn btn-sm btn-primary">
                            <small><p class = "text-danger">Cargar imagen de máximo 1MB</p></small>
                        </div>
                    </div>
                </div>

                <a href="<?= base_url();?>" class = "btn btn-sm btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
            </form>              
        </div>
    </main>