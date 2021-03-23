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

            <?php if(session()->has('error')){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <li> <?= session()->get('error') ?> </li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }?>

            <form method = "POST" action="<?= route_to('usuarios.actualizar_contrasenha') ?>" autocomplete = "off">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Contraseña actual</label>

                            <input type="password" id = "clave_actual" name = "clave_actual" class="form-control" >
                        </div>
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nueva contraseña</label>

                            <input type="password" id = "clave_nueva" name = "clave_nueva" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Confirmación</label>

                            <input type="password" id = "clave_confirmacion" name = "clave_confirmacion" class="form-control" >
                        </div>
                    </div>    
                </div>

                <a href="<?= route_to('configuracion.inicio') ?>" class = "btn btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-success">Guardar</button>
            </form>

        </div>
    </main>